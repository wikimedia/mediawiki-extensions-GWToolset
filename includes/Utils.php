<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;

use Language;
use ManualLogEntry;
use MWException;
use Sanitizer;
use Title;

class Utils {

	/**
	 * @param {array} $array
	 *
	 * @return {array}
	 * the array keys and values are not filtered
	 */
	public static function getArraySecondLevelValues( array $array ) {
		$values = [];

		foreach ( $array as $keys ) {
			foreach ( $keys as $value ) {
				$values[] = $value;
			}
		}

		return $values;
	}

	/**
	 * GlobalFunctions->wfObjectToArray() doesn’t work here
	 *
	 * @param {array|object} $data
	 * @return {array}
	 */
	public static function objectToArray( $data ) {
		if ( is_object( $data ) ) {
			$data = (array)$data;
		}

		if ( is_array( $data ) ) {
			return array_map( [ __CLASS__, __FUNCTION__ ], $data );
		} else {
			return $data;
		}
	}

	/**
	 * takes a php ini value that contains a letter for Kilobytes, Megabytes, etc.
	 * and converts it to bytes
	 *
	 * @see http://www.php.net/manual/en/function.ini-get.php#96996
	 *
	 * @param {string} $val
	 * @return {int}
	 */
	public static function getBytes( $val ) {
		switch ( substr( $val, -1 ) ) {
			case 'M': case 'm':
				return (int)$val * 1048576;
			case 'K': case 'k':
				return (int)$val * 1024;
			case 'G': case 'g':
				return (int)$val * 1073741824;
			default:
		}

		return $val;
	}

	/**
	 * based on a namespace number, returns the namespace name
	 *
	 * @param {int} $namespace
	 * @return {null|string}
	 * the result is not filtered
	 */
	public static function getNamespaceName( $namespace = 0 ) {
		global $wgLanguageCode;
		$result = null;

		if ( !is_int( $namespace ) ) {
			return $result;
		}

		$Languages = Language::factory( $wgLanguageCode );
		$namespaces = $Languages->getNamespaces();

		if ( isset( $namespaces[$namespace] ) ) {
			$result = $namespaces[$namespace] . ':';
		}

		return $result;
	}

	/**
	 * attempts to retrieve a wiki title based on a given page title, an
	 * optional namespace requirement and whether or not the title must be known
	 *
	 * @param {string} $page_title
	 * @param {Int} $namespace
	 * @param {array} $options
	 * @param {bool} $options['must-be-known']
	 * Whether or not the Title must be known; defaults to true
	 *
	 * @throws {GWTException|MWException}
	 * @return {null|Title}
	 */
	public static function getTitle( $page_title = null, $namespace = NS_MAIN, array $options = [] ) {
		global $wgServer;
		$result = null;

		$option_defaults = [
			'must-be-known' => true
		];

		$options = array_merge( $option_defaults, $options );

		if ( empty( $page_title ) ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-page-title' )->escaped() )
					->parse()
			);
		}

		if ( strpos( $page_title, $wgServer ) !== false ) {
			throw new GWTException(
				[ 'gwtoolset-page-title-contains-url' => [ $page_title ] ]
			);
		}

		$Title = Title::newFromText( $page_title, $namespace );

		if ( !( $Title instanceof Title ) ) {
			return $result;
		}

		if ( !empty( $namespace )
				&& $namespace !== $Title->getNamespace()
		) {
			global $wgLanguageCode;
			$Language = Language::factory( $wgLanguageCode );

			throw new GWTException(
				[
					'gwtoolset-namespace-mismatch' => [
						$page_title,
						$Language->getNsText( $Title->getNamespace() ),
						$Language->getNsText( $namespace )
					]
				]
			);
		}

		if ( !$options['must-be-known'] ) {
			$result = $Title;
		} elseif ( $Title->isKnown() ) {
			$result = $Title;
		}

		return $result;
	}

	/**
	 * cycles over the $_POST and returns a “whitelisted-post” that:
	 * - contains only the posted fields expected
	 * - if the field is an array, only one level is applied
	 * - sanitizes those fields with
	 *   - FILTER_SANITIZE_STRING
	 *     @see http://php.net/manual/en/filter.filters.sanitize.php
	 *   - shorterns strings > $metadata['size'], the max size expected of a field value
	 *
	 * @param {array} $original_post
	 * @param {array} $expected_post_fields
	 * @throws {MWException}
	 *
	 * @return {array}
	 * the values within the array have been sanitized
	 */
	public static function getWhitelistedPost(
		array $original_post = [],
		array $expected_post_fields = []
	) {
		$result = [];

		foreach ( $expected_post_fields as $field => $metadata ) {
			if ( !isset( $original_post[$field] ) ) {
				continue;
			}

			if ( !isset( $metadata['size'] ) ) {
				throw new MWException(
					__METHOD__ . ': ' .
					wfMessage( 'gwtoolset-developer-issue' )
						->params(
							wfMessage( 'gwtoolset-no-field-size' )
								->params( $field )
								->escaped()
						)
						->parse()
				);
			}

			if ( is_array( $original_post[$field] ) ) {
				$result[$field] = [];

				foreach ( $original_post[$field] as $value ) {
					// avoid field[][]
					if ( !is_array( $value ) ) {
						$value = substr( $value, 0, $metadata['size'] );
						$result[$field][] = self::sanitizeString( $value );
					}
				}
			} else {
				$value = substr( $original_post[$field], 0, $metadata['size'] );
				$result[$field] = self::sanitizeString( $value );
			}
		}

		return $result;
	}

	/**
	 * @throws {GWTException}
	 */
	public static function jsonCheckForError() {
		$error_msg = null;

		switch ( json_last_error() ) {
			case JSON_ERROR_NONE:
				break;

			case JSON_ERROR_DEPTH:
				$error_msg = 'gwtoolset-json-error-depth';
				break;

			case JSON_ERROR_STATE_MISMATCH:
				$error_msg = 'gwtoolset-json-error-state-mismatch';
				break;

			case JSON_ERROR_CTRL_CHAR:
				$error_msg = 'gwtoolset-json-error-ctrl-char';
				break;

			case JSON_ERROR_SYNTAX:
				$error_msg = 'gwtoolset-json-error-syntax';
				break;

			case JSON_ERROR_UTF8:
				$error_msg = 'gwtoolset-json-error-utf8';
				break;

			default:
				$error_msg = 'gwtoolset-json-error-unknown';
				break;
		}

		if ( !empty( $error_msg ) ) {
			throw new GWTException( $error_msg );
		}
	}

	/**
	 * replaces ‘ ’ with ‘_’
	 *
	 * @param {string} $parameter
	 *
	 * @return {string}
	 * the string is not filtered
	 */
	public static function normalizeSpace( $string ) {
		return str_replace( ' ', '_', $string );
	}

	/**
	 * @param {int} $value
	 * @param {array} $params
	 * @param {int} $params['min']
	 * @param {int} $params['max']
	 * @param {int} $params['default']
	 * @return {int}
	 * @throws {MWException}
	 */
	public static function sanitizeNumericRange( $value, $params ) {
		if ( !isset( $params['min'] ) ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
				->params( wfMessage( 'gwtoolset-no-min' ) )
				->escaped()
			);
		}

		if ( !isset( $params['max'] ) ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
				->params( wfMessage( 'gwtoolset-no-max' ) )
				->escaped()
			);
		}

		if ( !isset( $params['min'] ) ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
				->params( wfMessage( 'gwtoolset-no-default' ) )
				->escaped()
			);
		}

		$result = (int)$params['default'];
		$value = (int)$value;

		if ( $value >= (int)$params['min']
			&& $value <= (int)$params['max']
		) {
			$result = $value;
		}

		return $result;
	}

	/**
	 * note: FILTER_SANITIZE_STRING may encode quotes, depending on the php.ini
	 * settings, so if you wish it not to do so, e.g. wiki title, pass in
	 * $options as array( 'flags' => FILTER_FLAG_NO_ENCODE_QUOTES )
	 *
	 * @param {string} $string
	 *
	 * @param {array} $options
	 * Filter options
	 *
	 * @throws {MWException}
	 * @return {string|null}
	 */
	public static function sanitizeString( $string, array $options = [] ) {
		global $wgContLang;

		// is_string thought some form fields were booleans instead of strings
		if ( !gettype( $string ) === 'string' ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-not-string' )->params( gettype( $string ) ) )
					->escaped()
			);
		}

		$result = filter_var( trim( $string ), FILTER_SANITIZE_STRING, $options );

		if ( !$result ) {
			$result = null;
		}

		$result = $wgContLang->normalize( $result );

		return $result;
	}

	/**
	 * note: FILTER_SANITIZE_URL removes a space rather than encoding
	 * it as %20 or replacing it with +
	 *
	 * @param {string} $url
	 *
	 * @param {array} $options
	 * Filter options
	 *
	 * @return {string|null}
	 */
	public static function sanitizeUrl( $url, array $options = [] ) {
		$result = self::sanitizeString( $url );
		$result = filter_var( $result, FILTER_SANITIZE_URL, $options );
		return $result;
	}

	/**
	 * @param {array} $options
	 * @param {string} $options['comment']
	 * @param {string} $options['job-subtype']
	 * @param {array} $options['parameters']
	 * @param {object} $options['Title']
	 * @param {object} $options['User']
	 */
	public static function specialLog( array $options ) {
		$logEntry = new ManualLogEntry(
			strtolower( Constants::EXTENSION_NAME ),
			$options['job-subtype']
		);

		$logEntry->setPerformer( $options['User'] );
		$logEntry->setTarget( $options['Title'] );

		if ( !empty( $options['comment'] ) ) {
			$logEntry->setComment( $options['comment'] );
		}

		// these parameters should be localised beforehand when necessary
		// they are passed on to an i18n message that corresponds with the
		// $options['job-subtype'] e.g., logentry-gwtoolset-metadatajob,
		// which acts as a template placeholder
		if ( !empty( $options['parameters'] ) ) {
			$logEntry->setParameters( $options['parameters'] );
		}

		$logid = $logEntry->insert();
		// Do not call $logEntry->publish( $logid );
		// as we only want this on Special:Log/gwtoolset, and not
		// Special:Recentchanges or RC irc feed
	}

	/**
	 * @param {string} $category
	 * @return {null|string}
	 * the result has not been filtered
	 */
	public static function stripIllegalCategoryChars( $category = null ) {
		$result = null;

		if ( empty( $category ) || !is_string( $category ) ) {
			return $result;
		}

		$result = str_replace( [ '[', ']' ], '', $category );

		return $result;
	}

	/**
	 * makes sure that the provided title is a valid wiki title
	 * @see https://bugzilla.wikimedia.org/show_bug.cgi?id=62909
	 *
	 * wfStripIllegalFilenameChars doesn’t just replace /, \,
	 * it removes any part of the string before it. some titles contain these characters
	 * as part of the metadata value; e.g., when the value is a URL. we don’t want to
	 * truncate those strings; instead we want to preserve the legal characters.
	 *
	 * @param {string} $title
	 *
	 * @param {array} $options
	 * @param {string} $options['replacement']
	 * the character used to replace illegal characters; defaults to ‘-’
	 *
	 * @return {string}
	 * the string is not sanitized
	 */
	public static function stripIllegalTitleChars( $title, array $options = [] ) {
		$illegal_chars = [ '/', '\\' ];
		$option_defaults = [ 'replacement' => '-' ];

		$options = array_merge( $option_defaults, $options );

		$title = str_replace( $illegal_chars, $options['replacement'], $title );
		$title = Sanitizer::decodeCharReferences( $title );
		$title = wfStripIllegalFilenameChars( $title );

		return $title;
	}

}
