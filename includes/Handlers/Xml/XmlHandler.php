<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Handlers\Xml;

use GWToolset\GWTException;
use GWToolset\Helpers\GWTFileBackend;
use Html;
use MWException;
use Wikimedia\ScopedCallback;
use XMLReader;

abstract class XmlHandler {

	/**
	 * @var \GWToolset\Helpers\GWTFileBackend
	 */
	protected $_GWTFileBackend;

	abstract public function __construct();

	/**
	 * a debug method for testing the reader
	 *
	 * @param XMLReader $reader
	 * @return string
	 * @suppress PhanTypeSuspiciousStringExpression
	 */
	protected function displayCurrentNodeProperties( XMLReader $reader ) {
		return 'attributeCount : ' . $reader->attributeCount . Html::rawElement( 'br' ) .
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
	}

	/**
	 * a debug method
	 *
	 * @param \DOMNode $domNode
	 * @return string
	 */
	private function getNodesInfo( $domNode ) {
		$result = '';

		if ( $domNode->hasChildNodes() ) {
			$subNodes = $domNode->childNodes;

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

	abstract public function processXml( array &$userOptions, $xmlSource = null );

	/**
	 * opens the xml file as a stream and sends the stream to other methods in
	 * via the $callback to process the file. allows for the reader to be stopped
	 * if the $callback method returns true to the $stop_reading variable
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @param string|null $file_path_local
	 * a local wiki path to the xml metadata file. the assumption is that it
	 * has been uploaded to the wiki earlier and is ready for use
	 *
	 * @param string|null $callback
	 * the method that will be used to process the read xml file
	 *
	 * @todo handle invalid xml
	 * @todo how to handle attributes and children nodes
	 * @todo handle mal-formed xml (future)
	 * @todo handle an xml schema if present (future)
	 * @todo handle incomplete/partial uploads (future)
	 *
	 * @throws MWException
	 *
	 * @return array
	 * an array of mediafile Title(s)
	 */
	protected function readXmlAsFile(
		array &$userOptions, $file_path_local = null, $callback = null
	) {
		$result = [];

		if ( empty( $callback ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-callback' )->escaped() )
					->parse()
			);
		}

		$xmlReader = new XMLReader();

		if ( !$xmlReader->open( $file_path_local ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-could-not-open-xml' )->escaped() )
					->parse()
			);
		}

		// Make sure close() is called if exceptions occur
		$xmlCloser = new ScopedCallback( function () use ( $xmlReader ) {
			$xmlReader->close();
		} );

		$old_value = libxml_disable_entity_loader( true );

		while ( $xmlReader->read() ) {
			if ( $xmlReader->nodeType === XMLReader::DOC_TYPE ) {
				if ( $this->_GWTFileBackend instanceof GWTFileBackend ) {
					$mwstore_relative_path = $this->_GWTFileBackend->getMWStoreRelativePath();

					if ( $mwstore_relative_path !== null ) {
						$this->_GWTFileBackend->deleteFileFromRelativePath( $mwstore_relative_path );
					}
				}

				throw new GWTException( 'gwtoolset-xml-doctype' );
			}

			$read_result = $this->$callback( $xmlReader, $userOptions );

			if ( !empty( $read_result['Title'] ) ) {
				$result[] = $read_result['Title'];
			}

			if ( $read_result['stop-reading'] ) {
				break;
			}
		}

		libxml_disable_entity_loader( $old_value );

		if ( !$xmlReader->close() ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-could-not-close-xml' )->escaped() )
					->parse()
			);
		}

		ScopedCallback::cancel( $xmlCloser ); // done already

		return $result;
	}

}
