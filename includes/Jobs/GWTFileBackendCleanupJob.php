<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Jobs;
use Job,
	GWToolset\Config,
	GWToolset\Helpers\GWTFileBackend,
	GWToolset\GWTException,
	User;

class GWTFileBackendCleanupJob extends Job {

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 */
	public function __construct( $title, $params, $id = 0 ) {
		parent::__construct( 'gwtoolsetGWTFileBackendCleanupJob', $title, $params, $id );
	}

	/**
	 * @return {bool}
	 */
	protected function processJob() {
		$result = true;
		global $wgGWTFileBackend;

		$GWTFileBackend = new GWTFileBackend(
			array(
				'container' => Config::$filebackend_metadata_container,
				'file-backend-name' => $wgGWTFileBackend,
				'User' => User::newFromName( $this->params['user-name'] )
			)
		);

		$Status = $GWTFileBackend->deleteFileFromRelativePath(
			$this->params['gwtoolset-metadata-file-relative-path']
		);

		if ( !$Status->ok ) {
			$this->setLastError( __METHOD__ . ': ' . $Status->getMessage() );
			$result = false;
		}

		return $result;
	}

	/**
	 * entry point
	 * @return {bool}
	 */
	public function run() {
		$result = false;

		if ( !$this->validateParams() ) {
			return $result;
		}

		try {
			$result = $this->processJob();
		} catch ( GWTException $e ) {
			$this->setLastError( __METHOD__ . ': ' . $e->getMessage() );
		}

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function validateParams() {
		$result = true;

		if ( empty( $this->params['gwtoolset-metadata-file-relative-path'] ) ) {
			$this->setLastError(
				__METHOD__ . ': no $this->params[\'gwtoolset-metadata-file-relative-path\'] provided'
			);
			$result = false;
		}

		if ( empty( $this->params['user-name'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'user-name\'] provided' );
			$result = false;
		}

		return $result;
	}
}
