<?php
/**
 * Plugin Name: Screenly Cast
 * Plugin URI: https://www.screenly.io
 * Description: WordPress plugin to enable casting of content on Screenly devices
 * Version: 1.0.0
 * Author: Screenly, Inc
 * Author URI: https://www.screenly.io
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: screenly-cast
 * Domain Path: /languages
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

use ScreenlyCast\Exceptions\PluginInitializationException;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Initialize the plugin.
try {
	$screenly_plugin = new Plugin();
	$screenly_plugin->init();
} catch ( PluginInitializationException $e ) {
	// Add admin notice for initialization error.
	add_action(
		'admin_notices',
		function () use ( $e ) {
			printf(
				'<div class="notice notice-error"><p>%s</p></div>',
				esc_html( $e->getMessage() )
			);
		}
	);
}
