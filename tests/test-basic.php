<?php

class Nav_Menu_Trim_Basic_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group basic
	 */
	function construct() {
		$this->assertEquals( 10, has_filter( 'init', array( $this->nav_menu_trim, 'init' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function init() {
		$this->nav_menu_trim->init();
		$this->assertEquals( 10, has_filter( 'nav_menu_css_class', array( $this->nav_menu_trim, 'trim_menu_css_class' ) ) );
		$this->assertEquals( 10, has_filter( 'nav_menu_item_id', array( $this->nav_menu_trim, 'trim_item_id' ) ) );
		$this->assertEquals( 10, has_filter( 'nav_menu_submenu_css_class', array( $this->nav_menu_trim, 'trim_submenu_css_class' ) ) );

		$this->assertEquals( 10, has_action( 'customize_register', array( $this->nav_menu_trim, 'customizer' ) ) );
		$this->assertEquals( 10, has_action( 'customize_controls_print_styles', array( $this->nav_menu_trim, 'customizer_print_styles' ) ) );

		$this->assertEquals( 10, has_filter( 'plugin_action_links_' . plugin_basename( __NAV_MENU_TRIM_FILE__ ), array( $this->nav_menu_trim, 'plugin_action_links' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function customizer_print_styles() {
		$this->expectOutputRegex( '/^<style>/' );
		$this->nav_menu_trim->customizer_print_styles();
	}

	/**
	 * @test
	 * @group basic
	 */
	function plugin_action_links() {
		$links = $this->nav_menu_trim->plugin_action_links( array() );
		$this->assertContains( 'customize.php?autofocus%5Bsection%5D=nav_menu_trim', $links[0] );
	}

}
