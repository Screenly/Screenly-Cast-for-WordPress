<?php
/**
 * Settings interface.
 *
 * @package ScreenlyCast\Contracts
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface Settings
 *
 * Defines the contract for plugin settings management.
 */
interface Settings {
	/**
	 * Initialize settings.
	 */
	public function init(): void;

	/**
	 * Register plugin settings.
	 */
	public function register_settings(): void;

	/**
	 * Add settings page to the admin menu.
	 */
	public function add_settings_page(): void;

	/**
	 * Sanitize cache duration value.
	 *
	 * @param mixed $value The value to sanitize.
	 * @return int The sanitized value.
	 */
	public function sanitize_cache_duration( $value ): int;

	/**
	 * Render the settings page.
	 */
	public function render_settings_page(): void;
}
