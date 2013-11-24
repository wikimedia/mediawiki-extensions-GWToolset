<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use GWToolset\Helpers\WikiChecks;

if ( !defined( 'MEDIAWIKI' ) ) {
	echo 'This file is part of a MediaWiki extension; it is not a valid entry point. To install this extension, follow the instructions in the INSTALL file.';
	exit();
}

// register extension metadata with MediaWiki
$wgExtensionCredits['media'][] = array(
	'author' => array( 'dan entous' ),
	'descriptionmsg' => 'gwtoolset-desc',
	'name' => 'GWToolset',
	'path' => __FILE__,
	'url' => 'https://www.mediawiki.org/wiki/Extension:GWToolset',
	'version' => '0.0.1-dev'
);

// set extension directory reference to this directory
$wgGWToolsetDir = realpath( __DIR__ );

// define namespaces
// @see http://www.mediawiki.org/wiki/Manual:Using_custom_namespaces
// @see https://www.mediawiki.org/wiki/Extension_default_namespaces#GWToolset
if ( !defined( 'NS_GWTOOLSET' ) ) {
	define( 'NS_GWTOOLSET', 490 );
	define( 'NS_GWTOOLSET_TALK', NS_GWTOOLSET + 1 );
} else {
	echo 'Namespace conflict. Either another extension or configuration has already defined the namespace NS_GWTOOLSET.';
	exit();
}

$wgExtraNamespaces[NS_GWTOOLSET] = 'GWToolset';
$wgExtraNamespaces[NS_GWTOOLSET_TALK] = 'GWToolset_talk';
$wgNamespaceProtection[NS_GWTOOLSET] = array( 'gwtoolset' );
$wgNamespacesWithSubpages[NS_GWTOOLSET] = true;
$wgNamespacesWithSubpages[NS_GWTOOLSET_TALK] = true;

// add user permissions
$wgGroupPermissions["gwtoolset"]["gwtoolset"] = true;
$wgGroupPermissions["gwtoolset"]["upload_by_url"] = true;
$wgGroupPermissions['sysop']['gwtoolset'] = true;
$wgGroupPermissions['sysop']['gwtoolset-debug'] = true;

// add autoloader classes
$wgAutoloadClasses = $wgAutoloadClasses + array(
	'GWToolset\Config' => $wgGWToolsetDir . '/includes/Config.php',
	'GWToolset\Constants' => $wgGWToolsetDir . '/includes/Constants.php',
	'GWToolset\GWTException' => $wgGWToolsetDir . '/includes/GWTException.php',
	'GWToolset\Utils' => $wgGWToolsetDir . '/includes/Utils.php',
	'GWToolset\Adapters\DataAdapterInterface' => $wgGWToolsetDir . '/includes/Adapters/DataAdapterInterface.php',
	'GWToolset\Adapters\Php\MappingPhpAdapter' => $wgGWToolsetDir . '/includes/Adapters/Php/MappingPhpAdapter.php',
	'GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter' => $wgGWToolsetDir . '/includes/Adapters/Php/MediawikiTemplatePhpAdapter.php',
	'GWToolset\Adapters\Php\MetadataPhpAdapter' => $wgGWToolsetDir . '/includes/Adapters/Php/MetadataPhpAdapter.php',
	'GWToolset\Forms\MetadataDetectForm' => $wgGWToolsetDir . '/includes/Forms/MetadataDetectForm.php',
	'GWToolset\Forms\MetadataMappingForm' => $wgGWToolsetDir . '/includes/Forms/MetadataMappingForm.php',
	'GWToolset\Forms\PreviewForm' => $wgGWToolsetDir . '/includes/Forms/PreviewForm.php',
	'GWToolset\Handlers\Forms\FormHandler' => $wgGWToolsetDir . '/includes/Handlers/Forms/FormHandler.php',
	'GWToolset\Handlers\Forms\MetadataDetectHandler' => $wgGWToolsetDir . '/includes/Handlers/Forms/MetadataDetectHandler.php',
	'GWToolset\Handlers\Forms\MetadataMappingHandler' => $wgGWToolsetDir . '/includes/Handlers/Forms/MetadataMappingHandler.php',
	'GWToolset\Handlers\UploadHandler' => $wgGWToolsetDir . '/includes/Handlers/UploadHandler.php',
	'GWToolset\Handlers\Xml\XmlDetectHandler' => $wgGWToolsetDir . '/includes/Handlers/Xml/XmlDetectHandler.php',
	'GWToolset\Handlers\Xml\XmlHandler' => $wgGWToolsetDir . '/includes/Handlers/Xml/XmlHandler.php',
	'GWToolset\Handlers\Xml\XmlMappingHandler' => $wgGWToolsetDir . '/includes/Handlers/Xml/XmlMappingHandler.php',
	'GWToolset\Helpers\FileChecks' => $wgGWToolsetDir . '/includes/Helpers/FileChecks.php',
	'GWToolset\Helpers\GWTFileBackend' => $wgGWToolsetDir . '/includes/Helpers/GWTFileBackend.php',
	'GWToolset\Helpers\WikiChecks' => $wgGWToolsetDir . '/includes/Helpers/WikiChecks.php',
	'GWToolset\Helpers\WikiPages' => $wgGWToolsetDir . '/includes/Helpers/WikiPages.php',
	'GWToolset\Hooks' => $wgGWToolsetDir . '/includes/Hooks/Hooks.php',
	'GWToolset\Jobs\GWTFileBackendCleanupJob' => $wgGWToolsetDir . '/includes/Jobs/GWTFileBackendCleanupJob.php',
	'GWToolset\Jobs\UploadMediafileJob' => $wgGWToolsetDir . '/includes/Jobs/UploadMediafileJob.php',
	'GWToolset\Jobs\UploadMetadataJob' => $wgGWToolsetDir . '/includes/Jobs/UploadMetadataJob.php',
	'GWToolset\Models\Mapping' => $wgGWToolsetDir . '/includes/Models/Mapping.php',
	'GWToolset\Models\MediawikiTemplate' => $wgGWToolsetDir . '/includes/Models/MediawikiTemplate.php',
	'GWToolset\Models\Metadata' => $wgGWToolsetDir . '/includes/Models/Metadata.php',
	'GWToolset\Models\ModelInterface' => $wgGWToolsetDir . '/includes/Models/ModelInterface.php',
	'GWToolset\SpecialGWToolset' => $wgGWToolsetDir . '/includes/Specials/SpecialGWToolset.php',
	'Php\File' => $wgGWToolsetDir . '/includes/Php/File.php',
	'Php\FileException' => $wgGWToolsetDir . '/includes/Php/FileException.php'
);

// add internationalization message file references
$wgExtensionMessagesFiles['GWToolsetAlias'] = $wgGWToolsetDir . '/GWToolset.alias.php';
$wgExtensionMessagesFiles['GWToolset'] = $wgGWToolsetDir . '/GWToolset.i18n.php';
$wgExtensionMessagesFiles['GWToolsetNamespaces'] = $wgGWToolsetDir . '/GWToolset.namespaces.php';

// setup special page references
$wgSpecialPages['GWToolset'] = 'GWToolset\SpecialGWToolset';
$wgSpecialPageGroups['GWToolset'] = 'media';

// add hooks
$wgHooks['CanonicalNamespaces'][] = 'GWToolset\Hooks::onCanonicalNamespaces';
$wgHooks['UnitTestsList'][] = 'GWToolset\Hooks::onUnitTestsList';

// add jobs
$wgJobClasses['gwtoolsetGWTFileBackendCleanupJob'] = 'GWToolset\Jobs\GWTFileBackendCleanupJob';
$wgJobClasses['gwtoolsetUploadMediafileJob'] = 'GWToolset\Jobs\UploadMediafileJob';
$wgJobClasses['gwtoolsetUploadMetadataJob'] = 'GWToolset\Jobs\UploadMetadataJob';

// register resources with ResourceLoader
$wgResourceModules['ext.GWToolset'] = array(
	'localBasePath' => $wgGWToolsetDir,
	'remoteExtPath' => 'GWToolset',
	'scripts' => array(
		'resources/js/ext.gwtoolset.js'
	),
	'styles' => array(
		'resources/css/ext.gwtoolset.css'
	),
	'messages' => array(
		'gwtoolset-back-text-link',
		'gwtoolset-cancel',
		'gwtoolset-create-mapping',
		'gwtoolset-developer-issue',
		'gwtoolset-loading',
		'gwtoolset-save',
		'gwtoolset-save-mapping',
		'gwtoolset-save-mapping-name',
		'gwtoolset-save-mapping-failed',
		'gwtoolset-save-mapping-succeeded',
		'gwtoolset-step-2-heading'
	),
	'dependencies' => array(
		'jquery.json',
		'jquery.spinner',
		'jquery.ui.widget',
		'jquery.ui.button',
		'jquery.ui.draggable',
		'jquery.ui.mouse',
		'jquery.ui.position',
		'jquery.ui.resizable',
		'jquery.ui.dialog'
	)
);
