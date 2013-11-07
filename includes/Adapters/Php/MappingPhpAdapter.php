<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Adapters\Php;
use GWToolset\Adapters\DataAdapterInterface,
	GWToolset\GWTException,
	Revision,
	Title,
	WikiPage;

class MappingPhpAdapter implements DataAdapterInterface {

	public function create( array $options = array() ) {
	}

	public function delete( array $options = array() ) {
	}

	/**
	 * @todo is the content returned by the WikiPage filtered?
	 * @param {array} $options
	 *
	 * @throws {GWTException}
	 *
	 * @return {string}
	 * the content of the wikipage referred to by the wiki title
	 */
	public function retrieve( array $options = array() ) {
		$result = null;

		if ( $options['Metadata-Mapping-Title'] instanceof Title ) {
			if ( !$options['Metadata-Mapping-Title']->isKnown() ) {
				throw new GWTException(
					wfMessage( 'gwtoolset-metadata-mapping-not-found' )
						->params( $options['metadata-mapping-url'] )
						->parse()
				);
			}

			$Mapping_Page = new WikiPage( $options['Metadata-Mapping-Title'] );
			$result = $Mapping_Page->getContent( Revision::RAW )->getNativeData();
			// need to remove line breaks from the mapping otherwise the json_decode will error out
			$result = str_replace( PHP_EOL, '', $result );
		}

		return $result;
	}

	public function update( array $options = array() ) {
	}
}
