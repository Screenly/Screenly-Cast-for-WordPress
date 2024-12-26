<?php
/**
 * WordPress paths management class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class WordPressPaths
 *
 * Manages WordPress-related file paths for the plugin.
 */
class WordPressPaths implements Contracts\Paths {
	/**
	 * The plugin root directory path.
	 *
	 * @var string
	 */
	private string $plugin_root;

	/**
	 * The plugin theme directory path.
	 *
	 * @var string
	 */
	private string $theme_root;

	/**
	 * The plugin theme directory URL.
	 *
	 * @var string
	 */
	private string $theme_url;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->plugin_root = dirname( __DIR__ );
		$this->theme_root  = dirname( __DIR__ ) . '/theme/screenly-cast';
		$this->theme_url   = plugins_url( 'theme/screenly-cast', $this->plugin_root );
	}

	/**
	 * Get the plugin root directory path.
	 *
	 * @return string The plugin root directory path.
	 */
	public function get_plugin_root(): string {
		return $this->plugin_root;
	}

	/**
	 * Get the plugin theme directory path.
	 *
	 * @return string The plugin theme directory path.
	 */
	public function get_theme_root(): string {
		return $this->theme_root;
	}

	/**
	 * Get the plugin theme directory URL.
	 *
	 * @return string The plugin theme directory URL.
	 */
	public function get_theme_url(): string {
		return $this->theme_url;
	}

	/**
	 * Get the plugin directory path.
	 *
	 * @return string The plugin directory path.
	 */
	public function getPluginDir(): string {
		return trailingslashit( $this->plugin_root );
	}

	/**
	 * Get the plugin directory URL.
	 *
	 * @return string The plugin directory URL.
	 */
	public function getPluginUrl(): string {
		return trailingslashit( plugins_url( '', $this->plugin_root ) );
	}

	/**
	 * Get the theme directory path.
	 *
	 * @return string The theme directory path.
	 */
	public function getThemeDir(): string {
		return trailingslashit( $this->theme_root );
	}

	/**
	 * Get the theme directory URL.
	 *
	 * @return string The theme directory URL.
	 */
	public function getThemeUrl(): string {
		return trailingslashit( $this->theme_url );
	}

	/**
	 * Get the assets directory path.
	 *
	 * @return string The assets directory path.
	 */
	public function getAssetsDir(): string {
		return trailingslashit( $this->plugin_root . '/assets' );
	}

	/**
	 * Get the assets directory URL.
	 *
	 * @return string The assets directory URL.
	 */
	public function getAssetsUrl(): string {
		return trailingslashit( plugins_url( 'assets', $this->plugin_root ) );
	}

	/**
	 * Get the theme path.
	 *
	 * @return string The theme path.
	 */
	public function getThemePath(): string {
		return $this->get_theme_root();
	}
}
