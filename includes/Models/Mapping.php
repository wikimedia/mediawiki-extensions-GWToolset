<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Models;
use Exception,
	GWToolset\Adapters\DataAdapterInterface,
	GWtoolset\Config,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiPages,
	Linker,
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
		$error_msg = null;
		$json_error = JSON_ERROR_NONE;
		$result = array();

		$result = json_decode( $this->mapping_json, true );
		$json_error = json_last_error();

		if ( $json_error !== JSON_ERROR_NONE ) {
			switch ( json_last_error() ) {
				case JSON_ERROR_NONE:
					$error_msg = wfMessage( 'gwtoolset-json-error-none' )->escaped();
					break;

				case JSON_ERROR_DEPTH:
					$error_msg = wfMessage( 'gwtoolset-json-error-depth' )->escaped();
					break;

				case JSON_ERROR_STATE_MISMATCH:
					$error_msg = wfMessage( 'gwtoolset-json-error-state-mismatch' )->escaped();
					break;

				case JSON_ERROR_CTRL_CHAR:
					$error_msg = wfMessage( 'gwtoolset-json-error-ctrl-char' )->escaped();
					break;

				case JSON_ERROR_SYNTAX:
					$error_msg = wfMessage( 'gwtoolset-json-error-syntax' )->escaped();
					break;

				case JSON_ERROR_UTF8:
					$error_msg = wfMessage( 'gwtoolset-json-error-utf8' )->escaped();
					break;

				default:
					$error_msg = wfMessage( 'gwtoolset-json-error-unknown' )->escaped();
					break;
			}

			if ( isset( $options['Metadata-Mapping-Title'] ) ) {
				$error_msg .= ' ' . Linker::link( $options['Metadata-Mapping-Title'], null, array( 'target' => '_blank' ) );
			}

			throw new Exception( wfMessage( 'gwtoolset-metadata-mapping-bad' )->rawParams( $error_msg )->parse() );
		}

		return $result;
	}

	/**
	 * relies on a hardcoded path to the metadata mapping url
	 *
	 * @param {array} $options
	 *
	 * @throws {Exception}
	 *
	 * @return {string}
	 * the string is not filtered
	 */
	protected function getMappingName( array $options ) {
		$result = null;

		if ( !empty( $options['Metadata-Mapping-Title'] ) ) {
			$result = str_replace(
				array(
					Config::$metadata_namespace,
					Config::$metadata_mapping_subdirectory,
					'.json'
				),
				'',
				$options['Metadata-Mapping-Title']
			);

			$result = explode( '/', $result );

			if ( !isset( $result[2] ) ) {
				$msg =
					wfMessage( 'gwtoolset-metadata-mapping-invalid-url' )->rawParams(
						Filter::evaluate( $options['metadata-mapping-url'] ),
						Filter::evaluate( Config::$metadata_namespace ) . Filter::evaluate( Config::$metadata_mapping_subdirectory ) . '/user-name/file-name.json'
					)->escaped();

				throw new Exception( $msg );
			}

			$result = $result[2];
		}

		return $result;
	}

	/**
	 * @param {array} $options
	 * @throws {Exception}
	 * @return {null|Title}
	 */
	protected function getMappingTitle( array &$options ) {
		$result = null;

		if ( !empty( $options['metadata-mapping-url'] ) ) {
			$result = WikiPages::getTitleFromUrl(
				$options['metadata-mapping-url'],
				FileChecks::getAcceptedExtensions( Config::$accepted_mapping_types )
			);

			if ( empty( $result ) ) {
				throw new Exception(
					wfMessage( 'gwtoolset-metadata-mapping-not-found' )
						->params( $options['metadata-mapping-url'] )
						->escaped()
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
	 * @throws {Exception}
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
