<?php

class Test_Nav_Menu_Trim_Uninstall extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group basic
	 */
	function uninstall() {
		$options = array(
			'id'                     => true,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => true,
			'sub-menu-class'         => true,
		);

		update_option( 'nav_menu_trim_options', $options );

		$this->nav_menu_trim->uninstall();
		$this->assertFalse( get_option( 'nav_menu_trim_options' ) );
	}

}
