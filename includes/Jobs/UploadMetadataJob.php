<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Jobs;
use Job,
	MWException,
	GWToolset\Handlers\Forms\MetadataMappingHandler,
	User;

/**
 * runs the MetadataMappingHandler with the originally $_POST’ed
 * form fields when the job was created. the $_POST contains
 * one or more of the following, which are used to create
 * uploadMediafileJobs via the MetadataMappingHandler:
 *
 *   - mediawiki template to use
 *   - url to the metadata source in the wiki
 *   - the metadata mapping to use
 *   - categories to add to the media files
 *   - partner template to use
 *   - summary to use
 */
class UploadMetadataJob extends Job {

	/**
	 * @var {MetadataMappingHandler}
	 */
	protected $_MetadataMappingHandler;

	/**
	 * @param {Title} $title
	 * @param {bool|array} $params
	 * @param {int} $id
	 * @return {void}
	 */
	public function __construct( $title, $params, $id = 0 ) {
		parent::__construct( 'gwtoolsetUploadMetadataJob', $title, $params, $id );
	}

	/**
	 * entry point
	 * @todo: should $result always be true?
	 * @return {bool|array}
	 */
	public function run() {
		$result = false;

		if ( !$this->validateParams() ) {
			return $result;
		}

		$_POST = $this->params['post'];
		$this->_MetadataMappingHandler = new MetadataMappingHandler(
			array( 'User' => User::newFromName( $this->params['username'] ) )
		);

		try {
			$result = $this->_MetadataMappingHandler->processRequest();
		} catch ( MWException $e ) {
			$this->setLastError( __METHOD__ . ': ' . $e->getMessage() );
		}

		return $result;
	}

	/**
	 * @return {bool}
	 */
	protected function validateParams() {
		$result = true;

		if ( empty( $this->params['username'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'user\'] provided' );
			$result = false;
		}

		if ( empty( $this->params['post'] ) ) {
			$this->setLastError( __METHOD__ . ': no $this->params[\'post\'] provided' );
			$result = false;
		}

		return $result;
	}
}
