<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Adapters\Php;

use ApiMain;
use DerivativeRequest;
use GWToolset\Adapters\DataAdapterInterface;
use GWToolset\Config;
use GWToolset\GWTException;
use GWToolset\Utils;
use Title;

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

	public function create( array $options = [] ) {
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
	public function retrieve( array $options = [] ) {
		$result = [ 'mediawiki_template_json' => '' ];
		$template_data = null;

		$Title = Utils::getTitle(
			$options['mediawiki_template_name'],
			NS_TEMPLATE
		);

		if ( $Title === null || !$Title->isKnown() ) {
			throw new GWTException(
				[
					'gwtoolset-mediawiki-template-does-not-exist' =>
					[ $options['mediawiki_template_name'] ]
				]
			);
		}

		$template_data = $this->retrieveTemplateData( $Title );

		if ( !empty( $template_data ) ) {
			$result['mediawiki_template_json'] = $template_data;
		} elseif (
			in_array(
				$options['mediawiki_template_name'],
				Config::$mediawiki_templates
			)
		) {
			$result['mediawiki_template_json'] =
				Config::$mediawiki_templates[ $options['mediawiki_template_name'] ];
		} else {
			throw new GWTException(
				[
					'gwtoolset-no-templatedata' => [
						$options['mediawiki_template_name'],
						'[[' .
							'mw:Extension:TemplateData#Defining_a_TemplateData_block|' .
							wfMessage( 'gwtoolset-templatedata-link-text' )->parse() .
						']]',
						'[[' .
							'commons:Commons:TemplateData#Using_TemplateBox|' .
							wfMessage( 'gwtoolset-templatebox-link-text' )->parse() .
						']]'
					]
				]
			);
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
		global $wgAPIModules, $wgRequest;

		if ( !array_key_exists( 'templatedata', $wgAPIModules ) ) {
			return $result;
		}

		$Api = new ApiMain(
			new DerivativeRequest(
				$wgRequest,
				[
					'action' => 'templatedata',
					'titles' => $Title->getPrefixedText()
				],
				false // not posted
			),
			false // disable write
		);

		$Api->execute();

		if ( defined( 'ApiResult::META_CONTENT' ) ) {
			$api_result = $Api->getResult()->getResultData( null, [ 'Strip' => 'all' ] );
		} else {
			$api_result = $Api->getResultData();
		}

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

	public function update( array $options = [] ) {
	}

	public function delete( array $options = [] ) {
	}
}
