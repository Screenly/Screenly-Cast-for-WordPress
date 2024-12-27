<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\Settings;
use ScreenlyCast\Configuration;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\WordPressLogger;

class TestSettings extends WP_UnitTestCase {
    private Settings $settings;

    protected function setUp(): void {
        parent::setUp();
        $paths = new WordPressPaths();
        $logger = new WordPressLogger();
        $this->settings = new Settings($paths, $logger);

        // Ensure admin functions are loaded
        if (!function_exists('add_options_page')) {
            require_once ABSPATH . 'wp-admin/includes/admin.php';
        }

        // Set up admin environment
        if (!defined('WP_ADMIN')) {
            define('WP_ADMIN', true);
        }
    }

    /**
     * Test adding settings page.
     */
    public function test_add_settings_page(): void {
        $this->settings->add_settings_page();
        $this->assertTrue( has_action( 'admin_menu' ) );
    }

    /**
     * Test sanitizing cache duration.
     */
    public function test_sanitize_cache_duration(): void {
        $this->assertEquals( 3600, $this->settings->sanitize_cache_duration( 0 ) );
        $this->assertEquals( 3600, $this->settings->sanitize_cache_duration( -1 ) );
        $this->assertEquals( 3600, $this->settings->sanitize_cache_duration( 'invalid' ) );
        $this->assertEquals( 7200, $this->settings->sanitize_cache_duration( 7200 ) );
    }

    /**
     * Test registering settings.
     */
    public function test_register_settings(): void {
        $this->settings->register_settings();
        $this->assertTrue( get_option( 'screenly_cast_enabled' ) );
        $this->assertEquals( 3600, get_option( 'screenly_cast_cache_duration' ) );
    }
}