<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Adapters\Php;

use GWToolset\Adapters\DataAdapterInterface;
use GWToolset\GWTException;
use Title;
use WikiPage;

class MappingPhpAdapter implements DataAdapterInterface {

	/**
	 * @param array $options
	 */
	public function create( array $options = [] ) {
	}

	/**
	 * @param array $options
	 */
	public function delete( array $options = [] ) {
	}

	/**
	 * @todo is the content returned by the WikiPage filtered?
	 * @param array $options
	 *
	 * @throws GWTException
	 *
	 * @return string|null
	 * the content of the wikipage referred to by the wiki title
	 */
	public function retrieve( array $options = [] ) {
		$result = null;

		if ( $options['Metadata-Mapping-Title'] instanceof Title ) {
			if ( !$options['Metadata-Mapping-Title']->isKnown() ) {
				throw new GWTException(
					[
						'gwtoolset-metadata-mapping-not-found' =>
						[ $options['gwtoolset-metadata-mapping-url'] ]
					]
				);
			}

			$mappingPage = WikiPage::factory( $options['Metadata-Mapping-Title'] );
			$result = $mappingPage->getContent()->getNativeData();
			// need to remove line breaks from the mapping otherwise the json_decode will error out
			$result = str_replace( PHP_EOL, '', $result );
		}

		return $result;
	}

	/**
	 * @param array $options
	 */
	public function update( array $options = [] ) {
	}
}
