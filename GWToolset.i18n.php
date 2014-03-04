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
	 * permission labels
	 */
	'right-gwtoolset' => 'Use GWToolset',
	'action-gwtoolset' => 'use GWToolset',
	'group-gwtoolset' => 'GWToolset users',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset user}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset users',

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
	'gwtoolset-no-default' => 'No default value provided.',
	'gwtoolset-no-field-size' => 'No field size specified for the field "$1".',
	'gwtoolset-no-file-backend-name' => 'No file backend name provided.',
	'gwtoolset-no-file-backend-container' => 'No file backend container name provided.',
	'gwtoolset-no-file-url' => 'No <code>file_url</code> provided to parse.',
	'gwtoolset-no-form-handler' => 'No form handler created.',
	'gwtoolset-no-mapping' => 'No <code>mapping_name</code> provided.',
	'gwtoolset-no-mapping-json' => 'No <code>mapping_json</code> provided.',
	'gwtoolset-no-max' => 'No maximum value provided.',
	'gwtoolset-no-mediafile-throttle' => 'No mediafile job throttle provided.',
	'gwtoolset-no-mediawiki-template' => 'No <code>mediawiki-template-name</code> provided.',
	'gwtoolset-no-min' => 'No minimum value provided.',
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
	'gwtoolset-required-field' => 'denotes required field',
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
	'gwtoolset-json-error' => 'There was a problem with the JSON. Error: $1', // keep this for future use when necessary
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
	'gwtoolset-mediafile-throttle' => 'Mediafile throttle:',
	'gwtoolset-mediafile-throttle-description' => 'After the batch preview, in step 3, GWToolset uploads the remaining records in your batch upload via background jobs. The mediafile throttle controls the number of mediafile requests Wikimedia Commons will make against your mediafile server each time a background job is run. You can set the mediafile throttle between 1-20. For example, if the total number of records in your batch upload is 100 and you set the throttle to 20, Wikimedia Commons will run 5 background jobs in order to process your entire batch upload. The time between each background upload job varies depending on server load and configuration; we anticipate that on Wikimedia Commons a GWToolset background job will run at least every 5 minutes.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'MediaWiki template "<strong>$1</strong>" does not exist in the wiki.

Either import the template or select another MediaWiki template to use for mapping.',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki template "$1" not found.',
	'gwtoolset-metadata-file-source' => 'Select the metadata file source.',
	'gwtoolset-metadata-file-source-info' => '... either a file that has been previously uploaded or a file you wish to upload from your computer.',
	'gwtoolset-metadata-file-url' => 'Metadata file wiki URL:',
	'gwtoolset-metadata-file-upload' => 'Metadata file upload:',
	'gwtoolset-metadata-mapping-bad' => 'There is a problem with the metadata mapping. Most likely the JSON format is invalid. Try and correct the issue and then submit the form again.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'The supplied metadata mapping URL does not match the expected mapping URL path.

* Supplied URL: $1
* Expected URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'No metadata mapping was found.

The page "<strong>$1<strong>" does not exist in the wiki.',
	'gwtoolset-namespace-mismatch' => 'The page "<strong>$1<strong>" is in the wrong namespace "<strong>$2<strong>".

It should be in the namespace "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'No XML element found for mapping.
* Did you enter a value in the form for "{{int:gwtoolset-record-element-name}}"?
* Is the XML file well-formed? Try this [$1 XML validator].
$2',
	'gwtoolset-page-title-contains-url' => 'The page "$1" contains the entire wiki URL. Make sure you only enter the page title, e.g. the part of the URL after /wiki/',
	'gwtoolset-record-element-name' => 'What is the XML element that contains each metadata record:',
	'gwtoolset-step-1-heading' => 'Step 1: Metadata detection',
	'gwtoolset-step-1-instructions-1' => 'The metadata upload process consists of 4 steps:',
	'gwtoolset-step-1-instructions-2' => 'In this step, {{GENDER:$1|you upload}} a new metadata file to the wiki. The tool will attempt to extract the metadata fields available in the metadata file, which you will then map to a MediaWiki template in "{{int:gwtoolset-step-2-heading}}".',
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
	'gwtoolset-mapping-media-file-url-bad' => 'The media file URL could not be evaluated. The URL delivers the content in a way that is not yet handled by this extension or there was an HTTP Request issue. URL given was "$1". HTTP Request error "$2"',
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
	'gwtoolset-title-bad' => "The title, which was created based on the metadata and the MediaWiki template mapping, is not valid.

Try another field from the metadata for title and title-identifier, or if possible, change the metadata where needed. See [https://commons.wikimedia.org/wiki/Commons:File_naming File naming] for more information.

<strong>Invalid title:</strong> $1.",

	/**
	 * step 4 - batch job creation
	 */
	'gwtoolset-batchjob-metadata-created' => 'Metadata batch job created. Your metadata file will be analyzed shortly and each item will be uploaded to the wiki in a background process. You can check the page "$1" to see when they have been uploaded.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Could not create batch job for the metadata file.',
	'gwtoolset-create-mediafile' => '$1: Creating mediafile for $2.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => 'Created $1 mediafile batch {{PLURAL:$1|job|jobs}}.',
	'gwtoolset-step-4-heading' => 'Step 4: Batch upload',

	/**
	 * wiki checks
	 */
	'gwtoolset-invalid-token' => 'The edit token submitted with the form is invalid.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Current <code>php.ini</code> settings:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

These are set lower than the wiki\'s <code>$wgMaxUploadSize</code>, which is set at "$3". Please adjust the <code>php.ini</code> settings as appropriate.',
	'gwtoolset-mediawiki-version-invalid' => 'This extension requires MediaWiki version $1<br />This MediaWiki version is $2.',
	'gwtoolset-permission-not-given' => 'Make sure that you are logged in or contact an administrator in order to be granted permission to view this page ($1).',
	'gwtoolset-user-blocked' => 'Your user account is currently blocked. Please contact an administrator in order to correct the blocking issue.',
	'gwtoolset-required-group' => 'You are not a member of the $1 group.',
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
	'gwtoolset' => 'Extension name.

GWToolset is short for GLAMWiki Toolset.',
	'gwtoolset-desc' => '{{desc|name=GWToolset|url=https://www.mediawiki.org/wiki/Extension:GWToolset}}
GWToolset is short for GLAMWiki Toolset.',
	'gwtoolset-intro' => 'Introduction paragraph for the extension used on the initial [[Special:GWToolset]] landing page.

GWToolset is short for GLAMWiki Toolset.',
	'right-gwtoolset' => '{{doc-right|gwtoolset}}
GWToolset is short for GLAMWiki Toolset.',
	'action-gwtoolset' => '{{doc-action|gwtoolset}}
GWToolset is short for GLAMWiki Toolset.',
	'group-gwtoolset' => '{{doc-group|gwtoolset}}
GWToolset is short for GLAMWiki Toolset.',
	'group-gwtoolset-member' => '{{doc-group|gwtoolset|member}}
GWToolset is short for GLAMWiki Toolset.',
	'grouppage-gwtoolset' => '{{doc-group|gwtoolset|page}}
GWToolset is short for GLAMWiki Toolset.',
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
	'gwtoolset-no-accepted-types' => 'Hint to the developer that appears when no accepted types are provided.

Used if <code>$accepted_metadata_types</code> (metadata types the extension accepts) is empty.

Parameters:
* $1 - (Unused) "gwtoolset-no-accepted-types-provided" (untranslatable)',
	'gwtoolset-no-callback' => 'Hint to the developer that appears when no callback is given.',
	'gwtoolset-no-comment' => "Hint to the developer that appears when user_options['comment'] is not set.",
	'gwtoolset-no-default' => 'Developer message that appears when no default value was provided.

See also:
* {{msg-mw|Gwtoolset-no-max}}
* {{msg-mw|Gwtoolset-no-min}}',
	'gwtoolset-no-field-size' => 'Developer message that appears when no field size was specified for the field. Parameters:
* $1 is the name field.',
	'gwtoolset-no-file-backend-name' => 'Message that appears when a web admin does not provide a file backend name.',
	'gwtoolset-no-file-backend-container' => 'Message that appears wher no file backend container name was provided.',
	'gwtoolset-no-file-url' => 'Hint to the developer that appears when no file_url is provided to parse.',
	'gwtoolset-no-form-handler' => 'Hint to the developer that appears when no form handler was created.',
	'gwtoolset-no-mapping' => 'Hint to the developer that appears when no mapping_name is provided.',
	'gwtoolset-no-mapping-json' => 'Hint to the developer that appears when no mapping_json is provided.',
	'gwtoolset-no-max' => 'Developer message that appears when no maximum value was provided.

See also:
* {{msg-mw|Gwtoolset-no-min}}
* {{msg-mw|Gwtoolset-no-default}}',
	'gwtoolset-no-mediafile-throttle' => 'Developer message that appears when no mediafile job throttle was provided.',
	'gwtoolset-no-mediawiki-template' => 'Hint to the developer that appears when no mediawiki-template-name is provided.',
	'gwtoolset-no-min' => 'Developer message that appears when no minimum value was provided.

See also:
* {{msg-mw|Gwtoolset-no-max}}
* {{msg-mw|Gwtoolset-no-default}}',
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
	'gwtoolset-unaccepted-mime-type-for-xml' => '{{doc-important|Do not translate <code><nowiki>&lt;?xml version="1.0" encoding="UTF-8"?></nowiki></code> part.}}
User error message that appears when the mime type of the file is not accepted. Parameters:
* $1 - the interpreted MIME type. In this case the XML file may not have an XML declaration at the top of the file.',
	'gwtoolset-back-text-link' => '{{msg-mw|Gwtoolset-back-text}} is replaced by an anchor tag when JavaScript is active; this text is used as the text of the anchor tag.

Used as <code>$2</code> in {{msg-mw|Gwtoolset-no-xml-element-found}}.',
	'gwtoolset-back-text' => 'User message telling the user to use the browser back button to go back to the HTML form.

When JavaScript is active this message is replaced with an anchor tag using {{msg-mw|Gwtoolset-back-text-link}}.',
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

Preceded by a red "<span style="color:red">*</span>" (and a whitespace)',
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
	'gwtoolset-json-error' => 'Appears when there is a problem with a JSON value. Parameters:
* $1 is one of the gwtoolset-json-error- error messages, which already contain a full stop.',
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
	'gwtoolset-mediafile-throttle' => 'Mediafile throttle label for the HTML form.',
	'gwtoolset-mediafile-throttle-description' => 'User description of the mediafile throttle.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Message appears when the MediaWiki template requested to use for maetadata mapping does not exist in the wiki.

Parameters:
* $1 - MediaWiki template name',
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
	'gwtoolset-metadata-mapping-invalid-url' => 'User error message when the metadata mapping URL supplied does not match the expected mapping URL path. Parameters:
* $1 - the URL provided
* $2 - the expected path',
	'gwtoolset-metadata-mapping-not-found' => 'User error message when no metadata mapping was found in the page. Parameters:
* $1 is the URL to the page.',
	'gwtoolset-namespace-mismatch' => 'User message that appears when a page title is given that does not reside in the expected namespace. Parameters:
* $1 is the page title given.
* $2 is the namespace that title is in.
* $3 is the naemspace the title should be in.',
	'gwtoolset-no-xml-element-found' => 'User error message when no XML element was found for mapping.

Refers to {{msg-mw|Gwtoolset-record-element-name}}.

Parameters:
* $1 - http://www.w3schools.com/xml/xml_validator.asp
* $2 - {{msg-mw|Gwtoolset-back-text-link}}',
	'gwtoolset-page-title-contains-url' => 'Appears when the page title being requested contains the URL of the site and not just the page title',
	'gwtoolset-record-element-name' => 'Label for record element name in the HTML form.

Followed by the "Record element name" input box.

Also used in {{msg-mw|Gwtoolset-no-xml-element-found}}.',
	'gwtoolset-step-1-heading' => 'Heading for step 1.

Used in {{msg-mw|Gwtoolset-step-3-instructions-3}}.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-1}}',
	'gwtoolset-step-1-instructions-1' => 'Step 1, first instructions paragraph.

Followed by the following steps:
* {{msg-mw|Gwtoolset-step-1-instructions-li-1}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-2}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-3}}
* {{msg-mw|Gwtoolset-step-1-instructions-li-4}}',
	'gwtoolset-step-1-instructions-2' => 'Step 1, second instructions paragraph.

Refers to {{msg-mw|Gwtoolset-step-2-heading}}.

$1 is the user name, which can be used for GENDER.',
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
	'gwtoolset-create-mapping' => '"Edit summary" message used when the extension creates/updates a metadata mapping content page. Parameters:
* $1 - the extension name "GWToolset"
* $2 - the username',
	'gwtoolset-example-record' => 'Label for the metadata example record.',
	'gwtoolset-global-categories' => 'Heading for the global categories section in the HTML form.
{{Identical|Global category}}',
	'gwtoolset-global-tooltip' => 'Instructions for the HTML form.',
	'gwtoolset-maps-to' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.

Used in {{msg-mw|Gwtoolset-step-2-instructions-2-li-1}}.',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'User error message when the extension could not evaluate the media file URL in order to determine the file extension.

Parameters:
* $1 - the URL to the file or the file name given',
	'gwtoolset-mapping-media-file-url-bad' => 'User error message when the extension can not evaluate the media file URL. Parameters:
* $1 is the URL provided.
* $2 is the HTTP Request error message.',
	'gwtoolset-mapping-no-title' => 'User error message when the metadata mapping contains no title.',
	'gwtoolset-mapping-no-title-identifier' => 'User error message when the metadata mapping contains no title identifier.',
	'gwtoolset-metadata-field' => 'Text for the table column heading, which is at the top of the mapping metadata table in the HTML form.',
	'gwtoolset-metadata-file' => 'Heading for displaying some information about the metadata file.',
	'gwtoolset-metadata-mapping-legend' => 'Step 2 legend for the HTML form.',
	'gwtoolset-no-more-records' => 'User message that appears when there are no more records to process.',
	'gwtoolset-painted-by' => 'Placeholder text for category phrasing in Step 2 in the HTML form.

Used in {{msg-mw|Gwtoolset-specific-tooltip}}.',
	'gwtoolset-partner' => 'Heading for the partner section in Step 2 of the HTML form.
{{Identical|Partner}}',
	'gwtoolset-partner-explanation' => 'Instructions for the partner section in Step 2 of the HTML form.',
	'gwtoolset-partner-template' => 'Placeholder text for partner template in Step 2 of the HTML form.',
	'gwtoolset-phrasing' => 'Table heading for the phrasing field column in the categories section in Step 2 of the HTML form.',
	'gwtoolset-preview' => 'Text for submit button in Step 2 of the HTML form.',
	'gwtoolset-process-batch' => 'Text for submit button in Step 3 of the HTML form.

Used in {{msg-mw|Gwtoolset-step-3-instructions-2}}.',
	'gwtoolset-record-count' => 'User message that indicates the total number of records found in the metadata file. Parameters:
* $1 is the total number of records found.',
	'gwtoolset-results' => 'Heading used when results are given.
{{Identical|Result}}',
	'gwtoolset-step-2-heading' => 'Step 2 heading.

Used in:
* {{msg-mw|Gwtoolset-step-3-instructions-1}}
* {{msg-mw|Gwtoolset-step-1-instructions-2}}
* {{msg-mw|Gwtoolset-step-3-instructions-3}}

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-2}}',
	'gwtoolset-step-2-instructions-heading' => 'Step 2 heading instructions.',
	'gwtoolset-step-2-instructions-1' => 'Step 2, first set of instructions.',
	'gwtoolset-step-2-instructions-1-li-1' => 'Step 2, first set of instructions, first instruction. Parameters:
* $1 - the name and a link to the MediaWiki template being used in the metadata mapping. e.g. <code><nowiki>[[Template:Template_name]]</nowiki></code>',
	'gwtoolset-step-2-instructions-1-li-2' => 'Step 2, first set of instructions, second instruction.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Step 2, first set of instructions, third instruction.',
	'gwtoolset-step-2-instructions-2' => 'Step 2, second set of instructions.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Step 2, second set of instructions, first instruction.

Refers to:
* {{msg-mw|Gwtoolset-maps-to}}
* {{msg-mw|Gwtoolset-template-field}}',
	'gwtoolset-step-2-instructions-2-li-2' => 'Step 2, second set of instructions, second instruction.',
	'gwtoolset-reupload-media' => 'Label for re-upload media from URL checkbox in Step 2 of the HTML form.

Followed by the following explanation:
* {{msg-mw|Gwtoolset-reupload-media-explanation}}',
	'gwtoolset-reupload-media-explanation' => 'Instructions for the re-upload media from URL checkbox in Step 2 of the HTML form.

Preceded by the checkbox label {{msg-mw|Gwtoolset-reupload-media}}.',
	'gwtoolset-specific-categories' => 'Heading for the item specific categories section in Step 2 of the HTML form.',
	'gwtoolset-specific-tooltip' => 'Instructions for the item specific categories section in Step 2 of the HTML form.

Refers to {{msg-mw|Gwtoolset-painted-by}}.',
	'gwtoolset-template-field' => 'Table column heading for Step 2 in the HTML form.

Used in {{msg-mw|Gwtoolset-step-2-instructions-2-li-1}}.',
	'gwtoolset-step-3-instructions-heading' => 'Step 3, instructions heading.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-3}}',
	'gwtoolset-step-3-instructions-1' => 'Step 3, first set of instructions.

Refers to {{msg-mw|Gwtoolset-step-2-heading}}.',
	'gwtoolset-step-3-instructions-2' => 'Step 3, second set of instructions.

Refers to {{msg-mw|Gwtoolset-process-batch}}.',
	'gwtoolset-step-3-instructions-3' => 'Step 3, third set of instructions.

Refers to:
* {{msg-mw|Gwtoolset-step-2-heading}}
* {{msg-mw|Gwtoolset-step-1-heading}}',
	'gwtoolset-title-bad' => 'Message that appears when the title derived from the metadata and mediawiki template mapping is not a valid title',
	'gwtoolset-batchjob-metadata-created' => 'User message verifying that the metadata batch job was created. Parameters:
* $1 - a link to a page, [[Special:NewFiles]] where the user can use to see if their media files have been uploaded',
	'gwtoolset-batchjob-metadata-creation-failure' => 'User error message that appears when the extension could not create a batchjob for the metadata file.',
	'gwtoolset-create-mediafile' => '"Edit summary" message used when the extension creates/updates a media file content page. Parameters:
* $1 - the extension name "GWToolset"
* $2 - the username',
	'gwtoolset-create-prefix' => 'The name of the project, GWToolset, which can be replaced by a link or other content if necessary via a page Mediawiki:gwtoolset-create-prefix

GWToolset is short for GLAMWiki Toolset.',
	'gwtoolset-mediafile-jobs-created' => 'Message that indicates the number of media file batch jobs created. Parameters:
* $1 - number of batch jobs',
	'gwtoolset-step-4-heading' => 'Step 4 heading.

See also:
* {{msg-mw|Gwtoolset-step-1-instructions-li-4}}',
	'gwtoolset-invalid-token' => 'User message that appears when the edit token submitted with the form is invalid.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'User message that appears when the PHP ini settings are less that the wiki’s $wgMaxUploadSize setting.',
	'gwtoolset-mediawiki-version-invalid' => 'Message appears when the MediaWiki version is too low. Parameters:
* $1 - MediaWiki version required. "1.22c"
* $2 - MediaWiki version currently using. e.g. "1.21.3"',
	'gwtoolset-permission-not-given' => 'Message that appears when the user does not have the proper wiki permissions.

Parameters:
* $1 - the message {{msg-mw|Gwtoolset-no-upload-by-url}}',
	'gwtoolset-user-blocked' => 'Message that appears when the user is blocked from using the wiki.',
	'gwtoolset-required-group' => 'User message that appears when the user is not a member of the required group. Parameters:
* $1 is the required group.',
	'gwtoolset-verify-api-enabled' => 'Message that appears when the API has not been enabled. Parameters:
* $1 - "GWToolset" (untranslatable)
See also:
* {{msg-mw|Gwtoolset-verify-api-writeable}}',
	'gwtoolset-verify-api-writeable' => 'Message that appears when the API cannot write to the wiki. Parameters:
* $1 - "GWToolset" (untranslatable)
See also:
* {{msg-mw|Gwtoolset-verify-api-enabled}}',
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

/** Assamese (অসমীয়া)
 * @author Gitartha.bordoloi
 */
$messages['as'] = array(
	'gwtoolset-results' => 'ফলাফল',
);

/** Breton (brezhoneg)
 * @author Fohanno
 * @author Y-M D
 */
$messages['br'] = array(
	'gwtoolset' => 'GWToolset',
	'right-gwtoolset' => 'Implijout GWToolset',
	'action-gwtoolset' => 'implijout GWToolset',
	'group-gwtoolset' => 'Implijerien GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Implijer GWToolset|Implijerez GWToolset}}',
	'gwtoolset-could-not-close-xml' => "N'eus ket bet gallet serriñ al lenner XML.",
	'gwtoolset-fsfile-empty' => 'Goullo e oa ar restr ha dilamet e oa bet.',
	'gwtoolset-no-default' => "N'eus bet pourchaset talvoud dre ziouer ebet.",
	'gwtoolset-no-field-size' => 'N\'eo ket bet diferet ment ar vaezienn evit ar vaezienn "$1".',
	'gwtoolset-submit' => 'Kas',
	'gwtoolset-cancel' => 'Nullañ',
	'gwtoolset-save' => 'Enrollañ',
	'gwtoolset-json-error-unknown' => 'Fazi dianav.',
	'gwtoolset-category' => 'Rummad',
	'gwtoolset-partner' => 'Keveler',
	'gwtoolset-results' => "Disoc'hoù",
	'gwtoolset-step-2-instructions-1-li-1' => 'Ur roll eus ar maeziennoù er Mediawiki $1.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-required-group' => "N'oc'h ket un ezel eus ar strollad $1.",
);

/** Catalan (català)
 * @author ESM
 * @author KRLS
 * @author Papapep
 * @author QuimGil
 * @author Toniher
 */
$messages['ca'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, una eina de càrrega massiva per als projectes GLAM',
	'gwtoolset-intro' => "GWToolset és una extensió MediaWiki que permet la pujada massiva de contingut GLAM (Galeries, Biblioteques -Libraries-, Arxius i Museus) mitjançant un fitxer XML que conté les metadades del contingut. S'intenta amb això permetre diversos esquemes XML. Més informació del projecte a la seva [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project pàgina]. Contacteu amb nosaltres a la mateixa pàgina. Trieu un dels elements del menú superior per iniciar el procés de pujada.",
	'right-gwtoolset' => 'Utilitza el GWToolset',
	'action-gwtoolset' => 'utilitza el gwtoolset',
	'group-gwtoolset' => 'Usuaris del GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Usuari del GWToolset}}',
	'grouppage-gwtoolset' => '{{ns:project}}:Usuaris del GWToolset',
	'gwtoolset-batchjob-creation-failure' => 'No s\'ha pogut crear el treball per lots del tipus "$1".',
	'gwtoolset-could-not-close-xml' => "No s'ha pogut tancar el lector d'XML.",
	'gwtoolset-could-not-open-xml' => "No s'ha pogut llegir el fitxer XML.",
	'gwtoolset-developer-issue' => "$1Contacteu amb el desenvolupador. Aquest error s'ha de corregir abans de continuar. Afegiu el text següent al vostre informe:

$1",
	'gwtoolset-dom-record-issue' => "No s'ha proporcionat <code>record-element-name</code>, o <code>record-count</code>, o <code>record-current</code>.",
	'gwtoolset-file-backend-maxage-invalid' => 'L\'edat màxima proporcionada a <code>$wgGWTFBMaxAge</code> no és vàlida.
Consulteu el [php.net/manual/en/datetime.formats.relative.php manual de PHP] per saber com fer-ho.',
	'gwtoolset-fsfile-empty' => "El fitxer era buit i s'ha suprimit.",
	'gwtoolset-fsfile-retrieval-failure' => "No s'ha pogut recuperar el fitxer de la URL $1.",
	'gwtoolset-ignorewarnings' => "No s'ha definit <code>ignorewarnings</code>.",
	'gwtoolset-incorrect-form-handler' => 'El mòdul "$1" no ha registrat un gestor de formulari que extengui GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => "S'ha excedit el límit del treball per lots.",
	'gwtoolset-no-accepted-types' => "No s'ha proporcionat tipus acceptats",
	'gwtoolset-no-callback' => "No s'ha passat cap crida de retorn a aquest mètode",
	'gwtoolset-no-comment' => "No s'ha definit <code>user_options['comment']</code>.",
	'gwtoolset-no-default' => "No s'ha proporcionat cap valor predeterminat.",
	'gwtoolset-no-field-size' => 'No s\'ha especificat cap mida pel camp "$1".',
	'gwtoolset-no-file-backend-name' => "No s'ha proporcionat cap nom del rerefons del fitxer.",
	'gwtoolset-no-file-backend-container' => "No s'ha proporcionat cap nom del contenidor del rerefons del fitxer.",
	'gwtoolset-no-file-url' => "No s'ha proporcionat cap <code>file_url</code> per analitzar.",
	'gwtoolset-no-form-handler' => "No s'ha creat cap gestor de formulari.",
	'gwtoolset-no-mapping' => "No s'ha proporcionat cap <code>mapping_name</code>.",
	'gwtoolset-no-mapping-json' => "No s'ha proporcionat cap <code>mapping_json</code>.",
	'gwtoolset-no-max' => "No s'ha proporcionat un valor màxim.",
	'gwtoolset-no-mediafile-throttle' => "No s'ha proporcionat un límit pel treballs de fitxers multimèdia.",
	'gwtoolset-no-mediawiki-template' => "No s'ha proporcionat cap <code>mediawiki-template-name</code>.",
	'gwtoolset-no-min' => "No s'ha proporcionat cap valor mínim.",
	'gwtoolset-no-module' => "No s'ha especificat cap nom de mòdul.",
	'gwtoolset-no-mwstore-complete-path' => "No s'ha proporcionat el camí complet del fitxer.",
	'gwtoolset-no-mwstore-relative-path' => "No s'ha proporcionat el camí relatiu.",
	'gwtoolset-no-page-title' => "No s'ha proporcionat cap títol de pàgina.",
	'gwtoolset-no-save-as-batch' => "No s'ha definit <code>user_options['save-as-batch-job']</code>.",
	'gwtoolset-no-source-array' => "No s'ha proporcionat la matriu origen.",
	'gwtoolset-no-summary' => "No s'ha proporcionat cap resum.",
	'gwtoolset-no-template-url' => "No s'ha proporcionat cap URL de plantilla per analitzar.",
	'gwtoolset-no-text' => "No s'ha proporcionat cap text.",
	'gwtoolset-no-title' => "No s'ha proporcionat cap títol.",
	'gwtoolset-no-reupload-media' => "No s'ha definit <code>user_options['gwtoolset-reupload-media']</code>.",
	'gwtoolset-no-url-to-evaluate' => "No s'ha proporcionat cap URL per evaluar.",
	'gwtoolset-no-url-to-media' => "No s'ha definit <code>url-to-the-media-file</code>.",
	'gwtoolset-no-user' => "No s'ha proporcionat cap objecte d'usuari.",
	'gwtoolset-no-xml-element' => "No s'ha proporcionat cap XMLReader o DOMElement.",
	'gwtoolset-no-xml-source' => "No s'ha proporcionat cap origen XML local.",
	'gwtoolset-not-string' => 'El valor proporcionat al mètode no és una cadena de text. És del tipus "$1".',
	'gwtoolset-sha1-does-not-match' => "L'SHA-1 no coincideix.",
	'gwtoolset-disk-write-failure' => 'El servidor no ha pogut escriure el fitxer al sistema de fitxers.',
	'gwtoolset-xml-doctype' => 'El fitxer XML de metadades no pot contenir una secció <!DOCTYPE>. Elimineu-la i torneu-ho a provar.',
	'gwtoolset-file-is-empty' => "L'arxiu pujat és buit.",
	'gwtoolset-improper-upload' => "L'arxiu no s'ha carregat correctament.",
	'gwtoolset-mime-type-mismatch' => 'No coincideixen l\'extensió de fitxer "$1" i el tipus MIME "$2" pujats.',
	'gwtoolset-missing-temp-folder' => 'No hi ha disponible cap carpeta temporal.',
	'gwtoolset-multiple-files' => "El fitxer pujat conté informació de més d'un fitxer. Només es pot pujar un fitxer cada cop.",
	'gwtoolset-no-extension' => 'El fitxer pujat no conté prou informació per processar-lo. Probablement no té extensió de fitxer.',
	'gwtoolset-no-file' => "No s'ha rebut cap fitxer.",
	'gwtoolset-no-form-field' => 'No existeix el camp del formulari "$1" requerit.',
	'gwtoolset-over-max-ini' => 'El fitxer pujat excedeix les directives  <code>upload_max_filesize</code> i/o <code>post_max_size</code> del <code>php.ini</code>.',
	'gwtoolset-partial-upload' => "El fitxer només s'ha pujat parcialment.",
	'gwtoolset-php-extension-error' => "Una extensió de PHP ha aturat la càrrega d'arxius. PHP no proporciona la informació per saber quina extensió ha causat el problema. Examinar la llista d'extensions carregades amb <code>phpinfo()</code> pot ajudar.",
	'gwtoolset-unaccepted-extension' => 'El fitxer origen no conté cap extensió admesa.',
	'gwtoolset-unaccepted-extension-specific' => 'El fitxer origen té l\'extensió no admesa ".$1".',
	'gwtoolset-unaccepted-mime-type' => 'S\'interpreta que el fitxer pujat és del tipus MIME "$1", que no s\'accepta.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'El fitxer pujat és del tipus MIME "$1", que no s\'accepta. Hi ha una declaració XML al capdamunt del fitxer XML?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← torna al formulari',
	'gwtoolset-back-text' => "Premeu el botó d'enrere per tornar al formulari.",
	'gwtoolset-file-interpretation-error' => "S'ha produït un error en processar el fitxer de metadades",
	'gwtoolset-mediawiki-template' => 'Plantilla $1',
	'gwtoolset-metadata-user-options-error' => "S'ha d'emplenar el formulari {{PLURAL:$2|field|fields}} a:
$1",
	'gwtoolset-metadata-invalid-template' => "No s'ha trobat cap plantilla MediaWiki vàlida.",
	'gwtoolset-menu-1' => 'Correspondència de les metadades',
	'gwtoolset-technical-error' => "S'ha produït un error tècnic.",
	'gwtoolset-required-field' => 'camps obligatoris',
	'gwtoolset-submit' => 'Envia',
	'gwtoolset-summary-heading' => 'Resum',
	'gwtoolset-cancel' => 'Cancel·la',
	'gwtoolset-loading' => 'Sigueu pacients, això pot trigar una estona.',
	'gwtoolset-save' => 'Desa',
	'gwtoolset-save-mapping' => 'Desa la correspondència',
	'gwtoolset-save-mapping-failed' => "S'ha produït un error en processar la vostra petició. Torneu-ho a provar. (Missatge d'error: $1)",
	'gwtoolset-save-mapping-succeeded' => "S'ha desat la vostra correspondència.",
	'gwtoolset-save-mapping-name' => 'Com voleu anomenar aquesta correspondència?',
	'gwtoolset-json-error' => "S'ha produït un error amb el JSON. Error: $1",
	'gwtoolset-json-error-depth' => "S'ha superat el límit màxim de profunditat de la pila.",
	'gwtoolset-json-error-state-mismatch' => 'Insuficiència o no coincidència de modes.',
	'gwtoolset-json-error-ctrl-char' => "S'ha trobat un caràcter de control no esperat.",
	'gwtoolset-json-error-syntax' => 'Error de sintaxi, JSON amb errors de format.',
	'gwtoolset-json-error-utf8' => 'Caràcters UTF-8 amb errors de format, probablement mal codificats.',
	'gwtoolset-json-error-unknown' => "S'ha produït un error desconegut.",
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|type|types}}: de fitxer acceptat(s).',
	'gwtoolset-ensure-well-formed-xml' => 'Assegureu-vos que el fitxer XML té el format adient amb aquest $1.',
	'gwtoolset-file-url-invalid' => 'La URL del fitxer no és correcta. El fitxer encara no existeix al wiki. Heu de pujar abans el fitxer si voleu emprar la referència de la URL del fitxer al formulari.',
	'gwtoolset-mediafile-throttle' => 'Límit de fitxers multimèdia:',
	'gwtoolset-mediafile-throttle-description' => 'El límit controla la càrrega que tindrà el vostre servidor de fitxers multimèdia en pujar-los per lots al Wikimedia Commons. Podeu definir el límit entre 1 i 20, on el nombre indica el nombre de peticions per minut.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'La plantilla "<strong>$1</strong>" no existeix al wiki.

Importeu la plantilla MediaWiki o trieu-ne una altra per utilitzar la correspondència.',
	'gwtoolset-mediawiki-template-not-found' => 'No s\'ha trobat la plantilla MediaWiki "$1".',
	'gwtoolset-metadata-file-source' => 'Trieu el fitxer origen de metadades.',
	'gwtoolset-metadata-file-source-info' => "... un fitxer que s'ha carregat prèviament o un fitxer que voleu carregar des del vostre ordinador.",
	'gwtoolset-metadata-file-url' => 'URL wiki del fitxer de metadades:',
	'gwtoolset-metadata-file-upload' => "Càrrega d'arxius de metadades:",
	'gwtoolset-metadata-mapping-bad' => "S'ha produït un error en la correspondència de metadades. Probablement el format JSON no és correcte. Corregiu-ho i torneu-ho a enviar.

$1",
	'gwtoolset-metadata-mapping-invalid-url' => 'La URL de correspondència de metadades proporcionada no coincideix amb la URL de correspondència esperada.

* URL proporcionada: $1
* URL esperada: $2',
	'gwtoolset-metadata-mapping-not-found' => 'No s\'ha trobat correspondència de metadades.

La pàgina "<strong>$1<strong>" no existeix al wiki.',
	'gwtoolset-namespace-mismatch' => 'La pàgina "<strong>$1<strong>" és en un namespace erroni "<strong>$2<strong>".

Hauria de ser al namespace "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'No s\'ha trobat cap element XML coincident.
* Heu posat un valor al formulari per a "{{int:gwtoolset-record-element-name}}"?
* Té el format correcte el fitxer XML? Proveu això $1.',
	'gwtoolset-page-title-contains-url' => 'La pàgina "$1" conté la URL de la pàgina wiki. Assegureu-vos d\'entrar només el títol de la pàgina, per exemple la part de l\'URL després de  /wiki/',
	'gwtoolset-record-element-name' => "Quin és l'element XML que conté cada registre de metadades:",
	'gwtoolset-step-1-heading' => 'Pas 1: Detecció de metadades',
	'gwtoolset-step-1-instructions-1' => 'El procés de càrrega de metadades es divideix en 4 passos:',
	'gwtoolset-step-1-instructions-2' => 'En aquest pas pugeu un nou fitxer de metadades al wiki. L\'eina intentarà extreure els camps de metadades disponibles en el fitxer de metadades, que llavors s\'aplicaran a una plantilla MediaWiki a "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3' => "Si el vostre domini de fitxers multimèdia no es troba a la llista a continuació, [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment sol·liciteu] que sigui afegit a la llista blanca de dominis a Wikimedia Commons. Aquesta llista es comprova abans d'obtenir els fitxers multimèdia. Si el vostre domini no està en aquesta llista, Wikimedia Commons no baixarà els fitxers multimèdia d'aquell domini. El millor exemple que podeu presentar en la vostra sol·licitud és un enllaç a un dels vostres fitxers multimèdia.",
	'gwtoolset-step-1-instructions-3-heading' => 'Llista blanca de dominis',
	'gwtoolset-step-1-instructions-li-1' => 'Detecció de metadades',
	'gwtoolset-step-1-instructions-li-2' => 'Correspondència de les metadades',
	'gwtoolset-step-1-instructions-li-3' => 'Previsualització del lot',
	'gwtoolset-step-1-instructions-li-4' => 'Pujada per lots',
	'gwtoolset-upload-legend' => 'Pugeu el vostre fitxer de metadades',
	'gwtoolset-which-mediawiki-template' => 'Quina plantilla MediaWiki:',
	'gwtoolset-which-metadata-mapping' => 'Quina correspondència de metadades:',
	'gwtoolset-xml-error' => "S'ha produït un error en carregar l'XML. Corregiu els següents errors.",
	'gwtoolset-categories' => 'Poseu les categories separades pel caràcter de barra vertical ("|")',
	'gwtoolset-category' => 'Categoria',
	'gwtoolset-create-mapping' => "$1: s'està creant la correspondència de metadades per a $2.",
	'gwtoolset-example-record' => "Registres d'exemple de metadades.",
	'gwtoolset-global-categories' => 'Categories globals',
	'gwtoolset-global-tooltip' => "Aquestes categories s'aplicaran globalment a tots els elements pujats.",
	'gwtoolset-maps-to' => 'Té correspondència amb',
	'gwtoolset-mapping-media-file-url-extension-bad' => "No s'ha pogut determinar l'extensió del fitxer de la URL: $1.",
	'gwtoolset-mapping-media-file-url-bad' => 'No s\'ha pogut avaluar la URL del fitxer multimèdia. La URL proveeix el contingut en un format que encara no està suportat per l\'extensió. L\'URL proveïda és "$1".',
	'gwtoolset-mapping-no-title' => "L'assignació de metadades no conté cap títol, el qual és necessari per a crear la pàgina.",
	'gwtoolset-mapping-no-title-identifier' => "L'assignació de metadades no conté cap títol identificador, el qual s'utilitza per crear un títol de pàgina útil. Assegureu-vos que assigneu un camp de metadades per al paràmetre de títol identificador a la plantilla MediaWiki.",
	'gwtoolset-metadata-field' => 'Fitxer de metadades',
	'gwtoolset-metadata-file' => 'Fitxer de metadades',
	'gwtoolset-metadata-mapping-legend' => 'Assigneu les vostres metadades',
	'gwtoolset-no-more-records' => '<strong>No hi ha més registres per processar</strong>',
	'gwtoolset-painted-by' => 'Pintat per',
	'gwtoolset-partner' => 'Soci',
	'gwtoolset-partner-explanation' => 'Quan són proveïdes, les plantilles de col·laboradors s\'integren al codi de la plantilla de MediaWiki. Podeu trobar una llista de plantilles de col·laboradors a la pàgina de la categoria "Source templates"; vegeu el següent enllaç. Un cop trobada la plantilla de col·laborador desitjada, afegiu en aquest camp la seva URL. Si s\'escau, també podeu crear una nova plantilla de col·laborador.',
	'gwtoolset-partner-template' => "Plantilla d'associat:",
	'gwtoolset-phrasing' => 'Fraseig',
	'gwtoolset-preview' => 'Vista prèvia de lots',
	'gwtoolset-process-batch' => 'Processa el lot',
	'gwtoolset-record-count' => 'Nombre total de registres trobats en aquest fitxer de metadades:  {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Resultats',
	'gwtoolset-step-2-heading' => 'Pas 2: assignació de metadades',
	'gwtoolset-step-2-instructions-heading' => 'Assignar els camps de metadades',
	'gwtoolset-step-2-instructions-1' => 'A continuació és/són:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Una llista dels camps al MediaWiki  $1 .',
	'gwtoolset-step-2-instructions-1-li-2' => 'Camps desplegables que representen els camps de metadades trobats en el fitxer de metadades.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Un registre de mostra del fitxer de metadades.',
	'gwtoolset-step-2-instructions-2' => 'En aquest pas cal que assigneu els camps de metadades amb els camps de la plantilla de MediaWiki.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Seleccioneu un camp de metadades de la columna {{int:gwtoolset-maps-to}} que es correspongui amb un camp de plantilla de MediaWiki de la columna {{int:gwtoolset-template-field}}.',
	'gwtoolset-step-2-instructions-2-li-2' => 'No cal que proveïu un valor per a cada camp de la plantilla de MediaWiki.',
	'gwtoolset-reupload-media' => "Torna a penjar els arxius multimèdia des de l'URL",
	'gwtoolset-reupload-media-explanation' => "Aquesta casella de selecció us permet tornar a pujar fitxers multimèdia pujats anteriorment al wiki. Si l'element ja existeix s'afegirà un fitxer addicional al wiki. Si no existeix, es pujarà el fitxer tant si s'ha marcat la casella com si no.",
	'gwtoolset-specific-categories' => "Categories específiques de l'element",
	'gwtoolset-specific-tooltip' => 'Utilitzant els següents camps podeu aplicar una frase (opcional) a més d\'un camp de metadades com l\'entrada de categoria per a cada element individual carregat. Per exemple, si el fitxer de metadades conté un element per l\'artista de cada registre, es podria afegir com una entrada de categoria per a cada registre que canviaria el valor específic a cada registre. També podeu afegir una frase com "<em>{{int:gwtoolset-painted-by}}</em>" i després el camp de metadades de l\'artista, quedant "<em>{{int:gwtoolset-painted-by}} <artist name></em>" com a categoria per a cada registre.',
	'gwtoolset-template-field' => 'Camp de plantilla',
	'gwtoolset-step-3-instructions-heading' => 'Pas 3: Previsualització del lot',
	'gwtoolset-step-3-instructions-1' => 'Aquest és el resultat de carregar {{PLURAL:$1|el primer registre|els primers $1 registres}} del fitxer de metadades que heu seleccionat i {{PLURAL:$1|assignar-lo|assignar-los}} a la plantilla MediaWiki que heu seleccionat a "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-3-instructions-2' => 'Reviseu aquestes pàgines i si el resultat és correcte i teniu altres registres per pujar, contineu el procés de pujada per lots fent clic al botó "{{int:gwtoolset-process-batch}}".',
	'gwtoolset-step-3-instructions-3' => 'Si no us agrada el resultat, torneu a "{{int:gwtoolset-step-2-heading}}" i ajusteu les assignacions com calgui.

Si necessiteu modificar el fitxer de metadades, continueu i torneu-lo a pujar començant el procés un altre cop amb "{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => "El títol creat segons les metadades i l'assignació de la plantilla MediaWiki no és correcte.

Proveu un altre camp de les metadades pel títol i identificador del títol o, si és possible, modifiqueu les metadades. Més informació a [https://commons.wikimedia.org/wiki/Commons:File_naming noms de fitxer].

<strong>Títol no vàlid:</strong> $1.",
	'gwtoolset-batchjob-metadata-created' => 'S\'ha creat el trebal per lots de metadades. S\'analitzarà en breu el vostre fitxer de metadades i es pujarà cada element al wiki en un procés de fons. Podeu consultar la pàgina "$1" per veure si s\'han carregat.',
	'gwtoolset-batchjob-metadata-creation-failure' => "No s'ha pogut crear el treball per lots pel fitxer de metadades.",
	'gwtoolset-create-mediafile' => "$1: s'està creant el fitxer multimèdia per a $2.",
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => "S'ha creat $1 {{PLURAL:$1|tasca|tasques}} de fitxers multimèdia per lots.",
	'gwtoolset-step-4-heading' => 'Pujada per lots',
	'gwtoolset-invalid-token' => "El testimoni d'edició enviat amb el formulari no és correcte.",
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Paràmetres actuals de <code>php.ini</code>:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Aquests són inferiors que el <code>$wgMaxUploadSize</code> del wiki, que està definit a "$3". Corregiu el valor de <code>php.ini</code> al valor adient.',
	'gwtoolset-mediawiki-version-invalid' => 'Aquestà extensió requereix la versió $1 del MediaWiki</br>Aquest MediaWiki és de la versió $2.',
	'gwtoolset-permission-not-given' => 'Registreu-vos o contacteu amb un administrador per tenir permisos per veure aquesta pàgina ($1).',
	'gwtoolset-user-blocked' => "S'ha blocat el vostre compte d'usuari. Contacteu amb un administrador per arreglar-ho.",
	'gwtoolset-required-group' => 'No formeu part del grup $1.',
	'gwtoolset-verify-api-enabled' => "L'extensió \$1 requereix que s'hagi habilitat l'API wiki.

Assegureu-vos que <code>\$wgEnableAPI</code> té el valor <code>true</code> al fitxer <code>DefaultSettings.php</code> o que està canviat a <code>true</code> al fitxer <code>LocalSettings.php</code>.",
	'gwtoolset-verify-api-writeable' => 'L\'extensió $1 requereix que l\'API wiki pugui fer escriptures pels usuaris autoritzats.

Assegureu-vos que <code>$wgEnableWriteAPI</code> té el valor <code>true</code> al fitxer <code>DefaultSettings.php</code> o que està canviat a <code>true</code> al fitxer <code>LocalSettings.php</code>.',
	'gwtoolset-verify-curl' => "L'extensió $1 requereix que s'hagi instal·lat les [http://www.php.net/manual/en/curl.setup.php funcions cURL] del PHP.",
	'gwtoolset-verify-finfo' => "L'extensió $1 requereix que s'hagi instal·lat l'extensió [http://www.php.net/manual/en/fileinfo.setup.php finfo] del PHP.",
	'gwtoolset-verify-php-version' => "L'extensió $1 requereix PHP >= 5.3.3.",
	'gwtoolset-verify-uploads-enabled' => "L'extensió \$1 requereix que s'hagi activat la càrrega de fitxers.

Verifiqueu que s'hagi definit <code>\$wgEnableUploads</code> com a <code>true</code> a <code>LocalSettings.php</code>.",
	'gwtoolset-verify-xmlreader' => "L'extensió $1 requereix que el PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] sigui instal·lat.",
	'gwtoolset-wiki-checks-not-passed' => 'No ha passat les comprovacions Wiki',
);

/** Chechen (нохчийн)
 * @author Умар
 */
$messages['ce'] = array(
	'gwtoolset-summary-heading' => 'Цунах лаьцна',
);

/** German (Deutsch)
 * @author Blafasel42
 * @author Metalhead64
 */
$messages['de'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, ein Massenhochladewerkzeug für Galerien, Bibliotheken, Archive und Museen',
	'gwtoolset-intro' => 'GWToolset ist eine MediaWiki-Erweiterung, die es Galerien, Bibliotheken, Archive und Museen ermöglicht, Inhalte basierend auf einer XML-Datei massenhaft hochzuladen, die entsprechende Metadaten über den Inhalt enthält. Es wird beabsichtigt, eine Vielzahl von XML-Schemata zu erlauben. Weitere Informationen über das Projekt können auf der [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project Projektseite] gefunden werden. Kontaktiere uns auch auf dieser Seite. Wähle oben eines der Menüeinträge aus, um den Hochladeprozess zu starten.',
	'right-gwtoolset' => 'GWToolset verwenden',
	'action-gwtoolset' => 'GWToolset zu verwenden',
	'group-gwtoolset' => 'GWToolset-Benutzer',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset-Benutzer|GWToolset-Benutzerin}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset-Benutzer',
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
	'gwtoolset-no-default' => 'Kein Standardwert angegeben.',
	'gwtoolset-no-field-size' => 'Für das Feld „$1“ wurde keine Feldgröße angegeben.',
	'gwtoolset-no-file-backend-name' => 'Es wurde kein Dateibackendname angegeben.',
	'gwtoolset-no-file-backend-container' => 'Es wurde kein Name für den Dateibackendcontainer angegeben.',
	'gwtoolset-no-file-url' => '<code>file_url</code> wurde nicht angegeben.',
	'gwtoolset-no-form-handler' => 'Es wurde kein Formularhandler erstellt.',
	'gwtoolset-no-mapping' => '<code>mapping_name</code> wurde nicht angegeben.',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code> wurde nicht angegeben.',
	'gwtoolset-no-max' => 'Kein maximaler Wert angegeben.',
	'gwtoolset-no-mediafile-throttle' => 'Es wurde keine Mediendatei-Auftragsdrosselung angegeben.',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name</code> wurde nicht angegeben.',
	'gwtoolset-no-min' => 'Kein minimaler Wert angegeben.',
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
	'gwtoolset-required-field' => 'kennzeichnet ein erforderliches Feld',
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
	'gwtoolset-mediafile-throttle' => 'Mediendatei-Drosselung:',
	'gwtoolset-mediafile-throttle-description' => 'Nach der Stapelvorschau in Schritt 3 lädt GWToolset die verbleibenden Einträge in deinem Stapel-Upload mithilfe von Hintergrundaufträgen hoch. Die Mediendateidrosselung steuert die Anzahl der Mediendateianfragen, die Wikimedia Commons jedes Mal mit deinem Mediendateiserver durchführt, wenn ein Hintergrundauftrag läuft. Du kannst die Mediendateidrosselung zwischen 1 und 20 festlegen. Falls beispielsweise die Gesamtzahl der Einträge in deinem Stapel-Upload 100 beträgt und du die Grenze auf 20 festgelegt hast, führt Wikimedia Commons 5 Hintergrundaufträge aus, um deinen gesamten Stapel-Upload zu verarbeiten. Die Zeit zwischen jedem Hintergrund-Hochladeauftrag ist abhängig von der Serverladezeit und der Konfiguration; wir gehen davon aus, dass auf Wikimedia Commons mindestens alle 5 Minuten ein GWToolset-Hintergrundauftrag ausgeführt wird.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Die MediaWiki-Vorlage „<strong>$1</strong>“ ist im Wiki nicht vorhanden.

Importiere die Vorlage oder wähle eine andere MediaWiki-Vorlage aus, die für das Mapping verwendet werden soll.',
	'gwtoolset-mediawiki-template-not-found' => 'Die MediaWiki-Vorlage „$1“ wurde nicht gefunden.',
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
* Ist die XML-Datei wohlgeformt? Versuche diesen [$1 XML-Validator].
$2',
	'gwtoolset-page-title-contains-url' => 'Die Seite „$1“ enthält die vollständige Wiki-URL. Stelle sicher, dass du nur den Seitentitel eingibst, z.&nbsp;B. den Teil der URL nach /wiki/.',
	'gwtoolset-record-element-name' => 'Was ist das XML-Element, das jeden Metadateneintrag enthält:',
	'gwtoolset-step-1-heading' => 'Schritt 1: Metadaten-Erkennung',
	'gwtoolset-step-1-instructions-1' => 'Der Metadaten-Hochladeprozess besteht aus 4 Schritten:',
	'gwtoolset-step-1-instructions-2' => 'In diesem Schritt ladest {{GENDER:$1|du}} eine neue Metadatendatei auf das Wiki hoch. Das Werkzeug wird versuchen, die in der Metadatendatei vorhandenen Metadatenfelder zu extrahieren, die du dann zu einer MediaWiki-Vorlage in „{{int:gwtoolset-step-2-heading}}“ mappst.',
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
	'gwtoolset-mapping-media-file-url-bad' => 'Die Mediendatei-URL konnte nicht evaluiert werden. Die URL liefert den Inhalt in einer Weise, die noch nicht von dieser Erweiterung verarbeitet werden kann oder es gab ein HTTP-Anfrageproblem. Die angegebene URL war „$1“. HTTP-Anfragefehler „$2“.',
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
	'gwtoolset-title-bad' => 'Der basierend auf den Metadaten und dem MediaWiki-Vorlagenmapping erstellte Titel ist nicht gültig.

Versuche für den Titel und die Titelkennung ein anderes Feld aus den Metadaten zu verwenden oder ändere nach Bedarf Metadaten, falls möglich. Siehe die Seite „[https://commons.wikimedia.org/wiki/Commons:Dateibenennung Dateibenennung]“ für mehr Informationen.

<strong>Ungültiger Titel:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Der Metadaten-Stapelauftrag wurde erstellt. Deine Metadaten-Datei wird in Kürze analysiert und jedes Objekt wird auf das Wiki in einem Hintergrundprozess hochgeladen. Du kannst die Seite „$1“ überprüfen, um zu sehen, wann sie hochgeladen wurden.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Der Stapelauftrag für die Metadatendatei konnte nicht erstellt werden.',
	'gwtoolset-create-mediafile' => '$1: Erstelle Mediendatei für $2.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => 'Es {{PLURAL:$1|wurde ein Mediendatei-Stapelauftrag|wurden $1 Mediendatei-Stapelaufträge}} erstellt.',
	'gwtoolset-step-4-heading' => 'Schritt 4: Stapel hochladen',
	'gwtoolset-invalid-token' => 'Der Bearbeitungstoken, der mit dem Formular übermittelt wurde, ist ungültig.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Aktuelle <code>php.ini</code>-Einstellungen:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Diese sind niedriger gesetzt als <code>$wgMaxUploadSize</code> des Wikis, was auf „$3“ festgelegt wurde. Bitte passe die <code>php.ini</code>-Einstellungen dementsprechend an.',
	'gwtoolset-mediawiki-version-invalid' => 'Diese Erweiterung benötigt die MediaWiki-Version $1.<br />Diese MediaWiki-Version ist $2.',
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
	'gwtoolset-no-accepted-types' => 'No se proporcionaron tipos aceptados',
	'gwtoolset-no-field-size' => 'No se especificó el tamaño para el campo «$1».',
	'gwtoolset-no-module' => 'No se especificó ningún nombre de módulo.',
	'gwtoolset-no-mwstore-complete-path' => 'No se proporcionó una ruta de archivo completa.',
	'gwtoolset-no-mwstore-relative-path' => 'No se proporcionó una ruta relativa.',
	'gwtoolset-no-page-title' => 'No se proporcionó el título de la página.',
	'gwtoolset-no-summary' => 'No se proporcionó el resumen.',
	'gwtoolset-no-text' => 'No se proporcionó texto.',
	'gwtoolset-no-title' => 'No se proporcionó un título.',
	'gwtoolset-sha1-does-not-match' => 'El SHA-1 no coincide.',
	'gwtoolset-disk-write-failure' => 'El servidor no pudo escribir el archivo en un sistema de archivos.',
	'gwtoolset-file-is-empty' => 'El archivo cargado está vacío.',
	'gwtoolset-improper-upload' => 'El archivo no se cargó correctamente.',
	'gwtoolset-mime-type-mismatch' => 'La extensión del archivo «$1» y el tipo MIME «$2» del archivo cargado no coinciden.',
	'gwtoolset-missing-temp-folder' => 'No hay ninguna carpeta temporal disponible.',
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
	'gwtoolset-save-mapping-failed' => 'Se ha producido un problema al procesar la solicitud. Inténtalo de nuevo más tarde. (Mensaje de error: $1)',
	'gwtoolset-json-error-unknown' => 'Ocurrió un error desconocido.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Tipo de archivo aceptado|Tipos de archivo aceptados}}:',
	'gwtoolset-mediawiki-template-not-found' => 'No se encontró la plantilla de MediaWiki «$1».',
	'gwtoolset-step-1-heading' => 'Paso 1: detección de metadatos',
	'gwtoolset-step-1-instructions-1' => 'El proceso de carga de metadatos consiste de cuatro pasos:',
	'gwtoolset-category' => 'Categoría',
	'gwtoolset-global-categories' => 'Categorías globales',
	'gwtoolset-metadata-field' => 'Campo de metadatos',
	'gwtoolset-metadata-file' => 'Archivo de metadatos',
	'gwtoolset-results' => 'Resultados',
	'gwtoolset-step-2-instructions-1-li-1' => 'Una lista de los campos en $1 de MediaWiki.',
	'gwtoolset-template-field' => 'Campo de plantilla',
	'gwtoolset-step-3-instructions-heading' => 'Paso 3: previsualización del lote',
	'gwtoolset-step-4-heading' => 'Paso 4: carga del lote',
	'gwtoolset-mediawiki-version-invalid' => 'Esta extensión necesita la versión de MediaWiki $1<br />La versión actual de MediaWiki es $2.',
);

/** Persian (فارسی)
 * @author Armin1392
 * @author Ebraminio
 * @author Reza1615
 */
$messages['fa'] = array(
	'gwtoolset' => 'تنظیم ابزار جی‌دبلیو',
	'gwtoolset-desc' => 'GWToolset، یک ابزار انتقال ابزار برای GLAMs',
	'gwtoolset-intro' => 'جی‌دبلیو‌تول‌ست گسترهٔ مدیاویکی است که اجازه می‌دهد جی‌ال‌ای‌ام‌‌ها (گالری ها، کتابخانه‌ها، بایگانی‌ها و موزه‌ها) برای توانایی انتقال گروه محتویات بر اساس یک پوشهٔ ایکس‌ام‌ال که شامل فرادادهٔ مربوطه دربارهٔ محتوا است. منظور اجازه برای تنوع طرح‌های کلی است. اطلاعات بیشتر در مورد پروژه می‌تواند در این [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project project page] پیدا شود. احساس آزادی برای برای تماس با ما در آن صفحه به خوبی وجود دارد. یک از موارد منوی بالا را برای شروع فرایند انتقال انتخاب کنید.',
	'right-gwtoolset' => 'استفاده از تنظیم ابزار جی‌دبلیو',
	'action-gwtoolset' => 'استفاده از تنظیم ابزار جی‌دبلیو',
	'group-gwtoolset' => 'کاربران تنظیم ابزار جی‌دبلیو',
	'group-gwtoolset-member' => '{{GENDER:$1|کاربران تنظیم ابزار جی‌دبلیو}}',
	'grouppage-gwtoolset' => '{{ns:project}}: کاربران تنظیم ابزار جی‌دبلیو',
	'gwtoolset-batchjob-creation-failure' => 'گروه شغل از نوع "$1" نتوانست ایجاد شود.',
	'gwtoolset-could-not-close-xml' => 'نتوانست ایکس‌ام‌ال خوان را ببندد.',
	'gwtoolset-could-not-open-xml' => 'نتوانست پوشهٔ ایکس‌ام‌ال را برای خواندن باز کند.',
	'gwtoolset-developer-issue' => 'لطفاً با یک توسعه دهنده تماس بگیرید. قبل از اینکه شما بتوانید ادامه دهید باید به این مسئله بپردازید. لطفاً متن زیر را به گزارش خود اضافه کنید.
$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, یا <code>record-count</code>, یا <code>record-current</code>ارائه نشد.',
	'gwtoolset-file-backend-maxage-invalid' => 'اهمیت حداکثر سن ارائه شده در <code>$wgGWTFBMaxAge</code> نامعتبر است.
[php.net/manual/en/datetime.formats.relative.php PHP manual] را برای چگونگی تنظیم آن به درستی مشاهده کنید.',
	'gwtoolset-fsfile-empty' => 'پوشه خالی بود و حذف شد.',
	'gwtoolset-fsfile-retrieval-failure' => 'پوشه از یوآر‌ال $1 نتوانست بازیابی شود.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> تنظیم نشده.',
	'gwtoolset-incorrect-form-handler' => 'ماژول "$1" یک گسترش کنترل کننده GWToolset\\Handlers\\Forms\\FormHandler را ثبت نکرده‌‌است.',
	'gwtoolset-job-throttle-exceeded' => 'سرکوب کار گروه فراتر رفته بود.',
	'gwtoolset-no-accepted-types' => 'هیچ نوع ارائه شده‌ای قبول نشد',
	'gwtoolset-no-callback' => 'به این روش هیچ پاسخی رد نشده.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> تنظیم نشده.",
	'gwtoolset-no-default' => 'هیچ مقدار پیش‌فرضی ارائه نشده.',
	'gwtoolset-no-field-size' => 'هیچ اندازهٔ زمینه‌ای برای زمینهٔ "$1" تعیین نشده.',
	'gwtoolset-no-file-backend-name' => 'هیچ نام پوشهٔ بکندی ارائه نشده.',
	'gwtoolset-no-file-backend-container' => 'هیچ نام پوشهٔ‌ جعبهٔ‌ بکندی ارائه نشده.',
	'gwtoolset-no-file-url' => ' هیچ <code>file_url</code> برای تجزیه ارائه نشده.',
	'gwtoolset-no-form-handler' => 'هیچ کنترل‌کنندهٔ فرمی ایجاد نشده.',
	'gwtoolset-no-mapping' => 'هیچ <code>mapping_name</code> ارائه نشده.',
	'gwtoolset-no-mapping-json' => 'هیچ <code>mapping_json</code> ارائه نشده.',
	'gwtoolset-no-max' => 'هیچ مقدار حداکثری ارائه نشده.',
	'gwtoolset-no-mediafile-throttle' => 'هیچ سرکوب کار مدیافایلی ایجاد نشده.',
	'gwtoolset-no-mediawiki-template' => 'هیچ <code>mediawiki-template-name</code> ارائه نشده.',
	'gwtoolset-no-min' => 'هیچ مقدار حداقلی ارائه نشده.',
	'gwtoolset-no-module' => 'هیچ نام واحدی تعیین نشده.',
	'gwtoolset-no-mwstore-complete-path' => 'هیچ راهی برای تکمیل پوشه ارائه نشد.',
	'gwtoolset-no-mwstore-relative-path' => 'هیچ مسیر نسبی ارائه نشد.',
	'gwtoolset-no-page-title' => 'هیچ عنوان صفحه‌ای ارائه نشده.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> تنظیم نشده.",
	'gwtoolset-no-source-array' => 'هیچ منبع ارایه‌ای ارائه نشده.',
	'gwtoolset-no-summary' => 'هیچ خلاصه‌ای ارائه نشده.',
	'gwtoolset-no-template-url' => 'هیچ یوآرال الگویی برای تجزیه ارائه نشده.',
	'gwtoolset-no-text' => 'هیچ متنی ارائه نشده.',
	'gwtoolset-no-title' => 'هیچ عنوانی ارائه نشده.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> تنظیم نشده.",
	'gwtoolset-no-url-to-evaluate' => 'هیچ یوآر‌الی برای ارزیابی ارائه نشده.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> تنظیم نشده.',
	'gwtoolset-no-user' => 'هیچ هدف کاربری ارائه نشده.',
	'gwtoolset-no-xml-element' => 'هیچ ایکس‌ام‌ال خوان یا بخش دی‌اُامی ارائه نشده.',
	'gwtoolset-no-xml-source' => 'هیچ منبع ایکس‌ام‌ال داخلی ارائه نشده.',
	'gwtoolset-not-string' => 'مقدار برای روشی که یک مجموعه نبود، ارائه شد. نوعی از "$1" است.',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 مطابقت ندارد.',
	'gwtoolset-disk-write-failure' => 'سرور نتوانست پوشه را به یک سیستم پوشه بنویسد.',
	'gwtoolset-xml-doctype' => 'پوشهٔ فرادادهٔ ایکس‌ام‌ال نمی تواند شامل بخش <!DOCTYPE> باشد. ان را حذف کنید و سپس برای انتقال پوشهٔ فرادادهٔ ایکس‌ام‌ال دوباره سعی کنید.',
	'gwtoolset-file-is-empty' => 'پوشهٔ منتقل شده خالی است.',
	'gwtoolset-improper-upload' => 'پوشه به درستی منتقل نشده.',
	'gwtoolset-mime-type-mismatch' => 'گسترهٔ پوشهٔ "$1" و نوع مایم "$2" پوشهٔ انتقال داده‌شده باهم مطابقت ندارد.',
	'gwtoolset-missing-temp-folder' => 'هیچ پوشهٔ موقتی در دسترس نیست.',
	'gwtoolset-multiple-files' => 'پوشه‌ای که منتقل شده شامل اطلاعاتی در بیش از یک پوشه است. فقط یک پوشه در یک زمان می‌تواند ارائه شود.',
	'gwtoolset-no-extension' => 'پوشه‌ای که منتقل شده شامل اطلاعات کافی برای پردازش پوشه نیست. به احتمال زیاد آن هیچ گسترهٔ پوشه‌ای را ندارد.',
	'gwtoolset-no-file' => 'هیچ پوشه‌ای دریافت نشد.',
	'gwtoolset-no-form-field' => 'زمینهٔ فرم پذیرفته شدهٔ "$1" وجود ندارد.',
	'gwtoolset-over-max-ini' => 'پوشه‌ای که منتقل شده بود، دستورالعمل <code>upload_max_filesize</code> and/or the <code>post_max_size</code> را در <code>php.ini</code> فراتر می‌برد.',
	'gwtoolset-partial-upload' => 'پوشه فقط تا حدودی منتقل شده.',
	'gwtoolset-php-extension-error' => 'گسترهٔ‌پی‌اچ‌پی انتقال پوشه را متوقف کرده. پی‌اچ‌پی راهی را ارائه نکرده برای مشخص کردن که گستره دلیل توقف انتقال پوشه بوده. آزمودن فهرست گستره‌های بارگذاری شده با کمک احتمالی <code>phpinfo()</code>.',
	'gwtoolset-unaccepted-extension' => 'منبع پوشه شامل گسترهٔ پوشهٔ قبول شده نیست.',
	'gwtoolset-unaccepted-extension-specific' => 'منبع پوشه، یک گسترهٔ پوشهٔ ".$1" قبول نشده دارد.',
	'gwtoolset-unaccepted-mime-type' => 'پوشهٔ منتقل شده به عنوان دارا بودن نوع مایم "$1"، که یک نوع مایم قبول شده نیست،  تعبیر شده‌است.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'پوشهٔ انتقال یافته، نوع مایم "$1" را دارد، که پذیرفته نشده‌است. آیا پوشهٔ‌ ایکس‌ام‌ال، یک بیانیهٔ ایکس‌ام‌ال در بالای پوشه دارد؟‌
&lt;?xml نسخه="1.0" رمزگذاری="UTF-8"?>',
	'gwtoolset-back-text-link' => '← بازگشت به فرم',
	'gwtoolset-back-text' => 'دکمهٔ بازگشت مرورگر را برای بازگشت به فرم، فشار دهید.',
	'gwtoolset-file-interpretation-error' => 'مشکلی در پردازش پوشهٔ فراداده بود',
	'gwtoolset-mediawiki-template' => 'الگوی $1',
	'gwtoolset-metadata-user-options-error' => 'فرم زیر {{PLURAL:$2|field|fields}} باید در $1 پر شود:',
	'gwtoolset-metadata-invalid-template' => 'هیچ الگوی مدیاویکی معتبری پیدا نشد.',
	'gwtoolset-menu-1' => 'نقشهٔ فراداده',
	'gwtoolset-technical-error' => 'یک خطای فنی بود.',
	'gwtoolset-required-field' => 'نشاندهندهٔ زمینهٔ لازم',
	'gwtoolset-submit' => 'ثبت',
	'gwtoolset-summary-heading' => 'خلاصه',
	'gwtoolset-cancel' => 'لغو',
	'gwtoolset-loading' => 'لطفاً صبور باشید. ممکن است مدتی طول بکشد.',
	'gwtoolset-save' => 'ذخیره',
	'gwtoolset-save-mapping' => 'نقشهٔ ذخیره',
	'gwtoolset-save-mapping-failed' => 'متأسفم. مشکلی در پردازش درخواست شما بود. لطفاً بعداً دوباره امتحان کنید. (پیغام خطا: $1)',
	'gwtoolset-save-mapping-succeeded' => 'نقشهٔ شما ذخیره شده‌است.',
	'gwtoolset-save-mapping-name' => 'چگونه می‌خواهید این نقشه را نام‌گذاری کنید؟',
	'gwtoolset-json-error' => 'مشکلی با جی‌سون بود. خطا: $1',
	'gwtoolset-json-error-depth' => 'حداکثر عمق توده فراتر رفته‌است.',
	'gwtoolset-json-error-state-mismatch' => 'عدم مطابقت پاریز یا روش.',
	'gwtoolset-json-error-ctrl-char' => 'مشخصهٔ کنترلی غیرمنتظره‌ای پیدا شد.',
	'gwtoolset-json-error-syntax' => 'خطای نحو، جی‌سون ناقص.',
	'gwtoolset-json-error-utf8' => 'مشخصه‌های یو‌تی‌اف-۸ ناقص، احتمالاً نادرست رمز‌گذاری شده.',
	'gwtoolset-json-error-unknown' => 'خطای ناشناخته.',
	'gwtoolset-accepted-file-types' => 'پوشهٔ قبول شدهٔ {{PLURAL:$1|type|types}}:',
	'gwtoolset-ensure-well-formed-xml' => 'مطمئن شوید که پوشهٔ ایکس‌ام‌ال با $1 به خوبی شکل گرفته است.',
	'gwtoolset-file-url-invalid' => 'یوآر‌ال پوشه نامعتبر بود; پوشه هنوز در ویکی وجود ندارد. شما نیاز دارید ابتدا پوشه را از کامپیوتر خود انتقال دهید اگر می‌خواهید از منبع یوآرال پوشه در فرم استفاده کنید.',
	'gwtoolset-mediafile-throttle' => 'سرکوب مدیافایل:',
	'gwtoolset-mediafile-throttle-description' => 'پس از پیش‌‌نمایش دسته، در مرحلهٔ ۳، جی‌دبلیو‌تول‌ست، سوابق باقیمانده را در دستهٔ انتقالات شما از طریق مشاغل پس‌زمینه انتقال می‌دهد.گاز مدیافایل کنترل می‌کند تعداد درخواست‌های مدیافایل را که مشترکات ویکی‌مدیا علیه سرور مدیافایل شما خواهد بود که هر زمان یک شغل پیش‌زمینه اجرا می‌شود.شما می‌توانید گاز مدیافایل را بین ۱ـ۲۰ تنظیم می‌کند. برای مثال، اگر تعداد کل سوابق در دستهٔ انتقال شما ۱۰۰ است و شما گاز را به ۲۰ تنظیم می‌کنید، مشترکات ویکی‌مدیا ۵ شغل پیش‌زمینه را پردازش کل دستهٔ انتقال شما اجرا خواهد کرد. زمان بین هر انتقال انواع شغل‌ها بستگی به بارگذاری سرور و پیکربندی دارد؛ ما پیش‌بینی می‌کنیم که در مشترکات ویکی‌مدیا یک شغل پس‌زمینه جی‌دبلیو‌تول‌ست حداقل هر ۵ دقیقه اجرا خواهد شد.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'الگوی مدیاویکی "<strong>$1</strong>" در ویکی وجود ندارد.
یا الگو را وارد کنید یا الگوی مدیاویکی دیگری را برای استفاده از نقشه انتخاب کنید.',
	'gwtoolset-mediawiki-template-not-found' => 'الگوی "$1" مدیاویکی پیدا نشد.',
	'gwtoolset-metadata-file-source' => 'منبع پوشهٔ فراداده را انتخاب کنید.',
	'gwtoolset-metadata-file-source-info' => '... یا پوشه‌ای که قبلاً انتقال داده شده‌است یا پوشه‌ای که مایلید از کامپیوتر خود انتقال دهید.',
	'gwtoolset-metadata-file-url' => 'یوآر‌ال پوشهٔ فرادادهٔ ویکی:',
	'gwtoolset-metadata-file-upload' => 'انتقال پوشهٔ فراداده:',
	'gwtoolset-metadata-mapping-bad' => 'مشکلی با نقشه‌برداری فراداده وجود دارد. به احتمال زیاد فرمت جی‌سون نامعتبر است. سعی کنید و مسئله را درست کنید و سپس فرم را دوباره ارائه کنید.
$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'یوآرال نقشه‌برداری فرادادهٔ‌ عرضه شده، با مسیر یوآرال نقشه‌برداری انتظار رفته، مطابقت ندارد.
* یوآرال عرضه شده: $1
*یوآرال انتظار رفته: $2',
	'gwtoolset-metadata-mapping-not-found' => 'هیچ نقشه‌برداری فراداده‌ای پیدا نشد.
صفحهٔ‌ "<strong>$1<strong>" در ویکی وجود ندارد.',
	'gwtoolset-namespace-mismatch' => 'صفحهٔ "<strong>$1<strong>" در فضای نام اشتباه "<strong>$2<strong>" است.
باید در فضای نام  "<strong>$3<strong>" باشد.',
	'gwtoolset-no-xml-element-found' => 'هیچ عنصر ایکس‌ام‌ال برای نقشه‌برداری پیدا نشد.
* آیا مقداری در فرم برای "{{int:gwtoolset-record-element-name}}" وارد کردید؟ 
* آیا پوشهٔ ایکس‌ام‌ال به خوبی شکل گرفته‌است؟ [$1 ایکس‌ام‌ال سنج] را امتحان کنید.
$2',
	'gwtoolset-page-title-contains-url' => 'صفحهٔ "$1" شامل یوآر‌ال ویکی کامل است. مطمئن شوید شما فقط عنوان صفحه را وارد کردید، برای مثال قسمت یوآر‌ال پس از /wiki/',
	'gwtoolset-record-element-name' => 'عنصر ایکس‌ام‌الی که شامل هر سابقهٔ فراداده است، چیست:',
	'gwtoolset-step-1-heading' => 'مرحلهٔ ۱: تشخیص فراداده',
	'gwtoolset-step-1-instructions-1' => 'روند انتقال فراداده شامل ۴ مرحله است:',
	'gwtoolset-step-1-instructions-2' => 'در این مرحله، یک پوشهٔ فرادادهٔ جدید را به ویکی {{GENDER:$1|شما منتقل می‌کنید}}. ابزار برای خلاصهٔ زمینه‌های فرادادهٔ در دسترس در پوشهٔ فراداه کوشش خواهدکرد، که سپس شما برای یک الگوی مدیاویکی در "{{int:gwtoolset-step-2-heading}}" نقشه‌برداری خواهیدکرد.',
	'gwtoolset-step-1-instructions-3' => 'اگر دامنهٔ پوشهٔ مدیا شما در زیر فهرست نشده‌‌است، لطفاً [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment request] که دامنهٔ پوشهٔ مدیا فهرست سفید اضافه می‌شود. دامنهٔ فهرست سفید، فهرست دامنه‌های بررسی اشتراکات ویکی‌مدیا است علیه قبل از گرفتن پوشه‌های مدیا. اگر دامنهٔ پوشهٔ مدیا شما در آن فهرست نیست، اشتراکات ویکی‌مدیا، پوشه‌های مدیا از آن دامنه را دانلود نخواهد کرد. بهترین مثال، برای اٰرائهٔ در درخواست شما، یک لینک واقعی برای پوشهٔ مدیا است.',
	'gwtoolset-step-1-instructions-3-heading' => 'حیطهٔ فهرست سفید',
	'gwtoolset-step-1-instructions-li-1' => 'تشخیص فراداده',
	'gwtoolset-step-1-instructions-li-2' => 'نقشهٔ فراداده',
	'gwtoolset-step-1-instructions-li-3' => 'پیش نمایش گروه',
	'gwtoolset-step-1-instructions-li-4' => 'انتقال گروه',
	'gwtoolset-upload-legend' => 'انتقال پوشهٔ فرادادهٔ خود',
	'gwtoolset-which-mediawiki-template' => 'الگوی مدیاویکی:',
	'gwtoolset-which-metadata-mapping' => 'نقشهٔ فراداده:',
	'gwtoolset-xml-error' => 'عدم موفقیت بارگذاری ایکس‌ام‌ال. لطفاً خطاهای زیر را درست کنید.',
	'gwtoolset-categories' => 'دسته‌بندی‌های جداشده را با یک مشخصهٔ لوله‌ای ("|") وارد کنید',
	'gwtoolset-category' => 'رده',
	'gwtoolset-create-mapping' => '$1: ایجاد نقشه فراداده برای $2',
	'gwtoolset-example-record' => 'مثال محتویات سوابق فراداده.',
	'gwtoolset-global-categories' => 'دسته‌بندی‌های جهانی',
	'gwtoolset-global-tooltip' => 'ورودی‌های دسته‌بندی برای همهٔ موارد انتقال داده شده به طور جهانی اعمال خواهد شد.',
	'gwtoolset-maps-to' => 'نقشه‌هایی به',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'گسترهٔ پوشه نمی‌تواند از یوآر‌ال پوشه تعیین شود: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'یوآر‌ال پوشهٔ مدیا نتوانست ارزیابی شود. یوآر‌ال محتوا در راهی که هنوز توسط این گستره کنترل نشده را ارائه می‌دهد یا یک مسئلهٔ درخواست اچ‌تی‌تی‌پی وجود داشت. یوآر‌ال داده‌شده "$1" بود. خطای درخواست اچ‌تی‌تی پی "$2"',
	'gwtoolset-mapping-no-title' => 'نقشه‌برداری فراداده شامل هیچ عنوانی که نیازمند به ایجاد صفحه باشد، نیست.',
	'gwtoolset-mapping-no-title-identifier' => 'نقشه‌برداری فراداده شامل هیچ شناسهٔ عنوانی که برای ایجاد عنوان صفحه‌ای خاص استفاده می‌شود، نیست. مطمئن شوید زمینهٔ فراداده‌ای را برای شناسهٔ عنوان پارامتر الگوی مدیاویکی، نقشه‌برداری می کنید.',
	'gwtoolset-metadata-field' => 'زمینهٔ فراداده',
	'gwtoolset-metadata-file' => 'پوشهٔ فراداده',
	'gwtoolset-metadata-mapping-legend' => 'نقشه‌برداری فرادادهٔ شما',
	'gwtoolset-no-more-records' => '<strong>هیچ سوابقی برای پردازش نیست<strong>',
	'gwtoolset-painted-by' => 'نقاشی شده توسط',
	'gwtoolset-partner' => 'شریک',
	'gwtoolset-partner-explanation' => 'الگوهای شریک درون زمینهٔ منبع الگوی مدیا‌ویکی هنگامی که ارائه شد،کشیده شد. شما می‌توانید فهرست الگوهای شریک فعلی را در دسته پیدا کنید: صفحهٔ الگوهای منبع؛ لینک زیر را مشاهده کنید. هنگامی که الگوی شزیک مورد‌نظر خود را برای استفاده از محل يوآر‌ال در این زمینه پیدا کرده‌اید. شما همچنین می‌توانید اگر لازم بود، الگوی شریک جدیدی را ایجاد کنید.',
	'gwtoolset-partner-template' => 'الگوی شریک:',
	'gwtoolset-phrasing' => 'بیان‌کردن',
	'gwtoolset-preview' => 'پیش‌نمایش گروه',
	'gwtoolset-process-batch' => 'پردازش گروه',
	'gwtoolset-record-count' => 'تعداد کل سوابق پیدا شده در این پوشهٔ فراداده:
{{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'نتایج',
	'gwtoolset-step-2-heading' => 'مرحلهٔ ۲: نقشهٔ فراداده',
	'gwtoolset-step-2-instructions-heading' => 'نقشه‌برداری زمینه‌های فراداده',
	'gwtoolset-step-2-instructions-1' => 'در زیر است/هستند:',
	'gwtoolset-step-2-instructions-1-li-1' => 'فهرستی از زمینه‌ها در مدیاویکی $1',
	'gwtoolset-step-2-instructions-1-li-2' => 'سقوط زمینه‌هایی که نشاندهندهٔ زمینه‌های فراداده پیدا شده در پوشهٔ فراداده.',
	'gwtoolset-step-2-instructions-1-li-3' => 'یک نمونه سابقه از پوشهٔ‌ فراداده.',
	'gwtoolset-step-2-instructions-2' => 'در این مرحله شما نیاز به نقشه برداری زمینه‌های فراداده با زمینه‌های الگوی مدیاویکی دارید.',
	'gwtoolset-step-2-instructions-2-li-1' => 'انتخاب یک زمینهٔ‌ فراداده تحت ستون "{{int:gwtoolset-maps-to}}" که با یک زمینهٔ الگوی مدیاویکی تحت ستون "{{int:gwtoolset-template-field}}" مطابقت دارد.',
	'gwtoolset-step-2-instructions-2-li-2' => 'شما به ایجاد تطبیق برای زمینهٔ الگوی مدیاویکی نیار ندارید.',
	'gwtoolset-reupload-media' => 'انتقال دوبارهٔ رسانه از یوآر‌ال',
	'gwtoolset-reupload-media-explanation' => 'این جعبهٔ بررسی برای انتقال دوبارهٔ رسانه برای موردی که انتقال داده‌شده به ویکی به شما اجازه می‌دهد. اگر در حال حاضر این مورد وجود دارد، یک پوشهٔ رسانه‌ای اضافی به ویکی اضافه خواهد شد. اگر پوشهٔ رسانه‌ای هنوز وجود ندارد،  چه جعبهٔ بررسی، بررسی شده باشد یا نه، انتقال داده خواهد شد.',
	'gwtoolset-specific-categories' => 'دسته‌بندی‌های موردی خاص',
	'gwtoolset-specific-tooltip' => 'با استفاده از زمینه‌های زیر شما می‌توانید یک عبارت (اختیاری) به‌ اضافهٔ یک زمینهٔ فراداده به عنوان ورود دسته برای هر مورد انتقال شدهٔ جداگانه، درخواست کنید. برای مثال، اگر پوشهٔ فراداده شامل یک عنصر برای هنرمند هر سابقه باشد، شما می‌توانستید آن را به عنوان ورود دسته برای هر سابقه‌ای که تغییر خواهد کرد به مقدار ویژه‌ایبرای هر سابقه، اضافه کنید. همچنین می‌توانستید عبارتی مثل "<em>{{int:gwtoolset-painted-by}}</em>" اضافه کنید و سپس زمینهٔ فرادادهٔ هنرمند، که به عنوان دسته برای هر سابقه حاصل داده "<em>{{int:gwtoolset-painted-by}}.',
	'gwtoolset-template-field' => 'زمینهٔ الگو',
	'gwtoolset-step-3-instructions-heading' => 'مرحلهٔ ۳: پیش‌نمایش گروه',
	'gwtoolset-step-3-instructions-1' => 'در زیر نتایج انتقال {{PLURAL:$1|اولین سابقه|اولین $1 سوابق}} از پوشهٔ فراداده‌ای که انتخاب کرده‌اید و نقشه‌برداری {{PLURAL:$1|این|آنها}} برای الگوی مدیاویکی که در "{{int:gwtoolset-step-2-heading}}" انتخاب کرده‌اید.',
	'gwtoolset-step-3-instructions-2' => 'بررسی این صفحات و اگر نتایج با انتظارات شما جور درآمد، و سوابق اضافی در حال انتظاری برای انتقال داده‌شدن وجود دارند، روند انتقال گروه را با کلیک کردن بر روی دکمهٔ زیر "{{int:gwtoolset-process-batch}}" ادامه دهید.',
	'gwtoolset-step-3-instructions-3' => 'اگر از نتایج راضی نیستید، به "{{int:gwtoolset-step-2-heading}}" برگردید و نقشه‌برداری را به عنوان لازمه تنظیم کنید.
اگر نیاز دارید تنظیمات را برای پوشهٔ فرادادهٔ خودش ایجاد کنید، ادامه دهید و همچنان انجام دهید و این را با شروع پردازش دوباره با "{{int:gwtoolset-step-1-heading}}" دوباره انتقال دهید.',
	'gwtoolset-title-bad' => 'عنوان ایجاد شده، مبتنی بر فراداده و نقشه‌برداری الگوی مدیاویکی نامعتبر است.
زمینهٔ دیگری از فراداده برای عنوان و شناسهٔ عنوان امتحان کنید، یا اگر ممکن است، جایی که لازم است فراداده را تغییر دهید. برای اطلاعات بیشتر [https://commons.wikimedia.org/wiki/Commons:File_naming File naming] را مشاهده کنید.
<strong>Invalid title:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'کار گروه فراداده ایجاد شده. پوشهٔ‌ فراداده به طور مختصر تحلیل خواهد‌شد و هر مورد برای ویکی در یک پردازش پس‌زمینه انتقال داده خواهدشد. شما می‌توانید صفحهٔ "$1" را برای مشاهده هنگامی که انتقال داده شده‌اند، بررسی کنید.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'شغل گروهی از پوشهٔ فراداده نتوانست ایجاد شود.',
	'gwtoolset-create-mediafile' => '$1: ایجاد پوشهٔ مدیا برای $2.',
	'gwtoolset-create-prefix' => 'تتنظیم ابزارجی‌دبلیو',
	'gwtoolset-mediafile-jobs-created' => 'ایجاد گروه پوشهٔ مدیا $1 {{PLURAL:$1|job|jobs}}.',
	'gwtoolset-step-4-heading' => 'مرحلهٔ ۴: انتقال گروه',
	'gwtoolset-invalid-token' => 'نماد ویرایش ارائه شده با فرم نامعتبر است.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'تنظیمات فعلی <code>php.ini</code>: 
* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2
این‌ها کمتر از <code>$wgMaxUploadSize</code> ویکی تنظیم شده‌اند، که در "$3" تنظیم شده‌است. لطفاً برای صحت تنظیمات <code>php.ini</code> را تنظیم کنید.',
	'gwtoolset-mediawiki-version-invalid' => 'گستره نیازمند نسخهٔ $1<br /> مدیاویکی است،این نسخهٔ مدیاویکی $2 است.',
	'gwtoolset-permission-not-given' => 'مطمئن شوید که شما وارد شده‌اید یا برای تایید مجوز برای مشاهدهٔ‌ این صفحه ($1)، با سرپرست تماس بگیرید.',
	'gwtoolset-user-blocked' => 'حساب کاربری شما در حال حاضر مسدود شده‌است. لطفاً برای حل کردن مسئلهٔ مسدود، با سرپرست تماس بگیرید.',
	'gwtoolset-required-group' => 'شما عضو گروه $1 نیستید.',
	'gwtoolset-verify-api-enabled' => 'گسترهٔ $1 نیازمند این است که ای‌پی‌آی ویکی فعال شود.
لطفاً مطمئن شوید که <code>true</code> در پوشهٔ‌ <code>DefaultSettings.php</code>،به <code>$wgEnableAPI</code> تنظیم شده است یا به <code>true</code> در پوشهٔ <code>LocalSettings.php</code> نادیده گرفته‌ شده‌است.',
	'gwtoolset-verify-api-writeable' => 'گسترهٔ $1 نیازمند این است که ای‌پی‌آی ویکی می تواند عملیات نوشتن را برای مجاز کردن کاربران انجام دهد.
لطفاً مطمئن شوید که <code>$wgEnableWriteAPI</code> به <code>true</code> در پوشهٔ <code>DefaultSettings.php</code> تنظیم شده‌است یا به <code>true</code> در پوشهٔ <code>LocalSettings.php</code> نادیده گرفته شده‌است.',
	'gwtoolset-verify-curl' => 'گسترهٔ $1 نیازمند به نصب پی‌اچ‌پی [http://www.php.net/manual/en/curl.setup.php cURL functions] است.',
	'gwtoolset-verify-finfo' => 'گسترهٔ $1 نیازمند به نصب پی‌اچ‌پی [http://www.php.net/manual/en/fileinfo.setup.php finfo] است.',
	'gwtoolset-verify-php-version' => 'گسترهٔ $1 نیازمند پی‌اچ‌پی >= ۵.۳.۳ است.',
	'gwtoolset-verify-uploads-enabled' => 'گسترهٔ $1 نیازمند انتقالات پوشه‌ای فعال است.
لطفاً مطمئن شوید که <code>$wgEnableUploads</code> به <code>true</code> در <code>LocalSettings.php</code> تنظیم شده است.',
	'gwtoolset-verify-xmlreader' => 'گسترهٔ $1 نیازمند نصب پی‌اچ‌پی [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] است.',
	'gwtoolset-wiki-checks-not-passed' => 'بررسی‌های ویکی پذیرفته نشده.',
);

/** Finnish (suomi)
 * @author Stryn
 * @author Susannaanas
 */
$messages['fi'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWTyökalut, GLAM-massalataustyökalu',
	'gwtoolset-intro' => 'GWTyökalut on MediaWiki-laajennus, jonka avulla GLAMit (galleriat, kirjastot, arkistot ja museot) voivat massaladata sisältöä Wikimedia Commonsiin vastaavat metatiedot sisältävän XML-tiedoston avulla. Tavoitteena on tarjota useita myös erilaisia XML-skeemoja. Lisätietoja hankkeesta löytyy [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project projektisivulta]. Ota yhteyttä kyseisen sivun kautta. Valitse jokin yllä olevan valikon vaihtoehdoista latausprosessin käynnistämiseksi.',
	'right-gwtoolset' => 'Käytä GWTyökaluja',
	'action-gwtoolset' => 'käytä GWTyökaluja',
	'group-gwtoolset' => 'GWTyökalujen käyttäjät',
	'group-gwtoolset-member' => '{{GENDER:$1|GWTyökalujen käyttäjä}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWTyökalujen käyttäjät',
	'gwtoolset-batchjob-creation-failure' => 'Ei voitu luoda "$1"-tyyppistä massalataustyötä.',
	'gwtoolset-could-not-close-xml' => 'XML-lukijaa ei voitu sulkea.',
	'gwtoolset-could-not-open-xml' => 'Ei voitu avata XML-tiedostoa lukutilaan.',
	'gwtoolset-developer-issue' => 'Ota yhteyttä kehittäjään. Asia on käsiteltävä ennen kuin voit jatkaa. Lisää seuraava teksti raporttiin:
N!$1',
	'gwtoolset-dom-record-issue' => 'Joko<code>record-element-name</code>, tai <code>record-count</code>, tai <code>record-current</code> tietoja ei saatu.',
	'gwtoolset-file-backend-maxage-invalid' => 'Yläikärajan arvo <code>$wgGWTFBMaxAge</code> on virheellinen.
Katso [php.net/manual/en/datetime.formats.relative.php PHP-käsikirjasta] miten se asetetaan oikein.',
	'gwtoolset-fsfile-empty' => 'Tiedosto oli tyhjä ja poistettiin.',
	'gwtoolset-fsfile-retrieval-failure' => 'Tiedostoa ei voitu hakea URL-osoitteesta $1 .',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> ei ole asetettu.',
	'gwtoolset-no-accepted-types' => 'Ei ole annettu hyväksyttyä tyyppiä.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> ei ole asetettu.",
	'gwtoolset-no-default' => 'Oletusarvoa ei ole annettu.',
	'gwtoolset-no-field-size' => 'Kentälle "$1" ei ole määritetty kokoa.',
	'gwtoolset-no-file-url' => '<code>file_url</code> ei ole annettu jäsennettäväksi.',
	'gwtoolset-no-form-handler' => 'Lomakkeenkäsittelijää ei ole luotu.',
	'gwtoolset-no-mapping' => '<code>mapping_name</code> ei ole annettu.',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code> ei ole annettu.',
	'gwtoolset-no-max' => 'Maksimiarvoa ei ole annettu.',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name</code> ei ole annettu.',
	'gwtoolset-no-min' => 'Minimiarvoa ei ole annettu.',
	'gwtoolset-no-module' => 'Moduulin nimeä ei ole määritetty.',
	'gwtoolset-no-mwstore-complete-path' => 'Ei ole annettu täydellistä tiedostopolkua.',
	'gwtoolset-no-mwstore-relative-path' => 'Ei ole annettu suhteellista polkua.',
	'gwtoolset-no-page-title' => 'Sivun otsikkoa ei ole annettu.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> ei ole annettu.",
	'gwtoolset-no-source-array' => 'Lähdetaulukkoa ei ole annettu.',
	'gwtoolset-no-summary' => 'Yhteenvetoa ei ole annettu.',
	'gwtoolset-no-template-url' => 'Ei ole annettu URL-malliosoitetta jäsennettäväksi.',
	'gwtoolset-no-text' => 'Tekstiä ei ole annettu.',
	'gwtoolset-no-title' => 'Otsikkoa ei ole annettu.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> ei ole annettu.",
	'gwtoolset-no-url-to-evaluate' => 'URL-osoitetta ei ole annettu arvioitavaksi.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> ei ole annettu.',
	'gwtoolset-no-xml-source' => 'Ei ole annettu paikallista XML-lähdetiedostoa.',
	'gwtoolset-not-string' => 'Annettu arvo ei ollut merkkijono. Se on tyyppiä "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 ei vastaa.',
	'gwtoolset-disk-write-failure' => 'Palvelin ei voinut tallentaa tiedostoa tiedostojärjestelmään.',
	'gwtoolset-xml-doctype' => 'XML-metatietotiedosto ei voi sisältää <!DOCTYPE>-osaa. Poista se ja yritä sitten ladata XML-metatietotiedosto uudelleen.',
	'gwtoolset-file-is-empty' => 'Ladattu tiedosto on tyhjä.',
	'gwtoolset-improper-upload' => 'Tiedostoa ei ladattu oikein.',
	'gwtoolset-mime-type-mismatch' => 'Tiedostotunniste "$1"ja ladatun tiedoston MIME-tyyppi "$2" eivät täsmää.',
	'gwtoolset-missing-temp-folder' => 'Ei väliaikaista kansiota käytettävissä.',
	'gwtoolset-multiple-files' => 'Ladattu tiedosto sisältää tietoja useammasta kuin yhdestä tiedostosta. Kerralla voidaan lähettää vain yksi tiedosto.',
	'gwtoolset-no-extension' => 'Ladattu tiedosto ei sisällä tarpeeksi tietoja tiedoston käsittelemiseksi. Todennäköisesti sillä ei ole tiedostopäätettä.',
	'gwtoolset-no-file' => 'Tiedostoa ei saatu.',
	'gwtoolset-no-form-field' => 'Odotettua lomakekenttää "$1" ei ole olemassa.',
	'gwtoolset-over-max-ini' => 'Ladattu tiedosto ylittää <code>upload_max_filesize</code> ja/tai <code>post_max_size</code> direktiivin <code>php.ini</code>-tiedostossa.',
	'gwtoolset-partial-upload' => 'Tiedosto ladattiin vain osittain.',
	'gwtoolset-php-extension-error' => 'PHP-laajennus pysäytti tiedoston lataamisen. PHP ei tarjoa keinoa selvittää, mikä laajennus sen aiheutti. Ladattujen laajennusten luettelon tarkastelemisesta <code>phpinfo()</code> avulla voi olla apua.',
	'gwtoolset-unaccepted-extension' => 'Lähdetiedosto ei sisällä hyväksyttyä tiedostotunnistetta.',
	'gwtoolset-unaccepted-extension-specific' => 'Lähdetiedostossa on odottamaton tiedostotunniste ".$1".',
	'gwtoolset-unaccepted-mime-type' => 'Ladatussa tiedostossa tulkitaan olevan MIME-tyyppi "$1", joka ei ole hyväksytty tyyppi.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Ladatussa tiedostossa on MIME-tyyppi "$1", joka ei ole hyväksytty tyyppi. Onko XML-tiedoston alussa XML-määritys?

<?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← siirry takaisin lomakkeeseen',
	'gwtoolset-back-text' => 'Paina selaimen takaisin-painiketta palataksesi lomakkeeseen.',
	'gwtoolset-file-interpretation-error' => 'Metatietotiedoston käsittelemisessä tapahtui virhe.',
	'gwtoolset-mediawiki-template' => 'Malli $1',
	'gwtoolset-metadata-user-options-error' => 'Oheisen lomakkeen {{PLURAL:$2|kenttä|kentät}} on täytettävä:
$1',
	'gwtoolset-metadata-invalid-template' => 'Ei löytynyt kelvollista MediaWiki-mallinetta.',
	'gwtoolset-menu-1' => 'Metatietojen määritykset',
	'gwtoolset-technical-error' => 'Tapahtui tekninen virhe.',
	'gwtoolset-required-field' => 'tarkoittaa pakollista kenttää',
	'gwtoolset-submit' => 'Lähetä',
	'gwtoolset-summary-heading' => 'Yhteenveto',
	'gwtoolset-cancel' => 'Peruuta',
	'gwtoolset-loading' => 'Ole kärsivällinen. Tämä voi kestää jonkin aikaa.',
	'gwtoolset-save' => 'Tallenna',
	'gwtoolset-save-mapping' => 'Tallenna määritys',
	'gwtoolset-save-mapping-failed' => 'Pahoittelut. Virhe käsiteltäessä pyyntöä. Yritä myöhemmin uudelleen. (Virheilmoitus: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Määrityksesi on tallennettu.',
	'gwtoolset-save-mapping-name' => 'Miten haluaisit nimetä tämän määrityksen?',
	'gwtoolset-json-error' => 'Virhe JSONin kanssa. Virhe: $1',
	'gwtoolset-json-error-depth' => 'Maksimi pinon syvyys ylitetty.',
	'gwtoolset-json-error-ctrl-char' => 'Odottamaton ohjausmerkki löytynyt.',
	'gwtoolset-json-error-syntax' => 'Syntaksivirhe, väärin muotoiltu JSON.',
	'gwtoolset-json-error-utf8' => 'Virheellisiä UTF-8 merkkejä, mahdollisesti väärin koodattu.',
	'gwtoolset-json-error-unknown' => 'Tuntematon virhe.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Hyväksytty tiedostotyyppi|Hyväksytyt tiedostotyypit}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Varmista, että XML-tiedosto on hyvin muodostettu tämän $1 kanssa.',
	'gwtoolset-file-url-invalid' => 'Tiedoston URL-osoite oli virheellinen: tiedosto ei ole vielä Wikimedia Commosissa. Sinun täytyy ensin ladata tiedosto tietokoneeltasi, jos haluat käyttää tiedoston URL-viittausta lomakkeella.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'MediaWiki-mallinetta "<strong>$1</strong>" ei ole Wikimedia Commosissa.
Tuo malline tai valitse toinen MediaWiki-malline määrittelyä varten.',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki-mallinetta "$1" ei löytynyt.',
	'gwtoolset-metadata-file-source' => 'Valitse metatietojen lähdetiedosto.',
	'gwtoolset-metadata-file-source-info' => '... joko aikaisemmin ladattu tiedosto tai tiedosto, jonka haluat lähettää tietokoneeltasi.',
	'gwtoolset-metadata-file-url' => 'Metatietotiedoston URL-osoite Wikimedia Commonsissa:',
	'gwtoolset-metadata-file-upload' => 'Metatietotiedoston lataaminen:',
	'gwtoolset-metadata-mapping-bad' => 'Metatietojen määrityksessä on ongelma. Todennäköisesti JSON-muoto ei kelpaa. Yritä korjata ongelma ja lähettää lomake uudelleen.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'Ehdotettu metatietojen määrityksen URL-osoite ei vastaa odotettua määrityksen URL-polkua.

* Ehdotettu URL: $1 
* Odotetu URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'Metatietomääritystä ei löytynyt.

Sivua "<strong>$1<strong>" ei ole Wikimedia Commonsissa.',
	'gwtoolset-namespace-mismatch' => 'Sivu "<strong>$1<strong>" on väärässä nimiavaruudessa "<strong>$2<strong>".

Sen kuuluisi olla nimiavaruudessa "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'Ei löytynyt määritykseen tarvittavaa XML-elementtiä.
* Syötitkö lomakkeella arvon elementille "{{int:gwtoolset-record-elementti-nimi}}"?
* Onko XML-tiedosto oikein muotoiltu? Kokeile tätä $1.
$2', # Fuzzy
	'gwtoolset-page-title-contains-url' => 'Sivu "$1" sisältää koko URL-osoitteen Wikimedia Commonsiin. Varmista, että annat vain sivun otsikon, kuten URL-osoitteen osan tekstin /wiki/ jälkeen',
	'gwtoolset-record-element-name' => 'Mikä on XML-elementti, joka sisältää kaikki metatietotietueet:',
	'gwtoolset-step-1-heading' => 'Vaihe 1: Metatietojen tunnistus',
	'gwtoolset-step-1-instructions-1' => 'Metatietojen latausprosessi koostuu 4 vaiheesta:',
	'gwtoolset-step-1-instructions-2' => 'Tässä vaiheessa voit ladata uuden metatietotiedoston wikiin. Työkalu yrittää poimia metatietokentiksi käytettävissä metatietoja tiedostosta, jotka sitten yhdistetään MediaWiki-mallineeseen "{{int:gwtoolset-vaihe-2-otsikon}}".', # Fuzzy
	'gwtoolset-step-1-instructions-li-1' => 'Metatietojen tunnistaminen',
	'gwtoolset-step-1-instructions-li-2' => 'Metatietojen määritykset',
	'gwtoolset-step-1-instructions-li-3' => 'Erän esikatselu',
	'gwtoolset-step-1-instructions-li-4' => 'Erän lähetys',
	'gwtoolset-upload-legend' => 'Lähetä metatietotiedostosi',
	'gwtoolset-which-mediawiki-template' => 'Mikä MediaWiki-malline:',
	'gwtoolset-which-metadata-mapping' => 'Mikä metatietomääritys:',
	'gwtoolset-xml-error' => 'XML-tiedoston lataaminen epäonnistui. Korjaa seuraavat virheet.',
	'gwtoolset-categories' => 'Anna luokat erotettuna pystyviivalla ("|")',
	'gwtoolset-category' => 'Luokka',
	'gwtoolset-create-mapping' => '$1: Luodaan metatietojen määritys käyttäjälle $2.',
	'gwtoolset-step-2-instructions-1' => 'Alla on:',
	'gwtoolset-step-2-instructions-1-li-1' => 'MediaWiki-kenttien luettelo $1 .',
	'gwtoolset-step-2-instructions-1-li-2' => 'Pudotusvalikon kentät, jotka edustavat metatietokenttiä metatietotiedostossa.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Näytetietue metatietotiedostosta.',
	'gwtoolset-step-2-instructions-2' => 'Tässä vaiheessa yhdistät metatietokentät MediaWiki-mallineen kenttiin.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Valitse "{{int:gwtoolset-maps-to}}"-sarakkeesta metatietokenttä, joka vastaa MediaWiki-mallineen vastaavaa kenttää sarakkeessa "{{int:gwtoolset-template-field}}".',
	'gwtoolset-step-2-instructions-2-li-2' => 'Kaikille MediaWiki-mallineen kentille ei tarvitse antaa vastinetta.',
	'gwtoolset-reupload-media' => 'Lataa media uudelleen palvelimelle URLista',
	'gwtoolset-reupload-media-explanation' => 'Tämän valintaruudun avulla voit ladata uudelleen median nimikkeelle, joka on jo ladattu wikiin. Jos nimike on jo olemassa, wikiin lisätään uusi mediatiedosto. Jos mediatiedostoa ei vielä ole, se ladataan, oli tämä valintaruutu valittuna tai ei.',
	'gwtoolset-specific-categories' => 'Nimikekohtaiset luokat',
	'gwtoolset-template-field' => 'Mallineen kenttä',
	'gwtoolset-step-3-instructions-heading' => 'Vaihe 3: Erän esikatselu',
	'gwtoolset-step-3-instructions-3' => 'Jos et ole tyytyväinen tuloksiin, palaa "{{int:gwtoolset-step-2-otsikon}}" ja säädä vastaavuuksia tarvittaessa.

Jos haluat tehdä muutoksia metatietotiedostoon, tee korjaukset ja lataa tiedosto uudelleen alkaen kohdasta "{{int:gwtoolset-vaihe-1-otsikon}}".',
	'gwtoolset-title-bad' => 'Metatietojen ja MediaWiki-mallineen pohjalta luotu otsikko ei kelpaa.

Kokeile käyttää toista metatietokenttää otsikkona ja otsikon tunnisteena, tai muuta mahdollisuuksien mukaan metatietoja. Lisätietoja [https://commons.wikimedia.org/wiki/Commons:File_naming Tiedostojen nimeäminen].

<strong>Virheellinen otsikko:</strong>$1.',
	'gwtoolset-create-prefix' => 'GWTyökalut',
	'gwtoolset-step-4-heading' => 'Vaihe 4: Massalataus',
	'gwtoolset-mediawiki-version-invalid' => 'Tämä laajennus edellyttää MediaWikin versiota $1<br />Tämän MediaWikin versio on $2 .',
	'gwtoolset-permission-not-given' => 'Varmista, että olet kirjautunut sisään tai ota yhteys järjestelmänvalvojaan, jotta sinulle voidaan myöntää lupa nähdä tämä sivu ($1).',
	'gwtoolset-user-blocked' => 'Tilisi on tällä hetkellä estetty. Pyydä järjestelmänvalvojaa poistamaan esto.',
	'gwtoolset-required-group' => 'Et ole ryhmän $1 jäsen.',
);

/** French (français)
 * @author Crochet.david
 * @author Gomoko
 * @author Jean-Frédéric
 * @author Moyg
 * @author Nobody
 * @author VIGNERON
 */
$messages['fr'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, un outil d’import en masse pour GLAMs',
	'gwtoolset-intro' => "GWToolset est une extension MediaWiki permettant aux institutions culturelles (''GLAM'' − bibliothèques, archives, musées et galeries) de téléverser en masse des contenus en se basant sur un fichier XML contenant les métadonnées de ces contenus. Le but est d’autoriser une grande variété de schémas XML. De plus amples informations sur le projet sont disponibles sur [https://commons.wikimedia.org/wiki/Commons:GLAMwiki_Toolset_Project la page projet]. N’hésitez pas à nous contacter aussi via cette page. Choisissez l’un des éléments dans le menu ci-dessus et c’est parti pour le processus de téléversement.",
	'right-gwtoolset' => 'Utiliser GWToolset',
	'action-gwtoolset' => 'utiliser gwtoolset',
	'group-gwtoolset' => 'Utilisateurs de GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Utilisateur|Utilisatrice}} de GWToolset',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset users',
	'gwtoolset-batchjob-creation-failure' => 'Impossible de crée un traitement par lot de type « $1 ».',
	'gwtoolset-could-not-close-xml' => 'Impossible de fermer le lecteur XML.',
	'gwtoolset-could-not-open-xml' => 'Impossible de lire le fichier XML.',
	'gwtoolset-developer-issue' => "Veuillez contacter un développeur. Le message doit être traité avant de continuer. Merci d'ajouter le texte suivant à votre message :

$1",
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, ou <code>record-count</code>, ou <code>record-current</code> non fourni.',
	'gwtoolset-file-backend-maxage-invalid' => 'La valeur de l’âge maximum fournie dans <code>$wgGWTFBMaxAge</code> n’est pas valide.
Voyez le [php.net/manual/en/datetime.formats.relative.php manuel PHP] comment la fixer correctement.',
	'gwtoolset-fsfile-empty' => 'Le fichier était vide et a été supprimé.',
	'gwtoolset-fsfile-retrieval-failure' => 'Le fichier n’a pas pu être récupéré à partir de l’URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> n’est pas défini.',
	'gwtoolset-incorrect-form-handler' => 'Le module « $1 » n’a pas enregistré de gestionnaire de formulaire étendant GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'L’accélérateur de traitements de masse a été dépassé.',
	'gwtoolset-no-accepted-types' => 'Aucun type accepté fourni',
	'gwtoolset-no-callback' => 'Aucune fonction de rappel passée à cette méthode.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> non défini.",
	'gwtoolset-no-default' => 'Aucune valeur par défaut fournie.',
	'gwtoolset-no-field-size' => 'Aucune taille spécifiée pour le champ « $1 ».',
	'gwtoolset-no-file-backend-name' => 'Aucun nom terminal de fichier fourni.',
	'gwtoolset-no-file-backend-container' => 'Aucun nom de conteneur terminal de fichier fourni.',
	'gwtoolset-no-file-url' => 'Aucun <code>file_url</code> fourni pour analyse.',
	'gwtoolset-no-form-handler' => 'Aucun gestionnaire de formulaire créé.',
	'gwtoolset-no-mapping' => 'Aucun <code>mapping_name</code> fourni.',
	'gwtoolset-no-mapping-json' => 'Aucun <code>mapping_json</code> fourni.',
	'gwtoolset-no-max' => 'Aucune valeur maximale fournie.',
	'gwtoolset-no-mediafile-throttle' => 'Aucun accélérateur de traitement de fichier média fourni.',
	'gwtoolset-no-mediawiki-template' => 'Aucun <code>mediawiki-template-name</code> fourni.',
	'gwtoolset-no-min' => 'Aucune valeur minimale fournie.',
	'gwtoolset-no-module' => 'Aucun nom de module n’a été spécifié.',
	'gwtoolset-no-mwstore-complete-path' => 'Aucun chemin de dossier complet fourni.',
	'gwtoolset-no-mwstore-relative-path' => 'Aucun chemin d’accès relatif fourni.',
	'gwtoolset-no-page-title' => 'Pas de page de titre fournie.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> n’a pas été défini.",
	'gwtoolset-no-source-array' => 'Aucun tableau source fourni.',
	'gwtoolset-no-summary' => 'Aucun résumé fourni.',
	'gwtoolset-no-template-url' => 'Aucun modèle d’URL fourni à analyser.',
	'gwtoolset-no-text' => 'Aucun texte fourni.',
	'gwtoolset-no-title' => 'Aucun titre fourni.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> n’a pas été défini.",
	'gwtoolset-no-url-to-evaluate' => 'Aucune URL fournie pour l’évaluation.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> n’a pas été défini.',
	'gwtoolset-no-user' => 'Aucun objet utilisateur fourni.',
	'gwtoolset-no-xml-element' => 'Aucun XMLReader ou DOMElement fourni.',
	'gwtoolset-no-xml-source' => 'Aucune source locale de XML fourni.',
	'gwtoolset-not-string' => 'La valeur fournie à la méthode n’était pas une chaîne. Elle est du type "$1".',
	'gwtoolset-sha1-does-not-match' => 'Le hachage SHA-1 ne correspond pas.',
	'gwtoolset-disk-write-failure' => 'Le serveur n’a pas pu écrire le fichier dans un système de fichiers.',
	'gwtoolset-xml-doctype' => 'Le fichier de métadonnées XML ne contient pas une section <!DOCTYPE>. Supprimez-le puis essayez d’importer de nouveau le fichier de métadonnées XML.',
	'gwtoolset-file-is-empty' => 'Le fichier importé est vide.',
	'gwtoolset-improper-upload' => 'Le fichier n’a pas été importé correctement.',
	'gwtoolset-mime-type-mismatch' => 'L’extension de fichier "$1" et le type MIME "$2" du fichier importé ne correspondent pas.',
	'gwtoolset-missing-temp-folder' => 'Aucun dossier temporaire disponible.',
	'gwtoolset-multiple-files' => 'Le fichier qui a été importé contient des informations sur plus d’un fichier. Un seul fichier peut être soumis à la fois.',
	'gwtoolset-no-extension' => 'Le fichier qui a été importé ne contient pas assez d’information pour être traité. Le plus vraisemblable est qu’il n’a pas d’extension de fichier.',
	'gwtoolset-no-file' => 'Aucun fichier n’a été reçu.',
	'gwtoolset-no-form-field' => 'Le champ de formulaire obligatoire « $1 » n’existe pas.',
	'gwtoolset-over-max-ini' => 'Le fichier qui a été importé dépasse <code>upload_max_filesize</code> et/ou la directive <code>post_max_size</code> dans <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Le fichier n’a été importé que partiellement.',
	'gwtoolset-php-extension-error' => 'Une extension PHP a interrompue l’import du fichier. PHP ne fournit pas de moyen d’établir quelle extension l’a provoqué. L’examen de la liste des extensions chargées par <code>phpinfo()</code> peut aider.',
	'gwtoolset-unaccepted-extension' => 'Le fichier source ne contient pas une extension de fichier acceptée.',
	'gwtoolset-unaccepted-extension-specific' => 'Le fichier source a une extension de fichier « $1 » non acceptée.',
	'gwtoolset-unaccepted-mime-type' => 'Le fichier importé est interprété comme ayant le type MIME « $1 », qui n’est pas un type MIME accepté.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Le fichier importé a le type MIME « $1 », qui n’est pas accepté. Le fichier XML a-t-il une déclaration XML au début du fichier ?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← retour au formulaire',
	'gwtoolset-back-text' => 'Appuyer sur le bouton retour arrière du navigateur pour revenir au formulaire.',
	'gwtoolset-file-interpretation-error' => 'Il y a eu un problème de traitement du fichier de métadonnées',
	'gwtoolset-mediawiki-template' => 'Modèle $1',
	'gwtoolset-metadata-user-options-error' => '{{PLURAL:$2|Le champ de formulaire suivant doit être rempli|Les champs de formulaire suivants doivent être remplis}} dans :
$1',
	'gwtoolset-metadata-invalid-template' => 'Aucun modèle MediaWiki valide trouvé.',
	'gwtoolset-menu-1' => 'Correspondance des métadonnées',
	'gwtoolset-technical-error' => 'Il y a eu une erreur technique.',
	'gwtoolset-required-field' => 'indique un champ obligatoire',
	'gwtoolset-submit' => 'Soumettre',
	'gwtoolset-summary-heading' => 'Résumé',
	'gwtoolset-cancel' => 'Annuler',
	'gwtoolset-loading' => 'Veuillez patienter. Cela peut prendre un peu de temps.',
	'gwtoolset-save' => 'Enregistrer',
	'gwtoolset-save-mapping' => 'Enregistrer la correspondance',
	'gwtoolset-save-mapping-failed' => 'Désolé. Il y a eu un problème lors du traitement de votre requête. Veuillez réessayer ultérieurement. (Message d’erreur : $1)',
	'gwtoolset-save-mapping-succeeded' => 'Votre correspondance a été enregistrée.',
	'gwtoolset-save-mapping-name' => 'Comment voulez-vous appeler cette correspondance ?',
	'gwtoolset-json-error' => 'Il y a un problème avec le JSON. Erreur: $1',
	'gwtoolset-json-error-depth' => 'Profondeur maximale de la pile dépassée.',
	'gwtoolset-json-error-state-mismatch' => 'Dépassement de capacité ou non-correspondance des modes.',
	'gwtoolset-json-error-ctrl-char' => 'Caractère de contrôle non attendu trouvé.',
	'gwtoolset-json-error-syntax' => 'Erreur de syntaxe, JSON mal formé.',
	'gwtoolset-json-error-utf8' => 'Caractères UTF-8 mal formés, peut-être mal encodés.',
	'gwtoolset-json-error-unknown' => 'Erreur inconnue.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Type de fichier accepté|Types de fichier acceptés}} :',
	'gwtoolset-ensure-well-formed-xml' => 'Assurez-vous que le fichier XML est bien formé avec ce $1.',
	'gwtoolset-file-url-invalid' => 'Le fichier URL était non valide ; ce fichier n’existe pas encore dans le wiki. Vous devez d’abord importer le fichier depuis votre machine si vous voulez utiliser la référence d’URL du fichier dans ce formulaire.',
	'gwtoolset-mediafile-throttle' => 'Accélérateur de fichier média :',
	'gwtoolset-mediafile-throttle-description' => 'Après l’aperçu du lot, dans l’étape 3, GWToolset importe les enregistrements restants dans votre import de lot via des traitements en tâche de fond. L’accélérateur de fichier média contrôle le nombre de requêtes de fichiers média que Wikimédia Communs fera à votre serveur de fichiers média chaque fois qu’un traitement en tâche de fond est exécuté. Vous pouvez fixer l’accélérateur de fichiers média entre 1 et 20. Par exemple, si le nombre total d’enregistrements de votre import de lot est de 100 et que vous avez fixé l’accélérateur à 20, Wikimédia Communs fera tourner 5 traitements en tâche de fond pour exécuter l’ensemble de votre import de lot. Le temps entre chaque traitement en tâche de fond dépend de la charge du serveur et de la configuration ; nous avons prévu que sur Wikimédia Communs un traitement en tâche de fond de GWToolset tournera au moins toutes les 5 minutes.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Le modèle MediaWiki "<strong>$1</strong>" n’existe pas dans le wiki.

Importez le modèle, ou sélectionnez un autre modèle MediaWiki à utiliser pour la correspondance.',
	'gwtoolset-mediawiki-template-not-found' => 'Modèle MediaWiki « $1 » introuvable.',
	'gwtoolset-metadata-file-source' => 'Sélectionner le fichier de métadonnées source.',
	'gwtoolset-metadata-file-source-info' => '… soit un fichier qui a été préalablement importé ou un fichier que vous voulez importer depuis votre machine.',
	'gwtoolset-metadata-file-url' => 'URL du wiki du fichier de métadonnées :',
	'gwtoolset-metadata-file-upload' => 'Import du fichier de métadonnées :',
	'gwtoolset-metadata-mapping-bad' => 'Il y a un problème avec la correspondance des métadonnées. Le plus vraisemblable est que le format JSON n’est pas valide. Essayez de corriger le problème puis soumettez de nouveau le formulaire.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'L’URL de correspondance des métadonnées fournie ne correspond pas au chemin d’URL de correspondance attendu.

* URL fournie : $1
* URL attendue : $2',
	'gwtoolset-metadata-mapping-not-found' => 'Aucune correspondance de métadonnées n’a été trouvée.

La page « <strong>$1<strong> » n’existe pas dans le wiki.',
	'gwtoolset-namespace-mismatch' => 'La page « <strong>$1<strong> » est dans le mauvais espace de noms « <strong>$2<strong> ».

Elle devrait être dans l’espace de noms « <strong>$3<strong> ».',
	'gwtoolset-no-xml-element-found' => 'Aucun élément XML trouvé pour la correspondance.
* Avez-vous saisi une valeur dans le formulaire pour « {{int:gwtoolset-record-element-name}} » ?
* Le fichier XML est-il bien formé ? Essayez ce [$1 validateur XML].
$2',
	'gwtoolset-page-title-contains-url' => 'La page « $1 » contient l’URL complète du wiki. Assurez-vous de n’entrer que le titre de la page, par ex. la partie de l’URL après /wiki/',
	'gwtoolset-record-element-name' => 'Quel est l’élément XML qui contient chaque enregistrement de métadonnée :',
	'gwtoolset-step-1-heading' => 'Étape 1 : Détection des métadonnées',
	'gwtoolset-step-1-instructions-1' => 'Le processus de téléchargement des métadonnées se déroule en 4 étapes différentes :',
	'gwtoolset-step-1-instructions-2' => 'Dans cette étape, {{GENDER:$1|vous importez}} un nouveau fichier de métadonnées dans le wiki. L’outil essayera d’extraire les champs de métadonnées disponibles dans le fichier, que vous ferez ensuite correspondre avec un modèle de MediaWiki dans « {{int:gwtoolset-step-2-heading}} ».',
	'gwtoolset-step-1-instructions-3' => 'Si votre domaine de fichier média n’est pas listé ci-dessous, veuillez [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment demander] que votre domaine de fichier média soit ajouté à la liste blanche. La liste blanche des domaines est une liste de domaines que Wikimédia Communs vérifie avant d’analyser les fichiers média. Si votre domaine de fichier média n’est pas dans cette liste, Wikimédia Communs ne téléchargera pas de fichiers média de ce domaine. Le meilleur exemple, pour envoyer votre demande, est un lien réel vers le fichier média.',
	'gwtoolset-step-1-instructions-3-heading' => 'Whitelist des Domaines',
	'gwtoolset-step-1-instructions-li-1' => 'Détection des métadonnées',
	'gwtoolset-step-1-instructions-li-2' => 'Correspondance des métadonnées',
	'gwtoolset-step-1-instructions-li-3' => 'Aperçu du lot',
	'gwtoolset-step-1-instructions-li-4' => 'Import du lot',
	'gwtoolset-upload-legend' => 'Téléchargez votre fichier de métadonnées.',
	'gwtoolset-which-mediawiki-template' => 'Quel modèle de MediaWiki :',
	'gwtoolset-which-metadata-mapping' => 'Quelle correspondance de métadonnées :',
	'gwtoolset-xml-error' => 'Échec au chargement du XML. Veuillez corriger les erreurs ci-dessous.',
	'gwtoolset-categories' => 'Entrer les catégories séparées par un caractère barre verticale ("|")',
	'gwtoolset-category' => 'Catégorie',
	'gwtoolset-create-mapping' => '$1 : Création de la correspondance des métadonnées pour $2.',
	'gwtoolset-example-record' => 'Exemple du contenu des enregistrements des métadonnées.',
	'gwtoolset-global-categories' => 'Catégories globales',
	'gwtoolset-global-tooltip' => 'Ces entrées de catégorie s’appliqueront globalement à tous les éléments importés.',
	'gwtoolset-maps-to' => 'Correspond à',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'L’extension du fichier ne peut pas être déterminée pour l’URL de fichier : $1',
	'gwtoolset-mapping-media-file-url-bad' => 'L’URL du fichier média n’a pas pu être évaluée. L’URL fournit le contenu d’une manière qui n’est pas encore gérée par cette extension, ou bien il y a eu un problème de Requête HTTP. L’URL fournie était « $1 ». L’erreur de Requête HTTP est « $2 ».',
	'gwtoolset-mapping-no-title' => 'La correspondance des métadonnées ne contient aucun titre, lequel est nécessaire afin de créer la page.',
	'gwtoolset-mapping-no-title-identifier' => 'La correspondance des métadonnées ne contient pas d’identifiant de titre, lequel est utilisé pour créer un titre de page unique. Assurez-vous d’avoir fait correspondre un champ de métadonnées au paramètre identifiant de titre du modèle de MédiaWiki.',
	'gwtoolset-metadata-field' => 'Champ de métadonnées',
	'gwtoolset-metadata-file' => 'Fichier de métadonnées',
	'gwtoolset-metadata-mapping-legend' => 'Faites la correspondance avec vos métadonnées',
	'gwtoolset-no-more-records' => '<strong>Plus aucun enregistrement à traiter</strong>',
	'gwtoolset-painted-by' => 'Painted by',
	'gwtoolset-partner' => 'Partenaire',
	'gwtoolset-partner-explanation' => 'Les modèles de partenaire sont intégrés dans le champ source du modèle de MédiaWiki quand ils sont fournis. Vous pouvez trouver une liste des modèles de partenaire actuels sur la page Category:Source templates ; voyez le lien ci-dessous. Une fois que vous avez trouvé le modèle de partenaire que vous voulez utiliser, placez son URL dans ce champ. Vous pouvez aussi créer un nouveau modèle de partenaire si besoin.',
	'gwtoolset-partner-template' => 'Modèle du partenaire :',
	'gwtoolset-phrasing' => 'Formulation',
	'gwtoolset-preview' => 'Prévisualiser le lot',
	'gwtoolset-process-batch' => 'Traiter le lot',
	'gwtoolset-record-count' => 'Nombre total d’enregistrements trouvée dans ce fichier de métadonnées : {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Résultats',
	'gwtoolset-step-2-heading' => 'Étape 2 : Correspondance des métadonnées',
	'gwtoolset-step-2-instructions-heading' => 'Correspondance des champs de métadonnées',
	'gwtoolset-step-2-instructions-1' => 'Ci-dessous se trouve(nt) :',
	'gwtoolset-step-2-instructions-1-li-1' => 'Une liste des champs dans le $1 de MediaWiki',
	'gwtoolset-step-2-instructions-1-li-2' => 'Champs déroulants qui représentent les champs de métadonnées trouvés dans le fichier de métadonnées.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Un enregistrement exemple pour le fichier de métadonnées.',
	'gwtoolset-step-2-instructions-2' => 'Dans cette étape, vous devez manipuler les champs de métadonnées avec les champs du modèle MediaWiki.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Sélectionner un champ de métadonnées dans la colonne « {{int:gwtoolset-maps-to}} » qui correspond avec un champ du modèle de MediaWiki dans la colonne « {{int:gwtoolset-template-field}} ».',
	'gwtoolset-step-2-instructions-2-li-2' => "Il n'est pas nécessaire de remplir tous les champs des modèles de MediaWiki.",
	'gwtoolset-reupload-media' => 'Recharger le fichier média depuis l’URL',
	'gwtoolset-reupload-media-explanation' => 'Cette case à cocher vous permet de recharger le fichier média pour un élément qui a déjà été chargé sur le wiki. Si l’élément existe déjà, un fichier média supplémentaire sera ajouté au wiki. Si le fichier média n’existe pas encore, il sera téléchargé, que cette case soit cochée ou non.',
	'gwtoolset-specific-categories' => 'Catégories spécifiques d’élément',
	'gwtoolset-specific-tooltip' => 'En utilisant les champs qui suivent, vous pouvez appliquer une phrase (facultative) plus un champ de métadonnées comme entrée de catégorie pour chaque élément importé, individuellement. Par exemple, si le fichier de métadonnées contient un élément pour l’artiste de chaque enregistrement, vous pouvez l’ajouter comme une entrée de catégorie pour chaque enregistrement qui prendra la valeur spécifique à chaque enregistrement. Vous pouvez aussi ajouter une phrase comme « <em>{{int:gwtoolset-painted-by}}</em> » et puis le champ de métadonnées de l’artiste, que vous rendriez par « <em>{{int:gwtoolset-painted-by}} <nom de l’artiste></em> » comme catégorie pour chaque enregistrement.',
	'gwtoolset-template-field' => 'Champ du modèle',
	'gwtoolset-step-3-instructions-heading' => 'Étape 3 : Prévisualisation du lot',
	'gwtoolset-step-3-instructions-1' => 'Voici ci-dessous les résultats du téléchargement {{PLURAL:$1|du premier enregistrement|des $1 premiers enregistrements}} depuis le fichier de métadonnées que vous avez choisi et {{PLURAL:$1|sa|leur}} correspondance avec le modèle de MédiaWiki que vous avez choisi dans « {{int:gwtoolset-step-2-heading}} ».',
	'gwtoolset-step-3-instructions-2' => 'Regardez ces pages et si les résultats correspondent à vos attentes, et qu’il y a d’autres enregistrements en attente d’import, continuez le traitement du chargement par lot en cliquant sur le bouton « {{int:gwtoolset-process-batch}} » ci-dessous.',
	'gwtoolset-step-3-instructions-3' => 'Si vous n’êtes pas satisfait des résultats, retournez à « {{int:gwtoolset-step-2-heading}} »  et corrigez la correspondance en fonction.

Si vous devez faire des ajustements au fichier de métadonnées lui-même, retournez le faire puis rechargez-le en recommençant le traitement avec « {{int:gwtoolset-step-1-heading}} ».',
	'gwtoolset-title-bad' => 'Le titre créé, d’après les métadonnées et la correspondance du modèle de MédiaWiki, n’est pas valide.

Essayez un autre champ pour les métadonnées du titre et de l’identifiant du titre, ou si possible, modifiez les médatonnées quand cela est nécessaire. Voyez [https://commons.wikimedia.org/wiki/Commons:File_naming Nommage des fichiers] pour plus d’information.

<strong>Titre non valide :</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Traitement du lot de métadonnées créé. Votre fichier de métadonnées sera analysé prochainement et chaque élément sera chargé dans le wiki en tâche de fond. Vous pouvez vérifier la page « $1 » pour voir s’ils ont été importés.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Impossible de créer un traitement par lot pour le fichier de métadonnées.',
	'gwtoolset-create-mediafile' => '$1 : Création du fichier de média pour $2 en cours.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => '$1 {{PLURAL:$1|traitement par lot de fichier média créé|traitements par lot de fichier média créés}}.',
	'gwtoolset-step-4-heading' => 'Étape 4 : Téléversement du lot',
	'gwtoolset-invalid-token' => 'Le jeton de modification soumis avec le formulaire n’est pas valide.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Paramètres actuels de <code>php.ini</code> :

* <code>upload_max_filesize</code> : $1
* <code>post_max_size</code> : $2

Ils sont positionnés inférieurs au paramètre <code>$wgMaxUploadSize</code> du wiki, qui est fixé à « $3 ». Veuillez ajuster les paramètres de <code>php.ini</code> de façon appropriée.',
	'gwtoolset-mediawiki-version-invalid' => 'Cette extension nécessite la version $1 de MediaWiki<br />La version de ce MediaWiki est $2.',
	'gwtoolset-permission-not-given' => 'Assurez-vous que vous êtes connecté ou contactez un administrateur afin d’obtenir le droit de voir cette page ($1).',
	'gwtoolset-user-blocked' => 'Votre compte utilisateur est actuellement bloqué. Veuillez contacter un administrateur afin de corriger le problème de blocage.',
	'gwtoolset-required-group' => 'Vous n’êtes pas membre du groupe utilisateur « $1 ».',
	'gwtoolset-verify-api-enabled' => 'L’extension $1 nécessite que l’API du wiki soit activée.

Assurez-vous que <code>$wgEnableAPI</code> est positionné à <code>true</code> dans le fichier <code>DefaultSettings.php</code> ou est surchargé à <code>true</code> dans le fichier <code>LocalSettings.php</code>.',
	'gwtoolset-verify-api-writeable' => "L'extension \$1 nécessite que l'API wiki ait accès aux droits d'écriture pour les utilisateurs autorisés.

Vérifiez que le paramètre <code>\$wgEnableWriteAPI</code> soit défini à <code>true</code> dans le fichier <code>DefaultSettings.php</code> et dans le fichier <code>LocalSettings.php</code>.",
	'gwtoolset-verify-curl' => "L'extension $1 requiert l'installation des [http://www.php.net/manual/fr/curl.setup.php fonctions PHP cURL].",
	'gwtoolset-verify-finfo' => "L'extension $1 requiert l'installation de l'extension PHP [http://www.php.net/manual/fr/fileinfo.setup.php Finfo]",
	'gwtoolset-verify-php-version' => 'L’extension $1 nécessite PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'L’extension $1 nécessite que les imports de fichier soient activés.

Assurez-vous que <code>$wgEnableUploads</code> est défini à <code>true</code> dans <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'L’extension $1 nécessite que [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] de PHP soit installé.',
	'gwtoolset-wiki-checks-not-passed' => 'Les vérifications du Wiki n’ont pas été franchies.',
);

/** Western Frisian (Frysk)
 * @author Kening Aldgilles
 */
$messages['fy'] = array(
	'gwtoolset-cancel' => 'Ofbrekke',
	'gwtoolset-loading' => 'In amerijke. It kin in skoft duorje.',
	'gwtoolset-save' => 'Fêstlizze',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author AvrahamKatz
 * @author Danny-w
 * @author Guycn2
 * @author NLIGuy
 * @author YaronSh
 * @author Yona b
 * @author דולב
 */
$messages['he'] = array(
	'gwtoolset' => 'ארגז כלי גלאם־ויקי',
	'gwtoolset-desc' => 'ארגז כלי גלאם-ויקי, כלי להעלאה המונית לוויקישיתוף בשביל מוסדות GLAM (ספריות, ארכיונים, מוזיאונים, גלריות)',
	'gwtoolset-intro' => 'ארגז כלי גלאם־ויקי היא הרחבה של MediaWiki שנותנת למוסדות גלאם (גלריות, ספריות, ארכיונים ומוזיאונים) את האפשרות להעלות חומר רב המבוסס על קובץ XML המכיל מטא־נתונים מתאימים לגבי החומר. הכוונה היא לאפשר למגוון של סכֵמות XML. אפשר למצוא מידע נוסף לגבי המיזם ב[https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project עמוד המיזם]. הרגישו חופשיים ליצור אתנו קשר גם בעמוד זה. יש לבחור אחד מפריטי התפריטים מעל כדי להתחיל את תהליך.',
	'right-gwtoolset' => 'שימוש בארגז כלי גלאם־ויקי',
	'action-gwtoolset' => 'להשתמש בארגז כלי גלאם־ויקי',
	'group-gwtoolset' => 'משתמשי ארגז כלי גלאם-ויקי',
	'group-gwtoolset-member' => '{{GENDER:$1|משתמש|משתמשת}} ארגז כלי גלאם־ויקי',
	'grouppage-gwtoolset' => '{{ns:project}}:משתמשי ערכת כלי גלאם־ויקי',
	'gwtoolset-batchjob-creation-failure' => 'לא הייתה אפשרות ליצור משימת אצווה מסוג "$1".',
	'gwtoolset-could-not-close-xml' => 'לא יכול לסגור את קורא ה־XML.',
	'gwtoolset-could-not-open-xml' => 'לא ניתן לפתוח את קובץ ה־XML לקריאה.',
	'gwtoolset-developer-issue' => 'נא ליצור קשר עם מפתח. יש להתייחס לבעיה הזאת לפני שאפשר יהיה להמשיך. נא להוסיף את הטקסט הבא לדיווח שלכם:

$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, או <code>record-count</code>, או <code>record-current</code> לא סופקו.',
	'gwtoolset-file-backend-maxage-invalid' => 'ערך הגיל המרבי הנתון ב<code>$wgGWTFBMaxAge</code> אינו תקין. עיין ב־ [php.net/manual/en/datetime.formats.relative.php PHP manual] כדי להגדירו בצורה נכונה.',
	'gwtoolset-fsfile-empty' => 'הקובץ היה ריק ולכן נמחק.',
	'gwtoolset-fsfile-retrieval-failure' => 'לא הייתה אפשרות לאחזר את הקובץ מ־URL‏ $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> לא הוגדר.',
	'gwtoolset-incorrect-form-handler' => 'המודול "$1" לא רשם מטפל טפסים (form handler) שמרחיב את GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'מחסום המשימות (batch job throttle) הגיע לסף.',
	'gwtoolset-no-accepted-types' => 'לא סופקו טיפוסים מקובלים.',
	'gwtoolset-no-callback' => 'לא הועברה פונקציית קריאה לאחור (callback) לשיטה זו.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> לא הוגדר.",
	'gwtoolset-no-default' => 'לא סופק ערך התחלתי.',
	'gwtoolset-no-field-size' => 'לא צוין גודל שדה עבור שדה "$1".',
	'gwtoolset-no-file-backend-name' => 'לא סופק שם לשרת קבצים (file backend).',
	'gwtoolset-no-file-backend-container' => 'לא סופק שם מכל לשרת קבצים (file backend container name).',
	'gwtoolset-no-file-url' => 'לא סופק <code>file_url</code> לפענוח.',
	'gwtoolset-no-form-handler' => 'לא נוצר מטפל טפסים (form handler).',
	'gwtoolset-no-mapping' => 'לא סופק <code>mapping_name</code>.',
	'gwtoolset-no-mapping-json' => 'לא סופק <code>mapping_json</code>.',
	'gwtoolset-no-max' => 'לא סופק ערך מרבי.',
	'gwtoolset-no-mediafile-throttle' => 'לא סופק מחסום למשימות קובצי מדיה.',
	'gwtoolset-no-mediawiki-template' => 'לא סופק <code>mediawiki-template-name</code>.',
	'gwtoolset-no-min' => 'לא סופק ערך מינימלי.',
	'gwtoolset-no-module' => 'שם המודול לא צוין.',
	'gwtoolset-no-mwstore-complete-path' => 'לא סופק נתיב מלא לקובץ.',
	'gwtoolset-no-mwstore-relative-path' => 'לא צוין נתיב יחסי.',
	'gwtoolset-no-page-title' => 'לא סופקה כותרת לדף.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> לא הוגדר.",
	'gwtoolset-no-source-array' => 'לא סופק מערך מקור.',
	'gwtoolset-no-summary' => 'לא סופק תקציר.',
	'gwtoolset-no-template-url' => 'לא סופקה תבנית קישור לפענוח.',
	'gwtoolset-no-text' => 'לא הוכנס טקסט.',
	'gwtoolset-no-title' => 'לא ניתנה כותרת.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> לא הוגדר.",
	'gwtoolset-no-url-to-evaluate' => 'לא סופק URL לצורך הערכה.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> לא הוגדר.',
	'gwtoolset-no-user' => 'לא סופק אובייקט משתמש.',
	'gwtoolset-no-xml-element' => 'לא סופק XMLReader או DOMElement.',
	'gwtoolset-no-xml-source' => 'לא סופק מקור XML מקומי.',
	'gwtoolset-not-string' => 'הערך שסופק למתודה לא היה מחרוזת. הוא מסוג "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 אינו תואם.',
	'gwtoolset-disk-write-failure' => 'השרת לא הצליח לכתוב את הקובץ אל מערכת קבצים.',
	'gwtoolset-xml-doctype' => 'קובץ ה־XML לא יכול להכיל מקטע <!DOCTYPE>. יש להסיר אותו ולאחר מכן לנסות שוב להעלות קובץ מטא־נתונים XML .',
	'gwtoolset-file-is-empty' => 'הקובץ שהועלה ריק.',
	'gwtoolset-improper-upload' => 'הקובץ לא הועלה כראוי.',
	'gwtoolset-mime-type-mismatch' => 'סיומת הקובץ "$1" וסוג הקובץ (MIME type‏) "$2" של הקובץ שהועלה אינם תואמים.',
	'gwtoolset-missing-temp-folder' => 'אין תיקייה זמנית זמינה.',
	'gwtoolset-multiple-files' => 'הקובץ שהועלה מכיל מידע לגבי יותר מקובץ אחד. רק קובץ אחד יכול להתקבל בכל פעם.',
	'gwtoolset-no-extension' => 'הקובץ שהועלה לא מכיל מספיק מידע כדי לעבדו. ככל הנראה לקובץ אין כל סיומת.',
	'gwtoolset-no-file' => 'לא התקבל שום קובץ.',
	'gwtoolset-no-form-field' => 'שדה הטופס "$1" אינו קיים.',
	'gwtoolset-over-max-ini' => 'הקובץ שהועלה חורג <code>upload_max_filesize</code> או את הנחיית <code>post_max_size</code> ב־<code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'הקובץ הועלה חלקית.',
	'gwtoolset-php-extension-error' => 'הרחבת PHP עצרה את העלאת קובץ. PHP אינה מספקת דרך לברר איזו הרחבה גרמה להעלאת קובץ לעצור. בחינת רשימת סיומות טעונות עם <code dir="ltr">phpinfo()</code> עשויה לעזור.',
	'gwtoolset-unaccepted-extension' => 'קובץ המקור אינו מכיל סיומת קבילה.',
	'gwtoolset-unaccepted-extension-specific' => 'קובץ המקור מכיל סיומת קובץ בלתי־קבילה "$1".',
	'gwtoolset-unaccepted-mime-type' => 'הקובץ שהועלה זוהה כבעל סוג (MIME type)‏ "$1", שאינו אחד מהסוגים המקובלים.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'הקובץ שהועלה הוא מסוג (MIME type)‏ "$1", שאינו קביל. האם קובץ ה־XML מכיל הכרזת XML בחלק העליון של הקובץ?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '→ חזרה לטופס',
	'gwtoolset-back-text' => 'נא ללחוץ על כפתור "חזרה" של הדפדפן כדי לחזור לטופס.',
	'gwtoolset-file-interpretation-error' => 'אירעה בעיה בעיבוד קובץ המטא־נתונים',
	'gwtoolset-mediawiki-template' => 'תבנית $1',
	'gwtoolset-metadata-user-options-error' => 'נדרש למלא את {{PLURAL:$2|שדה הטופס הבא|שדות הטופס הבאים}}:
$1',
	'gwtoolset-metadata-invalid-template' => 'לא נמצאה תבנית מדיה־ויקי תקינה.',
	'gwtoolset-menu-1' => 'מיפוי המטא־נתונים',
	'gwtoolset-technical-error' => 'אירעה שגיאה טכנית.',
	'gwtoolset-required-field' => 'מציינת שדה חובה',
	'gwtoolset-submit' => 'שליחה',
	'gwtoolset-summary-heading' => 'תקציר',
	'gwtoolset-cancel' => 'ביטול',
	'gwtoolset-loading' => 'נא להתאזר בסבלנות. זה עלול לקחת זמן־מה.',
	'gwtoolset-save' => 'שמירה',
	'gwtoolset-save-mapping' => 'שמירת מיפוי',
	'gwtoolset-save-mapping-failed' => 'מצטערים. אירעה תקלה בעת עיבוד הבקשה שלך. נא לנסות שוב מאוחר יותר. (הודעת שגיאה: $1)',
	'gwtoolset-save-mapping-succeeded' => 'המיפוי שלך נשמר.',
	'gwtoolset-save-mapping-name' => 'איך ברצונך לקרוא למיפוי זה?',
	'gwtoolset-json-error' => 'אירעה בעיה עם ה־JSON. שגיאה: $1',
	'gwtoolset-json-error-depth' => 'ישנה חריגה מעומק הערימה (stack) המרבי.',
	'gwtoolset-json-error-state-mismatch' => 'בעיית underflow או אי־התאמה של מצבים.',
	'gwtoolset-json-error-ctrl-char' => 'נמצא תו בקרה בלתי־צפוי.',
	'gwtoolset-json-error-syntax' => 'שגיאת תחביר, JSON פגום.',
	'gwtoolset-json-error-utf8' => 'תווי UTF-8 פגומים, כנראה קידוד שגוי.',
	'gwtoolset-json-error-unknown' => 'שגיאה לא ידועה.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|סוג קובץ מורשה|סוגי קובץ מורשים}}:',
	'gwtoolset-ensure-well-formed-xml' => 'יש לוודא כי קובץ ה־XML בנוי נכון עם ה־$1 הזה.',
	'gwtoolset-file-url-invalid' => 'הכתובת של הקובץ אינה חוקית; הקובץ אינו קיים עדיין בוויקי. יש להעלות את הקובץ תחילה מהמחשב שלך אם ברצונך להשתמש בכתובת הקובץ בטופס.',
	'gwtoolset-mediafile-throttle' => 'מצערת Mediafile:',
	'gwtoolset-mediafile-throttle-description' => "לאחר התצוגה המקדימה של אצווה, בצעד מס' 3, GWToolset מעלה את הרשומות הנותרות בהעלאה אצווה בתהליך שרץ ברקע. מצערת קבצי המדיה (mediafile throttle) שולטת במספר הבקשות לקובצי מדיה שוויקישיתוף יעשה מול שרת קובצי המדיה בכל פעם שתהליך רץ ברקע. באפשרותך להגדיר את מצערת קובצי המדיה לערך שבין 1–20. לדוגמה, אם המספר הכולל של רשומות בהעלאת אצווה הוא 100 ומוגדרת מצערת של 20, ויקישיתוף יריץ 5 משימות ברקע כדי לעבד את כל אצוות ההעלאה שלך. הזמן בין כל משימת העלאה ברקע משתנה בהתאם עומס בשרת וההגדרות שלו; אנו צופים כי בוויקישיתוף, משימת GWToolset תופעל ברקע מדי 5 דקות לפחות.",
	'gwtoolset-mediawiki-template-does-not-exist' => 'תבנית מדיה־ויקי "<strong>$1</strong>" אינה קיימת בוויקי.

צריך או לייבא את התבנית או לבחור תבנית ויקי אחרת לשימוש עבור המיפוי.',
	'gwtoolset-mediawiki-template-not-found' => 'תבנית מדיה־ויקי "$1" לא נמצאה.',
	'gwtoolset-metadata-file-source' => 'נא לציין את מקור קובץ המטא־נתונים.',
	'gwtoolset-metadata-file-source-info' => '... או קובץ שהועלה כבר או קובץ שברצונך להעלות מהמחשב שלך.',
	'gwtoolset-metadata-file-url' => 'כתובת URL של קובץ המטא־נתונים.',
	'gwtoolset-metadata-file-upload' => 'העלאת קובץ מטא־נתונים:',
	'gwtoolset-metadata-mapping-bad' => 'קיימת בעיה עם מיפוי המטא־נתונים. קרוב לוודאי שתבנית ה־JSON אינה תקינה. נא לנסות לתקן את הבעיה ולאחר מכן לשלוח את הטופס שוב.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'כתובת מיפוי המטא־נתונים שניתנה אינה תואמת לנתיב המיפוי המצופה.

* הכתובת שניתנה: $1
* הכתובת המצופה: $2',
	'gwtoolset-metadata-mapping-not-found' => 'לא נמצא מיפוי מטא־נתונים.

הדף "<strong>$1<strong>" לא נמצא בוויקי.',
	'gwtoolset-namespace-mismatch' => 'הדף "<strong>$1<strong>" נמצא במרחב השם השגוי "<strong>$2<strong>".

הדף צריך להיות במרחב השם "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'לא נמצא אלמנט XML למיפוי.
* האם הזנת ערך בטופס עבור "{{int:gwtoolset-record-element-name}}"?
* האם ה־XML תקין? נא לנסות את [$1 בודק ה־XML] הזה.
$2',
	'gwtoolset-page-title-contains-url' => 'הדף $1 מכיל את כל כתובת ה־URL. יש להקפיד להזין רק את כותרת הדף, למשל את החלק של ה־URL שאחרי /wiki/',
	'gwtoolset-record-element-name' => 'מהו רכיב ה־XML המכיל כל רשומת מטא־נתונים:',
	'gwtoolset-step-1-heading' => 'צעד 1: זיהוי המטא־נתונים',
	'gwtoolset-step-1-instructions-1' => 'תהליך העלאת המטה-נתונים כולל 4 צעדים:',
	'gwtoolset-step-1-instructions-2' => 'בצעד הזה {{GENDER:$1|אתה|את}} מעלה קובץ מטא־נתונים חדש לוויקי. הכלי הזה ינסה למפות את שדות המטא־נתונים בקובץ המטא־נתונים, שלאחר מכן {{GENDER:$1|תמפה|תמפי}} לתבנית מדיה־ויקי בצעד "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3-heading' => 'רשימה לבנה של מתחמים',
	'gwtoolset-step-1-instructions-li-1' => 'זיהוי המטא־נתונים',
	'gwtoolset-step-1-instructions-li-2' => 'מיפוי המטא־נתונים',
	'gwtoolset-step-1-instructions-li-3' => 'תצוגה מקדימה של אצווה',
	'gwtoolset-step-1-instructions-li-4' => 'העלאת אצווה',
	'gwtoolset-upload-legend' => 'העלאת קובץ המטא־נתונים שלך',
	'gwtoolset-which-mediawiki-template' => 'איזו תבנית מדיה־ויקי:',
	'gwtoolset-which-metadata-mapping' => 'איזה מיפוי מטא־נתונים:',
	'gwtoolset-xml-error' => 'טעינת ה־XML נכשלה. נא לתקן את השגיאות הבאות.',
	'gwtoolset-categories' => 'נא להזין קטגוריות מופרדות בתו "|"',
	'gwtoolset-category' => 'קטגוריה',
	'gwtoolset-create-mapping' => '$1: יצירת מיפוי מטא־נתונים עבור $2.',
	'gwtoolset-example-record' => 'תכולת הרשומה לדוגמה של המטא־נתונים.',
	'gwtoolset-global-categories' => 'קטגוריות גלובליות',
	'gwtoolset-global-tooltip' => 'עיולי הקטגוריות האלה יחולו גלובלית לכל הפריטים המוּעלים.',
	'gwtoolset-maps-to' => 'ממפה ל...',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'לא ניתן היה לזהות את סיומת הקובץ מהכתובת לקובץ: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'לא היה ניתן לחשב את כתובת קובץ המדיה. הכתובת מעבירה את התוכן בצורה שלא נתמכת עדיין על־ידי הסיומת הזאת או שהייתה בעיה בבקשת ה־HTTP. הכתובת שניתנה היא "$1". שגיאת בקשת ה־HTTP היא "$2"',
	'gwtoolset-mapping-no-title' => 'מיפוי המטא-נתונים אינו מכיל כותרת, אשר נחוצה כדי ליצור את העמוד.',
	'gwtoolset-mapping-no-title-identifier' => 'מיפוי המטא־נתונים אינו מכיל מזהה כותרת, אשר משמש ליצירת כותרת עמוד ייחודית. נא לוודא שמיפיתם את שדה המטא־נתונים לפרמטר מזהה הכותר התבנית של מדיה־ויקי.',
	'gwtoolset-metadata-field' => 'שדה מטא־נתונים',
	'gwtoolset-metadata-file' => 'קובץ מטא־נתונים',
	'gwtoolset-metadata-mapping-legend' => 'מיפוי המטא־נתונים שלך',
	'gwtoolset-no-more-records' => '<strong>אין עוד רשומות לעיבוד</strong>',
	'gwtoolset-painted-by' => 'צויר על־ידי',
	'gwtoolset-partner' => 'שותף',
	'gwtoolset-partner-explanation' => 'תבניות השותפים נמשכות לשדה המקור של תבנית המדיה־ויקי כאשר הן מסופקות. ניתן למצוא רשימה של תבניות שותפים נוכחיות בקטגוריה Source templates page; ראה קישור להלן. ברגע שמצאת את תבנית השותף שברצונך להשתמש בה, שים את הכתובת בשדה הזה. ניתן גם ליצור תבנית שותף חדשה אם נחוץ.',
	'gwtoolset-partner-template' => 'תבנית שותף:',
	'gwtoolset-phrasing' => 'ניסוח',
	'gwtoolset-preview' => 'תצוגה מקדימה של אצווה',
	'gwtoolset-process-batch' => 'אצוות תהליך',
	'gwtoolset-record-count' => 'מספר כולל של רשומות שנמצאו בקובץ המטא-נתונים: {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'תוצאות',
	'gwtoolset-step-2-heading' => 'צעד 2: מיפוי מטא־נתונים',
	'gwtoolset-step-2-instructions-heading' => 'מיפוי שדות המטא־נתונים',
	'gwtoolset-step-2-instructions-1' => 'להלן הוא/הם:',
	'gwtoolset-step-2-instructions-1-li-1' => 'רשימת השדות במדיה־ויקי $1.',
	'gwtoolset-step-2-instructions-1-li-3' => 'רשומה לדוגמה מתוך קובץ המטא־נתונים.',
	'gwtoolset-step-2-instructions-2-li-2' => 'אין צורך לספר התאמה לכל שדה של תבנית מדיה־ויקי.',
	'gwtoolset-reupload-media' => 'העלאה מחדש של מדיה מ־URL',
	'gwtoolset-reupload-media-explanation' => 'תיבת הסימון הזאת נותנת לך להעלות מחדש מדיה עבור פריט שכבר הועלה לוויקי. אם הפריט קיים כבר, קובץ מדיה חדש יתווסף לוןויקי. אם קובץ המדיה עוד לא קיים, הוא יועלה אם התיבה מסומנת ואם לאו.',
	'gwtoolset-specific-categories' => 'קטגוריה ייחודיות לפריט',
	'gwtoolset-template-field' => 'שדה תבנית',
	'gwtoolset-step-3-instructions-heading' => 'צעד 3: תצוגה מקדימה של אצווה',
	'gwtoolset-step-3-instructions-3' => 'אם אינך שבע רצון מהתוצאות, חזור ל"{{int:gwtoolset-step-2-heading}}" והתאם את המיפוי לפי הצורך.

אם עליך לבצע שינויים בקובץ מטה-נתונים עצמו, כנס לקובץ ובצע את השינויים, לאחר מכן העלה אותו מחדש על-ידי תחילת התהליך מחדש מ"{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => "הכותרת, שנוצרה על סמך המטא־נתונים ומיפוי תבנית מדיה־ויקי, אינה תקינה.

יש לנסות שדה אחר מהמטא־נתונים עבור כותרת ומזהה־כותרת, או אם אפשר, לשנות את המטא־נתונים היכן שצריך. ר' [https://commons.wikimedia.org/wiki/Commons:File_naming מדריך למתן שמות לקבצים] לקבלת מידע נוסף.

<strong>כותרת בלתי־תקינה:</strong> $1.",
	'gwtoolset-batchjob-metadata-creation-failure' => 'לא היה ניתן ליצור משימת אצווה לקובץ המטא־נתונים.',
	'gwtoolset-create-mediafile' => '$1: יצירת קובץ מדיה עבור $2.',
	'gwtoolset-create-prefix' => 'ארגז כלי גלאם־ויקי',
	'gwtoolset-step-4-heading' => 'צעד 4: ההעלאת אצווה',
	'gwtoolset-invalid-token' => 'אסימון העריכה שנשלח עם הטופס אינו תקין.',
	'gwtoolset-mediawiki-version-invalid' => 'ההרחבה הזאת דורשת שימוש במדיה־ויקי $1<br />
הגרסה של מדיה־ויקי כאן היא $2.',
	'gwtoolset-permission-not-given' => 'נא לוודא שנכנסת לחשבון או לפנות למפעיל כדי לקבל הרשאה להציג דף זה ($1).',
	'gwtoolset-user-blocked' => 'חשבון המשתמש שלך חסום כרגע. נא ליצור קשר עם מפעיל כדי לתקן את זה.',
	'gwtoolset-required-group' => 'חשבונך אינו חלק מהקבוצה $1.',
	'gwtoolset-verify-curl' => 'ההרחבה $1 דורשת ש[http://www.php.net/manual/en/curl.setup.php פונקציות cURL] של PHP יהיו מותקנות.',
	'gwtoolset-verify-finfo' => 'ההרחבה $1 דורשת שההרחבה [http://www.php.net/manual/en/fileinfo.setup.php finfo] ל PHP תהיה מותקנת.',
	'gwtoolset-verify-php-version' => 'ההרחבה $1 דורשת PHP בגרסה 5.3.3 לפחות.',
	'gwtoolset-verify-xmlreader' => 'הרחבת $1 דורשת ש־PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] יהיה מותקן',
	'gwtoolset-wiki-checks-not-passed' => 'בדיקות הוויקי נכשלו',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, uno strumento di caricamento massivo per GLAM',
	'right-gwtoolset' => 'Usa GWToolset',
	'action-gwtoolset' => 'usare GWToolset',
	'group-gwtoolset' => 'Utenti GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|utente GWToolset}}',
	'grouppage-gwtoolset' => '{{ns:project}}:Utenti GWToolset',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, o <code>record-count</code>, o <code>record-current</code> non fornito.',
	'gwtoolset-fsfile-empty' => 'Il file era vuoto ed è stato cancellato.',
	'gwtoolset-fsfile-retrieval-failure' => "Il file non può essere recuperato dall'URL $1.",
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> non impostato.',
	'gwtoolset-no-accepted-types' => 'Nessun tipo accettato fornito',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> non impostato.",
	'gwtoolset-no-default' => 'Nessun valore predefinito fornito.',
	'gwtoolset-no-field-size' => 'Nessuna dimensione specificata per il campo "$1".',
	'gwtoolset-no-file-backend-name' => 'Nessun nome file backend fornito.',
	'gwtoolset-no-file-backend-container' => 'Nessun nome contenitore file backend fornito.',
	'gwtoolset-no-file-url' => 'Nessun <code>file_url</code> fornito da analizzare.',
	'gwtoolset-no-form-handler' => 'Nessun gestore del modulo creato.',
	'gwtoolset-no-mapping' => 'Nessun <code>mapping_name</code> fornito.',
	'gwtoolset-no-mapping-json' => 'Nessun <code>mapping_json</code> fornito.',
	'gwtoolset-no-max' => 'Nessun valore massimo fornito.',
	'gwtoolset-no-mediawiki-template' => 'Nessun <code>mediawiki-template-name</code> fornito.',
	'gwtoolset-no-min' => 'Nessuna valore minimo fornito.',
	'gwtoolset-no-module' => 'Nessun nome del modulo è stato specificato.',
	'gwtoolset-no-mwstore-complete-path' => 'Nessun percorso completo del file fornito.',
	'gwtoolset-no-mwstore-relative-path' => 'Nessun percorso relativo fornito.',
	'gwtoolset-no-page-title' => 'Nessun titolo pagina fornito.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> non impostato.",
	'gwtoolset-no-summary' => 'Nessun oggetto fornito.',
	'gwtoolset-no-template-url' => 'Nessun URL template fornito da analizzare.',
	'gwtoolset-no-text' => 'Nessun testo fornito.',
	'gwtoolset-no-title' => 'Nessun titolo fornito.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> non impostato.",
	'gwtoolset-no-url-to-evaluate' => 'Nessun URL fornito per la valutazione.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> non impostato.',
	'gwtoolset-no-user' => 'Nessun oggetto utente fornito.',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 non corrisponde.',
	'gwtoolset-file-is-empty' => 'Il file caricato è vuoto.',
	'gwtoolset-improper-upload' => 'Il file non è stato caricato correttamente.',
	'gwtoolset-missing-temp-folder' => 'Nessuna cartella temporanea disponibile.',
	'gwtoolset-no-file' => 'Nessun file è stato ricevuto.',
	'gwtoolset-partial-upload' => 'Il file è stato caricato solo parzialmente.',
	'gwtoolset-back-text-link' => '← torna al modulo',
	'gwtoolset-back-text' => 'Premere il pulsante indietro del browser per tornare al modulo.',
	'gwtoolset-mediawiki-template' => 'Template $1',
	'gwtoolset-metadata-invalid-template' => 'Non è stato trovato alcun template MediaWiki valido.',
	'gwtoolset-technical-error' => "C'è stato un errore tecnico.",
	'gwtoolset-required-field' => 'indica un campo obbligatorio',
	'gwtoolset-submit' => 'Invia',
	'gwtoolset-cancel' => 'Annulla',
	'gwtoolset-save' => 'Salva',
	'gwtoolset-json-error-unknown' => 'Errore sconosciuto.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Tipo|Tipi}} di file {{PLURAL:$1|accettato|accettati}}:',
	'gwtoolset-mediawiki-template-not-found' => 'Template MediaWiki "$1" non trovato.',
	'gwtoolset-category' => 'Categoria',
	'gwtoolset-global-categories' => 'Categorie globali',
	'gwtoolset-painted-by' => 'Dipinto da',
	'gwtoolset-results' => 'Risultati',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-invalid-token' => 'Il token di modifica inviato con il modulo non è valido.',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset - GLAM 用の一括アップロード ツール',
	'gwtoolset-intro' => 'GWToolset は、GLAM (美術館、図書館、記録保管所、博物館) がコンテンツを一括アップロードできるようにする MediaWiki 拡張機能です。この一括アップロードは、コンテンツそれぞれについてのメタデータを含む XML ファイルに基づいて行われます。さまざまな XML スキーマに対応することを意図しています。プロジェクトについての詳細情報は、[https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project プロジェクト ページ]にあります。そちらのページでもご遠慮なくお問い合わせください。アップロード作業を開始するには、上のメニュー項目から 1 つ選択してください。',
	'right-gwtoolset' => 'GWToolsetを使用',
	'action-gwtoolset' => 'GWToolsetの使用',
	'group-gwtoolset' => 'GWToolset 利用者',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset 利用者}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset 利用者',
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
	'gwtoolset-no-accepted-types' => '対応するファイル形式が指定されていません',
	'gwtoolset-no-callback' => 'このメソッドにコールバックが渡されませんでした。',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> が設定されていません。",
	'gwtoolset-no-default' => '既定値を指定していません。',
	'gwtoolset-no-field-size' => 'フィールド「$1」のサイズを指定していません。',
	'gwtoolset-no-file-backend-name' => 'ファイル バックエンド名を指定していません。',
	'gwtoolset-no-file-backend-container' => 'ファイル バックエンド コンテナー名を指定していません。',
	'gwtoolset-no-file-url' => '構文解析する <code>file_url</code> を指定していません。',
	'gwtoolset-no-form-handler' => 'フォーム ハンドラーを作成していません。',
	'gwtoolset-no-mapping' => '<code>mapping_name</code> を指定していません。',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code> を指定していません。',
	'gwtoolset-no-max' => '最大値を指定していません。',
	'gwtoolset-no-mediafile-throttle' => 'メディアファイルのジョブのしきい値を指定していません。',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name<</code> を指定していません。',
	'gwtoolset-no-min' => '最小値を指定していません。',
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
	'gwtoolset-not-string' => 'メソッドに渡した値は文字列ではありませんでした。渡した値の型は「$1」です。',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 が一致しません。',
	'gwtoolset-disk-write-failure' => 'サーバーは、ファイルをファイル システムに書き込めませんでした。',
	'gwtoolset-xml-doctype' => 'XML メタデータ ファイルには <!DOCTYPE> セクションを含めてはいけません。それを除去してから、XML メタデータ ファイルをもう一度アップロードしてください。',
	'gwtoolset-file-is-empty' => 'アップロードされたファイルは空です。',
	'gwtoolset-improper-upload' => 'ファイルを適切にはアップロードできませんでした。',
	'gwtoolset-mime-type-mismatch' => 'アップロードしたファイルの拡張子「$1」と MIME タイプ「$2」が一致しません。',
	'gwtoolset-missing-temp-folder' => '一時フォルダーを利用できません。',
	'gwtoolset-multiple-files' => 'アップロードしたファイルは複数のファイルの情報を含んでいます。1 回の操作で送信できるのは 1 つのファイルのみです。',
	'gwtoolset-no-extension' => 'アップロードしたファイルには、そのファイルを処理するのに十分な情報がありません。おそらく、ファイルの拡張子がありません。',
	'gwtoolset-no-file' => 'ファイルを受信できませんでした。',
	'gwtoolset-no-form-field' => '予期したフォーム フィールド「$1」が存在しません。',
	'gwtoolset-over-max-ini' => 'アップロードしたファイルのサイズが、<code>php.ini</code> 内の <code>upload_max_filesize</code> ディレクティブおよび <code>post_max_size</code> ディレクティブの両方または一方で指定した上限を超えています。',
	'gwtoolset-partial-upload' => 'ファイルは一部のみがアップロードされました。',
	'gwtoolset-php-extension-error' => 'PHP の拡張モジュールのいずれかがファイルのアップロードを停止させました。PHP は、どの拡張モジュールがファイルのアップロードを停止させたかを究明する手段を提供しません。読み込まれた拡張モジュールの一覧を <code>phpinfo()</code> で調べると見つかる場合があります。',
	'gwtoolset-unaccepted-extension' => 'ファイル ソースの拡張子が、対応しているファイル形式のものではありません。',
	'gwtoolset-unaccepted-extension-specific' => 'ファイル ソースの拡張子「.$1」のファイル形式には対応していません。',
	'gwtoolset-unaccepted-mime-type' => 'アップロードしたファイルの形式は、対応していない MIME タイプ「$1」と判定されました。',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'アップロードしたファイルの形式は、対応していない MIME タイプ「$1」です。アップロードした XML ファイルの先頭に XML 宣言があることを確認してください。

&lt;?xml version="1.0" encoding="UTF-8"?>',
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
	'gwtoolset-save-mapping-failed' => '申し訳ありません。リクエストを処理する際に問題点が発生しました。しばらくしてからもう一度お試しください。(エラー メッセージ: $1)',
	'gwtoolset-save-mapping-succeeded' => 'マッピングを保存しました。',
	'gwtoolset-save-mapping-name' => 'このマッピングに付ける名前を入力',
	'gwtoolset-json-error' => 'JSON に問題点がありました。エラー: $1',
	'gwtoolset-json-error-depth' => 'スタックの深さが最大値を超えました。',
	'gwtoolset-json-error-ctrl-char' => '予期しない制御文字が見つかりました。',
	'gwtoolset-json-error-syntax' => '構文エラーです。JSON が破損しています。',
	'gwtoolset-json-error-utf8' => 'UTF-8 の文字が破損しています。エンコーディングが誤っているおそれがあります。',
	'gwtoolset-json-error-unknown' => '不明なエラーです。',
	'gwtoolset-accepted-file-types' => '対応しているファイル{{PLURAL:$1|形式}}:',
	'gwtoolset-ensure-well-formed-xml' => 'こちらの $1 で、XML ファイルが整形式であることを確認してください。',
	'gwtoolset-file-url-invalid' => 'ファイル URL が無効です。ファイルがウィキ内にまだ存在しません。フォームでファイル URL 参照を使用したい場合は、まず、あなたのコンピューターからファイルをアップロードする必要があります。',
	'gwtoolset-mediafile-throttle' => 'メディアファイルのしきい値:',
	'gwtoolset-mediafile-throttle-description' => 'The throttle controls the load Wikimedia Commons will put on your media server during the batch upload. 1 分あたりのメディア リクエスト回数として 1 から 20 までの値を設定できます。', # Fuzzy
	'gwtoolset-mediawiki-template-does-not-exist' => 'MediaWiki テンプレート「<strong>$1</strong>」はウィキ内に存在しません。

テンプレートを取り込むか、またはマッピングに使用する別の MediaWiki テンプレートを選択してください。',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki テンプレート「$1」が見つかりません。',
	'gwtoolset-metadata-file-source' => 'メタデータ ファイル ソースを選択してください。',
	'gwtoolset-metadata-file-url' => 'メタデータ ファイルがあるウィキの URL:',
	'gwtoolset-metadata-file-upload' => 'メタデータ ファイルのアップロード:',
	'gwtoolset-metadata-mapping-bad' => 'メタデータのマッピングで問題点が発生しました。おそらく、JSON の形式が無効です。問題点を修正してから、フォームをもう一度送信してください。

$1',
	'gwtoolset-metadata-mapping-invalid-url' => '指定したメタデータ マッピング URL は、予期したマッピング URL パスに一致しませんでした。

* 指定した URL: $1
* 予期した URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'メタデータのマッピングが見つかりませんでした。

ページ「<strong>$1</strong>」がウィキ内に存在しません。',
	'gwtoolset-namespace-mismatch' => 'ページ「<strong>$1</strong>」が誤った名前空間「<strong>$2</strong>」に属しています。

名前空間「<strong>$3</strong>」である必要があります。',
	'gwtoolset-no-xml-element-found' => 'マッピング用の XML 要素が見つかりません。
* フォームで「{{int:gwtoolset-record-element-name}}」欄に値を入力しましたか?
* XML ファイルが整形式かどうか、こちらで検証してください: [$1 XML Validator]
$2',
	'gwtoolset-page-title-contains-url' => 'ページ「$1」はウィキの完全な URL を含んでいます。ページ名のみを入力するようにしてください (例: URL の /wiki/ の後の部分)。',
	'gwtoolset-record-element-name' => '各メタデータのレコードを含む XML 要素:',
	'gwtoolset-step-1-heading' => '手順 1: メタデータの検出',
	'gwtoolset-step-1-instructions-1' => 'メタデータのアップロード作業には以下の 4 つの手順があります:',
	'gwtoolset-step-1-instructions-2' => 'この手順では、ウィキにメタデータ ファイルを新たに{{GENDER:$1|アップロードします}}。このツールはメタデータ ファイルから利用できるメタデータ フィールドの抽出を試みます。次の「{{int:gwtoolset-step-2-heading}}」で、これらのフィールドを MediaWiki テンプレートにマッピングします。',
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
	'gwtoolset-create-mapping' => '$1: $2 用のメタデータ マッピングを作成',
	'gwtoolset-global-categories' => 'グローバル カテゴリ',
	'gwtoolset-global-tooltip' => 'これらのカテゴリ エントリは、アップロードされた項目すべてにグローバルに適用されます。',
	'gwtoolset-maps-to' => 'マッピング先',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'ファイル URL からそのファイルの拡張子を判定できませんでした: $1',
	'gwtoolset-mapping-media-file-url-bad' => 'メディア ファイルの URL を評価できませんでした。この URL では、この拡張機能がまだ処理できない方法でコンテンツを配信しているか、または HTTP リクエストのエラーが発生しました。指定した URL は「$1」でした。HTTP リクエスト エラー「$2」です。',
	'gwtoolset-mapping-no-title' => 'メタデータのマッピングが、ページ作成に必要なタイトルを含んでいません。',
	'gwtoolset-mapping-no-title-identifier' => 'メタデータ マッピングが、固有のページ名作成に使用するタイトル識別子を含んでいません。メタデータのフィールドを MediaWiki テンプレートのパラメーター タイトル識別子にマッピングしたことを確認してください。',
	'gwtoolset-metadata-field' => 'メタデータのフィールド',
	'gwtoolset-metadata-file' => 'メタデータ ファイル',
	'gwtoolset-metadata-mapping-legend' => 'メタデータのマッピング',
	'gwtoolset-no-more-records' => '<strong>処理すべきレコードはこれ以上ありません</strong>',
	'gwtoolset-partner' => 'パートナー',
	'gwtoolset-partner-template' => 'パートナー テンプレート:',
	'gwtoolset-preview' => '一括処理をプレビュー',
	'gwtoolset-process-batch' => '一括処理を実行',
	'gwtoolset-record-count' => 'このメタデータ ファイル内で見つかった総レコード数: {{PLURAL:$1|$1}}',
	'gwtoolset-results' => '結果',
	'gwtoolset-step-2-heading' => '手順 2: メタデータのマッピング',
	'gwtoolset-step-2-instructions-heading' => 'メタデータ フィールドのマッピング',
	'gwtoolset-step-2-instructions-1' => '下の内容の説明:',
	'gwtoolset-step-2-instructions-1-li-1' => 'MediaWiki テンプレート $1 内のフィールドの一覧。',
	'gwtoolset-step-2-instructions-1-li-2' => 'メタデータ ファイル内で見つかったメタデータ フィールドを含むドロップダウン フィールド。',
	'gwtoolset-step-2-instructions-1-li-3' => 'メタデータ ファイルから抽出したサンプル レコード。',
	'gwtoolset-step-2-instructions-2' => 'この手順では、メタデータのフィールドを MediaWiki テンプレートのフィールドにマッピングする必要があります。',
	'gwtoolset-step-2-instructions-2-li-1' => '「{{int:gwtoolset-template-field}}」列の MediaWiki テンプレートのフィールドに対応する「{{int:gwtoolset-maps-to}}」列のメタデータ フィールドを選択してください。',
	'gwtoolset-step-2-instructions-2-li-2' => 'マッピング先を、MediaWiki テンプレートのフィールドすべてに対して指定する必要はありません。',
	'gwtoolset-reupload-media' => 'メディアを URL から再アップロード',
	'gwtoolset-reupload-media-explanation' => 'このチェックボックスでは、ウィキに既にアップロードされている項目用のメディアを再アップロードできるようにします。項目が既に存在する場合は、新たなメディア ファイルがウィキに追加されます。項目がまだ存在しない場合は、このチェックボックスにチェックを入れているかどうかにかかわらずアップロードされます。',
	'gwtoolset-specific-categories' => '項目固有のカテゴリ',
	'gwtoolset-template-field' => 'テンプレートのフィールド',
	'gwtoolset-step-3-instructions-heading' => '手順 3: 一括処理のプレビュー',
	'gwtoolset-step-3-instructions-1' => '以下は、あなたが選択して「{{int:gwtoolset-step-2-heading}}」で MediaWiki テンプレートに{{PLURAL:$1|}}マッピングしたメタデータ ファイルから抽出した{{PLURAL:$1|先頭のレコード|先頭の $1 件のレコード}}のアップロード結果です。',
	'gwtoolset-step-3-instructions-2' => 'これらのページを確認して、期待したものと結果が異なる場合、およびアップロード待ちのレコードがある場合は、下の「{{int:gwtoolset-process-batch}}」ボタンをクリックして一括アップロードの処理を続行してください。',
	'gwtoolset-step-3-instructions-3' => '結果に問題がある場合は、「{{int:gwtoolset-step-2-heading}}」で前のページに戻って必要に応じてマッピングを調整してください。

メタデータ ファイル自体を調整する必要がある場合は、このまま進み、調整したものを最初の「{{int:gwtoolset-step-1-heading}}」で再アップロードするところからやり直してください。',
	'gwtoolset-title-bad' => 'メタデータと MediaWiki テンプレートのマッピングに基づいて作成したページ名が有効ではありません。

タイトルおよびタイトル識別子についてメタデータの別のフィールドを試すか、または可能であればメタデータの必要な箇所を変更してください。詳細情報は[https://commons.wikimedia.org/wiki/Commons:File_naming ファイルの命名]を参照してください。

<strong>無効なページ名:</strong> $1',
	'gwtoolset-batchjob-metadata-created' => 'メタデータ一括処理ジョブを作成しました。メタデータ ファイルはすぐに解析され、各項目はバックグラウンド プロセスでウィキにアップロードされます。アップロードがいつ完了したか知るには、ページ「$1」を確認してください。',
	'gwtoolset-batchjob-metadata-creation-failure' => 'メタデータ ファイルの一括処理ジョブを作成できませんでした。',
	'gwtoolset-create-mediafile' => '$1: $2 用のメディアファイルを作成',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => 'メディアファイル一括処理{{PLURAL:$1|ジョブ}}を $1 件作成しました。',
	'gwtoolset-step-4-heading' => '手順 4: 一括アップロード',
	'gwtoolset-invalid-token' => 'フォームから送信された編集トークンが無効です。',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => '現在の <code>php.ini</code> の設定:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

これらはウィキの <code>$wgMaxUploadSize</code> の値「$3」よりも小さい値に設定されています。<code>php.ini</code> の設定を適切なものに変更してください。',
	'gwtoolset-mediawiki-version-invalid' => 'この拡張機能を使用するには、MediaWiki バージョン $1 が必要です。<br />ご使用中の MediaWiki のバージョンは $2 です。',
	'gwtoolset-permission-not-given' => 'ログインしていることを確認してください。解決しない場合は、このページを閲覧する権限の付与について管理者にお問い合わせください ($1)。',
	'gwtoolset-user-blocked' => 'あなたのアカウントは現在ブロックされています。このブロックの問題点を解決するには管理者へお問い合わせください。',
	'gwtoolset-required-group' => 'あなたはグループ $1 に属していません。',
	'gwtoolset-verify-api-enabled' => '$1 拡張機能を使用するには、ウィキの API を有効にする必要があります。

<code>$wgEnableAPI</code> の値が、<code>DefaultSettings.php</code> で <code>true</code> に設定されていること、またはその値が <code>LocalSettings.php</code> で <code>true</code> に変更されていることを確認してください。',
	'gwtoolset-verify-api-writeable' => '$1 拡張機能を使用するには、権限がある利用者がウィキの API で書き込み操作を実行できるようにする必要があります。

<code>$wgEnableWriteAPI</code> の値が、<code>DefaultSettings.php</code> で <code>true</code> に設定されていること、またはその値が <code>LocalSettings.php</code> で <code>true</code> に変更されていることを確認してください。',
	'gwtoolset-verify-curl' => '$1 拡張機能を使用するには、PHP の [http://www.php.net/manual/en/curl.setup.php cURL 関数]をインストールする必要があります。',
	'gwtoolset-verify-finfo' => '$1 拡張機能を使用するには、PHP の [http://www.php.net/manual/ja/fileinfo.setup.php finfo] 拡張モジュールをインストールする必要があります。',
	'gwtoolset-verify-php-version' => '$1 拡張機能を使用するには、PHP 5.3.3 以降が必要です。',
	'gwtoolset-verify-uploads-enabled' => '$1 拡張機能を使用するには、ファイル アップロードを有効にする必要があります。

<code>LocalSettings.php</code> 内で <code>$wgEnableUploads</code> を <code>true</code> に設定していることを確認してください。',
	'gwtoolset-verify-xmlreader' => '$1 拡張機能を使用するには PHP の [http://www.php.net/manual/ja/xmlreader.setup.php XMLReader] をインストールする必要があります。',
	'gwtoolset-wiki-checks-not-passed' => 'ウィキが要件を満たしていません',
);

/** Korean (한국어)
 * @author Clockoon
 * @author Hym411
 * @author Priviet
 */
$messages['ko'] = array(
	'gwtoolset' => 'GW도구모음',
	'gwtoolset-desc' => 'GW 도구모음, GLAM을 위한 대량 업로드 도구',
	'gwtoolset-intro' => 'GW도구모음은 GLAM(갤러리, 도서관, 기록 보관소 및 박물관)의 메타데이터가 있는 XML 파일 기반으로 파일을 대량으로 올릴 수 있는 미디어위키 확장 기능입니다. XML 스키마의 다양성을 위해 추진되는 이 프로젝트는, [//commons.wikimedia.org/wiki/Commons:GLAMToolset_project 프로젝트 문서]에서 더 많은 정보를 찾아볼 수 있습니다. 해당 페이지에서 연락해 주세요. 업로드 절차를 진행하기 위해, 위의 메뉴 버튼을 눌러 진행해 주세요.',
	'right-gwtoolset' => 'GW도구모음 사용',
	'action-gwtoolset' => 'GW도구모음 사용',
	'group-gwtoolset' => 'GW도구모음 사용자',
	'group-gwtoolset-member' => '{{GENDER:$1|GW도구모음 사용자}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GW툴셋 사용자',
	'gwtoolset-batchjob-creation-failure' => '"$1" 형식의 일괄 작업을 생성할 수 없습니다.',
	'gwtoolset-could-not-close-xml' => 'XML 리더를 닫을 수 없습니다.',
	'gwtoolset-could-not-open-xml' => 'XML 파일을 읽어올 수 없습니다.',
	'gwtoolset-developer-issue' => '개발자와 연락해 주십시오. 계속하기 전에 이 문제를 해결해야 합니다. 개발자에게 알릴 때 다음 내용을 추가해 주십시오:

$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, <code>record-count</code>, 또는 <code>record-current</code>가 입력되지 않았습니다.',
	'gwtoolset-file-backend-maxage-invalid' => '<code>$wgGWTFBMaxAge</code>에 입력된 최대 나이 값이 유효하지 않습니다. [php.net/manual/en/datetime.formats.relative.php PHP 설명서]를 참고하여 올바르게 설정하실 수 있습니다.',
	'gwtoolset-fsfile-empty' => '파일이 비었으며 삭제했습니다.',
	'gwtoolset-fsfile-retrieval-failure' => '파일을 URL $1에서 가져올 수 없습니다.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>가 설정되지 않습니다.',
	'gwtoolset-incorrect-form-handler' => '"$1" 모듈이 GWToolset\\Handlers\\Forms\\FormHandler를 계승하는 양식 조작기을 하지 않았습니다.',
	'gwtoolset-job-throttle-exceeded' => '일괄 처리 작업 스로틀이 초과되었습니다.',
	'gwtoolset-no-accepted-types' => '허용된 유형이 입력되지 않았습니다.',
	'gwtoolset-no-callback' => '메소드가 콜백을 통과하지 않았습니다.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code>가 설정되지 않았습니다.",
	'gwtoolset-no-default' => '기본값이 입력되지 않았습니다.',
	'gwtoolset-no-field-size' => '"$1" 필드의 필드 크기가 지정되지 않았습니다.',
	'gwtoolset-no-file-backend-name' => '파일 백엔드 이름이 입력되지 않았습니다.',
	'gwtoolset-no-file-backend-container' => '파일 백엔드 컨테이너 이름이 입력되지 않았습니다.',
	'gwtoolset-no-file-url' => '구문 분석을 위한 <code>file_url</code>이 입력되지 않았습니다.',
	'gwtoolset-no-form-handler' => '양식 처리기가 만들어지 않았습니다.',
	'gwtoolset-no-mapping' => '<code>mapping_name</code>가 입력되지 않았습니다.',
	'gwtoolset-no-mapping-json' => '<code>mapping_json</code>가 입력되지 않았습니다.',
	'gwtoolset-no-max' => '최댓값가 입력되지 않았습니다.',
	'gwtoolset-no-mediafile-throttle' => '미디어파일 작업 스로틀이 입력되지 않았습니다.',
	'gwtoolset-no-mediawiki-template' => '<code>mediawiki-template-name</code>가 입력되지 않았습니다.',
	'gwtoolset-no-min' => '최댓값이 입력되지 않았습니다.',
	'gwtoolset-no-module' => '모듈 이름이 지정되지 않았습니다.',
	'gwtoolset-no-mwstore-complete-path' => '완성된 파일 경로가 입력되지 않았습니다.',
	'gwtoolset-no-mwstore-relative-path' => '상대 경로가 입력되지 않았습니다.',
	'gwtoolset-no-page-title' => '문서 제목가 입력되지 않았습니다.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code>가 설정되지 않았습니다.",
	'gwtoolset-no-source-array' => '출처 배열이 입력되지 않았습니다.',
	'gwtoolset-no-summary' => '요약이 입력되지 않았습니다.',
	'gwtoolset-no-template-url' => '구문분석을 위한 틀 URL이 입력되지 않았습니다.',
	'gwtoolset-no-text' => '텍스트가 입력되지 않았습니다.',
	'gwtoolset-no-title' => '제목이 입력되지 않았습니다.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code>가 설정되지 않았습니다.",
	'gwtoolset-no-url-to-evaluate' => '평가를 위한 URL이 입력되지 않았습니다.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code>가 설정되지 않았습니다.',
	'gwtoolset-no-user' => '사용자 객체 입력되지 않았습니다.',
	'gwtoolset-no-xml-element' => 'XML리더 또는 DOM요소가 입력되지 않았습니다.',
	'gwtoolset-no-xml-source' => '지역 XML 출처가 입력되지 않았습니다.',
	'gwtoolset-not-string' => '메서드에 입력된 값은 문자열이 아닙니다. "$1" 유형이 아닙니다.',
	'gwtoolset-sha1-does-not-match' => 'SHA-1가 일치하지 않습니다.',
	'gwtoolset-disk-write-failure' => '서버가 파일 시스템에 파일을 쓸 수 없습니다.',
	'gwtoolset-xml-doctype' => 'XML 메타데이터 파일이 <!DOCTYPE> 문단을 포함할 수 없습니다. 제거하고 XML 메타데이터 파일을 다시 올려주세요.',
	'gwtoolset-file-is-empty' => '빈 파일을 업로드했습니다.',
	'gwtoolset-improper-upload' => '파일이 정상적으로 업로드되지 않았습니다.',
	'gwtoolset-mime-type-mismatch' => '올려진 파일의 파일 확장자 "$1"와 MIME 유형 "$2"이 일치하지 않습니다.',
	'gwtoolset-missing-temp-folder' => '임시 폴더를 사용할 수 없습니다.',
	'gwtoolset-multiple-files' => '업로드된 파일이 두개 이상의 파일의 정보를 포함하고 있습니다. 한번에 하나의 파일만 올릴 수 있습니다.',
	'gwtoolset-no-extension' => '올려진 파일에 충분한 파일 정보가 없어 처리하지 못했습니다. 파일 확장자가 없을 수 있습니다.',
	'gwtoolset-no-file' => '파일이 없습니다.',
	'gwtoolset-no-form-field' => '예상되는 형식 필드 "$1"이 존재하지 않습니다.',
	'gwtoolset-over-max-ini' => '업로드된 파일이 
<code>php.ini</code> 내의 <code>upload_max_filesize</code> 디렉티브 또는/그리고 <code>post_max_size</code>을 초과했습니다.',
	'gwtoolset-partial-upload' => '파일의 일부만 올렸습니다.',
	'gwtoolset-php-extension-error' => 'PHP 확장기능이 파일 올리기를 중지시켰습니다. PHP는 어느 확장 기능이 파일 올리기를 멈추었는지 확정할 방법을 제공하지 않습니다. <code>phpinfo()</code>로 로드된 확장기능의 목록을 검사하는 것이 도움이 될 수 있습니다.',
	'gwtoolset-unaccepted-extension' => '허용된 파일 확장자를 포함하고 있지 않습니다.',
	'gwtoolset-unaccepted-extension-specific' => '파일 원본이 파일 확장자 ".$1"를 갖고 있습니다.',
	'gwtoolset-unaccepted-mime-type' => '올려진 파일이 허용되지 않은 MIME 유형인 "$1" MIME 유형으로 해석됩니다.',
	'gwtoolset-unaccepted-mime-type-for-xml' => '업로드된 파일이 MIME 형식 "$1"을 갖고 있으며, 이는 허용되지 않습니다. XML 파일이 파일의 앞부분에 XML 선언을 포함하고 있습니까?',
	'gwtoolset-back-text-link' => '← 양식으로 돌아가기',
	'gwtoolset-back-text' => '양식으로 돌아가려면 브라우저의 뒤로가기 버튼을 누르세요.',
	'gwtoolset-file-interpretation-error' => '메타데이터를 처리하는 도중 문제가 발생했습니다.',
	'gwtoolset-mediawiki-template' => '틀 $1',
	'gwtoolset-metadata-user-options-error' => '다음 양식의 {{PLURAL:$2|필드}}는 반드시 채워야 합니다:$1',
	'gwtoolset-metadata-invalid-template' => '유효한 미디어위키 틀을 찾을 수 없습니다.',
	'gwtoolset-menu-1' => '메타 데이터 매핑',
	'gwtoolset-technical-error' => '기술적인 오류가 있었습니다.',
	'gwtoolset-required-field' => '필수 필드를 나타냅니다.',
	'gwtoolset-submit' => '제출',
	'gwtoolset-summary-heading' => '요약',
	'gwtoolset-cancel' => '취소',
	'gwtoolset-loading' => '잠시 기다려 주십시오. 시간이 걸릴 수 있습니다.',
	'gwtoolset-save' => '저장',
	'gwtoolset-save-mapping' => '매핑 저장',
	'gwtoolset-save-mapping-failed' => '죄송합니다. 귀하의 요청을 처리하는 도중 문제가 발생했습니다. 나중에 다시 시도 하십시오. (오류 메시지: $1)',
	'gwtoolset-save-mapping-succeeded' => '매핑을 저장하였습니다.',
	'gwtoolset-save-mapping-name' => '매핑의 이름을 무엇으로 하시겠습니까?',
	'gwtoolset-json-error' => 'JSON에 문제가 있었습니다. 오류:$1',
	'gwtoolset-json-error-depth' => '스택 깊이 최대값을 초과하였습니다.',
	'gwtoolset-json-error-state-mismatch' => '언더플로우 혹은 모드가 일치하지 않습니다.',
	'gwtoolset-json-error-ctrl-char' => '예기치 않은 제어 문자를 발견하였습니다.',
	'gwtoolset-json-error-syntax' => '구문 오류, 잘못된 JSON입니다.',
	'gwtoolset-json-error-utf8' => '잘못된 UTF-8 문자, 제대로 인코딩되지 않았을 가능성이 있습니다.',
	'gwtoolset-json-error-unknown' => '알 수 없는 오류.',
	'gwtoolset-accepted-file-types' => '허용되는 파일{{PLURAL:$1|형식}}:',
	'gwtoolset-ensure-well-formed-xml' => 'XML 파일이 올바른 형식인지 $1로 확인해주세요.',
	'gwtoolset-file-url-invalid' => '파일 URL이 유효하지 않습니다; 파일이 아직 위키에 존재하지 않습니다. 양식에서 파일 URL 참조를 사용하려면 먼저 당신의 컴퓨터에서 파일을 올려야 합니다.',
	'gwtoolset-mediafile-throttle' => '미디어파일 스로틀:',
	'gwtoolset-mediafile-throttle-description' => '일괄 처리 미리보기 후, 단계 3에서 GW도구모음이 백그라운드 작업을 통해 일괄 처리 업로드에서 잔여 기록을 업로드했습니다. 미디어파일 스로틀은 위키미디어 공용이 백그라운드 작업이 동작하고 있을 때마다 당신의 미디어파일 서버에 대한 미디어파일 요청 수를 관리합니다. 미디어파일 스로틀을 1-20 사이로 설정할 수 있습니다. 위키미디어 공용은 전체 일괄 처리 업로드 작업을 처리하기 위하여 다섯 백그라운드 작업을 실행합니다. 백그라운드 작업 간 시간은 서버 부하나 설정에 따라 달라질 수 있습니다. 저희는 위키미디어 공용에서 GW도구모음 백그라운드 작어이 최소 5분마다 실행되기를 기대하고 있습니다.',
	'gwtoolset-mediawiki-template-does-not-exist' => '미디어위키 틀 "<strong>$1</strong>"이 위키에 존재하지 않습니다.

틀을 가져오고 매핑을 위해 사용할 다른 미디어위키 틀을 선택해주세요',
	'gwtoolset-mediawiki-template-not-found' => '미디어위키 틀 "$1"을 찾을 수 없습니다.',
	'gwtoolset-metadata-file-source' => '메타데이터 파일 출처를 선택해주세요.',
	'gwtoolset-metadata-file-source-info' => '... 이전에 올린 파일이거나 컴퓨터에서 올리려는 파일',
	'gwtoolset-metadata-file-url' => '메타데이터 파일 위키 URL:',
	'gwtoolset-metadata-file-upload' => '메타데이터 파일 올리기:',
	'gwtoolset-metadata-mapping-bad' => '메타데이터 매핑에 문제가 발생했습니다. JSON 형식이 유효하지 않을 가능성이 높습니다. 문제를 수정하고 다시 양식을 제출해보세요.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => '제공된 메타데이터 매핑 URL이 예상된 매핑 URL 경로와 일치하지 않습니다.

* 특정된 URL: $1
* 예상된 URL: $2',
	'gwtoolset-metadata-mapping-not-found' => '메타데이터 매핑을 찾을 수 없습니다.

"<strong>$1<strong>" 문서가 위키에 존재하지 않습니다.',
	'gwtoolset-namespace-mismatch' => '"<strong>$1<strong>" 문서는 잘못된 "<strong>$2<strong>" 이름공간에 존재합니다.

"<strong>$3<strong>" 이름공간이어야 합니다.',
	'gwtoolset-no-xml-element-found' => 'XML 요소를 매핑에서 찾을 수 없습니다.
* 양식에 "{{int:gwtoolset-record-element-name}}"의 값을 입력하셨나요?
* XML 파일이 정형식입니까? [$1 XML validator] 도구를 사용해보세요.
$2',
	'gwtoolset-page-title-contains-url' => '"$1" 문서는 전체 위키 URL을 포함하고 있습니다.문서 제목만을 입력했는지 확인하세요. (예) URL의 /wiki/의 뒷부분',
	'gwtoolset-record-element-name' => '메타데이터 기록을 포함하는 XML 요소:',
	'gwtoolset-step-1-heading' => '단계1: 메타데이터 검색',
	'gwtoolset-step-1-instructions-1' => '메타데이터 올리기 과정은 4단계로 구성됩니다.',
	'gwtoolset-step-1-instructions-2' => '이 단계에서 위키에 새로운 메타데이터 파일을 {{GENDER:$1|올립니다}}. 이 도구는 메타데이터 파일에서 사용할 수 있는 메타데이터 필드 추출을 시도합니다. "{{int:gwtoolset-step-2-heading}}"로 메타위키 틀에 매핑합니다.',
	'gwtoolset-step-1-instructions-3' => '만약 미디어 파일 도메인이 아래 목록에 없다면 당신의 미디어 파일 도메인이 위키미디어 공용 화이트리스트에 추가될 수 있도록 [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment 요청]해주세요. 미디어파일 도메인이 해당 목록에 없다면 위키미디어 공용은 해당 도메인에서 미디어 파일을 내려받을 것입니다. 당신의 요청을 제출하는 최고의 예시가 미디어파일에 연결할 실제 링크입니다.',
	'gwtoolset-step-1-instructions-3-heading' => '도메인 화이트리스트',
	'gwtoolset-step-1-instructions-li-1' => '메타데이터 감지',
	'gwtoolset-step-1-instructions-li-2' => '메타데이터 매핑',
	'gwtoolset-step-1-instructions-li-3' => '일괄 처리 미리보기',
	'gwtoolset-step-1-instructions-li-4' => '일괄 업로드',
	'gwtoolset-upload-legend' => '메타데이터 파일을 업로드하기',
	'gwtoolset-which-mediawiki-template' => '미디어위키 틀:',
	'gwtoolset-which-metadata-mapping' => '메타데이터 매핑:',
	'gwtoolset-xml-error' => 'XML을 로드하지 못했습니다. 아래 오류를 수정하시기 바랍니다.',
	'gwtoolset-categories' => '파이프 문자("|")로 구분된 카테고리를 입력하세요.',
	'gwtoolset-category' => '분류',
	'gwtoolset-create-mapping' => '$1: $2을 위한 메타데이터 매핑 만들기',
	'gwtoolset-example-record' => '메타데이터 예시 레코드의 내용',
	'gwtoolset-global-categories' => '전역 분류',
	'gwtoolset-global-tooltip' => '이 분류는 업로드된 모든 항목에 대해 적용됩니다.',
	'gwtoolset-maps-to' => '매핑 장소',
	'gwtoolset-mapping-media-file-url-extension-bad' => '파일 확장 기능이 파일 URL에서 확정되지 않았습니다: $1',
	'gwtoolset-mapping-media-file-url-bad' => '해당 미디어 파일 URL을 평가할 수 없습니다. URL이 아직 이 확장 기능으로 다룰 수 없는 방법으로 내용을 전달했거나 HTTP 요청 문제가 있습니다. 주어진 URL은 "$1"입니다. HTTP 요청은 "$2" 오류입니다.',
	'gwtoolset-mapping-no-title' => '메타데이터 매핑은 제목을 포함하고 있습니다. 제목은 문서를 만들기 위해 필요합니다',
	'gwtoolset-mapping-no-title-identifier' => '메타데이터 매핑이 고유 문서 제목을 생성하는데 사용되는 제목 식별자를 포함하고 있지 않습니다. 미디어위키 틀 매개변수 제목 식별자에 메타데이터 필드를 매핑하고 있는지 확인하세요.',
	'gwtoolset-metadata-field' => '메타데이터 필드',
	'gwtoolset-metadata-file' => '메타데이터 파일',
	'gwtoolset-metadata-mapping-legend' => '메타데이터를 매핑',
	'gwtoolset-no-more-records' => '<strong>진행할 레코드가 더 이상 없습니다</strong>',
	'gwtoolset-painted-by' => '그림',
	'gwtoolset-partner' => '파트너',
	'gwtoolset-partner-explanation' => '파트너 틀은 제공됐을 때 미디어위키 틀의 소스 필드를 넣었습니다. 분류에서 현재 파트너 틀 목록을 찾을 수 있습니다:출처 틀 문서; 아래 링크를 참조하세요. 파트너 틀을 찾으면 이 필드에 URL을 넣을 수 있습니다. 필요하다면 새로운 파트너 틀을 만들 수 있습니다.',
	'gwtoolset-partner-template' => '파트너 틀:',
	'gwtoolset-phrasing' => '프레이징',
	'gwtoolset-preview' => '미리보기 일괄 처리',
	'gwtoolset-process-batch' => '프로세스 일괄 처리',
	'gwtoolset-record-count' => '이 메타데이터 파일의 레코드 총 개수: {{PLURAL:$1|$1}}',
	'gwtoolset-results' => '결과',
	'gwtoolset-step-2-heading' => '단계 2: 메타데이터 매핑',
	'gwtoolset-step-2-instructions-heading' => '매핑 메타데이터 필드',
	'gwtoolset-step-2-instructions-1' => '다음은:',
	'gwtoolset-step-2-instructions-1-li-1' => '$1 미디어위키의 필드 목록.',
	'gwtoolset-step-2-instructions-1-li-2' => '메타데이터 필드를 나타내는 드롭다운 필드를 메타데이터 파일을 찾았습니다.',
	'gwtoolset-step-2-instructions-1-li-3' => '메타데이터에서 추출한 샘플 레코드.',
	'gwtoolset-step-2-instructions-2' => '이 단계에서 미디어위키 틀 필드로 메타데이터 필드를 매핑해야 합니다.',
	'gwtoolset-step-2-instructions-2-li-1' => ' "{{int:gwtoolset-template-field}}" 열 아래의 믿어이키 틀 필드와 일치하는 "{{int:gwtoolset-maps-to}}" 열 아래의 메타데이터 필드를 선택하세요.',
	'gwtoolset-step-2-instructions-2-li-2' => '모든 미디어위키 틀 필드와 일치시킬 필요가 없습니다.',
	'gwtoolset-reupload-media' => 'URL에서 미디어를 다시 업로드하기',
	'gwtoolset-reupload-media-explanation' => '이 확인란은 위키에 이미 올려진 항목인 미디어를 다시 업로드 할 수 있게 해줍니다.만약 항목이 이미 존재한다면 추가할 미디어 파일은 위키에 올라갈 것입니다. 미디어 파일이 존재하지 않는다면 확인란의 체크 여부에 관계 없이 올라갈 것입니다.',
	'gwtoolset-specific-categories' => '항목의 특정 분류',
	'gwtoolset-specific-tooltip' => '다음 필드를 사용하여 구절(선택 사항)과 개별적으로 올려진 항목에 대한 분류 항목으로서의 메타데이터 필드에 적용할 수 있습니다. 예를 들어, 메타이이터가 각각의 레코드의 아티스트에 대한 요소를 포함하고 있다면, 각각의 특수한 레코드 값으로 바꿀 각각의 레코드에 대한 분류 항목으로서 추가할 수 있습니다. 또한 "<em>{{int:gwtoolset-painted-by}}</em>" 같은 구절도 추가할 수 있으며 각각의 레코드에 대한 분류로서 "<em>{{int:gwtoolset-painted-by}} <artist name></em>"를 산출할 아티스트 메타데이터를 추가 할 수 있습니다.',
	'gwtoolset-template-field' => '틀 필드',
	'gwtoolset-step-3-instructions-heading' => '단계3: 일괄 처리 미리 보기',
	'gwtoolset-step-3-instructions-1' => '아래는 당신이 선택한 메타데이터 파일의 {{PLURAL:$1|첫 레코드|첫 $1 레코드}}와 당신이 "{{int:gwtoolset-step-2-heading}}"에서 선택한 미디어위키 틀에 {{PLURAL:$1|그것}}을 매핑한 것에 대한 올리기 결과이며',
	'gwtoolset-step-3-instructions-2' => '이 페이지를 검토해서 결과가 예상했던 것과 같고 업로드 대기중인 추가 레코드가 있다면 아래의 "{{int:gwtoolset-process-batch}}" 버튼을 클릭하여 일괄 처리 작업을 계속하세요.',
	'gwtoolset-step-3-instructions-3' => '결과에 만족하지 못한다면 "{{int:gwtoolset-step-2-heading}}"로 돌아가 매핑을 반드시 조정하세요.

메타데이터 파일 조정을 필요로 한다면 앞으로 가서 조정한 후 "{{int:gwtoolset-step-1-heading}}"로 다시 처리하기 시작하여 재업로드해 주세요.',
	'gwtoolset-title-bad' => '제목이 만들어졌으며 메타데이터에 기초하여 미디어위키 틀 매핑이 유효하지 않습니다.
<strong>유효하지 않은 제목:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => '메타데이터 일괄 처리 작업을 만들었습니다. 당신의 메타데이터 파일을 간단히 분석하고 각각의 항목을 위키에 백그라운드 프로세스로 올립니다. 항목이 올려졌을 때 "$1" 문서를 확인할 수 있습니다.',
	'gwtoolset-batchjob-metadata-creation-failure' => '메타데이터 파일을 위한 일괄 처리 작업을 만들 수 없습니다.',
	'gwtoolset-create-mediafile' => '$1: $2 사용자를 위한 미디어파일을 만들기',
	'gwtoolset-create-prefix' => 'GW도구모음',
	'gwtoolset-mediafile-jobs-created' => '$1 미디어 파일 일괄 처리 {{PLURAL:$1|작업}} 만들기',
	'gwtoolset-step-4-heading' => '단계 4: 일괄 업로드',
	'gwtoolset-invalid-token' => '양식과 제출된 편집 토큰이 유효하지 않습니다.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => '현재 <code>php.ini</code>의 설정:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

이것은 "$3"로 설정된 위키의 <code>$wgMaxUploadSize</code>보다 낮게 설정돼있습니다. <code>php.ini</code>를 적절하게 조정해주세요.',
	'gwtoolset-mediawiki-version-invalid' => '이 확장 기능은 미디어위키 $1 버전을 필요로 합니다<br />이 미디어위키 버전은 $2입니다.',
	'gwtoolset-permission-not-given' => '이 문서($1)를 보려면 로그인 상태인지 확인하거나 관리자에게 문의하세요.',
	'gwtoolset-user-blocked' => '당신의 사용자 계정은 현재 차단되어 있습니다. 차단 문제를 수정하려면 관리자에게 문의하세요.',
	'gwtoolset-required-group' => '$1 그룹에 속해있지 않습니다.',
	'gwtoolset-verify-api-enabled' => '$1 확장 기능은 위키 API가 활성화되야 합니다.

<code>$wgEnableAPI</code>가 <code>DefaultSettings.php</code> 파일에서 <code>true</code>로 설정되어 있거나 <code>LocalSettings.php</code> 파일에서 <code>true</code>로 오버라이드되어 있는지 확인하세요.',
	'gwtoolset-verify-api-writeable' => '$1 확장기능은 위키 API가 권한이 있는 사용자 쓰기 명령을 수행할 수 있어야 합니다.

<code>$wgEnableWriteAPI</code>가 <code>DefaultSettings.php</code> 파일에서 <code>true</code>로 설정되어 있거나 <code>LocalSettings.php</code> 파일에서 <code>true</code>로 오버라이드되어 있는지 확인하세요.',
	'gwtoolset-verify-curl' => '$1 확장 기능은  PHP [http://www.php.net/manual/en/curl.setup.php cURL 함수]가 설치되어 있어야 합니다.',
	'gwtoolset-verify-finfo' => '$1 확장 기능은  PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] 확장기능이 설치되어 있어야 합니다.',
	'gwtoolset-verify-php-version' => '$1 확장 기능은 PHP>=5.3.3.을 필요로 합니다.',
	'gwtoolset-verify-uploads-enabled' => '$1 확장 기능은 파일 올리기가 활성화되어 있어야 합니다.

<code>$wgEnableUploads</code>가 <code>LocalSettings.php</code>에서 <code>true</code>로 설정되어 있는지 확인하세요.',
	'gwtoolset-verify-xmlreader' => '$1 확장 기능은 PHP [http://www.php.net/manual/en/xmlreader.setup.php XML리더]을 설치해야 합니다.',
	'gwtoolset-wiki-checks-not-passed' => '위키 검사를 통과하지 못했습니다.',
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

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, en Tool fir Fichieren a grousser Zuel eropzelueden (speziell fir Galerien, Bibliothéiken, Archiver a Muséeën)',
	'right-gwtoolset' => 'GWToolset benotzen',
	'action-gwtoolset' => 'gwtoolset ze benotzen',
	'group-gwtoolset' => 'GWToolset-Benotzer',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset-Benotzer|GWToolset-Benotzerin}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset-Benotzer',
	'gwtoolset-could-not-open-xml' => 'Den XML-Fichier konnt net fir ze liesen opgemaach ginn.',
	'gwtoolset-fsfile-empty' => 'De Fichier war eidel a gouf geläscht.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> net agestallt.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> net agestallt.",
	'gwtoolset-no-default' => 'Kee Standard-Wäert uginn.',
	'gwtoolset-no-max' => 'Kee maximale Wäert uginn.',
	'gwtoolset-no-page-title' => 'Kee Säitentitel uginn.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> net agestallt.",
	'gwtoolset-no-summary' => 'Kee Resumé uginn.',
	'gwtoolset-no-text' => 'Keen Text uginn.',
	'gwtoolset-no-title' => 'Keen Titel uginn.',
	'gwtoolset-sha1-does-not-match' => 'Den SHA-1 ass net richteg.',
	'gwtoolset-file-is-empty' => 'Den eropgeluedene Fichier ass eidel.',
	'gwtoolset-improper-upload' => 'De Fichier gouf net richteg eropgelueden.',
	'gwtoolset-partial-upload' => 'De Fichier gouf nëmmen deelweis eropgelueden.',
	'gwtoolset-back-text-link' => '← gitt zréck op de Formulaire',
	'gwtoolset-mediawiki-template' => 'Schabloun $1',
	'gwtoolset-metadata-invalid-template' => 'Keng valabel MediaWiki-Schabloun fonnt.',
	'gwtoolset-technical-error' => 'Technesche Feeler.',
	'gwtoolset-summary-heading' => 'Resumé',
	'gwtoolset-cancel' => 'Ofbriechen',
	'gwtoolset-loading' => 'Hutt w.e.g. e bësse Gedold. Dëst kann e bëssen daueren.',
	'gwtoolset-save' => 'Späicheren',
	'gwtoolset-json-error' => 'Et gouf e Problem mam JSON. Feeler: $1',
	'gwtoolset-json-error-syntax' => 'Synthax-Feeler,JSON falsch zesummegesat.',
	'gwtoolset-json-error-unknown' => 'Onbekannte Feeler.',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki-Schabloun "$1" net fonnt.',
	'gwtoolset-metadata-file-url' => 'Wiki-URL vum Metadata-Fichier:',
	'gwtoolset-category' => 'Kategorie',
	'gwtoolset-global-categories' => 'Global Kategorien',
	'gwtoolset-global-tooltip' => 'Dës Kategorie gi global fir all eropgelueden Elementer applizéiert.',
	'gwtoolset-painted-by' => 'Gemoolt vum',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-template' => 'Partnerschabloun:',
	'gwtoolset-results' => 'Resultater',
	'gwtoolset-step-2-instructions-1-li-1' => 'Eng Lëscht vun de Felder an der MediaWiki $1.',
	'gwtoolset-template-field' => 'Feld vun der Schabloun',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediawiki-version-invalid' => "Dës Erweiderung brauch d'Mediawiki-Versioun $1<br />Dës MediaWiki Versioun ass $2.",
	'gwtoolset-user-blocked' => 'Äre Benotzerkont ass den Ament gespaart. Kontaktéiert w.e.g. en Administrateur fir de Problem mat der Spär ze léisen.',
	'gwtoolset-required-group' => 'Dir sidd net Member vum Grupp $1.',
	'gwtoolset-verify-php-version' => "D'Erweiderung $1 brauch PHP >= 5.3.3.",
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset — алатка за масовно подигање за GLAM',
	'gwtoolset-intro' => 'GWToolset е додаток за МедијаВики што овозможува масовно подигање на содржини од соработки со културно-образовни установи како галерии, библиотеки, архиви и музеи (крат. ГБАМ/GLAM) на XML-податотека што содржи метаподатоци за подигнатото. Намерата е да се овозможат разни XML-шеми. Повеќе информации за проектот ќе најдете на [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project неговата матична страница]. Таму можете и слободно да ни се обратите за било што. Изберете една од ставките во менито погоре за да го започнете подигањето.',
	'right-gwtoolset' => 'Употреба на GWToolset',
	'action-gwtoolset' => 'употреба на GWToolset',
	'group-gwtoolset' => 'Корисници на GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Корисник на GWToolset}}',
	'grouppage-gwtoolset' => '{{ns:project}}:Корисници на GWToolset',
	'gwtoolset-batchjob-creation-failure' => 'Не можев да создадам пакет задачи од типот „$1“.',
	'gwtoolset-could-not-close-xml' => 'Не можев да го затворам читачот на XML.',
	'gwtoolset-could-not-open-xml' => 'Не можев да ја отворам XML-податотеката за читање.',
	'gwtoolset-developer-issue' => 'Обратете се кај програмер. Овој проблем мора да се реши пред да продолжите. Во пријавата на проблемот вклучете го и следниов текст:

$1',
	'gwtoolset-dom-record-issue' => 'Не е укажан <code>record-element-name</code> или <code>record-count</code>, или пак <code>record-current</code>.',
	'gwtoolset-file-backend-maxage-invalid' => 'Максималната старосна вредност зададена во <code>$wgGWTFBMaxAge</code> е неважечка.
Погледајте како да ја укажете правилно во [php.net/manual/en/datetime.formats.relative.php упатството за PHP].',
	'gwtoolset-fsfile-empty' => 'Податотеката беше празна и затоа беше избришана.',
	'gwtoolset-fsfile-retrieval-failure' => 'Не можев да ја добијам податотеката од адресата $1.',
	'gwtoolset-ignorewarnings' => 'Не е зададено <code>ignorewarnings</code>.',
	'gwtoolset-incorrect-form-handler' => 'Модулот „$1“ нема регистрирано работник со обрасци што го прошируваат GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'Надминато е ограничувањето на пакетни задачи.',
	'gwtoolset-no-accepted-types' => 'Нема укажано допуштени типови',
	'gwtoolset-no-callback' => 'На овој метод не му е зададено отповикување.',
	'gwtoolset-no-comment' => "Не е зададено <code>user_options['comment']</code>.",
	'gwtoolset-no-default' => 'Нема укажано стандардна вредност.',
	'gwtoolset-no-field-size' => 'Нема укажано големина за полето „$1“.',
	'gwtoolset-no-file-backend-name' => 'Нема укажано име за податотечната задница.',
	'gwtoolset-no-file-backend-container' => 'Нема укажано име за содржателот на податотечната задница.',
	'gwtoolset-no-file-url' => 'Нема укажано <code>file_url</code> за расчленување.',
	'gwtoolset-no-form-handler' => 'Нема создадено работник со обрасци.',
	'gwtoolset-no-mapping' => 'Нема укажано <code>mapping_name</code>.',
	'gwtoolset-no-mapping-json' => 'Нема укажано <code>mapping_json</code>.',
	'gwtoolset-no-max' => 'Нема укажано максимална вредност.',
	'gwtoolset-no-mediafile-throttle' => 'Нема укажано граница на задачите за медиумските податотеки.',
	'gwtoolset-no-mediawiki-template' => 'Нема укажано <code>mediawiki-template-name</code>.',
	'gwtoolset-no-min' => 'Нема укажано минимална вредност.',
	'gwtoolset-no-module' => 'Немате внесено име на модулот.',
	'gwtoolset-no-mwstore-complete-path' => 'Нема укажано целосна податотечна патека.',
	'gwtoolset-no-mwstore-relative-path' => 'Нема укажано релативна патека.',
	'gwtoolset-no-page-title' => 'Нема укажано наслов на страницата.',
	'gwtoolset-no-save-as-batch' => "Не е зададен <code>user_options['save-as-batch-job']</code>.",
	'gwtoolset-no-source-array' => 'Нема укажана изворен строј.',
	'gwtoolset-no-summary' => 'Нема даден опис.',
	'gwtoolset-no-template-url' => 'Нема укажана URL на шаблонот за расчленување.',
	'gwtoolset-no-text' => 'Нема внесено текст.',
	'gwtoolset-no-title' => 'Нема внесено наслов.',
	'gwtoolset-no-reupload-media' => "Не е зададено <code>user_options['gwtoolset-reupload-media']</code>.",
	'gwtoolset-no-url-to-evaluate' => 'Нема укажано URL за проценување.',
	'gwtoolset-no-url-to-media' => 'Не е зададено <code>url-to-the-media-file</code>.',
	'gwtoolset-no-user' => 'Нема зададено кориснички објект.',
	'gwtoolset-no-xml-element' => 'Нема зададено XMLReader или DOMElement.',
	'gwtoolset-no-xml-source' => 'Нема укажано локален XML-извор.',
	'gwtoolset-not-string' => 'Укажаната вредност за методот не претставува низа, туку е од типот „$1“.',
	'gwtoolset-sha1-does-not-match' => 'Контролниот збир SHA-1 не се совпаѓа.',
	'gwtoolset-disk-write-failure' => 'Опслужувачот не можеше да ја запише податотеката во податотечен систем.',
	'gwtoolset-xml-doctype' => 'XML-метаподаточната податотека не може да содржи дел со <!DOCTYPE>. Отстранете го и обидете се да ја подигнете повторно.',
	'gwtoolset-file-is-empty' => 'Подигнатата податотека е празна.',
	'gwtoolset-improper-upload' => 'Податотеката не е подигната како што треба.',
	'gwtoolset-mime-type-mismatch' => 'Наставката „$1“ и MIME-типот „$2“ на подигнатата податотека не се совпаѓаат.',
	'gwtoolset-missing-temp-folder' => 'Нема привремена папка на располагање.',
	'gwtoolset-multiple-files' => 'Подигнатата податотека содржи информации за повеќе од една податотека. Мора да се подигаат само една по една.',
	'gwtoolset-no-extension' => 'Подигнатата податотека не содржи доволно информации за да се обработи податотеката. Најверојатно нема наставка.',
	'gwtoolset-no-file' => 'Не примив податотека.',
	'gwtoolset-no-form-field' => 'Очекуваното поле „$1“ не постои во образецот.',
	'gwtoolset-over-max-ini' => 'Подигнатата податотека го надминува  <code>upload_max_filesize</code> и/или наредбата <code>post_max_size</code> во <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Податотеката е само делумно подигната.',
	'gwtoolset-php-extension-error' => 'Подигањето го запре PHP-додаток. PHP не дава начин да се одреди кој е овој додаток. Може да помогне ако го разгледате списокот на вчитани додатоци со <code>phpinfo()</code>.',
	'gwtoolset-unaccepted-extension' => 'Изворната податотека не содржи допуштена податотечна наставка.',
	'gwtoolset-unaccepted-extension-specific' => 'Изворната податотека ја има недопуштена податотечна наставка „.$1“.',
	'gwtoolset-unaccepted-mime-type' => 'Подигнатата податотека се толкува како да има MIME-тип „$1“, кој не е допуштен.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Подигнатата податотека има MIME-тип „$1“, кој не е допуштен. Дали XML-податотеката има изјава за XML во најгорниот дел?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← назад на образецот',
	'gwtoolset-back-text' => 'Стиснете на копчето „Назад“ во прелистувачот за да се вратите на образецот.',
	'gwtoolset-file-interpretation-error' => 'Се појави проблем при обработката на метаподаточната податотека',
	'gwtoolset-mediawiki-template' => 'Шаблон „$1“',
	'gwtoolset-metadata-user-options-error' => 'Мора да се {{PLURAL:$2|пополни следново поле|пополнат следниве полиња}} во образецот:
$1',
	'gwtoolset-metadata-invalid-template' => 'Не најдов важечки МедијаВики-шаблон.',
	'gwtoolset-menu-1' => 'Пресликување на метаподатоци',
	'gwtoolset-technical-error' => 'Се појави техничка грешка.',
	'gwtoolset-required-field' => 'означува задолжително поле',
	'gwtoolset-submit' => 'Поднеси',
	'gwtoolset-summary-heading' => 'Опис',
	'gwtoolset-cancel' => 'Откажи',
	'gwtoolset-loading' => 'Ве молиме за трпение. Ова може да потрае.',
	'gwtoolset-save' => 'Зачувај',
	'gwtoolset-save-mapping' => 'Зачувај пресликување',
	'gwtoolset-save-mapping-failed' => 'Нажалост, се појави грешка при обработката на вашето барање. Обидете се подоцна. (Известување за грешката: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Пресликувањето е зачувано.',
	'gwtoolset-save-mapping-name' => 'Како би сакале да го наречете ова пресликување?',
	'gwtoolset-json-error' => 'Се јави проблем со JSON. Грешка: $1.',
	'gwtoolset-json-error-depth' => 'Надмината е најголемата дозволена длабочина на стогот.',
	'gwtoolset-json-error-state-mismatch' => 'Потчекорување или несовпаѓање во режимите.',
	'gwtoolset-json-error-ctrl-char' => 'Пронајден е неочекуван контролен знак.',
	'gwtoolset-json-error-syntax' => 'Синтаксна грешка: лошо срочен JSON.',
	'gwtoolset-json-error-utf8' => 'Лошо срочени знаци во UTF-8. Можеби неправилно кодирани.',
	'gwtoolset-json-error-unknown' => 'Непозната грешка.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Прифатен податотечен тип|Прифатени податотечни типови}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Проверете дали XML-податотеката е добро срочена со овој $1.',
	'gwtoolset-file-url-invalid' => 'Податотеката има неважчеки URL. Таа сè уште не постои на викито. Ќе треба прво да ја подигнете од сметачот ако сакате во образецот да користите навод за нејзиниот податотечен URL.',
	'gwtoolset-mediafile-throttle' => 'Делотворност:',
	'gwtoolset-mediafile-throttle-description' => 'По пакетниот пеглед, во чекор 3, GWToolset ги подига преостанатите записи преку позадински задачи. Делотворноста го контролира бројот на податотеки што Ризницата ќе ги подига (постава барања) на опслужвачот во дадена задача. Можете да зададете број од 1 до 20. На пример, ако во пакетното подигање сакате да подигнете вкупно 100 податотеки, а укажете делотворност 20, тоа значи дека Ризницата ќе пушти 5 позадински задачи за да го подигне целиот пакет. Временското растојание помеѓу секоја пакетна задача зависи од оптовареноста на опслужувачот и поставките. Очекуваме ова да биде барем на секои 5 минути.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'МедијаВики-шаблонот „<strong>$1</strong>“ не постои на викито.

Увезете го или одберете друг ваков шаблон за пресликување.',
	'gwtoolset-mediawiki-template-not-found' => 'МедијаВики-шаблонот „$1“ не постои.',
	'gwtoolset-metadata-file-source' => 'Изберете го изворот на метаподаточната подототека.',
	'gwtoolset-metadata-file-source-info' => '... или веќе подигната податотека или податотека што сакате да ја подигнете од вашиот сметач.',
	'gwtoolset-metadata-file-url' => 'URL на викито на медаподатоците:',
	'gwtoolset-metadata-file-upload' => 'Подигање на метаподаточна податотека:',
	'gwtoolset-metadata-mapping-bad' => 'Се јави проблем со пресликувањето на медаподатоците. Најверојатно имате неважечки JSON-формат. Обидете се да го исправите проблемот, па повторно поднесете го образецот.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'Укажаната URL за пресликување на метаподатоците не се совпаѓа со очекуваната патека.

* Укажана URL: $1
* Очекувана URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'Не пронајдов метаподаточно пресликување.

Страницата „<strong>$1<strong>“ не постои на викито.',
	'gwtoolset-namespace-mismatch' => 'Страницата „<strong>$1<strong>“ е во погрешниот именски простор „<strong>$2<strong>“.

Треба да биде во именскиот простор „<strong>$3<strong>“.',
	'gwtoolset-no-xml-element-found' => 'Не пронајдов XML-елемент за пресликување.
* Дали во образецот внесовте вредност за „{{int:gwtoolset-record-element-name}}“?
* Дали XML-податотеката е добро срочена? Пробајте го овој [$1 проверувач на XML].
$2',
	'gwtoolset-page-title-contains-url' => 'Страницата „$1“ ја содржи целата URL на викито. Се внесува само насловот на страницата, т.е. зборовите од адресата по /wiki/.',
	'gwtoolset-record-element-name' => 'Кој XML-елемент го содржи секој метаподаточен запис:',
	'gwtoolset-step-1-heading' => 'Чекор 1: Пронаоѓање на метаподатоци',
	'gwtoolset-step-1-instructions-1' => 'Постапката за подигање на метаподатоци се состои од 4 чекори:',
	'gwtoolset-step-1-instructions-2' => 'Во овој чекор {{GENDER:$1|ја подигате}} новата метаподаточна податотека на викито. Алатката ќе се обиде ги добие расположивите полиња со метаподатоци од податотеката, што потоа ќе ги пресликате во МедијаВики-шаблонот во „{{int:gwtoolset-step-2-heading}}“.',
	'gwtoolset-step-1-instructions-3' => 'Ако доменот на доменот на вашата медиумска податотека не е наведен подолу, тогаш [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment побарајте] да биде ставен во списокот на дозволени домени на Ризницата. Ако не биде на него, тогаш Ризницата нема да презема податотеки од тој домен. Најдобро е во барањето да ја наведете фактичката врска на податотеката.',
	'gwtoolset-step-1-instructions-3-heading' => 'Список на дозволени домени',
	'gwtoolset-step-1-instructions-li-1' => 'Пронаоѓање на метаподатоци',
	'gwtoolset-step-1-instructions-li-2' => 'Пресликување на метаподатоците',
	'gwtoolset-step-1-instructions-li-3' => 'Пакетен преглед',
	'gwtoolset-step-1-instructions-li-4' => 'Пакетно подигање',
	'gwtoolset-upload-legend' => 'Подигнете ја метаподаточната податотека',
	'gwtoolset-which-mediawiki-template' => 'Кој МедијаВики-шаблон:',
	'gwtoolset-which-metadata-mapping' => 'Кое метаподаточно пресликување:',
	'gwtoolset-xml-error' => 'Не успеав да го вчирам XML. Исправете ги долунаведените грешки.',
	'gwtoolset-categories' => 'Внесете ги категориите, одделувајќи ги со исправена црта („|“)',
	'gwtoolset-category' => 'Категорија',
	'gwtoolset-create-mapping' => '$1: Создавање на пресликување на метаподатоците за $2.',
	'gwtoolset-example-record' => 'Содржина на записот за пример за метаподатоци.',
	'gwtoolset-global-categories' => 'Глобални категории',
	'gwtoolset-global-tooltip' => 'Овие категориски ставки ќе се применат глобално врз сето она што е подигнато.',
	'gwtoolset-maps-to' => 'Се пресликува во',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Не можев да ја утврдам наставката на податотеката од нејзината URL: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'Не можев да ја проценам URL-адресата на медиумската податотека. Ја нуди содржината на начин што сè уште не може да се обработи со овој додаток, или пак има проблем со HTTP-барањето. Укажаната URL-адреса гласеше „$1“. Грешка во HTTP-барањето „$2“',
	'gwtoolset-mapping-no-title' => 'Медапотаточното пресликување нема наслов, кој е потребен за да се создаде страницата.',
	'gwtoolset-mapping-no-title-identifier' => 'Метаподаточното пресликување нема назнака за наслов, која е потребна за да се создаде единствен  наслов на страницата. Внимавајте да пресликате метаподаточно поле во назнаката за наслов во параметарот на МедијаВики-шаблонот.',
	'gwtoolset-metadata-field' => 'Метаподаточно поле',
	'gwtoolset-metadata-file' => 'Метаподаточна податотека',
	'gwtoolset-metadata-mapping-legend' => 'Пресликајте ги вашите метаподатоци',
	'gwtoolset-no-more-records' => '<strong>Повеќе нема записи за обработка</strong>',
	'gwtoolset-painted-by' => 'Насликано од',
	'gwtoolset-partner' => 'Партнер',
	'gwtoolset-partner-explanation' => 'Партнерските шаблони се преземаат и ставаат во полето за извор во МедијаВики-шаблонот, кога ги има. Список на тековни партнерски шаблони ќе најдете во страницата за шаблони за извори (погл. врската подолу). Штом имате партнерски шаблон што сакате да го употребите, во ова поле ставете ја неговата URL-адреса. Можете да создадете и нов партнерски шаблон, ако има потреба.',
	'gwtoolset-partner-template' => 'Партнерски шаблон:',
	'gwtoolset-phrasing' => 'Израз',
	'gwtoolset-preview' => 'Прегледајте го пакетот',
	'gwtoolset-process-batch' => 'Обработи го пакетот',
	'gwtoolset-record-count' => 'Вкупно записи пронајдени во оваа метаподаточна податотека: {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Резултати',
	'gwtoolset-step-2-heading' => 'Чекор 2: Пресликување на метаподатоците',
	'gwtoolset-step-2-instructions-heading' => 'Пресликување на метаподаточните полиња',
	'gwtoolset-step-2-instructions-1' => 'Подолу има:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Список на полиња МедијаВики-шаблонот „$1“.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Расклопни полиња што ги претставуваат полињата во метаподаточната податотека.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Пример за запис од метаподаточната податотека.',
	'gwtoolset-step-2-instructions-2' => 'Во овој чекор ќе треба да ги пресликате метаподататочните полиња од полињата од МедијаВики-шаблонот.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Одберете медатподаточно поле од колоната „{{int:gwtoolset-maps-to}}“ што соодветствува на полето во МедијаВики-шаблонот во колоната „{{int:gwtoolset-template-field}}“.',
	'gwtoolset-step-2-instructions-2-li-2' => 'Не морате да дадете совпаѓања за сите полиња во МедијаВики-шаблонот.',
	'gwtoolset-reupload-media' => 'Преподигни ја податотеката од URL',
	'gwtoolset-reupload-media-explanation' => 'Овој штикларник ви овозможува да преподигате медиумски податотеки (слики и снимки) за објект што веќе е подигнат на викито. Ако објектот веќе постои, во викито ќе биде додадена уште една податотека. Ако истата сè уште не постои, ќе биде подигната без оглед на тоа дали е штиклирано полево.',
	'gwtoolset-specific-categories' => 'Наменски категории за објекти',
	'gwtoolset-specific-tooltip' => 'Со следниве полиња можете да укажете израз (незадолжително) како и категориски запис за секој поединечен подигнат објект. На пример, ако метаподаточната податотека содржи елемент за изведувач во секој запис, можете да го додадете како категориски запис кај секој од нив, што ќе ја смени вредноста што се однесува на секој од записите. Можете и да додадете израз како „<em>{{int:gwtoolset-painted-by}}</em>“, а потоа метаподаточното поле за изведувач, што би дало „<em>{{int:gwtoolset-painted-by}} <име на изведувачот></em>“ како категорија за секој запис.',
	'gwtoolset-template-field' => 'Шаблонско поле',
	'gwtoolset-step-3-instructions-heading' => 'Step 3: Преглед на пакетот',
	'gwtoolset-step-3-instructions-1' => 'Подолу се наведени резултатите од подигањето на {{PLURAL:$1|првиот запис|првите $1 записи}} од метаподаточната податотека што ја одбравте и {{PLURAL:$1|неговото|нивните}} пресликувања од МедијаВики-шаблонот што го одбравте во „{{int:gwtoolset-step-2-heading}}“.',
	'gwtoolset-step-3-instructions-2' => 'Прегледајте ги странициве и, ако резултатите одговараат на вашите очекувања и има уште записи што чекаат на подигање, продолжете со пакетното подигање, стискајќи на копчето „{{int:gwtoolset-process-batch}}“ подолу.',
	'gwtoolset-step-3-instructions-3' => 'Ако не ви се допаѓаат резултатите, вратете се на „{{int:gwtoolset-step-2-heading}}“ и прилагодете го пресликувањето.

Ако треба да ја прилагодите самата метаподаточна податотека, тогаш направете го тоа, па преподигнете ја, започнувајќи ја постапката одново со „{{int:gwtoolset-step-1-heading}}“.',
	'gwtoolset-title-bad' => 'Создадениот наслов, заснован на пресликувањето од МедијаВики-шаблонот и метаподатоците не е важечки.

Пробајте со друго поле од метаподатоците за наслов и наслов-назнака, или, ако е можно, изменете ги метаподатоците според потребите. Повеќе информации ќе добиете на страницата „[https://commons.wikimedia.org/wiki/Commons:File_naming Именување на податотеки]“.

<strong>Неважечки наслов:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Создадена е пакетната задача за метаподатоците. Вашата метаподаточна податотека ќе биде набргу изанализирана, па секој објект ќе биде подигнат на викито со позадинска постапка. Можете да ја погледнете страницата „$1“ за да видите дали се подигнати.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Не можев да создадам пакетна задача за метаподаточната податотека.',
	'gwtoolset-create-mediafile' => '$1: Создавање на медиумска податотека за $2.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => '{{PLURAL:$1|Создадена е една пакетна задача|Создадени се $1 пакетни задачи}} за медиумски податотеки.',
	'gwtoolset-step-4-heading' => 'Чекор 4: Збирно подигање',
	'gwtoolset-invalid-token' => 'Шифрата на уредувањето поднесена со образецот е неважечка.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Тековни поставки на <code>php.ini</code>:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Тие се зададени пониско од <code>$wgMaxUploadSize</code> на викито, што е зададено на „$3“. Прилагодете ги поставките на <code>php.ini</code>.',
	'gwtoolset-mediawiki-version-invalid' => 'Додатоков бара МедијаВики со верзија $1<br />Оваа верзија е $2.',
	'gwtoolset-permission-not-given' => 'Проверете дали сте најавени или обратете се кај администратор за да ви даде дозвола да ја гледате страницава ($1).',
	'gwtoolset-user-blocked' => 'Вашата корисничка сметка е моментално блокирана. Обратете се кај администратор за да го средите проблемот.',
	'gwtoolset-required-group' => 'Не членувате во групата „$1“.',
	'gwtoolset-verify-api-enabled' => 'Додатокот „$1“ бара да е овозможен википрилогот (API).

Проверете дали <code>$wgEnableAPI</code> е наместено на <code>true</code> во податотеката <code>DefaultSettings.php</code> или пак е заменето со <code>true</code> во податотеката <code>LocalSettings.php</code>.',
	'gwtoolset-verify-api-writeable' => 'Додатокот „$1“ бара википрилогот да може да запишува за овластени корисници.

Внимавајте <code>$wgEnableWriteAPI</code> да биде наместено на <code>true</code> во податотеката <code>DefaultSettings.php</code> или пак да е презапишано со <code>true</code> во податотеката <code>LocalSettings.php</code>.',
	'gwtoolset-verify-curl' => 'Додатокот „$1“ бара да бидат воспоставени [http://www.php.net/manual/en/curl.setup.php функциите на cURL] во PHP.',
	'gwtoolset-verify-finfo' => 'Додатокот „$1“ бара да е воспоставен додатокот „[http://www.php.net/manual/en/fileinfo.setup.php finfo]“ за PHP.',
	'gwtoolset-verify-php-version' => 'Додатокот „$1“ бара PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'Додатокот „$1“ бара да е овозможено подигање на податотеки.

Проверете дали <code>$wgEnableUploads</code> е наместено на <code>true</code> во <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'Додатокот $1 бара воспоставен [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] со PHP.',
	'gwtoolset-wiki-checks-not-passed' => 'Не пројде на проверките на викито',
);

/** Marathi (मराठी)
 * @author V.narsikar
 */
$messages['mr'] = array(
	'gwtoolset-mapping-media-file-url-bad' => 'माध्यम संचिका URLचे मुल्यांकन करता आले नाही.ती URL असे आशय उपजते जे या विस्तारकाने अद्यापपावेतो हाताळले नाही किंवा HTTP विनंतीचा मुद्या उद्भवला आहे.दिलेली URL "$1" होती. HTTP विनंती त्रूटी "$2"',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, alat muat naik pukal untuk galeri, perpustakaan, arkib dan muzium',
	'gwtoolset-intro' => 'GWToolset merupakan sambungan MediaWiki yang membolehkan GLAM (Galeri, Perpustakaan, Arkib dan Muzium) untuk memuat naik kandungan secara pukal berasaskan satu fail XML yang mengandungi metadata untuk kandungan masing-masing. Tujuannya adalah membolehkan berbagai-bagai skema XML. Maklumat lanjut tentang projek ini boleh ditemui di [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project halaman projeknya]. Jangan rasa segan untuk menghubungi kami di halaman itu juga. Pilih salah satu perkara menu di atas untuk memulakan pemuatnaikan.',
	'gwtoolset-batchjob-creation-failure' => 'Tugas kelompok jenis "$1" tidak dapat diwujudkan.',
	'gwtoolset-could-not-close-xml' => 'Pembaca XML tidak dapat ditutup.',
	'gwtoolset-could-not-open-xml' => 'Fail XML tidak dapat dibuka untuk dibaca.',
	'gwtoolset-developer-issue' => 'Sila hubungi pemaju. Isu ini mesti ditangani sebelum anda boleh teruskan. Sila tambahkan teks yang berikut kepada laporan anda:

$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, atau <code>record-count</code>, atau <code>record-current</code> tidak disediakan.',
	'gwtoolset-file-backend-maxage-invalid' => 'Nilai umur maksimum yang dinyatakan dalam <code>$wgGWTFBMaxAge</code> adalah tidak sah.
Rujuk [php.net/manual/en/datetime.formats.relative.php manual PHP] untuk cara menetapkannya dengan betul.',
	'gwtoolset-fsfile-empty' => 'Fail ini kosong dan telah dihapuskan.',
	'gwtoolset-fsfile-retrieval-failure' => 'Fail tidak dapat diperoleh dari URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> tidak ditetapkan.',
	'gwtoolset-incorrect-form-handler' => 'Modul "$1" belum mendaftarkan pengelola barang yang melanjutkan GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'Pendikit tugas kelompok dilampaui.',
	'gwtoolset-no-accepted-types' => 'Tiada jenis diterima yang disediakan',
	'gwtoolset-no-callback' => 'Tiada panggilan balik disampaikan kepada kaedah ini.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> tidak ditetapkan.",
	'gwtoolset-no-default' => 'Tiada nilai azali disediakan.',
	'gwtoolset-no-file-backend-name' => 'Tiada nama belakang fail disediakan.',
	'gwtoolset-no-file-backend-container' => 'Tiada nama wadah belakang fail disediakan.',
	'gwtoolset-no-file-url' => 'Tiada <code>file_url</code> disediakan untuk dihuraikan.',
	'gwtoolset-no-form-handler' => 'Tiada pengelola borang diwujudkan.',
	'gwtoolset-no-mapping' => 'Tiada <code>mapping_name</code> disediakan.',
	'gwtoolset-no-mapping-json' => 'Tiada <code>mapping_json</code> disediakan.',
	'gwtoolset-no-max' => 'Tiada nilai maksimum disediakan.',
	'gwtoolset-no-mediafile-throttle' => 'Tiada pendikit tugas fail media disediakan.',
	'gwtoolset-no-mediawiki-template' => 'Tiada <code>mediawiki-template-name</code> disediakan.',
	'gwtoolset-no-min' => 'Tiada nilai minimum disediakan.',
	'gwtoolset-no-mwstore-complete-path' => 'Tiada laluan fail lengkap disediakan.',
	'gwtoolset-no-mwstore-relative-path' => 'Tiada laluan relatif disediakan.',
	'gwtoolset-no-page-title' => 'Tiada tajuk halaman disediakan.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> tidak ditetapkan.",
	'gwtoolset-no-template-url' => 'Tiada URL templat disediakan untuk dihuraikan.',
	'gwtoolset-no-text' => 'Tiada teks disediakan.',
	'gwtoolset-no-title' => 'Tiada tajuk disediakan.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> tidak ditetapkan.",
	'gwtoolset-no-url-to-evaluate' => 'Tiada URL disediakan untuk penilaian.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> tidak ditetapkan.',
	'gwtoolset-no-user' => 'Tiada objek pengguna disediakan.',
	'gwtoolset-no-xml-source' => 'Tiada sumber XML tempatan disediakan.',
	'gwtoolset-not-string' => 'Nilai yang disediakan pada kaedah bukan rentetan. Ia adalah jenis "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 tidak sepadan.',
	'gwtoolset-disk-write-failure' => 'Pelayan tidak dapat menuliskan fail ini kepada sistem fail.',
	'gwtoolset-xml-doctype' => 'Fail metadata XML tidak boleh mengandungi bahagian <!DOCTYPE>. Alihnya keluar dan cuba memuat naik fail metadata XML itu semula.',
	'gwtoolset-file-is-empty' => 'Fail yang dimuat naik itu kosong.',
	'gwtoolset-improper-upload' => 'Fail tidak dimuat naik dengan betul.',
	'gwtoolset-mime-type-mismatch' => 'Sambungan fail "$1" dan MIME jenis "$2" pada fail yang dimuat naik tidak sepadan.',
	'gwtoolset-missing-temp-folder' => 'Tiada folder sementara disediakan.',
	'gwtoolset-multiple-files' => 'Fail yang dimuat naik ini mengandungi maklumat untuk lebih daripada satu fail. Hanya satu fail boleh diserahkan pada satu masa.',
	'gwtoolset-no-form-field' => 'Ruangan borang "$1" yang dijangka tidak wujud.',
	'gwtoolset-over-max-ini' => 'Fail yang telah dimuat naik ini melebihi <code>upload_max_filesize</code> dan/atau arahan <code>post_max_size</code> dalam <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Fail ini telah dimuat baik separa-separa sahaja.',
	'gwtoolset-php-extension-error' => 'Pemuatnaikan fail dihentikan oleh sambungan PHP. PHP tidak menyediakan cara untuk menentukan sambungan mana yang menyebabkan pemuatnaikan terhenti. Penyemakan senarai sambungan yang dimuat dengan <code>phpinfo()</code> mungkin membantu.',
	'gwtoolset-unaccepted-extension' => 'Sumber fail tidak mengandungi sambungan fail yang diterima.',
	'gwtoolset-unaccepted-extension-specific' => 'Sumber fail mempunyai sambungan fail ".$1" yang tidak diterima.',
	'gwtoolset-unaccepted-mime-type' => 'Fail yang dimuat naik ditafsir sebagai memiliki MIME jenis "$1" yang bukan jenis MIME yang diterima.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Fail yang dimuat naik mempunyai MIME jenis "$1" yang tidak diterima. Adakah fail XML itu mempunyai akuan XML di bahagian atasnya?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← kembali ke borang',
	'gwtoolset-back-text' => 'Tekan butang undur (back) pelayar untuk kembali ke borang.',
	'gwtoolset-file-interpretation-error' => 'Terdapat masalah ketika memproseskan fail metadata ini',
	'gwtoolset-mediawiki-template' => 'Templat $1',
	'gwtoolset-metadata-user-options-error' => '{{PLURAL:$2|Ruangan|Ruangan-ruangan}} borang yang berikut wajib diisi:
$1',
	'gwtoolset-menu-1' => 'Pemetaan metadata',
	'gwtoolset-technical-error' => 'Terdapat kesilapan teknikal.',
	'gwtoolset-required-field' => 'menandakan ruangan yang perlu diisi',
	'gwtoolset-submit' => 'Hantar',
	'gwtoolset-summary-heading' => 'Ringkasan',
	'gwtoolset-cancel' => 'Batalkan',
	'gwtoolset-loading' => 'Harap bersabar. Ini mungkin mengambil sedikit masa.',
	'gwtoolset-save' => 'Simpan',
	'gwtoolset-save-mapping' => 'Simpan pemetaan',
	'gwtoolset-save-mapping-failed' => 'Maaf, terdapat masalah ketika memproses permintaan anda. Sila cuba lagi kemudian. (Pesanan ralat: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Pemetaan anda telah disimpan.',
	'gwtoolset-save-mapping-name' => 'Namakan pemetaan ini',
	'gwtoolset-json-error' => 'Terdapat masalah dengan JSON. Ralat: $1',
	'gwtoolset-json-error-depth' => 'Kedalaman timbunan melebihi maksimum.',
	'gwtoolset-json-error-ctrl-char' => 'Terdapat aksara kawalan yang tidak dijangka.',
	'gwtoolset-json-error-utf8' => 'Aksara UTF-8 cacat, mungkin dikodkan dengan tidak betul.',
	'gwtoolset-json-error-unknown' => 'Ralat yang tidak dikenali.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Jenis|Jenis-jenis}} fail yang diterima:',
	'gwtoolset-ensure-well-formed-xml' => 'Pastikan fail XML dibentuk sempurna dengan $1 ini.',
	'gwtoolset-file-url-invalid' => 'URL fail ini tidak sah; fail berkenaan belum wujud di wiki ini. Anda perlu memuat naik fail dari komputer terlebih dahulu jika anda ingin menggunakan rujukan URL fail di dalam borang.',
	'gwtoolset-mediafile-throttle' => 'Pendikit fail media:',
	'gwtoolset-mediafile-throttle-description' => 'Pendikit ini mengawal muatan yang akan diletakkan oleh Wikimedia Commons ke dalam pelayan median anda sewaktu pemuatnaikan berkelompok. Anda boleh melaraskan pendikit dari 1 hingga 20, iaitu bilangan permintaan media seminit.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Templat MediaWiki "<strong>$1</strong>" tidak wujud di dalam wiki ini.

Import templat itu atau pilih templat MediaWiki yang lain untuk digunakan untuk pemetaan.',
	'gwtoolset-mediawiki-template-not-found' => 'Templat MediaWiki "$1" tidak dijumpai.',
	'gwtoolset-metadata-file-source' => 'Pilih sumber fail metadata.',
	'gwtoolset-metadata-file-source-info' => '... sama ada fail yang dimuat naik terdahulu atau fail yang ingin anda muat naik dari komputer anda.',
	'gwtoolset-metadata-file-url' => 'URL wiki fail metadata:',
	'gwtoolset-metadata-file-upload' => 'Muat naik fail metadata:',
	'gwtoolset-metadata-mapping-bad' => 'Terdapat masalah dengan pemetaan metadata. Mungkin sekali format JSON-nya tidak sah. Cuba betulkan masalah ini, kemudian serahkan semula borang ini.

$1',
	'gwtoolset-metadata-mapping-not-found' => 'Tiada pemetaan metadata dijumpai.

Halaman "<strong>$1<strong>" tidak wujud di dalam wiki ini.',
	'gwtoolset-namespace-mismatch' => 'Halaman "<strong>$1<strong>" berada di ruang nama yang salah, iaitu "<strong>$2<strong>".

Ia seharusnya berada di ruang nama "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'Tiada elemen XML dijumpai untuk pemetaan.
* Adakah anda memasukkan nilai dalam borang untuk "{{int:gwtoolset-record-element-name}}"?
* Adakah fail, XML itu dibentuk dengan sempurna? Cuba $1 ini.',
	'gwtoolset-page-title-contains-url' => 'Halaman "$1" mengandungi URL seluruh wiki. Pastikan hanya tajuk halaman yang diisikan, cth. bahagian URL selepas /wiki/',
	'gwtoolset-record-element-name' => 'Elemen XML yang mengandungi setiap rekod metadata:',
	'gwtoolset-step-1-heading' => 'Langkah 1: Pengesanan metadata',
	'gwtoolset-step-1-instructions-1' => 'Proses pemuatnaikan metadata terdiri daripada 4 langkah:',
	'gwtoolset-step-1-instructions-2' => 'Dalam langkah ini, anda memuat naik fail metadata baru ke dalam wiki. Alatan akan cuba mengeluarkan medan-medan metadata yang terdapat dalam fail metadata itu, yang anda akan kemudian petakan pada templat Mediawiki dalam "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3' => 'Jika domain fail media anda tidak tersenarai di bawah, sila [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment memohon] supaya domain fail media anda ditambahkan ke dalam senarai putih domain Wikimedia Commons. Senarai putih domain merupakan senarai domain yang disemak oleh Wikimedia Commons sebelum menerima fail media. Jika domain fail media anda tidak tersenarai, Wikimedia Commons tidak akan memuat turun fail media dari domain itu. Contoh yang terbaik untuk disertakan dalam penyerahan permohonan anda adalah pautan sebenar kepada fail media.',
	'gwtoolset-step-1-instructions-3-heading' => 'Senarai putih domain',
	'gwtoolset-step-1-instructions-li-1' => 'Pengesanan metadata',
	'gwtoolset-step-1-instructions-li-2' => 'Pemetaan metadata',
	'gwtoolset-step-1-instructions-li-3' => 'Previu kelompok',
	'gwtoolset-step-1-instructions-li-4' => 'Muat naik berkelompok',
	'gwtoolset-upload-legend' => 'Muat naik fail metadata anda',
	'gwtoolset-which-mediawiki-template' => 'Templat MediaWiki:',
	'gwtoolset-which-metadata-mapping' => 'Pemetaan metadata:',
	'gwtoolset-xml-error' => 'XML gagal dimuatkan. Sila betulkan ralat-ralat yang berikut.',
	'gwtoolset-categories' => 'Isikan kategori-kategori secara dipisahkan dengan aksara jalur tegak ("|")',
	'gwtoolset-category' => 'Kategori',
	'gwtoolset-create-mapping' => '$1: Melakukan pemetaan metadata untuk $2.',
	'gwtoolset-example-record' => 'Kandungan rekod contoh metadata.',
	'gwtoolset-global-categories' => 'Kategori sejagat',
	'gwtoolset-global-tooltip' => 'Entri-entri kategori ini akan digunakan pada kesemua perkara yang dimuat naik secara sejagat.',
	'gwtoolset-maps-to' => 'Dipetakan kpd',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Sambungan fail tidak dapat ditentukan daripada URL fail: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'URL fail media tidak dapat dinilai. URL menyampaikan kandungan secara yang belum dapat dikelola oleh sambungan ini. URL yang diberikan ialah "$1".',
	'gwtoolset-mapping-no-title' => 'Pemetaan metadata tertinggal tajuknya yang diperlukan untuk mewujudkan halamannya.',
	'gwtoolset-mapping-no-title-identifier' => 'Pemetaan metadata tidak mengandungi pengecam tajuk yang digunakan untuk mewujudkan tajuk halaman yang unik. Pastikan anda memetakan medan metadata kepada pengecam tajuk parameter templat MediaWiki.',
	'gwtoolset-metadata-field' => 'Medan metadata',
	'gwtoolset-metadata-mapping-legend' => 'Petakan metadata anda',
	'gwtoolset-painted-by' => 'Dilukis oleh',
	'gwtoolset-partner' => 'Rakan Kongsi',
	'gwtoolset-partner-explanation' => 'Templat pekongsi ditarik ke dalam medan sumber templat MediaWiki apabila disediakan. Anda boleh mendapati satu senarai templat rakan kongsi semasa pada halaman Kategori:Templat sumber; rujuk pautan di bawah. Setelah menjumpai templat pekongsi yang ingin anda gunakan, letakkan URL-nya ke dalam medan ini. Anda juga boleh mewujudkan templat pekongsi baru jika perlu.',
	'gwtoolset-partner-template' => 'Templat pekongsi:',
	'gwtoolset-phrasing' => 'Pernyataan',
	'gwtoolset-preview' => 'Previu kelompok',
	'gwtoolset-process-batch' => 'Proses kelompok',
	'gwtoolset-results' => 'Hasil',
	'gwtoolset-step-2-heading' => 'Langkah 2: Pemetaan metadata',
	'gwtoolset-step-2-instructions-heading' => 'Memetakan medan-medan metadata',
	'gwtoolset-step-2-instructions-1' => 'Yang berikut ialah:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Senarai medan dalam MediaWiki $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Ruangan juntai yang mewakili medan-medan metadata yang terdapat pada fail metadata.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Contoh rekod dari fail metadata.',
	'gwtoolset-step-2-instructions-2' => 'Dalam langkah ini, anda perlu memetakan medan-medan metadata dengan medan-medan templat MediaWiki.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Pilih medan metadata di bawah lajur "{{int:gwtoolset-maps-to}}" yang berpadanan dengan medan templat MediaWiki di bawah lajur "{{int:gwtoolset-template-field}}".',
	'gwtoolset-step-2-instructions-2-li-2' => 'Anda tidak perlu menyediakan padanan untuk setiap medan templat MediaWiki.',
	'gwtoolset-reupload-media' => 'Muat naik semula media dari URL',
	'gwtoolset-reupload-media-explanation' => 'Petak pilihan ini membolehkan anda untuk memuat naik semula media untuk sesuatu perkara yang sudah dimuat naik ke dalam wiki. Jika perkara itu sudah wujud, maka fail media tambahan akan diletakkan pada wiki berkenaan. Jika fail media itu belum wujud, ia akan dimuat naik tidak kira sama ada petak pilihan ini ditandai atau tidak.',
	'gwtoolset-specific-categories' => 'Kategori khusus perkara',
	'gwtoolset-template-field' => 'Ruangan templat',
	'gwtoolset-step-3-instructions-heading' => 'Step 3: Previu kelompok',
	'gwtoolset-step-3-instructions-1' => 'Yang berikut adalah hasil pemuatnaikan {{PLURAL:$1|rekod pertama|$1 rekod pertama}} dari fail metadata yang telah anda pilih lalu memetakannya kepada templat MediaWiki yang telah anda pilih dalam "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-3-instructions-2' => 'Sila semak halaman-halaman ini. Jika hasilnya memenuhi kehendak anda, malah terdapat rekod-rekod tambahan untuk dimuat naik, sambung proses pemuatnaikan kelompok dengan mengklik butang "{{int:gwtoolset-process-batch}}" di bawah.',
	'gwtoolset-step-3-instructions-3' => 'Jika anda tidak berpuas hati dengan hasilnya, kembali ke "{{int:gwtoolset-step-2-heading}}" dan laraskan pemetaan sewajarnya.

Jika anda perlu melaraskan fail metadata itu sendiri, silakan berbuat demikian dan muat naiknya semula dengan memulakan semula proses dengan "{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => 'Tajuk yang diwujudkan berasaskan pemetaan metadata dan templat MediaWiki itu adalah tidak sah.

Cuba medan lain dari metadata untuk tajuk dan pengecam tajuk, atau jika boleh, ubah metadatanya di mana perlu. Rujuk [https://commons.wikimedia.org/wiki/Commons:File_naming Penamaan fail] untuk maklumat lanjut.

<strong>Tajuk tak sah:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Tugas kelompok Metadata diwujudkan. Fail metadata anda akan dianalisa sebentar nanti dan setiap perkara akan dimuat naik ke dalam wiki melalui proses latar belakang. Anda boleh melayari halaman "$1" untuk melihat bila perkara-perkara itu telah dimuat naik.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Tugas kelompok tidak dapat diwujudkan untuk fail metadata.',
	'gwtoolset-step-4-heading' => 'Langkah 4: Muat naik berkelompok',
	'gwtoolset-invalid-token' => 'Token suntingan yang diserahkan dengan borang ini adalah tidak sah.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Tetapan <code>php.ini</code> semasa:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Ini ditetapkan lebih rendah daripada <code>$wgMaxUploadSize</code> wiki yang ditetapkan pada "$3". Sila laras tetapan <code>php.ini</code> sewajarnya.',
	'gwtoolset-mediawiki-version-invalid' => 'Sambungan ini memerlukan MediaWiki versi $1<br />Ini ialah versi $2.',
	'gwtoolset-no-upload-by-url' => 'Anda bukan anggota kumpulan yang berhak untuk memuat naik melalui URL.',
	'gwtoolset-permission-not-given' => 'Pastikan anda telah log masuk atau hubungi penyelia untuk mendapat kebenaran untuk melihat halaman ini ($1).',
	'gwtoolset-user-blocked' => 'Akaun pengguna anda sedang disekat. Sila hubungi penyelia untuk meleraikan isu sekatan ini.',
	'gwtoolset-required-group' => 'Anda bukan ahli kumpulan $1.',
	'gwtoolset-verify-api-enabled' => 'Sambungan $1 memerlukan API wiki dihidupkan.

Sila pastikan bahawa <code>$wgEnableAPI</code> disetkan kepada <code>true</code> dalam fail <code>DefaultSettings.php</code> atau ditulis ganti kepada <code>true</code> dalam fail <code>LocalSettings.php</code>.',
	'gwtoolset-verify-api-writeable' => 'Sambungan $1 memerlukan API wiki untuk dapat melakukan penulisan untuk pengguna berdaftar.

Sila pastikan bahawa <code>$wgEnableWriteAPI</code> disetkan pada <code>true</code> dalam fail <code>DefaultSettings.php</code> atau ditulis ganti kepada <code>true</code> dalam fail <code>LocalSettings.php</code>.',
	'gwtoolset-verify-curl' => 'Sambungan $1 memerlukan pemasangan fungsi-fungsi PHP [http://www.php.net/manual/en/curl.setup.php cURL].',
	'gwtoolset-verify-finfo' => 'Sambungan $1 memerlukan pemasangan sambungan PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo].',
	'gwtoolset-verify-php-version' => 'Sambungan $1 memerlukan PHP versi 5.3.3 ke atas.',
	'gwtoolset-verify-uploads-enabled' => 'Sambungan $1 memerlukan pemuatnaikan fail dihidupkan.

Sila pastikan bahawa <code>$wgEnableUploads</code> disetkan kepada <code>true</code> dalam <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'Sambungan $1 memerlukan pemasangan PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader].',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki tidak lulus pemeriksaan',
);

/** Neapolitan (Napulitano)
 * @author Chelin
 */
$messages['nap'] = array(
	'action-gwtoolset' => 'ausare GWToolset',
	'gwtoolset-mediawiki-template' => 'Modello $1',
	'gwtoolset-required-group' => 'Nun sii membro d"o gruppo utente $1.',
);

/** Dutch (Nederlands)
 * @author Arent
 * @author AvatarTeam
 * @author Multichill
 * @author Siebrand
 * @author Sjoerddebruin
 * @author Southparkfan
 */
$messages['nl'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, een hulpprogramma voor het massaal uploaden van bestanden',
	'gwtoolset-intro' => "GWToolset is een MediaWiki-extensie die GLAMs (Galleries, Bibliotheken, archieven en musea) de mogelijkheid biedt om een verzameling mediabestanden te uploaden op basis van een XML-bestand met respectievelijke metagegevens over de inhoud. Het is de bedoeling om verschillende XML-schema's te accepteren. Meer informatie over het project kan worden gevonden op de [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project projectpagina]. Voel je ook vrij om contact met ons op te nemen middels die pagina. Selecteer een van de menu-items hierboven om te beginnen met het upload-proces.",
	'right-gwtoolset' => 'GLAMWiki Toolset gebruiken',
	'action-gwtoolset' => 'GLAMWiki Toolset te gebruiken',
	'group-gwtoolset' => 'GWToolsetgebruikers',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolsetgebruiker}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolsetgebruikers',
	'gwtoolset-batchjob-creation-failure' => 'Het is niet gelukt om batchverwerking van type "$1" aan te maken.',
	'gwtoolset-could-not-close-xml' => 'De XML-lezer kan niet worden gesloten.',
	'gwtoolset-could-not-open-xml' => 'Het is niet gelukt om het XML-bestand voor lezen te openen.',
	'gwtoolset-developer-issue' => 'Neem contact op met een ontwikkelaar. Dit probleem moet worden aangepakt voordat u kunt doorgaan. Voeg de volgende tekst aan het rapport:

$1',
	'gwtoolset-fsfile-empty' => 'Het bestand was leeg en is verwijderd.',
	'gwtoolset-fsfile-retrieval-failure' => 'Het bestand kon niet worden opgehaald vanaf URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> is niet ingesteld.',
	'gwtoolset-no-default' => 'Geen standaardwaarde gekozen.',
	'gwtoolset-no-field-size' => 'Geen veldgrootte opgegeven voor het veld "$1".',
	'gwtoolset-no-file-backend-name' => 'Er is geen naam voor een bestandsbackend opgegeven.',
	'gwtoolset-no-file-backend-container' => 'Er is geen naam voor een bestandsbackendcontainer opgegeven.',
	'gwtoolset-no-file-url' => 'Er is geen <code>file_url</code> opgegeven om te verwerken.',
	'gwtoolset-no-form-handler' => 'Er is geen formulierafhandelaar aangemaakt.',
	'gwtoolset-no-mapping' => 'Er is geen <code>mapping_name</code> opgegeven.',
	'gwtoolset-no-mapping-json' => 'Er is geen <code>mapping_json</code> opgegeven.',
	'gwtoolset-no-max' => 'Er is geen maximale waarde opgegeven.',
	'gwtoolset-no-mediawiki-template' => 'Er is geen <code>mediawiki-template-name</code> opgegeven.',
	'gwtoolset-no-min' => 'Er is geen minimale waarde opgegeven.',
	'gwtoolset-no-module' => 'Er is geen modulenaam opgegeven.',
	'gwtoolset-no-mwstore-complete-path' => 'Er is geen volledig bestandspad opgegeven.',
	'gwtoolset-no-mwstore-relative-path' => 'Er is geen relatief pad opgegeven.',
	'gwtoolset-no-page-title' => 'Er is geen paginanaam opgegeven.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> is niet ingesteld.",
	'gwtoolset-no-source-array' => 'Er is geen bronverzameling opgegeven.',
	'gwtoolset-no-summary' => 'Er is geen samenvatting opgegeven.',
	'gwtoolset-no-template-url' => 'Er is geen sjabloon-URL opgegeven om te verwerken.',
	'gwtoolset-no-text' => 'Er is geen tekst opgegeven.',
	'gwtoolset-no-title' => 'Er is geen naam opgegeven.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> is niet ingesteld.",
	'gwtoolset-no-url-to-evaluate' => 'Er is geen URL opgegeven voor evaluatie.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> is niet ingesteld.',
	'gwtoolset-no-user' => 'Geen gebruikersobject opgegeven.',
	'gwtoolset-no-xml-element' => 'Geen XMLReader of DOMElement opgegeven.',
	'gwtoolset-no-xml-source' => 'Geen lokale XML-bron opgegeven.',
	'gwtoolset-not-string' => 'De opgegeven waarde voor de methode was geen tekst, maar van het type "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 komt niet overeen.',
	'gwtoolset-disk-write-failure' => 'De server kan het bestand niet schrijven naar een bestandssysteem.',
	'gwtoolset-file-is-empty' => 'Het geüploade bestand is leeg.',
	'gwtoolset-improper-upload' => 'De bestandsupload is mislukt.',
	'gwtoolset-mime-type-mismatch' => 'De bestandsextensie "$1" het MIME-type "$2" van het geüploade bestand komen niet overeen.',
	'gwtoolset-missing-temp-folder' => 'Geen tijdelijke map beschikbaar.',
	'gwtoolset-no-file' => 'Er is geen bestand ontvangen.',
	'gwtoolset-no-form-field' => 'Het verwachte formulierveld "$1" bestaat niet.',
	'gwtoolset-partial-upload' => 'Het bestand is slechts gedeeltelijk geüpload.',
	'gwtoolset-back-text-link' => '← terug naar het formulier',
	'gwtoolset-mediawiki-template' => 'Sjabloon $1',
	'gwtoolset-metadata-invalid-template' => 'Geen geldig MediaWiki sjabloon gevonden.',
	'gwtoolset-menu-1' => 'Metadatakoppeling',
	'gwtoolset-technical-error' => 'Er is een technische fout opgetreden.',
	'gwtoolset-required-field' => 'vereist veld',
	'gwtoolset-submit' => 'Opslaan',
	'gwtoolset-summary-heading' => 'Samenvatting',
	'gwtoolset-cancel' => 'Annuleren',
	'gwtoolset-loading' => 'Even geduld. Dit kan even duren.',
	'gwtoolset-save' => 'Opslaan',
	'gwtoolset-save-mapping' => 'Koppelingen opslaan',
	'gwtoolset-save-mapping-failed' => 'Er is helaas een probleem opgetreden tijdens de verwerking van uw aanvraag. Probeer het later nog eens. Foutbericht: $1.',
	'gwtoolset-save-mapping-succeeded' => 'Uw koppelingen zijn opgeslagen',
	'gwtoolset-save-mapping-name' => 'Hoe wilt u deze verzameling koppelingen noemen?',
	'gwtoolset-json-error' => 'Er was een probleem met de JSON. Fout: $1.',
	'gwtoolset-json-error-depth' => 'Maximale stapeldiepte overschreden.',
	'gwtoolset-json-error-unknown' => 'Onbekende fout.',
	'gwtoolset-step-1-heading' => 'Stap 1: Metadata detecteren',
	'gwtoolset-step-1-instructions-li-4' => 'Massale upload',
	'gwtoolset-category' => 'Categorie',
	'gwtoolset-global-categories' => 'Globale categorieën',
	'gwtoolset-no-more-records' => '<strong>Geen records meer te verwerken</strong>',
	'gwtoolset-painted-by' => 'Geschilderd door',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-template' => 'Partnersjabloon:',
	'gwtoolset-results' => 'Resultaten',
	'gwtoolset-step-2-heading' => 'Stap 2: Metadata toewijzen',
	'gwtoolset-step-2-instructions-heading' => 'Metadatavelden koppelen',
	'gwtoolset-step-2-instructions-1' => 'Hieronder is/zijn:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Een lijst van de velden in de MediaWikipagina $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Keuzelijstvelden die gevonden zijn in het bestand met metadata die de metadatavelden representeren .',
	'gwtoolset-step-2-instructions-1-li-3' => 'Een voorbeeldrecord van het metadatabestand.',
	'gwtoolset-step-2-instructions-2' => 'In deze stap moet ik de metadatavelden koppelen met een velden uit de MediaWikisjabloon.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Selecteer een metadataveld in de kolom "{{int:gwtoolset-maps-to}}" dat overeenkomt met een veld in de MediaWikisjabloon in de kolom "{{int:gwtoolset-template-field}}".',
	'gwtoolset-step-2-instructions-2-li-2' => 'U hoeft niet voor ieder MediaWikisjabloonveld een koppeling te maken.',
	'gwtoolset-reupload-media' => 'Media opnieuw uploaden van URL',
	'gwtoolset-reupload-media-explanation' => 'Door dit selectievakje aan te vinken kunt u media opnieuw uploaden voor een item dat al is geüpload naar de wiki. Als het item al bestaat, wordt een extra mediabestand toegevoegd aan de wiki. Als het mediabestand nog niet bestaat, wordt het geüpload of dit selectievakje is ingeschakeld of niet.',
	'gwtoolset-specific-categories' => 'Itemspecifieke categorieën',
	'gwtoolset-template-field' => 'Sjabloonveld',
	'gwtoolset-step-3-instructions-heading' => 'Stap 3: Voorvertoning van de taak',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-required-group' => 'U bent geen lid van de groep $1.',
	'gwtoolset-verify-php-version' => 'De $1-extensie vereist PHP 5.3.3 of hoger.',
);

/** Polish (polski)
 * @author Chrumps
 * @author Jacenty359
 * @author Rzuwig
 */
$messages['pl'] = array(
	'right-gwtoolset' => 'Używanie GWToolset',
	'group-gwtoolset' => 'Użytkownicy GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset użytkownik}}',
	'gwtoolset-fsfile-empty' => 'Plik był pusty i został skasowany.',
	'gwtoolset-no-page-title' => 'Nie podano tytułu strony.',
	'gwtoolset-no-file' => 'Plik nie został odebrany.',
	'gwtoolset-partial-upload' => 'Plik został tylko częściowo przesłany.',
	'gwtoolset-back-text-link' => '← powrót do formularz',
	'gwtoolset-mediawiki-template' => 'Szablon $1',
	'gwtoolset-submit' => 'Wyślij',
	'gwtoolset-summary-heading' => 'Podsumowanie',
	'gwtoolset-cancel' => 'Anuluj',
	'gwtoolset-loading' => 'Prosimy o cierpliwość. To może zająć trochę czasu.',
	'gwtoolset-save' => 'Zapisz',
	'gwtoolset-json-error-syntax' => 'Błąd składni, nieprawidłowy format JSON.',
	'gwtoolset-json-error-unknown' => 'Nieznany błąd.',
	'gwtoolset-category' => 'Kategoria',
	'gwtoolset-results' => 'Wyniki',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-required-group' => 'Nie jesteś członkiem grupy $1.',
	'gwtoolset-verify-php-version' => 'Rozszerzenie $1 wymaga PHP w wersji >= 5.3.3.',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'gwtoolset-submit' => 'سپارل',
	'gwtoolset-summary-heading' => 'لنډيز',
	'gwtoolset-cancel' => 'ناگارل',
	'gwtoolset-save' => 'خوندي کول',
	'gwtoolset-category' => 'وېشنيزه',
	'gwtoolset-results' => 'پايلې',
);

/** Brazilian Portuguese (português do Brasil)
 * @author 555
 */
$messages['pt-br'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, uma ferramenta de uploads em massa para GLAMs',
	'gwtoolset-intro' => 'GWToolset é uma extensão do MediaWiki que permite que GLAMs (sigla em inglês para Glaerias, Bibliotecas, Arquivos e Museus) o envio em grandes blocos de arquivos a partir de um arquivo XML que contenha metadados relativos a tais arquivos. A intenção é ter suporte a uma grande quantia de esquemas em XML. Informações adicionais sobre o projeto podem ser encontradas em sua [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project página descritiva]. Fique à vontade para também a utilizar para entrar em contato conosco. Selecione um dos menus a seguir para iniciar o processo de upload.',
	'right-gwtoolset' => 'Usar as ferramentas GWToolset',
	'action-gwtoolset' => 'usar as ferramentas GWToolset',
	'group-gwtoolset' => 'Usuários da GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Usuário|Usuária|Usuário}} da GWToolset',
	'grouppage-gwtoolset' => '{{ns:project}}:Usuários da GWToolset',
	'gwtoolset-batchjob-creation-failure' => 'Não foi possível criar um trabalho em lotes do tipo "$1".',
	'gwtoolset-could-not-close-xml' => 'Não foi possível fechar o leitor XML',
	'gwtoolset-could-not-open-xml' => 'Não foi possível abrir o aquivo XML para leitura.',
	'gwtoolset-developer-issue' => 'Entre em contato com um desenvolvedor, esse problema precisa ser corrigido antes de prosseguir. Adicione o seguinte texto em seu relato:

$1',
	'gwtoolset-dom-record-issue' => 'Não foi inserido ou um <code>record-element-name</code> ou <code>record-count</code> ou <code>record-current</code>.',
	'gwtoolset-file-backend-maxage-invalid' => 'O valor máximo de idade fornecido em <code>$wgGWTFBMaxAge</code> é inválido. Veja o [php.net/manual/en/datetime.formats.relative.php manual do PHP] para saber como defini-lo corretamente.',
	'gwtoolset-fsfile-empty' => 'O arquivo foi eliminado por estar vazio.',
	'gwtoolset-fsfile-retrieval-failure' => 'Não foi possível obter o arquivo a partir do URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> não foi definido.',
);

/** Russian (русский)
 * @author Okras
 */
$messages['ru'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, инструмент массовой загрузки для GLAM',
	'right-gwtoolset' => 'Использовать GWToolset',
	'action-gwtoolset' => 'использовать GWToolset',
	'group-gwtoolset' => 'Пользователи GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Пользователь GWToolset}}',
	'grouppage-gwtoolset' => '{{ns:project}}:Пользователи GWToolset',
	'gwtoolset-could-not-open-xml' => 'Не удалось открыть XML-файл для чтения.',
	'gwtoolset-fsfile-empty' => 'Файл был пустым и был удалён.',
	'gwtoolset-fsfile-retrieval-failure' => 'Не удалось получить файл с URL-адреса $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>не задано.',
	'gwtoolset-no-url-to-media' => 'Не установлен <code>url-to-the-media-file</code>.',
	'gwtoolset-file-is-empty' => 'Загруженный файл пуст.',
	'gwtoolset-improper-upload' => 'Файл не был загружен правильно.',
	'gwtoolset-missing-temp-folder' => 'Временная папка недоступна.',
	'gwtoolset-no-file' => 'Файл не был получен.',
	'gwtoolset-partial-upload' => 'Файл был загружен только частично.',
	'gwtoolset-back-text-link' => '← вернуться к форме',
	'gwtoolset-mediawiki-template' => 'Шаблон $1',
	'gwtoolset-menu-1' => 'Сопоставление метаданных',
	'gwtoolset-submit' => 'Отправить',
	'gwtoolset-summary-heading' => 'Описание',
	'gwtoolset-cancel' => 'Отмена',
	'gwtoolset-save' => 'Сохранить',
	'gwtoolset-save-mapping' => 'Сохранить сопоставление',
	'gwtoolset-save-mapping-succeeded' => 'Ваше сопоставление было сохранено.',
	'gwtoolset-save-mapping-name' => 'Как вы хотите назвать это сопоставление?',
	'gwtoolset-json-error-unknown' => 'Неизвестная ошибка.',
	'gwtoolset-step-1-instructions-li-1' => 'Описание метаданных',
	'gwtoolset-step-1-instructions-li-2' => 'Сопоставление метаданных',
	'gwtoolset-step-1-instructions-li-3' => 'Пакетный предпросмотр',
	'gwtoolset-step-1-instructions-li-4' => 'Пакетная загрузка',
	'gwtoolset-upload-legend' => 'Загрузите ваш файл метаданных',
	'gwtoolset-which-metadata-mapping' => 'Какие метаданные сопоставить:',
	'gwtoolset-category' => 'Категория',
	'gwtoolset-global-categories' => 'Глобальные категории',
	'gwtoolset-maps-to' => 'Сопоставление для',
	'gwtoolset-metadata-field' => 'Поле метаданных',
	'gwtoolset-metadata-file' => 'Файл метаданных',
	'gwtoolset-partner' => 'Партнёр',
	'gwtoolset-results' => 'Результаты',
	'gwtoolset-step-2-heading' => 'Шаг 2: Сопоставление метаданных',
	'gwtoolset-template-field' => 'Поле шаблона',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-verify-php-version' => 'Расширение $1 требует PHP >= 5.3.3.',
	'gwtoolset-wiki-checks-not-passed' => 'Вики-проверки не пройдены',
);

/** Scots (Scots)
 * @author John Reid
 */
$messages['sco'] = array(
	'gwtoolset-metadata-mapping-invalid-url' => 'The supplied metadata mapping URL disna match the expected mapping URL path.

* Supplied URL: $1
* Expected URL: $2',
	'gwtoolset-no-xml-element-found' => 'No XML element foond fer mapping.
* Did ye enter ae value in the form fer "{{int:gwtoolset-record-element-name}}"?
* Is the XML file weel-formed? Try this [$1 XML validator].
$2',
	'gwtoolset-step-1-instructions-2' => 'In this step, {{GENDER:$1|ye uplaid}} ae new metadata file til the wiki. The tuil will attempt tae extract the metadata fields available in the metadata file, that ye will then map til ae MediaWiki template in "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-title-bad' => 'The title, that wis cræftit based oan the metadata n the MediaWiki template mappin, isna valid.

Try anither field fae the metadata fer title n title-identifier, or gif possible, chynge the metadata whaur needed. See [https://commons.wikimedia.org/wiki/Commons:File_naming File naming] fer mair information.

<strong>Onvalid title:</strong> $1.',
);

/** Swedish (svenska)
 * @author Ainali
 * @author Jopparn
 * @author LeiLar
 * @author Lokal Profil
 * @author Tobulos1
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset, ett massuppladdningsverktyg för GLAM-institutioner',
	'gwtoolset-intro' => 'GWToolset är ett MediaWiki-tillägg som ger GLAM (gallerier, bibliotek, arkiv och museer) möjlighet att massuppladda innehåll baserat på en XML-fil som innehåller metadata om respektive del av innehållet. Avsikten är att möjliggöra för en mängd olika XML-scheman. Ytterligare information om projektet kan hittas på dess [https://commons.wikimedia.org/wiki/Commons:GLAMToolset_project projektsida]. Du är välkommen att kontakta oss på den sidan också. Välj en av menyposterna ovan för att börja ladda upp.',
	'right-gwtoolset' => 'Använd GWToolset',
	'action-gwtoolset' => 'använd gwtoolset',
	'group-gwtoolset' => 'GWToolset-användare',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset-användare}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset-användare',
	'gwtoolset-batchjob-creation-failure' => 'Gick inte att skapa ett batch-jobb av typen "$1".',
	'gwtoolset-could-not-close-xml' => 'Kunde inte stänga av XML-läsaren.',
	'gwtoolset-could-not-open-xml' => 'Kunde inte öppna XML-filen för läsning.',
	'gwtoolset-developer-issue' => 'Vänligen kontakta en utvecklare. Detta problem måste åtgärdas innan du kan fortsätta. Lägg till följande text i rapporten:


$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, <code>record-count</code>, eller <code>record-current</code> inte angivet.',
	'gwtoolset-file-backend-maxage-invalid' => 'Maximalt värdet för ålder i <code>$wgGWTFBMaxAge</code> är ogiltigt.
Se [php.net/manual/en/datetime.formats.relative.php PHP-manualen] för hur du ställer in det korrekt.',
	'gwtoolset-fsfile-empty' => 'Filen var tom och togs bort.',
	'gwtoolset-fsfile-retrieval-failure' => 'Filen kunde inte hämtas från URL $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> inte angivet.',
	'gwtoolset-incorrect-form-handler' => 'Modulen "$1" har inte registrerat en formulärhanterare GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'Batch-jobbsreglaget har överskridits.',
	'gwtoolset-no-accepted-types' => 'Inga accepterat typer tillhandahålls',
	'gwtoolset-no-callback' => 'Ingen callback-funktion har skickats till den här metoden.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code> inte angivet.",
	'gwtoolset-no-default' => 'Inget standardvärde har angetts.',
	'gwtoolset-no-field-size' => 'Ingen fältstorlek har angetts för fältet "$1".',
	'gwtoolset-no-file-backend-name' => 'Inget filnamn har angetts.',
	'gwtoolset-no-file-url' => 'Ingen <code>file_url</code> satt att tolka.',
	'gwtoolset-no-form-handler' => 'Ingen formulärhanterare skapad.',
	'gwtoolset-no-mapping' => 'Inget <code>mapping_name</code> har angetts.',
	'gwtoolset-no-mapping-json' => 'Ingen <code>mapping_json</code> har angetts.',
	'gwtoolset-no-max' => 'Inget högsta värde har angetts.',
	'gwtoolset-no-mediafile-throttle' => 'Inget mediefilsreglage angavs.',
	'gwtoolset-no-mediawiki-template' => 'Ingen <code>mediawiki-mall-namn</code> har angetts.',
	'gwtoolset-no-min' => 'Inget minsta värde har angetts.',
	'gwtoolset-no-module' => 'Inget modulnamn specificerades.',
	'gwtoolset-no-mwstore-complete-path' => 'Ingen fullständig sökväg har angetts.',
	'gwtoolset-no-mwstore-relative-path' => 'Ingen relativ sökväg har angetts.',
	'gwtoolset-no-page-title' => 'Ingen sidorubrik har angetts.',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code> inte inställd.",
	'gwtoolset-no-source-array' => 'Ingen källtabell tillhandahölls.',
	'gwtoolset-no-summary' => 'Ingen sammanfattning har angetts.',
	'gwtoolset-no-template-url' => 'Ingen URL-mall har angetts för att tolka.',
	'gwtoolset-no-text' => 'Ingen text har angetts.',
	'gwtoolset-no-title' => 'Ingen titel har angetts.',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code> inte inställd.",
	'gwtoolset-no-url-to-evaluate' => 'Ingen URL har angetts för utvärdering.',
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code> inte inställd.',
	'gwtoolset-no-user' => 'Inga användarobjekt har angetts.',
	'gwtoolset-no-xml-element' => 'Ingen XMLReader eller DOMElement har angetts.',
	'gwtoolset-no-xml-source' => 'Ingen lokal XML-källa har angetts.',
	'gwtoolset-not-string' => 'Värdet som angetts i metoden var inte en sträng. Den är av typ "$1".',
	'gwtoolset-sha1-does-not-match' => 'SHA-1 matchar inte.',
	'gwtoolset-disk-write-failure' => 'Servern kunde inte skriva filen till ett filsystem.',
	'gwtoolset-xml-doctype' => 'XML-metadatafilen får inte innehålla ett <!DOCTYPE>-avsnitt. Ta bort den och försök sedan ladda upp XML-metadatafilen igen.',
	'gwtoolset-file-is-empty' => 'Den uppladdade filen är tom.',
	'gwtoolset-improper-upload' => 'Filen laddades inte upp korrekt.',
	'gwtoolset-mime-type-mismatch' => 'Filtillägget "$1" och MIME-typen "$2" av den uppladdade filen matchar inte.',
	'gwtoolset-missing-temp-folder' => 'Ingen tillfällig mapp tillgänglig.',
	'gwtoolset-multiple-files' => 'Filen som laddades upp innehåller information om mer än en fil. Endast en fil kan lämnas in på en gång.',
	'gwtoolset-no-extension' => 'Filen som laddades innehåller inte tillräckligt med information för att bearbeta filen. Troligen har den ingen filändelse.',
	'gwtoolset-no-file' => 'Ingen fil mottogs.',
	'gwtoolset-no-form-field' => 'Det förväntade formulärsfältet "$1" finns inte.',
	'gwtoolset-over-max-ini' => 'Filen som laddades upp överskrider <code>upload_max_filesize</code> och/eller <code>post_max_size</code>-direktivet i <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Filen blev bara delvis uppladdad.',
	'gwtoolset-php-extension-error' => 'En PHP-tillägg stannade filuppladdningen. PHP ger inte ett sätt att ta reda på vilket tillägg som orsakade filuppladdningens stopp. Granska listan över laddade tillägg med <code>phpinfo()</code>.',
	'gwtoolset-unaccepted-extension' => 'Källfilen innehåller inte ett accepterat filtillägg.',
	'gwtoolset-unaccepted-extension-specific' => 'Källfilen har det oaccepterade filtillägget ".$1".',
	'gwtoolset-unaccepted-mime-type' => 'Den uppladdade filen tolkas som att ha MIME-typ "$1", vilket inte är en godkänd MIME-typ.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Den uppladdade filen har MIME-typ "$1", vilket inte är godkänt. Har XML-filen en XML-deklaration överst i filen?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← gå tillbaka till formuläret',
	'gwtoolset-back-text' => 'Tryck på webbläsarens tillbaka-knapp för att gå tillbaka till formuläret.',
	'gwtoolset-file-interpretation-error' => 'Det fanns ett problem med att bearbeta metadatafilen',
	'gwtoolset-mediawiki-template' => 'Mall $1',
	'gwtoolset-metadata-user-options-error' => 'Följande {{PLURAL:$2|fält}} i formuläret måste fyllas i:
$1',
	'gwtoolset-metadata-invalid-template' => 'Ingen giltig MediaWiki-mall har hittats.',
	'gwtoolset-menu-1' => 'Metadata-mappning',
	'gwtoolset-technical-error' => 'Det var ett tekniskt fel.',
	'gwtoolset-required-field' => 'betecknar ett obligatoriskt fält',
	'gwtoolset-submit' => 'Verkställ',
	'gwtoolset-summary-heading' => 'Sammanfattning',
	'gwtoolset-cancel' => 'Avbryt',
	'gwtoolset-loading' => 'Var tålmodig. Detta kan ta ett tag.',
	'gwtoolset-save' => 'Spara',
	'gwtoolset-save-mapping' => 'Spara mappning',
	'gwtoolset-save-mapping-failed' => 'Förlåt. Det uppstod ett problem vid bearbetningen av din begäran. Vänligen försök igen senare. (Felmeddelande: $1)',
	'gwtoolset-save-mapping-succeeded' => 'Din mappning har sparats.',
	'gwtoolset-save-mapping-name' => 'Vad vill du kalla denna mappning?',
	'gwtoolset-json-error' => 'Det var ett problem med JSON. Fel: $1.',
	'gwtoolset-json-error-depth' => 'Det maximala stack-djupet överskreds.',
	'gwtoolset-json-error-ctrl-char' => 'Oväntat kontrolltecken hittat.',
	'gwtoolset-json-error-syntax' => 'Syntaxfel, felaktigt formerad JSON.',
	'gwtoolset-json-error-utf8' => 'Felaktigt UTF-8-tecken, möjligen felkodat.',
	'gwtoolset-json-error-unknown' => 'Okänt fel.',
	'gwtoolset-accepted-file-types' => 'Accepterade fil{{PLURAL:$1|typ|typer}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Kontrollera att XML-filen är välformad med detta $1.',
	'gwtoolset-file-url-invalid' => 'URL-filen var ogiltigt; Filen finns ännu inte på wikin. Du måste först ladda upp filen från din dator om du vill använda filens URL-referens i formuläret.',
	'gwtoolset-mediafile-throttle' => 'Mediefilsreglage:',
	'gwtoolset-mediafile-throttle-description' => 'Efter förhandsvisningen av batchen, i steg 3, laddar GWToolset upp de kvarvarande posterna i din batch-uppladdning genom bakgrundsjobb. Mediefilsreglaget kontrollerar antalet mediefilförfrågningar Wikimeida Commons gör mot din mediefilserver var gång ett bakgrundsjobb körs. Du kan sätta mediefilsreglaget till ett värde mellan 1 och 20. Till exempel, om det totala antalet poster i din batch-uppladning är 100 och du sätter ditt reglage till 20, kör Wikimedia Commons 5 bakgrundsjobb för att behandla hela din batch-uppladdning. Tiden mellan vart bakgrundsjobb varierar beroende på serverbelastning och konfigureringar; vi räknar med att det på Wikimedia Commons kommer att köras ett bakgrundsjobb för GWToolset åtminstone var 5:e minut.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'MediaWiki-mallen "<strong>$1</strong>" existerar inte på wikin.

Antingen importerar du mallen eller väljer en annan MediaWiki-mall att använda för mappning.',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki-mallen "$1" hittades inte.',
	'gwtoolset-metadata-file-source' => 'Välj källan för metadata-filen.',
	'gwtoolset-metadata-file-source-info' => '... antingen en fil som har laddats upp tidigare eller en fil som du vill ladda upp från din dator.',
	'gwtoolset-metadata-file-url' => 'Metadatafil wiki URL:',
	'gwtoolset-metadata-file-upload' => 'Uppladdning av metadatafil:',
	'gwtoolset-metadata-mapping-bad' => 'Det finns ett problem med metadata-mappning. Troligtvis är JSON-formatet ogiltigt. Försök korrigera problemet och skicka sedan in formuläret igen.

$1',
	'gwtoolset-metadata-mapping-invalid-url' => 'Den angivna URL:en för metadatamappningen stämmer inte med den förväntade mappnings-URL:en.

* Angiven URL: $1
* Förväntad URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'Ingen metadata-mappning hittades.

Sidan "<strong>$1<strong>" finns inte på wikin.',
	'gwtoolset-namespace-mismatch' => 'Sidan "<strong>$1<strong>" ligger i fel namnrymd "<strong>$2<strong>".

Den borde vara i namnrymden "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'Inget XML-element kunde hittas för mappningen.
* Angav du ett värde i formuläret för "{{int:gwtoolset-record-element-name}}"?
* Är XML-filen välformaterad? Pröva följande [$1 XML-validator].
$2',
	'gwtoolset-page-title-contains-url' => 'Sidan "$1" innehåller hela wiki-URL:en. Se till att du enbart anger sidtiteln, dvs. den delen av URL:en som kommer efter /wiki/',
	'gwtoolset-record-element-name' => 'Vilket är XML-elementet som innehåller var metadatapost:',
	'gwtoolset-step-1-heading' => 'Steg 1: Känna igen metadata',
	'gwtoolset-step-1-instructions-1' => 'Uppladdningsprocessen för metadata består av 4 steg:',
	'gwtoolset-step-1-instructions-2' => 'I detta steg, {{GENDER:$1|laddar du upp}} en ny metadatafil till wikin. Verktyget kommer att försöka extrahera metadatafält som finns i metadatafilen som du sedan kommer att matcha mot en MediaWikimall i "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3' => 'Om domänen för dina mediefiler inte finns listad nedan, [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment begär] 
att din mediefil-domän vitlistas på Wikimedia Commons. Vitlistan är en lista över domäner vilken Wikimedia Commons jämför emot innan mediefilerna hämtas. Om domänen för dina mediefiler inte finns på den listan kommer Wikimedia Commons inte att ladda ner filer från den domänen. Det bästa exemplet, när du skickar in din begäran, är en faktisk länk till en mediefil.',
	'gwtoolset-step-1-instructions-3-heading' => 'Vitlista för domäner',
	'gwtoolset-step-1-instructions-li-1' => 'Känna igen metadata',
	'gwtoolset-step-1-instructions-li-2' => 'Metadata-mappning',
	'gwtoolset-step-1-instructions-li-3' => 'Batch-förhandsgranskning',
	'gwtoolset-step-1-instructions-li-4' => 'Batch-uppladdning',
	'gwtoolset-upload-legend' => 'Ladda upp din metadatafil',
	'gwtoolset-which-mediawiki-template' => 'Vilken MediaWiki-mall:',
	'gwtoolset-which-metadata-mapping' => 'Vilken metadata-mappning:',
	'gwtoolset-xml-error' => 'Det gick inte att läsa in XML. Rätta felen nedan.',
	'gwtoolset-categories' => 'Ange kategorier avgränsade med ett vertikalstreck ("|")',
	'gwtoolset-category' => 'Kategori',
	'gwtoolset-create-mapping' => '$1: Skapar metadata-mappning för $2.',
	'gwtoolset-example-record' => 'Exempelinnehåll för metadataposten.',
	'gwtoolset-global-categories' => 'Globala kategorier',
	'gwtoolset-global-tooltip' => 'Dessa kategoriposter kommer att läggas till globalt på alla uppladdade objekt.',
	'gwtoolset-maps-to' => 'Mappar till',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Filtillägget kunde inte fastställas från filens URL: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'URL:en för mediefilen kunde inte utvärderas. URL:en levererar innehållet på ett sätt som ännu inte kan hanteras av detta tillägget eller uppstod ett fel under HTTP-begäran. Den angivna URL:en var "$1". Fel för HTTP-begäran "$2"',
	'gwtoolset-mapping-no-title' => 'Metadatamappningen innehåller ingen titel vilket krävs för att skapa sidan.',
	'gwtoolset-mapping-no-title-identifier' => 'Metadatamappningen innehåller inget titel-id som kan användas för att skapa en unik sidtitel. Se till att du mappar ett metadatafält till MediaWiki-mallens fält för titel-id.',
	'gwtoolset-metadata-field' => 'Metadatafält',
	'gwtoolset-metadata-file' => 'Metadatafil',
	'gwtoolset-metadata-mapping-legend' => 'Mappa din metadata',
	'gwtoolset-no-more-records' => '<strong>Inga fler poster att bearbeta</strong>',
	'gwtoolset-painted-by' => 'Målad av',
	'gwtoolset-partner' => 'Partner',
	'gwtoolset-partner-explanation' => 'Partner-mallar stoppas in källfältet i MediaWiki-mallen om angivna. Du hittar en lista över aktuella partner-mallar på Category:Source templates sidan; se länken nedan. När du har hittat den partner-mall di önskar använda ange URL:en till den i detta fältet. Du kan även skapa en ny partner-mall vid behov.',
	'gwtoolset-partner-template' => 'Mall för partner:',
	'gwtoolset-phrasing' => 'Frasering',
	'gwtoolset-preview' => 'Förhandsgranska batch',
	'gwtoolset-process-batch' => 'Bearbeta batch',
	'gwtoolset-record-count' => 'Totalt antal poster funna i denna metadatafil:  {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Resultat',
	'gwtoolset-step-2-heading' => 'Steg 2: Metadata-mappning',
	'gwtoolset-step-2-instructions-heading' => 'Mappning av metadatafälten',
	'gwtoolset-step-2-instructions-1' => 'Nedan är:',
	'gwtoolset-step-2-instructions-1-li-1' => 'En lista över fälten i MediaWiki $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Rullgardinsfält som representerar de metadatafält som hittades i metadatafilen.',
	'gwtoolset-step-2-instructions-1-li-3' => 'En exempelpost från metadatafilen.',
	'gwtoolset-step-2-instructions-2' => 'I det här steget ska du matcha metadatafälten med MediaWikimallfälten.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Välj ett metadatafält i "{{int:gwtoolset-maps-to}}"-kolumnen som motsvarar ett fält i MediaWiki-mallen i "{{int:gwtoolset-template-field}}"-kolumnen.',
	'gwtoolset-step-2-instructions-2-li-2' => 'Du behöver inte hitta en matchning för varenda fält i Mediawikimallen.',
	'gwtoolset-reupload-media' => 'Återuppladda media från URL',
	'gwtoolset-reupload-media-explanation' => 'Denna kryssrutan låter dig återupplada media för ett objekt som redan har laddats upp på wikin. Om objektet redan finns kommer en ytterligare mediafil att läggas till wikin. Om mediafilen inte finns kommer den att laddas upp oavsett om kryssrutan är ikryssad eller ej.',
	'gwtoolset-specific-categories' => 'Objektsspecifika kategorier',
	'gwtoolset-specific-tooltip' => 'Med följande fält kan du använda en fras (valfritt) plus ett metadatafält som kategori för vart enskilt objekt som laddas upp. Exempelvis om metadatafilen innehåller ett värde för konstnären av var post, då kan du lägga till detta som en kategoriuppgift för alla poster vilket automatiskt ändras till det specifika värdet för var post. Du kan även lägga till en fras som exempelvis "<em>{{int:gwtoolset-painted-by}}</em>" och sedan konstnärens metadatafält, vilket skulle ge "<em>{{int:gwtoolset-painted-by}} <konstnärsnamnet></em>" som kategorin för var post.',
	'gwtoolset-template-field' => 'Mallfält',
	'gwtoolset-step-3-instructions-heading' => 'Steg 3: Förhandsgranskning av batchen',
	'gwtoolset-step-3-instructions-1' => 'Nedan visas resultatet av uppladdningen av {{PLURAL:$1|den första posten|de första $1 posterna}} från den valda metadatafilen och mappningen av {{PLURAL:$1|det|dem}} till den MediaWiki-mall du valde i "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-3-instructions-2' => 'Granska dessa sidor och om resultatet uppfyller dina förväntningar, och det finns ytterligare poster som väntar på att laddas upp, fortsätt batch-uppladdningsprocessen genom att klicka på "{{int:gwtoolset-process-batch}}"-knappen nedan.',
	'gwtoolset-step-3-instructions-3' => 'Om du inte är nöjd med resultaten, gå tillbaka till "{{int:gwtoolset-step-2-heading}}" och justera mappningen som behövs.

Om du behöver göra redigeringar av själva metadatafilen, gör detta och ladda upp den igen genom att påbörja processen igen med "{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => 'Titeln, som skapades utifrån metadatan och mappningen till MediaWiki-mallen, är inte giltig.

Prova ett annat fält från metadatan för titel och titel-id, eller om möjligt, ändra metadatan där det behövs. Se [https://commons.wikimedia.org/wiki/Commons:File_naming Filnamngivning] för mer information.

<strong>Ogiltig titel:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Batch-jobb för metadata skapat. Din metadatafil kommer strax att analyseras och vart objekt kommer att laddas upp till wikin i bakgrunden. Du kan kolla på sidan "$1" för att se när de har laddats upp.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Kunde inte skapa ett batch-jobb för metadatafilen.',
	'gwtoolset-create-mediafile' => '$1: Skapar mediafil för $2.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => 'Skapade $1 mediefil-batch-{{PLURAL:$1|jobb}}.',
	'gwtoolset-step-4-heading' => 'Steg 4: Batch-uppladdning',
	'gwtoolset-invalid-token' => 'Redigeringstoken som lämnades in med formuläret är ogiltig.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Aktuella <code>php.ini</code>-inställningar:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Dessa har satts lägre än wikins <code>$wgMaxUploadSize</code>, vilken är satt till "$3". Vänligen justera <code>php.ini</code>-inställningarna efter behov.',
	'gwtoolset-mediawiki-version-invalid' => 'Detta tillägg kräver MediaWiki-version $1<br />Denna MediaWiki-version är $2.',
	'gwtoolset-permission-not-given' => 'Kontrollera att du är inloggad eller kontakta en administratör för att få behörighet att se denna sida ($1).',
	'gwtoolset-user-blocked' => 'Ditt konto är för närvarande blockerat. Kontakta en administratör för att korrigera blockeringsproblemet.',
	'gwtoolset-required-group' => 'Du är inte medlem av grupp $1.',
	'gwtoolset-verify-api-enabled' => '$1-tillägget kräver att wikins API är aktiverat.

Kontrollera att <code>$wgEnableAPI</code> är inställd på <code>true</code> i den <code>DefaultSettings.php</code>-filen eller åsidosätts till <code>true</code> i <code>LocalSettings.php</code>-filen.',
	'gwtoolset-verify-api-writeable' => '$1-tillägget kräver att wikins API kan utföra skriv-åtgärder för behöriga användare.

Kontrollera att <code>$wgEnableWriteAPI</code> har satts till <code>true</code> i <code>DefaultSettings.php</code>-filen eller åsidosätts till <code>true</code> i <code>LocalSettings.php</code>-filen.',
	'gwtoolset-verify-curl' => '$1-tillägget kräver att PHP [http://www.php.net/manual/en/curl.setup.php cURL-funktionerna] är installerade.',
	'gwtoolset-verify-finfo' => '$1-tillägget kräver att tillägget PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] är installerat.',
	'gwtoolset-verify-php-version' => '$1-tillägget kräver PHP >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => '$1-tillägget kräver att filuppladdningar är aktiverade.

Kontrollera att <code>$wgEnableUploads</code> har satts till <code>true</code> i <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => '$1-tillägget kräver att PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] är installerat.',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki-kontrollerna misslyckades',
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
	'right-gwtoolset' => 'Використовувати GWToolset',
	'action-gwtoolset' => 'використовувати gwtoolset',
	'group-gwtoolset' => 'Користувачі GWToolset',
	'group-gwtoolset-member' => '{{GENDER:$1|Користувач GWToolset|Користувачка GWToolset}}',
	'grouppage-gwtoolset' => '{{ns:project}}:користувачі GWToolset',
	'gwtoolset-batchjob-creation-failure' => 'Не вдалося створити пакетне завдання типу "$1".',
	'gwtoolset-could-not-close-xml' => 'Не можна закрити читанку XML.',
	'gwtoolset-could-not-open-xml' => 'Не вдалося відкрити XML-файл для читання.',
	'gwtoolset-developer-issue' => "Будь ласка, зв'яжіться з розробником. Цю проблему необхідно вирішити, перш ніж ви зможете продовжити. Будь ласка, додайте наступний текст звіту:

$1",
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>, або <code>record-count</code>, або <code>record-current</code> не надані.',
	'gwtoolset-file-backend-maxage-invalid' => 'Максимальне значення віку, передбачене у  <code>$wgGWTFBMaxAge</code>, невірне.
Подивіться  [php.net/manual/en/datetime.formats.relative.php підручник PHP] за вказівками, які вірно його встановити.',
	'gwtoolset-fsfile-empty' => 'Файл був порожній і через це його видалено.',
	'gwtoolset-fsfile-retrieval-failure' => 'Не вдалося отримати файл з URL-адреси  $1.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>не встановлено.',
	'gwtoolset-incorrect-form-handler' => 'Модуль "$1" не зареєстрував обробник форми, який розширює GWToolset\\Handlers\\Forms\\FormHandler.',
	'gwtoolset-job-throttle-exceeded' => 'Перевищено обмеження частоти створення пакетних завдань.',
	'gwtoolset-no-accepted-types' => 'Не надано прийнятих типів',
	'gwtoolset-no-callback' => 'Зворотний виклик не переданий до цього методу.',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code>не встановлено.",
	'gwtoolset-no-default' => 'Не передбачено типового значення.',
	'gwtoolset-no-field-size' => 'Не зазначено розмір поля для "$1".',
	'gwtoolset-no-file-backend-name' => "Не надано ім'я файлу бази даних.",
	'gwtoolset-no-file-backend-container' => "Не забезпечено ім'я контейнера файлу бази даних.",
	'gwtoolset-no-file-url' => 'Не забезпечено <code>file_url</code> для аналізу.',
	'gwtoolset-no-form-handler' => 'Не створено форми обробника.',
	'gwtoolset-no-mapping' => 'Не забезпечено <code>mapping_name</code>.',
	'gwtoolset-no-mapping-json' => 'Не забезпечено <code>mapping_json</code>.',
	'gwtoolset-no-max' => 'Немає максимального значення.',
	'gwtoolset-no-mediafile-throttle' => 'Не передбачено обмежень обробки медіафайлу.',
	'gwtoolset-no-mediawiki-template' => 'Не забезпечено <code>mediawiki-template-name</code>.',
	'gwtoolset-no-min' => 'Немає мінімального значення.',
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
	'gwtoolset-over-max-ini' => 'Файл, який був завантажений, перевищує <code>upload_max_filesize</code> та/або директиву <code>post_max_size</code> в <code>php.ini</code>.',
	'gwtoolset-partial-upload' => 'Файл був завантажений лише частково.',
	'gwtoolset-php-extension-error' => "Розширення PHP зупинило завантаження файлу. PHP не надає способу з'ясувати, яке розширення викликало зупинку завантаження файлу. Перевірка списку запущених розширень з <code>phpinfo()</code> може допомогти.",
	'gwtoolset-unaccepted-extension' => 'Вихідний файл не містить допустиме розширення файлу.',
	'gwtoolset-unaccepted-extension-specific' => 'Вихідний файл має неприйнятне розширення файлу ".$1".',
	'gwtoolset-unaccepted-mime-type' => 'Завантажений файл трактується як файл з MIME типом "$1", що є недопустимим типом MIME.',
	'gwtoolset-unaccepted-mime-type-for-xml' => 'Завантажений файл має неприйнятний тип MIME "$1". Файл XML має декларацію XML у верхній частині файлу?

&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '← повернутися до форми',
	'gwtoolset-back-text' => 'Натисніть кнопку браузера "назад", щоб повернутися до форми.',
	'gwtoolset-file-interpretation-error' => 'Сталася помилка обробки метаданих файлу',
	'gwtoolset-mediawiki-template' => 'Шаблон $1',
	'gwtoolset-metadata-user-options-error' => '{{PLURAL:$2|1=Наступне поле|Наступні поля}} форми повинні бути заповнені:
$1',
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
	'gwtoolset-json-error-state-mismatch' => 'Зникнення або невідповідність режимів.',
	'gwtoolset-json-error-ctrl-char' => 'Знайдено неочікуваний контрольний символ.',
	'gwtoolset-json-error-syntax' => 'Синтаксична помилка, неправильний формат JSON.',
	'gwtoolset-json-error-utf8' => 'Спотворені символи UTF-8. Можливо, неправильно закодовано.',
	'gwtoolset-json-error-unknown' => 'Невідома помилка.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|1=Допустимий тип файлу|Допустимі типи файлу}}:',
	'gwtoolset-ensure-well-formed-xml' => 'Переконайтеся, що файл XML — вірно сформований з цим  $1.',
	'gwtoolset-file-url-invalid' => "URL-адреса файлу хибна. Файл ще не існує в вікі. Ви повинні спочатку завантажити файл з комп'ютера, якщо потрібно використати посилання на URL-адресу файлу у формі.",
	'gwtoolset-mediafile-throttle' => 'Обмеження медіафайлу:',
	'gwtoolset-mediafile-throttle-description' => 'Обмеження контролює навантаження Вікісховища, яке буде покладене на ваш медіа-сервер під час пакетного завантаження. Ви можете встановити обмеження у межах 1-20, де число відповідає вибраному числу медіазапитів за хвилину.',
	'gwtoolset-mediawiki-template-does-not-exist' => 'Шаблон Медіавікі "<strong>$1</strong>" не існує у цій вікі.

Імпортуйте шаблон або виберіть інший шаблон Медіавікі для використання у зіставленні.',
	'gwtoolset-mediawiki-template-not-found' => 'Не знайдено шаблону Медіавікі "$1".',
	'gwtoolset-metadata-file-source' => 'Виберіть джерело файлу метаданих.',
	'gwtoolset-metadata-file-source-info' => ".. файл, який раніше був завантажений або файл, який ви хочете завантажити з вашого комп'ютера.",
	'gwtoolset-metadata-file-url' => 'Вікі файлу метаданих URL:',
	'gwtoolset-metadata-file-upload' => 'Завантаження файлу метаданих:',
	'gwtoolset-metadata-mapping-bad' => 'Існує проблема з відображенням метаданих. Найвірогідніше невірний формат JSON. Спробуйте виправити проблему і потім знову відправте форму.


$1.',
	'gwtoolset-metadata-mapping-invalid-url' => 'Поставлене URL зіставлення метаданих не збігається з URL очікуваного шляху зіставлення.

* Поставлене URL: $1
* Очікуване URL: $2',
	'gwtoolset-metadata-mapping-not-found' => 'Не знайдено зіставлення метаданих.

Сторінка "<strong>$1<strong>" не існує у вікі.',
	'gwtoolset-namespace-mismatch' => 'Сторінка "<strong>$1<strong>" перебуває у невірному просторі назв "<strong>$2<strong>".

Вона має бути у просторі назв "<strong>$3<strong>".',
	'gwtoolset-no-xml-element-found' => 'Не знайдено елемент XML для зіставлення.
* Ви ввели значення у формі для "{{int:gwtoolset-record-element-name}}"?
* Файл XML вірно сформований? Спробуйте цей [$1 XML validator].
$2',
	'gwtoolset-page-title-contains-url' => 'Сторінка "$1" містить URL усієї вікі. Переконайтеся, що ви ввели заголовок сторінки, наприклад частина URL після  /wiki/',
	'gwtoolset-record-element-name' => 'Який елемент XML, що містить кожен запис метаданих:',
	'gwtoolset-step-1-heading' => 'Крок 1: виявлення метаданих',
	'gwtoolset-step-1-instructions-1' => 'Процес завантаження метаданих складається з 4 кроків:',
	'gwtoolset-step-1-instructions-2' => 'На цьому кроці  {{GENDER:$1|ви}} завантажуєте новий файл метаданих у вікі. Інструмент буде намагатися отримати поля метаданих, наявні у файлі метаданих, які ви потім зіставите з шаблоном Медіавікі у "{{int:gwtoolset-step-2-heading}}".',
	'gwtoolset-step-1-instructions-3' => 'Якщо ваш мультимедійний файл відсутній у списку нижче, то перевірте [https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment request] чи домен вашого файлу доданий у білий список доменів Вікісховища. Білий список доменів - це перелік доменів, який Вікісховище читає перед отриманням медіафайлів. Якщо домен вашого медіафайлу відсутній у списку, то Вікісховище не завантажуватиме жодного файлу з нього. Найкращим зразком перевірки дії вашого запиту є фактичне посилання на медіафайл.',
	'gwtoolset-step-1-instructions-3-heading' => 'Білий список доменів',
	'gwtoolset-step-1-instructions-li-1' => 'Виявлення метаданих',
	'gwtoolset-step-1-instructions-li-2' => 'Відображення метаданих',
	'gwtoolset-step-1-instructions-li-3' => 'Пакетний перегляд',
	'gwtoolset-step-1-instructions-li-4' => 'Пакетне завантеження',
	'gwtoolset-upload-legend' => 'Завантажте ваш файл метаданих.',
	'gwtoolset-which-mediawiki-template' => 'Який шаблон Медіавікі:',
	'gwtoolset-which-metadata-mapping' => 'Які метадані зіставити:',
	'gwtoolset-xml-error' => 'Не вдалося завантажити XML-документ. Виправте вказані нижче помилки.',
	'gwtoolset-categories' => 'Введіть категорії, розділені вертикальною рискою ("|")',
	'gwtoolset-category' => 'Категорія',
	'gwtoolset-create-mapping' => '$1: Створення метаданих зіставлення для  $2 .',
	'gwtoolset-example-record' => 'Вміст запису прикладу метаданих.',
	'gwtoolset-global-categories' => 'Глобальні категорії',
	'gwtoolset-global-tooltip' => 'Записи цих категорій застосовуватимуться глобально до всіх завантажених елементів.',
	'gwtoolset-maps-to' => 'Зіставлення для',
	'gwtoolset-mapping-media-file-url-extension-bad' => 'Не вдалося визначити розширення файлу з URL файлу: $1.',
	'gwtoolset-mapping-media-file-url-bad' => 'URL медіафайлу неможливо визначити. URL надає вміст таким способом, який не опрацьовується цим розширенням або там трапилася проблема запиту HTTP. Надана URL була "$1". Помилка запиту HTTP "$2"',
	'gwtoolset-mapping-no-title' => 'Зіставлення метаданих не містить заголовок, який необхідний для того, щоб створити сторінку.',
	'gwtoolset-mapping-no-title-identifier' => 'Зіставлення метаданих не містить ідентифікатор заголовку, який використовується для створення унікальної титульної сторінки. Переконайтеся, що ви призначити поле метаданих для ідентифікатора заголовку параметричного шаблону Медіавікі.',
	'gwtoolset-metadata-field' => 'Поле метаданих',
	'gwtoolset-metadata-file' => 'Файл метаданих',
	'gwtoolset-metadata-mapping-legend' => 'Зіставити ваші метадані',
	'gwtoolset-no-more-records' => '<strong>Немає більше записів для оброблення</strong>',
	'gwtoolset-painted-by' => 'Намальовано',
	'gwtoolset-partner' => 'Партнер',
	'gwtoolset-partner-explanation' => 'Шаблони партнерів беруться у поле джерела шаблону Медіавікі, коли це передбачено. Ви можете знайти список поточних шаблонів партнера на сторінці Категорія:Шаблони джерела; див. посилання нижче. Як тільки ви знайшли партнера шаблон, який ви хочете використовувати, розмістіть URL-адресу в цьому полі. Ви також можете створити новий шаблон партнера за необхідності.',
	'gwtoolset-partner-template' => 'Шаблон партнера:',
	'gwtoolset-phrasing' => 'Формулювання',
	'gwtoolset-preview' => 'Пакетний перегляд',
	'gwtoolset-process-batch' => 'Пакетна обробка',
	'gwtoolset-record-count' => 'Всього знайдено записів в цьому файлі метаданих:  {{PLURAL:$1|$1}}.',
	'gwtoolset-results' => 'Результати',
	'gwtoolset-step-2-heading' => 'Крок 2: Відображення метаданих',
	'gwtoolset-step-2-instructions-heading' => 'Відображення полів метаданих',
	'gwtoolset-step-2-instructions-1' => 'Нижче є:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Список полів у Медіавікі $1.',
	'gwtoolset-step-2-instructions-1-li-2' => 'Розкривний список полів, які представляють поля метаданих знайти у файлі метаданих.',
	'gwtoolset-step-2-instructions-1-li-3' => 'Зразок запису з файлу метаданих.',
	'gwtoolset-step-2-instructions-2' => 'На цьому кроці необхідно зіставити поля метаданих з полями шаблону Медіавікі.',
	'gwtoolset-step-2-instructions-2-li-1' => 'Виберіть поле метаданих під стовпчиком "{{int:gwtoolset-maps-to}}", яке відповідає полю шаблону Медіавікі під стовпцем "{{int:gwtoolset-template-field}}".',
	'gwtoolset-step-2-instructions-2-li-2' => 'Вам не потрібно забезпечувати збіг для кожного поля шаблону Медіавікі.',
	'gwtoolset-reupload-media' => 'Повторно завантажити медіа з URL',
	'gwtoolset-reupload-media-explanation' => 'Цей параметр дозволяє вам повторно завантажувати медіа для елемента, яке вже було завантажене у вікі. Якщо елемент вже існує, то додатковий медіа-файл буде доданий у вікі. Якщо медіа-файл ще не існує, то він буде завантажений залежно від того, чи прапорець встановлений чи ні.',
	'gwtoolset-specific-categories' => 'Специфічні категорії пункту',
	'gwtoolset-specific-tooltip' => 'За допомогою таких полів можна вжити конструкцію (необов\'язково) плюс поле метаданих як елемент категорії  для кожного окремо завантаженого елемента. Наприклад, якщо файл метаданих містить пункт для автора кожного запису, то ви можете додати його як елемент категорії для кожного запису, що змінить значення, специфічні для кожного запису. Можна також додати фразу на кшталт <em>{{int:gwtoolset-painted-by}}</em>" і потім поле метаданих автора, яке принесе "<em>{{int:gwtoolset-painted-by}} <artist name></em>" як категорію для кожного запису.',
	'gwtoolset-template-field' => 'Поле шаблону',
	'gwtoolset-step-3-instructions-heading' => 'Крок 3: пакетний перегляд',
	'gwtoolset-step-3-instructions-1' => 'Нижче наведені результати завантаження {{PLURAL:$1|1=першого запису|перших $1 записів}} від файлу метаданих, який ви вибрали і зіставлення  {{PLURAL:$1|1=його|їх}} для вибраного у MediaWiki шаблону "{{int:gwtoolset-крок-2-заголовок}}".',
	'gwtoolset-step-3-instructions-2' => 'Перегляньте ці сторінки і якщо результати не відповідають вашим очікуванням, і існують додаткові записи, які чекають на завантаження, продовжіть процес пакетного завантаження, натиснувши нижче на кнопку  "{{int:gwtoolset-process-batch}}".',
	'gwtoolset-step-3-instructions-3' => 'Якщо ви не задоволені результатами, то поверніться до "{{int:gwtoolset-step-2-heading}}" та відрегулюйте відображення у разі потреби.

Якщо вам необхідно внести корективи у сам файл метаданих, то перейдіть вперед, зробіть потрібні зміни і завантажте його знову на початку процесу з "{{int:gwtoolset-step-1-heading}}".',
	'gwtoolset-title-bad' => 'Заголовок створено на основі метаданих, бо зіставлення шаблону Медіавікі не діє.

Спробуйте інше поле метаданих для заголовку і ідентифікатора заголовку, або, якщо це можливо, відредагуйте метадані там, де це необхідно. Див.  [https://commons.wikimedia.org/wiki/Commons:File_naming File naming] для отримання додаткової інформації.

<strong>Пошкоджених назва:</strong> $1.',
	'gwtoolset-batchjob-metadata-created' => 'Пакетне завдання метаданих створено. Ваш файл метаданих буде проаналізовано найближчим часом і кожний елемент буде завантажений на вікі у фоновому режимі. Ви можете перевірити на сторінці "$1" хід їхнього завантаження.',
	'gwtoolset-batchjob-metadata-creation-failure' => 'Не вдалося створити пакетне завдання для файлу метаданих.',
	'gwtoolset-create-mediafile' => '$1: Створення медіафайлу для $2.',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => 'Створено $1 {{PLURAL:$1|пакетне завдання|пакетні завдання|пакетних завдань}} для медіафайлу.',
	'gwtoolset-step-4-heading' => 'Крок 4: Пакетне завантаження',
	'gwtoolset-invalid-token' => 'Невірний маркер правки, надісланий із формою.',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => 'Чинні налаштування <code>php.ini</code>:

* <code>upload_max_filesize</code>: $1
* <code>post_max_size</code>: $2

Вони установлені нижче, ніж  <code>$wgMaxUploadSize</code> для вікі, який заданий як "$3". Будь ласка, відрегулюйте налаштування <code>php.ini</code> залежно від даних.',
	'gwtoolset-mediawiki-version-invalid' => 'Дане розширення вимагає Медіавікі версії $1<br />Це Медіавікі має версію $2.',
	'gwtoolset-permission-not-given' => 'Переконайтеся, що ви ввійшли до системи, або зверніться до адміністратора для того, щоб бути наданий дозвіл на перегляд цієї сторінки ($1).',
	'gwtoolset-user-blocked' => 'Ваш обліковий запис наразі заблоковано. Будь ласка, зверніться до адміністратора для того, щоб усунути це блокування.',
	'gwtoolset-required-group' => 'Ви не учасник групи $1.',
	'gwtoolset-verify-api-enabled' => 'Розширення $1 вимагає увімкненої API вікі.

Переконайтеся, що <code>$wgEnableAPI</code> установлено як <code>true</code> у файлі  <code>DefaultSettings.php</code> або переписано на <code>true</code> у файлі <code>LocalSettings.php</code>.',
	'gwtoolset-verify-api-writeable' => 'Розширення $1 вимагає, аби API вікі могла виконувати дію писання для авторизованих користувачів.

Переконайтеся, що <code>$wgEnableAPI</code> установлено як <code>true</code> у файлі  <code>DefaultSettings.php</code> або переписано на <code>true</code> у файлі <code>LocalSettings.php</code>.',
	'gwtoolset-verify-curl' => 'Розширення $1 потребує, аби PHP [http://www.php.net/manual/en/curl.setup.php cURL функції] були встановлені.',
	'gwtoolset-verify-finfo' => 'Розширення $1 Extension вимагає, щоби розширення PHP [http://www.php.net/manual/en/fileinfo.setup.php finfo] було встановлене.',
	'gwtoolset-verify-php-version' => 'Розширення $1 потребує PHP версії >= 5.3.3.',
	'gwtoolset-verify-uploads-enabled' => 'Розширення $1 вимагає увімкненого завантаження файлів.

Переконайтеся, що <code>$wgEnableUploads</code> встановлено як <code>true</code> у  <code>LocalSettings.php</code>.',
	'gwtoolset-verify-xmlreader' => 'Розширення $1 вимагає, щоб PHP [http://www.php.net/manual/en/xmlreader.setup.php XMLReader] був встановлений.',
	'gwtoolset-wiki-checks-not-passed' => 'Вікі-перевірки не пройдені',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'gwtoolset-mediawiki-template' => 'Bản mẫu $1',
	'gwtoolset-metadata-invalid-template' => 'Không tìm thấy bản mẫu MediaWiki hợp lệ.',
	'gwtoolset-menu-1' => 'Ánh xạ siêu dữ liệu',
	'gwtoolset-submit' => 'Gửi',
	'gwtoolset-summary-heading' => 'Tóm tắt',
	'gwtoolset-cancel' => 'Hủy bỏ',
	'gwtoolset-save' => 'Lưu',
	'gwtoolset-save-mapping' => 'Lưu ánh xạ',
	'gwtoolset-save-mapping-succeeded' => 'Ánh xạ của bạn đã được lưu.',
	'gwtoolset-save-mapping-name' => 'Bạn muốn gọi ánh xạ này là gì?',
	'gwtoolset-json-error-unknown' => 'Lỗi không xác định.',
	'gwtoolset-accepted-file-types' => '{{PLURAL:$1|Kiểu|Các kiểu}} tập tin được chấp nhận:',
	'gwtoolset-step-1-heading' => 'Bước 1: Phát hiện siêu dữ liệu',
	'gwtoolset-step-1-instructions-3-heading' => 'Danh sách trắng tên miền',
	'gwtoolset-step-1-instructions-li-1' => 'Phát hiện siêu dữ liệu',
	'gwtoolset-step-1-instructions-li-2' => 'Ánh xạ siêu dữ liệu',
	'gwtoolset-step-1-instructions-li-3' => 'Xem trước hàng loạt',
	'gwtoolset-step-1-instructions-li-4' => 'Tải lên hàng loạt',
	'gwtoolset-upload-legend' => 'Tải lên tập tin siêu dữ liệu của bạn',
	'gwtoolset-which-mediawiki-template' => 'Bản mẫu MediaWiki:',
	'gwtoolset-which-metadata-mapping' => 'Ánh xạ siêu dữ liệu:',
	'gwtoolset-categories' => 'Nhập các thể loại với dấu ống (“|”) phân cách',
	'gwtoolset-category' => 'Thể loại',
	'gwtoolset-create-mapping' => '$1: Đang đưa siêu dữ liệu vào ánh xạ cho $2.',
	'gwtoolset-global-categories' => 'Thể loại toàn cầu',
	'gwtoolset-maps-to' => 'Ánh xạ vào',
	'gwtoolset-metadata-field' => 'Ô siêu dữ liệu',
	'gwtoolset-metadata-file' => 'Tập tin siêu dữ liệu',
	'gwtoolset-metadata-mapping-legend' => 'Đưa siêu dữ liệu của bạn vào ánh xạ',
	'gwtoolset-partner' => 'Cùng đôi',
	'gwtoolset-partner-template' => 'Bản mẫu cùng đôi:',
	'gwtoolset-preview' => 'Xem trước hàng loạt',
	'gwtoolset-process-batch' => 'Xử lý hàng loạt',
	'gwtoolset-results' => 'Kết quả',
	'gwtoolset-step-2-heading' => 'Bước 2: Ánh xạ siêu dữ liệu',
	'gwtoolset-step-2-instructions-heading' => 'Đưa các ô siêu dữ liệu vào ánh xạ',
	'gwtoolset-step-2-instructions-1' => 'Dưới đây có:',
	'gwtoolset-step-2-instructions-1-li-1' => 'Trang sách các ô trong $1 của MediaWiki.',
	'gwtoolset-reupload-media' => 'Tải phương tiện lên lại từ URL',
	'gwtoolset-template-field' => 'Ô bản mẫu',
	'gwtoolset-step-3-instructions-heading' => 'Bước 3: Xem trước hàng loạt',
	'gwtoolset-create-mediafile' => '$1: Đang tạo tập tin phương tiện cho $2.',
	'gwtoolset-step-4-heading' => 'Bước 4: Tải lên hàng loạt',
	'gwtoolset-mediawiki-version-invalid' => 'Phần mở rộng này cần MediaWiki $1<br />Trang này đang chạy MediaWiki $2.',
	'gwtoolset-required-group' => 'Bạn không phải thuộc nhóm $1.',
	'gwtoolset-verify-php-version' => 'Phần mở rộng $1 cần PHP ≥ 5.3.3.',
	'gwtoolset-verify-xmlreader' => 'Phần mở rộng $1 cần cài đặt [http://www.php.net/manual/xmlreader.setup.php XMLReader] vào PHP.',
	'gwtoolset-wiki-checks-not-passed' => 'Các kiểm tra wiki bị thất bại',
);

/** Yiddish (ייִדיש)
 * @author פוילישער
 */
$messages['yi'] = array(
	'gwtoolset-fsfile-empty' => 'די טעקע איז געווען ליידיק און איז געווארן אויסגעמעקט.',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code> נישט פעסטגעשטעלט.',
	'gwtoolset-no-max' => 'קייו מאקסימאלן ווערט נישט פארזארגט.',
	'gwtoolset-no-page-title' => 'קיין בלאט קעפל נישט באזארגט.',
	'gwtoolset-no-title' => 'קיין קעפל נישט באזארגט.',
	'gwtoolset-mediawiki-template' => 'מוסטער „$1“',
	'gwtoolset-summary-heading' => 'רעזומע',
	'gwtoolset-cancel' => 'אנולירן',
	'gwtoolset-save' => 'אויפֿהיטן',
	'gwtoolset-json-error-unknown' => 'אומבאַקאַנטער פֿעלער',
	'gwtoolset-mediawiki-template-not-found' => 'מעדיעוויקי מוסטער "$1" נישט געטראפן.',
	'gwtoolset-category' => 'קאַטעגאָריע',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Liuxinyu970226
 * @author Qiyue2001
 * @author Shizhao
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'gwtoolset' => 'GWToolset',
	'gwtoolset-desc' => 'GWToolset，一个用于GLAM的大量上传工具',
	'right-gwtoolset' => '使用GWToolset',
	'action-gwtoolset' => '使用GWToolset',
	'group-gwtoolset' => 'GWToolset用户',
	'group-gwtoolset-member' => '{{GENDER:$1|GWToolset用户}}',
	'grouppage-gwtoolset' => '{{ns:project}}:GWToolset用户',
	'gwtoolset-batchjob-creation-failure' => '无法创建“$1”类型的批处理作业。',
	'gwtoolset-could-not-close-xml' => '不能关闭XML阅读器。',
	'gwtoolset-could-not-open-xml' => '不能打开XML文件用于阅读。',
	'gwtoolset-developer-issue' => '请联系开发人员。此问题必须在您继续之前解决。请在反馈时标注以下错误代码：
$1',
	'gwtoolset-dom-record-issue' => '<code>record-element-name</code>、<code>record-count</code>和/或<code>record-current</code>尚不支持。',
	'gwtoolset-fsfile-empty' => '文件是空的且已删除。',
	'gwtoolset-fsfile-retrieval-failure' => '无法从URL$1中检索该文件。',
	'gwtoolset-ignorewarnings' => '<code>ignorewarnings</code>未设置。',
	'gwtoolset-incorrect-form-handler' => '模块“$1”未注册成一个用于GWToolset\\Handlers\\Forms\\FormHandler的表单处理程序。',
	'gwtoolset-no-comment' => "<code>user_options['comment']</code>未设置。",
	'gwtoolset-no-default' => '没有提供默认值。',
	'gwtoolset-no-mapping' => '没有提供<code>mapping_name</code>。',
	'gwtoolset-no-mapping-json' => '没有提供<code>mapping_json</code>。',
	'gwtoolset-no-max' => '没有提供最大值。',
	'gwtoolset-no-mediawiki-template' => '没有提供<code>mediawiki-template-name</code>。',
	'gwtoolset-no-min' => '没有提供最小值。',
	'gwtoolset-no-module' => '没有提供模块名。',
	'gwtoolset-no-page-title' => '没有页面标题提供。',
	'gwtoolset-no-save-as-batch' => "<code>user_options['save-as-batch-job']</code>未设置。",
	'gwtoolset-no-summary' => '没有提供摘要。',
	'gwtoolset-no-text' => '没有提供内容。',
	'gwtoolset-no-title' => '没有提供标题。',
	'gwtoolset-no-reupload-media' => "<code>user_options['gwtoolset-reupload-media']</code>未设置。",
	'gwtoolset-no-url-to-media' => '<code>url-to-the-media-file</code>未设置。',
	'gwtoolset-no-user' => '没有用户计划提供。',
	'gwtoolset-no-xml-element' => '没有提供XML阅读器或DOMElement。',
	'gwtoolset-no-xml-source' => '没有提供本地XML源。',
	'gwtoolset-sha1-does-not-match' => 'SHA-1无法匹配。',
	'gwtoolset-file-is-empty' => '上传的文件是空的。',
	'gwtoolset-improper-upload' => '未正确上传文件。',
	'gwtoolset-no-file' => '没有收到文件。',
	'gwtoolset-php-extension-error' => '一个PHP拓展阻止了文件上传。PHP无法确定哪个PHP拓展致使上传被阻止。请测试所有拓展中的<code>phpinfo()</code>部分以获取帮助。',
	'gwtoolset-unaccepted-mime-type' => '上传的文件被认定拥有MIME格式“$1”，目前尚不支持此种MIME格式。',
	'gwtoolset-unaccepted-mime-type-for-xml' => '上传的文件被认定拥有MIME格式“$1”，目前尚不支持。难道XML文件的顶部拥有以下XML字段？
&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-back-text-link' => '←回到窗口',
	'gwtoolset-mediawiki-template' => '模板$1',
	'gwtoolset-metadata-invalid-template' => '未找到有效的 MediaWiki 模板。',
	'gwtoolset-menu-1' => '元数据映射',
	'gwtoolset-technical-error' => '这里有一个技术问题。',
	'gwtoolset-required-field' => '表示必填的字段',
	'gwtoolset-submit' => '提交',
	'gwtoolset-summary-heading' => '摘要',
	'gwtoolset-cancel' => '取消',
	'gwtoolset-loading' => '请耐心等待。这可能需要一段时间。',
	'gwtoolset-save' => '保存',
	'gwtoolset-save-mapping' => '保存映射',
	'gwtoolset-save-mapping-failed' => '抱歉。处理您的请求期间遇到技术问题。请稍后再试。（错误信息：$1）',
	'gwtoolset-save-mapping-succeeded' => '您的映射已保存。',
	'gwtoolset-json-error-syntax' => '语法错误，不正确的JSON。',
	'gwtoolset-json-error-utf8' => '畸形的UTF-8字符，可能编码不正确。',
	'gwtoolset-json-error-unknown' => '未知错误。',
	'gwtoolset-accepted-file-types' => '接受的文件{{PLURAL:$1|格式}}：',
	'gwtoolset-ensure-well-formed-xml' => '用这个$1确保XML文件格式优良。',
	'gwtoolset-mediafile-throttle' => '元文件节流阀：',
	'gwtoolset-mediawiki-template-not-found' => 'MediaWiki 模板" $1 "找不到。',
	'gwtoolset-metadata-file-source' => '选择元数据文件源。',
	'gwtoolset-metadata-file-url' => '元数据文件wikiURL：',
	'gwtoolset-metadata-file-upload' => '元数据文件上传：',
	'gwtoolset-step-1-heading' => '第1步：元数据检测',
	'gwtoolset-step-1-instructions-2' => '在此步骤中，{{GENDER:$1|您上传了}}一个新的元数据文件在此wiki。此工具将尝试从元数据文件中提取可用元数据字段，之后您将映射至在“{{int:gwtoolset-step-2-heading}}”中的一个MediaWiki模板。',
	'gwtoolset-step-1-instructions-3' => '如果您的媒体文件域未在下方列出，请[https://bugzilla.wikimedia.org/enter_bug.cgi?assigned_to=wikibugs-l@lists.wikimedia.org&attach_text=&blocked=58224&bug_file_loc=http://&bug_severity=normal&bug_status=NEW&cf_browser=---&cf_platform=---&comment=please+add+the+following+domain(s)+to+the+wgCopyUploadsDomains+whitelist:&component=Site+requests&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text/plain&data=&dependson=&description=&flag_type-3=X&form_name=enter_bug&keywords=&maketemplate=Remember+values+as+bookmarkable+template&op_sys=All&product=Wikimedia&rep_platform=All&short_desc=&target_milestone=---&version=wmf-deployment 在此]申请在维基共享资源域白名单中加入您的媒体文件域。域白名单是维基共享资源检查反例的媒体文件的例外列表。如果您的媒体文件域未在此列表上，维基共享资源将不会在此域下载媒体文件。最好的提交您申请的例子是实际连接一个媒体文件。',
	'gwtoolset-step-1-instructions-3-heading' => '域名白名单',
	'gwtoolset-step-1-instructions-li-1' => '元数据检测',
	'gwtoolset-step-1-instructions-li-2' => '元数据映射',
	'gwtoolset-step-1-instructions-li-3' => '批处理预览',
	'gwtoolset-step-1-instructions-li-4' => '批量上传',
	'gwtoolset-upload-legend' => '上传您的元数据文件',
	'gwtoolset-which-mediawiki-template' => '哪个MediaWiki模板：',
	'gwtoolset-which-metadata-mapping' => '哪些元数据映射：',
	'gwtoolset-xml-error' => '加载XML失败。请更正以下错误。',
	'gwtoolset-category' => '分类',
	'gwtoolset-create-mapping' => '$1：创建用于$2的元数据映射。',
	'gwtoolset-global-categories' => '全局分类',
	'gwtoolset-maps-to' => '映射至',
	'gwtoolset-metadata-field' => '元数据字段',
	'gwtoolset-metadata-file' => '元数据文件',
	'gwtoolset-metadata-mapping-legend' => '映射您的元数据',
	'gwtoolset-no-more-records' => '<strong>没有要处理的更多记录</strong>',
	'gwtoolset-painted-by' => '上色者',
	'gwtoolset-partner' => '合作伙伴',
	'gwtoolset-partner-template' => '合作伙伴模板：',
	'gwtoolset-phrasing' => '句式',
	'gwtoolset-preview' => '预览批处理',
	'gwtoolset-results' => '结果',
	'gwtoolset-step-2-heading' => '第2步：元数据映射',
	'gwtoolset-step-2-instructions-heading' => '映射元数据字段',
	'gwtoolset-step-2-instructions-1' => '下面是：',
	'gwtoolset-step-2-instructions-1-li-1' => 'MediaWiki $1的字段列表。',
	'gwtoolset-step-2-instructions-1-li-3' => '来自元数据文件的记录示范。',
	'gwtoolset-reupload-media' => '从URL重新上传媒体文件',
	'gwtoolset-template-field' => '模板字段',
	'gwtoolset-step-3-instructions-heading' => '第3步：预览批处理',
	'gwtoolset-create-mediafile' => '$1：为$2创建媒体文件。',
	'gwtoolset-create-prefix' => 'GWToolset',
	'gwtoolset-mediafile-jobs-created' => '已创建$1媒体文件批处理作业。',
	'gwtoolset-step-4-heading' => '第4步：批量上传',
	'gwtoolset-invalid-token' => '编辑令牌在标记无效的情况下被提交。',
	'gwtoolset-maxuploadsize-exceeds-ini-settings' => '当前的<code>php.ini</code>设置：
* <code>upload_max_filesize</code>：$1
* <code>post_max_size</code>：$2
这些设置低于wiki的<code>$wgMaxUploadSize</code>，可在“$3”设置。请适当调整<code>php.ini</code>的设置。',
	'gwtoolset-mediawiki-version-invalid' => '此拓展需要MediaWiki版本$1<br />当前MediaWiki版本$2',
	'gwtoolset-user-blocked' => '您的用户账户已被封禁。请与管理员联络以寻求解禁。',
	'gwtoolset-required-group' => '您不是$1组的成员。',
	'gwtoolset-verify-api-enabled' => '$1拓展要求wiki API被启用。请确保<code>DefaultSettings.php</code>文件的<code>$wgEnableAPI</code>设置是<code>true</code>或在<code>LocalSettings.php</code>文件重写至<code>true</code>。',
	'gwtoolset-verify-api-writeable' => '$1拓展要求wiki API对获权用户能够执行写入动作。请确保<code>DefaultSettings.php</code>文件的<code>$wgEnableWriteAPI</code>设置是<code>true</code>或在<code>LocalSettings.php</code>文件重写至<code>true</code>。',
	'gwtoolset-verify-curl' => '$1扩展要求安装PHP[http://www.php.net/manual/en/curl.setup.php cURL函数]。',
	'gwtoolset-verify-finfo' => '$1扩展要求安装PHP[http://www.php.net/manual/en/fileinfo.setup.php finfo]拓展。',
	'gwtoolset-verify-php-version' => '$1拓展需要PHP版本至少5.3.3。',
	'gwtoolset-verify-uploads-enabled' => '$1拓展要求文件上传被启用。请确保<code>LocalSettings.php</code>的<code>$wgEnableUploads</code>设置为<code>true</code>。',
	'gwtoolset-verify-xmlreader' => '$1扩展要求安装PHP[http://www.php.net/manual/en/xmlreader.setup.php XML阅读器]。',
	'gwtoolset-wiki-checks-not-passed' => 'Wiki检查未通过',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author EagerLin
 * @author Liuxinyu970226
 */
$messages['zh-hant'] = array(
	'action-gwtoolset' => '通過gwtoolset',
	'gwtoolset-unaccepted-mime-type-for-xml' => '已確認上載檔案擁有MIME類型「$1」，並且尚無法支援。XML檔案頁頂是否有以下XML位元聲明？
&lt;?xml version="1.0" encoding="UTF-8"?>',
	'gwtoolset-mapping-media-file-url-bad' => '不能計算該媒體檔案的 URL。該 URL 提供的內容不由該擴展尚未處理的方式，或者是一個 HTTP 要求的問題。給予 URL 是" $1 "。HTTP 要求錯誤" $2 "',
	'gwtoolset-step-2-instructions-1' => '以下為：',
	'gwtoolset-required-group' => '您並非$1組成員。',
	'gwtoolset-verify-api-enabled' => '$1擴展要求wiki API啟用。請確信於<code>DefaultSettings.php</code>檔案之<code>$wgEnableAPI</code>設定為<code>true</code>或於<code>LocalSettings.php</code>檔案重寫為<code>true</code>。',
);
