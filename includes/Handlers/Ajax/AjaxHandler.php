<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Handlers\Ajax;
use	GWToolset\Handlers\SpecialPageHandler,
	GWToolset\Helpers\WikiChecks,
	Status;

abstract class AjaxHandler extends SpecialPageHandler {

	/**
	 * gets an html form.
	 * not needed in this class
	 */
	public function getHtmlForm() {
	}

	/**
	 * entry point
	 * a control method that acts as an entry point for the
	 * SpecialPageHandler and handles execution of the class methods
	 */
	public function execute() {
		$result = WikiChecks::doesEditTokenMatch( $this->SpecialPage );

		if ( $result->ok ) {
			$result = $this->processRequest();
		}

		set_error_handler( array( $this, 'swallowErrors' ) );
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( $result );
		exit();
	}

	/**
	 * intended to swallow notice and warnings when display errors is set to true
	 * this should not be the case in a production environment
	 *
	 * @see http://php.net/manual/en/function.set-error-handler.php
	 */
	function swallowErrors() {
	}
}
