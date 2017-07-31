<?php

class Nav_Menu_Trim_Case_Test extends WP_UnitTestCase {

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
			'id' => 1,
		);

		update_option( 'nav_menu_trim_options', $options );

		$id = $this->nav_menu_trim->trim_item_id( 'menu-item-1697', '', '', '' );
		$this->assertEquals( $id, '' );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_id_case_2() {
		$options = array(
			'id' => 0,
		);

		update_option( 'nav_menu_trim_options', $options );

		$id = $this->nav_menu_trim->trim_item_id( 'menu-item-1697', '', '', '' );
		$this->assertEquals( $id, 'menu-item-1697' );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_1() {
		$options = array(
			'id'                     => 1,
			'menu-item'              => 1,
			'current-menu'           => 1,
			'menu-item-has-children' => 1,
			'current-menu-item'      => 1,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );

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

		$classes = $this->nav_menu_trim->trim_css_class( $classes, $wp_post, '', '' );
		$this->assertEquals( $classes, array() );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_2() {
		$options = array(
			'id'                     => 1,
			'menu-item'              => 1,
			'current-menu'           => 1,
			'menu-item-has-children' => 1,
			'current-menu-item'      => 0,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );

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

		$classes = $this->nav_menu_trim->trim_css_class( $classes, $wp_post, '', '' );
		$this->assertTrue( in_array( 'current-menu-item', $classes ) );
		$this->assertEquals( 1, count( $classes ) );
	}

	/**
	 * @test
	 * @group trim
	 */
	function trim_classes_case_3() {
		$options = array(
			'id'                     => 1,
			'menu-item'              => 1,
			'current-menu'           => 1,
			'menu-item-has-children' => 0,
			'current-menu-item'      => 0,
		);

		update_option( 'nav_menu_trim_options', $options );

		$post = $this->factory->post->create();
		$wp_post = get_post( $post );

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

		$classes = $this->nav_menu_trim->trim_css_class( $classes, $wp_post, '', '' );
		$this->assertTrue( in_array( 'current-menu-item', $classes ) );
		$this->assertTrue( in_array( 'menu-item-has-children', $classes ) );
		$this->assertEquals( 2, count( $classes ) );
	}

}
