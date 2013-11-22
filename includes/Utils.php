<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use MWException;

class Utils {

	/**
	 * @param {string} $string
	 * @return {string|null}
	 */
	public static function sanitizeString( $string ) {
		// is_string thought some form fields were booleans instead of strings
		if ( !gettype( $string ) === 'string' ) {
			throw new MWException(
				__METHOD__ . ': ' .
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-not-string' )->params( gettype( $string ) ) )
					->escaped()
			);
		}

		$result = trim( $string );
		$result = filter_var( $string, FILTER_SANITIZE_STRING );

		if ( !$result ) {
			$result = null;
		}

		return $result;
	}

	/**
	 * note: FILTER_SANITIZE_URL removes a space rather than encoding
	 * it as %20 or replacing it with +
	 *
	 * @param {string} $url
	 * @return {string|null}
	 */
	public static function sanitizeUrl( $url ) {
		$result = self::sanitizeString( $url );
		$result = filter_var( $result, FILTER_SANITIZE_URL );
		return $result;
	}

}
