<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
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
	 * @return array
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
	 * @param array $options
	 * @throws GWTException
	 * @return array
	 */
	public function retrieve( array $options = [] ) {
		$result = [ 'mediawiki_template_json' => '' ];
		$templateData = null;

		$title = Utils::getTitle(
			$options['mediawiki_template_name'],
			NS_TEMPLATE
		);

		if ( $title === null || !$title->isKnown() ) {
			throw new GWTException(
				[
					'gwtoolset-mediawiki-template-does-not-exist' =>
					[ $options['mediawiki_template_name'] ]
				]
			);
		}

		$templateData = $this->retrieveTemplateData( $title );

		if ( !empty( $templateData ) ) {
			$result['mediawiki_template_json'] = $templateData;
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
	 * @param Title $title
	 * @throws \MWException
	 * @return null|string
	 * null or a JSON representation of the MediaWiki template parameters
	 */
	protected function retrieveTemplateData( Title $title ) {
		$result = null;
		global $wgAPIModules, $wgRequest;

		if ( !array_key_exists( 'templatedata', $wgAPIModules ) ) {
			return $result;
		}

		$api = new ApiMain(
			new DerivativeRequest(
				$wgRequest,
				[
					'action' => 'templatedata',
					'titles' => $title->getPrefixedText()
				],
				false // not posted
			),
			false // disable write
		);

		$api->execute();

		$apiResult = $api->getResult()->getResultData( null, [ 'Strip' => 'all' ] );

		$apiResult = Utils::objectToArray( $apiResult );

		if ( isset( $apiResult['pages'] ) && count( $apiResult['pages'] ) === 1 ) {
			$apiResult = array_shift( $apiResult['pages'] );

			if ( isset( $apiResult['params'] ) && count( $apiResult['params'] ) > 0 ) {
				$jsonResult = [];
				foreach ( $apiResult['params'] as $key => $value ) {
					if ( !$value['deprecated'] ) {
						$jsonResult[$key] = '';
					}
				}

				$result = json_encode( $jsonResult );
			}
		}

		return $result;
	}

	public function update( array $options = [] ) {
	}

	public function delete( array $options = [] ) {
	}
}
