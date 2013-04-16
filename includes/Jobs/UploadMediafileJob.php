<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Jobs;
use Exception,
	GWToolset\Handlers\UploadHandler,
	Job,
	User;

class UploadMediafileJob extends Job {

	/**
	 * {UploadHandler}
	 */
	protected $_UploadHandler;

	/**
	 * @var {User}
	 */
	protected $_User;

	/**
	 * @var {string}
	 */
	public $filename_metadata;

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 * @return {void}
	 */
	public function __construct( $title, $params, $id = 0 ) {
		parent::__construct( 'gwtoolsetUploadMediafileJob', $title, $params, $id );
	}

	/**
	 * @return {bool|Title}
	 */
	protected function processMetadata() {
		$result = false;

		$this->_UploadHandler = new UploadHandler(
			array(
				'User' => $this->_User
			)
		);

		$this->_UploadHandler->user_options = $this->params['user_options'];
		$result = $this->_UploadHandler->saveMediafileAsContent( $this->params );

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function validateParams() {
		$result = true;

		if ( empty( $this->params['username'] ) ) {
			error_log( __METHOD__ . ' : no $this->params[\'username\'] provided' . PHP_EOL );
			$result = false;
		}

		if ( empty( $this->params['user_options'] ) ) {
			error_log( __METHOD__ . ' : no $this->params[\'user_options\'] provided' . PHP_EOL );
			$result = false;
		}

		return $result;
	}

	/**
	 * entry point
	 * @todo: should $result always be true?
	 * @return {bool|Title}
	 */
	public function run() {
		$result = false;

		if ( !$this->validateParams() ) {
			return $result;
		}

		$this->_User = User::newFromName( $this->params['username'] );

		try {
			$result = $this->processMetadata();
		} catch ( Exception $e ) {
			error_log( $e->getMessage() );
		}

		if ( !$result ) {
			error_log( "Could not save [ {$this->params['title']} ] to the wiki." );
		}

		return $result;
	}
}
