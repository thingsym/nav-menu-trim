<?php

class Test_Nav_Menu_Trim_Options extends WP_UnitTestCase {

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
		$expected = array(
			'id'                     => false,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);

		$this->assertSame( $expected, $options );
	}

	/**
	 * @test
	 * @group options
	 */
	function get_options_case_1() {
		$options = array(
			'id'                     => true,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => true,
			'sub-menu-class'         => true,
		);

		update_option( 'nav_menu_trim_options', $options );

		$options = $this->nav_menu_trim->get_options();

		$this->assertTrue( $options['id'] );
		$this->assertTrue( $options['menu-item'] );
		$this->assertTrue( $options['current-menu'] );
		$this->assertTrue( $options['menu-item-has-children'] );
		$this->assertTrue( $options['current-menu-item'] );
		$this->assertTrue( $options['sub-menu-class'] );

		$option = $this->nav_menu_trim->get_options( 'id' );
		$this->assertTrue( $option );

		$option = $this->nav_menu_trim->get_options( 'test' );
		$this->assertSame( $option, null );

	}

	/**
	 * @test
	 * @group options
	 */
	public function get_options_case_filters() {
		$options = array(
			'id'                     => true,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => true,
			'sub-menu-class'         => true,
		);

		update_option( 'nav_menu_trim_options', $options );

		add_filter( 'nav_menu_trim_get_options', array( $this, '_filter_options' ), 10 );

		$options = $this->nav_menu_trim->get_options();
		$this->assertFalse( $options['id'] );

		add_filter( 'nav_menu_trim_get_option', array( $this, '_filter_option' ), 10, 2 );

		$options = $this->nav_menu_trim->get_options( 'menu-item' );
		$this->assertFalse( $options );
	}

	public function _filter_options( $options ) {
		$expected = array(
			'id'                     => true,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => true,
			'sub-menu-class'         => true,
		);
		$this->assertSame( $expected, $options );

		$options['id'] = false;
		return $options;
	}

	public function _filter_option( $option, $name ) {
		$this->assertTrue( $option );
		$this->assertSame( $name, 'menu-item' );

		$option = false;
		return $option;
	}
}
