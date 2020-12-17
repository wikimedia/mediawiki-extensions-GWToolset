<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Models;

use GWToolset\Adapters\DataAdapterInterface;
use GWtoolset\Config;
use GWToolset\GWTException;
use GWToolset\Utils;
use MediaWiki\MediaWikiServices;

class Mapping implements ModelInterface {

	/**
	 * @var array
	 */
	public $mapping_array;

	/**
	 * @var string|null
	 */
	public $mapping_json;

	/**
	 * @var string|null
	 */
	public $mediawiki_template_name;

	/**
	 * @var array
	 * an array to be used for quick look-up of target dom elements to be
	 * used in the metadata for mapping to the mediawiki template; avoids
	 * the necessity of recursive look-up in the mapping array
	 */
	public $target_dom_elements;

	/**
	 * @var array
	 * holds an array of metadata dom elements mapped to their corresponding
	 * mediawiki template parameters
	 */
	public $target_dom_elements_mapped;

	/**
	 * @var DataAdapterInterface|null
	 */
	protected $_DataAdapater;

	/**
	 * @param DataAdapterInterface $dataAdapter
	 */
	public function __construct( DataAdapterInterface $dataAdapter ) {
		$this->reset();
		$this->_DataAdapater = $dataAdapter;
	}

	/**
	 * @param array $options
	 */
	public function create( array $options = [] ) {
		$this->_DataAdapater->create( $options );
	}

	/**
	 * @param array &$options
	 */
	public function delete( array &$options = [] ) {
	}

	/**
	 * @todo sanitize the mapping_array created
	 *
	 * @param array &$options
	 *
	 * @return array
	 * the keys and values within the array are not filtered
	 *
	 * @throws GWTException
	 */
	public function getJsonAsArray( array &$options = [] ) {
		try {
			$result = json_decode( $this->mapping_json, true );
			Utils::jsonCheckForError();
		} catch ( GWTException $e ) {
			$error_msg = $e->getMessage();
			if ( isset( $options['Metadata-Mapping-Title'] ) ) {
				$linkRenderer = MediaWikiServices::getInstance()->getLinkRenderer();
				$error_msg .= ' ' .
					$linkRenderer->makeLink(
						$options['Metadata-Mapping-Title'],
						null,
						[ 'target' => '_blank' ]
					);
			}

			throw new GWTException(
				[ 'gwtoolset-metadata-mapping-bad' => [ $error_msg ] ]
			);
		}

		return $result;
	}

	/**
	 * relies on a hardcoded path to the metadata mapping url
	 *
	 * @param array $options
	 * @throws GWTException
	 * @return string|null
	 * the string is not filtered
	 */
	protected function getMappingName( array $options ) {
		$result = null;
		$namespace = Utils::getNamespaceName( Config::$metadata_namespace );

		if ( !empty( $options['Metadata-Mapping-Title'] ) ) {
			$result = str_replace(
				[
					$namespace,
					Config::$metadata_mapping_subpage,
					'.json'
				],
				'',
				$options['Metadata-Mapping-Title']
			);

			$result = explode( '/', $result );

			if ( !isset( $result[2] ) ) {
				$url = Utils::sanitizeString( $options['gwtoolset-metadata-mapping-url'] );

				$expected_path = $namespace .
					Utils::sanitizeString( Config::$metadata_mapping_subpage ) .
					'/user-name/file-name.json';

				throw new GWTException(
					[
						'gwtoolset-metadata-mapping-invalid-url' =>
						[ $url, $expected_path ]
					]
				);
			}

			$result = $result[2];
		}

		return $result;
	}

	/**
	 * attempts to retrieve a wiki page title that contains the metadata mapping json
	 *
	 * @param array &$options
	 * @throws GWTException
	 * @return null|\Title
	 */
	protected function getMappingTitle( array &$options ) {
		$result = null;

		if ( !empty( $options['gwtoolset-metadata-mapping-url'] ) ) {
			$result = Utils::getTitle(
				$options['gwtoolset-metadata-mapping-url'],
				Config::$metadata_namespace
			);

			if ( empty( $result ) ) {
				throw new GWTException(
					[
						'gwtoolset-metadata-mapping-not-found' =>
						[ $options['gwtoolset-metadata-mapping-url'] ]
					]
				);
			}
		}

		return $result;
	}

	/**
	 * @param array &$options
	 */
	protected function populate( array &$options ) {
		if ( empty( $options ) ) {
			return;
		}

		$this->mediawiki_template_name = $options['gwtoolset-mediawiki-template-name'] ?? null;

		$this->mapping_json = $options['metadata-mapping-json'] ?? null;

		$this->mapping_array = $this->getJsonAsArray( $options );
		$this->setTargetElements();
		$this->reverseMap();
	}

	public function reset() {
		$this->mapping_array = [];
		$this->mapping_json = null;
		$this->mediawiki_template_name = null;
		$this->target_dom_elements = [];
		$this->target_dom_elements_mapped = [];
		$this->_DataAdapater = null;
	}

	/**
	 * @param array &$options
	 * an array of user options that was submitted in the html form
	 *
	 * @throws GWTException
	 */
	public function retrieve( array &$options = [] ) {
		$options['Metadata-Mapping-Title'] = $this->getMappingTitle( $options );
		$options['gwtoolset-metadata-mapping-name'] = $this->getMappingName( $options );
		$options['metadata-mapping-json'] = $this->_DataAdapater->retrieve( $options );

		if ( !empty( $options['Metadata-Mapping-Title'] ) ) {
			$this->populate( $options );
		}
	}

	public function reverseMap() {
		foreach ( $this->target_dom_elements as $element ) {
			foreach ( $this->mapping_array as $mediawiki_parameter => $target_dom_elements ) {
				if ( in_array( $element, $target_dom_elements ) ) {
					$this->target_dom_elements_mapped[$element][] = $mediawiki_parameter;
				}
			}
		}
	}

	public function setTargetElements() {
		foreach ( $this->mapping_array as $value ) {
			foreach ( $value as $item ) {
				if ( !in_array( $item, $this->target_dom_elements ) && !empty( $item ) ) {
					$this->target_dom_elements[] = $item;
				}
			}
		}
	}

	/**
	 * @param array &$options
	 */
	public function update( array &$options = [] ) {
	}
}
