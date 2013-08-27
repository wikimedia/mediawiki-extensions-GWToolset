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
	GWToolset\Adapters\Db\MediawikiTemplateDbAdapter,
	GWToolset\Config,
	GWToolset\Helpers\FileChecks,
	GWToolset\Models\MediawikiTemplate,
	Linker,
	Php\Filter,
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
		$MediawikiTemplate = new MediawikiTemplate( new MediawikiTemplateDbAdapter() );

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

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'MAX_FILE_SIZE',
					'value' => FileChecks::getMaxUploadSize()
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
							'name' => 'record-element-name',
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
					$MediawikiTemplate->getTemplatesAsSelect( 'mediawiki-template-name' ) .
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
							'name' => 'metadata-mapping-url',
							'class' => 'gwtoolset-url-input',
							'placeholder' => Filter::evaluate( Config::$metadata_namespace ) . Filter::evaluate( Config::$metadata_mapping_subdirectory ) . '/User-name/mapping-name.json'
						)
					) .
					Html::rawElement( 'br' ) .
					Linker::link(
						Title::newFromText( 'Special:PrefixIndex/' . Config::$metadata_namespace . Config::$metadata_mapping_subdirectory ),
						Filter::evaluate( Config::$metadata_namespace ) . Filter::evaluate( Config::$metadata_mapping_subdirectory ),
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
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-metadata-file-source-info' )->escaped() .
				Html::rawElement(
					'ul',
					array(),
					Html::rawElement(
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
									'name' => 'metadata-file-url',
									'class' => 'gwtoolset-url-input',
									'placeholder' => 'Two-images.xml'
								)
							) .
							Html::rawElement( 'br' ) .
							Linker::link(
								Title::newFromText( 'Special:PrefixIndex/' . Config::$metadata_namespace . Config::$metadata_sets_subdirectory ),
								Filter::evaluate( Config::$metadata_namespace ) . Filter::evaluate( Config::$metadata_sets_subdirectory ),
								array( 'target' => '_blank' )
							)
						)
					) .
					Html::rawElement(
						'li',
						array(),
						wfMessage( 'gwtoolset-metadata-file-upload' )->escaped() .
						Html::rawElement(
							'input',
							array(
								'type' => 'file',
								'name' => 'metadata-file-upload',
								'accept' => FileChecks::getFileAcceptAttribute( Config::$accepted_metadata_types )
							)
						) .
						Html::rawElement( 'br' ) .
						'<i>' .
						wfMessage( 'gwtoolset-accepted-file-types' )->escaped() . ' ' . FileChecks::getAcceptedExtensionsAsList( Config::$accepted_metadata_types ) .
						Html::rawElement( 'br' ) .
						wfMessage( 'upload-maxfilesize' )->params( number_format( FileChecks::getMaxUploadSize() / 1024 ) )->escaped() . ' kilobytes' .
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
}
