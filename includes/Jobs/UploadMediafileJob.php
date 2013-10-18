<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Jobs;
use GWToolset\Adapters\Php\MappingPhpAdapter,
	GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter,
	GWToolset\Adapters\Php\MetadataPhpAdapter,
	GWToolset\Models\Mapping,
	GWToolset\Models\MediawikiTemplate,
	GWToolset\Models\Metadata,
	GWToolset\Handlers\UploadHandler,
	MWException,
	Job,
	User;

class UploadMediafileJob extends Job {

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 * @return {void}
	 */
	public function __construct( $title, $params, $id = 0 ) {
		parent::__construct( 'gwtoolsetUploadMediafileJob', $title, $params, $id );
	}

	/**
	 * a control method for re-establishing application state so that the metadata can be processed.
	 * this is similar to MetadataMappingHandler::processMetadata(), however it avoids the necessity
	 * to process the metadata file
	 *
	 * @todo re-factor so that this is able to use MetadataMappingHandler::processMetadata(). will
	 * need to add some logic to it so that if a batch job is being process it doesn't display a form
	 * or process the metadata again
	 *
	 * @return {bool|Title}
	 */
	protected function processMetadata() {
		$result = false;
		$_POST = $this->params['post'];

		$MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$MediawikiTemplate->getMediaWikiTemplate( $this->params['user-options'] );

		$Mapping = new Mapping( new MappingPhpAdapter() );
		$Mapping->mapping_array = $MediawikiTemplate->getMappingFromArray( $_POST );
		$Mapping->setTargetElements();
		$Mapping->reverseMap();

		$Metadata = new Metadata( new MetadataPhpAdapter() );

		$User = User::newFromName( $this->params['user-name'] );

		$UploadHandler = new UploadHandler(
			array(
				'Mapping' => $Mapping,
				'MediawikiTemplate' => $MediawikiTemplate,
				'Metadata' => $Metadata,
				'User' => $User,
			)
		);

		$MediawikiTemplate->metadata_raw = $this->params['options']['metadata-raw'];
		$MediawikiTemplate->populateFromArray(
			$this->params['options']['metadata-mapped-to-mediawiki-template']
		);

		$Metadata->metadata_raw = $this->params['options']['metadata-raw'];
		$Metadata->metadata_as_array = $this->params['options']['metadata-as-array'];

		$result = $UploadHandler->saveMediafileAsContent( $this->params['user-options'] );

		return $result;
	}

	/**
	 * entry point
	 * @todo: should $result always be true?
	 * @return {bool|Title}
	 */
	public function run() {
		$result = false;

		if ( !$this->validateParams() ) {
			return $result;
		}

		try {
			$result = $this->processMetadata();
		} catch ( MWException $e ) {
			$this->setLastError(
				__METHOD__ . ': ' .
				$e->getMessage() .
				print_r( $this->params['user-options'], true )
			);
		}

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function validateParams() {
		$result = true;

		if ( empty( $this->params['options'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'options\'] provided' );
			$result = false;
		}

		if ( empty( $this->params['options']['metadata-mapped-to-mediawiki-template'] ) ) {
			$this->setLastError(
				__METHOD__ .
				': no $this->params[\'options\'][\'metadata-mapped-to-mediawiki-template\'] provided'
			);
			$result = false;
		}

		if ( empty( $this->params['options']['metadata-raw'] ) ) {
			$this->setLastError(
				__METHOD__ . ': no $this->params[\'options\'][\'metadata-raw\'] provided'
			);
			$result = false;
		}

		if ( empty( $this->params['user-name'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'user-name\'] provided' );
			$result = false;
		}

		if ( empty( $this->params['user-options'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'user-options\'] provided' );
			$result = false;
		}

		return $result;
	}
}
