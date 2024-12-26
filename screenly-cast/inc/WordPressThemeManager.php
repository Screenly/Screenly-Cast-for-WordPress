<?php
/**
 * WordPress theme manager class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class WordPressThemeManager
 *
 * Manages WordPress theme activation and deactivation.
 */
class WordPressThemeManager implements Contracts\ThemeManager {
	/**
	 * The WordPress paths manager.
	 *
	 * @var Contracts\Paths
	 */
	private Contracts\Paths $paths;

	/**
	 * Constructor.
	 *
	 * @param Contracts\Paths $paths The WordPress paths manager.
	 */
	public function __construct( Contracts\Paths $paths ) {
		$this->paths = $paths;
	}

	/**
	 * Register a theme directory.
	 *
	 * @param string $directory The directory to register.
	 * @return bool True on success, false on failure.
	 */
	public function registerThemeDirectory( string $directory ): bool {
		if ( ! is_dir( $directory ) ) {
			return false;
		}

		$result = register_theme_directory( $directory );
		if ( $result ) {
			wp_clean_themes_cache();
			search_theme_directories( true );
		}

		return $result;
	}

	/**
	 * Activate a theme.
	 *
	 * @param string $theme_name The name of the theme to activate.
	 */
	public function activate( string $theme_name ): void {
		$theme = wp_get_theme( $theme_name );
		if ( ! $theme->exists() ) {
			return;
		}

		switch_theme( $theme_name );
		wp_clean_themes_cache();
	}

	/**
	 * Switch to the Screenly theme.
	 *
	 * @return bool True on success, false on failure.
	 */
	public function switchToScreenlyTheme(): bool {
		$theme = wp_get_theme( 'screenly-cast' );
		if ( ! $theme->exists() ) {
			try {
				$installer = new ThemeInstaller( $this->paths );
				$installer->install_theme();
				wp_clean_themes_cache();
				search_theme_directories( true );
				$theme = wp_get_theme( 'screenly-cast' );
				if ( ! $theme->exists() ) {
					return false;
				}
			} catch ( \Exception $e ) {
				return false;
			}
		}

		switch_theme( 'screenly-cast' );
		wp_clean_themes_cache();
		return true;
	}
}
