<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Handlers;
use ContentHandler,
	GWToolset\Config,
	GWToolset\GWTException,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiChecks,
	GWToolset\Helpers\WikiPages,
	GWToolset\Jobs\UploadMediafileJob,
	GWToolset\Jobs\UploadFromUrlJob,
	GWToolset\Models\Mapping,
	GWToolset\Models\MediawikiTemplate,
	GWToolset\Models\Metadata,
	JobQueueGroup,
	Linker,
	LocalRepo,
	MimeMagic,
	MWHttpRequest,
	Php\File,
	Php\Filter,
	Title,
	UploadBase,
	UploadFromUrl,
	UploadStash,
	User,
	WikiPage;

class UploadHandler {

	/**
	 * @var {File}
	 */
	protected $_File;

	/**
	 * @var {Mapping}
	 */
	protected $_Mapping;

	/**
	 * @var {MediawikiTemplate}
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
	 * used to hold the original wiki file extension array while the extension
	 * augments it for metadata file upload.
	 */
	private $_wgFileExtensions;

	/**
	 * @var {array}
	 */
	public $user_options;

	/**
	 * @var {int}
	 */
	public $jobs_added;

	/**
	 * @var {int}
	 */
	public $jobs_not_added;

	/**
	 * @param {array} $options
	 */
	public function __construct( array $options = array() ) {
		$this->reset();

		if ( isset( $options['File'] ) ) {
			$this->_File = $options['File'];
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
			'<!-- Metadata Mapped -->' . PHP_EOL .
			'<!-- <metadata_mapped_json>' .
			json_encode( $this->_MediawikiTemplate->mediawiki_template_array ) .
			'</metadata_mapped_json> -->' . PHP_EOL . PHP_EOL .
			'<!-- Metadata Raw -->' . PHP_EOL .
			'<!-- <metadata_raw>' . PHP_EOL .
			htmlspecialchars( $this->_MediawikiTemplate->metadata_raw ) . PHP_EOL .
			'</metadata_raw> -->' . PHP_EOL;
	}

	/**
	 * creates wiki text category entries.
	 * these categories represent global categories
	 * that are applied to all of the media files being uploaded.
	 *
	 * @return {null|string}
	 * the resulting wiki text is filtered
	 */
	protected function addGlobalCategories() {
		$result = null;

		if ( !empty( $this->user_options['categories'] ) ) {
			$result .= '<!-- Categories -->' . PHP_EOL;
			$categories = explode( Config::$category_separator, $this->user_options['categories'] );

			foreach ( $categories as $category ) {
				$result .=
						'[[' .
							\GWToolset\getNamespaceName( NS_CATEGORY ) .
							\GWToolset\stripIllegalCategoryChars( Filter::evaluate( $category ) ) .
						']]';
			}
		}

		return $result;
	}

	/**
	 * creates wiki text category entries.
	 * these categories represent specific categories for this
	 * specific media file rather than global categories
	 * that are applied to all of the media files being uploaded.
	 *
	 * @return {null|string}
	 * the resulting wiki text is filtered
	 */
	protected function addItemSpecificCategories() {
		$category_count = 0;
		$phrase = null;
		$metadata = null;
		$result = null;

		if ( !empty( $this->user_options['category-metadata'] ) ) {
			$category_count = count( $this->user_options['category-metadata'] );

			for ( $i = 0; $i < $category_count; $i += 1 ) {
				$phrase = null;
				$metadata = null;

				if ( !empty( $this->user_options['category-phrase'][$i] ) ) {
					$phrase = Filter::evaluate( $this->user_options['category-phrase'][$i] ) . ' ';
				}

				if ( !empty( $this->user_options['category-metadata'][$i] ) ) {
					$metadata =
						$this->_Metadata->getConcatenatedField(
							$this->user_options['category-metadata'][$i]
						);
				}

				if ( !empty( $metadata ) ) {
					$result .=
						'[[' .
							\GWToolset\getNamespaceName( NS_CATEGORY ) .
							\GWToolset\stripIllegalCategoryChars( $phrase ) .
							\GWToolset\stripIllegalCategoryChars( $metadata ) .
						']]';
				}
			}
		}

		return $result;
	}

	/**
	 * adds to the wiki’s allowed extensions array, $wgFileExtensions so that
	 * UploadBase will accept certain types. original intention is to allow
	 * xml file uploads as metadata sets
	 *
	 * @param {array} $accepted_types
	 * @throws {GWTException}
	 */
	protected function augmentAllowedExtensions( array $accepted_types = array() ) {
		global $wgFileExtensions;

		if ( empty( $accepted_types ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						wfMessage( 'gwtoolset-no-accepted-types' )
							->escaped( 'gwtoolset-no-accepted-types-provided' )
					)
					->parse()
			);
		}

		$this->_wgFileExtensions = $wgFileExtensions;

		foreach ( array_keys( Config::$accepted_metadata_types ) as $accepted_extension ) {
			if ( !in_array( $accepted_extension, $wgFileExtensions ) ) {
				$wgFileExtensions[] = Filter::evaluate( $accepted_extension );
			}
		}
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
	 * @throws {GWTException}
	 * @return {array}
	 * the values in the array are not filtered
	 *   $result['content-type']
	 *   $result['extension']
	 *   $result['url']
	 */
	protected function evaluateMediafileUrl( $url ) {
		$result = array( 'content-type' => null, 'extension' => null, 'url' => null );
		$pathinfo = array();

		if ( empty( $url ) ) {
			throw new GWTException(
				__METHOD__ . ' ' .
				wfMessage( 'gwtoolset-no-url-to-evaluate' )->escaped()
			);
		}

		$Http = MWHttpRequest::factory(
			$url,
			array(
				'method' => 'HEAD',
				'followRedirects' => true,
				'userAgent' => Config::$http_agent
			)
		);

		$Status = $Http->execute();

		if ( !$Status->ok ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mapping-media-file-url-bad' )
					->rawParams( Filter::evaluate( $url ) )
					->escaped()
			);
		}

		$result['url'] = $Http->getFinalUrl();
		$result['content-type'] = $Http->getResponseHeader( 'content-type' );
		$result['extension'] = $this->getFileExtension( $result );

		if ( empty( $result['extension'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mapping-media-file-url-extension-bad' )
					->rawParams( Filter::evaluate( $url ) )
					->escaped()
			);
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
				wfMessage( 'gwtoolset-mapping-media-file-url-bad' )
					->rawParams( Filter::evaluate( $options['url'] ) )
					->escaped()
			);
		}

		if ( empty( $options['content-type'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mapping-media-file-no-content-type' )
					->rawParams( Filter::evaluate( $options['content-type'] ) )
					->escaped()
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
	 * creates the wiki text for the media file page.
	 * concatenates several pieces of information in order to create the wiki
	 * text for the mediafile wiki text
	 *
	 * @return {string}
	 * except for the metadata, the resulting wiki text is filtered
	 */
	protected function getText() {
		return
			$this->_MediawikiTemplate->getTemplate( $this->user_options ) . PHP_EOL . PHP_EOL .
			$this->addGlobalCategories() .
			$this->addItemSpecificCategories() . PHP_EOL . PHP_EOL .
			$this->addMetadata();
	}

	/**
	 * @param {string} $title
	 * @throws {GWTException}
	 * @return {Title}
	 */
	protected function getTitle( $title ) {
		$result = \GWToolset\getTitle(
			\GWToolset\stripIllegalTitleChars( $title ),
			Config::$mediafile_namespace,
			array( 'must-be-known' => false )
		);

		if ( !( $result instanceof Title ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-title-bad' )
					->params( $title )->parse()
			);
		}

		return $result;
	}

	/**
	 * retrieves the metadata file via :
	 * - a url to the local wiki
	 * - or the uploaded file given in the $_POST'ed form
	 *
	 * if the form contains both a url and uploaded file, the script will prefer
	 * the url and ignore the uploaded file
	 *
	 * if a file is uploaded, a local wiki url to the newly uploaded file will be
	 * added to $user_options[$options['metadata-file-url']]
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {array} $options
	 *   {string} $options['metadata-file-url']
	 *   the key within $user_options that holds the url to the metadata file
	 *   stored in the local wiki
	 *
	 *   {string} $options['metadata-file-upload']
	 *   the key-name expected in $_FILES[] that should contain the metadata file
	 *   that has been uploaded via an html form
	 *
	 * @return {null|Title}
	 */
	public function getTitleFromUrlOrFile( array &$user_options, array $options = array() ) {
		$result = null;

		$options_default = array(
			'metadata-file-url' => 'metadata-file-url',
			'metadata-file-upload' => 'metadata-file-upload'
		);

		$options = array_merge( $option_defaults, $options );

		if ( !empty( $user_options[$options['metadata-file-url']] ) ) {
			$result = \GWToolset\getTitle(
				$user_options[$options['metadata-file-url']],
				Config::$metadata_namespace
			);
		} elseif ( !empty( $_FILES[$options['metadata-file-upload']]['name'] ) ) {
			$result = $this->saveMetadataFileAsContent( $options['metadata-file-upload'] );
			$user_options['metadata-file-url'] = $result;
		}

		return $result;
	}

	/**
	 * @param {array} $user_options
	 * @return {null|UploadStashFile}
	 */
	public function getMetadataFromStash( array &$user_options ) {
		$result = null;

		if ( !empty( $user_options['metadata-stash-key'] ) ) {
			global $wgLocalFileRepo;
			$UploadStash = new UploadStash( new LocalRepo( $wgLocalFileRepo ), $this->_User );
			$result = $UploadStash->getFile( $user_options['metadata-stash-key'] );
		}

		return $result;
	}

	public function reset() {
		$this->_File = null;
		$this->_Mapping = null;
		$this->_MediawikiTemplate = null;
		$this->_SpecialPage = null;
		$this->_UploadBase = null;

		$this->jobs_added = 0;
		$this->jobs_not_added = 0;
		$this->user_options = array();
	}

	/**
	 * restores the wiki’s allowed extensions array
	 *
	 * @param {array} $accepted_types
	 */
	protected function restoreAllowedExtensions( array $accepted_types = array() ) {
		global $wgFileExtensions;
		$wgFileExtensions = $this->_wgFileExtensions;
	}

	/**
	 * attempts to save the uploaded metadata file to the wiki as content
	 *
	 * @todo does ContentHandler filter the $text?
	 * @todo does WikiPage filter $summary?
	 *
	 * @param {string} $metadata_file_upload
	 * the key-name expected in $_FILES[] that should contain the metadata file
	 * that has been uploaded via an html form
	 *
	 * @throws {GWTException}
	 * @return {null|Title}
	 */
	public function saveMetadataFileAsContent( $metadata_file_upload = 'metadata-file-upload' ) {
		$result = null;
		$this->_File->populate( $metadata_file_upload );
		$Status = FileChecks::isUploadedFileValid( $this->_File, Config::$accepted_metadata_types );

		if ( !$Status->ok ) {
			throw new GWTException( $Status->getMessage() );
		}

		$this->augmentAllowedExtensions( Config::$accepted_metadata_types );
		WikiChecks::increaseHTTPTimeout( 120 );

		$Metadata_Title = \GWToolset\getTitle(
			\GWToolset\stripIllegalTitleChars(
				Config::$metadata_sets_subpage . '/' .
				$this->_User->getName() . '/' .
				$this->_File->pathinfo['filename'] .
				'.' . $this->_File->pathinfo['extension'],
				array( 'allow-subpage' => true )
			),
			Config::$metadata_namespace,
			array( 'must-be-known' => false )
		);

		$text = file_get_contents( $this->_File->tmp_name );
		$Metadata_Content = ContentHandler::makeContent( $text, $Metadata_Title );
		$summary = wfMessage( 'gwtoolset-create-metadata' )
			->params( Config::$name, $this->_User->getName() )
			->escaped();

		$Metadata_Page = new WikiPage( $Metadata_Title );
		$Metadata_Page->doEditContent( $Metadata_Content, $summary, 0, false, $this->_User );
		$this->restoreAllowedExtensions();
		$result = $Metadata_Title;

		return $result;
	}

	/**
	 * @param {string} $metadata_file_upload
	 * @throws {GWTException}
	 * @return {null|string} null or a stash upload file key
	 */
	public function saveMetadataFileAsStash( $metadata_file_upload = 'metadata-file-upload' ) {
		$result = null;

		if ( !empty( $_FILES[$metadata_file_upload]['name'] ) ) {
			$this->_File->populate( $metadata_file_upload );
			$Status = FileChecks::isUploadedFileValid( $this->_File, Config::$accepted_metadata_types );

			if ( !$Status->ok ) {
				throw new GWTException( $Status->getMessage() );
			}

			global $wgLocalFileRepo;
			$UploadStash = new UploadStash( new LocalRepo( $wgLocalFileRepo), $this->_User );
			$result = $UploadStash
				->stashFile(
					$this->_File->tmp_name,
					null,
					array( 'expiry' => strtotime( '1 week' ) )
				)
				->getFileKey();
		}

		return $result;
	}

	/**
	 * @todo does ContentHandler filter $options['text']?
	 * @todo does WikiPage filter $options['comment']?
	 *
	 * @param {array} $user_options
	 * @throws {GWTException}
	 * @return {null|Title}
	 */
	public function saveMediafileAsContent( array &$user_options ) {
		$Title = null;
		$Status = null;
		$options = array();

		$this->validateUserOptions( $user_options );
		$this->user_options = $user_options;

		$options['url-to-the-media-file'] =
			$this->_MediawikiTemplate->mediawiki_template_array['url-to-the-media-file'];

		$evaluated_url = $this->evaluateMediafileUrl( $options['url-to-the-media-file'] );
		$options['url-to-the-media-file'] = $evaluated_url['url'];
		$options['evaluated-media-file-extension'] = $evaluated_url['extension'];

		$options['title'] = $this->_MediawikiTemplate->getTitle( $options );
		$options['ignorewarnings'] = true;
		$options['watch'] = true;
		$options['comment'] = wfMessage( 'gwtoolset-create-mediafile' )
			->params( Config::$name, $this->_User->getName() )
			->escaped() . PHP_EOL .
			trim( $this->user_options['comment'] );

		$options['text'] = $this->getText();

		WikiChecks::increaseHTTPTimeout();
		$this->validatePageOptions( $options );
		$Title = $this->getTitle( $options['title'] );

		if ( !$Title->isKnown() ) {
			$Status = $this->uploadMediaFileViaUploadFromUrl( $options, $Title );
		} else {
			if ( $this->user_options['upload-media'] === true ) {
				// this will re-upload the mediafile, but will not change the page contents
				$Status = $this->uploadMediaFileViaUploadFromUrl( $options, $Title );
			}

			if ( $Status === null || $Status->isOk() ) {
				$Content = ContentHandler::makeContent( $options['text'], $Title );
				$Page = new WikiPage( $Title );
				$Status = $Page->doEditContent( $Content, $options['comment'], 0, false, $this->_User );
			}
		}

		if ( !$Status->isOK() ) {
			throw new GWTException( $Status->getWikiText() );
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
	 *   {array} $options['metadata-mapped-to-mediawiki-template']
	 *   {array} $options['metadata-as-array']
	 *   {string} $options['metadata-raw']
	 *
	 * @return {bool}
	 */
	public function saveMediafileViaJob( array &$user_options, array $options ) {
		$result = false;
		$job = null;
		$sessionKey = null;

		if ( $this->jobs_added > Config::$job_throttle ) {
			return;
		}

		$this->validateUserOptions( $user_options );

		$job = new UploadMediafileJob(
			Title::newFromText(
				$this->_User->getName() . '/' .
				Config::$name . '/' .
				'Mediafile Batch Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'options' => $options,
				'post' => $_POST,
				'user-name' => $this->_User->getName(),
				'user-options' => $user_options
			)
		);

		$result = JobQueueGroup::singleton()->push( $job );

		if ( $result ) {
			$this->jobs_added += 1;
		} else {
			$this->jobs_not_added += 1;
		}

		return $result;
	}

	/**
	 * @todo does UploadFromUrl filter $options['url-to-the-media-file']
	 * @todo does UploadFromUrl filter $options['comment']
	 * @todo does UploadFromUrl filter $options['text']
	 *
	 * @param {array} $options
	 * @param {Title} $Title
	 * @return {Status}
	 */
	protected function uploadMediaFileViaUploadFromUrl( array &$options, Title $Title ) {
		// Initialize this object and the upload object
		$Upload = new UploadFromUrl();

		$Upload->initialize(
			$Title->getBaseText(),
			$options['url-to-the-media-file'],
			false
		);

		// Fetch the file - returns a Status Object
		$Status = $Upload->fetchFile();
		if ( !$Status->isOk() ) {
			return $Status;
		}

		// Verify upload - returns a status value via an array
		$status = $Upload->verifyUpload();
		if ( $status['status'] !== UploadBase::OK ) {
			return $Upload->convertVerifyErrorToStatus( $status );
		}

		// Perform the upload - returns FileRepoStatus Object
		$Status = $Upload->performUpload(
			$options['comment'],
			$options['text'],
			$options['watch'],
			$this->_User
		);

		return $Status;
	}

	/**
	 * @return {null|Status}
	 */
	protected function uploadMetadataFile() {
		$Status = null;

		$comment = wfMessage( 'gwtoolset-create-metadata' )
			->params( Config::$name, $this->_User->getName() )
			->escaped();
		$pagetext = '[[Category:' . Config::$metadata_file_category . ']]';
		$Status = $this->_UploadBase->performUpload(
			$comment,
			$comment . $pagetext,
			null,
			$this->_User
		);

		return $Status;
	}

	/**
	 * makes sure that the following values are present
	 *   - title
	 *   - ignorewarnings
	 *   - text
	 *   - url-to-the-media-file
	 *
	 * @param {array} $options
	 * @throws {GWTException}
	 */
	protected function validatePageOptions( array &$options ) {
		if ( !isset( $options['ignorewarnings'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-ignorewarnings' )->parse() )
					->parse()
			);
		}

		// assumes that text must be something
		if ( empty( $options['text'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-text' )->escaped() )
					->parse()
			);
		}if ( empty( $options['title'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-title' )->escaped() )
					->parse()
			);
		}

		if ( empty( $options['url-to-the-media-file'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-url-to-media' )->parse() )
					->parse()
			);
		}
	}

	/**
	 * @param {array} $options
	 * @throws {GWTException}
	 */
	protected function validateUserOptions( array &$user_options ) {
		if ( !isset( $user_options['comment'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-comment' )->parse() )
					->parse()
			);
		}

		if ( !isset( $user_options['save-as-batch-job'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-save-as-batch' )->parse() )
					->parse()
			);
		}

		if ( !isset( $user_options['upload-media'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-upload-media' )->parse() )
					->parse()
			);
		}
	}
}
