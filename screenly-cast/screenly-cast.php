<?php
/**
 * Plugin Name: Screenly Cast
 * Plugin URI: https://www.screenly.io
 * Description: A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on Screenly digital signage devices.
 * Version: 1.0.4
 * Requires at least: 6.2.4
 * Requires PHP: 7.4
 * Author: Screenly, Inc
 * Author URI: https://www.screenly.io
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: screenly-cast
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SRLY_VERSION', 'VERSION_PLACEHOLDER' );
define( 'SRLY_WP_VERSION', '4.4.0' );
define( 'SRLY_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'SRLY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SRLY_PLUGIN_NAME', plugin_basename( __FILE__ ) );
define( 'SRLY_INC_DIR', SRLY_PLUGIN_DIR . 'inc' );
define( 'SRLY_THEME', 'screenly-cast' );
define( 'SRLY_THEME_URI', SRLY_PLUGIN_URI . 'theme/screenly-cast' );
define( 'SRLY_THEME_DIR', SRLY_PLUGIN_DIR . 'theme/screenly-cast' );
define( 'SRLY_PREFIX', 'srly_' );

// Set up class autoloader.
spl_autoload_register(
	function ( $class_name ) {
		// Only handle our own namespace.
		if ( strpos( $class_name, 'ScreenlyCast\\' ) !== 0 ) {
			return;
		}

		// Convert namespace to file path.
		$class_path = str_replace( 'ScreenlyCast\\', '', $class_name );
		$class_path = str_replace( '\\', DIRECTORY_SEPARATOR, $class_path );
		$file       = __DIR__ . '/inc/' . $class_path . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
);

try {
	$screenly_plugin = new Plugin();
	$screenly_plugin->init();
} catch ( \Exception $e ) {
	add_action(
		'admin_notices', function () use ( $e ) {
			$class = 'notice notice-error';
			$message = $e->getMessage();
			printf(
				'<div class="%1$s"><p>%2$s</p></div>',
				esc_attr( $class ),
				esc_html( $message )
			);
		}
	);
}
