<?php

class Test_Nav_Menu_Trim_Basic extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group basic
	 */
	function public_variable() {
		$this->assertSame( 'nav_menu_trim_options', $this->nav_menu_trim->option_name );
		$this->assertSame( 'option', $this->nav_menu_trim->type );
		$this->assertSame( 'manage_options', $this->nav_menu_trim->capability );

		$expected = array(
			'id'                     => false,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);
		$this->assertSame( $expected, $this->nav_menu_trim->default_options );
	}

	/**
	 * @test
	 * @group basic
	 */
	function constructor() {
		$this->assertSame( 10, has_filter( 'plugins_loaded', array( $this->nav_menu_trim, 'load_textdomain' ) ) );
		$this->assertSame( 10, has_filter( 'plugins_loaded', array( $this->nav_menu_trim, 'init' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	function init() {
		$this->nav_menu_trim->init();

		$this->assertSame( 10, has_filter( 'nav_menu_css_class', array( $this->nav_menu_trim, 'trim_menu_css_class' ) ) );
		$this->assertSame( 10, has_filter( 'nav_menu_item_id', array( $this->nav_menu_trim, 'trim_item_id' ) ) );
		$this->assertSame( 10, has_filter( 'nav_menu_submenu_css_class', array( $this->nav_menu_trim, 'trim_submenu_css_class' ) ) );

		$this->assertSame( 10, has_action( 'customize_register', array( $this->nav_menu_trim, 'customizer' ) ) );
		$this->assertSame( 10, has_action( 'customize_controls_print_styles', array( $this->nav_menu_trim, 'customizer_print_styles' ) ) );

		$this->assertSame( 10, has_filter( 'plugin_action_links_' . plugin_basename( __NAV_MENU_TRIM__ ), array( $this->nav_menu_trim, 'plugin_action_links' ) ) );
		$this->assertSame( 10, has_filter( 'plugin_row_meta', array( $this->nav_menu_trim, 'plugin_metadata_links' ) ) );
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
		$this->assertContains( '<a href="customize.php?autofocus%5Bsection%5D=nav_menu_trim">Settings</a>', $links );
	}

	/**
	 * @test
	 * @group basic
	 */
	public function plugin_metadata_links() {
		$links = $this->nav_menu_trim->plugin_metadata_links( array(), plugin_basename( __NAV_MENU_TRIM__ ) );
		$this->assertContains( '<a href="https://github.com/sponsors/thingsym">Become a sponsor</a>', $links );
	}

}
