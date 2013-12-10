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
	JobQueueGroup,
	GWToolset\Config,
	GWToolset\Constants,
	GWToolset\GWTException,
	GWToolset\Handlers\Forms\MetadataMappingHandler,
	MWException,
	Title,
	User;

/**
 * runs the MetadataMappingHandler with the originally $_POST’ed form fields when
 * the job was created. the $_POST contains one or more of the following,
 * which are used to create uploadMediafileJobs via the MetadataMappingHandler:
 *
 *   - mediawiki template to use
 *   - url to the metadata source in the wiki
 *   - the metadata mapping to use
 *   - categories to add to the media files
 *   - partner template to use
 *   - summary to use
 */
class UploadMetadataJob extends Job {

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 */
	public function __construct( $title, $params, $id = 0 ) {
		parent::__construct( 'gwtoolsetUploadMetadataJob', $title, $params, $id );
	}

	/**
	 * a control method for re-establishing application state so that the metadata can be processed
	 *
	 * @return {bool|Title}
	 */
	protected function processMetadata() {
		$result = false;

		$MetadataMappingHandler = new MetadataMappingHandler(
			array( 'User' => User::newFromName( $this->params['user-name'] ) )
		);

		$result = $MetadataMappingHandler->processRequest( $this->params['whitelisted-post'] );

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function recreateMetadataJob() {
		$result = false;

		if ( (int)$this->params['attempts'] > (int)Config::$metadata_job_max_attempts ) {
			throw new MWException(
				'There is a serious problem with the gwtoolsetUploadMediafileJob job queue' .
				'There are > ' . Config::$mediafile_job_queue_max . ' gwtoolsetUploadMediafileJob’s ' .
				'in the job queue. gwtoolsetUploadMetadataJob has attempted ' .
				Config::$metadata_job_max_attempts . ' times to add additional ' .
				'gwtoolsetUploadMediafileJob’s to the job queue, but cannot because the ' .
				'gwtoolsetUploadMediafileJob’s are not clearing out.'
			);
		}

		$job = new UploadMetadataJob(
			Title::newFromText(
				User::newFromName( $this->params['user-name'] ) . '/' .
				Constants::EXTENSION_NAME . '/' .
				'Metadata Batch Job/' .
				uniqid(),
				NS_USER
			),
			array(
				'attempts' => (int)$this->params['attempts'] + 1,
				'user-name' => $this->params['user-name'],
				'whitelisted-post' => $this->params['whitelisted-post']
			)
		);

		$delayed_enabled =
			JobQueueGroup::singleton()
			->get( 'gwtoolsetUploadMetadataJob' )
			->delayedJobsEnabled();

		if ( $delayed_enabled ) {
			$job->params['jobReleaseTimestamp'] = strtotime(
				'+' . Utils::sanitizeString( Config::$metadata_job_delay )
			);
		}

		$result = JobQueueGroup::singleton()->push( $job );
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

		$job_queue_size = JobQueueGroup::singleton()->get( 'gwtoolsetUploadMediafileJob' )->getSize();

		// make sure the overall job queue does not have > Config::$mediafile_job_queue_max
		// gwtoolsetUploadMediafileJob’s. if it does, re-create the UploadMetadataJob
		// in order to try again later to add the UploadMediafileJob’s
		if ( (int)$job_queue_size > (int)Config::$mediafile_job_queue_max ) {
			$result = $this->recreateMetadataJob();

			if ( !$result ) {
				$this->setLastError(
					__METHOD__ . ': ' .
					wfMessage( 'gwtoolset-batchjob-metadata-creation-failure' )->escaped()
				);
			}

			return $result;
		}

		try {
			$result = $this->processMetadata();
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

		if ( empty( $this->params['attempts'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'attempts\'] provided' );
			$result = false;
		}

		if ( empty( $this->params['user-name'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'user-name\'] provided' );
			$result = false;
		}

		if ( empty( $this->params['whitelisted-post'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'whitelisted-post\'] provided' );
			$result = false;
		}

		return $result;
	}
}
