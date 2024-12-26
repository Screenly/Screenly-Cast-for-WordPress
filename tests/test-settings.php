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
    public function testAddSettingsPage(): void {
        global $submenu;
        $submenu = array(); // Initialize the array
        $this->settings->addSettingsPage();
        $this->assertArrayHasKey( 'options-general.php', $submenu );
    }

    /**
     * Test sanitizing cache duration.
     */
    public function testSanitizeCacheDuration(): void {
        $this->assertEquals( 3600, $this->settings->sanitizeCacheDuration( 0 ) );
        $this->assertEquals( 3600, $this->settings->sanitizeCacheDuration( -1 ) );
        $this->assertEquals( 3600, $this->settings->sanitizeCacheDuration( 'invalid' ) );
        $this->assertEquals( 7200, $this->settings->sanitizeCacheDuration( 7200 ) );
    }

    /**
     * Test registering settings.
     */
    public function testRegisterSettings(): void {
        $this->settings->registerSettings();
        $registered_settings = get_registered_settings();
        $this->assertArrayHasKey( 'screenly_cast_cache_duration', $registered_settings );
    }
}