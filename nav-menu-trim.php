<?php
/**
 * Plugin Name: Nav Menu Trim
 * Plugin URI:  https://github.com/thingsym/nav-menu-trim
 * Description: This WordPress plugin trim html id/class attributes of Nav Menu.
 * Version:     1.2.0
 * Author:      thingsym
 * Author URI:  https://management.thingslabo.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: nav-menu-trim
 * Domain Path: /languages
 *
 * @package      Nav_Menu_Trim
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( '__NAV_MENU_TRIM__', __FILE__ );

require_once plugin_dir_path( __FILE__ ) . 'inc/class-nav-menu-trim.php';

if ( class_exists( 'Nav_Menu_Trim' ) ) {
	new Nav_Menu_Trim();
};
