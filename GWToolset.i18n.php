<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

$messages = array();

/**
 * English
 * @author dan-nl
 */
$messages['en'] = array(
	/**
	 * basic extension information
	 */
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, a mass upload tool for GLAMs',
	'gwtoolset-intro' => 'GWToolset is a MediaWiki extension that allows GLAMs the ability to mass upload content based on an XML file containing respective metadata about the content. The intent is to allow for a variety of XML schemas. Further information about the project can be found on its (https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project project page). Feel free to contacts us on that page as well. Select one of the menu items above to begin the upload process.',

	/**
	 * db client
	 */
	'gwtoolset-db-client-support' => 'The GWToolset extension currently supports only MySQL.',

	/**
	 * developer issues
	 */
	'gwtoolset-batchjob-creation-failure' => 'Could not create a ($1) batch job.',
	'gwtoolset-could-not-close-xml' => 'Could not close the XMLReader.',
	'gwtoolset-could-not-open-xml' => 'Could not open the XML File for reading.',
	'gwtoolset-developer-issue' => "Please contact a developer; they will need to address this issue before you can continue. $1",
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, or <code>record-count</code> or <code>record-current</code> not provided.',
	'gwtoolset-file-backend-maxage-invalid' => 'The FileBackend max age value provided is invalid @see php.net/manual/en/datetime.formats.relative.php.',
	'gwtoolset-fsfile-empty' => 'The mwstored file was empty; the extension has deleted the file for you.',
	'gwtoolset-fsfile-retrieval-failure' => 'Could not retrieve ($1) from the FileBackend.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> not set.',
	'gwtoolset-incorrect-form-handler' => 'The module, $1, has not registered a form handler extending GWToolset\Handlers\Forms\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'The batch job throttle was exceeded.',
	'gwtoolset-no-accepted-types' => 'No accepted types provided',
	'gwtoolset-no-callback' => 'No callback passed to this method.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> not set.",
	'gwtoolset-no-field-size' => 'No field size was specified for the field ($1).',
	'gwtoolset-no-file-backend-name' => 'No file backend name provided.',
	'gwtoolset-no-file-backend-container' => 'No file backend container name provided.',
	'gwtoolset-no-file-url' => 'No <code>file_url</code> provided to parse.',
	'gwtoolset-no-form-handler' => 'No form handler was created.',
	'gwtoolset-no-mapping' => 'No <code>mapping_name</code> provided.',
	'gwtoolset-no-mapping-json' => 'No <code>mapping_json</code> provided.',
	'gwtoolset-no-mediawiki-template' => 'No <code>mediawiki-template-name</code> provided.',
	'gwtoolset-no-module' => 'No module name was specified.',
	'gwtoolset-no-mwstore-provided' => 'No mwstore URL provided.',
	'gwtoolset-no-page-title' => 'No page title provided.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> not set.",
	'gwtoolset-no-source-array' => 'No source array was provided.',
	'gwtoolset-no-summary' => 'No summary provided.',
	'gwtoolset-no-template-url' => 'No template URL provided to parse.',
	'gwtoolset-no-text' => 'No text provided.',
	'gwtoolset-no-title' => 'No title provided.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> not set.",
	'gwtoolset-no-url-to-evaluate' => 'No URL was provided for evaluation.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> not set.',
	'gwtoolset-no-user' => 'no user object provided.',
	'gwtoolset-no-xml-element' => 'No XMLReader or DOMElement provided.',
	'gwtoolset-no-xml-source' => 'No local XML source was given.',
	'gwtoolset-not-string' => 'The value provided to the method was not a string; it’s a ($1).',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 does not match.',

	/**
	 * file checks
	 */
	'gwtoolset-disk-write-failure' => 'Failed to write file to disk.',
	'gwtoolset-xml-doctype' => 'The XML metadata file cannot contain a <!DOCTYPE> section; please remove it and then try uploading the XML metadata file again.',
	'gwtoolset-file-is-empty' => 'The uploaded file is empty.',
	'gwtoolset-improper-upload' => 'File was not uploaded properly.',
	'gwtoolset-mime-type-mismatch' => 'The uploaded file’s extension ($1) and mime-type ($2) do not match.',
	'gwtoolset-missing-temp-folder' => 'Missing a temporary folder.',
	'gwtoolset-multiple-files' => 'The file submitted contains information on more than one file; only one file can be submitted at a time.',
	'gwtoolset-no-extension' => 'The file submitted does not contain enough information to process the file; most likely there is no file extension.',
	'gwtoolset-no-file' => 'No file received.',
	'gwtoolset-no-form-field' => 'The expected form field ($1) does not exist.',
	'gwtoolset-over-max-ini' => 'The uploaded file exceeds the <code>upload_max_filesize</code> and/or the <code>post_max_size</code> directive in php.ini.',
	'gwtoolset-partial-upload' => 'The uploaded file was only partially uploaded.',
	'gwtoolset-php-extension-error' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
	'gwtoolset-unaccepted-extension' => 'The file source does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => "The file source has an unaccepted file extension (.$1).",
	'gwtoolset-unaccepted-mime-type' => 'The uploaded file is interpreted as having the mime-type ($1), which is not an accepted mime-type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'The uploaded file is interpreted as having the mime-type ($1), which is not an accepted mime-type.

Does the XML file have an XML declaration at the top of the file?

&lt;?xml version="1.0" encoding="UTF-8"?>',

	/**
	 * general form
	 */
	'gwtoolset-back-text-link' => '⬅ go back to the form',
	'gwtoolset-back-text' => 'Press the browser back button to go back to the form.',
	'gwtoolset-file-interpretation-error' => 'There was a problem interpretting the metadata file',
	'gwtoolset-mediawiki-template' => '$1 Template',
	'gwtoolset-metadata-user-options-error' => 'The following form field(s) must be filled in:
$1',
	'gwtoolset-metadata-invalid-template' => 'No valid MediaWiki template found.',
	'gwtoolset-menu' => '* $1',
	'gwtoolset-menu-1' => 'Metadata mapping',
	'gwtoolset-technical-error' => 'There was a technical error.',
	'gwtoolset-required-field' => ' denotes required field',
	'gwtoolset-revised' => '(revised)',
	'gwtoolset-submit' => 'Submit',

	/**
	 * js
	 */
	'gwtoolset-cancel' => 'Cancel',
	'gwtoolset-loading' => 'Please be patient, this may take awhile.',
	'gwtoolset-save' => 'Save',
	'gwtoolset-save-mapping' => 'save mapping',
	'gwtoolset-save-mapping-failed' => 'We apologize, there was a problem processing your request; please try again later. ($1)',
	'gwtoolset-save-mapping-succeeded' => 'Your mapping has been successfully saved.',
	'gwtoolset-save-mapping-name' => 'How would you like to name this mapping?',

	/**
	 * json
	 */
	'gwtoolset-json-error' => 'There was a problem with the JSON ($1).',
	'gwtoolset-json-error-ctrl-char' => 'Unexpected control character found.',
	'gwtoolset-json-error-depth' => 'Maximum stack depth exceeded.',
	'gwtoolset-json-error-none' => 'No errors.',
	'gwtoolset-json-error-state-mismatch' => 'Underflow or the modes mismatch.',
	'gwtoolset-json-error-syntax' => 'Syntax error, malformed JSON.',
	'gwtoolset-json-error-unknown' => 'Unknown error.',
	'gwtoolset-json-error-utf8' => 'Malformed UTF-8 characters, possibly incorrectly encoded.',

	/**
	 * step 1 - metadata detect
	 */
	'gwtoolset-accepted-file-types' => 'Accepted file types:',
	'gwtoolset-create-metadata' => '$1 creating metadata for $2.',
	'gwtoolset-ensure-well-formed-xml' => 'Make sure the XML File is well-formed with this $1.',
	'gwtoolset-file-url-invalid' => 'The file URL was invalid; the file does not yet exist in the wiki. You need to first upload the file from your computer if you want to use the file URL reference in the form.',
	'gwtoolset-mediawiki-template-does-not-exist' => "MediaWiki template ('''$1''') does not exist in the wiki.

Either import the template or select another MediaWiki template to use for mapping.",
	'gwtoolset-mediawiki-template-not-found' => 'No MediaWiki template found for ($1).',
	'gwtoolset-metadata-file-source' => 'Select the metadata file source.',
	'gwtoolset-metadata-file-source-info' => '... either a file that has been previously uploaded or a file you wish to upload from your computer.',
	'gwtoolset-metadata-file-url' => 'Metadata file wiki URL:',
	'gwtoolset-metadata-file-url-not-present' => 'The metadata file source provided ($1) does not exist.',
	'gwtoolset-metadata-file-upload' => 'Metadata file upload:',
	'gwtoolset-metadata-mapping-bad' => 'There’s a problem with the metadata mapping; most likely the JSON format is invalid. Please try and correct the issue and then submit the form again.

$1.',
	'gwtoolset-metadata-mapping-invalid-url' => 'The metadata mapping URL supplied, ($1), does not match the expect mapping URL path ($2).',
	'gwtoolset-metadata-mapping-not-found' => "No metadata mapping was found.

The page title, '''$1''', does not exist in the wiki.",
	'gwtoolset-namespace-mismatch' => "The page title given, '''$1''', is in the wrong namespace, '''$2'''.

It should be in the '''$3''' namespace.",
	'gwtoolset-no-xml-element-found' => 'No XML element found for mapping.
* Did you enter a value in the form for “What is the XML element that contains each metadata record”?
* Is the XML file well-formed? Try this $1.',
	'gwtoolset-page-title-contains-url' => "The page title, $1, contains the entire wiki URL. Make sure you only refer to the page title, e.g. the part of the URL after /wiki/",
	'gwtoolset-record-element-name' => 'What is the XML element that contains each metadata record:',
	'gwtoolset-step-1-heading' => 'Step 1: Metadata detection',
	'gwtoolset-step-1-instructions-1' => 'The Metadata upload process consists of 4 steps:',
	'gwtoolset-step-1-instructions-2' => 'In this step, you either upload a new metadata file, or select a metadata file that has already been uploaded to the wiki for evaluation. The toolset will attempt to extract the metadata fields available in the metadata file, which you will then map to a MediaWiki template in Step 2: Metadata mapping.',
	'gwtoolset-step-1-instructions-li-1' => 'Metadata detection',
	'gwtoolset-step-1-instructions-li-2' => 'Metadata mapping',
	'gwtoolset-step-1-instructions-li-3' => 'Batch preview',
	'gwtoolset-step-1-instructions-li-4' => 'Batch upload',
	'gwtoolset-upload-legend' => 'Upload your metadata file.',
	'gwtoolset-which-mediawiki-template' => 'Which MediaWiki template:',
	'gwtoolset-which-metadata-mapping' => 'Which Metadata mapping:',
	'gwtoolset-xml-error' => 'Failed to load the XML; please correct the errors displayed below.',

	/**
	 * step 2 - metadata mapping
	 */
	'gwtoolset-categories' => 'Enter categories separated by a pipe |',
	'gwtoolset-category' => 'category',
	'gwtoolset-create-mapping' => '$1 creating metadata mapping for $2.',
	'gwtoolset-example-record' => 'Metadata’s example record’s contents.',
	'gwtoolset-global-categories' => 'Global Categories',
	'gwtoolset-global-tooltip' => 'These category entries will be applied globally to all uploaded items.',
	'gwtoolset-maps-to' => 'maps to',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Could not evaluate the media file URL in order to determine the file extension ($1).',
	'gwtoolset-mapping-media-file-url-bad' => 'Could not evaluate the media file URL provided ($1). The URL delivers the content in a way that is not yet handled by this extension.',
	'gwtoolset-mapping-no-title' => 'The metadata mapping contains no title, which is needed in order to create the page.',
	'gwtoolset-mapping-no-title-identifier' => 'The metadata mapping contains no title identifier, which is used to create a unique page title; make sure you map a metadata field to the MediaWiki template parameter title identifier.',
	'gwtoolset-metadata-field' => 'metadata field',
	'gwtoolset-metadata-file' => 'Metadata file',
	'gwtoolset-metadata-mapping-legend' => 'Map your metadata',
	'gwtoolset-no-more-records' => "'''no more records to process'''",
	'gwtoolset-painted-by' => 'Painted by',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-explanation' => 'Partner templates are pulled into the source field of the MediaWiki template when provided. You can find a list of current Partner Templates on the Category:Source templates page; see link below. Once you’ve found the Partner Template you wish to use place the URL to it in this field. You can also create a new Partner Template if necessary.',
	'gwtoolset-partner-template' => 'partner template:',
	'gwtoolset-phrasing' => 'phrasing',
	'gwtoolset-preview' => 'preview batch',
	'gwtoolset-process-batch' => 'process the batch',
	'gwtoolset-record-count' => 'Total number of records found in this metadata file ($1).',
	'gwtoolset-results' => 'Results',
	'gwtoolset-step-2-heading' => 'Step 2: Metadata mapping',
	'gwtoolset-step-2-instructions-heading' => 'Mapping the metadata fields',
	'gwtoolset-step-2-instructions-1' => 'Below is/are :',
	'gwtoolset-step-2-instructions-1-li-1' => 'A list of the fields in the MediaWiki $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Drop-down fields that represent the metadata fields found in the metadata file.',
	'gwtoolset-step-2-instructions-1-li-3' => 'A sample record from the metadata file.',
	'gwtoolset-step-2-instructions-2' => 'In this step you need to map the metadata fields with the MediaWiki template fields.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Select a metadata field under the ‘maps to’ column that corresponds with MediaWiki template field under the ‘template field’ column.',
	'gwtoolset-step-2-instructions-2-li-2' => 'You do not need to provide a match for every Mediawiki template field.',
	'gwtoolset-reupload-media' => 're-upload media from URL',
	'gwtoolset-reupload-media-explanation' => 'This check box allows you to re-upload media for an item that has already been uploaded to the wiki. If the item already exists, an additional media file will be added to the wiki. If the media file does not yet exist, it will be uploaded whether this checkbox is checked or not.',
	'gwtoolset-specific-categories' => 'Item specific categories',
	'gwtoolset-specific-tooltip' => "Using the following fields you can apply a phrase (optional) plus a metadata field as the category entry for each individual uploaded item. For example, if the metadata file contains an element for the artist of each record, you could add that as a category entry for each record that would change to the value specific to each record. You could also add a phrase such as “''Painted by''” and then the artist metadata field, which would yield “''Painted by <artist name>''” as the category for each record.",
	'gwtoolset-summary-tooltip' => 'Enter a short summary (ctrl-option-b)',
	'gwtoolset-template-field' => 'template field',

	/**
	 * step 3 - batch preview
	 */
	'gwtoolset-step-3-instructions-heading' => 'Step 3: Batch preview',
	'gwtoolset-step-3-instructions-1' => 'Below are the results of uploading the first $1 records from the metadata file you selected and mapping them to the MediaWiki template you selected in Step 2: Metadata mapping.',
	'gwtoolset-step-3-instructions-2' => 'Review these pages and if the results meet your expectations, and there are additional records waiting to be uploaded, continue the batch upload process by clicking on the “process the batch” button below.',
	'gwtoolset-step-3-instructions-3' => 'If you’re not happy with the results, go back to Step 2: Metadata mapping and adjust the mapping as necessary.

If you need to make adjustments to the metadata file itself, go ahead and do so and re-upload it by beginning the process again with Step 1: Metadata detection.',
	'gwtoolset-title-bad' => "The title created, based on the metadata and mediawiki template mapping is not valid.

Try another field from the metadata for title and title-identifier, or if possible, change the metadata where needed. See https://commons.wikimedia.org/wiki/Commons:File_naming for more insight.

'''Invalid title''': ($1)",

	/**
	 * step 4 - batch job creation
	 */
	'gwtoolset-batchjob-metadata-created' => 'Metadata batch job created. Your metadata file will be analyzed shortly and each item will be uploaded to the wiki in a background process. You can check the ($1) page to see when they have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Could not create batchjob for the metadata file.',
	'gwtoolset-create-mediafile' => '$1 creating mediafile for $2.',
	'gwtoolset-mediafile-jobs-created' => 'Created ($1) mediafile batch jobs.',
	'gwtoolset-step-4-heading' => 'Step 4: Batch upload',

	/**
	 * wiki checks
	 */
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'The PHP ini settings:

• <code>upload_max_filesize</code> ($1)
• <code>post_max_size</code> ($2)

are set lower than the wiki’s $wgMaxUploadSize ($3); please adjust the PHP ini settings as appropriate.',
	'gwtoolset-mediawiki-version-invalid' => 'This extension requires MediaWiki version ($1)<br />This MediaWiki version is ($2)',
	'gwtoolset-permission-not-given' => 'Make sure that you are logged-in or contact an administrator in order to be granted permission to view this page ($1).',
	'gwtoolset-user-blocked' => 'Your user account is currently blocked. Please contact an administrator in order to correct the blocking issue.',
	'gwtoolset-verify-api-enabled' => 'The $1 Extension requires that the wiki API is enabled.

Please make sure <code>$wgEnableAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-api-writeable' => 'The $1 Extension requires that the wiki API can perform write actions for authorized users.

Please make sure that <code>$wgEnableWriteAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-curl' => 'The $1 Extension requires that PHP (http://www.php.net/manual/en/curl.setup.php cURL functions) be installed.',
	'gwtoolset-verify-finfo' => 'The $1 Extension requires that the PHP (http://www.php.net/manual/en/fileinfo.setup.php finfo) extension be installed.',
	'gwtoolset-verify-php-version' => 'The $1 Extension requires PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'The $1 Extension requires that file uploads are enabled.

Please make sure that <code>$wgEnableUploads</code> is set to <code>true</code> in <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'The $1 Extension requires that PHP (http://www.php.net/manual/en/xmlreader.setup.php XMLReader) be installed.',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki checks did not pass'
);

/**
 * Message documentation
 * @author dan-nl
 */
$messages['qqq'] = array(
	'gwtoolset' => 'extension name',
	'gwtoolset-accepted-file-types' => 'Label for accepted file types in the HTML form.',
	'gwtoolset-back-text' => 'User message telling the user to use the browser back button to go back to the HTML form. When JavaScript is active this message is replaced with an anchor tag using gwtoolset-back-text-link.',
	'gwtoolset-back-text-link' => 'gwtoolset-back-text is replaced by an anchor tag when JavaScript is active; this text is used as the text of the anchor tag.',
	'gwtoolset-batchjob-creation-failure' => 'Message that appears when the extention could not create a batch job. Parameter $1 is the type of batch job.',
	'gwtoolset-batchjob-metadata-created' => 'User message verifying that the metadata batch job was created. Parameter 1 is a link to a page, Special:NewFiles where the user can use to see if their media files have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'User error message that appears when the extension could not create a batchjob for the metadata file.',
	'gwtoolset-cancel' => 'Label for the cancel button.',
	'gwtoolset-categories' => 'Instructions for adding categories in the HTML form.',
	'gwtoolset-category' => 'Label for category in the HTML form.',
	'gwtoolset-could-not-close-xml' => 'Hint to the developer that appears when could not close the XMLReader.',
	'gwtoolset-could-not-open-xml' => 'Hint to the developer that appears when could not open the XML File for reading.',
	'gwtoolset-create-mapping' => 'Summary message used when the extension creates/updates a metadata mapping content page. Parameter 1 is the extension name. Parameter 2 is the user name.',
	'gwtoolset-create-mediafile' => 'Summary message used when the extension creates/updates a media file content page. Parameter 1 is the extension name. Parameter 2 is the user name.',
	'gwtoolset-create-metadata' => 'Summary message used when the extension creates/updates a metadata content page. Parameter 1 is the extension name. Parameter 2 is the user name.',
	'gwtoolset-desc' => '{{desc|name=GWToolset|url=https://www.mediawiki.org/wiki/Extension:GWToolset}}',
	'gwtoolset-developer-issue' => "A user-friendly message that lets the user know that something went wrong that a developer will need to fix. The single parameter takes a message that explains a bit more to the developer what the issue may be.",
	'gwtoolset-disk-write-failure' => 'User error message that appears when the uploaded file failed to write to disk.',
	'gwtoolset-dom-record-issue' => 'Hint to the developer that appears when record-element-name, or record-count or record-current not provided.',
	'gwtoolset-ensure-well-formed-xml' => 'Additional instructions that will help the user make sure the XML File is well-formed.',
	'gwtoolset-example-record' => 'Label for the metadata example record.',
	'gwtoolset-file-backend-maxage-invalid' => 'Message that appears when the max age value provided is invalid.',
	'gwtoolset-file-interpretation-error' => 'Heading that appears when there was a problem interpreting the metadata file.',
	'gwtoolset-file-is-empty' => 'User error message that appears when the uploaded file is empty.',
	'gwtoolset-file-url-invalid' => 'User error message when the file URL is invalid.',
	'gwtoolset-fsfile-empty' => 'Message displayed when the mwstored file contains nothing in it.',
	'gwtoolset-fsfile-retrieval-failure' => 'Message that appears when the extension could not retrieve a file from the FileBackend. Parameter 1 is the mwstore URL to the file.',
	'gwtoolset-global-categories' => 'Heading for the global categories section in the HTML form.',
	'gwtoolset-global-tooltip' => 'Instructions for the HTML form.',
	'gwtoolset-ignorewarnings' => 'Hint to the developer that appears when ignorewarnings is not set.',
	'gwtoolset-improper-upload' => 'User error message that appears when a File was not uploaded properly.',
	'gwtoolset-incorrect-form-handler' => 'A developer message that appears when a module does not specify a form handler that extends GWToolset\Handlers\Forms\FormHandler.',
	'gwtoolset-intro' => 'Introduction paragraph for the extension used on the initial Special:GWtoolset landing page.',
	'gwtoolset-job-throttle-exceeded' => 'Developer message that appears when the batch job throttle was exceeded.',
	'gwtoolset-json-error' => 'Appears when there is a problem with a JSON value.',
	'gwtoolset-json-error-ctrl-char' => 'User error message when an unexpected control character has been found.',
	'gwtoolset-json-error-depth' => 'User error message when the maximum stack depth is exceeded.',
	'gwtoolset-json-error-none' => 'User error message when no errors have been found.',
	'gwtoolset-json-error-state-mismatch' => 'User error message when underflow or the modes mismatch.',
	'gwtoolset-json-error-syntax' => 'User error message when there is a syntax error; a malformed JSON.',
	'gwtoolset-json-error-unknown' => 'User error message when there’s an unknown error.',
	'gwtoolset-json-error-utf8' => 'User error message when there are malformed UTF-8 characters, possibly incorrectly encoded.',
	'gwtoolset-loading' => 'JavaScript loading message for when the user needs to wait for the application.',
	'gwtoolset-mapping-media-file-url-bad' => 'User error message when the extension can not evaluate the media file URL. Parameter 1 is the URL provided.',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'User error message when the extension could not evaluate the media file URL in order to determine the file extension. Parameter 1 is the URL to the file or the file name given.',
	'gwtoolset-mapping-no-title' => 'User error message when the metadata mapping contains no title.',
	'gwtoolset-mapping-no-title-identifier' => 'User error message when the metadata mapping contains no title identifier.',
	'gwtoolset-maps-to' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'User message that appears when the PHP ini settings are less that the wiki’s $wgMaxUploadSize setting.',
	'gwtoolset-mediafile-jobs-created' => 'User/Developer message that indicates the number of mediafile batch jobs created. Parameter $1 represents that number.',
	'gwtoolset-metadata-user-options-error' => 'Initial paragraph that notifies the user that there are form fields missing. The specific form fields that are missing are mentioned separately.',
	'gwtoolset-metadata-invalid-template' => 'Message that appears when no valid MediaWiki template is found.',
	'gwtoolset-mediawiki-template' => 'Heading used on the mapping page. The parameter is filled in with the wiki template name that will be used for mapping the metadata to the wiki template.',
	'gwtoolset-mediawiki-version-invalid' => 'Message appears when the MediaWiki version is too low.',
	'gwtoolset-menu' => 'The extension menu list. This is a parameter placeholder that will be replaced with HTML li elements.',
	'gwtoolset-menu-1' => 'The first menu item for the extension menu list.',
	'gwtoolset-metadata-field' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.',
	'gwtoolset-metadata-file' => 'Heading for displaying some information about the metadata file.',
	'gwtoolset-metadata-file-source' => 'Initial instructions for selecting the file source.',
	'gwtoolset-metadata-file-source-info' => 'Additional instructions about the file source.',
	'gwtoolset-metadata-file-url' => 'Label for the file source URL in the HTML form.',
	'gwtoolset-metadata-file-upload' => 'Label for the file upload button in the HTML form.',
	'gwtoolset-metadata-mapping-legend' => 'Step 2 legend for the HTML form.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Message appears when the MediaWiki template requested to use for maetadata mapping does not exist in the wiki.',
	'gwtoolset-mediawiki-template-not-found' => 'User error message when no MediaWiki template is found. Parameter is the template name that was not found.',
	'gwtoolset-metadata-file-url-not-present' => 'User error message when no metadata file was uploaded to the wiki or local wiki URL for the metadata file was provided.',
	'gwtoolset-metadata-mapping-bad' => 'User error message when there’s a problem with the metadata mapping JSON format. The parameter is the technical error message given by php for the specific JSON error.',
	'gwtoolset-metadata-mapping-invalid-url' => 'User error message when the metadata mapping URL supplied does not match the expected mapping URL path. Parameter 1 is the URL provided. Parameter 2 is the expected  path.',
	'gwtoolset-metadata-mapping-not-found' => 'User error message when no metadata mapping was found in the page. The parameter is the URL to the page.',
	'gwtoolset-mime-type-mismatch' => 'User error message that appears when the uploaded file’s extension and mime-type do not match. parameter 1 is the extension and parameter 2 is the mime-type detected.',
	'gwtoolset-missing-temp-folder' => 'User error message that appears when the wiki cannot find a temporary folder for file uploads.',
	'gwtoolset-multiple-files' => 'User message that appears when the file submitted contains information on more than one file.',
	'gwtoolset-namespace-mismatch' => 'Appears when a page title is given that does not reside in the expected namespace.',
	'gwtoolset-no-accepted-types' => 'Hint to the developer that appears when no accepted types are provided.',
	'gwtoolset-no-callback' => 'Hint to the developer that appears when no callback is given.',
	'gwtoolset-no-comment' => "Hint to the developer that appears when user_options['comment'] is not set.",
	'gwtoolset-no-extension' => 'User message that appears when the file submitted does not contain enough information to process the file; most likely there is no file extension.',
	'gwtoolset-no-field-size' => 'Developer message that appears when no field size was specified for the field. Parameter $1 is the name field.',
	'gwtoolset-no-file' => 'User error message that appears when no file was received by the upload form. Parameter $1, when provided is a hint to the developer as to where the problem occured in the application.',
	'gwtoolset-no-file-backend-name' => 'Message that appears when a web admin does not provide a file backend name.',
	'gwtoolset-no-file-backend-container' => 'Message that appears wher no file backend container name was provided.',
	'gwtoolset-no-file-url' => 'Hint to the developer that appears when no file_url is provided to parse.',
	'gwtoolset-no-form-field' => 'Developer message that appears when the expected form field does not exist. Parameter $1 is the name of the expected form field.',
	'gwtoolset-no-form-handler' => 'Hint to the developer that appears when no form handler was created.',
	'gwtoolset-no-mapping' => 'Hint to the developer that appears when no mapping_name is provided.',
	'gwtoolset-no-mapping-json' => 'Hint to the developer that appears when no mapping_json is provided.',
	'gwtoolset-no-mediawiki-template' => 'Hint to the developer that appears when no mediawiki-template-name is provided.',
	'gwtoolset-no-module' => 'Hint to the developer that appears when no module name was specified.',
	'gwtoolset-no-more-records' => 'User message that appears when there are no more records to process.',
	'gwtoolset-no-mwstore-provided' => 'Message that appears when no mwstore URL is provided.',
	'gwtoolset-no-page-title' => 'Appears when no page title was provided.',
	'gwtoolset-no-reupload-media' => "Hint to the developer that appears when user_options['gwtoolset-reupload-media'] is not set.",
	'gwtoolset-no-save-as-batch' => "Hint to the developer that appears when user_options['save-as-batch-job'] is not set.",
	'gwtoolset-no-source-array' => 'Developer message that appears when no source array was provided to a method.',
	'gwtoolset-no-summary' => 'Hint to the developer that appears when no summary is provided.',
	'gwtoolset-no-template-url' => 'Hint to the developer that appears when no template URL is provided to parse.',
	'gwtoolset-no-text' => 'Hint to the developer that appears when no text is provided.',
	'gwtoolset-no-title' => 'Hint to the developer that appears when no title is provided.',
	'gwtoolset-no-url-to-evaluate' => 'Message that appears when no URL was provided for evaluation.',
	'gwtoolset-no-url-to-media' => 'Hint to the developer that appears when url-to-the-media-file is not set.',
	'gwtoolset-no-user' => 'Hint to the developer that appears when no user object is provided.',
	'gwtoolset-no-xml-element' => 'Hint to the developer that appears when no XMLReader or DOMElement is provided.',
	'gwtoolset-no-xml-element-found' => 'User error message when no XML element was found for mapping.',
	'gwtoolset-no-xml-source' => 'Hint to the developer that appears when no local XML source was given',
	'gwtoolset-not-string' => 'Developer message that appears when the value provided to the method was not a string; parameter $1 is the actual type of the value.',
	'gwtoolset-over-max-ini' => 'User error message that appears when the uploaded file exceeds the upload_max_filesize directive in php.ini.',
	'gwtoolset-page-title-contains-url' => 'Appears when the page title being requested contains the URL of the site and not just the page title',
	'gwtoolset-painted-by' => 'Placeholder text for category phrasing in Step 2 in the HTML form.',
	'gwtoolset-partial-upload' => 'User error message that appears when the uploaded file was only partially uploaded.',
	'gwtoolset-partner' => 'Heading for the partner section in Step 2 of the HTML form.',
	'gwtoolset-partner-explanation' => 'Instructions for the partner section in Step 2 of the HTML form.',
	'gwtoolset-partner-template' => 'Placeholder text for partner template in Step 2 of the HTML form.',
	'gwtoolset-permission-not-given' => 'Message that appears when the user does not have the proper wiki permissions.',
	'gwtoolset-php-extension-error' => 'User error message that appears when a PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
	'gwtoolset-phrasing' => 'Table heading for the phrasing field column in the categories section in Step 2 of the HTML form.',
	'gwtoolset-preview' => 'Text for submit button in Step 2 of the HTML form.',
	'gwtoolset-process-batch' => 'Text for submit button in Step 3 of the HTML form.',
	'gwtoolset-record-count' => 'User message that indicates the total number of records found in the metadata file. Parameter 1 is the total number of records found.',
	'gwtoolset-record-element-name' => 'Label for record element name in the HTML form.',
	'gwtoolset-required-field' => 'Denotes required field.',
	'gwtoolset-results' => 'Heading used when results are given.',
	'gwtoolset-reupload-media' => 'Label for re-upload media from URL checkbox in Step 2 of the HTML form.',
	'gwtoolset-reupload-media-explanation' => 'Instructions for the re-upload media from URL checkbox in Step 2 of the HTML form.',
	'gwtoolset-revised' => 'Message that appears when a wiki page has been revised.',
	'gwtoolset-submit' => 'Submit button text for metadata forms.',
	'gwtoolset-save' => 'Label for the save button.',
	'gwtoolset-save-mapping' => 'Label for the save mapping button.',
	'gwtoolset-save-mapping-failed' => 'Message to the user that appears when their mapping could not be saved. Parameter $1 is any error information that may have been provided.',
	'gwtoolset-save-mapping-succeeded' => 'Message to the user that appears when their mapping was successfully saved.',
	'gwtoolset-save-mapping-name' => 'JavaScript prompt to the user asking them under which name they would like to save their mapping.',
	'gwtoolset-sha1-does-not-match' => 'Message that appears when the SHA-1 hash of a file does not match the expected SHA-1 hash.',
	'gwtoolset-specific-categories' => 'Heading for the item specific categories section in Step 2 of the HTML form.',
	'gwtoolset-specific-tooltip' => 'Instructions for the item specific categories section in Step 2 of the HTML form.',
	'gwtoolset-step-1-heading' => 'Heading for step 1.',
	'gwtoolset-step-1-instructions-1' => 'Step 1, first instructions paragraph.',
	'gwtoolset-step-1-instructions-2' => 'Step 1, second instructions paragraph.',
	'gwtoolset-step-1-instructions-li-1' => 'Step 1, first step.',
	'gwtoolset-step-1-instructions-li-2' => 'Step 1, second step.',
	'gwtoolset-step-1-instructions-li-3' => 'Step 1, third step.',
	'gwtoolset-step-1-instructions-li-4' => 'Step 1, fourth step.',
	'gwtoolset-step-2-heading' => 'Step 2 heading.',
	'gwtoolset-step-2-instructions-heading' => 'Step 2 heading instructions.',
	'gwtoolset-step-2-instructions-1' => 'Step 2, first set of instructions.',
	'gwtoolset-step-2-instructions-1-li-1' => 'Step 2, first set of instructions, first instuction.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Step 2, first set of instructions, second instruction.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Step 2, first set of instructions, third instruction.',
	'gwtoolset-step-2-instructions-2' => 'Step 2, second set of instructions.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Step 2, second set of instructions, first instruction.',
	'gwtoolset-step-2-instructions-2-li-2' => 'Step 2, second set of instructions, second instruction.',
	'gwtoolset-step-3-instructions-heading' => 'Step 3, instructions heading.',
	'gwtoolset-step-3-instructions-1' => 'Step 3, first set of instructions.',
	'gwtoolset-step-3-instructions-2' => 'Step 3, second set of instructions.',
	'gwtoolset-step-3-instructions-3' => 'Step 3, third set of instructions.',
	'gwtoolset-step-4-heading' => 'Step 4 heading.',
	'gwtoolset-summary-tooltip' => 'The title tooltip for the summary field in Step 2 of the HTML form.',
	'gwtoolset-technical-error' => 'Heading for error messages of a technical nature.',
	'gwtoolset-template-field' => 'Table column heading for Step 2 in the HTML form.',
	'gwtoolset-title-bad' => 'Message that appears when the title derived from the metadata and mediawiki template mapping is not a valid title',
	'gwtoolset-unaccepted-extension' => 'User error message that appears when the uploaded file does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => "User error message that appears when the uploaded file has an unaccepted file extension. The parameter is the extension found.",
	'gwtoolset-unaccepted-mime-type' => 'User error message that appears when the mime type of the file is not accepted. the parameter is the interpreted mime type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'user error message that appears when the mime type of the file is not accepted. The parameter is the interpreted mime type. In this case the XML file may not have an XML declaration at the top of the file.',
	'gwtoolset-upload-legend' => 'Legend for step 1 HTML form.',
	'gwtoolset-user-blocked' => 'Message that appears when the user is blocked from using the wiki.',
	'gwtoolset-verify-api-enabled' => 'Message that appears when the API has not been enabled.',
	'gwtoolset-verify-api-writeable' => 'Message that appears when the API cannot write to the wiki.',
	'gwtoolset-verify-curl' => 'Message that appears when PHP cURL is not available.',
	'gwtoolset-verify-finfo' => 'Message that appears when PHP finfo is not available.',
	'gwtoolset-verify-php-version' => 'Message that appears when the PHP version is less than version 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'Message that appears when the wiki does not allow file uploads.',
	'gwtoolset-verify-xmlreader' => 'Message that appears when PHP XMLReader is not available.',
	'gwtoolset-which-mediawiki-template' => 'Label for which media wiki template in the HTML form.',
	'gwtoolset-which-metadata-mapping' => 'Label for which metadata in the HTML form.',
	'gwtoolset-wiki-checks-not-passed' => 'Heading used when a wiki requirement is not met.',
	'gwtoolset-xml-doctype' => 'A user message that appears when the XML metadata file contains a <!DOCTYPE> section.',
	'gwtoolset-xml-error' => 'User error message when the extension cannot properly load the XML provided.'
);
