<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Forms;

use GWToolset\Config;
use GWToolset\Utils;
use Html;
use IContextSource;
use MediaWiki\MediaWikiServices;
use ParserOptions;
use SpecialPage;
use Title;

class PreviewForm {

	/**
	 * returns an html form for step 3 : Batch Preview
	 *
	 * @param IContextSource $Context
	 *
	 * @param array $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param array $expected_post_fields
	 *
	 * @param array $metadata_items
	 * each item is either a Title object or an array containing
	 * categories, a Title object, and the wikitext for the item
	 *
	 * @return string
	 * an html form that is filtered
	 */
	public static function getForm(
		IContextSource $Context,
		array $user_options,
		array $expected_post_fields,
		array $metadata_items
	) {
		$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
		$process_button =
			Html::rawElement(
					'input',
					[
						'type' => 'submit',
						'name' => 'submit',
						'value' => wfMessage( 'gwtoolset-process-batch' )->escaped()
					]
				) .
				Html::rawElement( 'br' );

		$step1_link = Html::rawElement(
			'li',
			[],
			$linkRenderer->makeLink(
				SpecialPage::getTitleFor( 'GWToolset' ),
				wfMessage( 'gwtoolset-step-1-heading' )->text(),
				[]
			)
		);

		$step2_link = Html::rawElement(
			'li',
			[],
			Html::rawElement( 'span', [ 'id' => 'step2-link' ], ' ' )
		);

		return
			Html::rawElement(
				'h2',
				[],
				wfMessage( 'gwtoolset-step-3-instructions-heading' )->escaped()
			) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-step-3-instructions-1' )
				->numParams( (int)Config::$preview_throttle )
				->escaped()
			) .

			Html::openElement(
				'form',
				[
					'id' => 'gwtoolset-form',
					'action' => $Context->getTitle()->getFullURL(),
					'method' => 'post'
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-form',
					'value' => 'metadata-preview'
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'id' => 'wpEditToken',
					'name' => 'wpEditToken',
					'value' => $Context->getUser()->getEditToken()
				]
			) .

			Html::rawElement(
				'input',
				[
					'type' => 'hidden',
					'name' => 'gwtoolset-record-begin',
					'value' => 1
				]
			) .

			self::getPostAsHiddenFields( $expected_post_fields ) .

			Html::rawElement(
				'p',
				[],
				wfMessage( 'gwtoolset-step-3-instructions-2' )->parse()
			) .

			wfMessage( 'gwtoolset-step-3-instructions-3' )->parse() .

			Html::rawElement( 'ul', [], $step1_link . $step2_link ) .

			Html::rawElement(
				'p',
				[],
				$process_button
			) .

			Html::closeElement( 'form' ) .

			self::getMetadataAsWikitext( $metadata_items, $Context ) .

			Html::rawElement(
				'a',
				[
					'id' => 'gwtoolset-back-to-top',
					'href' => '#top',
					'title' => wfMessage( 'gwtoolset-back-to-top' )
				],
				wfMessage( 'gwtoolset-back-to-top' )
			);
	}

	/**
	 * a decorator method that creates <input type="hidden"> fields based on the previous $_POST.
	 * this is done to insure that all fields posted in step 2 : Metadata Mapping are maintained
	 * within this form so that when this form posts to create the initial batch job,
	 * it has the mapping information from step 2
	 *
	 * @param array $expected_post_fields
	 *
	 * @return string
	 * the string is filtered
	 */
	public static function getPostAsHiddenFields( array $expected_post_fields ) {
		$result = null;

		foreach ( $expected_post_fields as $key => $value ) {
			if ( $key === 'submit'
				|| $key === 'wpEditToken'
				|| $key === 'gwtoolset-form'
				|| $key === 'gwtoolset-preview'
			) {
				continue;
			}

			if ( isset( $_POST[$key] ) ) {
				$value = $_POST[$key];
			} else {
				continue;
			}

			if ( !is_array( $value ) ) {
				$result .= Html::rawElement(
					'input',
					[
						'type' => 'hidden',
						'name' => Utils::sanitizeString( $key ),
						'value' => Utils::sanitizeString( $value )
					]
				);
			} else {
				foreach ( $value as $sub_value ) {
					$result .= Html::rawElement(
						'input',
						[
							'type' => 'hidden',
							'name' => Utils::sanitizeString( $key ) . '[]',
							'value' => Utils::sanitizeString( $sub_value )
						]
					);
				}
			}
		}

		return $result;
	}

	/**
	 * a decorator method that creates a <ul> with <li>s containing
	 * Title(s), which are the result of processing the metadata file
	 * with the mapping information given in step 2 : Metadata Mapping
	 *
	 * @param array $metadata_items
	 * a collection of MediaWiki Title objects
	 *
	 * @return string
	 * the string contains a Title link assumed to be filtered by Title
	 */
	public static function getMetadataAsTitleList( array $metadata_items ) {
		$result = Html::openElement( 'ul' );
		$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();

		foreach ( $metadata_items as $Title ) {
			if ( $Title instanceof Title ) {
				$result .= Html::rawElement(
					'li',
					[],
					// Use linkKnown to guard against slave lag for new uploads.
					$linkRenderer->makeKnownLink( $Title, null, [ 'target' => '_blank' ] )
				);
			}
		}

		$result .= Html::closeElement( 'ul' );

		return $result;
	}

	/**
	 * a decorator method that creates an HTML preview of the metadata items
	 * after they have been mapped into the chosen MediaWiki template.
	 * No mediafile is shown in order to avoid issues with downloading
	 * large mediafiles.
	 *
	 * @param array $metadata_items
	 * each item is an array containing
	 * $item['categories'] {array}
	 * $item['Title'] {Title}
	 * $item['wikitext'] {string}
	 *
	 * @param IContextSource $Context
	 *
	 * @return string
	 */
	public static function getMetadataAsWikitext(
		array $metadata_items,
		IContextSource $Context
	) {
		$result = null;
		global $wgParser;
		$Skin = $Context->getSkin();
		$Output = $Context->getOutput();

		$parser_options = ParserOptions::newFromContext( $Context );
		$parser_options->setEditSection( false );
		$parser_options->setIsPreview( true );

		foreach ( $metadata_items as $item ) {
			$categories = [];
			$notParsable = [];

			$parser_options->setTargetLanguage(
				$item['Title']->getPageLanguage()
			);

			$parser_out = $wgParser->parse(
				$item['wikitext'],
				$item['Title'],
				$parser_options
			);

			$lang = $item['Title']->getPageViewLanguage();

			// attempt to pre-parse the category in case it contains a template
			// @see https://bugzilla.wikimedia.org/show_bug.cgi?id=65620
			foreach ( $item['categories'] as $key => $value ) {
				$category = $wgParser->parse(
					$key,
					$item['Title'],
					$parser_options
				);

				// find this hacky, but not sure how to retrieve the raw text
				$category = strip_tags( $category->getText() );

				// if the parser was not able to parse a template, {} will be left.
				// only include the text if valid category.
				$catTitle = Title::makeTitleSafe( NS_CATEGORY, $category );
				if ( $catTitle ) {
					$categories[$catTitle->getDBkey()] = 0;
				} else {
					$notParsable[] = $category;
				}
			}

			$Output->setCategoryLinks( $categories );

			$result .=
				Html::openElement(
					'div',
					[
						'class' => 'mw-content-' . $lang->getDir(),
						'dir' => $lang->getDir(),
						'lang' => $lang->getHtmlCode(),
					]
				) .

				Html::rawElement(
					'h2',
					[ 'class' => 'preview-title' ],
					$item['Title']
				) .

				Html::rawElement(
					'div',
					[ 'class' => 'preview-image-placeholder' ],
					Html::rawElement(
						'h4',
						[],
						wfMessage( 'gwtoolset-preview-mediafile-placeholder-heading' )->escaped()
					) .
					wfMessage( 'gwtoolset-preview-mediafile-placeholder-text' )->escaped()
				) .

				$parser_out->getText() .
				$Skin->getCategories() .
				self::getNonParsableCategoriesAsHtml( $notParsable ) .
				Html::closeElement( 'div' );
		}

		// set the page caterogies to nothing
		$Output->setCategoryLinks( [] );

		return $result;
	}

	/**
	 * @param array $notParsable
	 * @return string
	 */
	public static function getNonParsableCategoriesAsHtml(
		array $notParsable = []
	) {
		$result = '';

		if ( empty( $notParsable ) ) {
			return $result;
		}

		$result .=
			Html::rawElement(
				'p',
				[ 'class' => 'error' ],
				wfMessage(
					'gwtoolset-preview-unparsable-categories'
				)
					->params( count( $notParsable ) )
					->parse()
			) .
			Html::openElement( 'ul' );

		foreach ( $notParsable as $category ) {
			$result .= Html::rawElement(
				'li',
				[],
				Utils::sanitizeString( $category )
			);
		}

		$result .= Html::closeElement( 'ul' );

		return $result;
	}

}
