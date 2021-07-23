=== Nav Menu Trim ===
Contributors: thingsym
Link: https://github.com/thingsym/nav-menu-trim
Donate link: https://github.com/sponsors/thingsym
Tags: nav, menu
Stable tag: 1.2.0
Tested up to: 5.8.0
Requires at least: 3.8
Requires PHP: 5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This WordPress plugin trim html id/class attributes of Nav Menu.

== Description ==

This WordPress plugin trim html id/class attributes of Nav Menu.

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [Github Actions](https://github.com/thingsym/nav-menu-trim/actions).

= Contributing =

= Patches and Bug Fixes =

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

* [nav-menu-trim - GitHub](https://github.com/thingsym/nav-menu-trim)
* [Nav Menu Trim - WordPress Plugin](https://wordpress.org/plugins/nav-menu-trim/)

== Installation ==

1. Download and unzip files. Or install **Nav Menu Trim** using the WordPress plugin installer. In that case, skip 2.
2. Upload **nav-menu-trim** to the "/wp-content/plugins/" directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Configure settings through the **Appearance > Customize > Menus > Nav Menu Trim** menu in WordPress.
5. Have fun!

= Filter hooks =

* nav_menu_trim_get_options
* nav_menu_trim_get_option

== Screenshots ==

1. Appearance > Customize > Menus
2. Nav Menu Trim options

== Changelog ==

= 1.2.0 =
* tested up to 5.7.0
* add composer scripts
* update japanese translation
* update pot
* add test case
* change constant name
* add sponsor link
* add FUNDING.yml
* add donate link
* update wordpress-test-matrix
* add GitHub actions for CI/CD, remove .travis.yml

= 1.1.2 =
* rename sanitize_callback function from sanitize_checkbox to sanitize_boolean
* fix indent and reformat with phpcs and phpcbf
* add composer.json for test
* add static code analysis config

= 1.1.1 =
* fix access modifier
* fix tests
* fix PHPDoc comment
* fix filter nav_menu_trim_get_options and nav_menu_trim_get_option
* change to add_action with load_textdomain
* add sanitize_checkbox

= 1.1.0 =
* update screenshot
* fix PHPDoc comment
* remove $languages_path
* fix .travis.yml
* fix tests
* add nav_menu_submenu_css_class function
* fix get_options function
* add default_options
* fix load_textdomain

= 1.0.2 =
* fix tests
* fix data validation via wp_kses
* change output css to here document
* fix option detect
* change add_filter from plugin_action_links to plugin_action_links_{$plugin_file}
* add init function
* fix codesniffer.ruleset.xml

= 1.0.1 =
* fixed: fix .travis.yml
* fixed: fix trim_css_class function
* fixed: check exists class

= 1.0.0 =
* initial release

== Upgrade Notice ==

= 1.1.1 =
* Requires at least version 3.8 of the WordPress
