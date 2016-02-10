<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Helpers;
use GWToolset\Config,
	GWToolset\Constants,
	GWToolset\Utils,
	MWException,
	SpecialPage,
	Status;

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
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function canUserViewPage( SpecialPage $SpecialPage ) {
		$SpecialPage->checkPermissions();

		return Status::newGood();
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @param {int} $max_image_area
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
	 * @return {Status}
	 */
	public static function checkMediaWikiVersion() {
		global $wgVersion;

		try {
			wfUseMW( Constants::REQUIRED_MEDIAWIKI_VERSION );
		} catch( MWException $e ) {
			return Status::newFatal(
				'gwtoolset-mediawiki-version-invalid',
				Constants::REQUIRED_MEDIAWIKI_VERSION,
				$wgVersion
			);
		}

		return Status::newGood();
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @param {string} $memory_limit
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
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function checkUserWikiPermissions( SpecialPage $SpecialPage ) {
		foreach ( Config::$user_permissions as $permission ) {
			if ( !$SpecialPage->getUser()->isAllowed( $permission ) ) {
				return Status::newFatal( 'gwtoolset-permission-not-given', $permission );
			}
		}

		return Status::newGood();
	}

	/**
	 * For a submitted form, is the edit token present and valid
	 *
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function doesEditTokenMatch( SpecialPage $SpecialPage ) {
		if ( !$SpecialPage->getUser()->matchEditToken( $SpecialPage->getRequest()->getVal( 'wpEditToken' ) ) ) {
			return Status::newFatal(
				'gwtoolset-permission-not-given',
				wfMessage( 'gwtoolset-invalid-token' )->escaped()
			);
		}

		return Status::newGood();
	}

	/**
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function isUserBlocked( SpecialPage $SpecialPage ) {
		if ( $SpecialPage->getUser()->isBlocked() ) {
			return Status::newFatal( 'gwtoolset-user-blocked' );
		}

		return Status::newGood();
	}

	/**
	 * @see SpecialPage::checkReadOnly()
	 *
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function isWikiWriteable( SpecialPage $SpecialPage ) {
		$SpecialPage->checkReadOnly();

		return Status::newGood();
	}

	/**
	 * Run through a series of checks to make sure the wiki environment is properly
	 * setup for this extension and that the user has permission to use it
	 *
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function pageIsReadyForThisUser( SpecialPage $SpecialPage ) {

		$Status = self::verifyXMLReaderExists();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyFinfoExists();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::checkMediaWikiVersion();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyAPIWritable();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::uploadsEnabled();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::isWikiWriteable( $SpecialPage );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::canUserViewPage( $SpecialPage );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::checkUserWikiPermissions( $SpecialPage );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::isUserBlocked( $SpecialPage );
		if ( !$Status->ok ) {
			return $Status;
		}

		self::checkMediaUploadSettings();

		return $Status;
	}


	/**
	 * @return {Status}
	 */
	public static function uploadsEnabled() {
		global $wgEnableUploads;

		if ( !$wgEnableUploads || ( !wfIsHHVM() && !wfIniGetBool( 'file_uploads' ) ) ) {
			return Status::newFatal( 'gwtoolset-verify-uploads-enabled', Constants::EXTENSION_NAME );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyAPIWritable() {
		global $wgEnableWriteAPI;

		if ( !$wgEnableWriteAPI ) {
			return Status::newFatal( 'gwtoolset-verify-api-writeable', Constants::EXTENSION_NAME );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyFinfoExists() {
		if ( !class_exists( 'finfo' ) ) {
			return Status::newFatal( 'gwtoolset-verify-finfo', Constants::EXTENSION_NAME );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyXMLReaderExists() {
		if ( !class_exists( 'XMLReader' ) ) {
			return Status::newFatal( 'gwtoolset-verify-xmlreader', Constants::EXTENSION_NAME );
		}

		return Status::newGood();
	}
}
