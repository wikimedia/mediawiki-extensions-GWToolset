<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Helpers;
use Exception,
	GWToolset\Config,
	Html,
	PermissionsError,
	SpecialPage,
	Status,
	User,
	UserBlockedError;

/**
 * provides several methods for verifying :
 * - php version & settings
 * - the wiki environment
 * - user access to the wiki
 */
class WikiChecks {

	/**
	 * @var {int}
	 */
	public static $wgMaxImageArea;

	/**
	 * @var {string}
	 */
	public static $memory_limit;

	/**
	 * @var {int}
	 */
	public static $wgHTTPTimeout;

	/**
	 * attempts to make sure certain wiki settings are in place for handling
	 * large media uploads
	 */
	public static function adjustMediaUploadSettings() {
		self::increaseMaxImageArea();
		self::increaseMemoryLimit();
	}

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
		try {
			$SpecialPage->checkPermissions();
		} catch ( PermissionsError $e ) {
			return Status::newFatal( 'gwtoolset-permission-not-given' );
		}

		return Status::newGood();
	}

	/**
	 * checks to see if the wiki’s $wgMaxUploadSize is greater than the PHP ini
	 * settings for upload_max_filesize and post_max_size
	 *
	 * @return {Status}
	 */
	public static function checkMaxUploadAndIniSettings() {
		$max_upload_size = FileChecks::getMaxUploadSize();
		$upload_max_filesize = \GWToolset\getBytes( ini_get('upload_max_filesize') );
		$post_max_size = \GWToolset\getBytes( ini_get('post_max_size') );

		if ( $max_upload_size > $upload_max_filesize
			|| $max_upload_size > $post_max_size
		) {
			return Status::newFatal(
				'gwtoolset-maxuploadsize-exceeds-ini-settings',
				$upload_max_filesize,
				$post_max_size,
				$max_upload_size
			);
		}

		return Status::newGood();
	}

	/**
	 * Make sure the user is a member of a group that can access this extension
	 *
	 * @param {SpecialPage} $SpecialPage
	 * @return {Status}
	 */
	public static function checkUserWikiGroups( SpecialPage $SpecialPage ) {
		if ( !in_array( Config::$user_group, $SpecialPage->getUser()->getEffectiveGroups() ) ) {
			return Status::newFatal( 'gwtoolset-permission-not-given' );
		}

		return Status::newGood();
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
			return Status::newFatal( 'gwtoolset-permission-not-given' );
		}

		return Status::newGood();
	}

	/**
	 * UploadFromUrl & Api->upload timeout on large files that take a long time
	 * to upload without this setting
	 *
	 * wiki default is 25 seconds
	 * e.g., http://academia.lndb.lv/xmlui/bitstream/handle/1/231/k_001_ktl1-1-27.jpg
	 * @todo: what is this limit set to on production?
	 * @todo: does ui need a notice to user about this limitation?
	 *
	 * @retun {void}
	 */
	public static function increaseHTTPTimeout( $timeout = 0 ) {
		global $wgHTTPTimeout;

		if ( empty( $timeout ) ) {
			$timeout = Config::$http_timeout;
		}

		if ( $wgHTTPTimeout < $timeout ) {
			self::$wgHTTPTimeout = $wgHTTPTimeout;
			$wgHTTPTimeout = $timeout;
		}
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @return {void}
	 */
	public static function increaseMaxImageArea( $area = 0 ) {
		global $wgMaxImageArea;

		if ( empty( $area ) ) {
			$area = Config::$max_image_area;
		}

		if ( (int)$wgMaxImageArea < (int)$area ) {
			self::$wgMaxImageArea = (int)$wgMaxImageArea;
			$wgMaxImageArea = (int)$area;
		}
	}

	/**
	 * the following settings need to be checked in order to handle large images
	 *
	 * @return {void}
	 */
	public static function increaseMemoryLimit( $limit = null ) {
		global $wgMemoryLimit;

		if ( empty( $limit ) ) {
			$limit = Config::$memory_limit;
		}

		if ( (int)ini_get( 'memory_limit' ) < (int)$limit ) {
			self::$memory_limit = ini_get( 'memory_limit' );
			ini_set( 'memory_limit', $limit );
		}
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

		$Status = self::verifyPHPVersion();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyCurlExists();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyXMLReaderExists();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyFinfoExists();
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::verifyAPIEnabled();
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

		$Status = self::checkUserWikiGroups( $SpecialPage );
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

		$Status = self::checkMaxUploadAndIniSettings();
		if ( !$Status->ok ) {
			return $Status;
		}

		return $Status;
	}

	/**
	 * @return {void}
	 */
	public static function restoreHTTPTimeout() {
		global $wgHTTPTimeout;

		if ( !empty( self::$wgHTTPTimeout )
			&& $wgHTTPTimeout !== self::$wgHTTPTimeout
		) {
			$wgHTTPTimeout = self::$wgHTTPTimeout; // 20 minutes, 25 seconds default
		}
	}

	/**
	 * @return {void}
	 */
	public static function restoreMaxImageArea() {
		global $wgMaxImageArea;

		if ( !empty( self::$wgMaxImageArea )
			&& $wgMaxImageArea !== self::$wgMaxImageArea
		) {
			$wgMaxImageArea = self::$wgMaxImageArea; // 12500000 default
		}
	}

	/**
	 * @return {void}
	 */
	public static function restoreMemoryLimit() {
		if ( !empty( self::$memory_limit )
			&& (int)ini_get( 'memory_limit' ) !== (int)self::$memory_limit
		) {
			ini_set( 'memory_limit', self::$memory_limit ); // 128M default
		}
	}

	/**
	 * @return {Status}
	 */
	public static function uploadsEnabled() {
		global $wgEnableUploads;

		if ( !$wgEnableUploads || ( !wfIsHipHop() && !wfIniGetBool( 'file_uploads' ) ) ) {
			return Status::newFatal( 'gwtoolset-verify-uploads-enabled', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyAPIEnabled() {
		global $wgEnableAPI;

		if ( !$wgEnableAPI ) {
			return Status::newFatal( 'gwtoolset-verify-api-enabled', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyAPIWritable() {
		global $wgEnableWriteAPI;

		if ( !$wgEnableWriteAPI ) {
			return Status::newFatal( 'gwtoolset-verify-api-writeable', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyCurlExists() {
		if ( !function_exists( 'curl_init' ) ) {
			return Status::newFatal( 'gwtoolset-verify-curl', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyFinfoExists() {
		if ( !class_exists( 'finfo' ) ) {
			return Status::newFatal( 'gwtoolset-verify-finfo', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyPHPVersion() {
		if ( !defined( 'PHP_VERSION' )
			|| version_compare( PHP_VERSION, '5.3.3', '<' )
		) {
			return Status::newFatal( 'gwtoolset-verify-php-version', Config::$name );
		}

		return Status::newGood();
	}

	/**
	 * @return {Status}
	 */
	public static function verifyXMLReaderExists() {
		if ( !class_exists( 'XMLReader' ) ) {
			return Status::newFatal( 'gwtoolset-verify-xmlreader', Config::$name );
		}

		return Status::newGood();
	}
}
