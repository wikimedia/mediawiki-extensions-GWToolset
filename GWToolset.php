<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 https://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;

use GWToolset\Constants;

if ( !defined( 'MEDIAWIKI' ) ) {
	echo 'This file is part of a MediaWiki extension; it is not a valid entry point. To install this extension, follow the instructions in the INSTALL file.';
	exit();
}

// load extension constants
require_once __DIR__ . '/includes/Constants.php';

// register extension metadata with MediaWiki
$wgExtensionCredits['media'][] = [
	'author' => [ 'dan entous' ],
	'descriptionmsg' => 'gwtoolset-desc',
	'name' => 'GWToolset',
	'path' => __FILE__,
	'url' => 'https://www.mediawiki.org/wiki/Extension:GWToolset',
	'version' => Constants::EXTENSION_VERSION,
	'license-name' => 'GPL-3.0+'
];

// define namespaces
// @see https://www.mediawiki.org/wiki/Manual:Using_custom_namespaces
// @see https://www.mediawiki.org/wiki/Extension_default_namespaces#GWToolset
if ( !defined( 'NS_GWTOOLSET' ) ) {
	define( 'NS_GWTOOLSET', 490 );
	define( 'NS_GWTOOLSET_TALK', NS_GWTOOLSET + 1 );
}

$wgNamespaceProtection[NS_GWTOOLSET] = [ 'gwtoolset' ];
$wgNamespacesWithSubpages[NS_GWTOOLSET] = true;
$wgNamespacesWithSubpages[NS_GWTOOLSET_TALK] = true;

// add user permissions
$wgAvailableRights[] = 'gwtoolset';
$wgGroupPermissions["gwtoolset"]["gwtoolset"] = true;
$wgGroupPermissions["gwtoolset"]["upload_by_url"] = true;

// add autoloader classes
$wgAutoloadClasses = $wgAutoloadClasses + [
	'GWToolset\Config' => __DIR__ . '/includes/Config.php',
	'GWToolset\GWTException' => __DIR__ . '/includes/GWTException.php',
	'GWToolset\Utils' => __DIR__ . '/includes/Utils.php',
	'GWToolset\Adapters\DataAdapterInterface' => __DIR__ . '/includes/Adapters/DataAdapterInterface.php',
	'GWToolset\Adapters\Php\MappingPhpAdapter' => __DIR__ . '/includes/Adapters/Php/MappingPhpAdapter.php',
	'GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter' => __DIR__ . '/includes/Adapters/Php/MediawikiTemplatePhpAdapter.php',
	'GWToolset\Adapters\Php\MetadataPhpAdapter' => __DIR__ . '/includes/Adapters/Php/MetadataPhpAdapter.php',
	'GWToolset\Forms\MetadataDetectForm' => __DIR__ . '/includes/Forms/MetadataDetectForm.php',
	'GWToolset\Forms\MetadataMappingForm' => __DIR__ . '/includes/Forms/MetadataMappingForm.php',
	'GWToolset\Forms\PreviewForm' => __DIR__ . '/includes/Forms/PreviewForm.php',
	'GWToolset\Handlers\Forms\FormHandler' => __DIR__ . '/includes/Handlers/Forms/FormHandler.php',
	'GWToolset\Handlers\Forms\MetadataDetectHandler' => __DIR__ . '/includes/Handlers/Forms/MetadataDetectHandler.php',
	'GWToolset\Handlers\Forms\MetadataMappingHandler' => __DIR__ . '/includes/Handlers/Forms/MetadataMappingHandler.php',
	'GWToolset\Handlers\UploadHandler' => __DIR__ . '/includes/Handlers/UploadHandler.php',
	'GWToolset\Handlers\Xml\XmlDetectHandler' => __DIR__ . '/includes/Handlers/Xml/XmlDetectHandler.php',
	'GWToolset\Handlers\Xml\XmlHandler' => __DIR__ . '/includes/Handlers/Xml/XmlHandler.php',
	'GWToolset\Handlers\Xml\XmlMappingHandler' => __DIR__ . '/includes/Handlers/Xml/XmlMappingHandler.php',
	'GWToolset\Helpers\FileChecks' => __DIR__ . '/includes/Helpers/FileChecks.php',
	'GWToolset\Helpers\GWTFileBackend' => __DIR__ . '/includes/Helpers/GWTFileBackend.php',
	'GWToolset\Helpers\WikiChecks' => __DIR__ . '/includes/Helpers/WikiChecks.php',
	'GWToolset\Hooks' => __DIR__ . '/includes/Hooks/Hooks.php',
	'GWToolset\Jobs\GWTFileBackendCleanupJob' => __DIR__ . '/includes/Jobs/GWTFileBackendCleanupJob.php',
	'GWToolset\Jobs\UploadMediafileJob' => __DIR__ . '/includes/Jobs/UploadMediafileJob.php',
	'GWToolset\Jobs\UploadMetadataJob' => __DIR__ . '/includes/Jobs/UploadMetadataJob.php',
	'GWToolset\Models\Mapping' => __DIR__ . '/includes/Models/Mapping.php',
	'GWToolset\Models\MediawikiTemplate' => __DIR__ . '/includes/Models/MediawikiTemplate.php',
	'GWToolset\Models\Metadata' => __DIR__ . '/includes/Models/Metadata.php',
	'GWToolset\Models\ModelInterface' => __DIR__ . '/includes/Models/ModelInterface.php',
	'GWToolset\SpecialGWToolset' => __DIR__ . '/includes/Specials/SpecialGWToolset.php',
	'Php\File' => __DIR__ . '/includes/Php/File.php'
];

// add internationalization message file references
$wgExtensionMessagesFiles['GWToolsetAlias'] = __DIR__ . '/GWToolset.alias.php';
$wgMessagesDirs['GWToolset'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['GWToolsetNamespaces'] = __DIR__ . '/GWToolset.namespaces.php';

// setup special page references
$wgSpecialPages['GWToolset'] = 'GWToolset\SpecialGWToolset';

// add hooks
$wgHooks['CanonicalNamespaces'][] = 'GWToolset\Hooks::onCanonicalNamespaces';
$wgHooks['UnitTestsList'][] = 'GWToolset\Hooks::onUnitTestsList';
$wgHooks['CodeEditorGetPageLanguage'][] = 'GWToolset\Hooks::onCodeEditorGetPageLanguage';
$wgHooks['ListDefinedTags'][] = 'GWToolset\Hooks::onListDefinedTags';
$wgHooks['ChangeTagsListActive'][] = 'GWToolset\Hooks::onChangeTagsListActive';

// add jobs
$wgJobClasses['gwtoolsetGWTFileBackendCleanupJob'] = 'GWToolset\Jobs\GWTFileBackendCleanupJob';
$wgJobClasses['gwtoolsetUploadMediafileJob'] = 'GWToolset\Jobs\UploadMediafileJob';
$wgJobClasses['gwtoolsetUploadMetadataJob'] = 'GWToolset\Jobs\UploadMetadataJob';

// register resources with ResourceLoader
$wgResourceModules['ext.GWToolset'] = [
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'GWToolset',
	'scripts' => [
		'resources/js/ext.gwtoolset.js'
	],
	'styles' => [
		'resources/css/ext.gwtoolset.css'
	],
	'messages' => [
		'gwtoolset-back-text-link',
		'gwtoolset-cancel',
		'gwtoolset-create-mapping',
		'gwtoolset-create-prefix',
		'gwtoolset-developer-issue',
		'gwtoolset-loading',
		'gwtoolset-save',
		'gwtoolset-save-mapping',
		'gwtoolset-save-mapping-name',
		'gwtoolset-save-mapping-failed',
		'gwtoolset-save-mapping-succeeded',
		'gwtoolset-step-2-heading'
	],
	'dependencies' => [
		'json',
		'jquery.spinner',
		'jquery.ui.widget',
		'jquery.ui.button',
		'jquery.ui.draggable',
		'jquery.ui.mouse',
		'jquery.ui.position',
		'jquery.ui.resizable',
		'jquery.ui.dialog'
	]
];

// add logging
$wgLogTypes[] = 'gwtoolset';
$wgLogActionsHandlers['gwtoolset/*'] = 'LogFormatter';
