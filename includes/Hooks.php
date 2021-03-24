<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */
namespace GWToolset;

class Hooks {

	/**
	 * Declares JSON as the code editor language for GWToolset: pages.
	 *
	 * This hook only runs if the CodeEditor extension is enabled.
	 * @param \Title $title
	 * @param string &$lang Page language.
	 * @return bool
	 */
	public static function onCodeEditorGetPageLanguage( $title, &$lang ) {
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
