<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Models;
use ResultWrapper;

interface ModelInterface {

	public function create( array $options = array() );

	public function retrieve( array &$options = array() );

	public function update( array &$options = array() );

	public function delete( array &$options = array() );
}
