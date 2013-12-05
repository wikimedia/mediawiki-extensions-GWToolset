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
	GWToolset\Config,
	GWToolset\Utils,
	GWToolset\Handlers\Forms\FormHandler,
	GWToolset\Helpers\FileChecks,
	IContextSource,
	Linker,
	Title;

class MetadataMappingForm {

	/**
	 * returns an html form for step 2 : Metadata Mapping
	 *
	 * @param {GWToolset\Handlers\Forms\FormHandler} $Handler
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @return {string}
	 * an html form
	 */
	public static function getForm( FormHandler $Handler, array &$user_options ) {

		$template_link = '[[Template:' .
			Utils::sanitizeString( $user_options['gwtoolset-mediawiki-template-name'] ) .
			']]';
		$metadata_file_url = !empty( $user_options['Metadata-Title'] )
			? Linker::link( $user_options['Metadata-Title'], null, array( 'target' => '_blank' ) ) .
				Html::rawElement( 'br' )
			: null;

		return
			Html::rawElement(
				'h2',
				array(),
				wfMessage( 'gwtoolset-step-2-heading' )->escaped()
			) .

			Html::rawElement(
				'h3',
				array(),
				wfMessage( 'gwtoolset-metadata-file' )->parse()
			) .

			Html::rawElement(
				'p',
				array(),
				$metadata_file_url .
				wfMessage( 'gwtoolset-record-count' )
					->params( (int)$user_options['gwtoolset-record-count'] )->escaped()
			) .

			Html::rawElement(
				'h4',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-1' )->escaped()
			) .

			Html::openElement( 'ul' ) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-1-li-1' )->params( $template_link )->parse()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-1-li-2' )->escaped()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-1-li-3' )->escaped()
			) .

			Html::closeElement( 'ul' ) .

			Html::rawElement(
				'h5',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-2' )->escaped()
			) .

			Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-2-li-1' )->escaped()
			) .

			Html::rawElement(
				'li',
				array(),
				wfMessage( 'gwtoolset-step-2-instructions-2-li-2' )->escaped()
			) .

			Html::closeElement( 'ol' ) .

			Html::openElement(
				'form',
				array(
					'id' => 'gwtoolset-form',
					'action' => $Handler->SpecialPage->getContext()->getTitle()->getFullURL(),
					'method' => 'post'
				)
			) .

			Html::openElement( 'fieldset' ) .

			Html::rawElement(
				'legend',
				array(),
				wfMessage( 'gwtoolset-metadata-mapping-legend' )->escaped()
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-form',
					'value' => 'metadata-mapping'
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-preview',
					'value' => 'true'
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'id' => 'gwtoolset-mediawiki-template-name',
					'name' => 'gwtoolset-mediawiki-template-name',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-mediawiki-template-name'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-url',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-metadata-file-url'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-mapping-name',
					'name' => 'gwtoolset-metadata-mapping-name',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-metadata-mapping-name'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-mapping-url',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-metadata-mapping-url'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-relative-path',
					'value' => Utils::sanitizeUrl( $user_options['gwtoolset-metadata-file-relative-path'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-sha1',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-metadata-file-sha1'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-record-count',
					'value' => (int)$user_options['gwtoolset-record-count']
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'gwtoolset-record-element-name',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-record-element-name'] )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-namespace',
					'name' => 'gwtoolset-metadata-namespace',
					'value' => Utils::sanitizeString( Utils::getNamespaceName( Config::$metadata_namespace ) )
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-mapping-subpage',
					'name' => 'gwtoolset-metadata-mapping-subpage',
					'value' => Utils::sanitizeString( Config::$metadata_mapping_subpage )
				)
			) .


			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'id' => 'wpEditToken',
					'name' => 'wpEditToken',
					'value' => $Handler->User->getEditToken()
				)
			) .

			Html::rawElement(
				'h3',
				array(),
				wfMessage( 'gwtoolset-mediawiki-template' )
					->params( Utils::sanitizeString( $user_options['gwtoolset-mediawiki-template-name'] ) )
					->escaped()
			) .

			Html::rawElement(
				'table',
				array(
					'id' => 'template-table',
					'style' => 'float:left;margin-right:2%;margin-bottom:1em;'
				),
				Html::rawElement(
					'thead',
					array(),
					Html::rawElement(
						'tr',
						array(),
						Html::rawElement(
							'th',
							array(),
							wfMessage( 'gwtoolset-template-field' )->escaped()
						) .
						Html::rawElement(
							'th',
							array( 'colspan' => 2 ),
							wfMessage( 'gwtoolset-maps-to' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					array(),
					$Handler->getMetadataAsHtmlSelectsInTableRows( $user_options )
				)
			) .

			Html::rawElement(
				'table',
				array(
					'style' => 'float:left;display:inline;width:60%;overflow:auto;'
				),
				Html::rawElement(
					'thead',
					array(),
					Html::rawElement(
						'tr',
						array(),
						Html::rawElement(
							'th',
							array( 'colspan' => 2 ),
							wfMessage( 'gwtoolset-example-record' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					array( 'style' => 'vertical-align:top;' ),
					$Handler->XmlDetectHandler->getMetadataAsHtmlTableRows( $user_options )
				)
			) .

			Html::rawElement(
				'p',
				array(
					'style' => 'clear:both;padding-top:2em;'
				),
				Html::rawElement(
					'span',
					array( 'class' => 'required' ),
					'*'
				) .
				wfMessage( 'gwtoolset-required-field' )->escaped()
			) .

			wfMessage( 'copyrightwarning2' )->parseAsBlock() .

			Html::rawElement(
				'h3',
				array( 'style' => 'margin-top:1em;'),
				wfMessage( 'categories' )->escaped()
			) .

			Html::rawElement(
				'p',
				array(),
				Html::rawElement(
					'span',
					array( 'style' => 'font-style:italic;text-decoration:underline;' ),
					wfMessage( 'gwtoolset-global-categories' )->escaped()
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-global-tooltip' )->escaped()
			) .

			Html::rawElement(
				'table',
				array( 'id' => 'global-categories-table' ),
				Html::rawElement(
					'tbody',
					array(),
					Html::rawElement(
						'tr',
						array(),
						Html::rawElement(
							'td',
							array(),
							Html::rawElement(
								'label',
								array( 'for' => 'gwtoolset-category' ),
								wfMessage( 'gwtoolset-category' )->escaped()
							)
						) .
						Html::rawElement(
							'td',
							array( 'class' => 'button-add' )
						) .
						Html::rawElement(
							'td',
							array(),
							Html::rawElement(
								'input',
								array(
									'type' => 'text',
									'id' => 'gwtoolset-category',
									'name' => 'gwtoolset-category[]'
								)
							)
						)
					)
				)
			) .

			Html::rawElement(
				'p',
				array( 'style' => 'margin-top:1em;' ),
				Html::rawElement(
					'span',
					array( 'style' => 'font-style:italic;text-decoration:underline;' ),
					wfMessage( 'gwtoolset-specific-categories' )->escaped()
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-specific-tooltip' )->parse()
			) .

			Html::rawElement(
				'table',
				array( 'id' => 'item-specific-categories-table' ),
				Html::rawElement(
					'thead',
					array(),
					Html::rawElement(
						'tr',
						array(),
						Html::rawElement(
							'th',
							array(),
							'&nbsp;'
						) .
						Html::rawElement(
							'th',
							array(),
							wfMessage( 'gwtoolset-phrasing' )->escaped()
						) .
						Html::rawElement(
							'th',
							array(),
							wfMessage( 'gwtoolset-metadata-field' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					array(),
					Html::rawElement(
						'tr',
						array(),
						Html::rawElement(
							'td',
							array( 'class' => 'button-add' )
						) .
						Html::rawElement(
							'td',
							array(),
							Html::rawElement(
								'input',
								array(
									'type' => 'text',
									'name' => 'gwtoolset-category-phrase[]',
									'placeholder' => wfMessage( 'gwtoolset-painted-by' )->escaped()
								)
							)
						) .
						Html::rawElement(
							'td',
							array(),
							Html::rawElement(
								'select',
								array(
									'name' => 'gwtoolset-category-metadata[]'
								),
								$Handler->XmlDetectHandler->getMetadataAsOptions()
							)
						)
					)
				)
			) .

			Html::rawElement(
				'h3',
				array( 'style' => 'margin-top:1em;' ),
				wfMessage( 'gwtoolset-partner' )->escaped()
			) .

			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-partner-explanation' )->escaped() .
				Html::rawElement( 'br' ) .
				Html::rawElement(
					'label',
					array(),
					wfMessage( 'gwtoolset-partner-template' )->escaped() .
					Html::rawElement(
						'input',
						array(
							'type' => 'text',
							'name' => 'gwtoolset-partner-template-url',
							'placeholder' => 'Template:Europeana',
							'class' => 'gwtoolset-url-input'
						)
					)
				) .
				Html::rawElement( 'br' ) .
				Linker::link(
					Title::newFromText( 'Category:' . Config::$source_templates ),
					null,
					array( 'target' => '_blank' )
				)
			) .

			Html::rawElement(
				'h3',
				array( 'style' => 'margin-top:1em;' ),
				wfMessage( 'summary' )->escaped()
			) .

			Html::rawElement(
				'p',
				array(),
				Html::rawElement(
					'input',
					array(
						'type' => 'text',
						'id' => 'wpSummary',
						'name' => 'wpSummary',
						'class' => 'mw-summary',
						'maxlength' => '255',
						'title' => wfMessage( 'gwtoolset-summary-tooltip' )->escaped(),
						'spellcheck' => 'true',
						'accesskey' => 'b'
					)
				)
			) .

			Html::rawElement(
				'p',
				array(),
				Html::rawElement(
					'label',
					array(),
					Html::rawElement(
						'input',
						array(
							'type' => 'checkbox',
							'name' => 'gwtoolset-reupload-media',
							'value' => 'true'
						)
					) .
					' ' . wfMessage( 'gwtoolset-reupload-media' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-reupload-media-explanation' )->escaped()
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'submit',
					'name' => 'submit',
					'value' => wfMessage( 'gwtoolset-preview' )->escaped()
				)
			) .

			Html::closeElement( 'fieldset' ) .
			Html::closeElement( 'form' );
	}
}
