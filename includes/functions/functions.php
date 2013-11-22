<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use ErrorException,
	GWToolset\Config,
	GWToolset\GWTException,
	GWToolset\Utils,
	GWToolset\MediaWiki\Api\Client,
	Html,
	Language,
	MWException,
	SpecialPage,
	Status,
	Title,
	RecursiveArrayIterator,
	RecursiveIteratorIterator;

/**
 * @param {array} $array
 *
 * @return {array}
 * the array keys and values are not filtered
 */
function getArraySecondLevelValues( array $array ) {
	$values = array();

	foreach ( $array as $keys ) {
		foreach ( $keys as $key => $value ) {
			$values[] = $value;
		}
	}

	return $values;
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
function getBytes( $val ) {
	switch ( substr ( $val, -1 ) ) {
		case 'M': case 'm': return (int)$val * 1048576;
		case 'K': case 'k': return (int)$val * 1024;
		case 'G': case 'g': return (int)$val * 1073741824;
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
function getNamespaceName( $namespace = 0 ) {
	$result = null;

	if ( !is_int( $namespace ) ) {
		return $result;
	}

	$Languages = new Language();
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
function getTitle( $page_title = null, $namespace = NS_MAIN, array $options = array() ) {
	global $wgServer;
	$result = null;

	$option_defaults = array(
		'must-be-known' => true
	);

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
			wfMessage( 'gwtoolset-page-title-contains-url' )
				->params( $page_title )
				->parse()
		);
	}

	$Title = Title::newFromText( $page_title, $namespace );

	if ( !( $Title instanceof Title ) ) {
		return $result;
	}

	if ( !empty( $namespace )
			&& $namespace !== $Title->getNamespace()
	) {
		$Language = new Language();
		throw new GWTException(
			wfMessage( 'gwtoolset-namespace-mismatch' )
				->params(
					$page_title,
					$Language->getNsText( $Title->getNamespace() ),
					$Language->getNsText( $namespace )
				)
				->parse()
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
 * @param {array} $expected_post_fields
 *
 * @throws {MWException}
 *
 * @return {array}
 * the values within the array have been sanitized
 */
function getWhitelistedPost( array $expected_post_fields = array() ) {
		$result = array();

		foreach ( $expected_post_fields as $field => $metadata ) {
			if ( !isset( $_POST[$field] ) ) {
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

			if ( is_array( $_POST[$field] ) ) {
				$result[$field] = array();

				foreach ( $_POST[$field] as $value ) {
					// avoid field[][]
					if ( !is_array( $value ) ) {
						$value = substr( $value, 0, $metadata['size'] );
						$result[$field][] = Utils::sanitizeString( $value );
					}
				}
			} else {
				$value = substr( $_POST[$field], 0, $metadata['size'] );
				$result[$field] = Utils::sanitizeString( $value );
			}
		}

		return $result;
	}

/**
 * @throws {GWTException}
 */
function jsonCheckForError() {
	$error_msg = null;

	switch ( json_last_error() ) {
		case JSON_ERROR_NONE:
			break;

		case JSON_ERROR_DEPTH:
			$error_msg = wfMessage( 'gwtoolset-json-error-depth' )->escaped();
			break;

		case JSON_ERROR_STATE_MISMATCH:
			$error_msg = wfMessage( 'gwtoolset-json-error-state-mismatch' )->escaped();
			break;

		case JSON_ERROR_CTRL_CHAR:
			$error_msg = wfMessage( 'gwtoolset-json-error-ctrl-char' )->escaped();
			break;

		case JSON_ERROR_SYNTAX:
			$error_msg = wfMessage( 'gwtoolset-json-error-syntax' )->escaped();
			break;

		case JSON_ERROR_UTF8:
			$error_msg = wfMessage( 'gwtoolset-json-error-utf8' )->escaped();
			break;

		default:
			$error_msg = wfMessage( 'gwtoolset-json-error-unknown' )->escaped();
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
function normalizeSpace( $string ) {
	return str_replace( ' ', '_', $string );
}

/**
 * @param {string} $category
 * @return {null|string}
 * the result has not been filtered
 */
function stripIllegalCategoryChars( $category = null ) {
	$result = null;

	if ( empty( $category ) || !is_string( $category ) ) {
		return $result;
	}

	$result = str_replace( array( '[', ']' ), '', $category );

	return $result;
}

/**
 * replaces illegal characters in a title with a replacement character, defaults to ‘-’.
 * illegal characters are based on Commons:File_naming and other bad title articles.
 * Title::secureAndSplit() allows some of these characters.
 *
 * @see https://commons.wikimedia.org/wiki/Commons:File_naming
 * @see http://en.wikipedia.org/wiki/Wikipedia:Naming_conventions_(technical_restrictions)
 * @see http://www.mediawiki.org/wiki/Help:Bad_title
 * @see http://commons.wikimedia.org/wiki/MediaWiki:Titleblacklist
 *
 * @param {string} $title
 *
 * @param {array} $options
 *
 * @param {boolean} $options['allow-subpage']
 * allows for the ‘/’ subpage character
 *
 * @param {string} $options['replacement']
 * the character used to replace illegal characters; defaults to ‘-’
 *
 * @return {string} the string is not filtered
 */
function stripIllegalTitleChars( $title, array $options = array() ) {
	$option_defaults = array(
		'allow-subpage' => false,
		'replacement' => '-'
	);

	$options = array_merge( $option_defaults, $options );

	$illegal_chars = array(
		'#','<','>','[',']','|','{','}',':','¬','`','!','"','£','$','^','&','*',
		'(',')','+','=','~','?',',',Config::$metadata_separator,';',"'",'@'
	);

	if ( !$options['allow-subpage'] ) {
		$illegal_chars[] = '/';
	}

	return str_replace(
		$illegal_chars,
		$options['replacement'],
		$title
	);
}
