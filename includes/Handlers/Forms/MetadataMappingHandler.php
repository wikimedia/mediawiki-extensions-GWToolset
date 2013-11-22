<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Handlers\Forms;
use FSFile,
	GWToolset\Adapters\Php\MappingPhpAdapter,
	GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter,
	GWToolset\Adapters\Php\MetadataPhpAdapter,
	GWToolset\Config,
	GWToolset\Constants,
	GWToolset\Utils,
	GWToolset\Forms\PreviewForm,
	GWToolset\GWTException,
	GWToolset\Helpers\GWTFileBackend,
	GWToolset\Handlers\UploadHandler,
	GWToolset\Handlers\Xml\XmlMappingHandler,
	GWToolset\Jobs\UploadMetadataJob,
	GWToolset\Models\Mapping,
	GWToolset\Models\MediawikiTemplate,
	GWToolset\Models\Metadata,
	Html,
	JobQueueGroup,
	Linker,
	MWException,
	SpecialPage,
	Title,
	User;

class MetadataMappingHandler extends FormHandler {

	/**
	 * @var {array}
	 */
	protected $_expected_post_fields = array(
		'gwtoolset-category' => array( 'size' => 255 ),
		'gwtoolset-category-phrase' => array( 'size' => 255 ),
		'gwtoolset-category-metadata' => array( 'size' => 255 ),
		'gwtoolset-form' => array( 'size' => 255 ),
		'gwtoolset-preview' => array( 'size' => 255 ),
		'gwtoolset-mediawiki-template-name' => array( 'size' => 255 ),
		'gwtoolset-metadata-file-mwstore' => array( 'size' => 255 ),
		'gwtoolset-metadata-file-sha1' => array( 'size' => 255 ),
		'gwtoolset-metadata-file-url' => array( 'size' => 255 ),
		'gwtoolset-metadata-mapping-name' => array( 'size' => 255 ),
		'gwtoolset-metadata-mapping-subpage' => array( 'size' => 255 ),
		'gwtoolset-metadata-mapping-url' => array( 'size' => 255 ),
		'gwtoolset-metadata-namespace' => array( 'size' => 255 ),
		'gwtoolset-partner-template-url' => array( 'size' => 255 ),
		'gwtoolset-record-begin' => array( 'size' => 255 ),
		'gwtoolset-record-count' => array( 'size' => 255 ),
		'gwtoolset-record-element-name' => array( 'size' => 255 ),
		'wpEditToken' => array( 'size' => 255 ),
		'wpSummary' => array( 'size' => 255 )
	);

	/**
	 * @var {GWToolset\Models\Mapping}
	 */
	protected $_Mapping;

	/**
	 * @var {GWToolset\Models\MediawikiTemplate}
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var {GWToolset\Models\Metadata}
	 */
	protected $_Metadata;

	/**
	 * @var {GWToolset\Handlers\UploadHandler}
	 */
	protected $_UploadHandler;

	/**
	 * #var {array}
	 */
	protected $_whitelisted_post;

	/**
	 * @var {GWToolset\Handlers\XmlMappingHandler}
	 */
	protected $_XmlMappingHandler;

	/**
	 * @throws {MWException}
	 *
	 * @return {string}
	 * the html string has been escaped and parsed by wfMessage
	 */
	protected function createMetadataBatchJob() {
		$result = false;

		$job = new UploadMetadataJob(
			Title::newFromText(
				$this->User->getName() . '/' .
				Constants::EXTENSION_NAME . '/' .
				'Metadata Batch Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'attempts' => 1,
				'user-name' => $this->User->getName(),
				'whitelisted-post' => $this->_whitelisted_post
			)
		);

		$result = JobQueueGroup::singleton()->push( $job );

		if ( $result ) {
			$newFilesLink = Linker::link(
				Title::newFromText( 'Special:NewFiles' ),
				null,
				array( 'target' => '_blank' )
			);

			$result = wfMessage( 'gwtoolset-batchjob-metadata-created' )
				->rawParams( $newFilesLink )
				->parse();
		} else {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-batchjob-metadata-creation-failure' )->escaped() )
					->parse()
			);
		}

		return $result;
	}

	/**
	 * sets the $user_options['categories'] index as appropriate.
	 * this value is used by UploadHandler to add global categories
	 * to a medifile wiki page; global meaning that these categories
	 * are added to all mediafiles that are being uploaded
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 */
	protected function getGlobalCategories( array &$user_options ) {
		$user_options['categories'] = Config::$mediawiki_template_default_category;

		if ( isset( $this->_whitelisted_post['gwtoolset-category'] ) ) {
			foreach ( $this->_whitelisted_post['gwtoolset-category'] as $category ) {
				if ( !empty( $category ) ) {
					$user_options['categories'] .= Config::$category_separator . $category;
				}
			}
		}
	}

	/**
	 * gets various user options from $this->_whitelisted_post and sets default values
	 * if no user value is supplied
	 *
	 * @return {array}
	 * the values within the array have not been filtered
	 */
	protected function getUserOptions() {
		$result = array(
			'categories' => null,

			'gwtoolset-category-phrase' =>
				!empty( $this->_whitelisted_post['gwtoolset-category-phrase'] )
				? $this->_whitelisted_post['gwtoolset-category-phrase']
				: array(),

			'gwtoolset-category-metadata' =>
				!empty( $this->_whitelisted_post['gwtoolset-category-metadata'] )
				? $this->_whitelisted_post['gwtoolset-category-metadata']
				: array(),

			'comment' =>
				!empty( $this->_whitelisted_post['wpSummary'] )
				? $this->_whitelisted_post['wpSummary']
				: '',

			'gwtoolset-mediawiki-template-name' =>
				!empty( $this->_whitelisted_post['gwtoolset-mediawiki-template-name'] )
				? $this->_whitelisted_post['gwtoolset-mediawiki-template-name']
				: null,

			'gwtoolset-metadata-file-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-url'] )
				? urldecode( $this->_whitelisted_post['gwtoolset-metadata-file-url'] )
				: null,

			'gwtoolset-metadata-file-mwstore' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-mwstore'] )
				? urldecode( $this->_whitelisted_post['gwtoolset-metadata-file-mwstore'] )
				: null,

			'gwtoolset-metadata-file-sha1' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-sha1'] )
				? $this->_whitelisted_post['gwtoolset-metadata-file-sha1']
				: null,

			'gwtoolset-partner-template-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-partner-template-url'] )
				? urldecode( $this->_whitelisted_post['gwtoolset-partner-template-url'] )
				: null,

			'preview' => !empty( $this->_whitelisted_post['gwtoolset-preview'] )
				? true
				: false,

			'gwtoolset-record-begin' =>
				!empty( $this->_whitelisted_post['gwtoolset-record-begin'] )
				? (int)$this->_whitelisted_post['gwtoolset-record-begin']
				: 1,

			'gwtoolset-record-count' =>
				!empty( $this->_whitelisted_post['gwtoolset-record-count'] )
				? (int)$this->_whitelisted_post['gwtoolset-record-count']
				: 0,

			'gwtoolset-record-current' => 0,

			'gwtoolset-record-element-name' =>
				!empty( $this->_whitelisted_post['gwtoolset-record-element-name'] )
				? $this->_whitelisted_post['gwtoolset-record-element-name']
				: 'record',

			'save-as-batch-job' =>
				!empty( $this->_whitelisted_post['save-as-batch-job'] )
				? (bool)$this->_whitelisted_post['save-as-batch-job']
				: false,

			'gwtoolset-title-identifier' =>
				!empty( $this->_whitelisted_post['gwtoolset-title-identifier'] )
				? $this->_whitelisted_post['gwtoolset-title-identifier']
				: null,

			'upload-media' =>
				!empty( $this->_whitelisted_post['upload-media'] )
				? (bool)$this->_whitelisted_post['upload-media']
				: false,

			'gwtoolset-url-to-the-media-file' =>
				!empty( $this->_whitelisted_post['gwtoolset-url-to-the-media-file'] )
				? $this->_whitelisted_post['gwtoolset-url-to-the-media-file']
				: null
		);

		if ( !empty( $result['gwtoolset-partner-template-url'] ) ) {
			$result['partner-template-name'] = \GWToolset\getTitle(
				$result['gwtoolset-partner-template-url'],
				NS_TEMPLATE,
				array( 'must-be-known' => false )
			);
		}

		return $result;
	}

	/**
	 * save a metadata record as a new/updated wiki page
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {array} $options
	 *   {array} $options['metadata-as-array']
	 *   {array} $options['metadata-mapped-to-mediawiki-template']
	 *   {string} $options['metadata-raw']
	 *
	 * @return {null|Title|bool}
	 */
	public function processMatchingElement( array &$user_options, array $options ) {
		$result = null;

		$this->_MediawikiTemplate->metadata_raw = $options['metadata-raw'];
		$this->_MediawikiTemplate->populateFromArray(
			$options['metadata-mapped-to-mediawiki-template']
		);

		$this->_Metadata->metadata_raw = $options['metadata-raw'];
		$this->_Metadata->metadata_as_array = $options['metadata-as-array'];

		if ( $user_options['save-as-batch-job'] ) {
			$result = $this->_UploadHandler->saveMediafileViaJob(
				$user_options,
				$options,
				$this->_whitelisted_post
			);
		} else {
			$result = $this->_UploadHandler->saveMediafileAsContent( $user_options );
		}

		return $result;
	}

	/**
	 * a control method that steps through the methods necessary
	 * for processing the metadata and mapping in order to create
	 * mediafile wiki pages
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @throws {GWTException}
	 * @return {array|string}
	 * an array of mediafile Title(s)
	 */
	protected function processMetadata( array &$user_options ) {
		$result = array();

		$this->_Mapping = new Mapping( new MappingPhpAdapter() );
		$this->_Mapping->mapping_array =
			$this->_MediawikiTemplate->getMappingFromArray( $this->_whitelisted_post );
		$this->_Mapping->setTargetElements();
		$this->_Mapping->reverseMap();

		$this->_Metadata = new Metadata( new MetadataPhpAdapter() );

		global $wgGWTFileBackend, $wgGWTFBMetadataContainer;

		$this->_GWTFileBackend = new GWTFileBackend(
			array(
				'file-backend-name' => $wgGWTFileBackend,
				'container' => $wgGWTFBMetadataContainer,
				'User' => $this->User
			)
		);

		$this->_UploadHandler = new UploadHandler(
			array(
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'Metadata' => $this->_Metadata,
				'User' => $this->User,
			)
		);

		$this->_XmlMappingHandler = new XmlMappingHandler(
			array(
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'MappingHandler' => $this
			)
		);

		// retrieve the metadata file, the FileBackend will return an FSFile object
		$FSFile = $this->_GWTFileBackend->retrieveFile(
			$user_options['gwtoolset-metadata-file-mwstore']
		);

		if ( !( $FSFile instanceof FSFile ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-fsfile-retrieval-failure' )
							->params( $user_options['gwtoolset-metadata-file-mwstore'] )
							->parse()
					)
					->parse()
			);
		}

		if ( $user_options['gwtoolset-metadata-file-sha1'] !== $FSFile->getSha1Base36() ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-sha1-does-not-match' )->parse()
					)
					->parse()
			);
		}

		$result = $this->_XmlMappingHandler->processXml(
			$user_options,
			$FSFile->getPath()
		);

		// when PHP_SAPI === 'cli' this method is being run by a wiki job.
		if ( PHP_SAPI === 'cli' ) {
			// add jobs created earlier by $this->_UploadHandler::saveMediafileViaJob to the JobQueue
			if ( count( $this->_UploadHandler->mediafile_jobs ) > 0 ) {
				$added_jobs = JobQueueGroup::singleton()->push( $this->_UploadHandler->mediafile_jobs );

				if ( $added_jobs ) {
					$result =
						wfMessage( 'gwtoolset-mediafile-jobs-created' )
							->params( count( $this->_UploadHandler->mediafile_jobs ) )
							->escaped();
				}
			}

			// at this point
			// * the UploadMetadataJob has created ( Config::$mediafile_job_throttle ) number of
			//   UploadMediafileJobs
			// * $user_options['gwtoolset-record-begin'] is the value that the UploadMetadataJob
			//   began with
			// * $user_options['gwtoolset-record-current'] is the next record that needs to be
			//   processed
			//
			// example to illustrate the test
			// * Config::$preview_throttle                 = 3
			// * Config::$mediafile_job_throttle           = 10
			// * $user_options['gwtoolset-record-count']   = 14
			// * $user_options['gwtoolset-record-begin']   = 4   ( because the preview took care of 3 )
			// * $user_options['gwtoolset-record-current'] = 14  ( 13 mediafiles will have been
			//                                                     processed this is the current
			//                                                     record we need to process )
			//
			// the test 14 >= ( 4 + 10 ) is true so
			// * $user_options['gwtoolset-record-begin'] = $user_options['gwtoolset-record-current']
			// * create another UploadMetadataJob that will take care of the last record
			if (
				(int)$user_options['gwtoolset-record-count']
				>= ( (int)$user_options['gwtoolset-record-begin'] + (int)Config::$mediafile_job_throttle )
			) {
				$this->_whitelisted_post['gwtoolset-record-begin'] =
					(int)$user_options['gwtoolset-record-current'];
				$this->createMetadataBatchJob( $user_options );

			} else {
				// no more UploadMediafileJobs need to be created
				// create a GWTFileBackendCleanupJob that will delete the metadata file in the mwstore
				$Status = $this->_GWTFileBackend->createCleanupJob(
					$user_options['gwtoolset-metadata-file-mwstore']
				);

				if ( !$Status->ok ) {
					throw new MWException(
						wfMessage( 'gwtoolset-developer-issue' )
							->params( __METHOD__ . ': ' . $Status->getMessage() )
							->parse()
					);
				}
			}
		}

		return $result;
	}

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * @return {string|array}
	 * - an html form, which is filtered in the getForm method
	 * - an html response, which has been escaped and parsed by wfMessage
	 * - an array of mediafile Title(s)
	 */
	public function processRequest() {
		$result = null;
		$mediafile_titles = array();

		$this->_MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$this->_MediawikiTemplate->getMediaWikiTemplate( $_POST['gwtoolset-mediawiki-template-name'] );

		foreach ( $this->_MediawikiTemplate->mediawiki_template_array as $key => $value ) {
			// MediaWiki template parameters sometimes contain spaces
			$key = \GWToolset\normalizeSpace( $key );
			$this->_expected_post_fields[Utils::sanitizeString( $key )] = array( 'size' => 255 );
		}

		$this->_whitelisted_post = \GWToolset\getWhitelistedPost( $this->_expected_post_fields );
		$user_options = $this->getUserOptions();
		$this->getGlobalCategories( $user_options );

		$this->checkForRequiredFormFields(
			$user_options,
			array(
				'gwtoolset-mediawiki-template-name',
				'gwtoolset-record-count',
				'gwtoolset-record-element-name',
				'gwtoolset-title-identifier',
				'gwtoolset-url-to-the-media-file',
				'gwtoolset-metadata-file-mwstore'
			)
		);

		if ( $user_options['preview'] === true ) {
			Config::$mediafile_job_throttle = (int)Config::$preview_throttle;
			$mediafile_titles = $this->processMetadata( $user_options );

			$result = PreviewForm::getForm(
				$this->SpecialPage->getContext(),
				$user_options,
				$mediafile_titles
			);
		} else {
			$user_options['save-as-batch-job'] = true;

			// when PHP_SAPI !== 'cli', this method is being run by a user as a SpecialPage,
			// thus this is the creation of the initial uploadMetadataJob. subsequent
			// uploadMetadataJobs are created in $this->processMetadata() when necessary.
			if ( PHP_SAPI !== 'cli' ) {
				$result =
					Html::rawElement(
						'h2',
						array(),
						wfMessage( 'gwtoolset-step-4-heading' )->escaped()
					) .
					$this->createMetadataBatchJob( $user_options );

			// when PHP_SAPI === 'cli', this method is being run by a wiki job;
			// typically uploadMediafileJob.
			} else {
				$result = $this->processMetadata( $user_options );
			}
		}

		return $result;
	}
}
