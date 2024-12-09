<?php
/**
 * Class ScreenlyCastAdminTest
 *
 * @package ScreenlyCast
 */

class ScreenlyCastAdminTest extends WP_UnitTestCase {
    /**
     * Test WordPress version compatibility check
     */
    public function test_wp_version_compatibility() {
        global $wp_version;
        $original_version = $wp_version;

        // Test with compatible version
        $wp_version = '4.4.0'; // Same as SRLY_WP_VERSION
        $this->assertTrue(ScreenlyCast::checkWPVersion());

        // Test with lower version
        $wp_version = '4.3.0'; // Lower than SRLY_WP_VERSION
        $this->assertFalse(ScreenlyCast::checkWPVersion());

        // Restore original version
        $wp_version = $original_version;
    }

    /**
     * Test admin initialization with incompatible WP version
     */
    public function test_admin_init_with_incompatible_version() {
        global $wp_version;
        $original_version = $wp_version;
        $wp_version = '4.3.0';

        // Should return false and add notice actions
        $this->assertFalse(ScreenlyCast::adminInit());
        $this->assertNotFalse(has_action('admin_notices', array('ScreenlyCast', 'notifyWPVersion')));
        $this->assertNotFalse(has_action('network_admin_notices', array('ScreenlyCast', 'notifyWPVersion')));

        $wp_version = $original_version;
    }

    /**
     * Test version notification markup
     */
    public function test_version_notification_markup() {
        ob_start();
        ScreenlyCast::notifyWPVersion();
        $output = ob_get_clean();

        $this->assertRegExp('/notice notice-success/', $output);
        $this->assertRegExp('/notice notice-error/', $output);
        $this->assertRegExp('/deactivated/', $output);
        $this->assertRegExp('/requires WordPress/', $output);
    }

    /**
     * Test debug logging
     */
    public function test_debug_logging() {
        // Enable debug logging
        if (!defined('WP_DEBUG')) {
            define('WP_DEBUG', true);
        }
        if (!defined('WP_DEBUG_LOG')) {
            define('WP_DEBUG_LOG', true);
        }

        // Add filter to enable debug logging
        add_filter('screenly_cast_debug_log', '__return_true');

        // Use reflection to access private method
        $class = new ReflectionClass('ScreenlyCast');
        $method = $class->getMethod('_log');
        $method->setAccessible(true);

        // Test logging
        $this->assertTrue($method->invoke(null, 'Test log message'));

        // Clean up
        remove_filter('screenly_cast_debug_log', '__return_true');
    }
}