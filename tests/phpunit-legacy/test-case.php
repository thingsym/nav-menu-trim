<?php

class Test_Nav_Menu_Trim_Case extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->nav_menu_trim = new Nav_Menu_Trim();
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_id_case_1() {
		$options = array(
			'id'                     => true,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$id = $this->nav_menu_trim->trim_item_id( 'menu-item-1697', '', '', '' );
		$this->assertSame( $id, '' );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );
		$hook_classes = $this->_get_classes( $wp_post );

		$classes = $this->nav_menu_trim->trim_menu_css_class( $hook_classes, $wp_post, '', '' );

		foreach ( $hook_classes as $key => $value ) {
			$this->assertTrue( in_array( $value, $classes ) );
		}
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_id_case_2() {
		$options = array(
			'id'                     => false,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$id = $this->nav_menu_trim->trim_item_id( 'menu-item-1697', '', '', '' );
		$this->assertSame( $id, 'menu-item-1697' );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );
		$hook_classes = $this->_get_classes( $wp_post );

		$classes = $this->nav_menu_trim->trim_menu_css_class( $hook_classes, $wp_post, '', '' );

		foreach ( $hook_classes as $key => $value ) {
			$this->assertTrue( in_array( $value, $classes ) );
		}
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_1() {
		$options = array(
			'id'                     => false,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => true,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );
		$hook_classes = $this->_get_classes( $wp_post );

		$classes = $this->nav_menu_trim->trim_menu_css_class( $hook_classes, $wp_post, '', '' );
		$this->assertSame( $classes, array() );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_2() {
		$options = array(
			'id'                     => false,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => true,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );
		$hook_classes = $this->_get_classes( $wp_post );

		$classes = $this->nav_menu_trim->trim_menu_css_class( $hook_classes, $wp_post, '', '' );
		$this->assertTrue( in_array( 'current-menu-item', $classes ) );
		$this->assertSame( 1, count( $classes ) );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_3() {
		$options = array(
			'id'                     => false,
			'menu-item'              => true,
			'current-menu'           => true,
			'menu-item-has-children' => false,
			'current-menu-item'      => false,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );
		$hook_classes = $this->_get_classes( $wp_post );

		$classes = $this->nav_menu_trim->trim_menu_css_class( $hook_classes, $wp_post, '', '' );
		$this->assertTrue( in_array( 'current-menu-item', $classes ) );
		$this->assertTrue( in_array( 'menu-item-has-children', $classes ) );
		$this->assertSame( 2, count( $classes ) );
	}

	public function _get_classes( $wp_post ) {
		$classes = array(
			'menu-item',
			'menu-item-object-' . $wp_post->object,
			'menu-item-object-category',
			'menu-item-object-tag',
			'menu-item-object-page',
			// menu-item-object-{custom}
			'menu-item-type-' . $wp_post->type,
			'menu-item-type-post_type',
			'menu-item-type-taxonomy',
			'menu-item-home',
			'menu-item-' . $wp_post->ID,

			'page_item',
			'page_item_has_children',
			'page-item-' . $wp_post->object_id,
			'current-menu-parent',
			'current-' . $wp_post->object_id . '-parent',
			'current-' . $wp_post->post_type . '-parent',
			'current-menu-ancestor',
			'current-' . $wp_post->object_id . '-ancestor',
			'current-' . $wp_post->post_type . '-ancestor',

			'current_page_item',
			'current_page_parent',
			'current_page_ancestor',

			'current-page-parent',
			'current-page-ancestor',

			'menu-item-has-children',
			'current-menu-item',
		);

		return $classes;
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_submenu_classes_case() {
		$options = array(
			'id'                     => false,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'sub-menu-class'         => true,
		);

		update_option( 'nav_menu_trim_options', $options );

		$hook_classes = array(
			'sub-menu',
		);

		$classes = $this->nav_menu_trim->trim_submenu_css_class( $hook_classes, '', '' );
		$this->assertFalse( in_array( 'sub-menu', $classes ) );

		$options = array(
			'id'                     => false,
			'menu-item'              => false,
			'current-menu'           => false,
			'menu-item-has-children' => false,
			'sub-menu-class'         => false,
		);

		update_option( 'nav_menu_trim_options', $options );

		$hook_classes = array(
			'sub-menu',
		);

		$classes = $this->nav_menu_trim->trim_submenu_css_class( $hook_classes, '', '' );
		$this->assertTrue( in_array( 'sub-menu', $classes ) );

	}
}
