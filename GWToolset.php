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

/**
 * If a user tries to access this extension directly,alert the user that this is
 * not a valid entry point to the wiki.
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	echo 'This file is part of a MediaWiki extension; it is not a valid entry point. To install this extension, follow the directions in the INSTALL file.';
	exit();
}

/**
 * set extension directory reference to this directory
 */
$wgGWToolsetDir = realpath( __DIR__ );

/**
 * load extension configuration
 */
require_once $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Config.php';

/**
 * load extension functions
 */
require_once $wgGWToolsetDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions.php';

/**
 * define namespaces
 */
if ( !defined( 'NS_GWTOOLSET' ) ) {
	define( 'NS_GWTOOLSET', 332 );
	define( 'NS_GWTOOLSET_TALK', NS_GWTOOLSET + 1 );
}

/**
 * registering extension metadata with MediaWiki
 */
$wgExtensionCredits[Config::$type][] = array(
	'author' => Config::$author,
	'descriptionmsg' => Config::$descriptionmsg,
	'name' => Config::$name,
	'path' => __FILE__,
	'url' => Config::$url,
	'version' => Config::$version
);

/**
 * add user permissions
 */
$wgGroupPermissions["gwtoolset"]["upload_by_url"] = true;
$wgGroupPermissions['sysop']['gwtoolset-debug'] = true;

/**
 * add autoloader classes
 */
foreach ( Config::$autoloader_classes as $class => $file ) {
	$wgAutoloadClasses[$class] = $wgGWToolsetDir . str_replace( '/', DIRECTORY_SEPARATOR, $file );
}

/**
 * add internationalization message file references
 */
foreach ( Config::$messages as $message => $file ) {
	$wgExtensionMessagesFiles[$message] = $wgGWToolsetDir . str_replace( '/', DIRECTORY_SEPARATOR, $file );
}

/**
 * setup special page references
 */
foreach ( Config::$special_pages as $page => $values ) {
	$wgSpecialPages[$page] = $values['class_name'];

	if ( !empty( $values['group'] ) ) {
		$wgSpecialPageGroups[$page] = $values['group'];
	}
}

/**
 * add hooks
 * not yet used
 */
foreach ( Config::$hooks as $hook => $method ) {
	$wgHooks[$hook][] = $method;
}

/**
 * add jobs
 */
foreach ( Config::$jobs as $job => $method ) {
	$wgJobClasses[$job] = $method;
}

/**
 * register resources with ResourceLoader
 */
Config::$resources['localBasePath'] = $wgGWToolsetDir;
Config::$resources['remoteExtPath'] = 'GWToolset';
$wgResourceModules['ext.GWToolset'] = Config::$resources;
