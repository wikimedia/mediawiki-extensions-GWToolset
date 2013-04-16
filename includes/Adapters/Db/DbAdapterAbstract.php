<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Adapters\Db;
use DatabaseUpdater,
	GWToolset\Adapters\DataAdapterInterface;

abstract class DbAdapterAbstract implements DataAdapterInterface {

	/**
	 * @var {DatabaseBase}
	 */
	protected $dbr;

	/**
	 * @var {DatabaseBase}
	 */
	protected $dbw;

	/**
	 * @var {string}
	 * table associated with this object
	 */
	protected $table_name;

	/**
	 * @var {string}
	 * path to the table create sql file
	 */
	protected $table_create_sql;

	/**
	 * @param {string} $table_name
	 * @param {string} $table_create_sql filename containing the create table sql statements
	 * @return {void}
	 */
	public function __construct( $table_name ) {
		$this->reset();
		$this->table_name = $table_name;
		$this->setTableCreateSql();
	}

	/**
	 * returns an indexed array of key values from a db table
	 * @return {array}
	 */
	abstract public function getKeys();

	/**
	 * @param {DatabaseAdapter} $updater
	 * @return {void}
	 */
	public function createTable( DatabaseUpdater $updater ) {
		$updater->addExtensionTable(
			$this->table_name,
			$this->table_create_sql
		);
	}

	/**
	 * @return {void}
	 */
	protected function setTableCreateSql() {
		global $wgGWToolsetDir;

		$this->table_create_sql =
			$wgGWToolsetDir . DIRECTORY_SEPARATOR .
			'sql' . DIRECTORY_SEPARATOR .
			'table-create-' . str_replace( '_', '-', $this->table_name ) . '.sql';
	}

	/**
	 * @return {void}
	 */
	public function reset() {
		$this->dbr = \wfGetDB( DB_SLAVE );
		$this->dbw = \wfGetDB( DB_MASTER );
		$this->table_name = null;
	}
}
