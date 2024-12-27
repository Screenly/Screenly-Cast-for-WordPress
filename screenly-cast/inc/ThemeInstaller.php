<?php
/**
 * Theme installer class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

use ScreenlyCast\Contracts\Paths;

/**
 * Class ThemeInstaller
 *
 * Handles theme installation and file management.
 */
class ThemeInstaller {
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
	 * Install the theme.
	 *
	 * @return bool True on success, false on failure.
	 * @throws \Exception If theme source directory does not exist or if directory copying fails.
	 */
	public function install_theme(): bool {
		try {
			$source      = $this->paths->get_theme_root();
			$destination = get_theme_root() . '/screenly-cast';

			if ( ! is_dir( $source ) ) {
				throw new \Exception( 'Theme source directory does not exist.' );
			}

			if ( ! is_dir( $destination ) ) {
				wp_mkdir_p( $destination );
			}

			$this->copy_directory( $source, $destination );
			wp_clean_themes_cache();
			search_theme_directories( true );
			register_theme_directory( get_theme_root() );
			return true;
		} catch ( \Exception $e ) {
			return false;
		}
	}

	/**
	 * Copy a directory recursively.
	 *
	 * @param string $source      The source directory.
	 * @param string $destination The destination directory.
	 *
	 * @throws \Exception If directory copying fails.
	 */
	private function copy_directory( string $source, string $destination ): void {
		$dir = opendir( $source );
		if ( ! $dir ) {
			throw new \Exception( 'Could not open source directory.' );
		}

		// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition -- This is the standard way to read directory contents
		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( '.' === $file || '..' === $file ) {
				continue;
			}

			$src = $source . '/' . $file;
			$dst = $destination . '/' . $file;

			if ( is_dir( $src ) ) {
				if ( ! is_dir( $dst ) ) {
					wp_mkdir_p( $dst );
				}
				$this->copy_directory( $src, $dst );
			} else {
				copy( $src, $dst );
			}
		}

		closedir( $dir );
	}

	/**
	 * Switch to a theme.
	 *
	 * @param string $theme_name The name of the theme to switch to.
	 * @return bool True on success, false on failure.
	 */
	public function switch_to_theme( string $theme_name ): bool {
		$theme = wp_get_theme( $theme_name );
		if ( ! $theme->exists() ) {
			$this->install_theme();
			$theme = wp_get_theme( $theme_name );
			if ( ! $theme->exists() ) {
				return false;
			}
		}

		switch_theme( $theme_name );
		wp_clean_themes_cache();
		return true;
	}

	/**
	 * Remove a theme.
	 *
	 * @param string $theme_name The name of the theme to remove.
	 * @return bool True on success, false on failure.
	 */
	public function remove_theme( string $theme_name ): bool {
		$theme_root = get_theme_root( $theme_name );
		if ( null === $theme_root || false === $theme_root ) {
			return false;
		}

		$theme_dir = $theme_root . '/' . $theme_name;
		if ( ! is_dir( $theme_dir ) ) {
			return false;
		}

		$this->cleanup_theme_directory( $theme_dir );
		return true;
	}

	/**
	 * Remove a directory recursively.
	 *
	 * @param string $dir The directory to remove.
	 * @return bool True on success, false on failure.
	 */
	private function remove_directory( string $dir ): bool {
		if ( ! is_dir( $dir ) ) {
			return false;
		}

		$files = scandir( $dir );
		foreach ( $files as $file ) {
			if ( '.' === $file || '..' === $file ) {
				continue;
			}

			$path = $dir . '/' . $file;
			if ( is_dir( $path ) ) {
				$this->remove_directory( $path );
			} else {
				wp_delete_file( $path );
			}
		}

		return wp_delete_file( $dir );
	}

	/**
	 * Clean up a theme directory by removing all files and the directory itself.
	 *
	 * @param string $dir The directory path to clean up.
	 */
	private function cleanup_theme_directory( string $dir ): void {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		global $wp_filesystem;
		WP_Filesystem();

		$files = glob( $dir . '/*' );
		foreach ( $files as $file ) {
			if ( is_file( $file ) ) {
				$wp_filesystem->delete( $file );
			}
		}
		if ( is_dir( $dir ) ) {
			$wp_filesystem->rmdir( $dir );
		}
	}
}
