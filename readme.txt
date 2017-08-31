=== Nav Menu Trim ===
Contributors: thingsym
Link: https://github.com/thingsym/nav-menu-trim
Tags: nav, menu
Requires at least: 3.9
Tested up to: 4.8
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This WordPress plugin trim html id/class attributes of Nav Menu.

== Description ==

This WordPress plugin trim html id/class attributes of Nav Menu.

= Filter Hooks =

* `nav_menu_trim_get_options` - Filters the options

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [Travis CI](https://travis-ci.org/thingsym/nav-menu-trim)

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

== Screenshots ==

1. Appearance > Customize > Menus
2. Nav Menu Trim options

== Changelog ==

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
