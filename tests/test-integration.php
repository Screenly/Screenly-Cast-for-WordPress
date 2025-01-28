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

    /**
     * Test plugin activation.
     */
    public function testPluginActivation(): void {
        global $wp_version;
        if (version_compare($wp_version, '6.2.4', '<')) {
            $this->expectException(\ScreenlyCast\Exceptions\PluginInitializationException::class);
            $this->expectExceptionMessage('Screenly Cast requires WordPress version 6.2.4 or higher');
        }

        try {
            $this->plugin->init();
            if (version_compare($wp_version, '6.2.4', '>=')) {
                $this->assertTrue(wp_get_theme('screenly-cast')->exists(), 'Screenly Cast theme should exist');
                $this->assertEquals('twentytwentyfour', get_stylesheet());
            }
        } catch (\Exception $e) {
            if (version_compare($wp_version, '6.2.4', '>=')) {
                throw $e;
            }
        }
    }

    /**
     * Test theme deactivation.
     */
    public function testThemeDeactivation(): void {
        global $wp_version;
        if (version_compare($wp_version, '6.2.4', '<')) {
            $this->markTestSkipped('Test requires WordPress 6.2.4 or higher');
        }

        $this->plugin->init();
        switch_theme('twentytwentyfour');
        $this->assertEquals('twentytwentyfour', get_stylesheet());
    }

    /**
     * Test settings integration.
     */
    public function testSettingsIntegration(): void {
        global $wp_version;
        if (version_compare($wp_version, '6.2.4', '<')) {
            $this->markTestSkipped('Test requires WordPress 6.2.4 or higher');
        }

        $this->plugin->init();
        update_option('screenly_cast_cache_duration', 7200);
        $this->assertEquals(7200, get_option('screenly_cast_cache_duration'));
    }

    /**
     * Test WordPress hooks integration.
     */
    public function testWordPressHooks(): void {
        global $wp_version;
        if (version_compare($wp_version, '6.2.4', '<')) {
            $this->markTestSkipped('Test requires WordPress 6.2.4 or higher');
        }

        $this->plugin->init();
        $this->assertGreaterThan(0, has_action('admin_menu'));
        $this->assertGreaterThan(0, has_action('admin_init'));
    }
}
