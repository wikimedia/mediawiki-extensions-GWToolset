<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */
namespace GWToolset\Models;

interface ModelInterface {

	public function create( array $options = [] );

	public function retrieve( array &$options = [] );

	public function update( array &$options = [] );

	public function delete( array &$options = [] );
}
