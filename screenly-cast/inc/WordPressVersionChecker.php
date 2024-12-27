<?php
/**
 * WordPress version checker class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

use ScreenlyCast\Contracts\VersionChecker;

/**
 * WordPress version checker class.
 *
 * Checks WordPress version compatibility.
 */
class WordPressVersionChecker implements VersionChecker {
	/**
	 * Get plugin data from header.
	 *
	 * @return array Plugin data.
	 */
	private function get_plugin_data(): array {
		if ( ! function_exists( 'get_file_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		return get_file_data(
			dirname( __DIR__ ) . '/screenly-cast.php',
			array(
				'requires' => 'Requires at least',
			)
		);
	}

	/**
	 * Check if the current WordPress version meets the minimum requirement.
	 *
	 * @param string $min_version The minimum required version.
	 * @return bool True if the version requirement is met, false otherwise.
	 */
	public function check_wordpress_version( string $min_version ): bool {
		global $wp_version;
		return version_compare( $wp_version, $min_version, '>=' );
	}

	/**
	 * Get the current WordPress version.
	 *
	 * @return string The current WordPress version.
	 */
	public function get_wordpress_version(): string {
		global $wp_version;
		return $wp_version;
	}

	/**
	 * Get the required WordPress version.
	 *
	 * @return string The required WordPress version.
	 */
	public function get_required_wordpress_version(): string {
		$plugin_data = $this->get_plugin_data();
		return $plugin_data['requires'];
	}

	/**
	 * Check if WordPress version is compatible.
	 *
	 * @return bool True if WordPress version is compatible, false otherwise.
	 */
	public function is_wordpress_version_compatible(): bool {
		return $this->check_wordpress_version( $this->get_required_wordpress_version() );
	}
}
