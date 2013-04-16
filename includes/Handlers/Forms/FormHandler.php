<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Handlers\Forms;
use Exception,
	GWToolset\Handlers\SpecialPageHandler,
	GWToolset\Helpers\WikiChecks,
	Html,
	Php\Filter;

abstract class FormHandler extends SpecialPageHandler {

	/**
	 * make sure the expected options :
	 * 1. exist
	 * 2. and have a value with strlen > 0
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @param {array} $expected_options
	 *
	 * @throws {Exception}
	 * the exception message has been filtered
	 *
	 * @return {void}
	 */
	protected function checkForRequiredFormFields( array &$user_options, array $expected_options ) {
		$msg = null;

		foreach ( $expected_options as $option ) {
			if ( !array_key_exists( $option, $user_options ) ) {
				$msg .= '<li>' . Filter::evaluate( $option ) . '</li>';
			}

			if ( is_array( $user_options[$option] ) ) {
				if ( strlen( reset( $user_options[$option] ) ) < 1 ) {
					$msg .= '<li>' . Filter::evaluate( $option ) . '</li>';
				}
			} else {
				if ( strlen( $user_options[$option] ) < 1 ) {
					$msg .= '<li>' . Filter::evaluate( $option ) . '</li>';
				}
			}
		}

		if ( $msg !== null ) {
			$msg =
				Html::rawElement( 'p', array( 'class' => 'error' ) , wfMessage( 'gwtoolset-metadata-user-options-error' )->escaped() ) .
				Html::rawElement( 'ul', array(), $msg ) .
				Html::rawElement( 'p', array(), $this->SpecialPage->getBackToFormLink() );

			throw new Exception( $msg );
		}
	}

	/**
	 * @param {string} $module_name
	 *
	 * @throws {Exception}
	 *
	 * @return {string}
	 * the string has not been filtered
	 */
	protected function getFormClass( $module_name ) {
		if ( $module_name === null ) {
			throw new Exception( wfMessage( 'gwtoolset-developer-issue' )->params( wfMessage( 'gwtoolset-no-module' )->escaped() )->parse() );
		}

		return $module_name['form'];
	}

	/**
	 * gets an html form.
	 *
	 * gets an html form based on a module name. modules handle
	 * different stages of the upload process
	 *
	 * 1. detection
	 * 2. mapping
	 * 3. preview
	 * 4. batch upload
	 *
	 * @param {string} $module_name
	 *
	 * @throws {Exception}
	 *
	 * @return {string}
	 * the string has not been filtered
	 */
	public function getHtmlForm( $module_name = null ) {
		$form_class = $this->getFormClass( $module_name );

		if ( !class_exists( $form_class ) ) {
			throw new Exception( wfMessage( 'gwtoolset-no-form' )->escaped() );
		}

		return $form_class::getForm( $this->SpecialPage );
	}

	/**
	 * entry point
	 * a control method that acts as an entry point for the
	 * SpecialPageHandler and handles execution of the class methods
	 *
	 * @return {string}
	 * the string has not been filtered
	 */
	public function execute() {
		$result = WikiChecks::doesEditTokenMatch( $this->SpecialPage );

		if ( !$result->ok ) {
			$result =
				wfMessage( 'gwtoolset-wiki-checks-not-passed' )->parse() .
				Html::rawElement( 'span', array( 'class' => 'error' ), $result->getMessage() );
		} else {
			$result = $this->processRequest();
		}

		return $result;
	}
}
