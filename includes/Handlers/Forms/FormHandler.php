<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */
namespace GWToolset\Handlers\Forms;

use GWToolset\GWTException;
use GWToolset\Helpers\WikiChecks;
use GWToolset\SpecialGWToolset;
use Html;
use MWException;
use User;

abstract class FormHandler {

	/**
	 * @var SpecialGWToolset
	 */
	public $SpecialPage;

	/**
	 * @var User
	 */
	public $User;

	/**
	 * @param array $options
	 */
	public function __construct( array $options = [] ) {
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
	 * @param array $userOptions
	 * an array of user options that was submitted in the html form
	 *
	 * @param array $expected_options
	 *
	 * @throws GWTException
	 * the exception message has been filtered
	 */
	protected function checkForRequiredFormFields( array $userOptions, array $expected_options ) {
		$msg = null;

		$count = 0;
		foreach ( $expected_options as $option ) {
			if ( !array_key_exists( $option, $userOptions ) ) {
				$msg .= '* ' . $option . PHP_EOL;
				$count++;
			}

			if ( is_array( $userOptions[$option] ) ) {
				if ( strlen( reset( $userOptions[$option] ) ) < 1 ) {
					$msg .= '* ' . $option . PHP_EOL;
					$count++;
				}
			} else {
				if ( strlen( $userOptions[$option] ) < 1 ) {
					$msg .= '* ' . $option . PHP_EOL;
					$count++;
				}
			}
		}

		if ( $msg !== null ) {
			$msg .= $this->SpecialPage->getBackToFormLink();

			throw new GWTException(
				[ 'gwtoolset-metadata-user-options-error' => [ $msg, $count ] ]
			);
		}
	}

	/**
	 * @param string|null $module
	 * @throws MWException
	 * @return string
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
	 * @param string|null $module
	 *
	 * @throws GWTException
	 *
	 * @return string
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
	 * @return string
	 * the string has not been filtered
	 */
	public function execute() {
		$result = WikiChecks::doesEditTokenMatch( $this->SpecialPage );

		if ( !$result->isOK() ) {
			$result =
				Html::rawElement(
					'h2',
					[],
					wfMessage( 'gwtoolset-wiki-checks-not-passed' )->escaped()
				) .
				Html::rawElement( 'span', [ 'class' => 'error' ], $result->getMessage() );
		} else {
			$result = $this->processRequest();
		}

		return $result;
	}

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * @return string
	 */
	abstract protected function processRequest();
}
