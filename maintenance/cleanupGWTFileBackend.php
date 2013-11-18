<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use GWToolset\Config,
	GWToolset\Helpers\GWTFileBackend,
	Maintenance,
	MWException;

chdir( '../../../maintenance' );
require_once './Maintenance.php';

/**
 * Maintenance script to remove abandoned or outdated metadata files from the temporary
 * gwtoolset file storage. These files are normally removed by GWToolset\Jobs\GWTFileBackendCleanupJob,
 * however if a user stops the GWToolset upload process or the clean-up job fails to run,
 * some files may become orphaned.
 *
 * @ingroup Maintenance
 */
class GWTFileBackendCleanup extends Maintenance {

	public function __construct() {
		parent::__construct();
		$this->mDescription = 'Clean up abandoned files in the GWTFileBackend.';
	}

	public function execute() {
		global $wgGWTFileBackend, $wgGWTFBMetadataContainer, $wgGWTFBMaxAge;

		$GWTFileBackend = new GWTFileBackend(
			array(
				'file-backend-name' => $wgGWTFileBackend,
				'container' => $wgGWTFBMetadataContainer
			)
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

		$mwstore_path = $GWTFileBackend->getMWStorePath();

		$FSFileBackendFileList = $GWTFileBackend->FileBackend->getFileList(
			array( 'dir' => $mwstore_path, 'adviseStat' => true )
		);

		$this->output(
			'Removing any files older than (' . $wgGWTFBMaxAge . ')' . PHP_EOL .
			'...' . PHP_EOL
		);

		$file_count = 0;

		foreach ( $FSFileBackendFileList as $file ) {
			$mwstore_file_path = $mwstore_path . $file;
			$extension = $GWTFileBackend->FileBackend->extensionFromPath( $file );
			$timestamp = $GWTFileBackend->FileBackend->getFileTimestamp(
				array( 'src' => $mwstore_file_path )
			);

			if (
				key_exists( $extension, Config::$accepted_metadata_types )
				&& wfTimestamp( TS_UNIX, $timestamp ) < $cutoff
			) {
				$Status = $GWTFileBackend->deleteFile( $mwstore_file_path );

				if ( !$Status->isOK() ) {
					throw new MWException(
						wfMessage( 'gwtoolset-developer-issue' )
							->params(
								__METHOD__ . ': ' .
								$Status->getMessage()
							)
							->escaped()
					);
				}

				$this->output( 'Removed file (' . $mwstore_file_path . ')' .PHP_EOL );
				$file_count++;
			}
		}

		$this->output(
			'...' . PHP_EOL .
			'(' . $file_count . ') files deleted' . PHP_EOL
		);
	}
}

$maintClass = 'GWToolset\GWTFileBackendCleanup';
require_once RUN_MAINTENANCE_IF_MAIN;
