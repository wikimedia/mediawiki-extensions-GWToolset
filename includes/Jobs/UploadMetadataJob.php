<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Jobs;

use Job;
use JobQueueGroup;
use GWToolset\Config;
use GWToolset\Constants;
use GWToolset\Utils;
use GWToolset\GWTException;
use GWToolset\Handlers\Forms\MetadataMappingHandler;
use MWException;
use Exception;
use Title;
use User;
use RequestContext;
use Wikimedia\ScopedCallback;

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
	 * @var User
	 */
	protected $User;

	/**
	 * @param Title $title
	 * @param bool|array $params
	 * @param int $id
	 */
	public function __construct( $title, $params, $id = 0 ) {
		if ( !isset( $params['session'] ) ) {
			$params['session'] = RequestContext::getMain()->exportSession();
		}
		parent::__construct( 'gwtoolsetUploadMetadataJob', $title, $params, $id );
	}

	/**
	 * a control method for re-establishing application state so that the metadata can be processed
	 *
	 * @return string|array
	 * if an array, an array of Titles
	 */
	protected function processMetadata() {
		$MetadataMappingHandler = new MetadataMappingHandler(
			[ 'User' => $this->User ]
		);

		return $MetadataMappingHandler->processRequest( $this->params['whitelisted-post'], true );
	}

	/**
	 * @throws MWException
	 * @return bool
	 */
	protected function recreateMetadataJob() {
		if ( (int)$this->params['attempts'] > (int)Config::$metadata_job_max_attempts ) {
			$job_release =
				isset( $this->params['jobReleaseTimestamp'] )
				? Utils::sanitizeString( $this->params['jobReleaseTimestamp'] )
				: null;

			$msg = 'There is a problem with the gwtoolsetUploadMediafileJob job queue' .
				'There are > ' . Config::$mediafile_job_queue_max . ' gwtoolsetUploadMediafileJob’s ' .
				'in the job queue. gwtoolsetUploadMetadataJob has attempted ' .
				Config::$metadata_job_max_attempts . ' times to add additional ' .
				'gwtoolsetUploadMediafileJob’s to the job queue, but cannot because the ' .
				'gwtoolsetUploadMediafileJob’s are not clearing out.' . PHP_EOL .
				'metadata job delay: ' . Config::$metadata_job_delay . PHP_EOL .
				'jobReleaseTimestamp: ' . $job_release;

			throw new MWException( $msg );
		}

		$job = new UploadMetadataJob(
			Title::newFromText(
				$this->User . '/' .
				Constants::EXTENSION_NAME . '/' .
				'Metadata Batch Job/' .
				uniqid(),
				NS_USER
			),
			[
				'attempts' => (int)$this->params['attempts'] + 1,
				'user-name' => $this->params['user-name'],
				'whitelisted-post' => $this->params['whitelisted-post']
			]
		);

		$delayed_enabled =
			JobQueueGroup::singleton()
			->get( 'gwtoolsetUploadMetadataJob' )
			->delayedJobsEnabled();

		if ( $delayed_enabled ) {
			$job->params['jobReleaseTimestamp'] = strtotime(
				'+' . Utils::sanitizeString( Config::$metadata_job_attempt_delay )
			);
		}

		JobQueueGroup::singleton()->push( $job );
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

		if ( isset( $this->params['session'] ) ) {
			$sessionScope = RequestContext::importScopedSession( $this->params['session'] );
			$this->addTeardownCallback( function () use ( &$sessionScope ) {
				ScopedCallback::consume( $sessionScope ); // T126450
			} );
		}

		$this->User = User::newFromName( $this->params['user-name'] );
		$job_queue_size = JobQueueGroup::singleton()->get( 'gwtoolsetUploadMediafileJob' )->getSize();

		// make sure the overall job queue does not have > Config::$mediafile_job_queue_max
		// gwtoolsetUploadMediafileJob’s. if it does, re-create the UploadMetadataJob
		// in order to try again later to add the UploadMediafileJob’s
		if ( (int)$job_queue_size > (int)Config::$mediafile_job_queue_max ) {
			$result = true;

			try {
				$this->recreateMetadataJob();
			} catch ( Exception $e ) {
				$result = false;
				$this->setLastError(
					__METHOD__ . ': ' .
					wfMessage( 'gwtoolset-batchjob-metadata-creation-failure' )->escaped() .
					$e->getMessage()
				);
			}

			return $result;
		}

		try {
			$result = $this->processMetadata();
			$message = $result;

			if ( isset( $this->params['whitelisted-post']['gwtoolset-record-begin'] ) ) {
				$message .=
					' ' .
					wfMessage( 'gwtoolset-begin-with' )
						->params( (int)$this->params['whitelisted-post']['gwtoolset-record-begin'] )
						->escaped();
			}
		} catch ( GWTException $e ) {
			$message = $e->getMessage();

			$this->setLastError(
				__METHOD__ . ': ' .
				$message
			);
		}

		$this->specialLog( $message );
		return $result;
	}

	/**
	 * @param string $message
	 */
	protected function specialLog( $message ) {
		$options = [
			'job-subtype' => 'metadata-job',
			'parameters' => [
				'4::message' => $message
			],
			'Title' => Title::newFromText(
				wfMessage( 'gwtoolset-title-none' )->escaped(),
				NS_FILE
			),
			'User' => $this->User
		];

		if ( !empty( $this->params['whitelisted-post']['wpSummary'] ) ) {
			$options['comment'] = $this->params['whitelisted-post']['wpSummary'];
		}

		Utils::specialLog( $options );
	}

	/**
	 * @return bool
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
