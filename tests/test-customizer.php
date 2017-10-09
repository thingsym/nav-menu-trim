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
	function sanitize_checkbox() {
		$this->assertTrue( $this->nav_menu_trim->sanitize_checkbox( true ) );
		$this->assertFalse( $this->nav_menu_trim->sanitize_checkbox() );
		$this->assertTrue( $this->nav_menu_trim->sanitize_checkbox( 1 ) );
		$this->assertFalse( $this->nav_menu_trim->sanitize_checkbox( 0 ) );
	}

}
