<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace Php;
use Html;

/**
 * @see http://www.php.net/manual/en/intro.filter.php
 * @see http://www.php.net/manual/en/function.filter-var.php
 */
class Filter {

	/**
	 * @var {string}
	 * the key name of the value in the source array
	 */
	protected static $key_name;

	/**
	 * @var {string}
	 * [default=string] the expected value type
	 */
	protected static $type;

	/**
	 * @var {array}
	 * the source array
	 */
	protected static $source;

	/**
	 * @var {bool}
	 * whether or not the value is required
	 */
	protected static $required;

	/**
	 * @var {bool}
	 * whether or not the value passed the required(), sanitize(), and
	 * validate() methods
	 */
	protected static $valid;

	/**
	 * @var {int}
	 * @see http://www.php.net/manual/en/filter.filters.sanitize.php
	 */
	protected static $filter_sanitize;

	/**
	 * @var {array}
	 * @see http://www.php.net/manual/en/function.filter-var.php (options)
	 */
	protected static $filter_sanitize_options;

	/**
	 * @var {int}
	 * @see http://www.php.net/manual/en/filter.filters.validate.php
	 */
	protected static $filter_validate;

	/**
	 * @var {array}
	 * @see http://www.php.net/manual/en/function.filter-var.php (options)
	 */
	protected static $filter_validate_options;

	/**
	 * @var {string|array}
	 * the original value passed into the class
	 */
	protected static $value_raw;

	/**
	 * @var {bool}
	 * cache whether or not $value_raw is an array so that
	 * is_array() is only called once
	 */
	protected static $value_raw_is_array;

	/**
	 * @var {string}
	 * the result after the $value_raw has passed through all Filter methods
	 */
	protected static $value_result;

	/**
	 * @var {array}
	 * when $value_raw is an array, an array of the results for each $value_raw
	 * element is set to the result for that element after it has passed through
	 * all Filter methods
	 */
	protected static $value_result_array;

	/**
	 * @param {array|string} $options
	 * @return {array|string|null}
	 */
	public static function evaluate( $options = null ) {
		self::reset();
		self::populate( $options );
		self::processElement();

		if ( self::$valid ) {
			if ( self::$value_raw_is_array ) {
				return self::$value_result_array;
			} else {
				return self::$value_result;
			}
		}

		return null;
	}

	/**
	 * @param {array|string} $options
	 * @return {void}
	 */
	protected static function populate( &$options = null ) {
		if ( !is_array( $options ) ) {
			self::$value_raw = $options;

			return;
		}

		if ( isset( $options['source'] ) ) {
			self::$source = $options['source'];
		} else {
			$msg = '$options provided as an array, but no $options[source] provided.';
			throw new FilterException( $msg );
		}

		if ( is_array( self::$source ) ) {
			if ( isset( $options['key-name'] ) ) {
				self::$key_name = $options['key-name'];
			} else {
				$msg = '$options[source] provided as an array, but no $options[key-name] provided.';
				throw new FilterException( $msg );
			}
		}

		if ( isset( $options['type'] ) ) {
			self::$type = $options['type'];
		}

		if ( isset( $options['required'] ) ) {
			self::$required = $options['required'];
		}

		if ( isset( $options['filter-sanitize'] ) ) {
			self::$filter_sanitize = $options['filter-sanitize'];
		}

		if ( is_array( self::$source ) ) {
			if ( isset( self::$source[self::$key_name] ) ) {
				self::$value_raw = self::$source[self::$key_name];
				if ( is_array( self::$value_raw ) ) {
					self::$value_raw_is_array = true;
				}
			} else {
				self::$value_raw = null;
			}
		} else {
			self::$value_raw = self::$source;
		}
	}

	/**
	 * @return {void}
	 */
	protected static function processElement() {
		self::trim();

		if ( self::required()
			&& self::sanitize()
			&& self::validate()
		) {
			self::$valid = true;
		}
	}

	/**
	 * make sure the value is not null and contains something
	 *
	 * @return {bool}
	 */
	protected static function required() {
		if ( !self::$required ) {
			return true;
		}

		if ( self::$value_raw_is_array ) {
			if ( empty( self::$value_raw ) ) {
				return false;
			}

			foreach ( self::$value_result_array as $key => $value ) {
				if ( $value === null || strlen( $value ) < 1 ) {
					return false;
				}
			}
		} else {
			if ( self::$value_result === null || strlen( self::$value_result ) < 1 ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @return {void}
	 */
	protected static function reset() {
		self::$key_name = null;
		self::$type = 'string';
		self::$source = null;

		self::$required = true;
		self::$valid = false;

		self::$filter_sanitize = FILTER_SANITIZE_STRING;
		self::$filter_sanitize_options = array();

		self::$filter_validate = null;
		self::$filter_validate_options = array();

		self::$value_raw = null;
		self::$value_raw_is_array = false;

		self::$value_result = null;
		self::$value_result_array = array();
	}

	/**
	 * @return {bool}
	 */
	protected static function sanitize() {
		if ( self::$filter_sanitize === null ) {
			return true;
		}

		if ( self::$value_raw_is_array ) {
			foreach ( self::$value_result_array as $key => $value ) {
				$result = filter_var( $value, self::$filter_sanitize, self::$filter_sanitize_options );
				if ( $result === false ) {
					return false;
				}
				self::$value_result_array[$key] = $result;
			}
		} else {
			$result = filter_var( self::$value_result, self::$filter_sanitize, self::$filter_sanitize_options );
			if ( $result === false ) {
				return false;
			}
			self::$value_result = $result;
		}

		return true;
	}

	/**
	 * @return {void}
	 */
	protected static function trim() {
		if ( self::$value_raw_is_array ) {
			foreach ( self::$value_raw as $key => $value ) {
				self::$value_result_array[$key] = trim( $value );
			}
		} else {
			self::$value_result = trim( self::$value_raw );
		}
	}

	/**
	 * @return {bool}
	 */
	protected static function validate() {
		if ( self::$filter_validate === null ) {
			return true;
		}

		if ( self::$value_raw_is_array ) {
			foreach ( self::$value_result_array as $key => $value ) {
				$result = filter_var( $value, self::$filter_validate, self::$filter_validate_options );
				if ( $result === false ) {
					return false;
				}
				self::$value_result_array[$key] = $result;
			}
		} else {
			$result = filter_var( self::$value_result, self::$filter_validate, self::$filter_validate_options );
			if ( $result === false ) {
				return false;
			}
			self::$value_result = $result;
		}

		return true;
	}
}
