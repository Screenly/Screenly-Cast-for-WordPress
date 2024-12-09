<?php
/**
 * Class ScreenlyCastTest
 *
 * @package ScreenlyCast
 */

class ScreenlyCastTest extends WP_UnitTestCase {
    /**
     * Set up test environment
     */
    public function setUp() {
        parent::setUp();
        switch_theme('twentysixteen');
        // Initialize WordPress query vars
        global $wp;
        if (!isset($wp->public_query_vars)) {
            $wp->public_query_vars = array();
        }
    }

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
     * Test plugin hooks are properly added
     */
    public function test_plugin_hooks() {
        $this->assertNotFalse(has_action('admin_init', array('ScreenlyCast', 'adminInit')));
        $this->assertNotFalse(has_action('init', array('ScreenlyCast', 'init')));
        $this->assertNotFalse(has_action('parse_query', array('ScreenlyCast', 'parseQuery')));
    }

    /**
     * Test plugin activation functionality
     */
    public function test_activation() {
        // Call the activation hook directly
        do_action('activate_plugin', 'screenly-cast/screenly-cast.php');

        // Add assertions for any activation functionality
        // For now, we just verify it doesn't error
        $this->assertTrue(true);
    }

    /**
     * Test plugin deactivation functionality
     */
    public function test_deactivation() {
        // Call the deactivation hook directly
        do_action('deactivate_plugin', 'screenly-cast/screenly-cast.php');

        // Add assertions for any deactivation functionality
        // For now, we just verify it doesn't error
        $this->assertTrue(true);
    }

    /**
     * Test plugin initialization
     */
    public function test_init() {
        // Call init to set up the plugin
        ScreenlyCast::init();

        // Test query_vars filter is added
        $this->assertNotFalse(has_filter('query_vars', array('ScreenlyCast', 'add_query_vars')));

        // Test query var is actually added
        $vars = apply_filters('query_vars', array());
        $this->assertContains('srly', $vars, 'Query var srly should be registered');

        // Test post thumbnails support
        $this->assertTrue(current_theme_supports('post-thumbnails'), 'Post thumbnails should be supported');

        // Test theme directory registration
        $theme = wp_get_theme(ScreenlyCast::THEME_STYLESHEET);
        $this->assertTrue($theme->exists() || is_dir(SRLY_PLUGIN_DIR . 'theme'), 'Theme directory should exist');
    }

    /**
     * Test theme switching functionality
     */
    public function test_theme_switching() {
        // Store current theme
        $original_theme = get_stylesheet();

        // Create a test query with srly parameter
        $query = new WP_Query(array('srly' => '1'));
        ScreenlyCast::parseQuery($query);

        // Check if template_include filter is added
        $this->assertNotFalse(has_filter('template_include', array('ScreenlyCast', 'templateInclude')));

        // Check if theme was switched
        $this->assertEquals(ScreenlyCast::THEME_STYLESHEET, get_stylesheet());

        // Create a test query without srly parameter
        $query = new WP_Query();
        ScreenlyCast::parseQuery($query);

        // Check if template_include filter is removed
        $this->assertFalse(has_filter('template_include', array('ScreenlyCast', 'templateInclude')));

        // Check if theme was switched back
        $this->assertNotEquals(ScreenlyCast::THEME_STYLESHEET, get_stylesheet());

        // Restore original theme
        switch_theme($original_theme);
    }

    /**
     * Test template inclusion
     */
    public function test_template_include() {
        // Test regular template
        $template = ABSPATH . 'wp-content/themes/twentytwentyone/index.php';
        $this->assertEquals($template, ScreenlyCast::templateInclude($template));

        // Test with srly parameter
        global $wp_query;
        $wp_query->query['srly'] = '1';

        // Mock the functions.php include
        $expected_template = SRLY_THEME_DIR . '/index.php';
        $this->assertEquals($expected_template, ScreenlyCast::templateInclude($template));

        // Test attachment template
        $wp_query->is_attachment = true;
        $expected_template = SRLY_THEME_DIR . '/attachment.php';
        $this->assertEquals($expected_template, ScreenlyCast::templateInclude($template));

        // Clean up
        unset($wp_query->query['srly']);
        $wp_query->is_attachment = false;
    }

    /**
     * Test plugin activation and deactivation
     */
    public function test_plugin_lifecycle() {
        // Test activation
        $this->assertTrue(ScreenlyCast::pluginActivation());

        // Test deactivation
        $this->assertTrue(ScreenlyCast::pluginDeactivation());
    }

    /**
     * Test admin theme handling
     */
    public function test_admin_theme_handling() {
        // Store current theme
        $original_theme = get_stylesheet();

        // Set up admin environment
        if (!defined('WP_ADMIN')) {
            define('WP_ADMIN', true);
        }
        $GLOBALS['is_admin'] = true;

        // Switch to Screenly theme
        switch_theme(ScreenlyCast::THEME_STYLESHEET);
        $this->assertEquals(ScreenlyCast::THEME_STYLESHEET, get_stylesheet());

        // Test admin theme handling
        do_action('admin_init');
        ScreenlyCast::init();

        // Should have switched to a different theme
        $this->assertNotEquals(ScreenlyCast::THEME_STYLESHEET, get_stylesheet());
        $this->assertEquals('twentyfifteen', get_stylesheet());

        // Clean up
        switch_theme($original_theme);
    }

    /**
     * Test admin initialization
     */
    public function test_admin_init() {
        // Mock WP version to be compatible
        $GLOBALS['wp_version'] = SRLY_WP_VERSION;

        // Test with compatible WP version
        $result = ScreenlyCast::adminInit();
        $this->assertTrue($result !== false);
    }
}