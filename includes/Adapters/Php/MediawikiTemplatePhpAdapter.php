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
	GWToolset\Config,
	MimeMagic,
	MWException,
	MWHttpRequest,
	Php\Filter,
	Title;

class MediawikiTemplatePhpAdapter implements DataAdapterInterface {

	/**
	 * @param {string} $table_name
	 * @return {void}
	 */
	public function __construct() {
	}

	/**
	 * returns an indexed array of key values from the Config::$mediawiki_templates
	 * array, which represents the mediawiki templates handled by the extension
	 *
	 * @return {array}
	 */
	public function getKeys() {
		return array_keys( Config::$mediawiki_templates );
	}

	public function create( array $options = array() ) {
	}

	/**
	 * retrieves a json representation of the Mediawiki Template
	 * - attempts to retrieve a TemplateData version of the template
	 * - falls back to a Config::$mediawiki_templates version if not found
	 *
	 * @param {array} $options
	 * @throws {MWException}
	 * @return {array}
	 */
	public function retrieve( array $options = array() ) {
		$result = array( 'mediawiki_template_json' => '' );
		$template_data = null;

		// should we limit the mw templates we allow?
		// 2013-09-26 w/david haskia, for now, yes
		if ( !isset(
			Config::$mediawiki_templates[Filter::evaluate( $options['mediawiki_template_name'] )] )
		) {
			throw new MWException(
				wfMessage( 'gwtoolset-mediawiki-template-not-found' )
					->rawParams( Filter::evaluate( $options['mediawiki_template_name'] ) )
					->escaped()
				);
		}

		$Title = \GWToolset\getTitle(
			$options['mediawiki_template_name'],
			NS_TEMPLATE
		);

		if ( !$Title->isKnown() ) {
			throw new MWException(
				wfMessage( 'gwtoolset-mediawiki-template-does-not-exist' )
					->params( $Title->getBaseTitle() )
					->parse()
			);
		}

		$template_data = $this->retrieveTemplateData( $Title );

		if ( empty ( $template_data ) ) {
			$result['mediawiki_template_json'] =
				Config::$mediawiki_templates[Filter::evaluate( $options['mediawiki_template_name'] )];
		} else {
			$result['mediawiki_template_json'] = $template_data;
		}

		return $result;
	}

	/**
	 * attempts to retrieve a TemplateData version of the Mediawiki Template
	 * if TemplateData isfound, it is prepared as a JSON string in an expected
	 * format -- {"parameter name":""}
	 *
	 * @param {Title} $Title
	 * @throws {MWException}
	 * @return {null|string}
	 * null or a JSON representation of the MediaWiki template parameters
	 */
	protected function retrieveTemplateData( Title $Title ) {
		$result = null;
		$api_result = array();
		global $wgServer, $wgScriptPath;

		$url = $wgServer .
			$wgScriptPath .
			'/api.php?action=templatedata&titles=' .
			$Title->getBaseTitle();

		$Http = MWHttpRequest::factory( $url );

		$Status = $Http->execute();

		if ( !$Status->ok ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						wfMessage( 'gwtoolset-api-call-unsuccessful' )
							->params( $Title->getBaseTitle(), $Status->getMessage() )
							->escaped()
					)
				->parse()
			);
		}

		$api_result = json_decode( $Http->getContent(), true );

		try {
			\GWToolset\jsonCheckForError();
		} catch ( MWException $e ) {
			throw new MWException(
				wfMessage( 'gwtoolset-json-error' )
					->rawParams( $e->getMessage() )
					->parse()
			);
		}

		if ( isset ( $api_result['pages'] ) && count ( $api_result['pages'] ) === 1 ) {
			$api_result = array_shift( $api_result['pages'] );

			if ( count ( $api_result['params'] ) > 0 ) {
				foreach ( $api_result['params'] as $key => $value ) {
					if ( !$value['deprecated'] ) {
						$result[$key] = '';
					}
				}

				$result = json_encode( $result );
			}
		}

		return $result;
	}

	public function update( array $options = array() ) {
	}

	public function delete( array $options = array() ) {
	}
}
