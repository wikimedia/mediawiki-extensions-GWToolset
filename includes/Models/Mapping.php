<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Models;
use GWToolset\Adapters\DataAdapterInterface,
	GWtoolset\Config,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiPages,
	Language,
	Linker,
	MWException,
	Php\Filter;

class Mapping implements ModelInterface {

	/**
	 * @var {array}
	 */
	public $mapping_array;

	/**
	 * @var {string}
	 */
	public $mapping_json;

	/**
	 * @var {string}
	 */
	public $mediawiki_template_name;

	/**
	 * @var {array}
	 * an array to be used for quick look-up of target dom elements to be
	 * used in the metadata for mapping to the mediawiki template; avoids
	 * the necessity of recursive look-up in the mapping array
	 */
	public $target_dom_elements;

	/**
	 * @var {array}
	 * holds an array of metadata dom elements mapped to their corresponding
	 * mediawiki template parameters
	 */
	public $target_dom_elements_mapped;

	/**
	 * @var {DataAdapterInterface}
	 */
	protected $_DataAdapater;

	/**
	 * @param {DataAdapterInterface} $DataAdapter
	 * @return {void}
	 */
	public function __construct( DataAdapterInterface $DataAdapter ) {
		$this->reset();
		$this->_DataAdapater = $DataAdapter;
	}

	/**
	 * @params {array} $options
	 * @return {Status}
	 */
	public function create( array $options = array() ) {
		return $this->_DataAdapater->create( $options );
	}

	public function delete( array &$options = array() ) {
	}

	/**
	 * @todo: sanitize the mapping_array created
	 *
	 * @param {array} $options
	 *
	 * @return {array}
	 * the keys and values within the array are not filtered
	 */
	public function getJsonAsArray( array &$options = array() ) {
		$result = array();

		try {
			$result = json_decode( $this->mapping_json, true );
			\GWToolset\jsonCheckForError();
		} catch ( MWException $e ) {
			$error_msg = $e->getMessage();
			if ( isset( $options['Metadata-Mapping-Title'] ) ) {
				$error_msg .= ' ' . Linker::link( $options['Metadata-Mapping-Title'], null, array( 'target' => '_blank' ) );
			}

			throw new MWException(
				wfMessage( 'gwtoolset-metadata-mapping-bad' )
					->rawParams( $error_msg )
					->parse()
			);
		}

		return $result;
	}

	/**
	 * relies on a hardcoded path to the metadata mapping url
	 *
	 * @param {array} $options
	 *
	 * @throws {MWException}
	 *
	 * @return {string}
	 * the string is not filtered
	 */
	protected function getMappingName( array $options ) {
		$result = null;

		$Languages = new Language();
		$namespace = $Languages->getNamespaces();
		$namespace = $namespace[Config::$metadata_namespace] . ':';

		if ( !empty( $options['Metadata-Mapping-Title'] ) ) {
			$result = str_replace(
				array(
					$namespace,
					Config::$metadata_mapping_subpage,
					'.json'
				),
				'',
				$options['Metadata-Mapping-Title']
			);

			$result = explode( '/', $result );

			if ( !isset( $result[2] ) ) {
				$url = Filter::evaluate( $options['metadata-mapping-url'] );

				$expected_path = $namespace .
					Filter::evaluate( Config::$metadata_mapping_subpage ) .
					'/user-name/file-name.json';

				$msg = wfMessage( 'gwtoolset-metadata-mapping-invalid-url' )
					->rawParams( $url, $expected_path )
					->escaped();

				throw new MWException( $msg );
			}

			$result = $result[2];
		}

		return $result;
	}

	/**
	 * attempts to retrieve a wiki page title that contains the metadata mapping json
	 *
	 * @param {array} $options
	 * @throws {MWException}
	 * @return {null|Title}
	 */
	protected function getMappingTitle( array &$options ) {
		$result = null;

		if ( !empty( $options['metadata-mapping-url'] ) ) {
			$result = \GWToolset\getTitle(
				$options['metadata-mapping-url'],
				Config::$metadata_namespace
			);

			if ( empty( $result ) ) {
				throw new MWException(
					wfMessage( 'gwtoolset-metadata-mapping-not-found' )
						->params( $options['metadata-mapping-url'] )
						->parse()
				);
			}
		}

		return $result;
	}

	/**
	 * @param {array} $options
	 * @return {void}
	 */
	protected function populate( array &$options ) {
		if ( empty( $options ) ) {
			return;
		}

		$this->mediawiki_template_name =
			isset( $options['mediawiki-template-name'] )
				? $options['mediawiki-template-name']
				: null;

		$this->mapping_json =
			isset( $options['metadata-mapping-json'] )
				? $options['metadata-mapping-json']
				: null;

		$this->mapping_array = $this->getJsonAsArray( $options );
		$this->setTargetElements();
		$this->reverseMap();
	}

	/**
	 * @return {void}
	 */
	public function reset() {
		$this->mapping_array = array();
		$this->mapping_json = null;
		$this->mediawiki_template_name = null;
		$this->target_dom_elements = array();
		$this->target_dom_elements_mapped = array();
		$this->_DataAdapater = null;
	}

	/**
	 * @param {array} $options
	 * an array of user options that was submitted in the html form
	 *
	 * @throws {MWException}
	 * @return {void}
	 */
	public function retrieve( array &$options = array() ) {
		$options['Metadata-Mapping-Title'] = $this->getMappingTitle( $options );
		$options['metadata-mapping-name'] = $this->getMappingName( $options );
		$options['metadata-mapping-json'] = $this->_DataAdapater->retrieve( $options );

		if ( !empty( $options['Metadata-Mapping-Title'] ) ) {
			$this->populate( $options );
		}
	}

	/**
	 * @return {void}
	 */
	public function reverseMap() {
		foreach ( $this->target_dom_elements as $element ) {
			foreach ( $this->mapping_array as $mediawiki_parameter => $target_dom_elements ) {
				if ( in_array( $element, $target_dom_elements ) ) {
					$this->target_dom_elements_mapped[$element][] = $mediawiki_parameter;
				}
			}
		}
	}

	/**
	 * @return {void}
	 */
	public function setTargetElements() {
		foreach ( $this->mapping_array as $key => $value ) {
			foreach ( $value as $item ) {
				if ( !in_array( $item, $this->target_dom_elements ) && !empty( $item ) ) {
					$this->target_dom_elements[] = $item;
				}
			}
		}
	}

	public function update( array &$options = array() ) {
	}
}
