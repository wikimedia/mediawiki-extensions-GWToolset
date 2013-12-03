<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Adapters\Php;
use ApiMain,
	DerivativeRequest,
	GWToolset\Adapters\DataAdapterInterface,
	GWToolset\Config,
	GWToolset\GWTException,
	GWToolset\Utils,
	MimeMagic,
	MWException,
	MWHttpRequest,
	Title;

class MediawikiTemplatePhpAdapter implements DataAdapterInterface {

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
	 * @throws {GWTException}
	 * @return {array}
	 */
	public function retrieve( array $options = array() ) {
		$result = array( 'mediawiki_template_json' => '' );
		$template_data = null;

		// should we limit the mw templates we allow?
		// 2013-09-26 w/david haskia, for now, yes
		if ( !isset(
			Config::$mediawiki_templates[Utils::sanitizeString( $options['mediawiki_template_name'] )] )
		) {
			throw new GWTException(
				array(
					'gwtoolset-mediawiki-template-not-found' =>
					array( $options['mediawiki_template_name'] )
				)
			);
		}

		$Title = Utils::getTitle(
			$options['mediawiki_template_name'],
			NS_TEMPLATE
		);

		if ( $Title === null || !$Title->isKnown() ) {
			throw new GWTException(
				array(
					'gwtoolset-mediawiki-template-does-not-exist' =>
					array( $options['mediawiki_template_name'] )
				)
			);
		}

		$template_data = $this->retrieveTemplateData( $Title );

		if ( empty ( $template_data ) ) {
			$result['mediawiki_template_json'] =
				Config::$mediawiki_templates[Utils::sanitizeString( $options['mediawiki_template_name'] )];
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
		global $wgRequest;

		$Api = new ApiMain(
			new DerivativeRequest(
				$wgRequest,
				array(
					'action' => 'templatedata',
					'titles' => $Title->getBaseTitle()
				),
				false // not posted
			),
			false // disable write
		);

		$Api->execute();

		$api_result = $Api->getResultData();
		$api_result = Utils::objectToArray( $api_result );

		if ( isset( $api_result['pages'] ) && count( $api_result['pages'] ) === 1 ) {
			$api_result = array_shift( $api_result['pages'] );

			if ( count( $api_result['params'] ) > 0 ) {
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
