<?php

class Test_Nav_Menu_Trim_Customizer extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group customizer
	 */
	function sanitize_boolean() {
		$this->assertTrue( $this->nav_menu_trim->sanitize_boolean( true ) );
		$this->assertFalse( $this->nav_menu_trim->sanitize_boolean( false ) );
		$this->assertFalse( $this->nav_menu_trim->sanitize_boolean() );
		$this->assertFalse( $this->nav_menu_trim->sanitize_boolean( 1 ) );
		$this->assertFalse( $this->nav_menu_trim->sanitize_boolean( 0 ) );
	}

}
