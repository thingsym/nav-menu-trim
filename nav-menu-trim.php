<?php
/**
 * Plugin Name:  Nav Menu Trim
 * Plugin URI:   https://github.com/thingsym/nav-menu-trim
 * Description:  This WordPress plugin trim html id/class attributes of Nav Menu.
 * Author:       thingsym
 * Author URI:   https://management.thingslabo.com/
 * Text Domain:  nav-menu-trim
 * Domain Path:  /languages
 * Version:      1.0.0
 *
 * @package      Nav_Menu_Trim
 */

define( '__NAV_MENU_TRIM_FILE__', __FILE__ );

include_once( plugin_dir_path( __FILE__ ) . 'inc/class-nav-menu-trim.php' );

new Nav_Menu_Trim();
