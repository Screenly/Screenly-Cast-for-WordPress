<?php
/**
 * Paths interface.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface for managing WordPress paths.
 */
interface Paths {
	/**
	 * Get the plugin root directory path.
	 *
	 * @return string The plugin root directory path.
	 */
	public function get_plugin_root(): string;

	/**
	 * Get the plugin theme directory path.
	 *
	 * @return string The plugin theme directory path.
	 */
	public function get_theme_root(): string;

	/**
	 * Get the plugin theme directory URL.
	 *
	 * @return string The plugin theme directory URL.
	 */
	public function get_theme_url(): string;
}
