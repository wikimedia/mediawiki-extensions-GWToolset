<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Models;

use GWToolset\Adapters\DataAdapterInterface;
use GWToolset\Config;
use GWToolset\Utils;

class Metadata implements ModelInterface {
	/**
	 * @var {array}
	 */
	public $metadata_as_array;

	/**
	 * @var {string}
	 * a raw representation of the original metadata
	 */
	public $metadata_raw;

	/**
	 * @var {DataAdapterInterface}
	 */
	protected $_DataAdapater;

	/**
	 * @param {DataAdapterInterface} $DataAdapter
	 */
	public function __construct( DataAdapterInterface $DataAdapter ) {
		$this->reset();
		$this->_DataAdapater = $DataAdapter;
	}

	/**
	 * @param {array} $options
	 */
	public function create( array $options = array() ) {
	}

	/**
	 * @param {array} $options
	 */
	public function delete( array &$options = array() ) {
	}

	/**
	 * locates an element within the metadata, which can sometimes be repeated
	 * in a single metadata record, and creates an array of the values it finds
	 *
	 * @param {string} $field
	 *
	 * @return {array}
	 * the elements within the array are sanitized
	 */
	public function getFieldValuesAsArray( $field = null ) {
		$result = array();

		if ( empty( $field ) || !is_string( $field ) ) {
			return $result;
		}

		if ( array_key_exists( $field, $this->metadata_as_array ) ) {
			foreach ( $this->metadata_as_array[$field] as $key => $value ) {
				if ( $key === '@attributes' ) {
					continue;
				}

				if ( strpos( $value, '://' ) !== false ) {
					$result[] = Utils::sanitizeUrl( $value );
				} else {
					$result[] = Utils::sanitizeString( $value );
				}
			}
		}

		return $result;
	}

	/**
	 * locates an element within the metadata and concatenates its values when
	 * there is more than one of the same element within the metadata
	 *
	 * @todo should we cache the concatenated fields or pre-populate all of them?
	 *
	 * @param {string} $field
	 *
	 * @return {null|string}
	 * the string is sanitized
	 */
	public function getFieldValuesConcatenated( $field = null ) {
		$result = null;

		if ( empty( $field ) || !is_string( $field ) ) {
			return $result;
		}

		$result = implode(
			Config::$metadata_separator . ' ',
			$this->getFieldValuesAsArray( $field )
		);

		$result = rtrim( $result, Config::$metadata_separator );

		return $result;
	}

	public function reset() {
		$this->metadata_as_array = array();
		$this->metadata_raw = null;
		$this->_DataAdapater = null;
	}

	/**
	 * @param {array} $options
	 */
	public function retrieve( array &$options = array() ) {
	}

	/**
	 * @param {array} $options
	 */
	public function update( array &$options = array() ) {
	}
}
