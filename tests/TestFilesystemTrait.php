<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_Filesystem_Direct;

trait TestFilesystemTrait {
    protected function initializeTestFilesystem(): void {
        global $wp_filesystem;

        if (!function_exists('WP_Filesystem')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        // Force direct filesystem access for tests
        add_filter('filesystem_method', function() {
            return 'direct';
        });

        WP_Filesystem();

        // Ensure we have a filesystem instance
        if (!$wp_filesystem instanceof WP_Filesystem_Direct) {
            $wp_filesystem = new WP_Filesystem_Direct(null);
        }

        // Ensure theme root directory exists and is writable
        $theme_root = get_theme_root();
        if (!$wp_filesystem->exists($theme_root)) {
            $wp_filesystem->mkdir($theme_root);
        }
        $wp_filesystem->chmod($theme_root, FS_CHMOD_DIR);

        // Clean up any existing theme directory
        $this->cleanupTestTheme();
    }

    /**
     * Clean up test theme.
     */
    protected function cleanupTestTheme(): void {
        $theme_dir = get_theme_root() . '/screenly-cast';
        if ( is_dir( $theme_dir ) ) {
            $this->removeDirectory( $theme_dir );
        }
    }

    /**
     * Remove a directory recursively.
     *
     * @param string $dir The directory to remove.
     */
    private function removeDirectory( string $dir ): void {
        if ( ! is_dir( $dir ) ) {
            return;
        }

        $files = scandir( $dir );
        foreach ( $files as $file ) {
            if ( $file === '.' || $file === '..' ) {
                continue;
            }

            $path = $dir . '/' . $file;
            if ( is_dir( $path ) ) {
                $this->removeDirectory( $path );
            } else {
                unlink( $path );
            }
        }

        rmdir( $dir );
    }
}