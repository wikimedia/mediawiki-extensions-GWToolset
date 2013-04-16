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
	Php\FileException;

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
	 * The mime type of the file, if the browser provided this information. An example would be "image/gif". This mime type is however not checked on the PHP side and therefore don't take its value for granted.
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
	 * Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
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
	 * Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0.
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
		$this->reset();
		if ( !empty( $file_field_name ) ) {
			$this->populate( $file_field_name );
		}
	}

	/**
	 * finfo runs a best guess at mime-type and character encoding.
	 * nb: if there are no utf-8 characters present in the file
	 * then it will guess that the encoding is us-ascii
	 *
	 * e.g. of output application/xml; charset=us-ascii
	 *
	 * @return {void}
	 *
	 * @link http://www.php.net/manual/en/function.finfo-file.php
	 * @link http://www.php.net/manual/en/fileinfo.constants.php
	 */
	protected function setMimeType() {
		if ( !class_exists( 'finfo' ) ) {
			return;
		}
		$finfo = new finfo( FILEINFO_MIME_TYPE );
		$this->mime_type = $finfo->file( $this->tmp_name );
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

		if ( !$result ) {
			return false;
		}

		return true;
	}

	/**
	 * @throws {FileException}
	 * @return {void}
	 */
	public function populate( $file_field_name ) {
		$file_field_name = Filter::evaluate( $file_field_name );

		if ( !isset( $_FILES[$file_field_name] ) ) {
			throw new FileException( 'The expected form field [' . $file_field_name . '] does not exist. (Php\File)' );
		}

		$file = $_FILES[$file_field_name];

		if ( empty( $file ) ) {
			throw new FileException( 'The file submitted contains no information; it is most likely an empty file. (Php\File)' );
		}

		if ( isset( $file[0] ) ) {
			throw new FileException( 'The file submitted contains information on more than one file ($_FILES has multiple values). (Php\File)' );
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
			throw new FileException( 'The file submitted does not contain enough information to process the file; it may be empty or you did not select a file to submit. (Php\File)' );
		}

		$this->setIsFileUploaded();
		$this->setPathinfo();
		$this->setMimeType();
	}

	/**
	 * @return {void}
	 */
	public function reset() {
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
