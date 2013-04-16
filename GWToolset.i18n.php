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
	'gwtoolset-intro' => 'GWToolset is a MediaWiki extension that allows GLAMs the ability to mass upload content based on an xml file containing respective metadata about the content. The intent is to allow for a variety of xml schemas. Further information about the project can be found on its [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project project page]. Feel free to contacts us on that page as well. Select one of the menu items above to begin the upload process.',

	/**
	 * db client
	 */
	'gwtoolset-db-client-support' => 'The GWToolset extension currently supports only MySQL',

	/**
	 * developer issues
	 */
	'gwtoolset-could-not-close-xml' => 'could not close the XMLReader',
	'gwtoolset-could-not-open-xml' => 'could not open the XML File for reading',
	'gwtoolset-developer-issue' => "Please contact a developer; they will need to address this issue before you can continue [ '''$1''' ].",
	'gwtoolset-dom-record-issue' => 'record-element-name, or record-count not provided',
	'gwtoolset-ignorewarnings' => 'ignorewarnings not set',
	'gwtoolset-no-accepted-types' => 'No accepted types provided',
	'gwtoolset-no-callback' => 'no callback passed to this method',
	'gwtoolset-no-comment' => "user_options['comment'] not set",
	'gwtoolset-no-file-url' => 'no file_url provided to parse',
	'gwtoolset-no-mapping' => 'no mapping_name provided',
	'gwtoolset-no-mapping-json' => 'no mapping_json provided',
	'gwtoolset-no-mediawiki-template' => 'no mediawiki-template-name provided',
	'gwtoolset-no-module' => 'no module name was specified',
	'gwtoolset-no-save-as-batch' => "user_options['save-as-batch-job'] not set",
	'gwtoolset-no-summary' => 'no summary provided',
	'gwtoolset-no-template-url' => 'no template url provided to parse',
	'gwtoolset-no-text' => 'no text provided',
	'gwtoolset-no-title' => 'no title provided',
	'gwtoolset-no-upload-handler' => 'no upload handler was created',
	'gwtoolset-no-upload-media' => "user_options['upload-media'] not set",
	'gwtoolset-no-url-to-media' => 'url-to-the-media-file not set',
	'gwtoolset-no-user' => 'no user object provided',
	'gwtoolset-no-xmlelement' => 'no XMLReader or DOMElement provided',
	'gwtoolset-no-xml-source' => 'no local xml source was given',

	/**
	 * file checks
	 */
	'gwtoolset-disk-write-failure' => 'Failed to write file to disk.',
	'gwtoolset-file-is-empty' => 'The uploaded file is empty.',
	'gwtoolset-improper-upload' => 'File was not uploaded properly.',
	'gwtoolset-mime-type-mismatch' => 'The uploaded file’s extension [ $1 ] and mime-type [ $2 ] do not match.',
	'gwtoolset-missing-temp-folder' => 'Missing a temporary folder.',
	'gwtoolset-no-file' => 'No file received.',
	'gwtoolset-over-max-file-size' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
	'gwtoolset-over-max-ini' => 'The uploaded file exceeds the upload_max_filesize and/or the post_max_size directive in php.ini.',
	'gwtoolset-partial-upload' => 'The uploaded file was only partially uploaded.',
	'gwtoolset-php-extension-error' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
	'gwtoolset-unaccepted-extension' => 'The file source does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => "The file source has an unaccepted file extension [.$1].",
	'gwtoolset-unaccepted-mime-type' => 'The uploaded file is interpreted as having the mime-type [ $1 ], which is not an accepted mime-type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'The uploaded file is interpreted as having the mime-type [ $1 ], which is not an accepted mime-type.<br />Does the xml file have an xml declaration at the top of the file?<br />&lt;?xml version="1.0" encoding="UTF-8"?>',

	/**
	 * general form
	 */
	'gwtoolset-back-link-option' => '⬅ go back to the form',
	'gwtoolset-back-text' => 'Press the browser back button to go back to the form',
	'gwtoolset-file-interpretation-error' => '== There was a problem interpretting the metadata file ==',
	'gwtoolset-mediawiki-template' => '=== $1 Template ===',
	'gwtoolset-metadata-user-options-error' => 'The following form field(s) must be filled in:',
	'gwtoolset-metadata-invalid-template' => 'No valid WikiMedia Template found',
	'gwtoolset-menu' => '* $1',
	'gwtoolset-menu-1' => 'Metadata Mapping',
	'gwtoolset-no-change' => '(no change)',
	'gwtoolset-no-form' => 'There is no form for this module',
	'gwtoolset-technical-error' => '== There was a Technical Error ==',
	'gwtoolset-required-field' => ' denotes required field',
	'gwtoolset-revised' => '(revised)',
	'gwtoolset-submit' => 'Submit',

	/**
	 * js
	 */
	'gwtoolset-loading' => 'Please be patient, this may take awhile',
	'gwtoolset-save-mapping' => 'save mapping',
	'gwtoolset-save-mapping-failed' => 'We apologize, there was a problem processing your request; please try again later.',
	'gwtoolset-save-mapping-succeeded' => 'Your mapping has been successfully saved.',
	'gwtoolset-save-mapping-name' => 'How would you like to name this mapping?',

	/**
	 * json
	 */
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
	'gwtoolset-ensure-well-formed-xml' => 'Make sure the XML File is well-formed with this $1',
	'gwtoolset-file-url-invalid' => 'The file url was invalid; the file does not yet exist in the wiki. You need to first upload the file from your computer if you want to use the file url reference in the form.',
	'gwtoolset-mediawiki-template-not-found' => 'No mediawiki template found for [ $1 ]',
	'gwtoolset-metadata-file-source' => 'Select the metadata file source',
	'gwtoolset-metadata-file-source-info' => '... either a file that has been previously uploaded or a file you wish to upload from your computer',
	'gwtoolset-metadata-file-url' => 'Metadata file wiki url : ',
	'gwtoolset-metadata-file-url-not-present' => 'The metadata file source provided [ $1 ] does not exist.',
	'gwtoolset-metadata-file-upload' => 'Metadata file upload : ',
	'gwtoolset-metadata-mapping-bad' => 'There’s a problem with the metadata mapping; most likely the json format is invalid. please try and correct the issue and then submit the form again.' . PHP_EOL . PHP_EOL . '$1.',
	'gwtoolset-metadata-mapping-invalid-url' => 'The metadata mapping url supplied, [ $1 ], does not match the expect mapping url path [ $2 ]',
	'gwtoolset-metadata-mapping-not-found' => 'No metadata mapping was found in the page [ $1 ]',
	'gwtoolset-no-xml-element-found' => 'No XML element found for mapping.' . PHP_EOL . '* Did you enter a value in the form for “What is the xml element that contains each metadata record”?' . PHP_EOL . '* Is the XML file well-formed? Try this [http://www.w3schools.com/xml/xml_validator.asp XML Validator]',
	'gwtoolset-record-element-name' => 'What is the xml element that contains each metadata record : ',
	'gwtoolset-step-1-instructions' => '== Step 1 : Metadata Detect ==' . PHP_EOL . 'The Metadata Upload process consists of 4 steps:' . PHP_EOL . '# Metadata Detection' . PHP_EOL . '# Metadata Mapping' . PHP_EOL . '# Batch Preview' . PHP_EOL . '# Batch Upload' . PHP_EOL . 'In this step, you either upload a new metadata file, or select a metadata file that has already been uploaded to the wiki for evaluation. The toolset will attempt to extract the metadata fields available in the metadata file, which you will then map to a MediaWiki Template in Step 2 : Metadata Mapping.',
	'gwtoolset-upload-legend' => 'Upload your metadata file',
	'gwtoolset-which-mediawiki-template' => 'Which MediaWiki Template : ',
	'gwtoolset-which-metadata-mapping' => 'Which Metadata Mapping : ',
	'gwtoolset-xml-error' => 'Failed to load the XML; please correct the errors displayed below.',

	/**
	 * step 2 - metadata mapping
	 */
	'gwtoolset-categories' => 'Enter categories separated by a pipe |',
	'gwtoolset-category' => 'category',
	'gwtoolset-create-mapping' => '$1 creating metadata mapping for $2.',
	'gwtoolset-example-record' => 'metadata’s example record’s contents',
	'gwtoolset-global-categories' => 'Global Categories',
	'gwtoolset-global-tooltip' => 'These category entries will be applied globally to all uploaded items',
	'gwtoolset-maps-to' => 'maps to',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Could not evaluate the media file url in order to determine the file extension [ $1 ]',
	'gwtoolset-mapping-media-file-url-bad' => 'Could not evaluate the media file url provided [ $1 ]. The url delivers the content in a way that is not yet handled by this extension.',
	'gwtoolset-mapping-no-title' => 'The metadata mapping contains no title, which is needed in order to create the page',
	'gwtoolset-mapping-no-title-identifier' => 'The metadata mapping contains no title identifier, which is used to create a unique page title; make sure you map a metadata field to the mediawiki template parameter title identifier',
	'gwtoolset-metadata-field' => 'metadata field',
	'gwtoolset-metadata-file' => '==== Metadata file ====',
	'gwtoolset-metadata-mapping-legend' => 'Map your metadata',
	'gwtoolset-no-more-records' => "'''no more records to process'''",
	'gwtoolset-painted-by' => 'Painted by',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-explanation' => 'Partner templates are pulled into the source field of the mediawiki template when provided. You can find a list of current Partner Templates on the Category:Source templates page; see link below. Once you’ve found the Partner Template you wish to use place the url to it in this field. You can also create a new Partner Template if necessary.',
	'gwtoolset-partner-template' => 'partner template : ',
	'gwtoolset-phrasing' => 'phrasing',
	'gwtoolset-preview' => 'preview batch',
	'gwtoolset-process-batch' => 'process the batch',
	'gwtoolset-record-count' => 'total number of records found in this metadata file [ $1 ]',
	'gwtoolset-results' => '=== Results ===',
	'gwtoolset-step-2' => 'Step 2 : Metadata Mapping',
	'gwtoolset-step-2-heading' => '== Step 2 : Metadata Mapping ==',
	'gwtoolset-step-2-instructions' => '==== Mapping the metadata fields ====' . PHP_EOL . 'Below is/are :' . PHP_EOL . '* a list of the fields in the MediaWiki $1' . PHP_EOL . '* drop-down fields that represent the metadata fields found in the metadata file' . PHP_EOL . '* a sample record from the metadata file' . PHP_EOL . "'''In this step you need to map the metadata fields with the MediaWiki template fields.'''" . PHP_EOL . '# select a metadata field under the ‘maps to’ column that corresponds with MediaWiki template field under the ‘template field’ column.' . PHP_EOL . '# you do not need to provide a match for every Mediawiki template field.',
	'gwtoolset-reupload-media' => 're-upload media from url',
	'gwtoolset-reupload-media-explanation' => 'this check box allows you to re-upload media for an item that has already been uploaded to the wiki. if the item already exists, an additional media file will be added to the wiki. if the media file does not yet exist, it will be uploaded whether this checkbox is checked or not.',
	'gwtoolset-specific-categories' => 'Item Specific Categories',
	'gwtoolset-specific-tooltip' => "Using the following fields you can apply a phrase (optional) plus a metadata field as the category entry for each individual uploaded item. For example, if the metadata file contains an element for the artist of each record, you could add that as a category entry for each record that would change to the value specific to each record. You could also add a phrase such as “''Painted by''” and then the artist metadata field, which would yield “''Painted by <artist name>''” as the category for each record.",
	'gwtoolset-summary-tooltip' => 'Enter a short summary [ctrl-option-b]',
	'gwtoolset-template-field' => 'template field',

	/**
	 * step 3 - batch preview
	 */
	'gwtoolset-step-3-instructions' => '== Step 3 : Batch Preview ==' . PHP_EOL . 'Below are the results of uploading the first $1 records from the metadata file you selected and mapping them to the mediawiki template you selected in Step 2 : Metadata Mapping.',
	'gwtoolset-step-3-instructions-2' => 'Review these pages and if the results meet your expectations, and there are additional records waiting to be uploaded, continue the batch upload process by clicking on the “process the batch” button below.',
	'gwtoolset-step-3-instructions-3' => 'If you’re not happy with the results, go back to Step 2 : Metadata Mapping and adjust the mapping as necessary.<br/>If you need to make adjustments to the metadata file itself, go ahead and do so and re-upload it by beginning the process again with Step 1 : Metadata Detect',

	/**
	 * step 4 - batch job creation
	 */
	'gwtoolset-batchjob-metadata-created' => 'Metadata batch job created. Your metadata file will be analyzed shortly and each item will be uploaded to the wiki in a background process. You can check the [ $1 ] page to see when they have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'could not create batchjob for the metadata file',
	'gwtoolset-create-mediafile' => '$1 creating mediafile for $2.',
	'gwtoolset-step-4-heading' => '== Step 4 : Batch Upload ==' . PHP_EOL,

	/**
	 * wiki checks
	 */
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'The PHP ini settings:<br />• upload_max_filesize ( $1 )<br /> • post_max_size( $2 )<br /><br />are set lower than the wiki’s $wgMaxUploadSize ( $3 ); please adjust the PHP ini settings as appropriate.',
	'gwtoolset-permission-not-given' => 'Make sure that you are logged-in or contact an administrator in order to be granted permission to view this page [ $1 ].',
	'gwtoolset-user-blocked' => 'Your user account is currently blocked. Please contact an administrator in order to correct the blocking issue.',
	'gwtoolset-verify-api-enabled' => 'The $1 Extension requires that the wiki API is enabled.<br />Please make sure <code>$wgEnableAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-api-writeable' => 'The $1 Extension requires that the wiki API can perform write actions for authorized users.<br />Please make sure that <code>$wgEnableWriteAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-curl' => 'The $1 Extension requires that PHP [http://www.php.net/manual/en/curl.setup.php cURL functions] be installed.',
	'gwtoolset-verify-finfo' => 'The $1 Extension requires that the PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] extension be installed.',
	'gwtoolset-verify-php-version' => 'The $1 Extension requires PHP >= 5.3.3',
	'gwtoolset-verify-uploads-enabled' => 'The $1 Extension requires that file uploads are enabled.<br />Pleas make sure that <code>$wgEnableUploads</code> is set to <code>true</code> in <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'The $1 Extension requires that PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] be installed.',
	'gwtoolset-wiki-checks-not-passed' => '== Wiki checks did not pass =='
);

/**
 * Message documentation
 * @author dan-nl
 */
$messages['qqq'] = array(
	'gwtoolset' => 'extension name',
	'gwtoolset-desc' => '{{desc|name=GWToolset|url=https://www.mediawiki.org/wiki/Extension:GWToolset}}',
	'gwtoolset-intro' => 'introduction paragraph for the extension used on the initial Special:GWtoolset landing page',
	'gwtoolset-db-client-support' => 'technical error message that appears when the extension does not find MySQL present when updating the database schema',
	'gwtoolset-could-not-close-xml' => 'hint to the developer that appears when could not close the XMLReader',
	'gwtoolset-could-not-open-xml' => 'hint to the developer that appears when could not open the XML File for reading',
	'gwtoolset-developer-issue' => "a user-friendly message that lets the user know that something went wrong that a developer will need to fix. the single parameter takes a message that explains a bit more to the developer what the issue may be.",
	'gwtoolset-dom-record-issue' => 'hint to the developer that appears when record-element-name, or record-count not provided',
	'gwtoolset-ignorewarnings' => 'hint to the developer that appears when ignorewarnings not set',
	'gwtoolset-no-accepted-types' => 'hint to the developer that appears when No accepted types are provided',
	'gwtoolset-no-callback' => 'hint to the developer that appears when no callback is given',
	'gwtoolset-no-comment' => "hint to the developer that appears when user_options['comment'] is not set",
	'gwtoolset-no-file-url' => 'hint to the developer that appears when no file_url is provided to parse',
	'gwtoolset-no-mapping' => 'hint to the developer that appears when no mapping_name is provided',
	'gwtoolset-no-mapping-json' => 'hint to the developer that appears when no mapping_json is provided',
	'gwtoolset-no-mediawiki-template' => 'hint to the developer that appears when no mediawiki-template-name is provided',
	'gwtoolset-no-module' => 'hint to the developer that appears when no module name was specified',
	'gwtoolset-no-save-as-batch' => "hint to the developer that appears when user_options['save-as-batch-job'] is not set",
	'gwtoolset-no-summary' => 'hint to the developer that appears when no summary is provided',
	'gwtoolset-no-template-url' => 'hint to the developer that appears when no template url is provided to parse',
	'gwtoolset-no-text' => 'hint to the developer that appears when no text is provided',
	'gwtoolset-no-title' => 'hint to the developer that appears when no title is provided',
	'gwtoolset-no-upload-handler' => 'hint to the developer that appears when no upload handler was created',
	'gwtoolset-no-upload-media' => "hint to the developer that appears when user_options['upload-media'] is not set",
	'gwtoolset-no-url-to-media' => 'hint to the developer that appears when url-to-the-media-file is not set',
	'gwtoolset-no-user' => 'hint to the developer that appears when no user object is provided',
	'gwtoolset-no-xmlelement' => 'hint to the developer that appears when no XMLReader or DOMElement is provided',
	'gwtoolset-no-xml-source' => 'hint to the developer that appears when no local xml source was given',
	'gwtoolset-disk-write-failure' => 'user error message that appears when the uploaded file Failed to write file to disk.',
	'gwtoolset-file-is-empty' => 'user error message that appears when The uploaded file is empty.',
	'gwtoolset-improper-upload' => 'user error message that appears when a File was not uploaded properly.',
	'gwtoolset-mime-type-mismatch' => 'user error message that appears when The uploaded file’s extension and mime-type do not match. parameter 1 is the extension and parameter 2 is the mime-type detected',
	'gwtoolset-missing-temp-folder' => 'user error message that appears when the wiki cannot find a temporary folder for file uploads.',
	'gwtoolset-no-file' => 'user error message that appears when No file was received.',
	'gwtoolset-over-max-ini' => 'user error message that appears when The uploaded file exceeds the upload_max_filesize directive in php.ini.',
	'gwtoolset-over-max-file-size' => 'user error message that appears when The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
	'gwtoolset-partial-upload' => 'user error message that appears when The uploaded file was only partially uploaded.',
	'gwtoolset-php-extension-error' => 'user error message that appears when A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
	'gwtoolset-unaccepted-extension' => 'user error message that appears when The uploaded file does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => "user error message that appears when The uploaded file has an unaccepted file extension. the parameter is the extension found.",
	'gwtoolset-unaccepted-mime-type' => 'user error message that appears when the mime type of the file is not accepted. the parameter is the interpreted mime type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'user error message that appears when the mime type of the file is not accepted. the parameter is the interpreted mime type. in this case the xml file may not have an xml declaration at the top of the file',
	'gwtoolset-back-link-option' => 'message to the user to go back to the form',
	'gwtoolset-back-text' => 'message to the user to Press the browser back button to go back to the form',
	'gwtoolset-file-interpretation-error' => 'heading that appears when There was a problem interpreting the metadata file',
	'gwtoolset-metadata-user-options-error' => 'initial paragraph that notifies the user that there are form fields missing. the specific form fields that are missing are mentioned separately',
	'gwtoolset-metadata-invalid-template' => 'appears when No valid WikiMedia Template found',
	'gwtoolset-mediawiki-template' => 'heading used on the mapping page. the parameter is filled in with the wiki template name that will be used for mapping the metadata to the wiki template',
	'gwtoolset-menu' => 'the extension menu list',
	'gwtoolset-menu-1' => 'the first menu item for the extension menu list',
	'gwtoolset-no-change' => 'appears when there has been no change to a wiki page',
	'gwtoolset-no-form' => 'appears when There is no form for this module',
	'gwtoolset-technical-error' => 'heading for error messages of a technical nature',
	'gwtoolset-required-field' => ' denotes required field',
	'gwtoolset-revised' => 'appears when a wiki page has been revised',
	'gwtoolset-submit' => 'submit button text for metadata forms',
	'gwtoolset-loading' => 'JavaScript loading message for when the user needs to wait for the application',
	'gwtoolset-save-mapping' => 'text used for a button on the mapping form page',
	'gwtoolset-save-mapping-failed' => 'message to the user that appears when their mapping could not be saved.',
	'gwtoolset-save-mapping-succeeded' => 'message to the user that appears when their mapping was successfully saved.',
	'gwtoolset-save-mapping-name' => 'JavaScript prompt to the user asking them under which name they would like to save their mapping',
	'gwtoolset-json-error-ctrl-char' => 'user error message when Unexpected control character found.',
	'gwtoolset-json-error-depth' => 'user error message when Maximum stack depth exceeded.',
	'gwtoolset-json-error-none' => 'user error message when No errors.',
	'gwtoolset-json-error-state-mismatch' => 'user error message when Underflow or the modes mismatch.',
	'gwtoolset-json-error-syntax' => 'user error message when Syntax error, malformed JSON.',
	'gwtoolset-json-error-unknown' => 'user error message when Unknown error.',
	'gwtoolset-json-error-utf8' => 'user error message when malformed UTF-8 characters, possibly incorrectly encoded.',
	'gwtoolset-accepted-file-types' => 'label for the HTML form',
	'gwtoolset-create-metadata' => 'summary message used when the extension creates/updates a metadata content page. parameter 1 is the extension name. parameter 2 is the user name',
	'gwtoolset-ensure-well-formed-xml' => 'additional instructions that will help the user Make sure the XML File is well-formed',
	'gwtoolset-file-url-invalid' => 'user error message when The file url was invalid',
	'gwtoolset-metadata-file-source' => 'label for the HTML form',
	'gwtoolset-metadata-file-source-info' => 'additional instructions for the HTML form',
	'gwtoolset-metadata-file-url' => 'label for the HTML form',
	'gwtoolset-metadata-file-upload' => 'label for the HTML form',
	'gwtoolset-mediawiki-template-not-found' => 'user error message when No mediawiki template found. parameter is the template name that was not found',
	'gwtoolset-metadata-file-url-not-present' => 'user error message when No metadata file was uploaded nor was a local wiki url for the metadata file provided.',
	'gwtoolset-metadata-mapping-bad' => 'user error when There’s a problem with the metadata mapping json format. the parameter is the technical error message given by php for the specific json error',
	'gwtoolset-metadata-mapping-invalid-url' => 'user error message when The metadata mapping url supplied, does not match the expect mapping url path. parameter 1 is the url provided. parameter 2 is the expected url path',
	'gwtoolset-metadata-mapping-not-found' => 'user error message when No metadata mapping was found in the page. the parameter is the url to the page',
	'gwtoolset-no-xml-element-found' => 'user error message when No XML element found for mapping',
	'gwtoolset-record-element-name' => 'label for the HTML form',
	'gwtoolset-step-1-instructions' => 'instructions for step 1',
	'gwtoolset-upload-legend' => 'legend for the step 1 HTML form',
	'gwtoolset-which-mediawiki-template' => 'label for the HTML form',
	'gwtoolset-which-metadata-mapping' => 'label for the HTML form',
	'gwtoolset-xml-error' => 'user error message when the extension cannot properly load the xml provided.',
	'gwtoolset-categories' => 'instructions for the HTML form',
	'gwtoolset-category' => 'label for the HTML form',
	'gwtoolset-create-mapping' => 'summary message used when the extension creates/updates a metadata mapping content page. parameter 1 is the extension name. parameter 2 is the user name',
	'gwtoolset-example-record' => 'label for the HTML form',
	'gwtoolset-global-categories' => 'heading for a section in the HTML form',
	'gwtoolset-global-tooltip' => 'instructions for the HTML form',
	'gwtoolset-mapping-media-file-url-bad' => 'user error message when the extension Could not evaluate the media file url. provided parameter 1 is the url provided.',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'user error message when the extension Could not evaluate the media file url in order to determine the file extension. parameter 1 is the url to the fiel or the file name given.',
	'gwtoolset-mapping-no-title' => 'user error message when The metadata mapping contains no title',
	'gwtoolset-mapping-no-title-identifier' => 'user error message when The metadata mapping contains no title identifier',
	'gwtoolset-maps-to' => 'label for the HTML form',
	'gwtoolset-metadata-field' => 'label for the HTML form',
	'gwtoolset-metadata-file' => 'heading for displaying some information about the metadata file',
	'gwtoolset-metadata-mapping-legend' => 'legend for the step 2 HTML form',
	'gwtoolset-no-more-records' => 'user message that appears when there are no more records to process',
	'gwtoolset-painted-by' => 'label for the HTML form',
	'gwtoolset-partner' => 'heading for a section in the HTML form',
	'gwtoolset-partner-explanation' => 'instructions for the HTML form',
	'gwtoolset-partner-template' => 'label for the HTML form',
	'gwtoolset-phrasing' => 'label for the HTML form',
	'gwtoolset-preview' => 'text for HTML form button',
	'gwtoolset-process-batch' => 'text for HTML form button',
	'gwtoolset-record-count' => 'user message that indicates the total number of records found in the metadata file. parameter 1 is the total number of records found.',
	'gwtoolset-results' => 'heading when results are given',
	'gwtoolset-reupload-media' => 'label for the HTML form',
	'gwtoolset-reupload-media-explanation' => 'HTML form instructions',
	'gwtoolset-specific-categories' => 'heading for a section in the HTML form',
	'gwtoolset-specific-tooltip' => 'instructions for the HTML form',
	'gwtoolset-summary-tooltip' => 'title tooltip for the summary field',
	'gwtoolset-step-2' => 'heading used by JavaScript',
	'gwtoolset-step-2-heading' => 'heading used by the HTML form',
	'gwtoolset-step-2-instructions' => 'instructions for step 2',
	'gwtoolset-template-field' => 'label for the HTML form',
	'gwtoolset-step-3-instructions' => 'heading and instructions for step 3',
	'gwtoolset-step-3-instructions-2' => 'additional instructions for step 3',
	'gwtoolset-step-3-instructions-3' => 'additional instructions for step 3',
	'gwtoolset-batchjob-metadata-created' => 'user message when Metadata batch job was created. parameter 1 is a link to a page, Special:NewFiles, the user can use to see if their media files have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'user error message that appears when the extension could not create a batchjob for the metadata file',
	'gwtoolset-create-mediafile' => 'summary message used when the extension creates/updates a media file content page. parameter 1 is the extension name. parameter 2 is the user name',
	'gwtoolset-step-4-heading' => 'heading for step 4',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'user message that appears when the PHP ini settings are less that the wiki’s $wgMaxUploadSize setting',
	'gwtoolset-permission-not-given' => 'appears when the requirement is not met.',
	'gwtoolset-user-blocked' => 'appears when the user is blocked.',
	'gwtoolset-verify-api-enabled' => 'appears when the requirement is not met.',
	'gwtoolset-verify-api-writeable' => 'appears when the requirement is not met.',
	'gwtoolset-verify-curl' => 'appears when the requirement is not met.',
	'gwtoolset-verify-finfo' => 'appears when the requirement is not met.',
	'gwtoolset-verify-php-version' => 'appears when the requirement is not met.',
	'gwtoolset-verify-uploads-enabled' => 'appears when the requirement is not met.',
	'gwtoolset-verify-xmlreader' => 'appears when the requirement is not met.',
	'gwtoolset-wiki-checks-not-passed' => 'heading used when a wiki requirement is not met'
);
