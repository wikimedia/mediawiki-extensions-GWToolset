<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use Exception,
	GWToolset\Utils;

class GWTException extends Exception {

	/**
	 * @param {string|array} $message
	 * allows for the message to contain a simple string, simple wfMessage or complex wfMessage.
	 * - e.g., simple string $message = 'My error message'
	 * - e.g., simple wfMessage $message = 'gwtoolset-key'
	 * - e.g., complex wfMessage $message = array( 'gwtoolset-key' => array( $param1, $param2 ) )
	 *
	 * @param {int} code
	 *
	 * @param {Exception} $previous
	 */
	public function __construct( $message = '', $code = 0, Exception $previous = null ) {
		$message = $this->processMessage( $message );
		parent::__construct( $message, $code, $previous );
	}

	/**
	 * @param {string|array} $message
	 * - if the message is an array, the array key is considered the i18n key, and its value,
	 *   an array of parameters for that i18n key
	 * - if the message is a string and contains gwtoolset- then it is assumed to be
	 *   a simple wfMessage
	 * - otherwise it is assumed that the message is a “regular” message string
	 *
	 * @return {string}
	 */
	protected function processMessage( $message ) {
		$result = null;

		if ( is_array( $message ) ) {
			foreach ( $message as $key => $params ) {
				$result .= wfMessage( $key )->params( $params )->parse();
			}
		} else if ( strpos( $message, 'gwtoolset-' ) !== false ) {
			$result .= wfMessage( $message )->parse();
		} else {
			$result = Utils::sanitizeString( $message );
		}

		return $result;
	}

}
