<?php

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'GWToolset' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['GWToolset'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['GWToolsetAlias'] = __DIR__ . '/GWToolset.alias.php';
	wfWarn(
		'Deprecated PHP entry point used for GWToolset extension. Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the GWToolset extension requires MediaWiki 1.25+' );
}
