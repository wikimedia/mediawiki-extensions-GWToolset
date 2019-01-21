<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Handlers\Forms;

use FSFile;
use GWToolset\Adapters\Php\MappingPhpAdapter;
use GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter;
use GWToolset\Adapters\Php\MetadataPhpAdapter;
use GWToolset\Config;
use GWToolset\Constants;
use GWToolset\Utils;
use GWToolset\Forms\PreviewForm;
use GWToolset\GWTException;
use GWToolset\Handlers\UploadHandler;
use GWToolset\Handlers\Xml\XmlMappingHandler;
use GWToolset\Helpers\GWTFileBackend;
use GWToolset\Jobs\UploadMetadataJob;
use GWToolset\Models\Mapping;
use GWToolset\Models\MediawikiTemplate;
use GWToolset\Models\Metadata;
use Html;
use JobQueueGroup;
use MediaWiki\MediaWikiServices;
use MWException;
use Title;

class MetadataMappingHandler extends FormHandler {

	protected $_GWTFileBackend;

	/**
	 * @var array
	 */
	protected $_expected_post_fields = [
		'gwtoolset-category' => [ 'size' => 255 ],
		'gwtoolset-category-phrase' => [ 'size' => 255 ],
		'gwtoolset-category-metadata' => [ 'size' => 255 ],
		'gwtoolset-form' => [ 'size' => 255 ],
		'gwtoolset-preview' => [ 'size' => 255 ],
		'gwtoolset-mediafile-throttle' => [ 'size' => 2 ],
		'gwtoolset-mediawiki-template-name' => [ 'size' => 255 ],
		'gwtoolset-metadata-file-relative-path' => [ 'size' => 255 ],
		'gwtoolset-metadata-file-sha1' => [ 'size' => 255 ],
		'gwtoolset-metadata-file-url' => [ 'size' => 255 ],
		'gwtoolset-metadata-mapping-name' => [ 'size' => 255 ],
		'gwtoolset-metadata-mapping-subpage' => [ 'size' => 255 ],
		'gwtoolset-metadata-mapping-url' => [ 'size' => 255 ],
		'gwtoolset-metadata-namespace' => [ 'size' => 255 ],
		'gwtoolset-partner-template-url' => [ 'size' => 255 ],
		'gwtoolset-record-begin' => [ 'size' => 255 ],
		'gwtoolset-record-count' => [ 'size' => 255 ],
		'gwtoolset-record-element-name' => [ 'size' => 255 ],
		'gwtoolset-reupload-media' => [ 'size' => 4 ],
		'gwtoolset-reverse-creator' => [ 'size' => 4 ],
		'gwtoolset-wrap-creator' => [ 'size' => 4 ],
		'gwtoolset-wrap-institution' => [ 'size' => 4 ],
		'gwtoolset-wrap-language' => [ 'size' => 4 ],
		'gwtoolset-detect-license' => [ 'size' => 4 ],
		'gwtoolset-global-license' => [ 'size' => 255 ],
		'wpEditToken' => [ 'size' => 255 ],
		'wpSummary' => [ 'size' => 255 ]
	];

	/**
	 * @var \GWToolset\Models\Mapping
	 */
	protected $_Mapping;

	/**
	 * @var \GWToolset\Models\MediawikiTemplate
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var \GWToolset\Models\Metadata
	 */
	protected $_Metadata;

	/**
	 * @var \GWToolset\Handlers\UploadHandler
	 */
	protected $_UploadHandler;

	/**
	 * @var array
	 */
	protected $_whitelisted_post;

	/**
	 * @var \GWToolset\Handlers\Xml\XmlMappingHandler
	 */
	protected $_XmlMappingHandler;

	/**
	 * @throws MWException
	 *
	 * @return string
	 * the html string has been escaped and parsed by wfMessage
	 */
	protected function createMetadataBatchJob() {
		$job = new UploadMetadataJob(
			Title::newFromText(
				$this->User->getName() . '/' .
				Constants::EXTENSION_NAME . '/' .
				'Metadata Batch Job/' .
				uniqid(),
				NS_USER
			),
			[
				'attempts' => 1,
				'user-name' => $this->User->getName(),
				'whitelisted-post' => $this->_whitelisted_post
			]
		);

		if ( $this->_whitelisted_post['gwtoolset-record-begin'] >
			( Config::$preview_throttle + 1 )
		) {
			$delayed_enabled =
				JobQueueGroup::singleton()
				->get( 'gwtoolsetUploadMetadataJob' )
				->delayedJobsEnabled();

			if ( $delayed_enabled ) {
				$job->params['jobReleaseTimestamp'] = strtotime(
					'+' . Utils::sanitizeString( Config::$metadata_job_delay )
				);
			}
		}

		JobQueueGroup::singleton()->push( $job );

		$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
		$newFilesLink = $linkRenderer->makeLink(
			Title::newFromText( 'Special:NewFiles' ),
			null,
			[ 'target' => '_blank' ]
		);

		$result = wfMessage( 'gwtoolset-batchjob-metadata-created' )
			->rawParams( $newFilesLink )
			->parse();

		return $result;
	}

	/**
	 * sets the $userOptions['categories'] index as appropriate.
	 * this value is used by UploadHandler to add global categories
	 * to a medifile wiki page; global meaning that these categories
	 * are added to all mediafiles that are being uploaded
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 */
	protected function getGlobalCategories( array &$userOptions ) {
		$userOptions['categories'] = '';

		if ( isset( $this->_whitelisted_post['gwtoolset-category'] ) ) {
			foreach ( $this->_whitelisted_post['gwtoolset-category'] as $category ) {
				if ( !empty( $category ) ) {
					if ( empty( $userOptions['categories'] ) ) {
						$userOptions['categories'] .= $category;
					} else {
						$userOptions['categories'] .= Config::$category_separator . $category;
					}
				}
			}
		}
	}

	/**
	 * gets various user options from $this->_whitelisted_post and sets default values
	 * if no user value is supplied
	 *
	 * @return array
	 * the values within the array have not been filtered
	 */
	protected function getUserOptions() {
		$result = [
			'categories' => null,

			'gwtoolset-category-phrase' =>
				!empty( $this->_whitelisted_post['gwtoolset-category-phrase'] )
				? $this->_whitelisted_post['gwtoolset-category-phrase']
				: [],

			'gwtoolset-category-metadata' =>
				!empty( $this->_whitelisted_post['gwtoolset-category-metadata'] )
				? $this->_whitelisted_post['gwtoolset-category-metadata']
				: [],

			'gwtoolset-detect-license' =>
				!empty( $this->_whitelisted_post['gwtoolset-detect-license'] )
				? (bool)$this->_whitelisted_post['gwtoolset-detect-license']
				: false,

			'comment' =>
				!empty( $this->_whitelisted_post['wpSummary'] )
				? $this->_whitelisted_post['wpSummary']
				: '',

			'gwtoolset-global-license' =>
				!empty( $this->_whitelisted_post['gwtoolset-global-license'] )
				? $this->_whitelisted_post['gwtoolset-global-license']
				: null,

			'gwtoolset-mediafile-throttle' =>
				!empty( $this->_whitelisted_post['gwtoolset-mediafile-throttle'] )
				? Utils::sanitizeNumericRange(
						$this->_whitelisted_post['gwtoolset-mediafile-throttle'],
						[
							'min' => Config::$mediafile_job_throttle_min,
							'max' => Config::$mediafile_job_throttle_max,
							'default' => Config::$mediafile_job_throttle_default
						]
					)
				: Config::$mediafile_job_throttle_default,

			'gwtoolset-mediawiki-template-name' =>
				!empty( $this->_whitelisted_post['gwtoolset-mediawiki-template-name'] )
				? $this->_whitelisted_post['gwtoolset-mediawiki-template-name']
				: null,

			'gwtoolset-metadata-file-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-url'] )
				? $this->_whitelisted_post['gwtoolset-metadata-file-url']
				: null,

			'gwtoolset-metadata-file-relative-path' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-relative-path'] )
				? $this->_whitelisted_post['gwtoolset-metadata-file-relative-path']
				: null,

			'gwtoolset-metadata-file-sha1' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-sha1'] )
				? $this->_whitelisted_post['gwtoolset-metadata-file-sha1']
				: null,

			'gwtoolset-partner-template-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-partner-template-url'] )
				? $this->_whitelisted_post['gwtoolset-partner-template-url']
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

			'gwtoolset-title' =>
				!empty( $this->_whitelisted_post['gwtoolset-title'] )
				? $this->_whitelisted_post['gwtoolset-title']
				: null,

			'gwtoolset-reupload-media' =>
				!empty( $this->_whitelisted_post['gwtoolset-reupload-media'] )
				? (bool)$this->_whitelisted_post['gwtoolset-reupload-media']
				: false,

			'gwtoolset-reverse-creator' =>
				!empty( $this->_whitelisted_post['gwtoolset-reverse-creator'] )
				? (bool)$this->_whitelisted_post['gwtoolset-reverse-creator']
				: false,

			'gwtoolset-wrap-creator' =>
				!empty( $this->_whitelisted_post['gwtoolset-wrap-creator'] )
				? (bool)$this->_whitelisted_post['gwtoolset-wrap-creator']
				: false,

			'gwtoolset-wrap-institution' =>
				!empty( $this->_whitelisted_post['gwtoolset-wrap-institution'] )
				? (bool)$this->_whitelisted_post['gwtoolset-wrap-institution']
				: false,

			'gwtoolset-wrap-language' =>
				!empty( $this->_whitelisted_post['gwtoolset-wrap-language'] )
				? (bool)$this->_whitelisted_post['gwtoolset-wrap-language']
				: false,

			'gwtoolset-url-to-the-media-file' =>
				!empty( $this->_whitelisted_post['gwtoolset-url-to-the-media-file'] )
				? $this->_whitelisted_post['gwtoolset-url-to-the-media-file']
				: null
		];

		return $result;
	}

	/**
	 * save a metadata record as a new/updated wiki page
	 *
	 * @param array $userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @param array $options
	 *   {array} $options['metadata-as-array']
	 *   {array} $options['metadata-mapped-to-mediawiki-template']
	 *   {string} $options['metadata-raw']
	 *
	 * @return bool|array|null|Title
	 */
	public function processMatchingElement( array $userOptions, array $options ) {
		$result = null;

		$this->_MediawikiTemplate->metadata_raw = $options['metadata-raw'];
		$this->_MediawikiTemplate->populateFromArray(
			$options['metadata-mapped-to-mediawiki-template']
		);

		$this->_Metadata->metadata_raw = $options['metadata-raw'];
		$this->_Metadata->metadata_as_array = $options['metadata-as-array'];

		if ( $userOptions['save-as-batch-job'] ) {
			$result = $this->_UploadHandler->saveMediafileViaJob(
				$userOptions,
				$options,
				$this->_whitelisted_post
			);
		} elseif ( $userOptions['preview'] ) {
			$result = $this->_UploadHandler->getPreview( $userOptions );
		} else {
			$result = $this->_UploadHandler->saveMediafileAsContent( $userOptions );
		}

		return $result;
	}

	/**
	 * a control method that steps through the methods necessary
	 * for processing the metadata and mapping in order to create
	 * mediafile wiki pages
	 *
	 * @param array &$userOptions
	 * an array of user options that was submitted in the html form
	 * @param bool $fromJob Is this coming from a job or direct from user
	 *
	 * @throws GWTException
	 * @return array|string
	 * an array of mediafile Title(s)
	 */
	protected function processMetadata( array &$userOptions, $fromJob = false ) {
		$this->_Mapping = new Mapping( new MappingPhpAdapter() );
		$this->_Mapping->mapping_array =
			$this->_MediawikiTemplate->getMappingFromArray( $this->_whitelisted_post );
		$this->_Mapping->setTargetElements();
		$this->_Mapping->reverseMap();

		$this->_Metadata = new Metadata( new MetadataPhpAdapter() );

		global $wgGWTFileBackend;

		$this->_GWTFileBackend = new GWTFileBackend(
			[
				'container' => Config::$filebackend_metadata_container,
				'file-backend-name' => $wgGWTFileBackend,
				'User' => $this->User
			]
		);

		$this->_UploadHandler = new UploadHandler(
			[
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'Metadata' => $this->_Metadata,
				'User' => $this->User,
			]
		);

		$this->_XmlMappingHandler = new XmlMappingHandler(
			[
				'GWTFileBackend' => $this->_GWTFileBackend,
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'MappingHandler' => $this
			]
		);

		// retrieve the metadata file, the FileBackend will return an FSFile object
		$file = $this->_GWTFileBackend->retrieveFileFromRelativePath(
			$userOptions['gwtoolset-metadata-file-relative-path']
		);

		if ( !( $file instanceof FSFile ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-fsfile-retrieval-failure' )
							->params( $userOptions['gwtoolset-metadata-file-relative-path'] )
							->parse()
					)
					->parse()
			);
		}

		if ( $userOptions['gwtoolset-metadata-file-sha1'] !== $file->getSha1Base36() ) {
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
			$userOptions,
			$file->getPath()
		);

		// this method is being run by a wiki job.
		if ( $fromJob || empty( $this->SpecialPage ) ) {
			// add jobs created earlier by $this->_UploadHandler::saveMediafileViaJob to the JobQueue
			if ( count( $this->_UploadHandler->mediafile_jobs ) > 0 ) {
				JobQueueGroup::singleton()->push( $this->_UploadHandler->mediafile_jobs );

				$result =
					wfMessage( 'gwtoolset-mediafile-jobs-created' )
						->numParams( count( $this->_UploadHandler->mediafile_jobs ) )
						->escaped();
			}

			/**
			 * at this point
			 * * the UploadMetadataJob has created ( $userOptions['gwtoolset-mediafile-throttle'] )
			 *   number of UploadMediafileJobs
			 * * $userOptions['gwtoolset-record-begin'] is the value that the UploadMetadataJob
			 *   began with
			 * * $userOptions['gwtoolset-record-current'] is the next record that needs to be
			 *   processed
			 *
			 * example to illustrate the test
			 * * Config::$preview_throttle                 = 3
			 * * $userOptions['gwtoolset-mediafile-throttle']   = 10
			 * * $userOptions['gwtoolset-record-count']   = 14
			 * * $userOptions['gwtoolset-record-begin']   = 4   ( because the preview took care of 3 )
			 * * $userOptions['gwtoolset-record-current'] = 14  ( 13 mediafiles will have been
			 *                                                     processed this is the current
			 *                                                     record we need to process )
			 *
			 * the test 14 >= ( 4 + 10 ) is true so
			 * * $userOptions['gwtoolset-record-begin'] = $userOptions['gwtoolset-record-current']
			 * * create another UploadMetadataJob that will take care of the last record
			 */
			if (
				(int)$userOptions['gwtoolset-record-count']
				>= ( (int)$userOptions['gwtoolset-record-begin'] +
						(int)$userOptions['gwtoolset-mediafile-throttle'] )
			) {
				$this->_whitelisted_post['gwtoolset-record-begin'] =
					(int)$userOptions['gwtoolset-record-current'];
				$this->createMetadataBatchJob();

			} else {
				// no more UploadMediafileJobs need to be created
				// create a GWTFileBackendCleanupJob that will delete the metadata file in the mwstore
				$status = $this->_GWTFileBackend->createCleanupJob(
					$userOptions['gwtoolset-metadata-file-relative-path']
				);

				if ( !$status->isOK() ) {
					throw new MWException(
						wfMessage( 'gwtoolset-developer-issue' )
							->params( __METHOD__ . ': ' . $status->getMessage() )
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
	 * @param array $original_post
	 * @param bool $fromJob
	 *
	 * @return string|array
	 * - an html form, which is filtered in the getForm method
	 * - an html response, which has been escaped and parsed by wfMessage
	 * - an array of mediafile Title(s)
	 */
	public function processRequest( array $original_post = [], $fromJob = false ) {
		$result = null;

		if ( empty( $original_post ) ) {
			$original_post = $_POST;
		}

		$this->_MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$this->_MediawikiTemplate->getMediaWikiTemplate(
			$original_post['gwtoolset-mediawiki-template-name']
		);

		foreach ( $this->_MediawikiTemplate->mediawiki_template_array as $key => $value ) {
			// MediaWiki template parameters sometimes contain spaces
			$key = Utils::normalizeSpace( $key );
			$this->_expected_post_fields[Utils::sanitizeString( $key )] = [ 'size' => 255 ];
		}

		$this->_whitelisted_post = Utils::getWhitelistedPost(
			$original_post,
			$this->_expected_post_fields
		);
		$userOptions = $this->getUserOptions();
		$this->getGlobalCategories( $userOptions );

		$this->checkForRequiredFormFields(
			$userOptions,
			[
				'gwtoolset-mediawiki-template-name',
				'gwtoolset-record-count',
				'gwtoolset-record-element-name',
				'gwtoolset-title',
				'gwtoolset-url-to-the-media-file',
				'gwtoolset-metadata-file-relative-path'
			]
		);

		if ( $userOptions['preview'] === true ) {
			$userOptions['gwtoolset-mediafile-throttle'] = (int)Config::$preview_throttle;
			$metadata_items = $this->processMetadata( $userOptions, $fromJob );

			$result = PreviewForm::getForm(
				$this->SpecialPage->getContext(),
				$this->_expected_post_fields,
				$metadata_items
			);
		} else {
			$userOptions['save-as-batch-job'] = true;

			// when !$fromJob, this method is being run by a user as a SpecialPage,
			// thus this is the creation of the initial uploadMetadataJob. subsequent
			// uploadMetadataJobs are created in $this->processMetadata() when necessary.
			// Note: Just because its a job doesn't neccesarily imply its from the commandline.
			if ( !$fromJob ) {
				$result =
					Html::rawElement(
						'h2',
						[],
						wfMessage( 'gwtoolset-step-4-heading' )->escaped()
					) .
					$this->createMetadataBatchJob();

			// $fromJob, this method is being run by a wiki job;
			// typically uploadMediafileJob.
			} else {
				$result = $this->processMetadata( $userOptions, $fromJob );
			}
		}

		return $result;
	}
}
