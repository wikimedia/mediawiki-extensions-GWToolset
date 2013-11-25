<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Forms;
use Html,
	GWToolset\Adapters\Php\MediawikiTemplatePhpAdapter,
	GWToolset\Config,
	GWToolset\Constants,
	GWToolset\Utils,
	GWToolset\Helpers\FileChecks,
	GWToolset\Models\MediawikiTemplate,
	Linker,
	SpecialPage,
	Title;

class MetadataDetectForm {

	/**
	 * returns an html form for step 1 : Metadata Detect
	 *
	 * @param {SpecialPage} $SpecialPage
	 *
	 * @return {string}
	 * an html form
	 */
	public static function getForm( SpecialPage $SpecialPage ) {
		$namespace = Utils::getNamespaceName( Config::$metadata_namespace );
		$MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplatePhpAdapter() );

		return
			Html::rawElement(
				'h2',
				array(),
				wfMessage( 'gwtoolset-step-1-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-1' )->escaped()
			) .

		Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-li-1' )->escaped()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-li-2' )->escaped()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-li-3' )->escaped()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-li-4' )->escaped()
			) .

			Html::closeElement( 'ol' ) .

			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-step-1-instructions-2' )
			) .

			Html::openElement(
				'form',
				array(
					'id' => 'gwtoolset-form',
					'action' => $SpecialPage->getContext()->getTitle()->getFullURL(),
					'method' => 'post',
					'enctype' => 'multipart/form-data'
				)
			) .

			Html::openElement( 'fieldset' ) .

			Html::rawElement(
				'legend',
				array(),
				wfMessage( 'gwtoolset-upload-legend' )->escaped()
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-form',
					'value' => 'metadata-detect'
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'wpEditToken',
					'value' => $SpecialPage->getUser()->getEditToken()
				)
			) .

			Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				array(),
				Html::rawElement(
					'label',
					array(),
					wfMessage( 'gwtoolset-record-element-name' )->escaped() .
					Html::rawElement(
						'input',
						array(
							'type' => 'text',
							'name' => 'gwtoolset-record-element-name',
							'placeholder' => 'record'
						)
					) .
					Html::rawElement(
						'span',
						array( 'class' => 'required' ),
						' *'
					)
				)
			) .

			Html::rawElement(
				'li',
				array(),
				Html::rawElement(
					'label',
					array(),
					wfMessage( 'gwtoolset-which-mediawiki-template' )->escaped() .
					$MediawikiTemplate->getTemplatesAsSelect( 'gwtoolset-mediawiki-template-name' ) .
					Html::rawElement(
						'span',
						array( 'class' => 'required' ),
						' *'
					)
				)
			) .

			Html::rawElement(
				'li',
				array(),
				Html::rawElement(
					'label',
					array(),
					wfMessage( 'gwtoolset-which-metadata-mapping' )->escaped() .
					Html::rawElement(
						'input',
						array(
							'type' => 'text',
							'name' => 'gwtoolset-metadata-mapping-url',
							'class' => 'gwtoolset-url-input',
							'placeholder' => $namespace .
								Utils::sanitizeString( Config::$metadata_mapping_subpage ) .
								'/User-name/mapping-name.json'
						)
					) .
					Html::rawElement( 'br' ) .
					Linker::link(
						Title::newFromText(
							'Special:PrefixIndex/' . $namespace . Config::$metadata_mapping_subpage
						),
						$namespace . Utils::sanitizeString( Config::$metadata_mapping_subpage ),
						array( 'target' => '_blank' )
					)
				)
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-ensure-well-formed-xml' )->params(
					Html::rawElement(
						'a',
						array(
							'href' => 'http://www.w3schools.com/xml/xml_validator.asp',
							'target' => '_blank'
						),
						'XML Validator'
					)
				)->plain() .
				Html::rawElement(
					'span',
					array( 'class' => 'required' ),
					' *'
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-metadata-file-source' )->escaped() .
				self::getMetadataFileUrlExtraInstructions() .
				Html::rawElement(
					'ul',
					array(),
					self::getMetadataFileUrlInput( $namespace ) .
					Html::rawElement(
						'li',
						array(),
						wfMessage( 'gwtoolset-metadata-file-upload' )->escaped() .
						Html::rawElement(
							'input',
							array(
								'type' => 'file',
								'name' => 'gwtoolset-metadata-file-upload',
								'accept' => FileChecks::getFileAcceptAttribute( Config::$accepted_metadata_types )
							)
						) .
						Html::rawElement( 'br' ) .
						'<i>' .
						wfMessage( 'gwtoolset-accepted-file-types' )->escaped() . ' ' .
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
				array(),
				Html::rawElement(
					'span',
					array( 'class' => 'required' ),
					'* '
				) .
				wfMessage( 'gwtoolset-required-field' )->escaped()
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'submit',
					'name' => 'submit',
					'value' => wfMessage( 'gwtoolset-submit' )->escaped()
				)
			) .

			Html::closeElement( 'form' );
	}

	public static function getMetadataFileUrlExtraInstructions() {
		$result = null;

		if ( Constants::USE_FILEBACKEND ) {
			return $result;
		}

		$result = Html::rawElement( 'br' ) .
			wfMessage( 'gwtoolset-metadata-file-source-info' )->escaped();

		return $result;
	}

	public static function getMetadataFileUrlInput( $namespace ) {
		$result = null;

		if ( Constants::USE_FILEBACKEND ) {
			return $result;
		}

		$result = Html::rawElement(
			'li',
			array(),
			Html::rawElement(
				'label',
				array(),
				wfMessage( 'gwtoolset-metadata-file-url' )->escaped() .
				Html::rawElement(
					'input',
					array(
						'type' => 'text',
						'name' => 'gwtoolset-metadata-file-url',
						'class' => 'gwtoolset-url-input',
						'placeholder' => 'Two-images.xml'
					)
				) .
				Html::rawElement( 'br' ) .
				Linker::link(
					Title::newFromText(
						'Special:PrefixIndex/' .
						$namespace .
						Config::$metadata_sets_subpage
					),
					$namespace .
					Utils::sanitizeString( Config::$metadata_sets_subpage ),
					array( 'target' => '_blank' )
				)
			)
		);

		return $result;
	}
}
