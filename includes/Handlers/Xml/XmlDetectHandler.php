<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Handlers\Xml;

use Content;
use DOMElement;
use GWToolset\GWTException;
use GWToolset\Utils;
use GWToolset\SpecialGWToolset;
use GWToolset\Models\Mapping;
use Html;
use MWException;
use Sanitizer;
use XMLReader;

/**
 * @todo possibley pull out the decorator methods and place them
 * in the appropriate form handler
 */
class XmlDetectHandler extends XmlHandler {

	/**
	 * @var \GWToolset\Helpers\GWTFileBackend
	 */
	protected $_GWTFileBackend;

	/**
	 * @var array
	 * an array collection of nodeName => nodeValues[] that are taken from the
	 * first matched dom element and will be used during the metadata mapping step
	 * of the upload process
	 */
	protected $_metadata_example_dom_element;

	/**
	 * @var array
	 * an array collection of nodeName => nodeValue matches
	 */
	protected $_metadata_example_dom_nodes;

	/**
	 * @var string
	 * an html string representing the XML metadata as options that can be placed
	 * in an html select element. none of the options has selected=selected
	 */
	protected $_metadata_as_options;

	/**
	 * @var SpecialGWToolset
	 */
	protected $_SpecialPage;

	/**
	 * @param array $options
	 */
	public function __construct( array $options = [] ) {
		$this->reset();

		if ( isset( $options['GWTFileBackend'] ) ) {
			$this->_GWTFileBackend = $options['GWTFileBackend'];
		}

		if ( isset( $options['SpecialPage'] ) ) {
			$this->_SpecialPage = $options['SpecialPage'];
		}
	}

	/**
	 * creates an example xml element that will be used as a sample illustration
	 * of the medtata found in the xml file. this is essentially the first record
	 * element found in the xml file. all found values are added to this
	 * example dom element, so if dc:date appears 3 times then it will appear 3
	 * times in this example dom element.
	 *
	 * additional nodes that do not exist in the first record are added in
	 * findExampleDOMNodes(), but only one value is used
	 *
	 * @param DOMElement $domElement
	 */
	protected function createExampleDOMElement( DOMElement $domElement ) {
		foreach ( $domElement->childNodes as $domNode ) {
			if ( $domNode->nodeType === XML_ELEMENT_NODE ) {
				if ( isset( $this->_metadata_example_dom_element[$domNode->nodeName] ) ) {
					$this->_metadata_example_dom_element[$domNode->nodeName][] = $domNode->nodeValue;
				} else {
					$this->_metadata_example_dom_element[$domNode->nodeName][0] = $domNode->nodeValue;
				}
			}
		}
	}

	/**
	 * attempts to find an example dom element in the metadata xml file that will
	 * be used for mapping the metadata to the mediawiki template. it will also
	 * search through all remaining dom elements and add nodes to the example
	 * record if they were not in the example dom element.
	 *
	 * the search is based on hard-coded keys in the $userOptions array
	 *
	 * - $userOptions['gwtoolset-record-element-name']
	 * - $userOptions['gwtoolset-record-count']
	 *
	 * if a matching dom element is found it is placed in
	 * $this->_metadata_example_dom_element
	 *
	 * @param XMLReader|DOMElement $xmlElement
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @throws MWException
	 */
	protected function findExampleDOMElement( $xmlElement, array &$userOptions ) {
		$record = null;

		if ( !( $xmlElement instanceof XMLReader ) && !( $xmlElement instanceof DOMElement ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-xml-element' )->escaped() )
					->parse()
			);
		}

		if ( !isset( $userOptions['gwtoolset-record-element-name'] )
			|| !isset( $userOptions['gwtoolset-record-count'] )
		) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-dom-record-issue' )->parse() )
					->parse()
			);
		}

		switch ( $xmlElement->nodeType ) {
			case ( XMLReader::ELEMENT ):
				if ( $xmlElement instanceof XMLReader ) {
					if ( $xmlElement->name === $userOptions['gwtoolset-record-element-name'] ) {
						$record = $xmlElement->expand();
					}
				} elseif ( $xmlElement instanceof DOMElement ) {
					if ( $xmlElement->nodeName === $userOptions['gwtoolset-record-element-name'] ) {
						$record = $xmlElement;
					}
				}

				if ( !empty( $record ) ) {
					$userOptions['gwtoolset-record-count'] += 1;

					if ( $userOptions['gwtoolset-record-count'] === 1 ) {
						$this->createExampleDOMElement( $record );
					}

					$this->findExampleDOMNodes( $record );
				}

				break;
		}
	}

	/**
	 * adds DOMNodes to an example collection, $this->_metadata_example_dom_nodes,
	 * that will be used to create form drop-downs for mapping metadata to mediawiki
	 * template parameters
	 *
	 * adds to the example DOMElement, $this->_metadata_example_dom_nodes, any nodes
	 * not yet present in it
	 *
	 * @param DOMElement $domElement
	 */
	protected function findExampleDOMNodes( DOMElement $domElement ) {
		foreach ( $domElement->childNodes as $domNode ) {
			if ( $domNode->nodeType === XML_ELEMENT_NODE ) {
				if ( !array_key_exists( $domNode->nodeName, $this->_metadata_example_dom_nodes ) ) {
					$this->_metadata_example_dom_nodes[$domNode->nodeName] = $domNode->nodeValue;
				}
				if ( !array_key_exists( $domNode->nodeName, $this->_metadata_example_dom_element ) ) {
					$this->_metadata_example_dom_element[$domNode->nodeName][] = $domNode->nodeValue;
				}
			}
		}
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param string|null $parameter
	 * @param string|null $parameter_as_id
	 * @param string|null $required
	 * @param string|null $selected_option
	 *
	 * @return string
	 */
	protected function getButtonRowNoMetadata(
		$parameter = null, $parameter_as_id = null, $required = null, $selected_option = null
	) {
		$template =
			'<tr>' .
			'<td><label for="%s">%s%s :</label></td>' .
			'<td>&nbsp;</td>' .
			'<td><select name="%s[]" id="%s">%s</select></td>' .
			'</tr>';

		return sprintf(
			$template,
			Sanitizer::escapeIdForAttribute( $parameter_as_id ),
			$this->getFormLabel( $parameter ),
			$required,
			Utils::sanitizeString( $parameter ),
			Sanitizer::escapeIdForAttribute( $parameter_as_id ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param string|null $parameter
	 * @param string|null $parameter_as_id
	 * @param string|null $required
	 * @param string|null $selected_option
	 *
	 * @return string
	 */
	protected function getFirstRow(
		$parameter = null, $parameter_as_id = null, $required = null, $selected_option = null
	) {
		$template =
			'<tr>' .
			'<td><label for="%s">%s%s :</label></td>' .
			'<td class="button-add"></td>' .
			'<td><select name="%s[]" id="%s">%s</select></td>' .
			'</tr>';

		return sprintf(
			$template,
			Sanitizer::escapeIdForAttribute( $parameter_as_id ),
			$this->getFormLabel( $parameter ),
			$required,
			Utils::sanitizeString( $parameter ),
			Sanitizer::escapeIdForAttribute( $parameter_as_id ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param string|null $parameter
	 * @param string|null $selected_option
	 *
	 * @return string
	 */
	protected function getFollowingRow( $parameter = null, $selected_option = null ) {
		$template =
			'<tr>' .
			'<td>&nbsp;</td>' .
			'<td class="button-subtract"></td>' .
			'<td><select name="%s[]">%s</select></td>' .
			'</tr>';

		return sprintf(
			$template,
			Utils::sanitizeString( $parameter ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * normalizes form field names so that - _ and gwtoolset are removed from the form label
	 *
	 * @param string $parameter
	 *
	 * @return string
	 * the string has been sanitized
	 */
	protected function getFormLabel( $parameter ) {
		$result = Utils::sanitizeString( $parameter );

		if ( $parameter === 'gwtoolset-title' ) {
			$result = wfMessage( 'gwtoolset-title-label' )->escaped();
		} elseif ( $parameter === 'gwtoolset-url-to-the-media-file' ) {
			$result = wfMessage( 'gwtoolset-url-to-the-media-file-label' )->escaped();
		} else {
			$result = str_replace(
				[ '_', '-' ],
				[ ' ', ' ' ],
				$result
			);
		}

		return $result;
	}

	/**
	 * a decorator method that creates table rows based on the example
	 * DOMElement, $this->_metadata_example_dom_element. the table rows
	 * are extracted metadata elements and their values
	 *
	 * @return string
	 * the values within the table rows have been filtered.
	 */
	public function getMetadataAsHtmlTableRows() {
		$result = null;

		foreach ( $this->_metadata_example_dom_element as $nodeName => $nodeValues ) {
			foreach ( $nodeValues as $nodeValue ) {
				$result .= Html::rawElement(
					'tr',
					[],
					Html::rawElement(
						'td',
						[],
						Utils::sanitizeString( $nodeName )
					) .
					Html::rawElement(
						'td',
						[],
						Utils::sanitizeString( $nodeValue )
					)
				);
			}
		}

		return $result;
	}

	/**
	 * a decorator method that creates a set of <option>s for
	 * an html <select> based on the $this->_metadata_example_dom_nodes.
	 * the method will mark an option as selected if the marked element
	 * is passed into the method
	 *
	 * @param string|null $selected_option
	 *
	 * @return string
	 * the <option> values are filtered.
	 */
	public function getMetadataAsOptions( $selected_option = null ) {
		$result = Html::rawElement( 'option', [ 'value' => '' ], ' ' );

		if ( empty( $selected_option ) ) {
			return $this->_metadata_as_options;
		}

		foreach ( $this->_metadata_example_dom_nodes as $nodeName => $nodeValue ) {
			$attribs = [];

			if ( !empty( $selected_option ) && $nodeName === $selected_option ) {
				$attribs['selected'] = 'selected';
			}

			$result .= Html::rawElement( 'option', $attribs, Utils::sanitizeString( $nodeName ) );
		}

		return $result;
	}

	/**
	 * a decorator method that creates table rows with <select>s used for
	 * mapping metadata elements to mediawiki template parameters
	 *
	 * if a mapping between a mediawiki template and a metadata element is provided
	 * the method will return the <option>s with a selected option that matches the
	 * mapping given
	 *
	 * @param string $parameter
	 * a mediawiki template parameter, e.g. in Template:Artwork, artist
	 *
	 * @param Mapping $mapping
	 *
	 * @return string
	 * the values within the table row have been filtered
	 */
	public function getMetadataAsTableCells( $parameter, Mapping $mapping ) {
		$result = null;
		$selected_options = [];
		$parameter_as_id = Utils::normalizeSpace( $parameter );
		$first_row_placed = false;
		$required = null;
		$required_fields = [ 'gwtoolset-title', 'gwtoolset-url-to-the-media-file' ];

		if ( isset( $mapping->mapping_array[$parameter] ) ) {
			$selected_options = $mapping->mapping_array[$parameter];
		}

		if ( empty( $this->_metadata_as_options ) ) {
			$this->_metadata_as_options = Html::rawElement( 'option', [ 'value' => '' ], ' ' );

			foreach ( $this->_metadata_example_dom_nodes as $nodeName => $nodeValue ) {
				$this->_metadata_as_options .= Html::rawElement(
					'option', [], Utils::sanitizeString( $nodeName )
				);
			}
		}

		if ( in_array( $parameter_as_id, $required_fields ) ) {
			$required = Html::rawElement( 'span', [ 'class' => 'required' ], '*' );
		}

		if ( $parameter_as_id === 'gwtoolset-url-to-the-media-file' ) {
			if ( isset( $selected_options[0] ) ) {
				$result .= $this->getButtonRowNoMetadata(
					$parameter, $parameter_as_id, $required, $selected_options[0]
				);
			} else {
				$result .= $this->getButtonRowNoMetadata( $parameter, $parameter_as_id, $required );
			}
		} elseif ( count( $selected_options ) === 1 ) {
			$result .= $this->getFirstRow(
				$parameter, $parameter_as_id, $required, $selected_options[0]
			);
		} elseif ( count( $selected_options ) > 1 ) {
			foreach ( $selected_options as $option ) {
				if ( array_key_exists( $option, $this->_metadata_example_dom_nodes ) ) {
					if ( !$first_row_placed ) {
						$result .= $this->getFirstRow( $parameter, $parameter_as_id, $required, $option );
						$first_row_placed = true;
					} else {
						$result .= $this->getFollowingRow( $parameter, $option );
					}
				}
			}
		} else {
			$result .= $this->getFirstRow( $parameter, $parameter_as_id, $required );
		}

		return $result;
	}

	/**
	 * a control method for retrieving dom elements from a metadata xml source.
	 * the dom elements will be used for creating option menus and an
	 * example xml record that will be used for mapping the mediawiki template
	 * attributes to the xml metadata elements
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @param string|Content|null $xmlSource
	 * a local wiki path to the xml metadata file or a local wiki Content source.
	 * the assumption is that it has already been uploaded to the wiki earlier and
	 * is ready for use
	 *
	 * @throws GWTException|MWException
	 */
	public function processXml( array &$userOptions, $xmlSource = null ) {
		$callback = 'findExampleDOMElement';

		if ( is_string( $xmlSource ) && !empty( $xmlSource ) ) {
			$this->readXmlAsFile( $userOptions, $xmlSource, $callback );
		} else {
			$msg = wfMessage( 'gwtoolset-developer-issue' )
				->params( wfMessage( 'gwtoolset-no-xml-source' )->escaped() )
				->parse();
			throw new MWException( $msg );
		}

		if ( empty( $this->_metadata_example_dom_element ) ) {
			throw new GWTException(
				[
					'gwtoolset-no-xml-element-found' => [
						'http://www.w3schools.com/xml/xml_validator.asp',
						$this->_SpecialPage->getBackToFormLink()
					]
				]
			);
		}

		ksort( $this->_metadata_example_dom_nodes );
		ksort( $this->_metadata_example_dom_element );
	}

	public function reset() {
		$this->_metadata_as_options = null;
		$this->_metadata_example_dom_element = [];
		$this->_metadata_example_dom_nodes = [];
		$this->_SpecialPage = null;
	}
}
