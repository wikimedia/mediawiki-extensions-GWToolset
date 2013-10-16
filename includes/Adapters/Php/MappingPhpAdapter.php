<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Adapters\Php;
use ContentHandler,
	GWToolset\Adapters\DataAdapterInterface,
	GWToolset\Config,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiPages,
	MWException,
	Php\Filter,
	Revision,
	Title,
	WikiPage;

class MappingPhpAdapter implements DataAdapterInterface {

	/**
	 * @param {array} $options
	 * @throws {MWException}
	 * @return {Status}
	 */
	public function create( array $options = array() ) {
		$result = false;

		if ( empty( $options['mapping-json'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-mapping-json' )->parse() )
					->parse()
			);
		}

		if ( empty( $options['mapping-name'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-mapping' )->parse() )
					->parse()
			);
		}

		if ( empty( $options['user'] ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-user' )->escaped() )
					->parse()
			);
		}

		// nb: cannot filter the json - might need to test it as valid by converting it back and
		// forth with json_decode/encode
		$options['text'] = $options['mapping-json'];
		$options['mapping-user-name'] = $options['user']->getName();

		$options['summary'] =
			wfMessage( 'gwtoolset-create-mapping' )
				->params( Config::$name, $options['mapping-user-name'] )
				->escaped();

		$options['title'] =	\GWToolset\getTitle(
			\GWToolset\stripIllegalTitleChars(
				Config::$metadata_mapping_subpage . '/' .
				$options['mapping-user-name'] . '/' .
				$options['mapping-name'] . '.json',
				array( 'allow-subpage' => true )
			),
			Config::$metadata_namespace,
			array( 'must-be-known' => false )
		);

		$result = $this->saveMapping( $options );

		return $result;
	}

	public function delete( array $options = array() ) {
	}

	/**
	 * @todo is the content returned by the WikiPage filtered?
	 * @param {array} $options
	 * @return {string}
	 * the content of the wikipage referred to by the wiki title
	 */
	public function retrieve( array $options = array() ) {
		$result = null;

		if ( $options['Metadata-Mapping-Title'] instanceof Title ) {
			if ( !$options['Metadata-Mapping-Title']->isKnown() ) {
				throw new MWException(
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

	/**
	 * attempts to save the mapping to the wiki as content
	 *
	 * @todo does ContentHandler filter $options['text']
	 * @todo does ContentHandler filter $options['summary']
	 * @todo figure out issue with the db ErrorException
	 *    Transaction idle or pre-commit callbacks still pending.
	 *    triggered by $db->__destruct because there is a mTrxIdleCallbacks waiting
	 *    not sure why though
	 * @see https://bugzilla.wikimedia.org/show_bug.cgi?id=47375
	 *
	 * @param {array} $options
	 * @return {Status}
	 */
	protected function saveMapping( array &$options ) {
		$result = false;

		$Mapping_Content = ContentHandler::makeContent( $options['text'], $options['title'] );
		$Mapping_Page = new WikiPage( $options['title'] );

		set_error_handler( '\GWToolset\swallowErrors' );
		$result = $Mapping_Page->doEditContent(
			$Mapping_Content,
			$options['summary'],
			0,
			false,
			$options['user']
		);

		return $result;
	}

	public function update( array $options = array() ) {
	}
}
