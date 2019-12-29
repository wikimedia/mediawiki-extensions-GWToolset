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
use GWToolset\Config;
use GWToolset\Utils;
use MWException;
use XMLReader;

class XmlMappingHandler extends XmlHandler {

	/**
	 * @var \GWToolset\Helpers\GWTFileBackend
	 */
	protected $_GWTFileBackend;

	/**
	 * @var \GWToolset\Models\Mapping|null
	 */
	protected $_Mapping;

	/**
	 * @var \GWToolset\Handlers\Forms\MetadataMappingHandler|null
	 */
	protected $_MappingHandler;

	/**
	 * @var \GWToolset\Models\MediawikiTemplate|null
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var \SpecialPage|null
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

		if ( isset( $options['Mapping'] ) ) {
			$this->_Mapping = $options['Mapping'];
		}

		if ( isset( $options['MappingHandler'] ) ) {
			$this->_MappingHandler = $options['MappingHandler'];
		}

		if ( isset( $options['MediawikiTemplate'] ) ) {
			$this->_MediawikiTemplate = $options['MediawikiTemplate'];
		}

		if ( isset( $options['SpecialPage'] ) ) {
			$this->_SpecialPage = $options['SpecialPage'];
		}
	}

	/**
	 * helper method for getDOMElementAsArray()
	 *
	 * @param array &$array
	 * @param DOMElement $domElement
	 */
	protected function addDOMElementToArray( array &$array, DOMElement $domElement ) {
		$is_url = strpos( $domElement->nodeValue, '://' ) !== false;
		$array[] = $this->getFilteredNodeValue( $domElement, $is_url );

		if ( $domElement->hasAttributes() ) {
			foreach ( $domElement->attributes as $attribute ) {
				$array['@attributes'][$attribute->name] = $attribute->value;
			}
		}
	}

	/**
	 * creates an array based on the dom element provided
	 *   - only goes 1 level down
	 *   - assigns the element name as the array index
	 *   - adds values as an array to the element name index
	 *
	 * we’re using this method instead of a SimpleXMLElement object because we have found that some
	 * metadata sources use XML namespaces without declaring them within the XML document, which
	 * requires additional logic to sort out the namespaced elements that may not be reliable
	 *
	 * @param DOMElement $domElement
	 * @return array
	 */
	protected function getDOMElementAsArray( DOMElement $domElement ) {
		$result = [];

		foreach ( $domElement->childNodes as $childNode ) {
			if ( $childNode->nodeType === XML_ELEMENT_NODE ) {
				if ( !isset( $result[$childNode->tagName] ) ) {
					$result[$childNode->tagName] = [];
					$this->addDOMElementToArray( $result[$childNode->tagName], $childNode );
				} else {
					$this->addDOMElementToArray( $result[$childNode->tagName], $childNode );
				}
			}
		}

		return $result;
	}

	/**
	 * takes in a metadata dom element that represents a targeted
	 * record within the metadata that will be saved/updated in the
	 * wiki as a wiki page and maps it to the mediawiki template
	 * using $this->_Mapping provided to the class
	 *
	 * allows for a one -> many relationship
	 * one mediawiki template parameter -> many dom elements
	 * uses the Config::$metadata_separator to concatenate multiple values
	 *
	 * values are filtered
	 *
	 * uses getElementsByTagName to avoid getElementsByTagNameNS as logic for
	 * getting the NS is not always straightforward
	 *
	 * @todo possibly filter keys and values
	 * @todo possibly refactor so that it works with getDOMElementAsArray
	 *
	 * @param DOMELement $domElement
	 * @param array $userOptions
	 *
	 * @return array
	 * the keys and values in the array have not been filtered
	 * an array that maps mediawiki template parameters to the metadata record
	 * values provided by the DOMElement
	 */
	protected function getDOMElementMapped( DOMElement $domElement, array $userOptions ) {
		$elements_mapped = [];
		$domNodeList = $domElement->getElementsByTagName( '*' );

		// cycle over all of the elements in the record element provided
		/** @var DOMElement $domNodeElement */
		foreach ( $domNodeList as $domNodeElement ) {
			// if the current element is not one that was mapped, skip it
			if ( !array_key_exists(
					$domNodeElement->tagName,
					$this->_Mapping->target_dom_elements_mapped
			) ) {
				continue;
			}

			// an array of mediawiki parameters that should be populatated by this DOMNodeElement’s value
			$template_parameters = $this->_Mapping->target_dom_elements_mapped[$domNodeElement->tagName];
			$lang = null;

			// set the lang attribute if found
			if ( $domNodeElement->hasAttributes() ) {
				foreach ( $domNodeElement->attributes as $domAttribute ) {
					if ( $domAttribute->name === 'lang' ) {
						$lang = Utils::sanitizeString( $domAttribute->value );
						break;
					}
				}
			}

			foreach ( $template_parameters as $template_parameter ) {
				$is_url = strpos( $template_parameter, 'url' ) !== false;

				if ( !empty( $lang ) && $userOptions['gwtoolset-wrap-language'] ) {
					/**
					 * within a record, multimple elements with the same element name, e.g., description
					 * can exist. some may have a lang attribute and some may not. if the first element
					 * found does not have a lang attribute it is stored as a value in
					 * $elements_mapped[$template_parameter] and consecutive elements are concatenate on it.
					 *
					 * however, if one of those similar elements has a lang attribute,
					 * $elements_mapped[$template_parameter] needs to become an array with index [0]
					 * containing the values that do not have a lang attribute and index['language']
					 * containing the languages provided as sub indexes, e.g., ['language']['en']
					 */
					if ( isset( $elements_mapped[$template_parameter] )
						&& !is_array( $elements_mapped[$template_parameter] )
					) {
						$tmp_string = $elements_mapped[$template_parameter];
						$elements_mapped[$template_parameter] = [ $tmp_string ];
					}

					if ( !isset( $elements_mapped[$template_parameter]['language'] ) ) {
						$elements_mapped[$template_parameter]['language'] = [];
					}

					if ( !isset( $elements_mapped[$template_parameter]['language'][$lang] ) ) {
						$elements_mapped[$template_parameter]['language'][$lang] =
							$this->getFilteredNodeValue( $domNodeElement, $is_url );
					} else {
						$elements_mapped[$template_parameter]['language'][$lang] .=
							Config::$metadata_separator .
							$this->getFilteredNodeValue( $domNodeElement, $is_url );
					}
				} else {
					if ( !isset( $elements_mapped[$template_parameter] ) ) {
						if ( $template_parameter === 'gwtoolset-title'
							|| $template_parameter === 'title'
						) {
							$elements_mapped[$template_parameter] =
								$this->getFilteredNodeValue(
									$domNodeElement,
									$is_url,
									[ 'flags' => FILTER_FLAG_NO_ENCODE_QUOTES ]
								);
						} else {
							$elements_mapped[$template_parameter] =
								$this->getFilteredNodeValue( $domNodeElement, $is_url );
						}
					} else {
						if ( $template_parameter === 'gwtoolset-title'
							|| $template_parameter === 'title'
						) {
							$elements_mapped[$template_parameter] .=
								Config::$title_separator .
								$this->getFilteredNodeValue(
									$domNodeElement,
									$is_url,
									[ 'flags' => FILTER_FLAG_NO_ENCODE_QUOTES ]
								);

						// url-to-the-media-file should only be evaluated once
						// when $elements_mapped['gwtoolset-url-to-the-media-file'] is not set
						} elseif ( $template_parameter !== 'gwtoolset-url-to-the-media-file' ) {
							/**
							 * if a template_parameter has some elements with a lang attribute
							 * and some not, the non lang attribute versions need their own
							 * array element
							 *
							 * isset( $elements_mapped[ $template_parameter ][ 'language ] )
							 * doesn't work here
							 */
							if ( is_array( $elements_mapped[$template_parameter] )
								&& array_key_exists( 'language', $elements_mapped[$template_parameter] )
							) {
								if ( !isset( $elements_mapped[$template_parameter][0] ) ) {
									$elements_mapped[$template_parameter][0] =
										$this->getFilteredNodeValue( $domNodeElement, $is_url );
								} else {
									// .= produces PHP Fatal error: Cannot use assign-op operators with overloaded
									// objects nor string offsets
									$elements_mapped[$template_parameter][0] .=
										Config::$metadata_separator .
										$this->getFilteredNodeValue( $domNodeElement, $is_url );
								}
							} else {
								$elements_mapped[$template_parameter] .=
									Config::$metadata_separator .
									$this->getFilteredNodeValue( $domNodeElement, $is_url );
							}
						}
					}
				}
			}
		}

		return $elements_mapped;
	}

	/**
	 * @param DOMElement &$domNodeElement
	 *
	 * @param bool $isUrl
	 *
	 * @param array $options
	 * Fiter options
	 *
	 * @return string
	 * the string has been sanitized
	 */
	protected function getFilteredNodeValue(
		DOMElement &$domNodeElement,
		$isUrl = false,
		array $options = []
	) {
		$result = null;

		if ( $isUrl ) {
			$result = Utils::sanitizeUrl( $domNodeElement->nodeValue, $options );
		} else {
			$result = Utils::sanitizeString( $domNodeElement->nodeValue, $options );
		}

		return $result;
	}

	/**
	 * find dom elements in the $xmlElement provided that match the metadata record element
	 * indicated by original $_POST, $userOptions['gwtoolset-record-element-name']
	 *
	 * each matched metadata record, is sent to $this->_MappingHandler->processMatchingElement()
	 * to be saved as a new mediafile in the wiki or to update an existing mediafile in the wiki
	 *
	 * @param XMLReader|DOMElement $xmlElement
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @throws MWException
	 *
	 * @return array
	 * - $result['Title'] {Title}
	 * - $result['stop-reading'] {bool}
	 */
	protected function processDOMElements( $xmlElement, array &$userOptions ) {
		$result = [ 'Title' => null, 'stop-reading' => false ];
		$record = null;
		$outer_xml = null;

		if ( !( $xmlElement instanceof XMLReader )
			&& !( $xmlElement instanceof DOMElement )
		) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-xml-element' )->escaped() )
					->parse()
			);
		}

		if ( !isset( $userOptions['gwtoolset-record-element-name'] )
			|| !isset( $userOptions['gwtoolset-record-count'] )
			|| !isset( $userOptions['gwtoolset-record-current'] )
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
						$outer_xml = $xmlElement->readOuterXml();
					}
				} elseif ( $xmlElement instanceof DOMElement ) {
					// @phan-suppress-previous-line PhanRedundantCondition
					if ( $xmlElement->nodeName === $userOptions['gwtoolset-record-element-name'] ) {
						$record = $xmlElement;
						$outer_xml = $record->ownerDocument->saveXml( $record );
					}
				}

				if ( !empty( $record ) ) {
					$userOptions['gwtoolset-record-current'] += 1;

					// don’t process the element if the current record nr is <
					// the record nr we should begin processing on
					if (
						$userOptions['gwtoolset-record-current'] < $userOptions['gwtoolset-record-begin']
					) {
						break;
					}

					// stop processing if the current record nr is >=
					// the record nr we should begin processing on plus the job throttle
					if (
						(int)$userOptions['gwtoolset-record-current']
						>= ( (int)$userOptions['gwtoolset-record-begin'] +
						(int)$userOptions['gwtoolset-mediafile-throttle'] )
					) {
						$result['stop-reading'] = true;
						break;
					}

					$result['Title'] = $this->_MappingHandler->processMatchingElement(
						$userOptions,
						[
							'metadata-as-array' => $this->getDOMElementAsArray( $record ),
							'metadata-mapped-to-mediawiki-template' =>
								$this->getDOMElementMapped( $record, $userOptions ),
							'metadata-raw' => $outer_xml
						]
					);
				}

				break;
		}

		return $result;
	}

	/**
	 * a control method for retrieving dom elements from an xml metadata
	 * source. the dom elements will be used for creating mediafile
	 * Titles in the wiki.
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the original $_POST
	 *
	 * @param string|Content|null $xmlSource
	 * a local wiki path to the xml metadata file or a local wiki Content source.
	 * the assumption is that it has already been uploaded to the wiki earlier and
	 * is ready for use
	 *
	 * @throws MWException
	 * @return array
	 * an array of mediafile Title(s)
	 */
	public function processXml( array &$userOptions, $xmlSource = null ) {
		$callback = 'processDOMElements';

		if ( is_string( $xmlSource ) && !empty( $xmlSource ) ) {
			return $this->readXmlAsFile( $userOptions, $xmlSource, $callback );
		} else {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-xml-source' )->escaped() )
					->parse()
			);
		}
	}

	public function reset() {
		$this->_Mapping = null;
		$this->_MappingHandler = null;
		$this->_MediawikiTemplate = null;
		$this->_SpecialPage = null;
	}
}
