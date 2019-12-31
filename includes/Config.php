<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset;

/**
 * these values can be overriden in LocalSettings.php with
 * $wgGWToolsetConfigOverrides['variable_name'] = value;
 */
class Config {

	/**
	 * Updates settings in this class with overrides from LocalSettings
	 */
	public static function mergeOverrides() {
		global $wgGWToolsetConfigOverrides;

		foreach ( $wgGWToolsetConfigOverrides as $setting => $value ) {
			// Intentionally not checking for existence to facilitate migrations
			self::${$setting} = $value;
		}
	}

	/**
	 * @var array
	 * which extension/mimetype combinations should the extension accept
	 * for metadata files
	 */
	public static $accepted_metadata_types = [
		'xml' => [ 'text/xml', 'application/xml' ]
	];

	/**
	 * @var string
	 */
	public static $category_separator = '|';

	/**
	 * @var string
	 */
	public static $filebackend_metadata_container = 'gwtoolset-metadata';

	/**
	 * @var int
	 * 20 minutes, 25 seconds default
	 */
	public static $http_timeout = 1200;

	/**
	 * @var float
	 * 1.25e7 or 12,500,000 default
	 */
	public static $max_image_area = 6.4e7;

	/**
	 * @var int
	 * set in bytes
	 * the maximum upload filesize this extension will accept. when set to 0,
	 * the wiki’s $wgMaxUploadSize is used
	 */
	public static $max_upload_filesize = 0;

	/**
	 * @var int
	 * the number of mediafile jobs to add to the job queue during this run.
	 */
	public static $mediafile_job_throttle_default = 10;

	/**
	 * @var int
	 * a min range for the mediafile job throttle.
	 */
	public static $mediafile_job_throttle_min = 1;

	/**
	 * @var int
	 * a max range for the mediafile job throttle.
	 *
	 * based on an irc chat with chris steipp. his main concern is about someone setting up
	 * files that are near the max upload size, approx 1GB, which would likely dos a server
	 * and use up all of the MediaWiki server’s bandwidth.
	 *
	 * @see https://gerrit.wikimedia.org/r/#/c/101008
	 * @see https://www.assembla.com/spaces/glamwiki/tickets/195-user-controlled-job-throttle
	 */
	public static $mediafile_job_throttle_max = 20;

	/**
	 * @var int
	 * the maximum number of UploadMediafileJob’s that should exist in the overall job queue.
	 * if this number is reached, the UploadMetadataJob will attempt
	 * Config::$metadata_job_max_attempts times to add to the additional
	 * UploadMediafileJob’s before failing.
	 */
	public static $mediafile_job_queue_max = 1000;

	/**
	 * @var array
	 * - which MediaWiki Templates are allowed for mapping
	 * - fallbacks in case there’s no template data for these MediaWiki templates
	 */
	public static $mediawiki_templates = [
		// @codingStandardsIgnoreStart
		'Art_Photo' => '{"artist":"","title":"","description":"","date":"","medium":"","dimensions":"","institution":"","location":"","references":"","object history":"","exhibition history":"","credit line":"","inscriptions":"","notes":"","accession number":"","object type":"","artwork license":"","artwork":"","photo description":"","photo date":"","photographer":"","source":"","photo license":"","other_versions":""}',
		'Artwork' => '{"artist":"","title":"","description":"","date":"","medium":"","dimensions":"","institution":"","location":"","references":"","object history":"","exhibition history":"","credit line":"","inscriptions":"","notes":"","accession number":"","source":"","permission":"","other_versions":""}',
		'Book' => '{"Author":"","Translator":"","Editor":"","Illustrator":"","Title":"","Subtitle":"","Series title":"","Volume":"","Edition":"","Publisher":"","Printer":"","Date":"","City":"","Language":"","Description":"","Source":"","Permission":"","Image":"","Image page":"","Pageoverview":"","Wikisource":"","Homecat":"","Other_versions":"","ISBN":"","LCCN":"","OCLC":""}',
		'Information' => '{"description":"","date":"","source":"","author":"","permission":"","other_versions":""}',
		'Map' => '{"description":"","maplocation":"","mapdate":"","publisher":"","printer":"","reproduction":"","type":"","sheet":"","legend":"","projection":"","scale":"","heading":"","latitude":"","longitude":""}',
		'Musical_work' => '{"composer":"","lyrics_writer":"","performer":"","title":"","description":"","composition_date":"","performance_date":"","notes":"","record_ID":"","image":"","references":"","source":"","permission":"","other_versions":""}',
		'Photograph' => '{"photographer":"","title":"","description":"","depicted people":"","depicted place":"","date":"","medium":"","dimensions":"","institution":"","department":"","references":"","object history":"","exhibition history":"","credit line":"","inscriptions":"","notes":"","accession number":"","source":"","permission":"","other_versions":""}',
		'Specimen' => '{"taxon":"","authority":"","institution":"","accession number":"","sex":"","discovery place":"","cultivar":"","author":"","source":"","date":"","description":"","period":"","depicted place":"","camera coord":"","dimensions":"","institution":"","location":"","object history":"","exhibition history":"","credit line":"","notes":"","references":"","permission":"","other versions":"","photographer":"","source":""}'
		// @codingStandardsIgnoreEnd
	];

	/**
	 * @var string
	 * 128M default
	 */
	public static $memory_limit = '256M';

	/**
	 * @var string
	 * category automatically assigned to metadata files uploaded by GWToolset
	 */
	public static $metadata_file_category = 'GWToolset_Metadata_Sets';

	/**
	 * @var string
	 * this delay is used specifically for each gwtoolsetUploadMetadataJob
	 *
	 * used in conjunction with the job param jobReleaseTimestamp when the job queue
	 * delayedJobsEnabled() is true, e.g., JobQueueRedis
	 */
	public static $metadata_job_delay = '1 minute';

	/**
	 * @var string
	 * this delay is used specifically when the job queue for gwtoolsetUploadMediafileJobs
	 * has reached the $mediafile_job_queue_max
	 *
	 * used in conjunction with the job param jobReleaseTimestamp when the job queue
	 * delayedJobsEnabled() is true, e.g., JobQueueRedis
	 */
	public static $metadata_job_attempt_delay = '5 minutes';

	/**
	 * @var int
	 * the maximum number of times the UploadMetadataJob will attempt to add the same
	 * UploadMediafileJob’s to the job queue. this max is used when the
	 * Config::$metadata_job_max_attempts has been reached and if used, can indicate
	 * an issue with the job queue clearing out UploadMediafileJob’s.
	 */
	public static $metadata_job_max_attempts = 10;

	/**
	 * @var int
	 * wiki namespace to store metadata mappings and data sets
	 */
	public static $metadata_namespace = NS_GWTOOLSET;

	/**
	 * @var string
	 * subpage used to place saved metadata mappings
	 */
	public static $metadata_mapping_subpage = 'Metadata_Mappings';

	/**
	 * @var string
	 */
	public static $metadata_separator = '; ';

	/**
	 * @var string
	 * subpage used to place saved metadata sets
	 */
	public static $metadata_sets_subpage = 'Metadata_Sets';

	/**
	 * @var int
	 */
	public static $preview_throttle = 3;

	/**
	 * @var string
	 * Category:Source_templates is the category on commons for partner templates
	 */
	public static $source_templates = 'Source_templates';

	/**
	 * @var int
	 * title maximum length in bytes
	 * @see https://commons.wikimedia.org/wiki/Commons:File_naming
	 */
	public static $title_max_length = 240;

	/**
	 * @var string
	 */
	public static $title_separator = '-';

	/**
	 * @var bool
	 * tells the upload form to place the $accepted_mime_types in a comma
	 * delimited list in the input file’s accept attribute
	 */
	public static $use_file_accept_attribute = true;

	/**
	 * @var array
	 * user permissions required in order to be able to use this extension
	 * @see \GWToolset\Helpers\WikiChecks::checkUserPermissions
	 */
	public static $user_permissions = [
		'edit',
		'gwtoolset',
		'upload',
		'upload_by_url'
	];
}
