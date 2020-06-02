<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset;

use GWToolset\Helpers\GWTFileBackend;
use Maintenance;
use MWException;

$IP = getenv( 'MW_INSTALL_PATH' );
if ( $IP === false ) {
	$IP = __DIR__ . '/../../..';
}
require_once "$IP/maintenance/Maintenance.php";

/**
 * Maintenance script to remove abandoned or outdated metadata files from the temporary
 * gwtoolset file storage. These files are normally removed by
 * GWToolset\Jobs\GWTFileBackendCleanupJob, however if a user stops the GWToolset upload process
 * or the clean-up job fails to run, some files may become orphaned.
 *
 * @ingroup Maintenance
 */
class GWTFileBackendCleanup extends Maintenance {

	public function __construct() {
		parent::__construct();
		$this->addDescription( 'Clean up abandoned files in the GWTFileBackend.' );
		$this->requireExtension( 'GWToolset' );
	}

	public function execute() {
		global $wgGWTFileBackend, $wgGWTFBMaxAge;

		$fileBackend = new GWTFileBackend(
			[
				'container' => Config::$filebackend_metadata_container,
				'file-backend-name' => $wgGWTFileBackend
			]
		);

		// how far back should the script look for files to delete?
		// expects an unsigned relative time, e.g., 1 day, 1 week
		$cutoff = strtotime( '-' . $wgGWTFBMaxAge );

		if ( !$cutoff ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-file-backend-maxage-invalid' )->escaped()
					)
					->escaped()
			);
		}

		$this->output(
			'Getting list of files to clean up' . PHP_EOL .
			'...' . PHP_EOL
		);

		$mwstore_path = $fileBackend->getMWStorePath() . '/';

		$fileList = $fileBackend->FileBackend->getFileList(
			[ 'dir' => $mwstore_path, 'adviseStat' => true ]
		);

		$this->output(
			'Removing any files older than (' . $wgGWTFBMaxAge . ')' . PHP_EOL .
			'...' . PHP_EOL
		);

		$file_count = 0;

		foreach ( $fileList as $file ) {
			$mwstore_file_path = $mwstore_path . $file;
			$extension = $fileBackend->FileBackend->extensionFromPath( $file );
			$timestamp = $fileBackend->FileBackend->getFileTimestamp(
				[ 'src' => $mwstore_file_path ]
			);

			if (
				array_key_exists( $extension, Config::$accepted_metadata_types )
				&& wfTimestamp( TS_UNIX, $timestamp ) < $cutoff
			) {
				$status = $fileBackend->deleteFile( $mwstore_file_path );

				if ( !$status->isOK() ) {
					throw new MWException(
						wfMessage( 'gwtoolset-developer-issue' )
							->params(
								__METHOD__ . ': ' .
								$status->getMessage()->text()
							)
							->escaped()
					);
				}

				$this->output( 'Removed file (' . $mwstore_file_path . ')' . PHP_EOL );
				$file_count++;
			}
		}

		$this->output(
			'...' . PHP_EOL .
			'(' . $file_count . ') files deleted' . PHP_EOL
		);
	}
}

$maintClass = GWTFileBackendCleanup::class;
require_once RUN_MAINTENANCE_IF_MAIN;
