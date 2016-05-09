<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */
namespace GWToolset\Adapters;

interface DataAdapterInterface {

	public function create( array $options = [] );

	public function retrieve( array $options = [] );

	public function update( array $options = [] );

	public function delete( array $options = [] );
}
