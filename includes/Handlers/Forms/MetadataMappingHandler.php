<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Handlers\Forms;
use GWToolset\Adapters\Php\MappingPhpAdapter,
	GWToolset\Adapters\Db\MediawikiTemplateDbAdapter,
	GWToolset\Config,
	GWToolset\Forms\PreviewForm,
	GWToolset\Jobs\UploadMetadataJob,
	GWToolset\Handlers\UploadHandler,
	GWToolset\Handlers\Xml\XmlMappingHandler,
	GWToolset\Helpers\WikiPages,
	GWToolset\Models\Mapping,
	GWToolset\Models\MediawikiTemplate,
	Html,
	JobQueueGroup,
	Linker,
	Php\Filter,
	Revision,
	SpecialPage,
	Title,
	User,
	WikiPage;

class MetadataMappingHandler extends FormHandler {

	/**
	 * @var {Mapping}
	 */
	protected $_Mapping;

	/**
	 * @var {MediawikiTemplate}
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var {UploadHandler}
	 */
	protected $_UploadHandler;

	/**
	 * @var {XmlMappingHandler}
	 */
	protected $_XmlMappingHandler;

	/**
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @return {string}
	 * the html string has been escaped and parsed by wfMessage
	 */
	protected function createMetadataBatchJob( array &$user_options ) {
		$result = false;

		$job = new UploadMetadataJob(
			Title::newFromText( 'User:' . $this->User->getName() . '/' . Config::$name . ' Metadata Batch Job' ),
			array(
				'username' => $this->User->getName(),
				'user_options' => $user_options,
				'post' => $_POST
			)
		);

		$result = JobQueueGroup::singleton()->push( $job );

		if ( $result ) {
			$newFilesLink = Linker::link(
				Title::newFromText( 'Special:NewFiles' ),
				null,
				array( 'target' => '_blank' )
			);

			$result = wfMessage( 'gwtoolset-batchjob-metadata-created' )->rawParams( $newFilesLink )->parse();
		} else {
			$result = Html::rawElement(
				'span',
				array( 'class' => 'error' ),
				wfMessage( 'gwtoolset-developer-issue' )->params(
					wfMessage( 'gwtoolset-batchjob-metadata-creation-failure' )->escaped()
				)->parse()
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
	 *
	 * @return {void}
	 */
	protected function getGlobalCategories( array &$user_options ) {
		$user_options['categories'] = Config::$mediawiki_template_default_category;

		if ( isset( $_POST['category'] ) ) {
			foreach ( $_POST['category'] as $category ) {
				if ( !empty( $category ) ) {
					$user_options['categories'] .= Config::$category_separator . $category;
				}
			}
		}
	}

	/**
	 * gets various user options from $_POST and sets default values
	 * if no user value is supplied
	 *
	 * @return {array}
	 * the values within the array have not been filtered
	 */
	protected function getUserOptions() {
		$result = array(
			'categories' => null,

			'category-phrase' => !empty( $_POST['category-phrase'] )
				? $_POST['category-phrase']
				: array(),

			'category-metadata' => !empty( $_POST['category-metadata'] )
				? $_POST['category-metadata']
				: array(),

			'comment' => !empty( $_POST['wpSummary'] )
				? $_POST['wpSummary']
				: '',

			'mediawiki-template-name' => !empty( $_POST['mediawiki-template-name'] )
				? $_POST['mediawiki-template-name']
				: null,

			'metadata-file-url' => !empty( $_POST['metadata-file-url'] )
				? urldecode( $_POST['metadata-file-url'] )
				: null,

			'partner-template-url' => !empty( $_POST['partner-template-url'] )
				? urldecode( $_POST['partner-template-url'] )
				: null,

			'preview' => !empty( $_POST['gwtoolset-preview'] )
				? true
				: false,

			'record-count' => 0,

			'record-begin' => !empty( $_POST['record-begin'] )
				? (int)$_POST['record-begin']
				: 0,

			'record-element-name' => !empty( $_POST['record-element-name'] )
				? $_POST['record-element-name']
				: 'record',

			'save-as-batch-job' => !empty( $_POST['save-as-batch-job'] )
				? (bool)$_POST['save-as-batch-job']
				: false,

			// Filter::evaluate is used here to extract the 'title-identifier' array
			'title-identifier' => !empty( $_POST['title-identifier'] )
				? Filter::evaluate( array( 'source' => $_POST, 'key-name' => 'title-identifier' ) )
				: null,

			'upload-media' => !empty( $_POST['upload-media'] )
				? (bool)$_POST['upload-media']
				: false,

			// Filter::evaluate is used here to extract the 'url-to-the-media-file' array
			'url-to-the-media-file' => !empty( $_POST['url-to-the-media-file'] )
				? Filter::evaluate( array( 'source' => $_POST, 'key-name' => 'url-to-the-media-file' ) )
				: null
		);

		if ( !empty( $result['partner-template-url'] ) ) {
			$result['partner-template-name'] = WikiPages::getTitleFromUrl( $result['partner-template-url'] );
		}

		return $result;
	}

	/**
	 * save a metadata record as a new/updated wiki page
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {array} $element_mapped_to_mediawiki_template
	 * @param {string} $metadata_raw
	 * @return {null|Title}
	 */
	public function processMatchingElement( array &$user_options, $element_mapped_to_mediawiki_template, $metadata_raw ) {
		$this->_MediawikiTemplate->metadata_raw = $metadata_raw;
		$this->_MediawikiTemplate->populateFromArray( $element_mapped_to_mediawiki_template );

		return $this->_UploadHandler->saveMediaFile( $user_options );
	}

	/**
	 * a control method that steps through the methods necessary
	 * for processing the metadata and mapping in order to create
	 * mediafile wiki pages
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @throws {Exception}
	 * @return {array}
	 * an array of mediafile Title(s)
	 */
	protected function processMetadata( array &$user_options ) {
		$mediafile_titles = array();
		$this->_Mapping = null;
		$this->_MediawikiTemplate = null;
		$this->_UploadHandler = null;
		$this->_XmlMappingHandler = null;

		$this->_MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplateDbAdapter() );
		$this->_MediawikiTemplate->getMediaWikiTemplate( $user_options );

		$this->_Mapping = new Mapping( new MappingPhpAdapter() );
		$this->_Mapping->mapping_array = $this->_MediawikiTemplate->getMappingFromArray( $_POST );
		$this->_Mapping->setTargetElements();
		$this->_Mapping->reverseMap();

		$this->_UploadHandler = new UploadHandler(
			array(
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'User' => $this->User,
			)
		);

		$Metadata_Title = WikiPages::getTitleFromUrl( $user_options['metadata-file-url'] );

		if ( $Metadata_Title instanceof Title ) {
			$Metadata_Page = new WikiPage( $Metadata_Title );
			$Metadata_Content = $Metadata_Page->getContent( Revision::RAW );
		} else {
			throw new Exception(
				wfMessage( 'gwtoolset-metadata-file-url-not-present' )
					->params( $user_options['metadata-file-url'])
					->escaped()
			);
		}

		$this->_XmlMappingHandler = new XmlMappingHandler(
			array(
				'Mapping' => $this->_Mapping,
				'MediawikiTemplate' => $this->_MediawikiTemplate,
				'MappingHandler' => $this
			)
		);

		$mediafile_titles = $this->_XmlMappingHandler->processXml( $user_options, $Metadata_Content );

		/**
		 * when $this->SpecialPage is empty this method is being run by a wiki job
		 * if more metadata records exist in the metadata file, create another
		 * UploadMetadataJob
		 */
		if ( empty( $this->SpecialPage ) &&
			(int)$user_options['record-count'] > (
				(int)$user_options['record-begin'] + (int)Config::$job_throttle
			)
		) {
			$_POST['record-begin'] = (int)$user_options['record-count'];
			$this->createMetadataBatchJob( $user_options );
		}

		return $mediafile_titles;
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
		$user_options = $this->getUserOptions();
		$this->getGlobalCategories( $user_options );

		$this->checkForRequiredFormFields(
			$user_options,
			array(
				'mediawiki-template-name',
				'metadata-file-url',
				'record-count',
				'record-element-name',
				'title-identifier',
				'url-to-the-media-file'
			)
		);

		if ( $user_options['preview'] === true ) {
			Config::$job_throttle = Config::$preview_throttle;
			$mediafile_titles = $this->processMetadata( $user_options );

			$result = PreviewForm::getForm(
				$this->SpecialPage->getContext(),
				$user_options,
				$mediafile_titles
			);
		} else {
			$user_options['save-as-batch-job'] = true;

			/**
			 * when $this->SpecialPage is not empty, this method is being run
			 * by a user as a SpecialPage, thus this is the creation of the
			 * initial uploadMetadataJob. subsequent uploadMetadataJobs are
			 * created in $this->processMetadata() when necessary.
			 */
			if ( !empty( $this->SpecialPage ) ) {
				$result = wfMessage( 'gwtoolset-step-4-heading' )->parse() .
					$this->createMetadataBatchJob( $user_options );
				/**
				 * when $this->SpecialPage is empty, this method is being run
				 * by a wiki job; typically, uploadMediafileJob.
				 */
			} else {
				$result = $this->processMetadata( $user_options );
			}
		}

		return $result;
	}
}
