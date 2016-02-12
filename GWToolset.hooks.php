<?php
/**
 * Hooks for GWToolset extension
 *
 * @file
 * @ingroup Extensions
 */

class GWToolsetHooks {

	/**
	 * Register unit tests
	 */
	public static function onUnitTestsList( array &$files ) {
		$testDir = __DIR__ . '/tests/phpunit/';
		$files = array_merge( $files, glob( "$testDir/*Test.php" ) );
		return true;
	}

}
