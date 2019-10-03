<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Helpers;

use GWToolset\Config;
use GWToolset\Constants;
use GWToolset\Utils;
use SpecialPage;
use Status;

/**
 * provides several methods for verifying :
 * - php version & settings
 * - the wiki environment
 * - user access to the wiki
 */
class WikiChecks {

	/**
	 * Checks if the given user (identified by an object) can execute this
	 * special page (as defined by $mRestriction) sent to the SpecialPage
	 * constructor
	 *
	 * @see SpecialPage::checkPermissions()
	 *
	 * @param SpecialPage $specialPage
	 * @return Status
	 */
	public static function canUserViewPage( SpecialPage $specialPage ) {
		$specialPage->checkPermissions();

		return Status::newGood();
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @param int $max_image_area
	 */
	public static function checkMaxImageArea( $max_image_area = 0 ) {
		global $wgMaxImageArea, $wgUseImageMagick;

		if ( empty( $max_image_area ) ) {
			$max_image_area = Config::$max_image_area;
		}

		if ( (int)$wgMaxImageArea < (int)$max_image_area && !$wgUseImageMagick ) {
			$msg =
				'$wgMaxImageArea is set to ' . (int)$wgMaxImageArea . '. ' .
				'the recommended setting is ' . (int)$max_image_area . ' ' .
				'when ImageMagick is not being used. ' .
				'You may need to set $wgMaxImageArea to the recommended setting in ' .
				'LocalSettings.php.';

			trigger_error( $msg, E_USER_NOTICE );
		}
	}

	/**
	 * attempts to make sure certain wiki settings are in place for handling
	 * large media uploads
	 */
	public static function checkMediaUploadSettings() {
		self::checkMaxImageArea();
		self::checkMemoryLimit();
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @param string|null $memory_limit
	 */
	public static function checkMemoryLimit( $memory_limit = null ) {
		global $wgUseImageMagick;

		if ( empty( $memory_limit ) ) {
			$memory_limit = Config::$memory_limit;
		}

		$memory_limit_in_bytes = wfShorthandToInteger( $memory_limit );
		$php_memory_limit_in_bytes = wfShorthandToInteger( ini_get( 'memory_limit' ) );

		if ( (int)$php_memory_limit_in_bytes < (int)$memory_limit_in_bytes && !$wgUseImageMagick ) {
			$msg =
				'php\'s memory_limit is set to ' . ini_get( 'memory_limit' ) . '. ' .
				'the recommended setting is ' . Utils::sanitizeString( $memory_limit ) . ' ' .
				'when ImageMagick is not being used. ' .
				'You can set php\'s memory_limit to the recommended setting in httpd.conf, ' .
				'httpd-vhosts.conf, php.ini, or .htaccess.';

			trigger_error( $msg, E_USER_NOTICE );
		}
	}

	/**
	 * Make sure the user has all required permissions. It appears that
	 * SpecialPage $restriction must be a string, thus it does not check a
	 * group of permissions.
	 *
	 * @param SpecialPage $specialPage
	 * @return Status
	 */
	public static function checkUserWikiPermissions( SpecialPage $specialPage ) {
		foreach ( Config::$user_permissions as $permission ) {
			if ( !$specialPage->getUser()->isAllowed( $permission ) ) {
				return Status::newFatal( 'gwtoolset-permission-not-given', $permission );
			}
		}

		return Status::newGood();
	}

	/**
	 * For a submitted form, is the edit token present and valid
	 *
	 * @param SpecialPage $specialPage
	 * @return Status
	 */
	public static function doesEditTokenMatch( SpecialPage $specialPage ) {
		if ( !$specialPage->getUser()->matchEditToken(
			$specialPage->getRequest()->getVal( 'wpEditToken' ) )
		) {
			return Status::newFatal(
				'gwtoolset-permission-not-given',
				wfMessage( 'gwtoolset-invalid-token' )->escaped()
			);
		}

		return Status::newGood();
	}

	/**
	 * @param SpecialPage $specialPage
	 * @return Status
	 */
	public static function isUserBlocked( SpecialPage $specialPage ) {
		if ( $specialPage->getUser()->isBlocked() ) {
			return Status::newFatal( 'gwtoolset-user-blocked' );
		}

		return Status::newGood();
	}

	/**
	 * Run through a series of checks to make sure the wiki environment is properly
	 * setup for this extension and that the user has permission to use it
	 *
	 * @param SpecialPage $specialPage
	 * @return Status
	 */
	public static function pageIsReadyForThisUser( SpecialPage $specialPage ) {
		$status = self::uploadsEnabled();
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::canUserViewPage( $specialPage );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::checkUserWikiPermissions( $specialPage );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::isUserBlocked( $specialPage );
		if ( !$status->isOK() ) {
			return $status;
		}

		self::checkMediaUploadSettings();

		return $status;
	}

	/**
	 * @return Status
	 */
	public static function uploadsEnabled() {
		global $wgEnableUploads;

		if ( !$wgEnableUploads || !wfIniGetBool( 'file_uploads' ) ) {
			return Status::newFatal(
				'gwtoolset-verify-uploads-enabled', Constants::EXTENSION_NAME
			);
		}

		return Status::newGood();
	}
}
