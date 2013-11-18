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

// load extension functions
require_once $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions.php';

// add autoloader classes
$wgAutoloadClasses['GWToolset\Config'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Config.php';
$wgAutoloadClasses['GWToolset\Constants'] =	$wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Constants.php';
$wgAutoloadClasses['GWToolset\GWTException'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'GWTException.php';
$wgAutoloadClasses['GWToolset\Adapters\DataAdapterInterface'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Adapters' . DIRECTORY_SEPARATOR . 'DataAdapterInterface.php';
$wgAutoloadClasses['GWToolset\Adapters\Php\MappingPhpAdapter'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Adapters' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'MappingPhpAdapter.php';
$wgAutoloadClasses['GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Adapters' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'MediawikiTemplatePhpAdapter.php';
$wgAutoloadClasses['GWToolset\Adapters\Php\MetadataPhpAdapter'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Adapters' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'MetadataPhpAdapter.php';
$wgAutoloadClasses['GWToolset\Forms\MetadataDetectForm'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'MetadataDetectForm.php';
$wgAutoloadClasses['GWToolset\Forms\MetadataMappingForm'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'MetadataMappingForm.php';
$wgAutoloadClasses['GWToolset\Forms\PreviewForm'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'PreviewForm.php';
$wgAutoloadClasses['GWToolset\Handlers\Forms\FormHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'FormHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\Forms\MetadataDetectHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'MetadataDetectHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\Forms\MetadataMappingHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Forms' . DIRECTORY_SEPARATOR . 'MetadataMappingHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\SpecialPageHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'SpecialPageHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\UploadHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'UploadHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\Xml\XmlDetectHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Xml' . DIRECTORY_SEPARATOR . 'XmlDetectHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\Xml\XmlHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Xml' . DIRECTORY_SEPARATOR . 'XmlHandler.php';
$wgAutoloadClasses['GWToolset\Handlers\Xml\XmlMappingHandler'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Xml' . DIRECTORY_SEPARATOR . 'XmlMappingHandler.php';
$wgAutoloadClasses['GWToolset\Helpers\FileChecks'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'FileChecks.php';
$wgAutoloadClasses['GWToolset\Helpers\GWTFileBackend'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'GWTFileBackend.php';
$wgAutoloadClasses['GWToolset\Helpers\WikiChecks'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'WikiChecks.php';
$wgAutoloadClasses['GWToolset\Helpers\WikiPages'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'WikiPages.php';
$wgAutoloadClasses['GWToolset\Hooks'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Hooks' . DIRECTORY_SEPARATOR . 'Hooks.php';
$wgAutoloadClasses['GWToolset\Jobs\GWTFileBackendCleanupJob'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Jobs' . DIRECTORY_SEPARATOR . 'GWTFileBackendCleanupJob.php';
$wgAutoloadClasses['GWToolset\Jobs\UploadMediafileJob'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Jobs' . DIRECTORY_SEPARATOR . 'UploadMediafileJob.php';
$wgAutoloadClasses['GWToolset\Jobs\UploadMetadataJob'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Jobs' . DIRECTORY_SEPARATOR . 'UploadMetadataJob.php';
$wgAutoloadClasses['GWToolset\Models\Mapping'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Mapping.php';
$wgAutoloadClasses['GWToolset\Models\MediawikiTemplate'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'MediawikiTemplate.php';
$wgAutoloadClasses['GWToolset\Models\Metadata'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Metadata.php';
$wgAutoloadClasses['GWToolset\Models\ModelInterface'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'ModelInterface.php';
$wgAutoloadClasses['GWToolset\SpecialGWToolset'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Specials' . DIRECTORY_SEPARATOR . 'SpecialGWToolset.php';
$wgAutoloadClasses['Php\File'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'File.php';
$wgAutoloadClasses['Php\FileException'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'FileException.php';
$wgAutoloadClasses['Php\Filter'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'Filter.php';
$wgAutoloadClasses['Php\FilterException'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Php' . DIRECTORY_SEPARATOR . 'FilterException.php';

// add internationalization message file references
$wgExtensionMessagesFiles['GWToolsetAlias'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'GWToolset.alias.php';
$wgExtensionMessagesFiles['GWToolset'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'GWToolset.i18n.php';
$wgExtensionMessagesFiles['GWToolsetNamespaces'] = $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'GWToolset.namespaces.php';

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
