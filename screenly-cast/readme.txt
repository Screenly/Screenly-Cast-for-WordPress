=== Screenly Cast ===
Tags: digital signage, screenly
Requires at least: 6.4
Requires PHP: 7.4
License: GPLv2
Stable tag: 1.0.0

A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on [Screenly](https://www.screenly.io) digital signage devices.

The Screenly Cast plugin optimizes your website content for beautiful, easy to read display on TVs and other non-interactive devices.

To after installing and activated the plugin, simply append `?srly` to the end of page, posts and media URLs.

== Description ==

The goal with Screenly Cast for WordPress is to turn WordPress into a simple content creation tool for digital signage (and for [Screenly](https://www.screenly.io) in particular).

Contrary to some other WordPress plugins or themes out there, the goal is not to convert WordPress into a full-fledged digital signage CMS. Instead, the plugin is designed for simple content creation that can be used assets in your digital signage CMS.
Also, instead of trying to add support for zones, feeds and all kind of other features, we’ve focused on ensuring a good end-user viewing experience.

For more information, check out Screenly Cast for WordPress' home on [Github](https://github.com/Screenly/Screenly-Cast-for-WordPress/) and this [blog post](https://news.screenly.io/introducing-screenly-cast-for-wordpress-a27ff26667b7?source=collection_home---4------0-----------).

https://www.youtube.com/watch?v=rX6b9ZAYi34

== Installation ==

* Install and activate the plugin
* Navigate to a blog post or media attachment page and append "?srly" to the URL

== Frequently Asked Questions ==

= When should I use "?srly" and when should I use "&srly" in the URL? =

In most cases, you only need to use "?srly". However, if you already got an existing parameter or variable in your URL string, you need to use "&srly" to chain it. For instance, if you "https://www.mydomain.com/?somevar=1&anothervar=2", you need to add "&srly". In most cases, your URL will look like "https://www.mydomain.com/some-page", in which case you just need to add "?srly"

== Screenshots ==

1. An example post in WordPress page without Screenly Cast.
2. The same page with Screenly Cast enabled.



== Changelog ==

= 1.0.0 =
* Major: Complete rewrite of the plugin
* - Modern PHP 7.4+ features and type safety
* - Improved code organization and maintainability
* - Updated minimum WordPress version to 6.4
* - Better error handling and version compatibility checks
* - Added comprehensive test suite with unit and integration tests
* - Added theme installation and management functionality
* - Added proper WordPress coding standards compliance
* - Added proper query handling for Screenly Cast content

= 0.1.19 =
* Added PHPUnit test files for wordpress.