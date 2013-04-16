<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Adapters\Db;
use Php\Filter,
	ResultWrapper;

class MediawikiTemplateDbAdapter extends DbAdapterAbstract {

	/**
	 * @param {string} $table_name
	 * @return {void}
	 */
	public function __construct( $table_name = 'gwtoolset_mediawiki_templates' ) {
		parent::__construct( $table_name );
	}

	/**
	 * returns an indexed array of key values from the mediawiki template db table,
	 * which represents the mediawiki templates handled by the extension
	 *
	 * @return {array}
	 */
	public function getKeys() {
		$result = array();

		$query_result = $this->dbr->select(
			'gwtoolset_mediawiki_templates',
			array( 'key_name' => 'mediawiki_template_name' ),
			null,
			null,
			array( 'ORDER BY' => 'mediawiki_template_name ASC' )
		);

		foreach ( $query_result as $row ) {
			$result[] = $row->key_name;
		}

		return $result;
	}

	public function create( array $options = array() ) {
	}

	/**
	 * @param {array} $options
	 * @return {ResultWrapper}
	 */
	public function retrieve( array $options = array() ) {
		return $this->dbr->select(
			Filter::evaluate( $this->table_name ),
			'mediawiki_template_name, mediawiki_template_json',
			'mediawiki_template_name = ' . $this->dbr->addQuotes( Filter::evaluate( $options['mediawiki_template_name'] ) )
		);
	}

	public function update( array $options = array() ) {
	}

	public function delete( array $options = array() ) {
	}
}
