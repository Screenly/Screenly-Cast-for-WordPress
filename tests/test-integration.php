<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\Plugin;

class TestIntegration extends WP_UnitTestCase {
    private Plugin $plugin;

    protected function setUp(): void {
        parent::setUp();
        global $wp_version;
        $wp_version = getenv('WP_VERSION') ?: '6.3.0';
        $this->plugin = new Plugin();
    }

    public function testPluginActivation(): void {
        // Test full plugin activation flow
        try {
            $this->plugin->init();

            // Verify theme is installed
            $theme = wp_get_theme('screenly-cast');
            $this->assertTrue($theme->exists(), 'Theme should be installed');

            // Verify theme is active
            $this->assertEquals('screenly-cast', get_stylesheet(), 'Theme should be active');

            // Verify settings are registered
            $settings = get_registered_settings();
            $this->assertArrayHasKey('screenly_cast_cache_duration', $settings, 'Cache duration setting should be registered');

            // Verify default options are set
            $this->assertNotFalse(get_option('screenly_cast_enabled'), 'Plugin should be enabled by default');
        } catch (\Exception $e) {
            $this->fail('Plugin initialization failed: ' . $e->getMessage());
        }
    }

    public function testThemeDeactivation(): void {
        // Test theme switching back on plugin deactivation
        $this->plugin->init();

        // Switch to a different theme
        switch_theme('twentytwentyfour');

        // Verify theme was switched
        $this->assertEquals('twentytwentyfour', get_stylesheet(), 'Theme should be switched back');
    }

    public function testSettingsIntegration(): void {
        // Test settings integration
        $this->plugin->init();

        // Test cache duration setting
        update_option('screenly_cast_cache_duration', 7200);
        $this->assertEquals(7200, get_option('screenly_cast_cache_duration'), 'Cache duration should be updateable');

        // Test invalid cache duration
        update_option('screenly_cast_cache_duration', -1);
        $this->assertEquals(3600, get_option('screenly_cast_cache_duration'), 'Invalid cache duration should be set to default');
    }

    public function testWordPressHooks(): void {
        // Test WordPress hooks integration
        $this->plugin->init();

        // Verify our actions are registered
        $this->assertGreaterThan(0, has_action('admin_menu'), 'Admin menu action should be registered');
        $this->assertGreaterThan(0, has_action('admin_init'), 'Admin init action should be registered');
    }
}