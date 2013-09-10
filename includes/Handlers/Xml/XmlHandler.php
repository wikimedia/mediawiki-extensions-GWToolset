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
	DOMDocument,
	DOMXPath,
	Html,
	Linker,
	MWException,
	Php\Filter,
	XMLReader;

abstract class XmlHandler {

	public abstract function __construct();

	/**
	 * a debug method for testing the reader
	 *
	 * @param {XMLReader} $reader
	 * @return {string}
	 */
	protected function displayCurrentNodeProperties( XMLReader $reader ) {
		return
			'attributeCount : ' . $reader->attributeCount . Html::rawElement( 'br' ) .
			'baseURI : ' . $reader->baseURI . Html::rawElement( 'br' ) .
			'depth : ' . $reader->depth . Html::rawElement( 'br' ) .
			'hasAttributes : ' . $reader->hasAttributes . Html::rawElement( 'br' ) .
			'hasValue : ' . $reader->hasValue . Html::rawElement( 'br' ) .
			'isDefault : ' . $reader->isDefault . Html::rawElement( 'br' ) .
			'isEmptyElemet : ' . $reader->isEmptyElement . Html::rawElement( 'br' ) .
			'localName : ' . $reader->localName . Html::rawElement( 'br' ) .
			'name : ' . $reader->name . Html::rawElement( 'br' ) .
			'namespaceURI : ' . $reader->namespaceURI . Html::rawElement( 'br' ) .
			'nodeType : ' . $reader->nodeType . Html::rawElement( 'br' ) .
			'prefix : ' . $reader->prefix . Html::rawElement( 'br' ) .
			'value : ' . $reader->value . Html::rawElement( 'br' ) .
			'xmlLang : ' . $reader->xmlLang . Html::rawElement( 'br' );
			Html::rawElement( 'br' );
	}

	/**
	 * a debug method
	 *
	 * @param {DOMNode} $DOMNode
	 * @return {string}
	 */
	protected function getNodesInfo( $DOMNode ) {
		$result = null;

		if ( $DOMNode->hasChildNodes() ) {
			$subNodes = $DOMNode->childNodes;

			foreach ( $subNodes as $subNode ) {
				if ( ( $subNode->nodeType !== 3 ) ||
					( ( $subNode->nodeType === 3 ) &&
						( strlen( trim( $subNode->wholeText ) ) >= 1 ) )
				) {
					$result .=
						'Node name: ' . $subNode->nodeName . Html::rawElement( 'br' ) .
						'Node value: ' . $subNode->nodeValue . Html::rawElement( 'br' ) .
						Html::rawElement( 'br' );
				}

				$this->getNodesInfo( $subNode );
			}
		}

		return $result;
	}

	public abstract function processXml( array &$user_options, $xml_source = null );

	/**
	 * opens the xml file as a stream and sends the stream to other methods in
	 * via the $callback to process the file. allows for the reader to be stopped
	 * if the $callback method returns true to the $stop_reading variable
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {string} $file_path_local
	 * a local wiki path to the xml metadata file. the assumption is that it
	 * has been uploaded to the wiki earlier and is ready for use
	 *
	 * @param {string} $callback
	 * the method that will be used to process the read xml file
	 *
	 * @todo: handle invalid xml
	 * @todo: handle no record-element-name found, specified element does not exist
	 * @todo: how to handle attributes and children nodes
	 * @todo: how to store entire file while only reading first node and preparing for element to template matching
	 * @todo: upload by url use internal upload process rather than the api
	 * @todo: parse the actual Artwork template for attributes rather than rely on a hard-coded class
	 * @todo: setup so that record x can be used for mapping rather than only the first record, which is the current default
	 * @todo: figure out a batch job processing method
	 * @todo: handle mal-formed xml (future)
	 * @todo: handle an xml schema if present (future)
	 * @todo: handle incomplete/partial uploads (future)
	 *
	 * @throws {MWException}
	 *
	 * @return {array}
	 * an array of mediafile Title(s)
	 */
	protected function readXmlAsFile( array &$user_options, $file_path_local = null, $callback = null ) {
		$result = array();
		$read_result = array( 'Title' => null, 'stop-reading' => false );

		if ( empty( $callback ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-callback' )->escaped() )
					->parse()
			);
		}

		$XMLReader = new XMLReader();

		if ( !$XMLReader->open( $file_path_local ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-could-not-open-xml' )->escaped() )
					->parse()
			);
		}

		while ( $XMLReader->read() ) {
			$read_result = $this->$callback( $XMLReader, $user_options );

			if ( !empty( $read_result['Title'] ) ) {
				$result[] = $read_result['Title'];
			}

			if ( $read_result['stop-reading'] ) {
				break;
			}
		}

		if ( !$XMLReader->close() ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-could-not-close-xml' )->escaped() )
					->parse()
			);
		}

		return $result;
	}

	/**
	 * reads an xml string and sends the nodes to other methods
	 * via the $callback to process the them.
	 *
	 * allows for the reading to be stopped if the $callback
	 * method returns $read_result['stop-reading'] = true
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {string} $xml_source
	 * an xml string
	 *
	 * @param {string} $callback
	 * the method that will be used to process the read xml file
	 *
	 * @todo: handle invalid xml
	 * @todo: handle no record-element-name found, specified element does not exist
	 * @todo: how to handle attributes and children nodes
	 * @todo: how to store entire file while only reading first node and preparing for element to template matching
	 * @todo: upload by url use internal upload process rather than the api
	 * @todo: parse the actual Artwork template for attributes rather than rely on a hard-coded class
	 * @todo: setup so that record x can be used for mapping rather than only the first record, which is the current default
	 * @todo: figure out a batch job processing method
	 * @todo: handle mal-formed xml (future)
	 * @todo: handle an xml schema if present (future)
	 * @todo: handle incomplete/partial uploads (future)
	 *
	 * @throws {MWException}
	 *
	 * @return {array}
	 * an array of mediafile Title(s)
	 */
	protected function readXmlAsString( array &$user_options, $xml_source = null, &$callback = null ) {
		$result = array();
		$read_result = array( 'Title' => null, 'stop-reading' => false );

		if ( empty( $callback ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )->params(
					wfMessage( 'gwtoolset-no-callback' )->escaped()
				)->parse()
			);
		}

		libxml_use_internal_errors( true );
		libxml_clear_errors();

		$DOMDoc = new DOMDocument();
		$DOMDoc->loadXML( $xml_source );
		$errors = libxml_get_errors();

		if ( !empty( $errors ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-xml-error' )->escaped() .
				Html::rawElement( 'pre', array( 'style' => 'overflow:auto;' ), print_r( $errors, true ) )
			);
		}

		$DOMXPath = new DOMXPath( $DOMDoc );
		$DOMNodeList = $DOMXPath->query( '//' . Filter::evaluate( $user_options['record-element-name'] ) );

		if ( $DOMNodeList->length < 1 ) {
			$msg =
				wfMessage( 'gwtoolset-no-xml-element-found' )->escaped() .
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

		foreach ( $DOMNodeList as $DOMNode ) {
			$read_result = $this->$callback( $DOMNode, $user_options );

			if ( !empty( $read_result['Title'] ) ) {
				$result[] = $read_result['Title'];
			}

			if ( $read_result['stop-reading'] ) {
				break;
			}
		}

		return $result;
	}
}
