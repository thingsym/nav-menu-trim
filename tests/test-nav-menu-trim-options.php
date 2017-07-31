<?php

class Nav_Menu_Trim_Options_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group options
	 */
	function get_options_default() {
		$options = $this->nav_menu_trim->get_options();
		$this->assertEquals( null, $options );
	}

	/**
	 * @test
	 * @group options
	 */
	function get_options_case_1() {
		$options = array(
			'id'                     => 1,
			'menu-item'              => 1,
			'current-menu'           => 1,
			'menu-item-has-children' => 1,
			'current-menu-item'      => 1,
		);

		update_option( 'nav_menu_trim_options', $options );

		$options = $this->nav_menu_trim->get_options();

		$this->assertEquals( $options['id'], 1 );
		$this->assertEquals( $options['menu-item'], 1 );
		$this->assertEquals( $options['current-menu'], 1 );
		$this->assertEquals( $options['menu-item-has-children'], 1 );
		$this->assertEquals( $options['current-menu-item'], 1 );

		$option = $this->nav_menu_trim->get_options( 'id' );
		$this->assertEquals( $option, 1 );

		$option = $this->nav_menu_trim->get_options( 'test' );
		$this->assertEquals( $option, null );

	}

}
