<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Handlers\Ajax;
use GWToolset\Adapters\Php\MappingPhpAdapter,
	GWToolset\Models\Mapping;

class MetadataMappingSaveHandler extends AjaxHandler {

	/**
	 * @var {Mapping}
	 */
	protected $_Mapping;

	/**
	 * a control method that processes a SpecialPage request
	 * and returns a response, typically an html form
	 *
	 * @return {Status}
	 */
	protected function processRequest() {
		$mapping_result = false;

		$this->_Mapping = new Mapping( new MappingPhpAdapter() );
		$this->_Mapping->mapping_array = $this->SpecialPage->getRequest()->getArray( 'metadata-mappings' );

		// create takes care of new and existing pages
		$mapping_result = $this->_Mapping->create(
			array(
				'created' => date( 'Y-m-d H:i:s' ),
				'mapping-json' => json_encode( $this->_Mapping->mapping_array ),
				'mapping-name' => $this->SpecialPage->getRequest()->getVal( 'mapping-name-to-use' ),
				'mediawiki-template-name' => $this->SpecialPage->getRequest()->getVal( 'mediawiki-template-name' ),
				'user' => $this->SpecialPage->getUser()
			)
		);

		return $mapping_result;
	}
}
