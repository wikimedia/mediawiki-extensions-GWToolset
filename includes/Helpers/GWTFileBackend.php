<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Helpers;
use FileBackendGroup,
	GWToolset\Jobs\GWTFileBackendCleanupJob,
	GWToolset\Config,
	GWToolset\Constants,
	GWToolset\Utils,
	JobQueueGroup,
	MWException,
	Php\File,
	Status,
	Title,
	User;

class GWTFileBackend {

	/**
	 * @var {FileBackend}
	 */
	public $FileBackend;

	/**
	 * @var {string}
	 */
	protected $_container;

	/**
	 * @var {string}
	 */
	protected $_file_extension;

	/**
	 * @var {string}
	 */
	protected $_hash;

	/**
	 * @var {User}
	 */
	protected $_User;

	/**
	 * @param {array} $params
	 */
	public function __construct( array $params = array() ) {
		$this->setupFileBackend( $params );

		if ( isset( $params['User'] ) && $params['User'] instanceof User ) {
			$this->_User = $params['User'];
		}
	}

	/**
	 * creates a GWTFileBackendCleanupJob that will delete the mwstore file in the FileBackend
	 *
	 * @param {string} $mwstore_relative_path
	 * @throws {MWException}
	 * @return {bool}
	 */
	public function createCleanupJob( $mwstore_relative_path = null ) {
		$result = false;

		if ( empty( $mwstore_relative_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore-relative-path' ) )
					->parse()
				);
		}

		if ( empty( $this->_User ) ) {
			throw new MWException( wfMessage( 'gwtoolset-no-user' ) );
		}

		$job = new GWTFileBackendCleanupJob(
			Title::newFromText(
				Utils::sanitizeString( $this->_User->getName() ) . '/' .
				Utils::sanitizeString( Constants::EXTENSION_NAME ) . '/' .
				'FileBackend Cleanup Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'gwtoolset-metadata-file-relative-path' => Utils::sanitizeString( $mwstore_relative_path ),
				'user-name' => $this->_User->getName()
			)
		);

		$result = JobQueueGroup::singleton()->push( $job );

		if ( $result ) {
			$result = Status::newGood();
		} else {
			$result = Status::newFatal(
				wfMessage( 'gwtoolset-batchjob-creation-failure' )
					->params( 'GWTFileBackendCleanupJob' )
					->parse()
			);
		}

		return $result;
	}

	/**
	 * deletes a file, based on an mwstore complete file path, from the FileBackend
	 *
	 * @param {string} $mwstore_complete_file_path
	 * @return {Status}
	 */
	public function deleteFile( $mwstore_complete_file_path = null ) {
		$result = Status::newGood();

		if ( empty( $mwstore_complete_file_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore-complete-path' ) )
					->parse()
			);
		}

		$src = array( 'src' => Utils::sanitizeString( $mwstore_complete_file_path ) );

		if ( $this->FileBackend->fileExists( $src ) ) {
			$result = $this->FileBackend->quickDelete( $src );
		} else {
			$result = Status::newFatal( wfMessage( 'gwtoolset-delete-no-file' ) );
		}

		return $result;
	}

	/**
	 * @param {string} $mwstore_relative_path
	 * @throws {MWException}
	 * @return {string}
	 */
	public function deleteFileFromRelativePath( $mwstore_relative_path = null ) {
		if ( empty( $mwstore_relative_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore-relative-path' ) )
					->parse()
			);
		}

		return $this->deleteFile(
			$this->getMWStoreCompleteFilePath( $mwstore_relative_path )
		);
	}

	/**
	 * create a filename based on the md5 hash of the tmp_filename.
	 * add the file extension if it exists
	 *
	 * @return {null|string}
	 */
	protected function getFilename() {
		$result = null;

		if ( !empty( $this->_hash ) ) {
			$result =
				$this->_hash .
				( !empty( $this->_file_extension )
					? '.' . Utils::sanitizeString( $this->_file_extension )
					: null );
		}

		return $result;
	}

	/**
	 * based on the md5 hash of the tmp_filename, create a hash mapped directory structure
	 * using the first 3 characters of the md5 hash
	 *
	 * @return {null|string}
	 */
	protected function getHashPath() {
		$result = null;

		if ( !empty( $this->_hash ) ) {
			$result =
				substr( $this->_hash, 0, 1 ) . '/' .
				substr( $this->_hash, 1, 1 ) . '/' .
				substr( $this->_hash, 2, 1 );
		}

		return $result;
	}

	/**
	 * the complete MWStore path to the file.
	 *
	 * includes:
	 * - root storage path
	 * - container name
	 * - user name
	 * - hash path
	 * - filename
	 *
	 * @param {string} $mwstore_relative_path
	 * should contain:
	 * - hash path
	 * - filename
	 *
	 * @return {string}
	 */
	protected function getMWStoreCompleteFilePath( $mwstore_relative_path = null ) {
		if ( !empty( $mwstore_relative_path ) ) {
			return
				$this->getMWStorePath() . '/' .
				$this->getUserPath() . '/' .
				$mwstore_relative_path;
		} else {
			return
				$this->getMWStoreFileDirectory() . '/' .
				$this->getFilename();
		}
	}

	/**
	 * the MWStore directory path to where the file is stored.
	 *
	 * includes
	 * - root storage path
	 * - container name
	 * - user name
	 * - hash path
	 *
	 * @return {string}
	 */
	protected function getMWStoreFileDirectory() {
		return
			$this->getMWStorePath() . '/' .
			$this->getUserPath() . '/' .
			$this->getHashPath();
	}

	/**
	 * includes:
	 * - root storage path
	 * - container name
	 *
	 * the User name is used in order to help limit file access and indicate
	 * which user submitted the file.
	 *
	 * @throws {MWException}
	 * @return {string}
	 */
	public function getMWStorePath() {
		$result = $this->FileBackend->getRootStoragePath();

		if ( !empty( $this->_container ) ) {
			$result .= '/' . $this->_container;
		}

		return $result;
	}

	/**
	 * includes:
	 * - hash path
	 * - filename
	 *
	 * @return {string}
	 */
	public function getMWStoreRelativePath() {
		return
			$this->getHashPath() . '/' .
			$this->getFilename();
	}

	/**
	 * includes:
	 * - user name
	 *
	 * @throws {MWException}
	 */
	protected function getUserPath() {
		if ( empty( $this->_User ) ) {
			throw new MWException( wfMessage( 'gwtoolset-no-user' ) );
		}

		return wfStripIllegalFilenameChars( $this->_User->getName() );
	}

	/**
	 * create any containers/directories as needed
	 *
	 * @return {Status}
	 */
	protected function prepare() {
		return $this->FileBackend->prepare(
			array(
				'dir' => $this->getMWStoreFileDirectory(),
				'noAccess' => true,
				'noListing' => true
			)
		);
	}

	/**
	 * store the file at the final storage path
	 *
	 * @param {string} $tmp_file_path
	 * the temporary file path location of the src file to be stored in the FileBackend
	 *
	 * @return {Status}
	 */
	protected function quickStore( $tmp_file_path = null ) {
		$params = array(
			'src' => Utils::sanitizeString( $tmp_file_path ),
			'dst' => Utils::sanitizeString( $this->getMWStoreCompleteFilePath() )
		);

		return $this->FileBackend->quickStore( $params );
	}

	/**
	 * retrieves a file, based on an mwstore complete file path, from the FileBackend
	 *
	 * @param {string} $mwstore_complete_file_path
	 * @throws {MWException}
	 * @return {null|FSFile}
	 */
	public function retrieveFile( $mwstore_complete_file_path = null ) {
		$result = null;

		if ( empty( $mwstore_complete_file_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore-complete-path' ) )
					->parse()
			);
		}

		$src = array( 'src' => Utils::sanitizeString( $mwstore_complete_file_path ) );

		if ( $this->FileBackend->fileExists( $src ) ) {
			if ( $this->FileBackend->getFileSize( $src ) === 0 ) {
				$this->FileBackend->quickDelete( $src );

				throw new MWException(
					wfMessage( 'gwtoolset-developer-issue' )
						->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-fsfile-empty' )->parse() )
						->parse()
				);
			}

			$result = $this->FileBackend->getLocalReference( $src );
		}

		return $result;
	}

	/**
	 * @param {string} $mwstore_relative_path
	 * @throws {MWException}
	 * @return {null|FSFile}
	 */
	public function retrieveFileFromRelativePath( $mwstore_relative_path = null ) {
		if ( empty( $mwstore_relative_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore-relative-path' ) )
					->parse()
			);
		}

		return $this->retrieveFile(
			$this->getMWStoreCompleteFilePath( $mwstore_relative_path )
		);
	}

	/**
	 * saves the file to the FileBackend
	 *
	 * @see http://www.php.net/manual/en/datetime.formats.relative.php
	 *
	 * @param {File} $File
	 * @throws {MWException}
	 * @return {null|string}
	 */
	public function saveFile( File $File ) {
		$result = null;

		if ( empty( $File ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-file' )->parse() )
					->parse()
			);
		}

		$this->setHash( $File->tmp_name );
		$this->setFileExtension( $File->pathinfo['extension'] );
		$Status = $this->prepare();

		if ( !$Status->ok ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . $Status->getMessage() )
					->parse()
			);
		}

		$Status = $this->quickStore( $File->tmp_name );

		if ( !$Status->ok ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . $Status->getMessage() )
					->parse()
			);
		}

		$result = $this->getMWStoreRelativePath();

		return $result;
	}

	/**
	 * @param {string} $file_extension
	 */
	protected function setFileExtension( $file_extension = null ) {
		$this->_file_extension = $file_extension;
	}

	/**
	 * @param {string} $string
	 */
	protected function setHash( $string ) {
		$this->_hash = md5( $string );
	}

	/**
	 * sets up the file backend
	 *
	 * @param {array} $params
	 */
	protected function setupFileBackend( array $params ) {
		if ( empty( $params['file-backend-name'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-file-backend-name' )->parse() )
					->parse()
			);
		}

		if ( empty( $params['container'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-no-file-backend-container' )->parse()
					)
					->parse()
			);
		}

		$this->FileBackend = FileBackendGroup::singleton()->get(
			Utils::sanitizeString( $params['file-backend-name'] )
		);

		$this->_container = Utils::sanitizeString( $params['container'] );
	}

}
