<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset;

class Config {

	public static $name = 'GWToolset';
	public static $author = array( 'dan entous' );
	public static $url = 'https://www.mediawiki.org/wiki/Extension:GWToolset';
	public static $descriptionmsg = 'gwtoolset-desc';
	public static $type = 'media';
	public static $version = '0.0.1';

	public static $autoloader_classes = array(
		'GWToolset\Adapters\DataAdapterInterface' => '/includes/Adapters/DataAdapterInterface.php',

		'GWToolset\Adapters\Db\DbAdapterAbstract' => '/includes/Adapters/Db/DbAdapterAbstract.php',
		'GWToolset\Adapters\Db\MediawikiTemplateDbAdapter' => '/includes/Adapters/Db/MediawikiTemplateDbAdapter.php',

		'GWToolset\Adapters\Php\MappingPhpAdapter' => '/includes/Adapters/Php/MappingPhpAdapter.php',

		'GWToolset\Exception' => '/includes/Exception.php',

		'GWToolset\Forms\MetadataDetectForm' => '/includes/Forms/MetadataDetectForm.php',
		'GWToolset\Forms\MetadataMappingForm' => '/includes/Forms/MetadataMappingForm.php',
		'GWToolset\Forms\PreviewForm' => '/includes/Forms/PreviewForm.php',

		'GWToolset\Handlers\Ajax\AjaxHandler' => '/includes/Handlers/Ajax/AjaxHandler.php',
		'GWToolset\Handlers\Ajax\MetadataMappingSaveHandler' => '/includes/Handlers/Ajax/MetadataMappingSaveHandler.php',

		'GWToolset\Handlers\Forms\FormHandler' => '/includes/Handlers/Forms/FormHandler.php',
		'GWToolset\Handlers\Forms\MetadataDetectHandler' => '/includes/Handlers/Forms/MetadataDetectHandler.php',
		'GWToolset\Handlers\Forms\MetadataMappingHandler' => '/includes/Handlers/Forms/MetadataMappingHandler.php',

		'GWToolset\Handlers\SpecialPageHandler' => '/includes/Handlers/SpecialPageHandler.php',
		'GWToolset\Handlers\UploadHandler' => '/includes/Handlers/UploadHandler.php',
		'GWToolset\Handlers\Xml\XmlDetectHandler' => '/includes/Handlers/Xml/XmlDetectHandler.php',
		'GWToolset\Handlers\Xml\XmlHandler' => '/includes/Handlers/Xml/XmlHandler.php',
		'GWToolset\Handlers\Xml\XmlMappingHandler' => '/includes/Handlers/Xml/XmlMappingHandler.php',

		'GWToolset\Helpers\FileChecks' => '/includes/Helpers/FileChecks.php',
		'GWToolset\Helpers\WikiChecks' => '/includes/Helpers/WikiChecks.php',
		'GWToolset\Helpers\WikiPages' => '/includes/Helpers/WikiPages.php',

		'GWToolset\Hooks' => '/includes/Hooks/Hooks.php',

		'GWToolset\Jobs\UploadFromUrlJob' => '/includes/Jobs/UploadFromUrlJob.php',
		'GWToolset\Jobs\UploadMediafileJob' => '/includes/Jobs/UploadMediafileJob.php',
		'GWToolset\Jobs\UploadMetadataJob' => '/includes/Jobs/UploadMetadataJob.php',

		'GWToolset\Models\Mapping' => '/includes/Models/Mapping.php',
		'GWToolset\Models\MediawikiTemplate' => '/includes/Models/MediawikiTemplate.php',
		'GWToolset\Models\Menu' => '/includes/Models/Menu.php',
		'GWToolset\Models\ModelAbstract' => '/includes/Models/ModelAbstract.php',
		'GWToolset\Models\ModelInterface' => '/includes/Models/ModelInterface.php',

		'GWToolset\SpecialGWToolset' => '/includes/Specials/SpecialGWToolset.php',

		'Php\File' => '/includes/Php/File.php',
		'Php\FileException' => '/includes/Php/FileException.php',
		'Php\Filter' => '/includes/Php/Filter.php',
		'Php\FilterException' => '/includes/Php/FilterException.php'
	);

	public static $messages = array(
		'GWToolset' => '/GWToolset.i18n.php',
		'GWToolsetAlias' => '/GWToolset.alias.php'
	);

	public static $special_pages = array(
		'GWToolset' => array(
			'class_name' => 'GWToolset\SpecialGWToolset',
			'group' => 'media'
		)
	);

	public static $resources = array(
		'scripts' => array(
			'resources/js/jquery/ui/1.10.3/jquery-ui.js',
			'resources/js/ext.gwtoolset.js'
		),
		'styles' => array(
			'resources/css/jquery/ui/1.10.3/themes/smoothness/jquery-ui.css',
			'resources/css/ext.gwtoolset.css'
		),
		'messages' => array(
			'gwtoolset-developer-issue',
			'gwtoolset-loading',
			'gwtoolset-save-mapping',
			'gwtoolset-save-mapping-name',
			'gwtoolset-save-mapping-failed',
			'gwtoolset-save-mapping-succeeded',
			'gwtoolset-step-2',
			'gwtoolset-back-link-option'
		)
	);

	public static $hooks = array(
		'LoadExtensionSchemaUpdates' => 'GWToolset\Hooks::onLoadExtensionSchemaUpdates'
	);

	public static $jobs = array(
		'gwtoolsetUploadFromUrlJob' => 'GWToolset\Jobs\UploadFromUrlJob',
		'gwtoolsetUploadMediafileJob' => 'GWToolset\Jobs\UploadMediafileJob',
		'gwtoolsetUploadMetadataJob' => 'GWToolset\Jobs\UploadMetadataJob'
	);

	/**
	 * @see SpecialPage __constructor
	 *
	 * $name string
	 * name of the special page, as seen in links and URLs
	 *
	 * $restriction string
	 * user right required, e.g. "block" or "delete"
	 *
	 * $listed boolean
	 * whether the page is listed in Special:Specialpages
	 */
	public static $special_page_name = 'GWToolset';
	public static $restriction = 'upload_by_url';
	public static $listed = true;

	/**
	 * @var {int}
	 * set in bytes
	 * the maximum upload filesize this extension will accept. when set to 0,
	 * the wiki’s $wgMaxUploadSize is used
	 */
	public static $max_upload_filesize = 0;

	/**
	 * the user group the user must be a member of in order to be able to use this extension
	 * @see GWToolset\Helpers\WikiChecks\checkUserWikiGroups
	 */
	public static $user_group = 'gwtoolset';

	/**
	 * user permissions required in order to be able to use this extension
	 * @see GWToolset\Helpers\WikiChecks\checkUserPermissions
	 */
	public static $user_permissions = array( 'upload', 'upload_by_url', 'edit' );

	/**
	 * tells the upload form to place the $accepted_mime_types in a comma
	 * delimited list in the input file’s accept attribute
	 */
	public static $use_file_accept_attribute = true;

	/**
	 * which extension/mimetype combinations should the extension accept
	 * for mapping files
	 */
	public static $accepted_mapping_types = array(
		'json' => array( 'application/json' )
	);

	/**
	 * which extension/mimetype combinations should the extension accept
	 * for media files
	 */
	public static $accepted_media_types = array(
		'jpg' => array( 'image/jpeg' ),
		'pdf' => array( 'application/pdf' )
	);

	/**
	 * which extension/mimetype combinations should the extension accept
	 * for metadata files
	 */
	public static $accepted_metadata_types = array(
		'xml' => array( 'text/xml', 'application/xml' )
	);

	/**
	 * which MediaWiki Templates are allowed for mapping
	 */
	public static $allowed_templates = array(
		'Artwork',
		'Book',
		'Musical work',
		'Photograph',
		'Specimen'
	);

	public static $category_separator = '|';
	public static $metadata_separator = '; ';
	public static $title_separator = '-';

	/**
	 * note that this mapping tag has a hardcoded pregmatch in
	 * GWToolset/includes/Adapters/Api/MappingApiAdapter.php
	 * that needs to change if this value changes
	 */
	public static $metadata_mapping_open_tag = '<mapping_json>';
	public static $metadata_mapping_close_tag = '</mapping_json>';

	// wiki namespace to store metadata mappings and data sets
	public static $metadata_namespace = 'GWToolset:';

	// wiki namespace to store metadata mappings and data sets
	public static $mediafile_namespace = 'File:';

	// sub directory used to place saved metadata mappings
	public static $metadata_mapping_subdirectory = 'Metadata Mappings';

	// sub directory used to place saved metadata sets
	public static $metadata_sets_subdirectory = 'Metadata Sets';

	// category automatically assigned to saved metadata mappings
	public static $metadata_mapping_category = 'GWToolset Metadata Mappings';

	// category automatically added to items uploaded by GWToolset
	public static $mediawiki_template_default_category = 'GWToolset Batch Upload';

	// category automatically assigned to metadata files uploaded by GWToolset
	public static $metadata_file_category = 'GWToolset Metadata Sets';

	// Category:Source_templates is the category on commons for partner templates
	public static $source_templates = 'Source templates';

	public static $job_throttle = 3;

	public static $preview_throttle = 3;

	// 20 minutes, 25 seconds default
	public static $http_timeout = 1200;

	// 12500000 default
	public static $max_image_area = 64000000;

	// 128M default
	public static $memory_limit = '256M';
}
