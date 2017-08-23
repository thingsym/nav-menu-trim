<?php

class Nav_Menu_Trim_Uninstall_Test extends WP_UnitTestCase {

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
			'id'                     => 1,
			'menu-item'              => 1,
			'current-menu'           => 1,
			'menu-item-has-children' => 1,
			'current-menu-item'      => 1,
		);

		update_option( 'nav_menu_trim_options', $options );

		$this->nav_menu_trim->uninstall();
		$this->assertFalse( get_option( 'nav_menu_trim_options' ) );
	}

}
