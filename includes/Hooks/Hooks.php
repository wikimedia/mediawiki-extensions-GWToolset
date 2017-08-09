<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset;

class Hooks {

	/**
	 * @param {array} &$list
	 * @return {bool}
	 */
	public static function onCanonicalNamespaces( &$list ) {
		$list[NS_GWTOOLSET] = 'GWToolset';
		$list[NS_GWTOOLSET_TALK] = 'GWToolset_talk';
		return true;
	}

	/**
	 * @param {array} &$files
	 * @return {bool}
	 */
	public static function onUnitTestsList( &$files ) {
		$dir = dirname( dirname( __DIR__ ) );
		$files = array_merge( $files, glob( $dir . '/tests/phpunit/*Test.php' ) );
		return true;
	}

	/**
	 * Declares JSON as the code editor language for GWToolset: pages.
	 *
	 * This hook only runs if the CodeEditor extension is enabled.
	 * @param Title $title
	 * @param string &$lang Page language.
	 * @return bool
	 */
	static function onCodeEditorGetPageLanguage( $title, &$lang ) {
		if ( $title->inNamespace( NS_GWTOOLSET ) ) {
			$lang = 'json';
		}
		return true;
	}

	/**
	 * Register change tags.
	 *
	 * @param array &$tags
	 * @return bool
	 */
	public static function onListDefinedTags( &$tags ) {
		$tags[] = 'gwtoolset';
		return true;
	}

	/**
	 * Mark active change tags.
	 *
	 * @param array &$tags
	 * @return bool
	 */
	public static function onChangeTagsListActive( &$tags ) {
		$tags[] = 'gwtoolset';
		return true;
	}
}
