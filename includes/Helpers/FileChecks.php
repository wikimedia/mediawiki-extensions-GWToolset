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
	GWToolset\GWTException,
	GWToolset\Utils,
	MWException,
	Php\File,
	OutputPage,
	Status,
	UploadBase;

/**
 * @todo: examine other checks in baseupload - detectVirus
 * @todo: examine other checks in baseupload - detectScript
 * @todo: examine other checks in baseupload - detectScriptInSvg
 * @todo: examine other checks in baseupload - mJavaDetected
 * @todo: take a look at how MimeMagic.php is working
 */
class FileChecks {

	public static $current_extension;

	/**
	 * @throws {GWTException}
	 */
	public static function checkContentLength() {
		if ( isset( $_SERVER["CONTENT_LENGTH"] )
			&& ( (int)$_SERVER["CONTENT_LENGTH"] > Utils::getBytes( ini_get('post_max_size') )
				|| (int)$_SERVER["CONTENT_LENGTH"] > Utils::getBytes( ini_get('upload_max_filesize') ) )
		) {
			throw new GWTException( 'gwtoolset-over-max-ini' );
		}
	}

	/**
	 * @param {File} $File
	 * @return {Status}
	 */
	public static function fileWasUploaded( File $File ) {
		if ( !$File->is_uploaded_file ) {
			return Status::newFatal( 'gwtoolset-improper-upload' );
		}

		return Status::newGood();
	}

	/**
	 * @param {array} $accepted_types
	 * expected format 'extension' => array('mime/type','mime2/type2')
	 *
	 * @return {array}
	 */
	public static function getAcceptedExtensions( array &$accepted_types = array() ) {
		return array_keys( $accepted_types );
	}

	/**
	 * returns the accepted file extensions this wiki extension accepts.
	 *
	 * @param {array} $accepted_types
	 * expected format 'file-extension' => array('mime/type','mime2/type2')
	 *
	 * @return {string}
	 * the string is filtered
	 * a comma delimited list of accepted file extensions
	 */
	public static function getAcceptedExtensionsAsList( array &$accepted_types = array() ) {
		$result = null;

		if ( !empty( $accepted_types ) ) {
			$result = Utils::sanitizeString(
				implode( ', ', self::getAcceptedExtensions( $accepted_types ) )
			);
		}

		return $result;
	}

	/**
	 * @param {array} $accepted_types
	 * expected format 'extension' => array('mime/type','mime2/type2')
	 *
	 * @return {array}
	 */
	public static function getAcceptedMimeTypes( array &$accepted_types = array() ) {
		return array_unique( Utils::getArraySecondLevelValues( $accepted_types ) );
	}

	/**
	 * returns the accept attribute for <input type="file" accept="">
	 * populated with file mime types the extension accepts.
	 *
	 * @param {array} $accepted_types
	 * expected format 'file-extension' => array('mime/type','mime2/type2')
	 *
	 * @return {string}
	 * the string is filtered
	 * a comma delimited list of accepted file mime types
	 */
	public static function getFileAcceptAttribute( array &$accepted_types = array() ) {
		$result = null;

		if ( !empty( $accepted_types ) && Config::$use_file_accept_attribute ) {
			$result =
				Utils::sanitizeString(
					implode( ', ', self::getAcceptedMimeTypes( $accepted_types ) )
				);
		}

		return $result;
	}

	/**
	 * gets the max file upload size. the value is based on
	 * the lesser of two values : the gwtoolset value, if set,
	 * and the wiki’s setting in $wgMaxUploadSize
	 *
	 * @param {null|string} $forType
	 * @return {int}
	 */
	public static function getMaxUploadSize( $forType = null ) {
		if ( !empty( Config::$max_upload_filesize )
			&& (int)Config::$max_upload_filesize < UploadBase::getMaxUploadSize( $forType )
		) {
			return (int)Config::$max_upload_filesize;
		}

		return (int)UploadBase::getMaxUploadSize( $forType );
	}

	/**
	 * Validates the file extension based on the accepted extensions provided
	 *
	 * @param {string|File} $File
	 * @param {array} $accepted_extensions
	 * @return {Status}
	 */
	public static function isAcceptedFileExtension( &$File, array $accepted_extensions = array() ) {
		$msg = null;
		$extension = null;

		if ( $File instanceof File ) {
			$extension = Utils::sanitizeString( strtolower( $File->pathinfo['extension'] ) );
		} else {
			$pathinfo = pathinfo( $File );

			if ( !isset( $pathinfo['extension'] ) ) {
				$msg = 'gwtoolset-unaccepted-extension';
			} else {
				$extension = Utils::sanitizeString( strtolower( $pathinfo['extension'] ) );
			}
		}

		if ( !isset( $extension ) || empty( $extension ) ) {
			$msg = 'gwtoolset-unaccepted-extension';
		}

		if ( $msg === null && !in_array( $extension, $accepted_extensions ) ) {
			$msg = 'gwtoolset-unaccepted-extension-specific';
		}

		if ( $msg !== null ) {
			return Status::newFatal( $msg, Utils::sanitizeString( $extension ) );
		}

		self::$current_extension = $extension;

		return Status::newGood();
	}

	/**
	 * @param {File} $File
	 * @param {array} $accepted_mime_types
	 * @return {Status}
	 */
	public static function isAcceptedMimeType( File $File, array $accepted_mime_types = array() ) {
		if ( !in_array( $File->mime_type, $accepted_mime_types ) ) {
			if ( self::$current_extension === 'xml' ) {
				return Status::newFatal( 'gwtoolset-unaccepted-mime-type-for-xml', Utils::sanitizeString( $File->mime_type ) );
			} else {
				return Status::newFatal( 'gwtoolset-unaccepted-mime-type', Utils::sanitizeString( $File->mime_type ) );
			}
		}

		return Status::newGood();
	}

	/**
	 * @param {File} $File
	 * @return {Status}
	 */
	public static function isFileEmpty( File $File ) {
		if ( $File->size === 0 ) {
			return Status::newFatal( 'gwtoolset-file-is-empty' );
		}

		return Status::newGood();
	}

	/**
	 * test cases
	 *  - no file sent with the post
	 *  - empty file
	 *  - unaccepted extension
	 *  - bad extension
	 *  - js posing as xml
	 *
	 * @param {File} $File
	 * @param {array} $accepted_types
	 * @throws {MWException}
	 * @return {Status}
	 */
	public static function isUploadedFileValid( File $File, array $accepted_types = array() ) {
		if ( empty( $accepted_types ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-accepted-types' )->escaped( 'gwtoolset-no-accepted-types-provided' ) )
					->parse()
			);
		}

		$Status = self::isFileEmpty( $File );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::noFileErrors( $File );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::fileWasUploaded( $File );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::isAcceptedFileExtension( $File, self::getAcceptedExtensions( $accepted_types ) );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::isAcceptedMimeType( $File, self::getAcceptedMimeTypes( $accepted_types ) );
		if ( !$Status->ok ) {
			return $Status;
		}

		$Status = self::mimeTypeAndExtensionMatch( $File, $accepted_types );
		if ( !$Status->ok ) {
			return $Status;
		}

		return $Status;
	}

	/**
	 * @param {File} $File
	 * @return {Status}
	 */
	public static function mimeTypeAndExtensionMatch( File $File, array $accepted_types = array() ) {
		if ( !isset( $File->pathinfo['extension'] ) || empty( $File->pathinfo['extension'] ) ) {
			return Status::newFatal( 'gwtoolset-unaccepted-extension' );
		}

		if ( !in_array( $File->mime_type, $accepted_types[$File->pathinfo['extension']] ) ) {
			return Status::newFatal(
				'gwtoolset-mime-type-mismatch',
				Utils::sanitizeString( $File->pathinfo['extension'] ),
				Utils::sanitizeString( $File->mime_type )
			);
		}

		return Status::newGood();
	}

	/**
	 * @param {File} $File
	 * @return {Status}
	 */
	public static function noFileErrors( File &$File ) {
		$msg = null;

		switch ( $File->error ) {
			case UPLOAD_ERR_OK:
				break;

			case UPLOAD_ERR_INI_SIZE :
				$msg = 'gwtoolset-over-max-ini';
				break;

			case UPLOAD_ERR_PARTIAL :
				$msg = 'gwtoolset-partial-upload';
				break;

			case UPLOAD_ERR_NO_FILE :
				$msg = 'gwtoolset-no-file';
				break;

			case UPLOAD_ERR_NO_TMP_DIR :
				$msg = 'gwtoolset-missing-temp-folder';
				break;

			case UPLOAD_ERR_CANT_WRITE :
				$msg = 'gwtoolset-disk-write-failure';
				break;

			case UPLOAD_ERR_EXTENSION :
				$msg = 'gwtoolset-php-extension-error';
				break;
		}

		if ( $msg !== null ) {
			return Status::newFatal( $msg );
		}

		return Status::newGood();
	}
}
