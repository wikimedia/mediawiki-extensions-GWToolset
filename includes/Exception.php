<?php
namespace GWToolset;
use Html;

class Exception extends \Exception {
	public function __construct( $message = null, $code = 0, Exception $previous = null ) {
		$this->message = $message;
		$this->code = $code;

		if ( ini_get( 'display_errors' ) ) {
			$this->message .= Html::rawElement( 'pre', array( 'style' => 'overflow:auto;' ), print_r( $this, true ) );
		}
	}
}
