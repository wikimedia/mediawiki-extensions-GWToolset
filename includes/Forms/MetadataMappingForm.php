<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */
namespace GWToolset\Forms;

use GWToolset\Handlers\Forms\MetadataDetectHandler;
use Html;
use GWToolset\Config;
use GWToolset\Utils;
use MediaWiki\MediaWikiServices;
use Title;

class MetadataMappingForm {

	/**
	 * returns an html form for step 2 : Metadata Mapping
	 *
	 * @param MetadataDetectHandler $Handler
	 *
	 * @param array &$user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @return string
	 * an html form
	 */
	public static function getForm( MetadataDetectHandler $Handler, array &$user_options ) {
		$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
		$template_link = '[[Template:' .
			Utils::sanitizeString( $user_options['gwtoolset-mediawiki-template-name'] ) .
			']]';
		$metadata_file_url = !empty( $user_options['Metadata-Title'] )
			? $linkRenderer->makeLink( $user_options['Metadata-Title'], null,
				[ 'target' => '_blank' ] ) . Html::rawElement( 'br' )
			: null;

		return Html::rawElement(
				'h2',
				[],
				wfMessage( 'gwtoolset-step-2-heading' )->escaped()
			) .

			Html::rawElement(
				'h3',
				[],
				wfMessage( 'gwtoolset-metadata-file' )->parse()
			) .

			Html::rawElement(
				'p',
				[],
				$metadata_file_url .
				wfMessage( 'gwtoolset-record-count' )
					->numParams( (int)$user_options['gwtoolset-record-count'] )->escaped()
			) .

			Html::rawElement(
				'h4',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-1' )->escaped()
			) .

			Html::openElement( 'ul' ) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-1-li-1' )
					->params( $template_link )->parse()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-1-li-2' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-1-li-3' )->escaped()
			) .

			Html::closeElement( 'ul' ) .

			Html::rawElement(
				'h5',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-2' )->escaped()
			) .

			Html::openElement( 'ol' ) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-2-li-1' )->escaped()
			) .

			Html::rawElement(
				'li',
				[],
				wfMessage( 'gwtoolset-step-2-instructions-2-li-2' )->escaped()
			) .

			Html::closeElement( 'ol' ) .

			Html::openElement(
				'form',
				[
					'id' => 'gwtoolset-form',
					'action' => $Handler->SpecialPage->getContext()->getTitle()->getFullURL(),
					'method' => 'post'
				]
			) .

			Html::openElement( 'fieldset' ) .

			Html::rawElement(
				'legend',
				[],
				wfMessage( 'gwtoolset-metadata-mapping-legend' )->escaped()
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-form',
					'value' => 'metadata-mapping'
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-preview',
					'value' => 'true'
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-mediafile-throttle',
					'value' => (int)$user_options['gwtoolset-mediafile-throttle']
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'gwtoolset-mediawiki-template-name',
					'name' => 'gwtoolset-mediawiki-template-name',
					'value' => Utils::sanitizeString(
						$user_options['gwtoolset-mediawiki-template-name'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-url',
					'value' => Utils::sanitizeString( $user_options['gwtoolset-metadata-file-url'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-mapping-name',
					'name' => 'gwtoolset-metadata-mapping-name',
					'value' => Utils::sanitizeString(
						$user_options['gwtoolset-metadata-mapping-name'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-mapping-url',
					'value' => Utils::sanitizeString(
						$user_options['gwtoolset-metadata-mapping-url'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-relative-path',
					'value' => Utils::sanitizeUrl(
						$user_options['gwtoolset-metadata-file-relative-path'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-metadata-file-sha1',
					'value' => Utils::sanitizeString(
						$user_options['gwtoolset-metadata-file-sha1'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-record-count',
					'value' => (int)$user_options['gwtoolset-record-count']
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-record-element-name',
					'value' => Utils::sanitizeString(
						$user_options['gwtoolset-record-element-name'] )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-namespace',
					'name' => 'gwtoolset-metadata-namespace',
					'value' => Utils::sanitizeString(
						Utils::getNamespaceName( Config::$metadata_namespace ) )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'gwtoolset-metadata-mapping-subpage',
					'name' => 'gwtoolset-metadata-mapping-subpage',
					'value' => Utils::sanitizeString( Config::$metadata_mapping_subpage )
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'wpEditToken',
					'name' => 'wpEditToken',
					'value' => $Handler->User->getEditToken()
				]
			) .

			Html::rawElement(
				'h3',
				[],
				wfMessage( 'gwtoolset-mediawiki-template' )
					->params( Utils::sanitizeString(
						$user_options['gwtoolset-mediawiki-template-name'] ) )
					->escaped()
			) .

			Html::rawElement(
				'table',
				[
					'id' => 'template-table',
					'style' => 'float:left;margin-right:2%;margin-bottom:1em;'
				],
				Html::rawElement(
					'thead',
					[],
					Html::rawElement(
						'tr',
						[],
						Html::rawElement(
							'th',
							[],
							wfMessage( 'gwtoolset-template-field' )->escaped()
						) .
						Html::rawElement(
							'th',
							[ 'colspan' => 2 ],
							wfMessage( 'gwtoolset-maps-to' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					[],
					$Handler->getMetadataAsHtmlSelectsInTableRows()
				)
			) .

			Html::rawElement(
				'table',
				[
					'style' => 'float:left;display:inline;width:60%;overflow:auto;'
				],
				Html::rawElement(
					'thead',
					[],
					Html::rawElement(
						'tr',
						[],
						Html::rawElement(
							'th',
							[ 'colspan' => 2 ],
							wfMessage( 'gwtoolset-example-record' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					[ 'style' => 'vertical-align:top;' ],
					$Handler->XmlDetectHandler->getMetadataAsHtmlTableRows( $user_options )
				)
			) .

			Html::rawElement(
				'p',
				[
					'style' => 'clear:both;padding-top:2em;'
				],
				Html::rawElement(
					'span',
					[ 'class' => 'required' ],
					'*'
				) . ' ' .
				wfMessage( 'gwtoolset-required-field' )->escaped()
			) .

			wfMessage( 'copyrightwarning2' )->parseAsBlock() .

			// creator template
			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-wrap-creator-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-wrap-creator',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-wrap-creator' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-wrap-creator-explanation' )->parse()
				)
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-reverse-creator',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-reverse-creator' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-reverse-creator-explanation' )->escaped()
				)
			) .

			// institution template
			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-wrap-institution-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-wrap-institution',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-wrap-institution' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-wrap-institution-explanation' )->parse()
				)
			) .

			// language template
			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-wrap-language-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-wrap-language',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-wrap-language' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-wrap-language-explanation' )->parse()
				)
			) .

			// permission/license template
			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-detect-license-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-detect-license',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-detect-license' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-detect-license-explanation' )->parse()
				)
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'span',
					[ 'style' => 'font-style:italic;text-decoration:underline;' ],
					wfMessage( 'gwtoolset-global-license' )->escaped()
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-global-license-explanation' )->escaped()
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'text',
					'name' => 'gwtoolset-global-license',
					'placeholder' => wfMessage( 'gwtoolset-global-license' )->text(),
					'class' => 'gwtoolset-url-input'
				]
			) .

			// global categories
			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'categories' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'span',
					[ 'style' => 'font-style:italic;text-decoration:underline;' ],
					wfMessage( 'gwtoolset-global-categories' )->escaped()
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-global-tooltip' )->parse()
			) .

			Html::rawElement(
				'table',
				[ 'id' => 'global-categories-table' ],
				Html::rawElement(
					'tbody',
					[],
					Html::rawElement(
						'tr',
						[],
						Html::rawElement(
							'td',
							[],
							Html::rawElement(
								'label',
								[ 'for' => 'gwtoolset-category' ],
								wfMessage( 'gwtoolset-category' )->escaped()
							)
						) .
						Html::rawElement(
							'td',
							[ 'class' => 'button-add' ]
						) .
						Html::rawElement(
							'td',
							[],
							Html::rawElement(
								'input',
								[
									'type' => 'text',
									'id' => 'gwtoolset-category',
									'name' => 'gwtoolset-category[]'
								]
							)
						)
					)
				)
			) .

			Html::rawElement(
				'p',
				[ 'style' => 'margin-top:1em;' ],
				Html::rawElement(
					'span',
					[ 'style' => 'font-style:italic;text-decoration:underline;' ],
					wfMessage( 'gwtoolset-specific-categories' )->escaped()
				) .
				Html::rawElement( 'br' ) .
				wfMessage( 'gwtoolset-specific-tooltip' )->parse()
			) .

			Html::rawElement(
				'table',
				[ 'id' => 'item-specific-categories-table' ],
				Html::rawElement(
					'thead',
					[],
					Html::rawElement(
						'tr',
						[],
						Html::rawElement(
							'th',
							[],
							'&nbsp;'
						) .
						Html::rawElement(
							'th',
							[],
							wfMessage( 'gwtoolset-phrasing' )->escaped()
						) .
						Html::rawElement(
							'th',
							[],
							wfMessage( 'gwtoolset-metadata-field' )->escaped()
						)
					)
				) .
				Html::rawElement(
					'tbody',
					[],
					Html::rawElement(
						'tr',
						[],
						Html::rawElement(
							'td',
							[ 'class' => 'button-add' ]
						) .
						Html::rawElement(
							'td',
							[],
							Html::rawElement(
								'input',
								[
									'type' => 'text',
									'name' => 'gwtoolset-category-phrase[]',
									'placeholder' => wfMessage( 'gwtoolset-painted-by' )->text()
								]
							)
						) .
						Html::rawElement(
							'td',
							[],
							Html::rawElement(
								'select',
								[
									'name' => 'gwtoolset-category-metadata[]'
								],
								$Handler->XmlDetectHandler->getMetadataAsOptions()
							)
						)
					)
				)
			) .

			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-partner' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-partner-explanation' )->escaped() .
				Html::rawElement( 'br' ) .
				Html::rawElement(
					'label',
					[],
					wfMessage( 'gwtoolset-partner-template' )->escaped() .
					Html::rawElement(
						'input',
						[
							'type' => 'text',
							'name' => 'gwtoolset-partner-template-url',
							'placeholder' => 'Template:Europeana',
							'class' => 'gwtoolset-wider-input'
						]
					)
				) .
				Html::rawElement( 'br' ) .
				$linkRenderer->makeLink(
					Title::newFromText( 'Category:' . Config::$source_templates ),
					null,
					[ 'target' => '_blank' ]
				)
			) .

			Html::rawElement(
				'h3',
				[ 'style' => 'margin-top:1em;' ],
				wfMessage( 'gwtoolset-summary-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'input',
					[
						'type' => 'text',
						'id' => 'wpSummary',
						'name' => 'wpSummary',
					]
				)
			) .

			Html::rawElement(
				'p',
				[],
				Html::rawElement(
					'label',
					[],
					Html::rawElement(
						'input',
						[
							'type' => 'checkbox',
							'name' => 'gwtoolset-reupload-media',
							'value' => 'true'
						]
					) .
					' ' . wfMessage( 'gwtoolset-reupload-media' )->escaped() .
					Html::rawElement( 'br' ) .
					wfMessage( 'gwtoolset-reupload-media-explanation' )->escaped()
				)
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'submit',
					'name' => 'submit',
					'value' => wfMessage( 'gwtoolset-preview' )->text()
				]
			) .

			Html::closeElement( 'fieldset' ) .
			Html::closeElement( 'form' );
	}
}
