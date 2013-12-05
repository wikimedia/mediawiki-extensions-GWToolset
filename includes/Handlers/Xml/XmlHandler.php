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
	GWToolset\GWTException,
	GWToolset\Utils,
	Html,
	Linker,
	MWException,
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
	 * @todo: how to handle attributes and children nodes
	 * @todo: handle mal-formed xml (future)
	 * @todo: handle an xml schema if present (future)
	 * @todo: handle incomplete/partial uploads (future)
	 *
	 * @throws {MWException}
	 *
	 * @return {array}
	 * an array of mediafile Title(s)
	 */
	protected function readXmlAsFile(
		array &$user_options, $file_path_local = null, $callback = null
	) {
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

		$old_value = libxml_disable_entity_loader( true );

		while ( $XMLReader->read() ) {
			if ( $XMLReader->nodeType === XMLReader::DOC_TYPE ) {
				if ( $this->_GWTFileBackend instanceof \GWToolset\Helpers\GWTFileBackend ) {
					$mwstore_relative_path = $this->_GWTFileBackend->getMWStoreRelativePath();

					if ( $mwstore_relative_path !== null ) {
						$this->_GWTFileBackend->deleteFileFromRelativePath( $mwstore_relative_path );
					}
				}

				throw new GWTException( 'gwtoolset-xml-doctype' );
			}

			$read_result = $this->$callback( $XMLReader, $user_options );

			if ( !empty( $read_result['Title'] ) ) {
				$result[] = $read_result['Title'];
			}

			if ( $read_result['stop-reading'] ) {
				break;
			}
		}

		libxml_disable_entity_loader( $old_value );

		if ( !$XMLReader->close() ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-could-not-close-xml' )->escaped() )
					->parse()
			);
		}

		return $result;
	}

}
