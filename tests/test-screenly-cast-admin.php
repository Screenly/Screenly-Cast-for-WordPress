<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\WordPressVersionChecker;
use ScreenlyCast\Core;
use ScreenlyCast\WordPressLogger;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\WordPressThemeManager;
use Exception;

class ScreenlyCastAdminTest extends WP_UnitTestCase {
    use TestFilesystemTrait;

    private Core $core;
    private WordPressVersionChecker $versionChecker;
    private string $originalVersion;
    private WordPressPaths $paths;
    private WordPressLogger $logger;
    private WordPressThemeManager $theme_manager;
    private WordPressVersionChecker $version_checker;

    /**
     * Set up test environment.
     */
    protected function setUp(): void {
        parent::setUp();
        global $wp_version;
        $this->originalVersion = $wp_version;
        $this->paths = new WordPressPaths();
        $this->logger = new WordPressLogger();
        $this->theme_manager = new WordPressThemeManager( $this->paths );
        $this->version_checker = new WordPressVersionChecker();
        $this->core = new Core(
            $this->logger,
            $this->paths,
            $this->theme_manager,
            $this->version_checker
        );
    }

    protected function tearDown(): void {
        global $wp_version;
        $wp_version = $this->originalVersion;
        $this->cleanupTestTheme();
        parent::tearDown();
    }

    /**
     * Test WordPress version compatibility.
     */
    public function test_wp_version_compatibility(): void {
        global $wp_version;

        // Test with compatible version
        $wp_version = '6.3';
        $this->assertTrue( $this->version_checker->isWordPressVersionCompatible() );

        // Test with incompatible version
        $wp_version = '6.2';
        $this->assertFalse( $this->version_checker->isWordPressVersionCompatible() );
    }

    /**
     * Test admin initialization with incompatible version.
     */
    public function test_admin_init_with_incompatible_version(): void {
        global $wp_version;
        $wp_version = '6.2';

        ob_start();
        $this->core->adminInit();
        do_action( 'admin_notices' );
        $output = ob_get_clean();

        $this->assertStringContainsString( 'error', $output );
        $this->assertStringContainsString( 'Screenly Cast requires WordPress version 6.3 or higher', $output );
    }

    /**
     * Test debug logging.
     */
    public function test_debug_logging(): void {
        $temp_log = tempnam( sys_get_temp_dir(), 'wp_test_log' );
        $original_error_log = ini_get( 'error_log' );
        ini_set( 'error_log', $temp_log );

        try {
            $this->logger->debug( 'Test debug message' );
            $log_content = file_get_contents( $temp_log );

            $this->assertStringContainsString( '[Screenly Cast Debug]', $log_content );
            $this->assertStringContainsString( 'Test debug message', $log_content );
        } finally {
            ini_set( 'error_log', $original_error_log );
            unlink( $temp_log );
        }
    }
}