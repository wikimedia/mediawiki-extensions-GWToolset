<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset;

use Exception;
use Sanitizer;

class GWTException extends Exception {

	/**
	 * @param string|array $message
	 * allows for the message to contain a simple string, simple wfMessage or complex wfMessage.
	 * - e.g., simple string $message = 'My error message'
	 * - e.g., simple wfMessage $message = 'gwtoolset-key'
	 * - e.g., complex wfMessage $message = array( 'gwtoolset-key' => array( $param1, $param2 ) )
	 *
	 * @param int $code
	 *
	 * @param Exception|null $previous
	 */
	public function __construct( $message = '', $code = 0, Exception $previous = null ) {
		$message = $this->processMessage( $message );
		parent::__construct( $message, $code, $previous );
	}

	/**
	 * @param string|array $message
	 * - if the message is an array, the array key is considered the i18n key, and its value,
	 *   an array of parameters for that i18n key
	 * - if the message is a string and contains gwtoolset- then it is assumed to be
	 *   a simple wfMessage
	 * - otherwise it is assumed that the message is a “regular” message string
	 *
	 * @return string
	 *
	 * Hack for T268353:
	 * @param-taint $message none
	 */
	protected function processMessage( $message ) {
		$result = '';

		if ( is_array( $message ) ) {
			foreach ( $message as $key => $params ) {
				$result .= wfMessage( $key )->params( $params )->text();
			}
		} elseif ( strpos( $message, 'gwtoolset-' ) === 0 ) {
			$result .= wfMessage( $message )->text();
		} else {
			$result = $message;
		}

		return Sanitizer::removeHTMLtags( $result );
	}

}
