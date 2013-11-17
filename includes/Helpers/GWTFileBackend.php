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
	JobQueueGroup,
	MWException,
	Php\File,
	Php\Filter,
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
	 * @param {string} $mwstore_path
	 * @throws {MWException}
	 * @return {bool}
	 */
	public function createCleanupJob( $mwstore_path = null ) {
		$result = false;

		if ( empty( $mwstore_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore' ) )
					->parse()
				);
		}

		$job = new GWTFileBackendCleanupJob(
			Title::newFromText(
				Filter::evaluate( $this->_User->getName() ) . '/' .
				Filter::evaluate( Config::$name ) . '/' .
				'FileBackend Cleanup Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'gwtoolset-metadata-file-mwstore' => Filter::evaluate( $mwstore_path )
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
	 * deletes a file, based on an mwstore path, from the FileBackend
	 *
	 * @param {string} $mwstore_file_path
	 * @return {Status}
	 */
	public function deleteFile( $mwstore_file_path = null ) {
		$result = Status::newGood();

		if ( empty( $mwstore_file_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore' ) )
					->parse()
			);
		}

		$src = array( 'src' => Filter::evaluate( $mwstore_file_path ) );

		if ( $this->FileBackend->fileExists( $src ) ) {
			$result = $this->FileBackend->quickDelete( $src );
		} else {
			$result = Status::newFatal( wfMessage( 'gwtoolset-delete-no-file' ) );
		}

		return $result;
	}

	/**
	 * gets path to store hashes in
	 *
	 * @return {null|string} storage directory
	 */
	protected function getHashPath() {
		$result = null;
		$hash_sub_path = $this->getHashSubPath();

		$result =
			$this->FileBackend->getRootStoragePath() . DIRECTORY_SEPARATOR .
			$this->_container;

		if ( !empty( $hash_sub_path ) ) {
			$result .= DIRECTORY_SEPARATOR . $hash_sub_path;
		}

		return $result;
	}

	/**
	 * gets relative directory for this specific hash
	 *
	 * @return {null|string} relative directory
	 */
	protected function getHashSubPath() {
		$result = null;

		if ( !empty( $this->_hash ) ) {
			$result =
				substr( $this->_hash, 0, 1 ) . DIRECTORY_SEPARATOR .
				substr( $this->_hash, 1, 1 ) . DIRECTORY_SEPARATOR .
				substr( $this->_hash, 2, 1 );
		}

		return $result;
	}

	/**
	 * retrieves the mwstore path to the FileBackend file
	 *
	 * @return {string}
	 */
	public function getMWStorePath() {
		return
			$this->getHashPath() . DIRECTORY_SEPARATOR .
			$this->_hash .
			( ( !empty( $this->_file_extension ) )
				? '.' . Filter::evaluate( $this->_file_extension )
				: null );
	}

	/**
	 * create any containers/directories as needed
	 *
	 * @return {Status}
	 */
	protected function prepare() {
		return $this->FileBackend->prepare(
			array(
				'dir' => $this->getHashPath(),
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
			'src' => Filter::evaluate( $tmp_file_path ),
			'dst' => Filter::evaluate( $this->getMWStorePath() )
		);

		return $this->FileBackend->quickStore( $params );
	}

	/**
	 * retrieves a file, based on an mwstore path, from the FileBackend
	 *
	 * @param {string} $mwstore_file_path
	 * @throws {MWException}
	 * @return {null|FSFile}
	 */
	public function retrieveFile( $mwstore_file_path = null ) {
		$result = null;

		if ( empty( $mwstore_file_path ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( __METHOD__ . ': ' . wfMessage( 'gwtoolset-no-mwstore' ) )
					->parse()
			);
		}

		$src = array( 'src' => Filter::evaluate( $mwstore_file_path ) );

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

		$result = $this->getMWStorePath();

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
			Filter::evaluate( $params['file-backend-name'] )
		);

		$this->_container = Filter::evaluate( $params['container'] );
	}

}
