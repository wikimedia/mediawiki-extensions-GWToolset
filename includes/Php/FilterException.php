<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace Php;
use Exception,
	Html;

class FilterException extends Exception {
	public function __construct( $message = null, $code = 0, Exception $previous = null ) {
		$this->message = Html::rawElement( 'span', array( 'class' => 'error' ), $message );
		$this->code = $code;

		if ( ini_get( 'display_errors' ) ) {
			$this->message .= Html::rawElement( 'pre', array( 'style' => 'overflow:auto;' ), print_r( debug_backtrace(), true ) );
		}
	}
}
