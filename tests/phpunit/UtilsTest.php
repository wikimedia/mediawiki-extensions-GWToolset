<?php
/**
 * @group GWToolset
 * @covers Utils
 */
namespace GWToolset;

use MediaWikiTestCase;

class GWToolsetUtilsTest extends MediaWikiTestCase {

	protected $utils;

	protected function setUp() {
		parent::setUp();
		$this->utils = new Utils();
	}

	protected function tearDown() {
		parent::tearDown();
	}

	/**
	 * @covers Utils::getArraySecondLevelValues
	 */
	public function test_getArraySecondLevelValues_empty() {
		$input = [ [] ];
		$expected = [];
		$this->assertEquals( $this->utils->getArraySecondLevelValues( $input ), $expected );
	}

	/**
	 * @covers Utils::getArraySecondLevelValues
	 */
	public function test_getArraySecondLevelValues() {
		$input = [ [ 1 ], [ 2 ], [ 3, 4, 5 ] ];
		$expected = [ 1, 2, 3, 4, 5 ];
		$this->assertEquals( $this->utils->getArraySecondLevelValues( $input ), $expected );
	}

	/**
	 * @covers Utils::getBytes
	 */
	public function test_getBytes_passthrough() {
		$this->assertEquals( $this->utils->getBytes( '1' ), 1 );
	}

	/**
	 * @covers Utils::getBytes
	 */
	public function test_getBytes_M() {
		$this->assertEquals( $this->utils->getBytes( "1M" ), 1048576 );
	}

	/**
	 * @covers Utils::getBytes
	 */
	public function test_getBytes_K() {
		$this->assertEquals( $this->utils->getBytes( "1K" ), 1024 );
	}

	/**
	 * @covers Utils::getBytes
	 */
	public function test_getBytes_G() {
		$this->assertEquals( $this->utils->getBytes( "1G" ), 1073741824 );
	}

	/**
	 * @covers Utils::getNamespaceName
	 */
	public function test_getNamespaceName_empty() {
		$this->assertEquals( $this->utils->getNamespaceName(), ':' );
	}

	/**
	 * @covers Utils::getNamespaceName
	 */
	public function test_getNamespaceName_6() {
		$this->assertEquals( $this->utils->getNamespaceName( 6 ), 'File:' );
	}

	/**
	 * @covers Utils::getNamespaceName
	 */
	public function test_getNamespaceName_not_string() {
		$this->assertEquals( $this->utils->getNamespaceName( "Something" ), null );
	}

	/**
	 * @covers Utils::normalizeSpace
	 */
	public function test_normalizeSpace() {
		$this->assertEquals( $this->utils->normalizeSpace( "a b cd" ), "a_b_cd" );
	}

}
