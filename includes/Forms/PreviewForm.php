<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Forms;
use GWToolset\Config,
	GWToolset\Helpers\FileChecks,
	Html,
	IContextSource,
	Linker,
	Php\Filter,
	Title;

class PreviewForm {

	/**
	 * returns an html form for step 3 : Batch Preview
	 *
	 * @param {IContextSource} $Context
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {string} $results
	 * an html string that contains links to the results of the preview batch upload
	 * the string should have already been filtered
	 *
	 * @return {string}
	 * an html form that is filtered
	 */
	public static function getForm( IContextSource $Context, array &$user_options, array &$mediafile_titles ) {
		$process_button =
			(int)$user_options['record-count'] > (int)Config::$preview_throttle
			? Html::rawElement(
					'input',
					array(
						'type' => 'submit',
						'name' => 'submit',
						'value' => wfMessage( 'gwtoolset-process-batch' )->escaped()
					)
				) .
				Html::rawElement( 'br' )
			: wfMessage( 'gwtoolset-no-more-records' )->parse() . Html::rawElement( 'br' );

		$step1_link = Linker::link(
			Title::newFromText( 'Special:GWToolset' ),
			'Step 1 : Metadata Detect',
			array(),
			array( 'gwtoolset-form' => 'metadata-detect' )
		) . Html::rawElement( 'br' );

		$step2_link = Html::rawElement( 'span', array( 'id' =>'step2-link' ), ' ' );

		return
			Html::rawElement(
				'h2',
				array(),
				wfMessage( 'gwtoolset-step-3-instructions-heading' )->escaped()
			) .


			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-step-3-instructions-1' )->params( (int)Config::$preview_throttle )->parse()
			) .

			Html::rawElement(
				'h3',
				array(),
				wfMessage( 'gwtoolset-results' )->escaped()
			) .

			self::getTitlesAsList( $mediafile_titles ) .

			Html::openElement(
				'form',
				array(
					'id' => 'gwtoolset-form',
					'action' => $Context->getTitle()->getFullURL(),
					'method' => 'post'
				)
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
					'id' => 'wpEditToken',
					'name' => 'wpEditToken',
					'value' => $Context->getUser()->getEditToken()
				)
			) .

			Html::rawElement(
				'input',
				array(
					'type' => 'hidden',
					'name' => 'record-begin',
					'value' => (int)$user_options['record-count']
				)
			) .

			self::getPostAsHiddenFields() .

			Html::rawElement(
				'p',
				array(),
				wfMessage( 'gwtoolset-step-3-instructions-2' )->parse()
			) .

			Html::rawElement(
				'p',
				array(),
				$process_button
			) .

			wfMessage( 'gwtoolset-step-3-instructions-3' )->parse() .

			Html::closeElement( 'form' ) .

			$step1_link .
			$step2_link;
	}

	/**
	 * a decorator method that creates <input type="hidden"> fields
	 * based on the previous $_POST. this is done to insure that all
	 * fields posted in step 2 : Metadata Mapping are maintained
	 * within this form, so that when this form posts to create the
	 * initial batch job, it has the mapping information from step 2
	 *
	 * @return {string}
	 * the string is filtered
	 */
	public static function getPostAsHiddenFields() {
		$result = null;

		foreach ( $_POST as $key => $value ) {
			if ( $key === 'submit'
				|| $key === 'wpEditToken'
				|| $key === 'gwtoolset-form'
				|| $key === 'gwtoolset-preview'
			) {
				continue;
			}

			if ( !is_array( $value ) ) {
				$result .= Html::rawElement(
					'input',
					array(
						'type' => 'hidden',
						'name' => Filter::evaluate( $key ),
						'value' => Filter::evaluate( $value )
					)
				);
			} else {
				foreach ( $value as $sub_value ) {
					$result .= Html::rawElement(
						'input',
						array(
							'type' => 'hidden',
							'name' => Filter::evaluate( $key ) . '[]',
							'value' => Filter::evaluate( $sub_value )
						)
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
	 * @param {array} $mediafile_titles
	 * a collection of MediaWiki Title objects
	 *
	 * @return {string}
	 * the string contains a Title link assumed to be filtered by Title
	 */
	public static function getTitlesAsList( array &$mediafile_titles ) {
		$result = Html::openElement( 'ul' );

		foreach ( $mediafile_titles as $Title ) {
			if ( $Title instanceof Title ) {
				$result .= Html::rawElement(
					'li',
					array(),
					Linker::link( $Title, null, array( 'target' => '_blank' ) )
				);
			}
		}

		$result .= Html::closeElement( 'ul' );

		return $result;
	}
}