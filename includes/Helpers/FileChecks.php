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
use GWToolset\GWTException;
use GWToolset\Utils;
use MWException;
use Php\File;
use Status;
use UploadBase;

/**
 * @todo: examine other checks in baseupload - detectVirus
 * @todo: examine other checks in baseupload - detectScript
 * @todo: examine other checks in baseupload - detectScriptInSvg
 * @todo: examine other checks in baseupload - mJavaDetected
 */
class FileChecks {

	public static $current_extension;

	/**
	 * Check php.ini max_post_size isn't exceeded.
	 *
	 * @note upload_max_filesize is checked separately in Handlers/UploadHandler.php
	 * @throws GWTException
	 */
	public static function checkMaxPostSize() {
		if ( isset( $_SERVER["CONTENT_LENGTH"] )
			&& Utils::getBytes( ini_get( 'post_max_size' ) ) > 0
			&& ( (int)$_SERVER["CONTENT_LENGTH"] > Utils::getBytes( ini_get( 'post_max_size' ) ) )
		) {
			throw new GWTException( 'gwtoolset-over-max-ini' );
		}
	}

	/**
	 * @param File $file
	 * @return Status
	 */
	public static function fileWasUploaded( File $file ) {
		if ( !$file->is_uploaded_file ) {
			return Status::newFatal( 'gwtoolset-improper-upload' );
		}

		return Status::newGood();
	}

	/**
	 * @param array $accepted_types
	 * expected format 'extension' => array('mime/type','mime2/type2')
	 *
	 * @return array
	 */
	public static function getAcceptedExtensions( array $accepted_types = [] ) {
		return array_keys( $accepted_types );
	}

	/**
	 * returns the accepted file extensions this wiki extension accepts.
	 *
	 * @param array $accepted_types
	 * expected format 'file-extension' => array('mime/type','mime2/type2')
	 *
	 * @return string
	 * the string is filtered
	 * a comma delimited list of accepted file extensions
	 */
	public static function getAcceptedExtensionsAsList( array $accepted_types = [] ) {
		$result = null;

		if ( !empty( $accepted_types ) ) {
			// @todo FIXME: i18n issue: Use Language::listToText()
			$result = Utils::sanitizeString(
				implode( ', ', self::getAcceptedExtensions( $accepted_types ) )
			);
		}

		return $result;
	}

	/**
	 * @param array $accepted_types
	 * expected format 'extension' => array('mime/type','mime2/type2')
	 *
	 * @return array
	 */
	public static function getAcceptedMimeTypes( array $accepted_types = [] ) {
		return array_unique( Utils::getArraySecondLevelValues( $accepted_types ) );
	}

	/**
	 * returns the accept attribute for <input type="file" accept="">
	 * populated with file mime types the extension accepts.
	 *
	 * @param array $accepted_types
	 * expected format 'file-extension' => array('mime/type','mime2/type2')
	 *
	 * @return string
	 * the string is filtered
	 * a comma delimited list of accepted file mime types
	 */
	public static function getFileAcceptAttribute( array $accepted_types = [] ) {
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
	 * @param null|string $forType
	 * @return int
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
	 * @param string|File $file
	 * @param array $accepted_extensions
	 * @return Status
	 */
	public static function isAcceptedFileExtension( $file, array $accepted_extensions = [] ) {
		$msg = null;
		$extension = null;

		if ( $file instanceof File ) {
			$extension = Utils::sanitizeString( strtolower( $file->pathinfo['extension'] ) );
		} else {
			$pathinfo = pathinfo( $file );

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
	 * @param File $file
	 * @param array $accepted_mime_types
	 * @return Status
	 */
	public static function isAcceptedMimeType( File $file, array $accepted_mime_types = [] ) {
		if ( !in_array( $file->mime_type, $accepted_mime_types ) ) {
			if ( self::$current_extension === 'xml' ) {
				return Status::newFatal(
					'gwtoolset-unaccepted-mime-type-for-xml',
					Utils::sanitizeString( $file->mime_type ),
					'<?xml version="1.0" encoding="UTF-8"?>'
				);
			} else {
				return Status::newFatal(
					'gwtoolset-unaccepted-mime-type',
					Utils::sanitizeString( $file->mime_type )
				);
			}
		}

		return Status::newGood();
	}

	/**
	 * @param File $file
	 * @return Status
	 */
	public static function isFileEmpty( File $file ) {
		if ( $file->size === 0 ) {
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
	 * currently tests metadata file upload only.
	 *
	 * @param File $file
	 * @param array $accepted_types
	 * @throws MWException
	 * @return Status
	 */
	public static function isUploadedFileValid( File $file, array $accepted_types = [] ) {
		if ( empty( $accepted_types ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						wfMessage( 'gwtoolset-no-accepted-types' )
							->escaped()
					)->parse()
			);
		}

		$status = self::isFileEmpty( $file );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::noFileErrors( $file );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::fileWasUploaded( $file );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::isAcceptedFileExtension(
			$file, self::getAcceptedExtensions( $accepted_types )
		);
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::isAcceptedMimeType( $file, self::getAcceptedMimeTypes( $accepted_types ) );
		if ( !$status->isOK() ) {
			return $status;
		}

		$status = self::mimeTypeAndExtensionMatch( $file );
		if ( !$status->isOK() ) {
			return $status;
		}

		return $status;
	}

	/**
	 * currently tests metadata file upload only.
	 *
	 * @param File $file
	 * @return Status
	 */
	public static function mimeTypeAndExtensionMatch( File $file ) {
		if ( !isset( $file->pathinfo['extension'] ) || empty( $file->pathinfo['extension'] ) ) {
			return Status::newFatal( 'gwtoolset-unaccepted-extension' );
		}

		$mime_type_extension_match = \MediaWiki\MediaWikiServices::getInstance()->getMimeAnalyzer()
			->isMatchingExtension( $file->pathinfo['extension'], $file->mime_type );

		if ( !$mime_type_extension_match ) {
			return Status::newFatal(
				'gwtoolset-mime-type-mismatch',
				Utils::sanitizeString( $file->pathinfo['extension'] ),
				Utils::sanitizeString( $file->mime_type )
			);
		}

		return Status::newGood();
	}

	/**
	 * @param File $file
	 * @return Status
	 */
	public static function noFileErrors( File $file ) {
		$msg = null;

		switch ( $file->error ) {
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
