<?php
/**
 * Class ScreenlyCastTest
 *
 * @package ScreenlyCast
 */

class ScreenlyCastTest extends WP_UnitTestCase {

    /**
     * Test that the plugin constants are defined correctly
     */
    public function test_plugin_constants() {
        $this->assertTrue(defined('SRLY_VERSION'));
        $this->assertTrue(defined('SRLY_WP_VERSION'));
        $this->assertTrue(defined('SRLY_PLUGIN_URI'));
        $this->assertTrue(defined('SRLY_PLUGIN_DIR'));
        $this->assertTrue(defined('SRLY_PLUGIN_NAME'));
        $this->assertTrue(defined('SRLY_INC_DIR'));
        $this->assertTrue(defined('SRLY_THEME'));
        $this->assertTrue(defined('SRLY_THEME_URI'));
        $this->assertTrue(defined('SRLY_THEME_DIR'));
        $this->assertTrue(defined('SRLY_PREFIX'));
    }

    /**
     * Test that the plugin hooks are added
     */
    public function test_plugin_hooks() {
        $this->assertNotFalse(has_action('admin_init', array('ScreenlyCast', 'adminInit')));
        $this->assertNotFalse(has_action('init', array('ScreenlyCast', 'init')));
        $this->assertNotFalse(has_action('parse_query', array('ScreenlyCast', 'parseQuery')));
    }

    /**
     * Test that the plugin activation hook is registered
     */
    public function test_activation_hook() {
        global $wp_filter;
        $plugin_file = basename(dirname(dirname(__FILE__))) . '/screenly-cast/screenly-cast.php';
        $this->assertNotEmpty($wp_filter['activate_' . $plugin_file]);
    }

    /**
     * Test that the plugin deactivation hook is registered
     */
    public function test_deactivation_hook() {
        global $wp_filter;
        $plugin_file = basename(dirname(dirname(__FILE__))) . '/screenly-cast/screenly-cast.php';
        $this->assertNotEmpty($wp_filter['deactivate_' . $plugin_file]);
    }
}