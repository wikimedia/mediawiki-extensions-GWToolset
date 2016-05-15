<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Jobs;

use GWToolset\Adapters\Php\MappingPhpAdapter;
use GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter;
use GWToolset\Adapters\Php\MetadataPhpAdapter;
use GWToolset\GWTException;
use GWToolset\Handlers\UploadHandler;
use GWToolset\Models\Mapping;
use GWToolset\Models\MediawikiTemplate;
use GWToolset\Models\Metadata;
use GWToolset\Utils;
use Job;
use ScopedCallback;
use Title;
use User;
use RequestContext;

class UploadMediafileJob extends Job {

	/**
	 * @var {User}
	 */
	protected $User;
	/** @var bool Allow retries */
	protected $allowRetry = true;

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 */
	public function __construct( $title, $params, $id = 0 ) {
		if ( !isset( $params['session'] ) ) {
			$params['session'] = RequestContext::getMain()->exportSession();
		}
		parent::__construct( 'gwtoolsetUploadMediafileJob', $title, $params, $id );
	}

	/**
	 * a control method for re-establishing application state so that the metadata can be processed.
	 * this is similar to MetadataMappingHandler::processMetadata(), however it avoids the necessity
	 * to process the metadata file
	 *
	 * @todo re-factor so that this is able to use MetadataMappingHandler::processRequest(). will
	 * need to add some logic to it so that if a batch job is being process it doesn't display a
	 * form or process the metadata again
	 *
	 * @return {bool|Title}
	 */
	protected function processMetadata() {
		global $wgUser;
		$MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$MediawikiTemplate->getMediaWikiTemplate(
			$this->params['user-options']['gwtoolset-mediawiki-template-name']
		);

		$Mapping = new Mapping( new MappingPhpAdapter() );

		$Mapping->mapping_array = $MediawikiTemplate->getMappingFromArray(
			$this->params['whitelisted-post']
		);

		$Mapping->setTargetElements();
		$Mapping->reverseMap();
		$Metadata = new Metadata( new MetadataPhpAdapter() );

		// AbuseFilter still looks at $wgUser in an UploadVerifyFile hook
		$oldUser = $wgUser;
		$wgUser = $this->User;
		// This will automatically restore $wgUser, when $magicScopeVariable falls out of scope.
		$magicScopeVariable = new ScopedCallback( function() use ( $oldUser ) {
			global $wgUser;
			$wgUser = $oldUser;
		} );

		$UploadHandler = new UploadHandler(
			[
				'Mapping' => $Mapping,
				'MediawikiTemplate' => $MediawikiTemplate,
				'Metadata' => $Metadata,
				'User' => $this->User,
			]
		);

		$MediawikiTemplate->metadata_raw = $this->params['options']['metadata-raw'];
		$MediawikiTemplate->populateFromArray(
			$this->params['options']['metadata-mapped-to-mediawiki-template']
		);

		$Metadata->metadata_raw = $this->params['options']['metadata-raw'];
		$Metadata->metadata_as_array = $this->params['options']['metadata-as-array'];

		$result = $UploadHandler->saveMediafileAsContent( $this->params['user-options'] );

		if ( $result === null ) {
			$result = false;
		}

		return $result;
	}

	/**
	 * entry point
	 * @todo: should $result always be true?
	 * @return {bool|Title}
	 */
	public function run() {
		$result = false;
		$message = null;

		if ( !$this->validateParams() ) {
			return $result;
		}

		if ( isset( $this->params['session'] ) ) {
			$sessionScope = RequestContext::importScopedSession( $this->params['session'] );
			$this->addTeardownCallback( function () use ( &$sessionScope ) {
				ScopedCallback::consume( $sessionScope ); // T126450
			} );
		}

		$this->User = User::newFromName( $this->params['user-name'] );

		try {
			$result = $this->processMetadata();
		} catch ( GWTException $e ) {
			$message = $e->getMessage();

			$this->setLastError(
				__METHOD__ . ': ' .
				$message . PHP_EOL .
				print_r( $this->params['user-options'], true )
			);
		}

		if ( $result instanceof Title ) {
			$this->specialLog( $message, 'mediafile-job-succeeded', $result );
		} else {
			$this->specialLog(
				$message,
				'mediafile-job-failed',
				Title::newFromText(
					wfMessage( 'gwtoolset-title-none' )
						->inContentLanguage()
						->escaped(),
					NS_FILE
				)
			);
		}

		return $result;
	}

	/**
	 * @param {string} $message
	 * @param {string} $job_subtype
	 * @param {object} $Title
	 */
	protected function specialLog( $message, $job_subtype, Title $Title ) {
		$options = [
			'job-subtype' => $job_subtype,
			'Title' => $Title,
			'User' => $this->User
		];

		if ( !empty( $this->params['whitelisted-post']['wpSummary'] ) ) {
			$options['comment'] = $this->params['whitelisted-post']['wpSummary'];
		}

		// when 0, record nr is unknown
		$record_nr = 0;

		if ( !empty( $this->params['user-options']['gwtoolset-record-begin'] ) ) {
			$record_nr = (int)$this->params['user-options']['gwtoolset-record-current'];
		}

		$options['parameters'] = [
			'4::metadata-record-nr' => $record_nr,
			'5::message' => $message
		];

		Utils::specialLog( $options );
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

		if ( empty( $this->params['whitelisted-post'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'whitelisted-post\'] provided' );
			$result = false;
		}

		$this->allowRetry = $result;

		return $result;
	}

	public function allowRetries() {
		return $this->allowRetry;
	}
}
