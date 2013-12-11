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
	'gwtoolset-intro' => 'GWToolset is a MediaWiki extension that allows GLAMs (Galleries, Libraries, Archives and Museums) the ability to mass upload content based on an XML file containing respective metadata about the content. The intent is to allow for a variety of XML schemas. Further information about the project can be found on its [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project project page]. Feel free to contact us on that page as well. Select one of the menu items above to begin the upload process.',

	/**
	 * developer issues
	 */
	'gwtoolset-batchjob-creation-failure' => 'Could not create a batch job of type "$1".',
	'gwtoolset-could-not-close-xml' => 'Could not close the XML reader.',
	'gwtoolset-could-not-open-xml' => 'Could not open the XML file for reading.',
	'gwtoolset-developer-issue' => "Please contact a developer. This issue must be addressed before you can continue. Please add the following text to your report:

$1",
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, or <code>record-count</code>, or <code>record-current</code> not provided.',
	'gwtoolset-file-backend-maxage-invalid' => 'The maximum age value provided in <code>$wgGWTFBMaxAge</code> is invalid.
See the [php.net/manual/en/datetime.formats.relative.php PHP manual] for how to set it correctly.',
	'gwtoolset-fsfile-empty' => 'The file was empty and was deleted.',
	'gwtoolset-fsfile-retrieval-failure' => 'The file could not be retrieved from URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> not set.',
	'gwtoolset-incorrect-form-handler' => 'The module "$1" has not registered a form handler extending GWToolset\Handlers\Forms\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'The batch job throttle was exceeded.',
	'gwtoolset-no-accepted-types' => 'No accepted types provided',
	'gwtoolset-no-callback' => 'No callback passed to this method.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> not set.",
	'gwtoolset-no-field-size' => 'No field size specified for the field "$1".',
	'gwtoolset-no-file-backend-name' => 'No file backend name provided.',
	'gwtoolset-no-file-backend-container' => 'No file backend container name provided.',
	'gwtoolset-no-file-url' => 'No <code>file_url</code> provided to parse.',
	'gwtoolset-no-form-handler' => 'No form handler created.',
	'gwtoolset-no-mapping' => 'No <code>mapping_name</code> provided.',
	'gwtoolset-no-mapping-json' => 'No <code>mapping_json</code> provided.',
	'gwtoolset-no-mediawiki-template' => 'No <code>mediawiki-template-name</code> provided.',
	'gwtoolset-no-module' => 'No module name was specified.',
	'gwtoolset-no-mwstore-complete-path' => 'No complete file path provided.',
	'gwtoolset-no-mwstore-relative-path' => 'No relative path provided.',
	'gwtoolset-no-page-title' => 'No page title provided.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> not set.",
	'gwtoolset-no-source-array' => 'No source array provided.',
	'gwtoolset-no-summary' => 'No summary provided.',
	'gwtoolset-no-template-url' => 'No template URL provided to parse.',
	'gwtoolset-no-text' => 'No text provided.',
	'gwtoolset-no-title' => 'No title provided.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> not set.",
	'gwtoolset-no-url-to-evaluate' => 'No URL provided for evaluation.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> not set.',
	'gwtoolset-no-user' => 'No user object provided.',
	'gwtoolset-no-xml-element' => 'No XMLReader or DOMElement provided.',
	'gwtoolset-no-xml-source' => 'No local XML source provided.',
	'gwtoolset-not-string' => 'The value provided to the method was not a string. It is of type "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 does not match.',

	/**
	 * file checks
	 */
	'gwtoolset-disk-write-failure' => 'The server could not write the file to a file system.',
	'gwtoolset-xml-doctype' => 'The XML metadata file cannot contain a <!DOCTYPE> section. Remove it and then try uploading the XML metadata file again.',
	'gwtoolset-file-is-empty' => 'The uploaded file is empty.',
	'gwtoolset-improper-upload' => 'The file was not uploaded properly.',
	'gwtoolset-mime-type-mismatch' => 'The file extension "$1" and MIME type "$2" of the uploaded file do not match.',
	'gwtoolset-missing-temp-folder' => 'No temporary folder available.',
	'gwtoolset-multiple-files' => 'The file that was uploaded contains information on more than one file. Only one file can be submitted at a time.',
	'gwtoolset-no-extension' => 'The file that was uploaded does not contain enough information to process the file. Most likely it has no file extension.',
	'gwtoolset-no-file' => 'No file was received.',
	'gwtoolset-no-form-field' => 'The expected form field "$1" does not exist.',
	'gwtoolset-over-max-ini' => 'The file that was uploaded exceeds the <code>upload_max_filesize</code> and/or the <code>post_max_size</code> directive in <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'The file was only partially uploaded.',
	'gwtoolset-php-extension-error' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop. Examining the list of loaded extensions with <code>phpinfo()</code> may help.',
	'gwtoolset-unaccepted-extension' => 'The file source does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => 'The file source has an unaccepted file extension ".$1".',
	'gwtoolset-unaccepted-mime-type' => 'The uploaded file is interpreted as having the MIME type "$1", which is not an accepted MIME type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'The uploaded file has the MIME type "$1", which is not an accepted. Does the XML file have an XML declaration at the top of the file?

&lt;?xml version="1.0" encoding="UTF-8"?>',

	/**
	 * general form
	 */
	'gwtoolset-back-text-link' => '← go back to the form',
	'gwtoolset-back-text' => 'Press the browser back button to go back to the form.',
	'gwtoolset-file-interpretation-error' => 'There was a problem processing the metadata file',
	'gwtoolset-mediawiki-template' => 'Template $1',
	'gwtoolset-metadata-user-options-error' => 'The following form {{PLURAL:$2|field|fields}} must be filled in:
$1',
	'gwtoolset-metadata-invalid-template' => 'No valid MediaWiki template found.',
	'gwtoolset-menu' => '* $1',
	'gwtoolset-menu-1' => 'Metadata mapping',
	'gwtoolset-technical-error' => 'There was a technical error.',
	'gwtoolset-required-field' => ' denotes required field',
	'gwtoolset-submit' => 'Submit',
	'gwtoolset-summary-heading' => 'Summary',

	/**
	 * js
	 */
	'gwtoolset-cancel' => 'Cancel',
	'gwtoolset-loading' => 'Please be patient. This may take a while.',
	'gwtoolset-save' => 'Save',
	'gwtoolset-save-mapping' => 'Save mapping',
	'gwtoolset-save-mapping-failed' => 'Sorry. There was a problem processing your request. Please try again later. (Error message: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Your mapping has been saved.',
	'gwtoolset-save-mapping-name' => 'How would you like to name this mapping?',

	/**
	 * json
	 */
	'gwtoolset-json-error' => 'There was a problem with the JSON. Error: $1.', // keep this for future use when necessary
	'gwtoolset-json-error-depth' => 'Maximum stack depth exceeded.',
	'gwtoolset-json-error-state-mismatch' => 'Underflow or the modes mismatch.',
	'gwtoolset-json-error-ctrl-char' => 'Unexpected control character found.',
	'gwtoolset-json-error-syntax' => 'Syntax error, malformed JSON.',
	'gwtoolset-json-error-utf8' => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
	'gwtoolset-json-error-unknown' => 'Unknown error.',

	/**
	 * step 1 - metadata detect
	 */
	'gwtoolset-accepted-file-types' => 'Accepted file {{PLURAL:$1|type|types}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Make sure the XML file is well-formed with this $1.',
	'gwtoolset-file-url-invalid' => 'The file URL was invalid; The file does not yet exist in the wiki. You need to first upload the file from your computer if you want to use the file URL reference in the form.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'MediaWiki template "<strong>$1</strong>" does not exist in the wiki.

Either import the template or select another MediaWiki template to use for mapping.',
	'gwtoolset-mediawiki-template-not-found' => 'No MediaWiki template "$1" not found.',
	'gwtoolset-metadata-file-source' => 'Select the metadata file source.',
	'gwtoolset-metadata-file-source-info' => '... either a file that has been previously uploaded or a file you wish to upload from your computer.',
	'gwtoolset-metadata-file-url' => 'Metadata file wiki URL:',
	'gwtoolset-metadata-file-upload' => 'Metadata file upload:',
	'gwtoolset-metadata-mapping-bad' => 'There is a problem with the metadata mapping. Most likely the JSON format is invalid. Try and correct the issue and then submit the form again.

$1.',
	'gwtoolset-metadata-mapping-invalid-url' => 'The metadata mapping URL supplied, does not match the expect mapping URL path.

* Supplied URL: $1
* Expected URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'No metadata mapping was found.

The page "<strong>$1<strong>" does not exist in the wiki.',
	'gwtoolset-namespace-mismatch' => 'The page "<strong>$1<strong>" is in the wrong namespace "<strong>$2<strong>".

It should be in the namespace "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'No XML element found for mapping.
* Did you enter a value in the form for "{{int:gwtoolset-record-element-name}}"?
* Is the XML file well-formed? Try this $1.',
	'gwtoolset-page-title-contains-url' => 'The page "$1" contains the entire wiki URL. Make sure you only enter the page title, e.g. the part of the URL after /wiki/',
	'gwtoolset-record-element-name' => 'What is the XML element that contains each metadata record:',
	'gwtoolset-step-1-heading' => 'Step 1: Metadata detection',
	'gwtoolset-step-1-instructions-1' => 'The metadata upload process consists of 4 steps:',
	'gwtoolset-step-1-instructions-2' => 'In this step, you upload a new metadata file to the wiki. The tool will attempt to extract the metadata fields available in the metadata file, which you will then map to a MediaWiki template in "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3' => 'If your media file domain is not listed below, please [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment request] that your media file domain be added to the Wikimedia Commons domain whitelist. The domain whitelist is a list of domains Wikimedia Commons checks against before fetching media files. If your media file domain is not on that list, Wikimedia Commons will not download media files from that domain. The best example, to submit in your request, is an actual link to a media file.',
	'gwtoolset-step-1-instructions-3-heading' => 'Domain whitelist',
	'gwtoolset-step-1-instructions-li-1' => 'Metadata detection',
	'gwtoolset-step-1-instructions-li-2' => 'Metadata mapping',
	'gwtoolset-step-1-instructions-li-3' => 'Batch preview',
	'gwtoolset-step-1-instructions-li-4' => 'Batch upload',
	'gwtoolset-upload-legend' => 'Upload your metadata file',
	'gwtoolset-which-mediawiki-template' => 'Which MediaWiki template:',
	'gwtoolset-which-metadata-mapping' => 'Which metadata mapping:',
	'gwtoolset-xml-error' => 'Failed to load the XML. Please correct the errors below.',

	/**
	 * step 2 - metadata mapping
	 */
	'gwtoolset-categories' => 'Enter categories separated by a pipe character ("|")',
	'gwtoolset-category' => 'Category',
	'gwtoolset-create-mapping' => '$1: Creating metadata mapping for $2.',
	'gwtoolset-example-record' => 'Metadata\'s example record\'s contents.',
	'gwtoolset-global-categories' => 'Global categories',
	'gwtoolset-global-tooltip' => 'These category entries will be applied globally to all uploaded items.',
	'gwtoolset-maps-to' => 'Maps to',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'The file extension could not be determined from the file URL: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'The media file URL could not be evaluated. The URL delivers the content in a way that is not yet handled by this extension. URL given was "$1".',
	'gwtoolset-mapping-no-title' => 'The metadata mapping contains no title, which is needed in order to create the page.',
	'gwtoolset-mapping-no-title-identifier' => 'The metadata mapping contains no title identifier, which is used to create a unique page title. Make sure you map a metadata field to the MediaWiki template parameter title identifier.',
	'gwtoolset-metadata-field' => 'Metadata field',
	'gwtoolset-metadata-file' => 'Metadata file',
	'gwtoolset-metadata-mapping-legend' => 'Map your metadata',
	'gwtoolset-no-more-records' => "<strong>No more records to process</strong>",
	'gwtoolset-painted-by' => 'Painted by',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-explanation' => 'Partner templates are pulled into the source field of the MediaWiki template when provided. You can find a list of current partner templates on the Category:Source templates page; see link below. Once you have found the partner template you wish to use place the URL to it in this field. You can also create a new partner template if necessary.',
	'gwtoolset-partner-template' => 'Partner template:',
	'gwtoolset-phrasing' => 'Phrasing',
	'gwtoolset-preview' => 'Preview batch',
	'gwtoolset-process-batch' => 'Process batch',
	'gwtoolset-record-count' => 'Total number of records found in this metadata file: {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Results',
	'gwtoolset-step-2-heading' => 'Step 2: Metadata mapping',
	'gwtoolset-step-2-instructions-heading' => 'Mapping the metadata fields',
	'gwtoolset-step-2-instructions-1' => 'Below is/are :',
	'gwtoolset-step-2-instructions-1-li-1' => 'A list of the fields in the MediaWiki $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Drop-down fields that represent the metadata fields found in the metadata file.',
	'gwtoolset-step-2-instructions-1-li-3' => 'A sample record from the metadata file.',
	'gwtoolset-step-2-instructions-2' => 'In this step you need to map the metadata fields with the MediaWiki template fields.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Select a metadata field under the "{{int:gwtoolset-maps-to}}" column that corresponds with a MediaWiki template field under the "{{int:gwtoolset-template-field}}" column.',
	'gwtoolset-step-2-instructions-2-li-2' => 'You do not need to provide a match for every MediaWiki template field.',
	'gwtoolset-reupload-media' => 'Re-upload media from URL',
	'gwtoolset-reupload-media-explanation' => 'This check box allows you to re-upload media for an item that has already been uploaded to the wiki. If the item already exists, an additional media file will be added to the wiki. If the media file does not yet exist, it will be uploaded whether this checkbox is checked or not.',
	'gwtoolset-specific-categories' => 'Item specific categories',
	'gwtoolset-specific-tooltip' => "Using the following fields you can apply a phrase (optional) plus a metadata field as the category entry for each individual uploaded item. For example, if the metadata file contains an element for the artist of each record, you could add that as a category entry for each record that would change to the value specific to each record. You could also add a phrase such as \"<em>{{int:gwtoolset-painted-by}}</em>\" and then the artist metadata field, which would yield \"<em>{{int:gwtoolset-painted-by}} <artist name></em>\" as the category for each record.",
	'gwtoolset-template-field' => 'Template field',

	/**
	 * step 3 - batch preview
	 */
	'gwtoolset-step-3-instructions-heading' => 'Step 3: Batch preview',
	'gwtoolset-step-3-instructions-1' => 'Below are the results of uploading the {{PLURAL:$1|first record|first $1 records}} from the metadata file you selected and mapping {{PLURAL:$1|it|them}} to the MediaWiki template you selected in "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-3-instructions-2' => 'Review these pages and if the results meet your expectations, and there are additional records waiting to be uploaded, continue the batch upload process by clicking on the "{{int:gwtoolset-process-batch}}" button below.',
	'gwtoolset-step-3-instructions-3' => 'If you are not happy with the results, go back to "{{int:gwtoolset-step-2-heading}}" and adjust the mapping as necessary.

If you need to make adjustments to the metadata file itself, go ahead and do so and re-upload it by beginning the process again with "{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => "The title created, based on the metadata and MediaWiki template mapping is not valid.

Try another field from the metadata for title and title-identifier, or if possible, change the metadata where needed. See [https://commons.wikimedia.org/wiki/Commons:File_naming File naming] for more information.

<strong>Invalid title:</strong> $1.",

	/**
	 * step 4 - batch job creation
	 */
	'gwtoolset-batchjob-metadata-created' => 'Metadata batch job created. Your metadata file will be analyzed shortly and each item will be uploaded to the wiki in a background process. You can check the page "$1" to see when they have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Could not create batch job for the metadata file.',
	'gwtoolset-create-mediafile' => '$1: Creating mediafile for $2.',
	'gwtoolset-mediafile-jobs-created' => 'Created $1 mediafile batch {{PLURAL:$1|job|jobs}}.',
	'gwtoolset-step-4-heading' => 'Step 4: Batch upload',

	/**
	 * wiki checks
	 */
	'gwtoolset-invalid-token' => 'The edit token submitted with the form is invalid.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Current <code>php.ini</code> settings:

• <code>upload_max_filesize</code>: $1
• <code>post_max_size</code>: $2

These are set lower than the wiki\'s <code>$wgMaxUploadSize</code>, which is set at "$3". Please adjust the <code>php.ini</code> settings as appropriate.',
	'gwtoolset-mediawiki-version-invalid' => 'This extension requires MediaWiki version $1<br />This MediaWiki version is $2.',
	'gwtoolset-no-upload-by-url' => 'You are not part of a group that has the right to upload by URL.',
	'gwtoolset-permission-not-given' => 'Make sure that you are logged in or contact an administrator in order to be granted permission to view this page ($1).',
	'gwtoolset-user-blocked' => 'Your user account is currently blocked. Please contact an administrator in order to correct the blocking issue.',
	'gwtoolset-required-group' => 'You are not a member of the, $1, group.',
	'gwtoolset-verify-api-enabled' => 'The $1 extension requires that the wiki API is enabled.

Please make sure <code>$wgEnableAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-api-writeable' => 'The $1 extension requires that the wiki API can perform write actions for authorized users.

Please make sure that <code>$wgEnableWriteAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
	'gwtoolset-verify-curl' => 'The $1 extension requires that PHP [http://www.php.net/manual/en/curl.setup.php cURL functions] be installed.',
	'gwtoolset-verify-finfo' => 'The $1 extension requires that the PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] extension be installed.',
	'gwtoolset-verify-php-version' => 'The $1 extension requires PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'The $1 extension requires that file uploads are enabled.

Please make sure that <code>$wgEnableUploads</code> is set to <code>true</code> in <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'The $1 extension requires that PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] be installed.',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki checks did not pass'
);

/** Message documentation (Message documentation)
 * @author Shirayuki
 * @author dan-nl
 */
$messages['qqq'] = array(
	'gwtoolset' => 'extension name',
	'gwtoolset-desc' => '{{desc|name=GWToolset|url=https://www.mediawiki.org/wiki/Extension:GWToolset}}',
	'gwtoolset-intro' => 'Introduction paragraph for the extension used on the initial [[Special:GWToolset]] landing page.',
	'gwtoolset-batchjob-creation-failure' => 'Message that appears when the extension could not create a batch job. Parameters:
* $1 - the type of batch job.',
	'gwtoolset-could-not-close-xml' => 'Hint to the developer that appears when could not close the XMLReader.',
	'gwtoolset-could-not-open-xml' => 'Hint to the developer that appears when could not open the XML File for reading.',
	'gwtoolset-developer-issue' => 'A user-friendly message that lets the user know that something went wrong that a developer will need to fix. Parameters:
* $1 is a technical message targeted at developers that explains a bit more what the issue may be.',
	'gwtoolset-dom-record-issue' => 'Hint to the developer that appears when record-element-name, or record-count or record-current not provided.',
	'gwtoolset-file-backend-maxage-invalid' => 'Message that appears when the max age value provided is invalid.',
	'gwtoolset-fsfile-empty' => 'Message displayed when the mwstored file contains nothing in it.',
	'gwtoolset-fsfile-retrieval-failure' => 'Message that appears when the extension could not retrieve a file from the file backend.

Parameters:
* $1 - the mwstore URL to the file',
	'gwtoolset-ignorewarnings' => 'Hint to the developer that appears when ignorewarnings is not set.',
	'gwtoolset-incorrect-form-handler' => 'A developer message that appears when a module does not specify a form handler that extends GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'Developer message that appears when the batch job throttle was exceeded.',
	'gwtoolset-no-accepted-types' => 'Hint to the developer that appears when no accepted types are provided.',
	'gwtoolset-no-callback' => 'Hint to the developer that appears when no callback is given.',
	'gwtoolset-no-comment' => "Hint to the developer that appears when user_options['comment'] is not set.",
	'gwtoolset-no-field-size' => 'Developer message that appears when no field size was specified for the field. Parameters:
* $1 is the name field.',
	'gwtoolset-no-file-backend-name' => 'Message that appears when a web admin does not provide a file backend name.',
	'gwtoolset-no-file-backend-container' => 'Message that appears wher no file backend container name was provided.',
	'gwtoolset-no-file-url' => 'Hint to the developer that appears when no file_url is provided to parse.',
	'gwtoolset-no-form-handler' => 'Hint to the developer that appears when no form handler was created.',
	'gwtoolset-no-mapping' => 'Hint to the developer that appears when no mapping_name is provided.',
	'gwtoolset-no-mapping-json' => 'Hint to the developer that appears when no mapping_json is provided.',
	'gwtoolset-no-mediawiki-template' => 'Hint to the developer that appears when no mediawiki-template-name is provided.',
	'gwtoolset-no-module' => 'Hint to the developer that appears when no module name was specified.',
	'gwtoolset-no-mwstore-complete-path' => 'Developer message that appears when no mwstore complete file path provied.',
	'gwtoolset-no-mwstore-relative-path' => 'Developer message that appears when no mwstore relative path is provided.',
	'gwtoolset-no-page-title' => 'Appears when no page title was provided.',
	'gwtoolset-no-save-as-batch' => "Hint to the developer that appears when user_options['save-as-batch-job'] is not set.",
	'gwtoolset-no-source-array' => 'Developer message that appears when no source array was provided to a method.',
	'gwtoolset-no-summary' => 'Hint to the developer that appears when no summary is provided.',
	'gwtoolset-no-template-url' => 'Hint to the developer that appears when no template URL is provided to parse.',
	'gwtoolset-no-text' => 'Hint to the developer that appears when no text is provided.',
	'gwtoolset-no-title' => 'Hint to the developer that appears when no title is provided.',
	'gwtoolset-no-reupload-media' => "Hint to the developer that appears when user_options['gwtoolset-reupload-media'] is not set.",
	'gwtoolset-no-url-to-evaluate' => 'Message that appears when no URL was provided for evaluation.',
	'gwtoolset-no-url-to-media' => 'Hint to the developer that appears when url-to-the-media-file is not set.',
	'gwtoolset-no-user' => 'Hint to the developer that appears when no user object is provided.',
	'gwtoolset-no-xml-element' => 'Hint to the developer that appears when no XMLReader or DOMElement is provided.',
	'gwtoolset-no-xml-source' => 'Hint to the developer that appears when no local XML source was given',
	'gwtoolset-not-string' => 'Developer message that appears when the value provided to the method was not a string. Parameters:
* $1 is the actual type of the value.',
	'gwtoolset-sha1-does-not-match' => 'Message that appears when the SHA-1 hash of a file does not match the expected SHA-1 hash.',
	'gwtoolset-disk-write-failure' => 'User error message that appears when the uploaded file failed to write to disk.',
	'gwtoolset-xml-doctype' => 'A user message that appears when the XML metadata file contains a <!DOCTYPE> section.',
	'gwtoolset-file-is-empty' => 'User error message that appears when the uploaded file is empty.',
	'gwtoolset-improper-upload' => 'User error message that appears when a File was not uploaded properly.',
	'gwtoolset-mime-type-mismatch' => 'User error message that appears when the uploaded file’s extension and mime-type do not match. Parameters:
* $1 is the extension
* $2 is the MIME type detected.',
	'gwtoolset-missing-temp-folder' => 'User error message that appears when the wiki cannot find a temporary folder for file uploads.',
	'gwtoolset-multiple-files' => 'User message that appears when the file submitted contains information on more than one file.',
	'gwtoolset-no-extension' => 'User message that appears when the file submitted does not contain enough information to process the file; most likely there is no file extension.',
	'gwtoolset-no-file' => 'User error message that appears when no file was received by the upload form.',
	'gwtoolset-no-form-field' => 'Developer message that appears when the expected form field does not exist. Parameters:
* $1 is the name of the expected form field.',
	'gwtoolset-over-max-ini' => 'User error message that appears when the uploaded file exceeds the upload_max_filesize directive in php.ini.',
	'gwtoolset-partial-upload' => 'User error message that appears when the uploaded file was only partially uploaded.',
	'gwtoolset-php-extension-error' => 'User error message that appears when a PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
	'gwtoolset-unaccepted-extension' => 'User error message that appears when the uploaded file does not contain an accepted file extension.',
	'gwtoolset-unaccepted-extension-specific' => 'User error message that appears when the uploaded file has an unaccepted file extension. Parameters:
* $1 is the extension found.',
	'gwtoolset-unaccepted-mime-type' => 'User error message that appears when the mime type of the file is not accepted. Parameters:
* $1 is the interpreted MINE type.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'User error message that appears when the mime type of the file is not accepted. Parameters:
* $1 is the interpreted MIME type. In this case the XML file may not have an XML declaration at the top of the file.',
	'gwtoolset-back-text-link' => 'gwtoolset-back-text is replaced by an anchor tag when JavaScript is active; this text is used as the text of the anchor tag.',
	'gwtoolset-back-text' => 'User message telling the user to use the browser back button to go back to the HTML form. When JavaScript is active this message is replaced with an anchor tag using gwtoolset-back-text-link.',
	'gwtoolset-file-interpretation-error' => 'Heading that appears when there was a problem interpreting the metadata file.',
	'gwtoolset-mediawiki-template' => 'Heading used on the mapping page. Parameters:
* $1 is the wiki template name that will be used for mapping the metadata to the wiki template.',
	'gwtoolset-metadata-user-options-error' => 'Initial paragraph that notifies the user that there are form fields missing. The specific form fields that are missing are mentioned separately.

Parameters:
* $1 - list of fields. e.g. <code>gwtoolset-mediawiki-template-name</code> (untranslatable)
* $2 - number of fields, used for PLURAL',
	'gwtoolset-metadata-invalid-template' => 'Message that appears when no valid MediaWiki template is found.',
	'gwtoolset-menu' => 'The extension menu list. Parameters:
* $1 is a parameter placeholder that will be replaced with HTML list elements.',
	'gwtoolset-menu-1' => 'The first menu item for the extension menu list.',
	'gwtoolset-technical-error' => 'Heading for error messages of a technical nature.',
	'gwtoolset-required-field' => 'Denotes required field.

Preceded by a red "<span style="color:red">*</span>"',
	'gwtoolset-submit' => 'Submit button text for metadata forms.
{{Identical|Submit}}',
	'gwtoolset-summary-heading' => 'Summary heading for the metadata mapping form.
{{Identical|Summary}}',
	'gwtoolset-cancel' => 'Label for the cancel button.
{{Identical|Cancel}}',
	'gwtoolset-loading' => 'JavaScript loading message for when the user needs to wait for the application.',
	'gwtoolset-save' => 'Label for the save button.
{{Identical|Save}}',
	'gwtoolset-save-mapping' => 'Label for the save mapping button.',
	'gwtoolset-save-mapping-failed' => 'Message to the user that appears when their mapping could not be saved. Parameters:
* $1 is any error information that may have been provided.',
	'gwtoolset-save-mapping-succeeded' => 'Message to the user that appears when their mapping was saved.',
	'gwtoolset-save-mapping-name' => 'JavaScript prompt to the user asking them under which name they would like to save their mapping.',
	'gwtoolset-json-error' => 'Appears when there is a problem with a JSON value.',
	'gwtoolset-json-error-depth' => 'User error message when the maximum stack depth is exceeded.',
	'gwtoolset-json-error-state-mismatch' => 'User error message when underflow or the modes mismatch.',
	'gwtoolset-json-error-ctrl-char' => 'User error message when an unexpected control character has been found.',
	'gwtoolset-json-error-syntax' => 'User error message when there is a syntax error; a malformed JSON.',
	'gwtoolset-json-error-utf8' => 'User error message when there are malformed UTF-8 characters, possibly incorrectly encoded.',
	'gwtoolset-json-error-unknown' => 'User error message when there’s an unknown error.
{{Identical|Unknown error}}',
	'gwtoolset-accepted-file-types' => 'Label for accepted file types in the HTML form.

This means "The form accepts the following file types:".

Followed by "xml", etc.',
	'gwtoolset-ensure-well-formed-xml' => 'Additional instructions that will help the user make sure the XML file is well-formed.

Followed by {{msg-mw|Gwtoolset-metadata-file-source}}.

Parameters:
* $1 - link text "XML Validator" (untranslatable). The link points to http://www.w3schools.com/xml/xml_validator.asp',
	'gwtoolset-file-url-invalid' => 'User error message when the file URL is invalid.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Message appears when the MediaWiki template requested to use for maetadata mapping does not exist in the wiki.',
	'gwtoolset-mediawiki-template-not-found' => 'User error message when no MediaWiki template is found. Parameters:
* $1 is the template name that was not found.',
	'gwtoolset-metadata-file-source' => 'Initial instructions for selecting the file source.

Preceded by {{msg-mw|Gwtoolset-ensure-well-formed-xml}}.

Followed by {{msg-mw|Gwtoolset-metadata-file-upload}}.',
	'gwtoolset-metadata-file-source-info' => 'Additional instructions about the file source.',
	'gwtoolset-metadata-file-url' => 'Label for the file source URL in the HTML form.',
	'gwtoolset-metadata-file-upload' => 'Label for the file upload button in the HTML form.

Preceded by {{msg-mw|Gwtoolset-metadata-file-source}}.

Followed by the file selector (<code><nowiki><input type="file"></nowiki></code>).',
	'gwtoolset-metadata-mapping-bad' => 'User error message when there is a problem with the metadata mapping JSON format. Parameters:
* $1 - the technical error message given by PHP for the specific JSON error',
	'gwtoolset-metadata-mapping-invalid-url' => 'User error message when the metadata mapping URL supplied does not match the expected mapping URL path. Parameter 1 is the URL provided. Parameter 2 is the expected  path.',
	'gwtoolset-metadata-mapping-not-found' => 'User error message when no metadata mapping was found in the page. Parameters:
* $1 is the URL to the page.',
	'gwtoolset-namespace-mismatch' => 'User message that appears when a page title is given that does not reside in the expected namespace. Parameters:
* $1 is the page title given.
* $2 is the namespace that title is in.
* $3 is the naemspace the title should be in.',
	'gwtoolset-no-xml-element-found' => 'User error message when no XML element was found for mapping.',
	'gwtoolset-page-title-contains-url' => 'Appears when the page title being requested contains the URL of the site and not just the page title',
	'gwtoolset-record-element-name' => 'Label for record element name in the HTML form.

Followed by the "Record element name" inputbox.',
	'gwtoolset-step-1-heading' => 'Heading for step 1.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-1}}',
	'gwtoolset-step-1-instructions-1' => 'Step 1, first instructions paragraph.

Followed by the following steps:
* {{msg-mw|Gwtoolset-step-1-instructions-li-1}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-2}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-3}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-4}}',
	'gwtoolset-step-1-instructions-2' => 'Step 1, second instructions paragraph.',
	'gwtoolset-step-1-instructions-3-heading' => 'Used as <code><nowiki><h4></nowiki></code> heading.',
	'gwtoolset-step-1-instructions-li-1' => 'Step 1, first step.

See also:
* {{msg-mw|Gwtoolset-step-1-heading}}',
	'gwtoolset-step-1-instructions-li-2' => 'Step 1, second step.

See also:
* {{msg-mw|Gwtoolset-step-2-heading}}',
	'gwtoolset-step-1-instructions-li-3' => 'Step 1, third step.

See also:
* {{msg-mw|Gwtoolset-step-3-instructions-heading}}',
	'gwtoolset-step-1-instructions-li-4' => 'Step 1, fourth step.

See also:
* {{msg-mw|Gwtoolset-step-4-heading}}',
	'gwtoolset-upload-legend' => 'Legend for step 1 HTML form.',
	'gwtoolset-which-mediawiki-template' => 'Label for which media wiki template in the HTML form.

Followed by the list box which has the following items (template names):
* Artwork
* Book
* Musical_work
* Photograph
* Specimen',
	'gwtoolset-which-metadata-mapping' => 'Label for which metadata in the HTML form.',
	'gwtoolset-xml-error' => 'User error message when the extension cannot properly load the XML provided.',
	'gwtoolset-categories' => 'Instructions for adding categories in the HTML form.',
	'gwtoolset-category' => 'Label for category in the HTML form.
{{Identical|Category}}',
	'gwtoolset-create-mapping' => 'Summary message used when the extension creates/updates a metadata mapping content page. Parameters:
* $1 is the extension name.
* $2 is the user name.',
	'gwtoolset-example-record' => 'Label for the metadata example record.',
	'gwtoolset-global-categories' => 'Heading for the global categories section in the HTML form.
{{Identical|Global category}}',
	'gwtoolset-global-tooltip' => 'Instructions for the HTML form.',
	'gwtoolset-maps-to' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'User error message when the extension could not evaluate the media file URL in order to determine the file extension. Parameter 1 is the URL to the file or the file name given.',
	'gwtoolset-mapping-media-file-url-bad' => 'User error message when the extension can not evaluate the media file URL. Parameters:
* $1 is the URL provided.',
	'gwtoolset-mapping-no-title' => 'User error message when the metadata mapping contains no title.',
	'gwtoolset-mapping-no-title-identifier' => 'User error message when the metadata mapping contains no title identifier.',
	'gwtoolset-metadata-field' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.',
	'gwtoolset-metadata-file' => 'Heading for displaying some information about the metadata file.',
	'gwtoolset-metadata-mapping-legend' => 'Step 2 legend for the HTML form.',
	'gwtoolset-no-more-records' => 'User message that appears when there are no more records to process.',
	'gwtoolset-painted-by' => 'Placeholder text for category phrasing in Step 2 in the HTML form.',
	'gwtoolset-partner' => 'Heading for the partner section in Step 2 of the HTML form.
{{Identical|Partner}}',
	'gwtoolset-partner-explanation' => 'Instructions for the partner section in Step 2 of the HTML form.',
	'gwtoolset-partner-template' => 'Placeholder text for partner template in Step 2 of the HTML form.',
	'gwtoolset-phrasing' => 'Table heading for the phrasing field column in the categories section in Step 2 of the HTML form.',
	'gwtoolset-preview' => 'Text for submit button in Step 2 of the HTML form.',
	'gwtoolset-process-batch' => 'Text for submit button in Step 3 of the HTML form.',
	'gwtoolset-record-count' => 'User message that indicates the total number of records found in the metadata file. Parameters:
* $1 is the total number of records found.',
	'gwtoolset-results' => 'Heading used when results are given.
{{Identical|Result}}',
	'gwtoolset-step-2-heading' => 'Step 2 heading.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-2}}',
	'gwtoolset-step-2-instructions-heading' => 'Step 2 heading instructions.',
	'gwtoolset-step-2-instructions-1' => 'Step 2, first set of instructions.',
	'gwtoolset-step-2-instructions-1-li-1' => 'Step 2, first set of instructions, first instruction. Parameters:
* $1 - the name and a link to the MediaWiki template being used in the metadata mapping. e.g. <code><nowiki>[[Template:Template_name]]</nowiki></code>',
	'gwtoolset-step-2-instructions-1-li-2' => 'Step 2, first set of instructions, second instruction.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Step 2, first set of instructions, third instruction.',
	'gwtoolset-step-2-instructions-2' => 'Step 2, second set of instructions.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Step 2, second set of instructions, first instruction.',
	'gwtoolset-step-2-instructions-2-li-2' => 'Step 2, second set of instructions, second instruction.',
	'gwtoolset-reupload-media' => 'Label for re-upload media from URL checkbox in Step 2 of the HTML form.',
	'gwtoolset-reupload-media-explanation' => 'Instructions for the re-upload media from URL checkbox in Step 2 of the HTML form.',
	'gwtoolset-specific-categories' => 'Heading for the item specific categories section in Step 2 of the HTML form.',
	'gwtoolset-specific-tooltip' => 'Instructions for the item specific categories section in Step 2 of the HTML form.',
	'gwtoolset-template-field' => 'Table column heading for Step 2 in the HTML form.',
	'gwtoolset-step-3-instructions-heading' => 'Step 3, instructions heading.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-3}}',
	'gwtoolset-step-3-instructions-1' => 'Step 3, first set of instructions.',
	'gwtoolset-step-3-instructions-2' => 'Step 3, second set of instructions.',
	'gwtoolset-step-3-instructions-3' => 'Step 3, third set of instructions.',
	'gwtoolset-title-bad' => 'Message that appears when the title derived from the metadata and mediawiki template mapping is not a valid title',
	'gwtoolset-batchjob-metadata-created' => 'User message verifying that the metadata batch job was created. Parameters:
* $1 is a link to a page, Special:NewFiles where the user can use to see if their media files have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'User error message that appears when the extension could not create a batchjob for the metadata file.',
	'gwtoolset-create-mediafile' => 'Summary message used when the extension creates/updates a media file content page. Parameters:
* $1 - the extension name
* $2 - the username',
	'gwtoolset-mediafile-jobs-created' => 'Message that indicates the number of media file batch jobs created. Parameters:
* $1 represents that number.',
	'gwtoolset-step-4-heading' => 'Step 4 heading.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-4}}',
	'gwtoolset-invalid-token' => 'User message that appears when the edit token submitted with the form is invalid.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'User message that appears when the PHP ini settings are less that the wiki’s $wgMaxUploadSize setting.',
	'gwtoolset-mediawiki-version-invalid' => 'Message appears when the MediaWiki version is too low.',
	'gwtoolset-no-upload-by-url' => 'User message that appears when the user is not part of a group that has the right to upload by url.

Used as <code>$1</code> in:
* {{msg-mw|Gwtoolset-permission-not-given}}',
	'gwtoolset-permission-not-given' => 'Message that appears when the user does not have the proper wiki permissions.

Parameters:
* $1 - the message {{msg-mw|Gwtoolset-no-upload-by-url}}',
	'gwtoolset-user-blocked' => 'Message that appears when the user is blocked from using the wiki.',
	'gwtoolset-required-group' => 'User message that appears when the user is not a member of the required group. Parameters:
* $1 is the required group.',
	'gwtoolset-verify-api-enabled' => 'Message that appears when the API has not been enabled. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-api-writeable' => 'Message that appears when the API cannot write to the wiki. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-curl' => 'Message that appears when PHP cURL is not available. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-finfo' => 'Message that appears when PHP finfo is not available. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-php-version' => 'Message that appears when the PHP version is less than version 5.3.3. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-uploads-enabled' => 'Message that appears when the wiki does not allow file uploads. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-verify-xmlreader' => 'Message that appears when PHP XMLReader is not available. Parameters:
* $1 - "GWToolset" (untranslatable)',
	'gwtoolset-wiki-checks-not-passed' => 'Heading used when a wiki requirement is not met.',
);

/** German (Deutsch)
 * @author Metalhead64
 */
$messages['de'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, ein Massenhochladewerkzeug für Galerien, Bibliotheken, Archive und Museen',
	'gwtoolset-intro' => 'GWToolset ist eine MediaWiki-Erweiterung, die es Galerien, Bibliotheken, Archive und Museen ermöglicht, Inhalte basierend auf einer XML-Datei massenhaft hochzuladen, die entsprechende Metadaten über den Inhalt enthält. Es wird beabsichtigt, eine Vielzahl von XML-Schemata zu erlauben. Weitere Informationen über das Projekt können auf der [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project Projektseite] gefunden werden. Kontaktiere uns auch auf dieser Seite. Wähle oben eines der Menüeinträge aus, um den Hochladeprozess zu starten.',
	'gwtoolset-batchjob-creation-failure' => 'Ein Stapelauftrag des Typs „$1“ konnte nicht erstellt werden.',
	'gwtoolset-could-not-close-xml' => 'Der XML-Reader konnte nicht geschlossen werden.',
	'gwtoolset-could-not-open-xml' => 'Die XML-Datei konnte nicht zum Lesen geöffnet werden.',
	'gwtoolset-developer-issue' => 'Bitte kontaktiere einen Entwickler. Dieses Problem muss behoben werden, bevor du fortfahren kannst. Bitte füge deinem Bericht den folgenden Text hinzu:

$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, <code>record-count</code> oder <code>record-current</code> nicht angegeben.',
	'gwtoolset-file-backend-maxage-invalid' => 'Der in <code>$wgGWTFBMaxAge</code> angegebene Wert für das maximale Alter ist ungültig.
Zur korrekten Festlegung, siehe das [//php.net/manual/de/datetime.formats.relative.php PHP-Handbuch].',
	'gwtoolset-fsfile-empty' => 'Die Datei war leer und wurde gelöscht.',
	'gwtoolset-fsfile-retrieval-failure' => 'Die Datei konnte nicht von der URL $1 abgerufen werden.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> ist nicht festgelegt.',
	'gwtoolset-incorrect-form-handler' => 'Das Modul „$1“ hat keinen Formularhandler mit der Erweiterung GWToolset\\Handlers\\Forms\\FormHandler registriert.',
	'gwtoolset-job-throttle-exceeded' => 'Die Stapelauftragsdrosselung wurde überschritten.',
	'gwtoolset-no-accepted-types' => 'Es wurden keine erlaubten Typen angegeben',
	'gwtoolset-no-callback' => 'Dieser Methode wurde kein Rückruf übergeben.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> ist nicht festgelegt.",
	'gwtoolset-no-field-size' => 'Für das Feld „$1“ wurde keine Feldgröße angegeben.',
	'gwtoolset-no-file-backend-name' => 'Es wurde kein Dateibackendname angegeben.',
	'gwtoolset-no-file-backend-container' => 'Es wurde kein Name für den Dateibackendcontainer angegeben.',
	'gwtoolset-no-file-url' => '<code>file_url</code> wurde nicht angegeben.',
	'gwtoolset-no-form-handler' => 'Es wurde kein Formularhandler erstellt.',
	'gwtoolset-no-mapping' => '<code>mapping_name</code> wurde nicht angegeben.',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code> wurde nicht angegeben.',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name</code> wurde nicht angegeben.',
	'gwtoolset-no-module' => 'Es wurde kein Modulname angegeben.',
	'gwtoolset-no-mwstore-complete-path' => 'Es wurde kein vollständiger Dateipfad angegeben.',
	'gwtoolset-no-mwstore-relative-path' => 'Es wurde kein relativer Pfad angegeben.',
	'gwtoolset-no-page-title' => 'Es wurde kein Seitentitel angegeben.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> ist nicht festgelegt.",
	'gwtoolset-no-source-array' => 'Es wurde kein Quellenarray angegeben.',
	'gwtoolset-no-summary' => 'Es wurde keine Zusammenfassung angegeben.',
	'gwtoolset-no-template-url' => 'Zum Parsen wurde keine Vorlagen-URL angegeben.',
	'gwtoolset-no-text' => 'Es wurde kein Text angegeben.',
	'gwtoolset-no-title' => 'Es wurde kein Titel angegeben.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> ist nicht festgelegt.",
	'gwtoolset-no-url-to-evaluate' => 'Zur Evaluierung wurde keine URL angegeben.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> ist nicht festgelegt.',
	'gwtoolset-no-user' => 'Es wurde kein Benutzerobjekt angegeben.',
	'gwtoolset-no-xml-element' => 'Es wurde kein XMLReader oder DOMElement angegeben.',
	'gwtoolset-no-xml-source' => 'Es wurde keine lokale XML-Quelle angegeben.',
	'gwtoolset-not-string' => 'Der angegebene Wert zur Methode war keine Zeichenfolge. Er ist vom Typ „$1“.',
	'gwtoolset-sha1-does-not-match' => 'Die SHA-1-Prüfsumme stimmt nicht überein.',
	'gwtoolset-disk-write-failure' => 'Der Server konnte die Datei nicht auf ein Dateisystem schreiben.',
	'gwtoolset-xml-doctype' => 'Die XML-Metadatendatei kann keinen <!DOCTYPE>-Abschnitt enthalten. Entferne ihn und versuche das Hochladen erneut.',
	'gwtoolset-file-is-empty' => 'Die hochgeladene Datei ist leer.',
	'gwtoolset-improper-upload' => 'Die Datei wurde nicht korrekt hochgeladen.',
	'gwtoolset-mime-type-mismatch' => 'Die Dateierweiterung „$1“ und der MIME-Typ „$2“ der hochgeladenen Datei stimmen nicht überein.',
	'gwtoolset-missing-temp-folder' => 'Es ist kein temporärer Ordner verfügbar.',
	'gwtoolset-multiple-files' => 'Die hochgeladene Datei enthält Informationen zu mehr als einer Datei. Es kann nur eine Datei gleichzeitig übermittelt werden.',
	'gwtoolset-no-extension' => 'Die hochgeladene Datei enthält nicht genügend Informationen, um sie zu verarbeiten. Eventuell hat sie keine Dateiendung.',
	'gwtoolset-no-file' => 'Es wurde keine Datei empfangen.',
	'gwtoolset-no-form-field' => 'Das erwartete Formularfeld „$1“ ist nicht vorhanden.',
	'gwtoolset-over-max-ini' => 'Die hochgeladene Datei überschreitet die Richtlinien „<code>upload_max_filesize</code>“ und/oder „<code>post_max_size</code>“ in <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Die Datei wurde nur teilweise hochgeladen.',
	'gwtoolset-php-extension-error' => 'Eine PHP-Erweiterung hat das Hochladen der Datei abgebrochen. PHP bietet keine Möglichkeiten zur Feststellung, welche Erweiterung den Hochladeabbruch verursacht hat. Das Untersuchen der Liste geladener Erweiterungen mit <code>phpinfo()</code> könnte helfen.',
	'gwtoolset-unaccepted-extension' => 'Die Dateiquelle enthält keine erlaubte Dateierweiterung.',
	'gwtoolset-unaccepted-extension-specific' => 'Die Dateiquelle hat die nicht erlaubte Dateierweiterung „.$1“.',
	'gwtoolset-unaccepted-mime-type' => 'Der MIME-Typ der hochgeladenen Datei wurde als „$1“ interpretiert, was kein erlaubter MIME-Typ ist.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Die hochgeladene Datei hat den nicht erlaubten MIME-Typ „$1“. Hat die XML-Datei am Anfang eine XML-Deklaration?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← gehe zurück zum Formular',
	'gwtoolset-back-text' => 'Drücke auf die „Zurück“-Schaltfläche deines Browsers, um zum Formular zurückzugelangen.',
	'gwtoolset-file-interpretation-error' => 'Beim Verarbeiten der Metadatendatei gab es ein Problem',
	'gwtoolset-mediawiki-template' => 'Vorlage „$1“',
	'gwtoolset-metadata-user-options-error' => '{{PLURAL:$2|Das folgende Formularfeld muss|Die folgenden Formularfelder müssen}} ausgefüllt werden:
$1',
	'gwtoolset-metadata-invalid-template' => 'Keine gültige MediaWiki-Vorlage gefunden.',
	'gwtoolset-menu-1' => 'Metadaten-Mapping',
	'gwtoolset-technical-error' => 'Es gab einen technischen Fehler.',
	'gwtoolset-required-field' => ' kennzeichnet ein erforderliches Feld',
	'gwtoolset-submit' => 'Übertragen',
	'gwtoolset-summary-heading' => 'Zusammenfassung',
	'gwtoolset-cancel' => 'Abbrechen',
	'gwtoolset-loading' => 'Bitte habe Geduld. Dies kann eine Weile dauern.',
	'gwtoolset-save' => 'Speichern',
	'gwtoolset-save-mapping' => 'Mapping speichern',
	'gwtoolset-save-mapping-failed' => 'Leider gab es beim Verarbeiten deiner Anfrage ein Problem. Bitte versuche es später erneut. (Fehlermeldung: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Dein Mapping wurde gespeichert.',
	'gwtoolset-save-mapping-name' => 'Wie willst du dieses Mapping benennen?',
	'gwtoolset-json-error' => 'Mit dem JSON gab es ein Problem. Fehler: $1.',
	'gwtoolset-json-error-depth' => 'Maximale Stapeltiefe überschritten.',
	'gwtoolset-json-error-state-mismatch' => 'Unterlauf oder die Methoden sind falsch angepasst.',
	'gwtoolset-json-error-ctrl-char' => 'Es wurde ein unerwartetes Steuerzeichen gefunden.',
	'gwtoolset-json-error-syntax' => 'Syntaxfehler, fehlerhaftes JSON.',
	'gwtoolset-json-error-utf8' => 'Ungültige UTF-8-Zeichen, möglicherweise falsch kodiert.',
	'gwtoolset-json-error-unknown' => 'Unbekannter Fehler.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Erlaubter Dateityp|Erlaubte Dateitypen}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Stelle sicher, dass die XML-Datei mit diesem $1 wohlgeformt ist.',
	'gwtoolset-file-url-invalid' => 'Die Datei-URL war ungültig. Die Datei ist im Wiki noch nicht vorhanden. Du musst die Datei zuerst von deinem Computer hochladen, wenn du die Datei-URL-Referenz im Formular verwenden willst.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Die MediaWiki-Vorlage „<strong>$1</strong>“ ist im Wiki nicht vorhanden.

Importiere die Vorlage oder wähle eine andere MediaWiki-Vorlage aus, die für das Mapping verwendet werden soll.',
	'gwtoolset-mediawiki-template-not-found' => 'Keine MediaWiki-Vorlage „$1“ gefunden.',
	'gwtoolset-metadata-file-source' => 'Wähle die Quelle der Metadatendatei aus.',
	'gwtoolset-metadata-file-source-info' => '… entweder eine Datei, die kürzlich hochgeladen wurde oder eine Datei, die du von deinem Computer hochladen willst.',
	'gwtoolset-metadata-file-url' => 'Wiki-URL der Metadatendatei:',
	'gwtoolset-metadata-file-upload' => 'Hochladen der Metadatendatei:',
	'gwtoolset-metadata-mapping-bad' => 'Mit dem Metadaten-Mapping gab es ein Problem. Eventuell ist das JSON-Format ungültig. Versuche, das Problem zu beheben und übermittle das Formular erneut.

$1.',
	'gwtoolset-metadata-mapping-invalid-url' => 'Die angegebene Metadaten-Mapping-URL entspricht nicht der erwarteten Mapping-URL.

* Angegebene URL: $1
* Erwartete URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'Es wurde kein Metadaten-Mapping gefunden.

Die Seite „<strong>$1</strong>“ ist im Wiki nicht vorhanden.',
	'gwtoolset-namespace-mismatch' => 'Die Seite „<strong>$1</strong>“ befindet sich im falschen Namensraum „<strong>$2</strong>“.

Sie sollte im Namensraum „<strong>$3</strong>“ sein.',
	'gwtoolset-no-xml-element-found' => 'Es wurde kein XML-Element zum Mappen gefunden.
* Hast du im Formular einen Wert für „{{int:gwtoolset-record-element-name}}“ angegeben?
* Ist die XML-Datei wohlgeformt? Versuche dieses $1.',
	'gwtoolset-page-title-contains-url' => 'Die Seite „$1“ enthält die vollständige Wiki-URL. Stelle sicher, dass du nur den Seitentitel eingibst, z.&nbsp;B. den Teil der URL nach /wiki/.',
	'gwtoolset-record-element-name' => 'Was ist das XML-Element, das jeden Metadateneintrag enthält:',
	'gwtoolset-step-1-heading' => 'Schritt 1: Metadaten-Erkennung',
	'gwtoolset-step-1-instructions-1' => 'Der Metadaten-Hochladeprozess besteht aus 4 Schritten:',
	'gwtoolset-step-1-instructions-2' => 'In diesem Schritt ladest du eine neue Metadatendatei auf das Wiki hoch. Das Werkzeug wird versuchen, die in der Metadatendatei vorhandenen Metadatenfelder zu extrahieren, die du dann zu einer MediaWiki-Vorlage in „{{int:gwtoolset-step-2-heading}}“ mappst.',
	'gwtoolset-step-1-instructions-3' => 'Falls deine Mediendateidomain unten nicht aufgelistet ist, stelle bitte eine [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment Anfrage], dass deine Mediendateidomain zur Wikimedia-Commons-Domain-Whitelist hinzugefügt wird. Die Domain-Whitelist ist eine Liste von Domains, die Wikimedia Commons vor dem Abrufen von Mediendateien gegenprüft. Falls deine Mediendateidomain nicht auf dieser Liste ist, wird Wikimedia Commons keine Mediendateien von dieser Domain herunterladen. Das beste Beispiel zum Einreichen deiner Anfrage ist ein tatsächlicher Link zu einer Mediendatei.',
	'gwtoolset-step-1-instructions-3-heading' => 'Domain-Whitelist',
	'gwtoolset-step-1-instructions-li-1' => 'Metadaten-Erkennung',
	'gwtoolset-step-1-instructions-li-2' => 'Metadaten-Mapping',
	'gwtoolset-step-1-instructions-li-3' => 'Stapel-Vorschau',
	'gwtoolset-step-1-instructions-li-4' => 'Stapel hochladen',
	'gwtoolset-upload-legend' => 'Lade deine Metadatendatei hoch.',
	'gwtoolset-which-mediawiki-template' => 'Welche MediaWiki-Vorlage:',
	'gwtoolset-which-metadata-mapping' => 'Welches Metadaten-Mapping:',
	'gwtoolset-xml-error' => 'XML konnte nicht geladen werden. Bitte korrigiere unten die Fehler.',
	'gwtoolset-categories' => 'Gib Kategorien ein, getrennt durch ein Pipe-Symbol („|“)',
	'gwtoolset-category' => 'Kategorie',
	'gwtoolset-create-mapping' => '$1: Erstelle Metadaten-Mapping für $2.',
	'gwtoolset-example-record' => 'Beispieleintragsinhalte der Metadaten.',
	'gwtoolset-global-categories' => 'Globale Kategorien',
	'gwtoolset-global-tooltip' => 'Diese Kategorieeinträge werden global auf alle hochgeladenen Objekte angewandt.',
	'gwtoolset-maps-to' => 'Maps zu',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Die Dateierweiterung konnte von der Datei-URL $1 nicht bestimmt werden.',
	'gwtoolset-mapping-media-file-url-bad' => 'Die Mediendatei-URL konnte nicht evaluiert werden. Die URL liefert den Inhalt in einer Weise, die noch nicht von dieser Erweiterung verarbeitet werden kann. Die angegebene URL war „$1“.',
	'gwtoolset-mapping-no-title' => 'Das Metadatenmapping enthält keinen Titel. Dieser ist zum Erstellen der Seite erforderlich.',
	'gwtoolset-mapping-no-title-identifier' => 'Das Metadatenmapping enthält keine Titelkennung, die für die Erstellung eines eindeutigen Seitentitels verwendet wird. Stelle sicher, dass du ein Metadatenfeld zur MediaWiki-Vorlagenparametertitelkennung mappst.',
	'gwtoolset-metadata-field' => 'Metadatenfeld',
	'gwtoolset-metadata-file' => 'Metadatendatei',
	'gwtoolset-metadata-mapping-legend' => 'Mappen deiner Metadaten',
	'gwtoolset-no-more-records' => '<strong>Keine weiteren Einträge zur Verarbeitung</strong>',
	'gwtoolset-painted-by' => 'Gemalt von',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-explanation' => 'Partnervorlagen werden in das Quellenfeld der MediaWiki-Vorlage gezogen, falls angegeben. Du kannst eine Liste mit aktuellen Partnervorlagen in der untenstehenden Kategorie finden. Sobald du die gewünschte Partnervorlage gefunden hast, platziere die URL in dieses Feld. Du kannst auch, falls nötig, eine neue Partnervorlage erstellen.',
	'gwtoolset-partner-template' => 'Partnervorlage:',
	'gwtoolset-phrasing' => 'Ausdruck',
	'gwtoolset-preview' => 'Stapel-Vorschau',
	'gwtoolset-process-batch' => 'Stapel verarbeiten',
	'gwtoolset-record-count' => 'Gesamtzahl der Einträge, die in dieser Metadatendatei gefunden wurden: {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Ergebnisse',
	'gwtoolset-step-2-heading' => 'Schritt 2: Metadaten-Mapping',
	'gwtoolset-step-2-instructions-heading' => 'Mappen der Metadatenfelder',
	'gwtoolset-step-2-instructions-1' => 'Unten ist/sind:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Eine Liste der Felder in der MediaWiki-Vorlage „$1“.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Dropdownfelder, die die Metadatenfelder darstellen, die in der Metadatendatei gefunden wurden.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Ein Beispieleintrag aus der Metadatendatei.',
	'gwtoolset-step-2-instructions-2' => 'In diesem Schritt musst du die Metadatenfelder mit den MediaWiki-Vorlagenfeldern mappen.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Wähle ein Metadatenfeld unter der Spalte „{{int:gwtoolset-maps-to}}“ aus, das einem MediaWiki-Vorlagenfeld unter der Spalte „{{int:gwtoolset-template-field}}“ entspricht.',
	'gwtoolset-step-2-instructions-2-li-2' => 'Du musst keinen Treffer für jedes MediaWiki-Vorlagenfeld angeben.',
	'gwtoolset-reupload-media' => 'Medium von URL erneut hochladen',
	'gwtoolset-reupload-media-explanation' => 'Dieses Kontrollkästchen ermöglicht dir das erneute Hochladen von Medien für ein Objekt, das bereits auf dieses Wiki hochgeladen wurde. Falls das Objekt bereits vorhanden ist, wird dem Wiki eine zusätzliche Mediendatei hinzugefügt. Falls die Mediendatei noch nicht vorhanden ist, wird sie hochgeladen. Dabei ist es gleichgültig, ob dieses Kontrollkästchen markiert ist oder nicht.',
	'gwtoolset-specific-categories' => 'Objektspezifische Kategorien',
	'gwtoolset-specific-tooltip' => 'Durch Verwendung der folgenden Felder kannst du optional einen Ausdruck und ein Metadatenfeld als Kategorieeintrag für jedes individuell hochgeladene Objekt anwenden. Falls die Metadatendatei beispielsweise ein Element für den Künstler jeden Eintrags enthält, kannst du dies als Kategorieeintrag für jeden Eintrag hinzufügen, was auf den Wert speziell für jeden Eintrag übergehen würde. Du kannst auch einen Ausdruck wie „<em>{{int:gwtoolset-painted-by}}</em>“ hinzufügen, anschließend das Künstler-Metadatenfeld, was „<em>{{int:gwtoolset-painted-by}} <Name des Künstlers></em>“ als Kategorie für jeden Eintrag ergibt.',
	'gwtoolset-template-field' => 'Vorlagenfeld',
	'gwtoolset-step-3-instructions-heading' => 'Schritt 3: Vorschau des Stapels',
	'gwtoolset-step-3-instructions-1' => 'Unten sind die Ergebnisse des Hochladens {{PLURAL:$1|des ersten Eintrags|der ersten $1 Einträge}} aus der ausgewählten Metadatendatei und das Mapping {{PLURAL:$1|dieses Eintrags|dieser Einträge}} zur MediaWiki-Vorlage, die du in „{{int:gwtoolset-step-2-heading}}“ ausgewählt hast.',
	'gwtoolset-step-3-instructions-2' => 'Überprüfe diese Seiten. Falls die Ergebnisse deinen Erwartungen entsprechen und zusätzliche Einträge auf das Hochladen warten, fahre mit dem Stapelhochladeprozess fort, indem du unten auf die Schaltfläche „{{int:gwtoolset-process-batch}}“ klickst.',
	'gwtoolset-step-3-instructions-3' => 'Falls du mit den Ergebnissen nicht zufrieden bist, gehe zurück zu „{{int:gwtoolset-step-2-heading}}“ und passe das Mapping nach Bedarf an.

Falls du Anpassungen an der Metadaten-Datei selber durchführen musst, mache dies und lade sie erneut hoch, indem du den Prozess mit „{{int:gwtoolset-step-1-heading}}“ beginnst.',
	'gwtoolset-title-bad' => 'Der erstellte Titel, basierend auf den Metadaten und dem MediaWiki-Vorlagenmapping, ist nicht gültig.

Versuche für den Titel und die Titelkennung ein anderes Feld aus den Metadaten oder ändere nach Bedarf Metadaten, falls möglich. Siehe die Seite „[https://commons.wikimedia.org/wiki/Commons:Dateibenennung Dateibenennung]“ für mehr Informationen.

<strong>Ungültiger Titel:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Der Metadaten-Stapelauftrag wurde erstellt. Deine Metadaten-Datei wird in Kürze analysiert und jedes Objekt wird auf das Wiki in einem Hintergrundprozess hochgeladen. Du kannst die Seite „$1“ überprüfen, um zu sehen, wann sie hochgeladen wurden.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Der Stapelauftrag für die Metadatendatei konnte nicht erstellt werden.',
	'gwtoolset-create-mediafile' => '$1: Erstelle Mediendatei für $2.',
	'gwtoolset-mediafile-jobs-created' => 'Es {{PLURAL:$1|wurde ein Mediendatei-Stapelauftrag|wurden $1 Mediendatei-Stapelaufträge}} erstellt.',
	'gwtoolset-step-4-heading' => 'Schritt 4: Stapel hochladen',
	'gwtoolset-invalid-token' => 'Der Bearbeitungstoken, der mit dem Formular übermittelt wurde, ist ungültig.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Aktuelle <code>php.ini</code>-Einstellungen:

• <code>upload_max_filesize</code>: $1
• <code>post_max_size</code>: $2

Diese sind niedriger gesetzt als <code>$wgMaxUploadSize</code> des Wikis, was auf „$3“ festgelegt wurde. Bitte passe die <code>php.ini</code>-Einstellungen dementsprechend an.',
	'gwtoolset-mediawiki-version-invalid' => 'Diese Erweiterung benötigt die MediaWiki-Version $1.<br />Diese MediaWiki-Version ist $2.',
	'gwtoolset-no-upload-by-url' => 'Du bist nicht Teil der Gruppe, die das Recht hat, Dateien per URL hochzuladen.',
	'gwtoolset-permission-not-given' => 'Stelle sicher, dass du angemeldet bist oder kontaktiere einen Administrator, um Anzeigerechte für diese Seite zu erhalten ($1).',
	'gwtoolset-user-blocked' => 'Dein Benutzerkonto ist derzeit gesperrt. Bitte kontaktiere einen Administrator, um das Sperrproblem zu beheben.',
	'gwtoolset-required-group' => 'Du bist kein Mitglied der Gruppe „$1“.',
	'gwtoolset-verify-api-enabled' => 'Die Erweiterung „$1“ erfordert, dass die Wiki-API aktiviert ist.

Bitte stelle sicher, dass <code>$wgEnableAPI</code> in der Datei „<code>DefaultSettings.php</code>“ auf <code>true</code> festgelegt ist  oder mit <code>true</code> in der Datei „<code>LocalSettings.php</code>“ überschrieben wurde.',
	'gwtoolset-verify-api-writeable' => 'Die Erweiterung „$1“ erfordert, dass die Wiki-API Schreibaktionen für berechtigte Benutzer durchführen kann.

Bitte stelle sicher, dass <code>$wgEnableWriteAPI</code> in der Datei „<code>DefaultSettings.php</code>“ auf <code>true</code> festgelegt ist oder in der Datei „<code>LocalSettings.php</code>“ mit <code>true</code> überschrieben wurde.',
	'gwtoolset-verify-curl' => 'Die Erweiterung „$1“ erfordert, dass die PHP-[http://www.php.net/manual/de/curl.setup.php cURL-Funktionen] installiert sind.',
	'gwtoolset-verify-finfo' => 'Die Erweiterung „$1“ erfordert, dass die PHP-[http://www.php.net/manual/de/fileinfo.setup.php finfo]-Erweiterung installiert ist.',
	'gwtoolset-verify-php-version' => 'Die Erweiterung „$1“ benötigt PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'Die Erweiterung „$1“ erfordert, dass das Hochladen von Dateien aktiviert ist.

Bitte stelle sicher, dass <code>$wgEnableUploads</code> in <code>LocalSettings.php</code> auf <code>true</code> festgelegt ist.',
	'gwtoolset-verify-xmlreader' => 'Die Erweiterung „$1“ erfordert, dass der PHP-[http://www.php.net/manual/de/xmlreader.setup.php XMLReader] installiert ist.',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki-Prüfungen nicht bestanden',
);

/** British English (British English)
 * @author Shirayuki
 */
$messages['en-gb'] = array(
	'gwtoolset-verify-api-writeable' => 'The $1 extension requires that the wiki API can perform write actions for authorised users.

Please make sure that <code>$wgEnableWriteAPI</code> is set to <code>true</code> in the <code>DefaultSettings.php</code> file or is overridden to <code>true</code> in the <code>LocalSettings.php</code> file.',
);

/** Spanish (español)
 * @author Fitoschido
 */
$messages['es'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, una herramienta de carga por lotes para los GLAM',
	'gwtoolset-batchjob-creation-failure' => 'No se pudo crear una tarea de lote del tipo «$1».',
	'gwtoolset-could-not-close-xml' => 'No se pudo cerrar el lector de XML.',
	'gwtoolset-could-not-open-xml' => 'No se pudo abrir el archivo XML para su lectura.',
	'gwtoolset-fsfile-empty' => 'El archivo estaba vacío y se ha eliminado.',
	'gwtoolset-fsfile-retrieval-failure' => 'No se pudo extraer el archivo del URL $1.',
	'gwtoolset-no-page-title' => 'No se proporcionó el título de la página.',
	'gwtoolset-no-summary' => 'No se proporcionó el resumen.',
	'gwtoolset-no-text' => 'No se proporcionó texto.',
	'gwtoolset-no-title' => 'No se proporcionó un título.',
	'gwtoolset-sha1-does-not-match' => 'El SHA-1 no coincide.',
	'gwtoolset-disk-write-failure' => 'El servidor no pudo escribir el archivo en un sistema de archivos.',
	'gwtoolset-file-is-empty' => 'El archivo cargado está vacío.',
	'gwtoolset-improper-upload' => 'El archivo no se cargó correctamente.',
	'gwtoolset-mime-type-mismatch' => 'La extensión del archivo «$1» y el tipo MIME «$2» del archivo cargado no coinciden.',
	'gwtoolset-no-file' => 'No se recibió ningún archivo.',
	'gwtoolset-back-text-link' => '← regresar al formulario',
	'gwtoolset-back-text' => 'Pulse el botón «atrás» del navegador para volver al formulario.',
	'gwtoolset-file-interpretation-error' => 'Ocurrió un problema al procesar el archivo de metadatos',
	'gwtoolset-mediawiki-template' => 'Plantilla $1',
	'gwtoolset-technical-error' => 'Ocurrió un error técnico.',
	'gwtoolset-required-field' => 'indica un campo obligatorio',
	'gwtoolset-submit' => 'Enviar',
	'gwtoolset-summary-heading' => 'Resumen',
	'gwtoolset-cancel' => 'Cancelar',
	'gwtoolset-save' => 'Guardar',
	'gwtoolset-json-error-unknown' => 'Ocurrió un error desconocido.',
	'gwtoolset-step-1-heading' => 'Paso 1: detección de metadatos',
	'gwtoolset-step-1-instructions-1' => 'El proceso de carga de metadatos consiste de cuatro pasos:',
	'gwtoolset-category' => 'Categoría',
	'gwtoolset-global-categories' => 'Categorías globales',
	'gwtoolset-results' => 'Resultados',
	'gwtoolset-step-2-instructions-1-li-1' => 'Una lista de los campos en $1 de MediaWiki.',
	'gwtoolset-template-field' => 'Campo de plantilla',
	'gwtoolset-step-3-instructions-heading' => 'Paso 3: previsualización del lote',
	'gwtoolset-step-4-heading' => 'Paso 4: carga del lote',
	'gwtoolset-mediawiki-version-invalid' => 'Esta extensión necesita la versión de MediaWiki $1<br />La versión actual de MediaWiki es $2.',
);

/** French (français)
 * @author Gomoko
 * @author Nobody
 */
$messages['fr'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, un outil d’import en masse pour GLAMs',
	'gwtoolset-could-not-close-xml' => 'Impossible de fermer le lecteur XML.',
	'gwtoolset-could-not-open-xml' => 'Impossible de lire le fichier XML.',
	'gwtoolset-developer-issue' => "Veuillez contacter un développeur. Le message doit être traité avant de continuer. Merci d'ajouter le texte suivant à votre message :

$1",
	'gwtoolset-no-page-title' => 'Pas de page de titre fournie.',
	'gwtoolset-sha1-does-not-match' => 'Le hachage SHA-1 ne correspond pas.',
	'gwtoolset-step-1-instructions-1' => 'Le processus de téléchargement des métadonnées se déroule en 4 étapes différentes :',
	'gwtoolset-step-1-instructions-3-heading' => 'Whitelist des Domaines',
	'gwtoolset-upload-legend' => 'Téléchargez votre fichier de métadonnées.',
	'gwtoolset-example-record' => 'Exemple du contenu des enregistrement des métadonnées.',
	'gwtoolset-step-2-instructions-2-li-2' => "Il n'est pas nécessaire de remplir tous les champs des modèles de MediaWiki.",
	'gwtoolset-no-upload-by-url' => "Vous ne faites pas partie d'un groupe ayant le droit d'uploader par URL.",
	'gwtoolset-verify-api-writeable' => "L'extension \$1 nécessite que l'API wiki ait accès aux droits d'écriture pour les utilisateurs autorisés.

Vérifiez que le paramètre <code>\$wgEnableWriteAPI</code> soit défini à <code>true</code> dans le fichier <code>DefaultSettings.php</code> et dans le fichier <code>LocalSettings.php</code>.",
	'gwtoolset-verify-curl' => "L'extension $1 requiert l'installation des [http://www.php.net/manual/fr/curl.setup.php fonctions PHP cURL].",
	'gwtoolset-verify-finfo' => "L'extension $1 requiert l'installation de l'extension PHP [http://www.php.net/manual/fr/fileinfo.setup.php Finfo]",
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset - GLAM 用の一括アップロード ツール',
	'gwtoolset-intro' => 'GWToolset は、GLAM (美術館、図書館、記録保管所、博物館) がコンテンツを一括アップロードできるようにする MediaWiki 拡張機能です。この一括アップロードは、コンテンツそれぞれについてのメタデータを含む XML ファイルに基づいて行われます。さまざまな XML スキーマに対応することを意図しています。プロジェクトについての詳細情報は、[https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project プロジェクト ページ]にあります。そちらのページでもご遠慮なくお問い合わせください。アップロード作業を開始するには、上のメニュー項目から 1 つ選択してください。',
	'gwtoolset-batchjob-creation-failure' => '種類「$1」の一括処理のジョブを作成できませんでした。',
	'gwtoolset-could-not-close-xml' => 'XML リーダーを閉じることができませんでした。',
	'gwtoolset-could-not-open-xml' => 'XML ファイルを読み取り用で開くことができませんでした。',
	'gwtoolset-developer-issue' => '開発者にお問い合わせください。処理を続行するには、まずこの問題点を解決しなければなりません。ご報告の際には以下の内容を添えてください:

$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>、<code>record-count</code>、<code>record-current</code> のいずれかを指定していません。',
	'gwtoolset-fsfile-empty' => 'ファイルが空であったため削除されました。',
	'gwtoolset-fsfile-retrieval-failure' => 'URL $1 からファイルを取得できませんでした。',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> が設定されていません。',
	'gwtoolset-incorrect-form-handler' => 'モジュール「$1」は、GWToolset\\Handlers\\Forms\\FormHandler を継承するフォーム ハンドラーを登録していません。',
	'gwtoolset-job-throttle-exceeded' => '一括処理ジョブのしきい値を超えました。',
	'gwtoolset-no-callback' => 'このメソッドにコールバックが渡されませんでした。',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> が設定されていません。",
	'gwtoolset-no-field-size' => 'フィールド「$1」のサイズを指定していません。',
	'gwtoolset-no-file-backend-name' => 'ファイル バックエンド名を指定していません。',
	'gwtoolset-no-file-backend-container' => 'ファイル バックエンド コンテナー名を指定していません。',
	'gwtoolset-no-file-url' => '構文解析する <code>file_url</code> を指定していません。',
	'gwtoolset-no-form-handler' => 'フォーム ハンドラーを作成していません。',
	'gwtoolset-no-mapping' => '<code>mapping_name</code> を指定していません。',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code> を指定していません。',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name<</code> を指定していません。',
	'gwtoolset-no-module' => 'モジュール名が指定されていませんでした。',
	'gwtoolset-no-mwstore-complete-path' => 'ファイルの完全なパスを指定していません。',
	'gwtoolset-no-mwstore-relative-path' => '相対パスを指定していません。',
	'gwtoolset-no-page-title' => 'ページ名を指定していません。',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> が設定されていません。",
	'gwtoolset-no-source-array' => 'ソース配列を指定していません。',
	'gwtoolset-no-summary' => '要約を指定していません。',
	'gwtoolset-no-template-url' => '構文解析するテンプレートの URL を指定していません。',
	'gwtoolset-no-text' => 'テキストを指定していません。',
	'gwtoolset-no-title' => 'タイトルを指定していません。',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> が設定されていません。",
	'gwtoolset-no-url-to-evaluate' => '評価する URL を指定していません。',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> が設定されていません。',
	'gwtoolset-no-user' => '利用者オブジェクトを指定していません。',
	'gwtoolset-no-xml-element' => 'XMLReader または DOMElement を指定していません。',
	'gwtoolset-no-xml-source' => 'ローカル XML ソースを指定していません。',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 が一致しません。',
	'gwtoolset-disk-write-failure' => 'サーバーは、ファイルをファイル システムに書き込めませんでした。',
	'gwtoolset-xml-doctype' => 'XML メタデータ ファイルには <!DOCTYPE> セクションを含めてはいけません。それを除去してから、XML メタデータ ファイルをもう一度アップロードしてください。',
	'gwtoolset-file-is-empty' => 'アップロードされたファイルは空です。',
	'gwtoolset-improper-upload' => 'ファイルを適切にはアップロードできませんでした。',
	'gwtoolset-mime-type-mismatch' => 'アップロードしたファイルの拡張子「$1」と MIME タイプ「$2」が一致しません。',
	'gwtoolset-missing-temp-folder' => '一時フォルダーを利用できません。',
	'gwtoolset-no-file' => 'ファイルを受信できませんでした。',
	'gwtoolset-unaccepted-extension-specific' => 'ファイル ソースの拡張子「.$1」のファイル形式には対応していません。',
	'gwtoolset-back-text-link' => '← フォームに戻る',
	'gwtoolset-back-text' => 'フォームに戻るにはブラウザーの戻るボタンを押してください。',
	'gwtoolset-file-interpretation-error' => 'メタデータ ファイルを処理する際に問題点が発生しました',
	'gwtoolset-mediawiki-template' => 'テンプレート $1',
	'gwtoolset-metadata-user-options-error' => 'フォームの以下の{{PLURAL:$2|欄}}への記入は必須です:
$1',
	'gwtoolset-metadata-invalid-template' => '有効な MediaWiki テンプレートが見つかりません。',
	'gwtoolset-menu-1' => 'メタデータのマッピング',
	'gwtoolset-technical-error' => '技術的なエラーが発生しました。',
	'gwtoolset-required-field' => '必須項目',
	'gwtoolset-submit' => '送信',
	'gwtoolset-summary-heading' => '要約',
	'gwtoolset-cancel' => 'キャンセル',
	'gwtoolset-loading' => 'しばらくお待ちください。時間がかかる場合があります。',
	'gwtoolset-save' => '保存',
	'gwtoolset-save-mapping' => 'マッピングを保存',
	'gwtoolset-save-mapping-succeeded' => 'マッピングを保存しました。',
	'gwtoolset-json-error' => 'JSON に問題点がありました。エラー: $1',
	'gwtoolset-json-error-depth' => 'スタックの深さが最大値を超えました。',
	'gwtoolset-json-error-ctrl-char' => '予期しない制御文字が見つかりました。',
	'gwtoolset-json-error-syntax' => '構文エラーです。JSON が破損しています。',
	'gwtoolset-json-error-utf8' => 'UTF-8 の文字が破損しています。エンコーディングが誤っているおそれがあります。',
	'gwtoolset-json-error-unknown' => '不明なエラーです。',
	'gwtoolset-accepted-file-types' => '対応しているファイル{{PLURAL:$1|形式}}:',
	'gwtoolset-ensure-well-formed-xml' => 'こちらの $1 で、XML ファイルが整形式であることを確認してください。',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki テンプレート「$1」が見つかりません。',
	'gwtoolset-metadata-file-source' => 'メタデータ ファイル ソースを選択してください。',
	'gwtoolset-metadata-file-url' => 'メタデータ ファイルがあるウィキの URL:',
	'gwtoolset-metadata-file-upload' => 'メタデータ ファイルのアップロード:',
	'gwtoolset-metadata-mapping-bad' => 'メタデータのマッピングで問題点が発生しました。JSON の形式が無効である場合がほとんどです。問題点を修正してから、フォームをもう一度送信してください。

$1',
	'gwtoolset-metadata-mapping-not-found' => 'メタデータのマッピングが見つかりませんでした。

ページ「<strong>$1</strong>」がウィキ内に存在しません。',
	'gwtoolset-namespace-mismatch' => 'ページ「<strong>$1</strong>」が誤った名前空間「<strong>$2</strong>」に属しています。

名前空間「<strong>$3</strong>」である必要があります。',
	'gwtoolset-page-title-contains-url' => 'ページ「$1」はウィキの完全な URL を含んでいます。ページ名のみを入力するようにしてください (例: URL の /wiki/ の後の部分)。',
	'gwtoolset-record-element-name' => '各メタデータのレコードを含む XML 要素:',
	'gwtoolset-step-1-heading' => '手順 1: メタデータの検出',
	'gwtoolset-step-1-instructions-1' => 'メタデータのアップロード作業には以下の 4 つの手順があります:',
	'gwtoolset-step-1-instructions-2' => 'この手順では、ウィキにメタデータ ファイルを新たにアップロードします。このツールはメタデータ ファイルから利用できるメタデータ フィールドの抽出を試みます。次の「{{int:gwtoolset-step-2-heading}}」で、これらのフィールドを MediaWiki テンプレートにマッピングします。',
	'gwtoolset-step-1-instructions-3-heading' => 'ドメイン ホワイトリスト',
	'gwtoolset-step-1-instructions-li-1' => 'メタデータの検出',
	'gwtoolset-step-1-instructions-li-2' => 'メタデータのマッピング',
	'gwtoolset-step-1-instructions-li-3' => '一括処理のプレビュー',
	'gwtoolset-step-1-instructions-li-4' => '一括アップロード',
	'gwtoolset-upload-legend' => 'メタデータ ファイルのアップロード',
	'gwtoolset-which-mediawiki-template' => 'MediaWiki テンプレート:',
	'gwtoolset-which-metadata-mapping' => 'メタデータのマッピング:',
	'gwtoolset-xml-error' => 'XML を読み込めませんでした。以下のエラーを修正してください。',
	'gwtoolset-categories' => 'カテゴリをパイプ文字 ("|") 区切りで入力してください',
	'gwtoolset-category' => 'カテゴリ',
	'gwtoolset-global-categories' => 'グローバル カテゴリ',
	'gwtoolset-global-tooltip' => 'これらのカテゴリ エントリは、アップロードされた項目すべてにグローバルに適用されます。',
	'gwtoolset-maps-to' => 'マッピング先',
	'gwtoolset-metadata-field' => 'メタデータのフィールド',
	'gwtoolset-metadata-file' => 'メタデータ ファイル',
	'gwtoolset-metadata-mapping-legend' => 'メタデータのマッピング',
	'gwtoolset-no-more-records' => '<strong>処理すべきレコードはこれ以上ありません</strong>',
	'gwtoolset-partner' => 'パートナー',
	'gwtoolset-partner-template' => 'パートナー テンプレート:',
	'gwtoolset-record-count' => 'このメタデータ ファイル内で見つかった総レコード数: {{PLURAL:$1|$1}}',
	'gwtoolset-results' => '結果',
	'gwtoolset-step-2-heading' => '手順 2: メタデータのマッピング',
	'gwtoolset-step-2-instructions-heading' => 'メタデータ フィールドのマッピング',
	'gwtoolset-step-2-instructions-1-li-1' => 'MediaWiki テンプレート内のフィールドの一覧。', # Fuzzy
	'gwtoolset-step-2-instructions-1-li-2' => 'メタデータ ファイル内で見つかったメタデータ フィールドを含むドロップダウン フィールド。',
	'gwtoolset-step-2-instructions-1-li-3' => 'メタデータ ファイルから抽出したサンプル レコード。',
	'gwtoolset-step-2-instructions-2' => 'この手順では、メタデータのフィールドを MediaWiki テンプレートのフィールドにマッピングする必要があります。',
	'gwtoolset-specific-categories' => '項目固有のカテゴリ',
	'gwtoolset-template-field' => 'テンプレートのフィールド',
	'gwtoolset-step-3-instructions-heading' => '手順 3: 一括処理のプレビュー',
	'gwtoolset-batchjob-metadata-creation-failure' => 'メタデータ ファイルの一括処理ジョブを作成できませんでした。',
	'gwtoolset-step-4-heading' => '手順 4: 一括アップロード',
	'gwtoolset-invalid-token' => 'フォームから送信された編集トークンが無効です。',
	'gwtoolset-no-upload-by-url' => 'あなたは、URL からアップロードする権限があるグループに属していません。',
	'gwtoolset-permission-not-given' => 'ログインしていることを確認してください。解決しない場合は、このページを閲覧する権限の付与について管理者にお問い合わせください ($1)。',
	'gwtoolset-required-group' => 'あなたはグループ $1 に属していません。',
	'gwtoolset-verify-api-writeable' => '$1 拡張機能を使用するには、権限がある利用者がウィキの API で書き込み操作を実行できるようにする必要があります。

<code>$wgEnableWriteAPI</code> の値が、<code>DefaultSettings.php</code> で <code>true</code> に設定されていること、またはその値が <code>LocalSettings.php</code> で <code>true</code> に変更されていることを確認してください。',
	'gwtoolset-verify-curl' => '$1 拡張機能を使用するには、PHP の [http://www.php.net/manual/en/curl.setup.php cURL 関数]をインストールする必要があります。',
	'gwtoolset-verify-finfo' => '$1 拡張機能を使用するには、PHP の [http://www.php.net/manual/ja/fileinfo.setup.php finfo] 拡張モジュールをインストールする必要があります。',
	'gwtoolset-verify-php-version' => '$1 拡張機能には PHP 5.3.3 以降が必要です。',
	'gwtoolset-verify-xmlreader' => '$1 拡張機能を使用するには PHP の [http://www.php.net/manual/ja/xmlreader.setup.php XMLReader] をインストールする必要があります。',
	'gwtoolset-wiki-checks-not-passed' => 'ウィキが要件を満たしていません',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'gwtoolset' => '<i lang="en" xml:lang="en">GWToolset</i>',
	'gwtoolset-fsfile-empty' => 'Di Dattei wohr läddesch un es jäz fott jeschmeße.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> es nit jasaz.",
	'gwtoolset-no-mapping' => 'Keine <code lang="en" xml:lang="en">mapping_name</code> aanjjovve.',
	'gwtoolset-no-title' => 'Ed es keine Tettel aanjejovve.',
	'gwtoolset-disk-write-failure' => 'Di Dattei lehß sesch nit schpeischere.',
	'gwtoolset-improper-upload' => 'Di Dattei es nit öhndlesch huhjelaade woode.',
	'gwtoolset-back-text-link' => '← Jangk retuur noh däm Fommolaa.',
	'gwtoolset-mediawiki-template' => 'De Schablohn $1',
	'gwtoolset-required-field' => 'Dat Fäld es nüüdesch.',
	'gwtoolset-submit' => 'Lohß Jonn!',
	'gwtoolset-summary-heading' => 'Zosammejefaß',
	'gwtoolset-cancel' => 'Ophüre!',
	'gwtoolset-save' => 'Faßhalde',
	'gwtoolset-json-error-unknown' => 'Ene Fähler, dä mer nit kenne.',
	'gwtoolset-step-1-instructions-li-4' => 'Ene Pöngel huhlaade',
	'gwtoolset-category' => 'Saachjropp',
	'gwtoolset-global-categories' => 'Jemeinsam Saachjroppe',
	'gwtoolset-process-batch' => 'Lohß jonn!',
	'gwtoolset-results' => 'Erus jekumme es',
	'gwtoolset-step-3-instructions-heading' => 'Schrett 3: Dä Pöngel beloore',
	'gwtoolset-step-4-heading' => 'Schrett 4: Ene Pöngel huhlaade',
	'gwtoolset-verify-php-version' => 'Dat Zohsazprojramm $1 bruch de Väsjohn 5.3.3 vun PHP, udder hühter.',
);

/** Dutch (Nederlands)
 * @author Sjoerddebruin
 */
$messages['nl'] = array(
	'gwtoolset-submit' => 'Opslaan',
	'gwtoolset-summary-heading' => 'Samenvatting',
	'gwtoolset-cancel' => 'Annuleren',
	'gwtoolset-save' => 'Opslaan',
);

/** Russian (русский)
 * @author Okras
 */
$messages['ru'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, инструмент массовой загрузки для GLAM',
	'gwtoolset-menu-1' => 'Сопоставление метаданных',
	'gwtoolset-submit' => 'Отправить',
	'gwtoolset-summary-heading' => 'Описание',
	'gwtoolset-cancel' => 'Отмена',
	'gwtoolset-save' => 'Сохранить',
	'gwtoolset-save-mapping' => 'Сохранить сопоставление',
	'gwtoolset-save-mapping-succeeded' => 'Ваше сопоставление было сохранено.',
	'gwtoolset-save-mapping-name' => 'Как вы хотите назвать это сопоставление?',
	'gwtoolset-json-error-unknown' => 'Неизвестная ошибка.',
	'gwtoolset-step-1-instructions-li-2' => 'Сопоставление метаданных',
	'gwtoolset-which-metadata-mapping' => 'Какие метаданные сопоставить:',
	'gwtoolset-category' => 'Категория',
	'gwtoolset-global-categories' => 'Глобальные категории',
	'gwtoolset-maps-to' => 'Сопоставление для',
	'gwtoolset-metadata-field' => 'Поле метаданных',
	'gwtoolset-metadata-file' => 'Файл метаданных',
	'gwtoolset-results' => 'Результаты',
	'gwtoolset-step-2-heading' => 'Шаг 2: Сопоставление метаданных',
	'gwtoolset-verify-php-version' => 'Расширение $1 требует PHP >= 5.3.3.',
	'gwtoolset-wiki-checks-not-passed' => 'Вики-проверки не пройдены',
);

/** Swedish (svenska)
 * @author Tobulos1
 */
$messages['sv'] = array(
	'gwtoolset-no-accepted-types' => 'Ingen accepterad typ försedd',
	'gwtoolset-no-field-size' => 'Ingen fältstorlek har angetts för fältet "$1".',
	'gwtoolset-no-page-title' => 'Ingen sidorubrik har angetts.',
	'gwtoolset-mediawiki-template' => 'Mall $1',
	'gwtoolset-metadata-user-options-error' => 'Följande formulär {{PLURAL:$2|fält|fält}} måste fyllas i:
$1', # Fuzzy
	'gwtoolset-metadata-invalid-template' => 'Ingen giltig MediaWiki-mall har hittats.',
	'gwtoolset-technical-error' => 'Det var ett tekniskt fel.',
	'gwtoolset-submit' => 'Verkställ',
	'gwtoolset-summary-heading' => 'Sammanfattning',
	'gwtoolset-cancel' => 'Avbryt',
	'gwtoolset-loading' => 'Var tålmodig. Detta kan ta ett tag.',
	'gwtoolset-save' => 'Spara',
	'gwtoolset-save-mapping-failed' => 'Förlåt. Det uppstod ett problem vid bearbetningen av din begäran. Vänligen försök igen senare. (Felmeddelande: $1)',
	'gwtoolset-json-error' => 'Det var ett problem med JSON. Fel: $1.',
	'gwtoolset-json-error-ctrl-char' => 'Oväntad kontrollkaraktär finns.',
	'gwtoolset-json-error-unknown' => 'Okänt fel.',
	'gwtoolset-accepted-file-types' => 'Accepterade fil {{PLURAL:$1|typ|typer}}:',
	'gwtoolset-category' => 'Kategori',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'gwtoolset-summary-heading' => 'సారాంశం',
	'gwtoolset-cancel' => 'రద్దుచేయి',
	'gwtoolset-loading' => 'దయచేసి ఓపిక వహించండి. ఇది కొంతసేపు పట్టవచ్చు.',
	'gwtoolset-save' => 'భద్రపరచు',
	'gwtoolset-category' => 'వర్గం',
	'gwtoolset-global-categories' => 'సార్వత్రిక వర్గాలు',
	'gwtoolset-results' => 'ఫలితాలు',
);

/** Ukrainian (українська)
 * @author Andriykopanytsia
 */
$messages['uk'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset - інструмент масового завантаження для ГБАМ',
	'gwtoolset-intro' => "GWToolset - розширення Медіавікі, що надає ГБАМ (галереям, бібліотекам, архівам і музеям) можливість масового завантаження вмісту на основі XML-файлу, який містить відповідні метадані про вміст. Мета полягає в тому, щоб дозволити це для різних XML-схем. Детальнішу інформацію про проект можна знайти на [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project сторінці проекту]. Не соромтеся зв'язуватися з  нами на цій сторінці. Виберіть один із пунктів вище, щоб почати процес завантаження.",
	'gwtoolset-batchjob-creation-failure' => 'Не вдалося створити пакетне завдання типу "$1".',
	'gwtoolset-could-not-close-xml' => 'Не можна закрити читанку XML.',
	'gwtoolset-could-not-open-xml' => 'Не вдалося відкрити XML-файл для читання.',
	'gwtoolset-developer-issue' => "Будь ласка, зв'яжіться з розробником. Цю проблему необхідно вирішити, перш ніж ви зможете продовжити. Будь ласка, додайте наступний текст звіту:

$1",
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, або <code>record-count</code>, або <code>record-current</code> не надані.',
	'gwtoolset-fsfile-empty' => 'Файл був порожній і через це його видалено.',
	'gwtoolset-fsfile-retrieval-failure' => 'Не вдалося отримати файл з URL-адреси  $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>не встановлено.',
	'gwtoolset-no-accepted-types' => 'Не надано прийнятих типів',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code>не встановлено.",
	'gwtoolset-no-field-size' => 'Не зазначено розмір поля для "$1".',
	'gwtoolset-no-file-backend-name' => "Не надано ім'я файлу бази даних.",
	'gwtoolset-no-file-url' => 'Не забезпечено <code>file_url</code> для аналізу.',
	'gwtoolset-no-form-handler' => 'Не створено форми обробника.',
	'gwtoolset-no-mapping' => 'Не забезпечено <code>mapping_name</code>.',
	'gwtoolset-no-mapping-json' => 'Не забезпечено <code>mapping_json</code>.',
	'gwtoolset-no-mediawiki-template' => 'Не забезпечено <code>mediawiki-template-name</code>.',
	'gwtoolset-no-module' => "Не вказано ім'я модуля.",
	'gwtoolset-no-mwstore-complete-path' => 'Не надано повного шляху до файлу.',
	'gwtoolset-no-mwstore-relative-path' => 'Не надано відносного шляху.',
	'gwtoolset-no-page-title' => 'Не надано заголовку сторінки.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> не задано.",
	'gwtoolset-no-source-array' => 'Не надано вихідний масив.',
	'gwtoolset-no-summary' => 'Немає зведення.',
	'gwtoolset-no-template-url' => 'Не забезпечено шаблону URL для аналізу.',
	'gwtoolset-no-text' => 'Не забезпечено тексту.',
	'gwtoolset-no-title' => 'Немає заголовку.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> не задано.",
	'gwtoolset-no-url-to-evaluate' => 'Не надано URL для оцінки.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> не встановлено.',
	'gwtoolset-no-user' => "Не забезпечено об'єкту користувача.",
	'gwtoolset-no-xml-element' => 'Не надано XMLReader або DOMElement.',
	'gwtoolset-no-xml-source' => 'Не забезпечено локального джерела XML.',
	'gwtoolset-not-string' => 'Не було рядком значення, надане для методу. Воно має тип "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 не відповідає очікуваному.',
	'gwtoolset-disk-write-failure' => 'Сервер не може записати файл у файловій системі.',
	'gwtoolset-xml-doctype' => 'Файл метаданих XML не може містити розділ <!DOCTYPE>. Вилучіть його і знову повторіть спробу завантаження метаданих файлу XML.',
	'gwtoolset-file-is-empty' => 'Завантажений файл порожній.',
	'gwtoolset-improper-upload' => 'Файл не був завантажений належним чином.',
	'gwtoolset-mime-type-mismatch' => 'Розширення файлу "$1" і тип MIME "$2" завантаженого файлу не збігаються.',
	'gwtoolset-missing-temp-folder' => 'Недоступна тимчасова тека.',
	'gwtoolset-multiple-files' => 'Файл, який було завантажено, містить інформацію про більше, ніж один файл. Лише один файл можна подавати за один раз.',
	'gwtoolset-no-extension' => 'Файл, який було завантажено, не містить достатньої інформації для обробки файлу. Вірогідно він не має розширення.',
	'gwtoolset-no-file' => 'Файл не був отриманий.',
	'gwtoolset-no-form-field' => 'Очікуване поле форми "$1" не існує.',
	'gwtoolset-partial-upload' => 'Файл був завантажений лише частково.',
	'gwtoolset-unaccepted-extension' => 'Вихідний файл не містить допустиме розширення файлу.',
	'gwtoolset-unaccepted-extension-specific' => 'Вихідний файл має неприйнятне розширення файлу ".$1".',
	'gwtoolset-back-text-link' => '← повернутися до форми',
	'gwtoolset-file-interpretation-error' => 'Сталася помилка обробки метаданих файлу',
	'gwtoolset-mediawiki-template' => 'Шаблон $1',
	'gwtoolset-metadata-invalid-template' => 'Не знайдено чинного шаблону Медіавікі.',
	'gwtoolset-menu-1' => 'Відображення метаданих',
	'gwtoolset-technical-error' => 'Трапилася технічна помилка.',
	'gwtoolset-required-field' => 'позначає неодмінне поле',
	'gwtoolset-submit' => 'Надіслати',
	'gwtoolset-summary-heading' => 'Підсумок',
	'gwtoolset-cancel' => 'Скасувати',
	'gwtoolset-loading' => 'Будь ласка, будьте терплячими. Це може зайняти деякий час.',
	'gwtoolset-save' => 'Зберегти',
	'gwtoolset-save-mapping' => 'Зберегти зіставлення',
	'gwtoolset-save-mapping-failed' => 'Вибач. Сталася помилка обробки вашого запиту. Будь ласка, спробуйте ще раз пізніше. (Повідомлення про помилку:  $1 )',
	'gwtoolset-save-mapping-succeeded' => 'Ваше зіставлення вже збережено.',
	'gwtoolset-save-mapping-name' => 'Як би ви хотіли назвати це зіставлення?',
	'gwtoolset-json-error' => 'Виникла проблема з JSON. Помилка:  $1.',
	'gwtoolset-json-error-depth' => 'Перевищено максимальну глибину стеку.',
	'gwtoolset-json-error-ctrl-char' => 'Знайдено неочікуваний контрольний символ.',
	'gwtoolset-json-error-syntax' => 'Синтаксична помилка, неправильний формат JSON.',
	'gwtoolset-json-error-unknown' => 'Невідома помилка.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Допустимий тип файлу|Допустимі типи файлу}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Переконайтеся, що файл XML — вірно сформований з цим  $1.',
	'gwtoolset-file-url-invalid' => "URL-адреса файлу хибна. Файл ще не існує в вікі. Ви повинні спочатку завантажити файл з комп'ютера, якщо потрібно використати посилання на URL-адресу файлу у формі.",
	'gwtoolset-mediawiki-template-not-found' => 'Не знайдено жодного шаблону Медіавікі "$1".',
	'gwtoolset-metadata-file-source' => 'Виберіть джерело файлу метаданих.',
	'gwtoolset-metadata-file-source-info' => ".. файл, який раніше був завантажений або файл, який ви хочете завантажити з вашого комп'ютера.",
	'gwtoolset-record-element-name' => 'Який елемент XML, що містить кожен запис метаданих:',
	'gwtoolset-step-1-heading' => 'Крок 1: виявлення метаданих',
	'gwtoolset-step-1-instructions-1' => 'Процес завантаження метаданих складається з 4 кроків:',
	'gwtoolset-step-1-instructions-li-1' => 'Виявлення метаданих',
	'gwtoolset-step-1-instructions-li-2' => 'Відображення метаданих',
	'gwtoolset-step-1-instructions-li-3' => 'Пакетний перегляд',
	'gwtoolset-step-1-instructions-li-4' => 'Пакетне завантеження',
	'gwtoolset-upload-legend' => 'Завантажте ваш файл метаданих.',
	'gwtoolset-which-mediawiki-template' => 'Який шаблон Медіавікі:',
	'gwtoolset-xml-error' => 'Не вдалося завантажити XML-документ. Виправте вказані нижче помилки.',
	'gwtoolset-categories' => 'Введіть категорії, розділені вертикальною рискою ("|")',
	'gwtoolset-category' => 'Категорія',
	'gwtoolset-create-mapping' => '$1: Створення метаданих зіставлення для  $2 .',
	'gwtoolset-example-record' => 'Вміст запису прикладу метаданих.',
	'gwtoolset-global-categories' => 'Глобальні категорії',
	'gwtoolset-global-tooltip' => 'Записи цих категорій застосовуватимуться глобально до всіх завантажених елементів.',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Не вдалося визначити розширення файлу з URL файлу: $1.',
	'gwtoolset-metadata-field' => 'Поле метаданих',
	'gwtoolset-metadata-file' => 'Файл метаданих',
	'gwtoolset-no-more-records' => '<strong>Немає більше записів для оброблення</strong>',
	'gwtoolset-partner' => 'Партнер',
	'gwtoolset-partner-template' => 'Шаблон партнера:',
	'gwtoolset-phrasing' => 'Формулювання',
	'gwtoolset-record-count' => 'Всього знайдено записів в цьому файлі метаданих:  {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Результати',
	'gwtoolset-step-2-heading' => 'Крок 2: Відображення метаданих',
	'gwtoolset-step-2-instructions-heading' => 'Відображення полів метаданих',
	'gwtoolset-step-2-instructions-1-li-1' => 'Список полів у Медіавікі $1.',
	'gwtoolset-template-field' => 'Поле шаблону',
	'gwtoolset-step-3-instructions-heading' => 'Крок 3: пакетний перегляд',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Не вдалося створити пакетне завдання для файлу метаданих.',
	'gwtoolset-create-mediafile' => '$1: Створення медіафайлу для $2.',
	'gwtoolset-step-4-heading' => 'Крок 4: Пакетне завантаження',
	'gwtoolset-mediawiki-version-invalid' => 'Дане розширення вимагає Медіавікі версії $1<br />Це Медіавікі має версію $2.',
	'gwtoolset-no-upload-by-url' => 'Ви не є частиною групи, яка має право передати за URL-адресою.',
	'gwtoolset-user-blocked' => 'Ваш обліковий запис наразі заблоковано. Будь ласка, зверніться до адміністратора для того, щоб усунути це блокування.',
	'gwtoolset-required-group' => 'Ви не учасник групи $1.',
	'gwtoolset-verify-curl' => 'Розширення $1 потребує, аби PHP [http://www.php.net/manual/en/curl.setup.php cURL функції] були встановлені.',
	'gwtoolset-verify-finfo' => 'Розширення $1 Extension вимагає, щоби розширення PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] було встановлене.',
	'gwtoolset-verify-php-version' => 'Розширення $1 потребує PHP версії >= 5.3.3.',
	'gwtoolset-verify-xmlreader' => 'Розширення $1 вимагає, щоб PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] був встановлений.',
	'gwtoolset-wiki-checks-not-passed' => 'Вікі-перевірки не пройдені',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Liuxinyu970226
 */
$messages['zh-hans'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset，一个用于GLAM的大量上传工具',
	'gwtoolset-could-not-close-xml' => '不能关闭XML阅读器。',
	'gwtoolset-could-not-open-xml' => '不能打开XML文件用于阅读。',
	'gwtoolset-developer-issue' => '请联系开发人员。此问题必须在您继续之前解决。请在反馈时标注以下错误代码：
$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>、<code>record-count</code>和/或<code>record-current</code>尚不支持。',
	'gwtoolset-fsfile-empty' => '文件是空的且已删除。',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>未设置。',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code>未设置。",
	'gwtoolset-no-xml-source' => '未提供本地XML源。',
	'gwtoolset-sha1-does-not-match' => 'SHA-1无法匹配。',
	'gwtoolset-file-is-empty' => '上传的文件是空的。',
	'gwtoolset-improper-upload' => '未正确上传文件。',
	'gwtoolset-back-text-link' => '←回到窗口',
	'gwtoolset-mediawiki-template' => '模板$1',
	'gwtoolset-menu-1' => '元数据映射',
	'gwtoolset-submit' => '提交',
	'gwtoolset-summary-heading' => '摘要',
	'gwtoolset-cancel' => '取消',
	'gwtoolset-save' => '保存',
	'gwtoolset-save-mapping' => '保存映射',
	'gwtoolset-save-mapping-failed' => '抱歉。处理您的请求期间遇到技术问题。请稍后再试。（错误信息：$1）',
	'gwtoolset-json-error-unknown' => '未知错误。',
	'gwtoolset-accepted-file-types' => '接受的文件{{PLURAL:$1|格式}}：',
	'gwtoolset-metadata-file-url' => '元数据文件wikiURL：',
	'gwtoolset-metadata-file-upload' => '元数据文件上传：',
);
