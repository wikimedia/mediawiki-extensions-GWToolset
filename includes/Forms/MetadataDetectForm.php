<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */
namespace GWToolset\Forms;

use Html;
use GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter;
use GWToolset\Config;
use GWToolset\Utils;
use GWToolset\Helpers\FileChecks;
use GWToolset\Models\MediawikiTemplate;
use MediaWiki\MediaWikiServices;
use SpecialPage;
use Title;

class MetadataDetectForm {

	/**
	 * @return null|string
	 */
	public static function getCopyUploadsDomainsAsList() {
		global $wgCopyUploadsDomains;
		$result = null;

		if ( !empty( $wgCopyUploadsDomains ) ) {
			$result = Html::rawElement(
				'h4',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-3-heading' )->parse()
			);

			$result .= Html::rawElement(
				'p',
				[],
				wfMessage(
					'gwtoolset-step-1-instructions-3',
					// @codingStandardsIgnoreStart
					'https://phabricator.wikimedia.org/maniphest/task/create/?projects=Wikimedia-Site-requests&priority=50&title=Add+domain+to+$wgCopyUploadsDomains&description=Please+add+the+following+domain+to+the+wgCopyUploadsDomains+whitelist,+so+that+I+can+use+GWToolset+to+upload+media+files+from+that+domain.+I+have+provided+at+least+3+example+URLs+to+media+files+that+will+be+uploaded+with+GWToolset.%0A%0A%3Cdomain+name%3E%0A%0A%3Cexample+URL%3E%0A%3Cexample+URL%3E%0A%3Cexample+URL%3E'
					// @codingStandardsIgnoreEnd
				)->parse()
			);

			$result .= Html::openElement( 'ul', [ 'id' => 'gwtoolset-whitelist' ] );

			foreach ( $wgCopyUploadsDomains as $domain ) {
				$result .= Html::rawElement(
					'li',
					[],
					Utils::sanitizeString( $domain )
				);
			}

			$result .= Html::closeElement( 'ul' );
		}

		return $result;
	}

	/**
	 * returns an html form for step 1 : Metadata Detect
	 *
	 * @param SpecialPage $SpecialPage
	 *
	 * @return string an html form
	 */
	public static function getForm( SpecialPage $SpecialPage ) {
		$namespace = Utils::getNamespaceName( Config::$metadata_namespace );
		$MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );
		$user = $SpecialPage->getUser();
		$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();

		return Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-intro' )->parse()
			) .

			Html::rawElement(
				'h2',
				[],
				wfMessage( 'gwtoolset-step-1-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-1' )->escaped()
			) .

			Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-li-1' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-li-2' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-li-3' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-li-4' )->escaped()
			) .

			Html::closeElement( 'ol' ) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-step-1-instructions-2', $user->getName() )->parse()
			) .

			self::getCopyUploadsDomainsAsList() .

			Html::openElement(
				'form',
				[
					'id' => 'gwtoolset-form',
					'action' => $SpecialPage->getContext()->getTitle()->getFullURL(),
					'method' => 'post',
					'enctype' => 'multipart/form-data'
				]
			) .

			Html::openElement( 'fieldset' ) .

			Html::rawElement(
				'legend',
				[],
				wfMessage( 'gwtoolset-upload-legend' )->escaped()
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-form',
					'value' => 'metadata-detect'
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'wpEditToken',
					'value' => $user->getEditToken()
				]
			) .

			Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				[],
				Html::rawElement(
					'label',
					[],
					wfMessage( 'gwtoolset-record-element-name' )->escaped() .
					Html::rawElement(
						'input',
						[
							'type' => 'text',
							'name' => 'gwtoolset-record-element-name',
							'placeholder' => 'record'
						]
					) .
					Html::rawElement(
						'span',
						[ 'class' => 'required' ],
						' *'
					)
				)
			) .

			Html::rawElement(
				'li',
				[],
				Html::rawElement(
					'label',
					[],
					wfMessage( 'gwtoolset-which-mediawiki-template' )->escaped() .
					Html::rawElement(
						'span',
						[ 'class' => 'required' ],
						' *'
					)
				) .

				Html::openElement( 'ul' ) .

				Html::rawElement(
					'li',
					[],
					wfMessage( 'gwtoolset-select-template' )->escaped() .
					Html::rawElement( 'br' ) .
					$MediawikiTemplate->getTemplatesAsSelect( 'gwtoolset-mediawiki-template-name' )
				) .

				Html::rawElement(
					'li',
					[],
					wfMessage( 'gwtoolset-select-custom-template' ) .
					Html::rawElement( 'br' ) .
					Html::rawElement(
						'input',
						[
							'type' => 'text',
							'name' => 'gwtoolset-mediawiki-template-custom',
							'class' => 'gwtoolset-wider-input',
							'placeholder' => 'TorontoHollarCollection'
						]
					)
				) .

				Html::closeElement( 'ul' )
			) .

			Html::rawElement(
				'li',
				[],
				Html::rawElement(
					'label',
					[],
					wfMessage( 'gwtoolset-which-metadata-mapping' )->escaped() .
					Html::rawElement(
						'input',
						[
							'type' => 'text',
							'name' => 'gwtoolset-metadata-mapping-url',
							'class' => 'gwtoolset-wider-input',
							'placeholder' => $namespace .
								Utils::sanitizeString( Config::$metadata_mapping_subpage ) .
								'/User-name/mapping-name.json'
						]
					) .
					Html::rawElement( 'br' ) .
					$linkRenderer->makeLink(
						Title::newFromText(
							'Special:PrefixIndex/' . $namespace . Config::$metadata_mapping_subpage
						),
						$namespace . Utils::sanitizeString( Config::$metadata_mapping_subpage ),
						[ 'target' => '_blank' ]
					)
				)
			) .

			Html::rawElement(
				'li',
				[],
				Html::rawElement(
					'label',
					[],
					wfMessage( 'gwtoolset-mediafile-throttle' )->escaped() .
					Html::rawElement(
						'input',
						[
							'type' => 'text',
							'name' => 'gwtoolset-mediafile-throttle',
							'min' => Config::$mediafile_job_throttle_min,
							'max' => Config::$mediafile_job_throttle_max,
							'maxlength' => 2,
							'size' => 2,
							'placeholder' => Config::$mediafile_job_throttle_default
						]
					)
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-mediafile-throttle-description' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-ensure-well-formed-xml' )->params(
					Html::rawElement(
						'a',
						[
							'href' => 'http://www.w3schools.com/xml/xml_validator.asp',
							'target' => '_blank',
							'class' => 'external free',
							'rel' => 'nofollow'
						],
						'XML Validator'
					)
				)->plain() .
				Html::rawElement(
					'span',
					[ 'class' => 'required' ],
					' *'
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-metadata-file-source' )->escaped() .
				self::getMetadataFileUrlExtraInstructions() .
				Html::rawElement(
					'ul',
					[],
					self::getMetadataFileUrlInput( $namespace ) .
					Html::rawElement(
						'li',
						[],
						wfMessage( 'gwtoolset-metadata-file-upload' )->escaped() .
						Html::rawElement(
							'input',
							[
								'type' => 'file',
								'name' => 'gwtoolset-metadata-file-upload',
								'accept' => FileChecks::getFileAcceptAttribute(
									Config::$accepted_metadata_types )
							]
						) .
						Html::rawElement( 'br' ) .
						'<i>' .
						wfMessage( 'gwtoolset-accepted-file-types' )
							->numParams( count( Config::$accepted_metadata_types ) )
							->escaped() . ' ' .
						FileChecks::getAcceptedExtensionsAsList( Config::$accepted_metadata_types ) .
						Html::rawElement( 'br' ) .
						wfMessage( 'upload-maxfilesize' )
							->params( number_format( FileChecks::getMaxUploadSize() / 1024 ) )
							->escaped() .
							' kilobytes' .
						'</i>'
					)
				)
			) .

			Html::closeElement( 'ol' ) .
			Html::closeElement( 'fieldset' ) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'span',
					[ 'class' => 'required' ],
					'*'
				) . ' ' .
				wfMessage( 'gwtoolset-required-field' )->escaped()
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'submit',
					'name' => 'submit',
					'value' => wfMessage( 'gwtoolset-submit' )->escaped()
				]
			) .

			Html::closeElement( 'form' );
	}

	/**
	 * @FIXME what is the point of this function
	 * @return null
	 */
	public static function getMetadataFileUrlExtraInstructions() {
		return null;
	}

	/**
	 * @FIXME what is the point of this function
	 * @param int $namespace
	 * @return null
	 */
	public static function getMetadataFileUrlInput( $namespace ) {
		return null;
	}
}
