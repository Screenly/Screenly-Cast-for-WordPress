<?php
/**
 * Theme manager interface.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface for managing WordPress themes.
 */
interface ThemeManager {
	/**
	 * Activate a theme.
	 *
	 * @param string $theme_name The name of the theme to activate.
	 */
	public function activate( string $theme_name ): void;
}
