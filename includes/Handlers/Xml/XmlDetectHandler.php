<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Handlers\Xml;
use Content,
	DOMElement,
	Html,
	GWToolset\Models\Mapping,
	GWToolset\Models\MediawikiTemplate,
	MWException,
	Php\Filter,
	XMLReader;

/**
 * @todo possibley pull out the decorator methods and place them
 * in the appropriate form handler
 */
class XmlDetectHandler extends XmlHandler {

	/**
	 * @var {array}
	 * an array collection of nodeName => nodeValues[] that are taken from the
	 * first matched dom element and will be used during the metadata mapping step
	 * of the upload process
	 */
	protected $_metadata_example_dom_element;

	/**
	 * @var {array}
	 * an array collection of nodeName => nodeValue matches
	 */
	protected $_metadata_example_dom_nodes;

	/**
	 * @var {string}
	 * an html string representing the XML metadata as options that can be placed
	 * in an html select element. none of the options has selected=selected
	 */
	protected $_metadata_as_options;

	/**
	 * @param {array} $options
	 * @return {void}
	 */
	public function __construct( array $options = array() ) {
		$this->reset();
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
	 * @param {DOMElement} $DOMElement
	 * @return {void}
	 */
	protected function createExampleDOMElement( DOMElement $DOMElement ) {
		foreach ( $DOMElement->childNodes as $DOMNode ) {
			if ( $DOMNode->nodeType === XML_ELEMENT_NODE ) {
				if ( isset( $this->_metadata_example_dom_element[$DOMNode->nodeName] ) ) {
					$this->_metadata_example_dom_element[$DOMNode->nodeName][] = $DOMNode->nodeValue;
				} else {
					$this->_metadata_example_dom_element[$DOMNode->nodeName][0] = $DOMNode->nodeValue;
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
	 * the search is based on hard-coded keys in the $user_options array
	 *
	 * - $user_options['record-element-name']
	 * - $user_options['record-count']
	 *
	 * if a matching dom element is found it is placed in
	 * $this->_metadata_example_dom_element
	 *
	 * @param {XMLReader|DOMElement} $XMLElement
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @throws {MWException}
	 * @return {void}
	 */
	protected function findExampleDOMElement( $XMLElement, array &$user_options ) {
		$record = null;

		if ( !( $XMLElement instanceof XMLReader ) && !( $XMLElement instanceof DOMElement ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-xml-element' )->escaped() )
					->parse()
			);
		}

		if ( !isset( $user_options['record-element-name'] )
			|| !isset( $user_options['record-count'] )
		) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-dom-record-issue' )->parse() )
					->parse()
			);
		}

		switch ( $XMLElement->nodeType ) {
			case ( XMLReader::ELEMENT ):
				if ( $XMLElement instanceof XMLReader ) {
					if ( $XMLElement->name === $user_options['record-element-name'] ) {
						$record = $XMLElement->expand();
					}
				} elseif ( $XMLElement instanceof DOMElement ) {
					if ( $XMLElement->nodeName === $user_options['record-element-name'] ) {
						$record = $XMLElement;
					}
				}

				if ( !empty( $record ) ) {
					$user_options['record-count'] += 1;

					if ( $user_options['record-count'] === 1 ) {
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
	 * @param {DOMElement} $DOMElement
	 * @return {void}
	 */
	protected function findExampleDOMNodes( DOMElement $DOMElement ) {
		foreach ( $DOMElement->childNodes as $DOMNode ) {
			if ( $DOMNode->nodeType === XML_ELEMENT_NODE ) {
				if ( !array_key_exists( $DOMNode->nodeName, $this->_metadata_example_dom_nodes ) ) {
					$this->_metadata_example_dom_nodes[$DOMNode->nodeName] = $DOMNode->nodeValue;
				}
				if ( !array_key_exists( $DOMNode->nodeName, $this->_metadata_example_dom_element ) ) {
					$this->_metadata_example_dom_element[$DOMNode->nodeName][] = $DOMNode->nodeValue;
				}
			}
		}
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param {string} $parameter
	 * @param {string} $parameter_as_id
	 * @param {string} $required
	 * @param {string} $selected_option
	 *
	 * @return {string}
	 */
	protected function getButtonRowNoMetadata( $parameter = null, $parameter_as_id = null, $required = null, $selected_option = null ) {
		$template =
			'<tr>' .
			'<td><label for="%s">%s%s :</label></td>' .
			'<td>&nbsp;</td>' .
			'<td><select name="%s[]" id="%s">%s</select></td>' .
			'</tr>';

		return sprintf(
			$template,
			Filter::evaluate( $parameter_as_id ),
			Filter::evaluate( $parameter ),
			$required,
			Filter::evaluate( $parameter ),
			Filter::evaluate( $parameter_as_id ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param {string} $parameter
	 * @param {string} $parameter_as_id
	 * @param {string} $required
	 * @param {string} $selected_option
	 *
	 * @return {string}
	 */
	protected function getFirstRow( $parameter = null, $parameter_as_id = null, $required = null, $selected_option = null ) {
		$template =
			'<tr>' .
			'<td><label for="%s">%s%s :</label></td>' .
			'<td class="button-add"></td>' .
			'<td><select name="%s[]" id="%s">%s</select></td>' .
			'</tr>';

		return sprintf(
			$template,
			Filter::evaluate( $parameter_as_id ),
			Filter::evaluate( $parameter ),
			$required,
			Filter::evaluate( $parameter ),
			Filter::evaluate( $parameter_as_id ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * a decorator helper method for getMetadataAsTableCells
	 *
	 * @param {string} $parameter
	 * @param {string} $selected_option
	 *
	 * @return {string}
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
			Filter::evaluate( $parameter ),
			$this->getMetadataAsOptions( $selected_option )
		);
	}

	/**
	 * a decorator method that creates table rows based on the example
	 * DOMElement, $this->_metadata_example_dom_element. the table rows
	 * are extracted metadata elements and their values
	 *
	 * @return {string}
	 * the values within the table rows have been filtered.
	 */
	public function getMetadataAsHtmlTableRows() {
		$result = null;

		foreach ( $this->_metadata_example_dom_element as $nodeName => $nodeValues ) {
			foreach ( $nodeValues as $nodeValue ) {
				$result .= Html::rawElement(
					'tr',
					array(),
					Html::rawElement(
						'td',
						array(),
						Filter::evaluate( $nodeName )
					) .
					Html::rawElement(
						'td',
						array(),
						Filter::evaluate( $nodeValue )
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
	 * @param {string} $selected_option
	 *
	 * @return {string}
	 * the <option> values are filtered.
	 */
	public function getMetadataAsOptions( $selected_option = null ) {
		$result = Html::rawElement( 'option', array( 'value' => '' ), ' ' );

		if ( empty( $selected_option ) ) {
			return $this->_metadata_as_options;
		}

		foreach ( $this->_metadata_example_dom_nodes as $nodeName => $nodeValue ) {
			$attribs = array();

			if ( !empty( $selected_option ) && $nodeName === $selected_option ) {
				$attribs['selected'] = 'selected';
			}

			$result .= Html::rawElement( 'option', $attribs, Filter::evaluate( $nodeName ) );
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
	 * @param {string} $parameter
	 * a mediawiki template parameter, e.g. in Template:Artwork, artist
	 *
	 * @param {MediawikiTemplate} $MediawikiTemplate
	 * @param {Mapping} $Mapping
	 *
	 * @return {string}
	 * the values within the table row have been filtered
	 */
	public function getMetadataAsTableCells( $parameter, MediawikiTemplate $MediawikiTemplate, Mapping $Mapping ) {
		$result = null;
		$selected_options = array();
		$parameter_as_id = $MediawikiTemplate->getParameterAsId( $parameter );
		$first_row_placed = false;
		$required = null;
		$required_fields = array( 'title-identifier', 'url-to-the-media-file' );

		if ( isset( $Mapping->mapping_array[$parameter] ) ) {
			$selected_options = $Mapping->mapping_array[$parameter];
		}

		if ( empty( $this->_metadata_as_options ) ) {
			$this->_metadata_as_options = Html::rawElement( 'option', array( 'value' => '' ), ' ' );

			foreach ( $this->_metadata_example_dom_nodes as $nodeName => $nodeValue ) {
				$this->_metadata_as_options .= Html::rawElement( 'option', array(), Filter::evaluate( $nodeName ) );
			}
		}

		if ( in_array( $parameter_as_id, $required_fields ) ) {
			$required = Html::rawElement( 'span', array( 'class' => 'required' ), '*' );
		}

		if ( $parameter_as_id === 'url-to-the-media-file' ) {
			if ( isset( $selected_options[0] ) ) {
				$result .= $this->getButtonRowNoMetadata( $parameter, $parameter_as_id, $required, $selected_options[0] );
			} else {
				$result .= $this->getButtonRowNoMetadata( $parameter, $parameter_as_id, $required );
			}
		} elseif ( count( $selected_options ) === 1 ) {
			$result .= $this->getFirstRow( $parameter, $parameter_as_id, $required, $selected_options[0] );
		} elseif ( count( $selected_options ) > 1 ) {
			foreach ( $selected_options as $option ) {
				if ( key_exists( $option, $this->_metadata_example_dom_nodes ) ) {
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
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {string|Content} $xml_source
	 * a local wiki path to the xml metadata file or a local wiki Content source.
	 * the assumption is that it has already been uploaded to the wiki earlier and
	 * is ready for use
	 *
	 * @throws {MWException}
	 * @return {void}
	 */
	public function processXml( array &$user_options, $xml_source = null ) {
		$callback = 'findExampleDOMElement';

		if ( is_string( $xml_source ) && !empty( $xml_source ) ) {
			$this->readXmlAsFile( $user_options, $xml_source, $callback );
		} elseif ( $xml_source instanceof Content ) {
			$this->readXmlAsString( $user_options, $xml_source->getNativeData(), $callback );
		} else {
			$msg = wfMessage( 'gwtoolset-developer-issue' )->params(
				wfMessage( 'gwtoolset-no-xml-source' )->escaped()
			)->parse();
			throw new MWException( $msg );
		}

		if ( empty( $this->_metadata_example_dom_element ) ) {
			$msg = wfMessage( 'gwtoolset-no-xml-element-found' )->escaped() .
				Html::openElement( 'ul' ) .
					Html::rawElement(
						'li',
						array(),
						wfMessage( 'gwtoolset-no-xml-element-found-li-1' )->escaped()
					) .
					Html::rawElement(
						'li',
						array(),
						wfMessage( 'gwtoolset-no-xml-element-found-li-2' )->rawParams(
							Html::rawElement(
								'a',
								array(
									'href' => 'http://www.w3schools.com/xml/xml_validator.asp',
									'target' => '_blank'
								),
								'XML Validator'
							)
						)->escaped()
					) .
				Html::closeElement( 'ul' ) .
				$this->_SpecialPage->getBackToFormLink();
			throw new MWException( $msg );
		}

		ksort( $this->_metadata_example_dom_nodes );
		ksort( $this->_metadata_example_dom_element );
	}

	/**
	 * @return {void}
	 */
	public function reset() {
		$this->_metadata_as_options = null;
		$this->_metadata_example_dom_element = array();
		$this->_metadata_example_dom_nodes = array();
		$this->_SpecialPage = null;
	}
}
