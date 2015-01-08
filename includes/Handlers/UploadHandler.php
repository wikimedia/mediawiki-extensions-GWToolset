<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Handlers;
use ApiMain,
	ContentHandler,
	DerivativeRequest,
	GWToolset\Config,
	GWToolset\Constants,
	GWToolset\GWTException,
	GWToolset\Utils,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiChecks,
	GWToolset\Jobs\UploadMediafileJob,
	Http,
	MimeMagic,
	MWException,
	MWHttpRequest,
	Status,
	Title,
	UploadBase,
	UploadFromUrl,
	WikiPage;

class UploadHandler {

	/**
	 * @var {Php\File}
	 */
	protected $_File;

	/**
	 * @var {GWToolset\Helpers\GWTFileBackend}
	 */
	protected $_GWTFileBackend;

	/**
	 * @var {array}
	 */
	protected $_global_categories;

	/**
	 * @var {array}
	 */
	protected $_item_specific_categories;

	/**
	 * @var {GWToolset\Modles\Mapping}
	 */
	protected $_Mapping;

	/**
	 * @var {GWToolset\Models\MediawikiTemplate}
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var {Metadata}
	 */
	protected $_Metadata;

	/**
	 * @var {SpecialPage}
	 */
	protected $_SpecialPage;

	/**
	 * @var {UploadBase}
	 */
	protected $_UploadBase;

	/**
	 * @var {User}
	 */
	protected $_User;

	/**
	 * @var {array}
	 */
	public $mediafile_jobs;

	/**
	 * @var {null|bool}
	 */
	protected $otherContributors;

	/**
	 * @var {array}
	 */
	public $user_options;

	/**
	 * @param {array} $options
	 */
	public function __construct( array $options = array() ) {
		$this->reset();

		if ( isset( $options['File'] ) ) {
			$this->_File = $options['File'];
		}

		if ( isset( $options['GWTFileBackend'] ) ) {
			$this->_GWTFileBackend = $options['GWTFileBackend'];
		}

		if ( isset( $options['Mapping'] ) ) {
			$this->_Mapping = $options['Mapping'];
		}

		if ( isset( $options['MediawikiTemplate'] ) ) {
			$this->_MediawikiTemplate = $options['MediawikiTemplate'];
		}

		if ( isset( $options['Metadata'] ) ) {
			$this->_Metadata = $options['Metadata'];
		}

		if ( isset( $options['SpecialPage'] ) ) {
			$this->_SpecialPage = $options['SpecialPage'];
		}

		if ( isset( $options['UploadBase'] ) ) {
			$this->_UploadBase = $options['UploadBase'];
		}

		if ( isset( $options['User'] ) ) {
			$this->_User = $options['User'];
		}
	}

	/**
	 * creates wiki text that makes up the original metadata used
	 * and the original mapping used to create the wiki page
	 *
	 * @return {string}
	 * the string is not filtered
	 */
	protected function addMetadata() {
		return
			'<!-- <metadata_mapped_json>' .
			json_encode( $this->_MediawikiTemplate->mediawiki_template_array ) .
			'</metadata_mapped_json> -->' .
			PHP_EOL . PHP_EOL .
			'<!-- <metadata_raw>' . PHP_EOL .
			htmlspecialchars( $this->_MediawikiTemplate->metadata_raw, ENT_QUOTES, 'UTF-8' ) . PHP_EOL .
			'</metadata_raw> -->' .
			PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
	}

	/**
	 * creates wiki text category entries.
	 * these categories represent global categories
	 * that are applied to all of the media files being uploaded.
	 *
	 * @return {string}
	 * sanitized
	 */
	protected function addGlobalCategories() {
		$result = '';

		$this->setGlobalCategories();
		$categories = $this->_global_categories;

		if ( empty( $categories ) ) {
			return $result;
		}

		foreach ( $categories as $category ) {
			$result .=
				'[[' .
					Utils::getNamespaceName( NS_CATEGORY ) .
					$category .
				']]' . PHP_EOL;
		}

		return $result;
	}

	/**
	 * creates wikitext category entries.
	 *
	 * these categories represent specific categories for a single media file
	 * rather than global categories that are applied to all media files being
	 * uploaded.
	 *
	 * no category is added to the $result if only a category-phrase is given.
	 * either a category-phrase and a category-metadata value must be provided
	 * or only a category-metadata value.
	 *
	 * @return {string}
	 * sanitized
	 */
	protected function addItemSpecificCategories() {
		$result = '';

		$this->setItemSpecificCategories();
		$categories = $this->_item_specific_categories;

		if ( empty( $categories ) ) {
			return $result;
		}

		foreach( $categories as $category ) {
			$result .= '[[' .
				Utils::getNamespaceName( NS_CATEGORY ) .
				$category .
			']]' . PHP_EOL;
		}

		return $result;
	}

	/**
	 * allows the original uploader to upload a new version
	 * of the mediafile when:
	 *
	 * - no other contributors have contributed or made alterations
	 * - the mediafile being uploaded is not the same as the title’s most
	 *   recently associated mediafile
	 * - the mediafile being uploaded is not associated with another title
	 *
	 * @todo how to handle $warnings['exists']['warning'] === 'was-deleted'.
	 * because it was deleted there are no contributors in the array coming
	 * back from the api call
	 *
	 * @param {UploadBase} $upload
	 * @param {Title} $title
	 * @return {Status}
	 */
	protected function checkUploadWarnings( UploadBase $upload, Title $title ) {
		$status = Status::newGood();
		$warnings = $upload->checkWarnings();

		if (
			isset( $warnings['exists'] )
			&& isset( $warnings['exists']['warning'] )
		) {
			if ( $warnings['exists']['warning'] === 'exists' ) {
				// check if another contributor has altered this title
				if ( $this->otherContributors( $title ) ) {
					$msg =
						wfMessage( 'gwtoolset-mediafile-other-contributors' )
							->params( $warnings['exists']['file']->getTitle() )
							->text();

					$status = Status::newFatal( $msg );

				// this title’s most recent mediafile is the same as the one being uploaded
				} else if (
					$upload->getTempFileSha1Base36() ===
					$warnings['exists']['file']->getSha1()
				) {
					$msg =
						wfMessage( 'gwtoolset-mediafile-duplicate-same-title' )
							->params( $warnings['exists']['file']->getTitle() )
							->text();

					$status = Status::newFatal( $msg );
				}
			}
		}

		// another title has this mediafile
		if (
			$status->isOK()
			&& isset( $warnings['duplicate'] )
			&& count( $warnings['duplicate'] ) > 0
		) {
			$msg =
				wfMessage( 'gwtoolset-mediafile-duplicate-another-title' )
					->params( $warnings['duplicate'][0]->getTitle() )
					->text();

			$status = Status::newFatal( $msg );
		}

		return $status;
	}

	/**
	 * follows a url testing the headers to determine the final url, content-type
	 * and file extension
	 *
	 * text/html example - has a js redirect in it
	 *   $url = 'http://aleph500.biblacad.ro:8991/F?func=service&doc_library=RAL01
	 *           &doc_number=000245208&line_number=0001&func_code=DB_RECORDS&service_type=MEDIA';
	 *
	 * url is to a script that returns the media file
	 *   $url = https://www.rijksmuseum.nl/mediabin.jsp?id=RP-P-1956-764
	 *   $url = 'http://europeanastatic.eu/api/image?uri=http%3A%2F%2Fcollections.smvk.se
	             %3A8080%2Fcarlotta-em%2Fguest%2F1422401%2F13%2Fbild.jpg&size=LARGE&type=IMAGE';
	 *
	 * url is redirected to another url that actually serves the media file
	 *   $url = 'http://www.rijksmuseum.nl/media/assets/AK-RAK-1978-3';
	 *   $url = 'http://www.rijksmuseum.nl/media/assets/RP-P-1956-764';
	 *
	 * forced downloads with Content-Disposition
	 *   Content-Disposition: attachment;
	 *   times out after 25000 milliseconds - how can we set api upload curl to > timeout
	 *   $url = 'http://academia.lndb.lv/xmlui/bitstream/handle/1/231/k_001_ktl1-1-27.jpg';
	 *
	 * Content-Disposition: inline;
	 *   $url = 'http://images.memorix.nl/gam/thumb/150x150/115165d2-1267-7db5-4abb-54d273c47a81.jpg';
	 *
	 * @param {string} $url
	 *
	 * @throws {GWTException}
	 *
	 * @return {array}
	 *   the values in the array are not filtered
	 *   $result['content-type']
	 *   $result['extension']
	 *   $result['url']
	 */
	protected function evaluateMediafileUrl( $url ) {
		global $wgCopyUploadProxy;
		$result = array( 'content-type' => null, 'extension' => null, 'url' => null );

		if ( empty( $url ) ) {
			throw new GWTException( 'gwtoolset-no-url-to-evaluate' );
		}

		$options = array(
			'method' => 'HEAD',
			'followRedirects' => true,
			'userAgent' => Http::userAgent() . ' ' .
				Constants::EXTENSION_NAME . '/' .
				Constants::EXTENSION_VERSION
		);

		if ( $wgCopyUploadProxy !== false ) {
			$options['proxy'] = $wgCopyUploadProxy;
		}

		$Http = MWHttpRequest::factory( $url, $options );
		$Status = $Http->execute();

		if ( !$Status->ok ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-url-bad' => array( $url, $Status->getMessage() )
				)
			);
		}

		$result['url'] = $Http->getFinalUrl();

		if ( empty( $result['url'] ) ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-url-bad' =>
					array( $url, '' )
				)
			);
		}

		$result['content-type'] = $Http->getResponseHeader( 'content-type' );

		if ( empty( $result['content-type'] ) ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-no-content-type' =>
					array ( $url )
				)
			);
		}

		$result['extension'] = $this->getFileExtension( $result );

		if ( empty( $result['extension'] ) ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-url-extension-bad' =>
					array( $url )
				)
			);
		}

		return $result;
	}

	/**
	 * @return {array}
	 */
	protected function getCategoriesForPreview() {
		$result = array();

		$categories = array_merge(
			$this->_global_categories,
			$this->_item_specific_categories
		);

		// $Output->setCategoryLinks requires an array with the category name
		// as the key and a sortkey as the value;  not sure what the are valid
		// sortkey values, but 0 seems to work well
		foreach( $categories as $category ) {
			$result[$category] = 0;
		}

		return $result;
	}

	/**
	 * attempts to get the file extension of a media file url using the
	 * $options provided. it will first look for a valid file extension in the
	 * url; if none is found it will fallback to an appropriate file extention
	 * based on the content-type
	 *
	 * @param {array} $options
	 *   ['url'] final url to the media file
	 *   ['content-type'] content-type of that final url
	 *
	 * @throws {GWTException}
	 * @return {null|string}
	 */
	protected function getFileExtension( array $options ) {
		global $wgFileExtensions;
		$result = null;

		if ( empty( $options['url'] ) ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-url-bad' =>
					array( $options['url'], '' )
				)
			);
		}

		if ( empty( $options['content-type'] ) ) {
			throw new GWTException(
				array(
					'gwtoolset-mapping-media-file-no-content-type' =>
					array ( $options['url'] )
				)
			);
		}

		$pathinfo = pathinfo( $options['url'] );
		$MimeMagic = MimeMagic::singleton();

		if ( !empty( $pathinfo['extension'] )
			&& in_array( $pathinfo['extension'], $wgFileExtensions )
			&& strpos( $MimeMagic->getTypesForExtension( $pathinfo['extension'] ),
					$options['content-type']
				) !== false
		) {
			$result = $pathinfo['extension'];
		} elseif ( !empty( $options['content-type'] ) ) {
			$result = explode( ' ', $MimeMagic->getExtensionsForType( $options['content-type'] ) );

			if ( !empty( $result ) ) {
				$result = $result[0];
			}
		}

		return $result;
	}

	/**
	 * @return {array}
	 */
	protected function getUploadParams() {
		$result = array();

		$result['gwtoolset-url-to-the-media-file'] =
			$this->_MediawikiTemplate->mediawiki_template_array[
				'gwtoolset-url-to-the-media-file'
			];

		$evaluated_url = $this->evaluateMediafileUrl(
			$result['gwtoolset-url-to-the-media-file']
		);

		$this->verifyUploadDomain( $evaluated_url['url'] );
		$result['gwtoolset-url-to-the-media-file'] = $evaluated_url['url'];
		$result['evaluated-media-file-extension'] = $evaluated_url['extension'];

		$result['title'] = $this->_MediawikiTemplate->getTitle( $result );
		$result['ignorewarnings'] = true;
		$result['watch'] = true;

		$result['comment'] =
			wfMessage( 'gwtoolset-create-mediafile' )
				->params(
					wfMessage( 'gwtoolset-create-prefix' )->text(),
					$this->_User->getName()
				)
				->text() .
			PHP_EOL .
			trim( $this->user_options['comment'] );

		$result['text'] = $this->getWikiText();

		return $result;
	}

	/**
	 * creates the wiki text for the media file page.
	 * concatenates several pieces of information in order to create the wiki
	 * text for the mediafile wiki text
	 *
	 * @return {string}
	 * except for the metadata, the resulting wiki text is filtered
	 */
	protected function getWikiText() {
		return
			'=={{int:filedesc}}==' . PHP_EOL . PHP_EOL .
			$this->_MediawikiTemplate->getTemplateAsWikiText( $this->user_options ) .
			$this->_MediawikiTemplate->getGWToolsetTemplateAsWikiText() .
			$this->addMetadata() .
			$this->addGlobalCategories() .
			$this->addItemSpecificCategories();
	}

	/**
	 * @param {string} $title
	 * @throws {GWTException}
	 * @return {Title}
	 */
	protected function getTitle( $title ) {
		$result = Utils::getTitle(
			Utils::stripIllegalTitleChars( $title ),
			Config::$mediafile_namespace,
			array( 'must-be-known' => false )
		);

		if ( !( $result instanceof Title ) ) {
			throw new GWTException(
				array( 'gwtoolset-title-bad' => array( $title ) )
			);
		}

		return $result;
	}

	/**
	 * find out if anyone, besides the current user,
	 * has contributed to a given Title
	 *
	 * @param {Title} $Title
	 * @return {bool}
	 */
	protected function otherContributors( Title $Title ) {
		global $wgRequest;

		if ( is_bool( $this->otherContributors ) ) {
			return $this->otherContributors;
		}

		$Api = new ApiMain(
			new DerivativeRequest(
				$wgRequest,
				array(
					'action' => 'query',
					'prop' => 'contributors',
					'titles' => $Title->getPrefixedText()
				),
				false // not posted
			),
			false // disable write
		);

		$Api->execute();

		if ( defined( 'ApiResult::META_CONTENT' ) ) {
			$api_result = \ApiResult::removeMetadata( $Api->getResult()->getResultData() );
		} else {
			$api_result = $Api->getResultData();
		}

		$api_result = Utils::objectToArray( $api_result );

		if (
			isset( $api_result['query']['pages'] )
			&& count( $api_result['query']['pages'] ) === 1
		) {
			if (
				key( $api_result['query']['pages'] ) === -1
				&& isset( $api_result['query']['pages'][-1]['missing'] )
			) {
				$this->otherContributors = false;
				return $this->otherContributors;
			}

			$api_result = array_shift( $api_result['query']['pages'] );

			if (
				!isset( $api_result['anoncontributors'] )
				&& isset( $api_result['contributors'] )
				&& count( $api_result['contributors'] ) == 1
			) {
				if (
					$api_result['contributors'][0]['name']
					=== $this->_User->getName()
				) {
					$this->otherContributors = false;
					return $this->otherContributors;
				}
			}
		}

		$this->otherContributors = true;
		return $this->otherContributors;
	}

	public function reset() {
		$this->_File = null;
		$this->_Mapping = null;
		$this->_MediawikiTemplate = null;
		$this->_SpecialPage = null;
		$this->_UploadBase = null;

		$this->mediafile_jobs = array();
		$this->otherContributors = null;
		$this->user_options = array();
	}

	/**
	 * @param {string} $metadata_file_upload
	 * @throws {GWTException}
	 *
	 * @return {null|string}
	 * null or an mwstore path
	 */
	public function saveMetadataToFileBackend(
		$metadata_file_upload = 'gwtoolset-metadata-file-upload'
	) {
		$result = null;

		if ( empty( $_FILES[$metadata_file_upload]['name'] ) ) {
			throw new GWTException( 'gwtoolset-no-file' );
		}

		$this->_File->populate( $metadata_file_upload );
		$Status = FileChecks::isUploadedFileValid( $this->_File, Config::$accepted_metadata_types );

		if ( !$Status->ok ) {
			throw new GWTException( $Status->getMessage() );
		}

		$result = $this->_GWTFileBackend->saveFile( $this->_File );

		return $result;
	}

	/**
	 * @param {array} $user_options
	 * @return {array}
	 */
	public function getPreview( array $user_options ) {
		$this->validateUserOptions( $user_options );
		$this->user_options = $user_options;

		$upload_params = $this->getUploadParams();
		$this->validateUploadParams( $upload_params );

		return array(
			'categories' => $this->getCategoriesForPreview(),
			'Title' => $this->getTitle( $upload_params['title'] ),
			'wikitext' => $upload_params['text']
		);
	}

	/**
	 * @todo does ContentHandler filter $options['text']?
	 * @todo does WikiPage filter $options['comment']?
	 *
	 * @param {array} $user_options
	 * @throws {GWTException}
	 * @return {null|Title}
	 */
	public function saveMediafileAsContent( array $user_options ) {
		$Status = Status::newGood();

		$this->validateUserOptions( $user_options );
		$this->user_options = $user_options;

		$upload_params = $this->getUploadParams();
		$this->validateUploadParams( $upload_params );

		$Title = $this->getTitle( $upload_params['title'] );

		if ( !$Title->isKnown() ) {
			// upload new content and mediafile
			$this->otherContributors = false;
			$Status = $this->uploadMediaFileViaUploadFromUrl( $upload_params, $Title );
		} else {
			// re-upload the mediafile
			if ( $this->user_options['gwtoolset-reupload-media'] === true ) {
				$Status = $this->uploadMediaFileViaUploadFromUrl( $upload_params, $Title );
			}

			// upload new page content if no one else has edited the title
			if ( $Status->isOk() ) {
				if ( !$this->otherContributors( $Title ) ) {
					$Content = ContentHandler::makeContent( $upload_params['text'], $Title );
					$Page = WikiPage::factory( $Title );
					$Status = $Page->doEditContent(
						$Content,
						$upload_params['comment'],
						0,
						false,
						$this->_User
					);
				} else {
					$msg =
						wfMessage( 'gwtoolset-mediafile-other-contributors' )
							->params( $Title )
							->escaped();

					$Status = Status::newFatal( $msg );
				}
			}
		}

		if ( !$Status->isOK() ) {
			$msg =
				$Status->getMessage() . PHP_EOL .
				'original URL: ' .
				Utils::sanitizeUrl(
					$this
						->_MediawikiTemplate
						->mediawiki_template_array['gwtoolset-url-to-the-media-file']
				) . PHP_EOL .
				'evaluated URL: ' .
				Utils::sanitizeUrl( $upload_params['gwtoolset-url-to-the-media-file'] );

			throw new GWTException( $msg );
		}

		return $Title;
	}

	/**
	 * save a metadata record as a new/updated wiki page
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {array} $options
	 * @param {array} $options['metadata-mapped-to-mediawiki-template']
	 * @param {array} $options['metadata-as-array']
	 * @param {string} $options['metadata-raw']
	 * @param {array} $whitelisted_post
	 *
	 * @return {bool}
	 * @throws {MWException}
	 */
	public function saveMediafileViaJob(
		array $user_options, array $options, array $whitelisted_post
	) {

		if ( count( $this->mediafile_jobs ) > (int)$user_options['gwtoolset-mediafile-throttle'] ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-job-throttle-exceeded' )->escaped()
					)
					->escaped()
			);
		}

		$this->validateUserOptions( $user_options );

		$job = new UploadMediafileJob(
			Title::newFromText(
				$this->_User->getName() . '/' .
				Constants::EXTENSION_NAME . '/' .
				'Mediafile Batch Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'options' => $options,
				'whitelisted-post' => $whitelisted_post,
				'user-name' => $this->_User->getName(),
				'user-options' => $user_options
			)
		);

		$this->mediafile_jobs[] = $job;
		return true;
	}

	/**
	 * processes user_options['categories']
	 *
	 * creates sanitized categories, which have been
	 * stripped of illegal category characters
	 */
	protected function setGlobalCategories() {
		$categories = array();
		$this->_global_categories = array();

		if ( !empty( $this->user_options['categories'] ) ) {
			$categories = explode(
				Config::$category_separator,
				$this->user_options['categories']
			);
		}

		foreach( $categories as $key => $item ) {
			$this->_global_categories[$key] =
				Utils::stripIllegalCategoryChars(
					Utils::sanitizeString( $item )
				);
		}
	}

	/**
	 * processes user_options['gwtoolset-category-metadata']
	 * and user_options['gwtoolset-category-phrase']
	 *
	 * creates sanitized categories, which have been
	 * stripped of illegal category characters
	 */
	protected function setItemSpecificCategories() {
		$this->_item_specific_categories = array();

		if ( !empty( $this->user_options['gwtoolset-category-metadata'] ) ) {
			$category_count = count( $this->user_options['gwtoolset-category-metadata'] );

			for ( $i = 0; $i < $category_count; $i += 1 ) {
				$phrase = null;
				$metadata_values = array();

				if ( !empty( $this->user_options['gwtoolset-category-phrase'][$i] ) ) {
					$phrase = $this->user_options['gwtoolset-category-phrase'][$i];
				}

				if ( !empty( $this->user_options['gwtoolset-category-metadata'][$i] ) ) {
					$metadata_values =
						$this->_Metadata->getFieldValuesAsArray(
							$this->user_options['gwtoolset-category-metadata'][$i]
						);
				}

				foreach( $metadata_values as $metadata_value ) {
					if ( !empty( $phrase ) ) {
						$this->_item_specific_categories[] =
							Utils::stripIllegalCategoryChars(
								Utils::sanitizeString( $phrase )
							) .
							' ' .
							Utils::stripIllegalCategoryChars(
								Utils::sanitizeString( $metadata_value )
							);
					} else {
						$this->_item_specific_categories[] =
							Utils::stripIllegalCategoryChars(
								Utils::sanitizeString( $metadata_value )
							);
					}
				}
			}
		}
	}

	/**
	 * @param {array} $options
	 * @param {Title} $Title
	 * @return {Status}
	 */
	protected function uploadMediaFileViaUploadFromUrl(
		array $options,
		Title $Title
	) {
		// Initialize the upload object
		$upload = new UploadFromUrl();
		WikiChecks::increaseHTTPTimeout();

		$upload->initialize(
			$Title->getBaseText(),
			$options['gwtoolset-url-to-the-media-file'],
			false
		);

		// Fetch the file - returns a Status Object
		$status = $upload->fetchFile();
		if ( !$status->isOk() ) {
			$upload->cleanupTempFile();
			return $status;
		}

		// Verify upload - returns a status value via an array
		$status = $upload->verifyUpload();
		if ( $status['status'] !== UploadBase::OK ) {
			$upload->cleanupTempFile();
			return $upload->convertVerifyErrorToStatus( $status );
		}

		// Check upload warnings
		$status = $this->checkUploadWarnings( $upload, $Title );
		if ( !$status->isOk() ) {
			$upload->cleanupTempFile();
			return $status;
		}

		// Perform the upload - returns FileRepoStatus Object
		$status = $upload->performUpload(
			$options['comment'],
			$options['text'],
			$options['watch'],
			$this->_User
		);

		// Page may very well exist now where it previously didn't
		$Title->resetArticleID( false );

		if ( !$status->isOK() ) {
			$msg =
				$status->getMessage() . PHP_EOL . ' ' .
				'tmp path: ' . $upload->getTempPath() . PHP_EOL;

			$upload->cleanupTempFile();
			$status = Status::newFatal( $msg );
		}

		return $status;
	}

	/**
	 * makes sure that the following values are present
	 *   - title
	 *   - ignorewarnings
	 *   - text
	 *   - url-to-the-media-file
	 *
	 * @param {array} $options
	 * @throws {MWException}
	 */
	protected function validateUploadParams( array &$options ) {
		if ( !isset( $options['ignorewarnings'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-ignorewarnings' )->parse() )
					->parse()
			);
		}

		// assumes that text must be something
		if ( empty( $options['text'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-text' )->escaped() )
					->parse()
			);
		}

		if ( empty( $options['title'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-title' )->escaped() )
					->parse()
			);
		}

		if ( empty( $options['gwtoolset-url-to-the-media-file'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-url-to-media' )->parse() )
					->parse()
			);
		}
	}

	/**
	 * @param {array} $options
	 * @throws {MWException}
	 */
	protected function validateUserOptions( array $user_options ) {
		if ( !isset( $user_options['comment'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-comment' )->parse() )
					->parse()
			);
		}

		if ( !isset( $user_options['gwtoolset-mediafile-throttle'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-mediafile-throttle' )->parse() )
					->parse()
			);
		}

		if ( !isset( $user_options['gwtoolset-reupload-media'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-reupload-media' )->parse() )
					->parse()
			);
		}

		if ( !isset( $user_options['save-as-batch-job'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-save-as-batch' )->parse() )
					->parse()
			);
		}
	}

	/**
	 * verifies whether or not the wiki will allow the copy of content from
	 * the given URL. If not, a request to add the domain to the
	 * $wgCopyUploadsDomains array needs to be made.
	 *
	 * @param {string} $url
	 * @throws {GWTException}
	 */
	protected function verifyUploadDomain( $url ) {
		if ( !UploadFromUrl::isAllowedHost( $url ) ) {
			throw new GWTException(
				wfMessage( 'upload-copy-upload-invalid-domain' )->escaped()
			);
		}
	}

}
