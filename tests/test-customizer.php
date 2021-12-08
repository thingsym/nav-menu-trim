<?php

class Test_Nav_Menu_Trim_Customizer extends WP_UnitTestCase {

	/**
	 * Instance of WP_Customize_Manager which is reset for each test.
	 *
	 * @var WP_Customize_Manager
	 */
	public $wp_customize;

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();

		require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';

		$user_id = self::factory()->user->create(
			array(
				'role' => 'administrator',
			)
		);
		if ( is_multisite() ) {
			grant_super_admin( $user_id );
		}

		wp_set_current_user( $user_id );

		global $wp_customize;
		$this->wp_customize = new WP_Customize_Manager();
		$wp_customize       = $this->wp_customize;

		do_action( 'customize_register', $this->wp_customize );
	}

	/**
	 * @test
	 * @group customizer
	 */
	function customizer() {
		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[id]' );
		$this->assertEquals( 'nav_menu_trim_options[id]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[id]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[menu-item]' );
		$this->assertEquals( 'nav_menu_trim_options[menu-item]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[menu-item]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[current-menu]' );
		$this->assertEquals( 'nav_menu_trim_options[current-menu]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[current-menu]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[menu-item-has-children]' );
		$this->assertEquals( 'nav_menu_trim_options[menu-item-has-children]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[menu-item-has-children]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[current-menu-item]' );
		$this->assertEquals( 'nav_menu_trim_options[current-menu-item]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[current-menu-item]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[sub-menu-class]' );
		$this->assertEquals( 'nav_menu_trim_options[sub-menu-class]', $setting->id );
		$this->assertEquals( 'option', $setting->type );
		$this->assertEquals( 'manage_options', $setting->capability );
		$this->assertEquals( false, $setting->default );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertTrue( in_array( 'sanitize_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( false, $setting->value() );

		$control = $this->wp_customize->get_control( 'nav_menu_trim_options[sub-menu-class]' );
		$this->assertEquals( 'nav_menu_trim', $control->section );
		$this->assertEquals( 'checkbox', $control->type );

		$section = $this->wp_customize->get_section( 'nav_menu_trim' );
		$this->assertEquals( 'nav_menu_trim', $section->id );
		$this->assertEquals( 1000, $section->priority );
		$this->assertEquals( 'nav_menus', $section->panel );
		$this->assertEquals( 'manage_options', $section->capability );
		$this->assertEquals( 'Nav Menu Trim', $section->title );
	}

	/**
	 * @test
	 * @group customizer
	 */
	function save_case() {
		$this->wp_customize->set_post_value( 'nav_menu_trim_options[id]', true );
		// $setting->preview();
		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[id]' );
		$setting->save();
		$this->assertTrue( $setting->value() );

		$option = $this->nav_menu_trim->get_options( 'id' );
		$this->assertTrue( $option );

		$this->wp_customize->set_post_value( 'nav_menu_trim_options[id]', false );
		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[id]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->nav_menu_trim->get_options( 'id' );
		$this->assertFalse( $option );

		$this->wp_customize->set_post_value( 'nav_menu_trim_options[id]', 'abc' );
		$setting = $this->wp_customize->get_setting( 'nav_menu_trim_options[id]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->nav_menu_trim->get_options( 'id' );
		$this->assertFalse( $option );
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
