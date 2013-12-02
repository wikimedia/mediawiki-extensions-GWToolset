<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace Php;
use finfo,
	GWToolset\GWTException,
	GWToolset\Utils,
	MimeMagic,
	MWException;

/**
 * @link http://php.net/manual/en/reserved.variables.files.php
 */
class File {

	/**
	 * @var {array}
	 * The original uploaded file array
	 */
	public $original_file_array;

	/**
	 * @var {string}
	 * The original name of the file on the client machine.
	 */
	public $name;

	/**
	 * @var {string}
	 * The mime type of the file, if the browser provided this information.
	 * An example would be "image/gif". This mime type is however not checked on the PHP side
	 * and therefore don't take its value for granted.
	 */
	public $type;

	/**
	 * @var {string}
	 * The size, in bytes, of the uploaded file.
	 */
	public $size;

	/**
	 * @var {string}
	 * The temporary filename of the file in which the uploaded file was stored on the server.
	 */
	public $tmp_name;

	/**
	 * @var {string}
	 * The error code associated with this file upload. This element was added in PHP 4.2.0
	 *
	 * UPLOAD_ERR_OK
	 * Value: 0; There is no error, the file uploaded with success.
	 *
	 * UPLOAD_ERR_FORM_SIZE
	 * Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that
	 * was specified in the HTML form.
	 *
	 * UPLOAD_ERR_PARTIAL
	 * Value: 3; The uploaded file was only partially uploaded.
	 *
	 * UPLOAD_ERR_NO_FILE
	 * Value: 4; No file was uploaded.
	 *
	 * UPLOAD_ERR_NO_TMP_DIR
	 * Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.
	 *
	 * UPLOAD_ERR_CANT_WRITE
	 * Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.
	 *
	 * UPLOAD_ERR_EXTENSION
	 * Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to
	 * ascertain which extension caused the file upload to stop; examining the list of
	 * loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0.
	 */
	public $error;

	/**
	 * @var {bool}
	 * Tells whether the file was uploaded via HTTP POST
	 *
	 * @link http://www.php.net/manual/en/function.is-uploaded-file.php
	 */
	public $is_uploaded_file;

	/**
	 * @var {array}
	 * information about a file path
	 *
	 * @link http://nl3.php.net/manual/en/function.pathinfo.php
	 */
	public $pathinfo;

	/**
	 * @var {string}
	 */
	public $mime_type;

	/**
	 * @param {array} $file
	 * @return {void}
	 */
	public function __construct( $file_field_name = null ) {
		$this->init();

		if ( !empty( $file_field_name ) ) {
			$this->populate( $file_field_name );
		}
	}

	protected function setMimeType() {
		$this->mime_type = MimeMagic::singleton()->guessMimeType(
			$this->tmp_name,
			$this->pathinfo['extension']
		);
	}

	protected function setPathInfo() {
		$this->pathinfo = pathinfo( $this->name );
	}

	protected function setIsFileUploaded() {
		$this->is_uploaded_file = is_uploaded_file( $this->tmp_name );
	}

	/**
	 * @return {bool}
	 */
	protected function isFileInfoComplete() {
		$result = !(
			!isset( $this->error )
			|| empty( $this->name )
			|| !isset( $this->type )
			|| !isset( $this->size )
			|| empty( $this->tmp_name )
		);

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function isPathInfoComplete() {
		$result = !(
			!isset( $this->pathinfo['basename'] )
			|| !isset( $this->pathinfo['dirname'] )
			|| !isset( $this->pathinfo['extension'] )
			|| !isset( $this->pathinfo['filename'] )
		);

		return $result;
	}

	/**
	 * @throws {GWTException|MWException}
	 */
	public function populate( $file_field_name ) {
		$file_field_name = Utils::sanitizeString( $file_field_name );

		if ( !isset( $_FILES[$file_field_name] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-no-form-field' )
					->params( $file_field_name )
					->escaped()
			);
		}

		$file = $_FILES[$file_field_name];

		if ( empty( $file ) ) {
			throw new GWTException( 'gwtoolset-no-file' );
		}

		if ( isset( $file[0] ) ) {
			throw new GWTException( 'gwtoolset-multiple-files' );
		}

		$this->original_file_array = $file;

		if ( isset( $file['error'] ) ) {
			$this->error = $file['error'];
		}

		if ( isset( $file['name'] ) ) {
			$this->name = $file['name'];
		}

		if ( isset( $file['size'] ) ) {
			$this->size = $file['size'];
		}

		if ( isset( $file['tmp_name'] ) ) {
			$this->tmp_name = $file['tmp_name'];
		}

		if ( isset( $file['type'] ) ) {
			$this->type = $file['type'];
		}

		if ( !$this->isFileInfoComplete() ) {
			throw new GWTException( 'gwtoolset-no-file' );
		}

		$this->setIsFileUploaded();
		$this->setPathinfo();

		if ( !$this->isPathInfoComplete() ) {
			throw new GWTException( 'gwtoolset-no-extension' );
		}

		$this->setMimeType();
	}

	public function init() {
		$this->original_file_array = array();
		$this->error = null;
		$this->name = null;
		$this->size = null;
		$this->tmp_name = null;
		$this->type = null;
		$this->is_uploaded_file = false;
		$this->pathinfo = array();
		$this->mime_type = null;
	}

}
