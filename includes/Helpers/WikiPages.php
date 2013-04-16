<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Helpers;
use Exception,
	Php\Filter,
	Title;

class WikiPages {

	/**
	 * parses a url to determine if the url is a valid wiki Title
	 *
	 * if $accepted_extensions are passed in the method will first check to see
	 * if the url contains one of the $accepted_extensions
	 *
	 * @param {string} $url url to be interpreted
	 * @param {array} $accepted_extensions
	 *
	 * @throws {Exception}
	 * @return {null|Title}
	 */
	public static function getTitleFromUrl( $url = null, $accepted_extensions = array() ) {
		global $wgServer, $wgScriptPath, $wgArticlePath;
		$result = null;

		if ( empty( $url ) ) {
			throw new Exception( wfMessage( 'gwtoolset-developer-issue' )->params( wfMessage( 'gwtoolset-no-file-url' )->escaped() )->parse() );
		}

		if ( count( $accepted_extensions ) > 0 ) {
			$Status = FileChecks::isAcceptedFileExtension( $url, $accepted_extensions );

			if ( !$Status->ok ) {
				throw new Exception( $Status->getMessage() );
			}
		}

		$result = str_replace(
			array( $wgServer, str_replace( '$1', '', $wgArticlePath ), $wgScriptPath, '//' ),
			'',
			$url
		);

		$result = Title::newFromText( $result );

		if ( $result instanceof Title && !$result->isKnown() ) {
			$result = null;
		}

		return $result;
	}

	/**
	 * replacing : and / so that metadata and mediafile titles do not accidentatlly
	 * contain namespaces or paths
	 *
	 * @param {string} $title
	 *
	 * @param {string} $replacement
	 *
	 * @return {string}
	 * the string is not filtered
	 *
	 * @see https://commons.wikimedia.org/wiki/Commons:File_naming
	 * @see http://en.wikipedia.org/wiki/Wikipedia:Naming_conventions_(technical_restrictions)
	 * @see http://www.mediawiki.org/wiki/Help:Bad_title
	 */
	public static function titleCheck( $title, $replacement = '-' ) {
		//return str_replace( array( '#','<','>','[',']','|','{','}',':','¬','`','!','"','£','$','^','&','*','(',')','+','=','~','?','/',',',Config::$metadata_separator,';',"'",'@' ), $replacement, $title );
		return str_replace( array( ':', '/' ), $replacement, $title );
	}
}
