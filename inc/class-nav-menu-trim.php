<?php
/**
 * Class Nav_Menu_Trim
 *
 * @since 1.0.0
 */
class Nav_Menu_Trim {

	/**
	 * @var string $option_name   option name
	 */
	protected $option_name = 'nav_menu_trim_options';

	/**
	 * @var string $type   types of settings
	 */
	protected $type = 'option';

	/**
	 * @var string $capability   types of capability
	 */
	protected $capability = 'manage_options';

	/**
	 * @var string $languages_path   languages file path
	 */
	protected $languages_path = 'nav-menu-trim/languages';

	/**
	 * constructor
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'init', array( $this, 'init' ) );
	}

	/**
	 * init
	 *
	 * @access public
	 *
	 * @since 1.0.2
	 */
	public function init() {
		add_filter( 'nav_menu_item_id', array( $this, 'trim_item_id' ), 10, 4 );
		add_filter( 'nav_menu_css_class', array( $this, 'trim_css_class' ), 10, 4 );

		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_action( 'customize_controls_print_styles', array( $this, 'customizer_print_styles' ) );

		add_filter( 'plugin_action_links_' . plugin_basename( __NAV_MENU_TRIM_FILE__ ), array( $this, 'plugin_action_links' ) );
		register_uninstall_hook( __NAV_MENU_TRIM_FILE__, array( __CLASS__, 'uninstall' ) );
	}

	/**
	 * trim html id attributes of Nav Menu.
	 *
	 * hook to nav_menu_item_id
	 * @see https://developer.wordpress.org/reference/hooks/nav_menu_item_id/
	 *
	 * @access public
	 * @param $menu_id
	 * @param $item
	 * @param $args
	 * @param $depth
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function trim_item_id( $menu_id, $item, $args, $depth ) {
		$option = $this->get_options( 'id' );

		if ( $option ) {
			return '';
		}

		return $menu_id;
	}

	/**
	 * trim html class attributes of Nav Menu.
	 *
	 * hook to nav_menu_css_class
	 * @see https://developer.wordpress.org/reference/hooks/nav_menu_css_class/
	 *
	 * @access public
	 * @param $classes
	 * @param $item
	 * @param $args
	 * @param $depth
	 * @return array
	 *
	 * @link https://developer.wordpress.org/reference/functions/_wp_menu_item_classes_by_context/
	 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
	 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
	 *
	 * @since 1.0.0
	 */
	public function trim_css_class( $classes, $item, $args, $depth ) {
		$menu_item_classes = array(
			'menu-item',
			'menu-item-object-' . $item->object,
			'menu-item-object-category',
			'menu-item-object-tag',
			'menu-item-object-page',
			// menu-item-object-{custom}
			'menu-item-type-' . $item->type,
			'menu-item-type-post_type',
			'menu-item-type-taxonomy',
			'menu-item-home',
			'menu-item-' . $item->ID,

			'page_item',
			'page_item_has_children',
			'page-item-' . $item->object_id,
		);

		$current_classes = array(
			'current-menu-parent',
			'current-' . $item->object_id . '-parent',
			'current-' . $item->post_type . '-parent',
			'current-menu-ancestor',
			'current-' . $item->object_id . '-ancestor',
			'current-' . $item->post_type . '-ancestor',

			'current_page_item',
			'current_page_parent',
			'current_page_ancestor',

			'current-page-parent',
			'current-page-ancestor',
		);

		$trim_classes = array();
		$options = $this->get_options();

		if ( $options['menu-item'] ) {
			$trim_classes = array_merge( $trim_classes, $menu_item_classes );
		}
		if ( $options['current-menu'] ) {
			$trim_classes = array_merge( $trim_classes, $current_classes );
		}
		if ( $options['menu-item-has-children'] ) {
			$trim_classes[] = 'menu-item-has-children';
		}
		if ( $options['current-menu-item'] ) {
			$trim_classes[] = 'current-menu-item';
		}

		foreach ( $trim_classes as $class ) {
			$key = array_search( $class, $classes );
			if ( false !== $key ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;
	}

	/**
	 * Returns the options array or value.
	 *
	 * @access public
	 * @param string $option Optional
	 * @return array|value
	 *
	 * @since 1.0.0
	 */
	public function get_options( $option = null ) {
		$options = get_option( $this->option_name );

		if ( is_null( $option ) ) {
			return apply_filters( 'nav_menu_trim_get_options', $options );
		}

		if ( isset( $options[ $option ] ) ) {
			return apply_filters( 'nav_menu_trim_get_options', $options[ $option ] );
		}
		else {
			return null;
		}
	}

	/**
	 * Options into the Customizer.
	 *
	 * @access public
	 * @param $wp_customize Customizer object
	 * @return void
	 *
	 * @options array nav_menu_trim_options
	 * @option bool id
	 * @option bool menu-item
	 * @option bool current-menu
	 * @option bool menu-item-has-children
	 * @option bool current-menu-item
	 *
	 * @since 1.0.0
	 */
	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$this->load_textdomain();

		$wp_customize->add_setting(
			'nav_menu_trim_options[id]',
			array(
				'type'              => $this->type,
				'capability'        => $this->capability,
				'default'           => false,
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'nav_menu_trim_options[id]',
			array(
				'label'      => __( 'remove id attribute', 'nav-menu-trim' ),
				'section'    => 'nav_menu_trim',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'nav_menu_trim_options[menu-item]',
			array(
				'type'              => $this->type,
				'capability'        => $this->capability,
				'default'           => false,
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'nav_menu_trim_options[menu-item]',
			array(
				'label'      => __( 'remove menu-item-* values of the class attribute (exclude menu-item-has-children)', 'nav-menu-trim' ),
				'section'    => 'nav_menu_trim',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'nav_menu_trim_options[current-menu]',
			array(
				'type'              => $this->type,
				'capability'        => $this->capability,
				'default'           => false,
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'nav_menu_trim_options[current-menu]',
			array(
				'label'      => __( 'remove current-menu-* values of the class attribute (exclude current-menu-item)', 'nav-menu-trim' ),
				'section'    => 'nav_menu_trim',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'nav_menu_trim_options[menu-item-has-children]',
			array(
				'type'              => $this->type,
				'capability'        => $this->capability,
				'default'           => false,
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'nav_menu_trim_options[menu-item-has-children]',
			array(
				'label'      => __( 'remove menu-item-has-children value of the class attribute', 'nav-menu-trim' ),
				'section'    => 'nav_menu_trim',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'nav_menu_trim_options[current-menu-item]',
			array(
				'type'              => $this->type,
				'capability'        => $this->capability,
				'default'           => false,
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_control(
			'nav_menu_trim_options[current-menu-item]',
			array(
				'label'      => __( 'remove current-menu-item value of the class attribute', 'nav-menu-trim' ),
				'section'    => 'nav_menu_trim',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_section( 'nav_menu_trim', array(
			'title'        => __( 'Nav Menu Trim', 'nav-menu-trim' ),
			'description'  => __( 'Select the checkbox of id / class attributes in Menus you want to delete.', 'nav-menu-trim' ),
			'panel'        => 'nav_menus',
			'priority'     => 1000,
			'capability'   => $this->capability,
		) );

	}

	/**
	 * output style into the head of Customize Theme controls.
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function customizer_print_styles() {
		$css = '<style>';
		$css .= '#customize-theme-controls #accordion-section-nav_menu_trim {';
		$css .= 'margin-top: 3px;';
		$css .= '}';
		$css .= '</style>';
		echo $css;
	}

	/**
	 * load textdomain
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	function load_textdomain() {
		load_plugin_textdomain( 'nav-menu-trim', false, $this->languages_path );
	}

	/**
	 * set link to customizer section on the plugins page.
	 *
	 * hooks to plugin_action_links_{$plugin_file}
	 *
	 * @access public
	 * @param array $links
	 * @return array $links
	 *
	 * @since 1.0.0
	 */
	function plugin_action_links( $links = array() ) {
		$this->load_textdomain();
		$settings_link = '<a href="customize.php?autofocus%5Bsection%5D=nav_menu_trim">' . __( 'Settings', 'nav-menu-trim' ) . '</a>';

		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * uninstall hook
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function uninstall() {
		$nav_menu_trim = new Nav_Menu_Trim();
		delete_option( $nav_menu_trim->option_name );
	}
}
