<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Jobs;

use Job;
use GWToolset\Config;
use GWToolset\Helpers\GWTFileBackend;
use GWToolset\GWTException;
use User;

class GWTFileBackendCleanupJob extends Job {

	/**
	 * @param \Title $title
	 * @param bool|array $params
	 */
	public function __construct( $title, $params ) {
		parent::__construct( 'gwtoolsetGWTFileBackendCleanupJob', $title, $params );
	}

	/**
	 * @return bool
	 */
	protected function processJob() {
		$result = true;
		global $wgGWTFileBackend;

		$fileBackend = new GWTFileBackend(
			[
				'container' => Config::$filebackend_metadata_container,
				'file-backend-name' => $wgGWTFileBackend,
				'User' => User::newFromName( $this->params['user-name'] )
			]
		);

		$status = $fileBackend->deleteFileFromRelativePath(
			$this->params['gwtoolset-metadata-file-relative-path']
		);

		if ( !$status->isOK() ) {
			$this->setLastError( __METHOD__ . ': ' . $status->getMessage() );
			$result = false;
		}

		return $result;
	}

	/**
	 * entry point
	 * @return bool
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
	 * @return bool
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
