<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Handlers;
use SpecialPage;

abstract class SpecialPageHandler {

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
	 * @return {void}
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
	 * entry point
	 * a control method that acts as an entry point for the
	 * SpecialPageHandler and handles execution of the class methods
	 *
	 * @return {void|string}
	 */
	abstract public function execute();

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * @return {string}
	 */
	abstract protected function processRequest();

	/**
	 * gets an html form
	 *
	 * @return {string}
	 */
	abstract public function getHtmlForm();
}
