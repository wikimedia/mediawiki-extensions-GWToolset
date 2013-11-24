<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Handlers\Forms;
use	GWToolset\GWTException,
	GWToolset\Utils,
	GWToolset\Helpers\WikiChecks,
	Html,
	MWException,
	SpecialPage;

abstract class FormHandler {

	/**
	 * @var {SpecialPage}
	 */
	public $SpecialPage;

	/**
	 * @var {User}
	 */
	public $User;

	/**
	 * @param {array} $options
	 */
	public function __construct( array $options = array() ) {
		if ( isset( $options['SpecialPage'] ) ) {
			$this->SpecialPage = $options['SpecialPage'];
		}

		if ( isset( $options['User'] ) ) {
			$this->User = $options['User'];
		} elseif ( isset( $this->SpecialPage ) ) {
			$this->User = $this->SpecialPage->getUser();
		}
	}

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
	 * @throws {GWTException}
	 * the exception message has been filtered
	 */
	protected function checkForRequiredFormFields( array &$user_options, array $expected_options ) {
		$msg = null;

		foreach ( $expected_options as $option ) {
			if ( !array_key_exists( $option, $user_options ) ) {
				$msg .= '<li>' . Utils::sanitizeString( $option ) . '</li>';
			}

			if ( is_array( $user_options[$option] ) ) {
				if ( strlen( reset( $user_options[$option] ) ) < 1 ) {
					$msg .= '<li>' . Utils::sanitizeString( $option ) . '</li>';
				}
			} else {
				if ( strlen( $user_options[$option] ) < 1 ) {
					$msg .= '<li>' . Utils::sanitizeString( $option ) . '</li>';
				}
			}
		}

		if ( $msg !== null ) {
			$msg =
				Html::rawElement(
					'p',
					array( 'class' => 'error' ),
					wfMessage( 'gwtoolset-metadata-user-options-error' )->escaped()
				) .
				Html::rawElement( 'ul', array(), $msg ) .
				Html::rawElement( 'p', array(), $this->SpecialPage->getBackToFormLink() );

			throw new GWTException( $msg );
		}
	}

	/**
	 * @param {string} $module
	 * @throws {MWException}
	 * @return {string}
	 */
	public function getFormClass( $module = null ) {
		$registered_modules = $this->SpecialPage->getRegisteredModules();

		if ( $module === null || !array_key_exists( $module, $registered_modules ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-no-module' )->escaped()
					)
					->escaped()
			);
		}

		if ( !isset( $registered_modules[$module]['form'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-no-module' )->escaped()
					)
					->escaped()
			);
		}

		$result = $registered_modules[$module]['form'];

		if ( !class_exists( $result ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-no-module' )->escaped()
					)
					->escaped()
			);
		}

		return $result;
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
	 * @throws {GWTException}
	 *
	 * @return {string}
	 * the string has not been filtered
	 */
	public function getHtmlForm( $module = null ) {
		$form_class = $this->getFormClass( $module );
		return $form_class::getForm( $this->SpecialPage );
	}

	/**
	 * entry point
	 * a control method that acts as an entry point for the
	 * FormHandler and handles execution of the class methods
	 *
	 * @return {string}
	 * the string has not been filtered
	 */
	public function execute() {
		$result = WikiChecks::doesEditTokenMatch( $this->SpecialPage );

		if ( !$result->ok ) {
			$result =
				Html::rawElement(
					'h2',
					array(),
					wfMessage( 'gwtoolset-wiki-checks-not-passed' )->escaped()
				) .
				Html::rawElement( 'span', array( 'class' => 'error' ), $result->getMessage() );
		} else {
			$result = $this->processRequest();
		}

		return $result;
	}

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * @return {string}
	 */
	abstract protected function processRequest();
}
