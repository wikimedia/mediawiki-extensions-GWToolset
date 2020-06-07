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
use GWToolset\Config;
use GWToolset\Forms\MetadataMappingForm;
use GWToolset\GWTException;
use GWToolset\Handlers\UploadHandler;
use GWToolset\Handlers\Xml\XmlDetectHandler;
use GWToolset\Helpers\GWTFileBackend;
use GWToolset\Models\Mapping;
use GWToolset\Models\MediawikiTemplate;
use GWToolset\Utils;
use Language;
use MWException;
use Php\File;

class MetadataDetectHandler extends FormHandler {

	/**
	 * @var array
	 */
	protected $_expected_post_fields = [
		'gwtoolset-form' => [ 'size' => 255 ],
		'gwtoolset-mediawiki-template-name' => [ 'size' => 255 ],
		'gwtoolset-mediawiki-template-custom' => [ 'size' => 255 ],
		'gwtoolset-mediafile-throttle' => [ 'size' => 2 ],
		'gwtoolset-metadata-file-upload' => [ 'size' => 255 ],
		'gwtoolset-metadata-mapping-url' => [ 'size' => 255 ],
		'gwtoolset-record-element-name' => [ 'size' => 255 ],
		'wpEditToken' => [ 'size' => 255 ]
	];

	/**
	 * @var \GWToolset\Helpers\GWTFileBackend
	 */
	protected $_GWTFileBackend;

	/**
	 * @var \GWToolset\Models\Mapping
	 */
	protected $_Mapping;

	/**
	 * @var \GWToolset\Models\MediawikiTemplate
	 */
	protected $_MediawikiTemplate;

	/**
	 * @var \GWToolset\Handlers\UploadHandler
	 */
	protected $_UploadHandler;

	/**
	 * @var array
	 */
	protected $_whitelisted_post;

	/**
	 * @var \GWToolset\Handlers\Xml\XmlDetectHandler
	 */
	public $XmlDetectHandler;

	/**
	 * a control method that returns an html string that is comprised
	 * of table rows.
	 *
	 * each table row consists of a mediawiki template parameter,
	 * based on the mediawiki template selected in step 1, and an
	 * html <select> that contains <option>s derived from
	 * evaluating a metadata file provided in step 1. the options
	 * represent elements found within the metadata file and will
	 * be used by the user to map mediawiki template parameters to
	 * the metadata elements within the metadata file. if a pre-defined
	 * Mapping is provided, it will be used to pre-select matching
	 * mediawiki template parameters with metadata elements in the
	 * <select>s
	 *
	 * @return string
	 * the values within the table rows have been filtered
	 */
	public function getMetadataAsHtmlSelectsInTableRows() {
		$result = '';

		foreach ( $this->_MediawikiTemplate->mediawiki_template_array as $parameter => $value ) {
			$result .= $this->XmlDetectHandler->getMetadataAsTableCells(
				$parameter,
				$this->_Mapping
			);
		}

		return $result;
	}

	/**
	 * gets various user options from $this->_whitelisted_post and sets default values
	 * if no user value is supplied
	 *
	 * @return array
	 */
	protected function getUserOptions() {
		return [
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

			'gwtoolset-mediawiki-template-name' => $this->setTemplateName(),

			'gwtoolset-metadata-file-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-file-url'] )
					? $this->_whitelisted_post['gwtoolset-metadata-file-url']
					: null,

			'gwtoolset-metadata-mapping-url' =>
				!empty( $this->_whitelisted_post['gwtoolset-metadata-mapping-url'] )
					? $this->_whitelisted_post['gwtoolset-metadata-mapping-url']
					: null,

			'Metadata-Title' => null,

			'gwtoolset-record-count' => 0,

			'gwtoolset-record-element-name' =>
				!empty( $this->_whitelisted_post['gwtoolset-record-element-name'] )
					? $this->_whitelisted_post['gwtoolset-record-element-name']
					: 'record',
		];
	}

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * - uploads a metadata file if provided and stores it in the wiki
	 * - retrieves the metadata file from the wiki
	 * - retrieves a metadata mapping if a url to it in the wiki is given
	 * - adds this information to the metadata mapping form and presents it to the user
	 *
	 * @throws GWTException
	 * @return string
	 * the html form string has not been filtered in this method,
	 * but within the getForm method
	 */
	protected function processRequest() {
		$result = null;

		$this->_whitelisted_post = Utils::getWhitelistedPost(
			$_POST,
			$this->_expected_post_fields
		);

		$userOptions = $this->getUserOptions();

		$this->checkForRequiredFormFields(
			$userOptions,
			[
				'gwtoolset-record-element-name',
				'gwtoolset-mediawiki-template-name',
				'gwtoolset-record-count'
			]
		);

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
				'File' => new File(),
				'GWTFileBackend' => $this->_GWTFileBackend,
				'SpecialPage' => $this->SpecialPage,
				'User' => $this->User,
				'HttpRequestFactory' => $this->HttpRequestFactory
			]
		);

		$this->XmlDetectHandler = new XmlDetectHandler(
			[
				'GWTFileBackend' => $this->_GWTFileBackend,
				'SpecialPage' => $this->SpecialPage
			]
		);

		// upload the metadata file and get an mwstore reference to it
		$userOptions['gwtoolset-metadata-file-relative-path'] =
			$this->_UploadHandler->saveMetadataToFileBackend();

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

		$userOptions['gwtoolset-metadata-file-sha1'] = $file->getSha1Base36();
		$this->XmlDetectHandler->processXml( $userOptions, $file->getPath() );

		$this->_MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$this->_MediawikiTemplate->getMediaWikiTemplate(
			$userOptions['gwtoolset-mediawiki-template-name']
		);

		$this->_Mapping = new Mapping( new MappingPhpAdapter() );
		$this->_Mapping->retrieve( $userOptions );

		$result = MetadataMappingForm::getForm(
			$this,
			$userOptions
		);

		return $result;
	}

	/**
	 * the application uses gwtoolset-mediawiki-template-name to fetch a mediawiki
	 * template to use for metadata matching.
	 *
	 * if a value for gwtoolset-mediawiki-template-custom is given, it is assumed
	 * that the application should use it instead, even a value is also provided
	 * in gwtoolset-mediawiki-template-name.
	 *
	 * @return string
	 */
	protected function setTemplateName() {
		global $wgLanguageCode;

		if (
			!empty( $this->_whitelisted_post['gwtoolset-mediawiki-template-custom'] )
		) {
			$language = Language::factory( $wgLanguageCode );

			return Utils::normalizeSpace(
					str_replace(
						$language->getNsText( NS_TEMPLATE ) . ':',
						'',
						$this->_whitelisted_post['gwtoolset-mediawiki-template-custom']
					)
				);
		} else {
			return Utils::normalizeSpace(
					$this->_whitelisted_post['gwtoolset-mediawiki-template-name']
				);
		}
	}
}
