=== Screenly Cast ===
Contributors: vpetersson
Tags: digital signage, screenly
Requires at least: 6.2.4
Tested up to: 6.4.3
Stable tag: 1.0.5
Requires PHP: 7.4
License: GPLv2
License URI: https://github.com/Screenly/Screenly-Cast-for-WordPress/blob/master/LICENSE

A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on Screenly digital signage devices.

== Description ==

The goal with Screenly Cast for WordPress is to turn WordPress into a simple content creation tool for digital signage (and for [Screenly](https://www.screenly.io) in particular).

Contrary to some other WordPress plugins or themes, we don't aim to convert WordPress into a full-fledged digital signage CMS. Instead, the plugin is designed for simple content creation that can be used as assets in your digital signage CMS.
Rather than adding support for zones, feeds, and other complex features, we've focused on ensuring a great end-user viewing experience.

The Screenly Cast plugin optimizes your website content for beautiful, easy-to-read display on TVs and other non-interactive devices.

After installing and activating the plugin, simply append `?srly` to the end of your page, post, or media URLs to view them in digital signage format.

The source code for this plugin is available on [GitHub](https://github.com/Screenly/Screenly-Cast-for-WordPress/). We welcome contributions and feedback from the community.

== Installation ==

1. Install and activate the plugin through the WordPress plugin directory
2. Navigate to any page, post, or media attachment
3. Append "?srly" to the URL to view it in digital signage format

== Frequently Asked Questions ==

= When should I use "?srly" and when should I use "&srly" in the URL? =

Use "?srly" when there are no other URL parameters. For example:
* `https://www.mydomain.com/some-page?srly`

Use "&srly" when the URL already contains other parameters. For example:
* `https://www.mydomain.com/?somevar=1&anothervar=2&srly`

== Support ==

For support, feature requests, and bug reports, please visit our [GitHub Issues page](https://github.com/Screenly/Screenly-Cast-for-WordPress/issues).

== Screenshots ==

1. An example post in WordPress page without Screenly Cast.
2. The same page with Screenly Cast enabled.

== Changelog ==

= 1.0.5 =
* Fix: Make failing unit tests pass
* Fix: Update handling of the `?srly` query parameter
* Fix: Screenly Cast theme not being applied when using the `srly` query parameter

= 1.0.4 =
* Fix: Move build artifacts to separate dist/ directory
* Fix: Improve build script to create correct WordPress plugin structure
* Fix: Update documentation for build process and plugin installation

= 1.0.3 =
* Fix: Correct directory structure for WordPress.org SVN deployment
* Fix: Ensure proper handling of plugin assets
* Fix: Streamline build process for cleaner releases

= 1.0.2 =
* Fix: Remove all development files and directories from release package
* Fix: Improve .distignore patterns to match actual directory structure
* Fix: Clean up root directory files from WordPress.org deployment

= 1.0.1 =
* Fix: Remove development files from release package
* Fix: Clean up files included in WordPress.org deployment

= 1.0.0 =
* Major: Complete rewrite of the plugin
* Modern PHP 7.4+ features and type safety
* Improved code organization and maintainability
* Updated minimum WordPress version to 6.2.4
* Better error handling and version compatibility checks
* Added comprehensive test suite with unit and integration tests
* Added theme installation and management functionality
* Added proper WordPress coding standards compliance
* Added proper query handling for Screenly Cast content

= 0.1.19 =
* Added PHPUnit test files for WordPress
