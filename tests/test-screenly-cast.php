<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\Core;
use ScreenlyCast\WordPressVersionChecker;
use ScreenlyCast\WordPressLogger;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\WordPressThemeManager;
use WP_Query;

/**
 * Mock query class for testing
 */
class MockQuery extends \WP_Query {
    public function is_main_query(): bool {
        return true;
    }

    public function is_admin(): bool {
        return false;
    }
}

class ScreenlyCastTest extends WP_UnitTestCase {
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
     * Test plugin hooks.
     */
    public function test_plugin_hooks(): void {
        $this->core->init();
        $this->assertGreaterThan(0, has_filter('parse_query', array($this->core, 'parse_query')));
    }

    /**
     * Test plugin activation.
     */
    public function test_activation(): void {
        $this->core->activate();
        $this->assertEquals( 'screenly-cast', get_stylesheet() );
    }

    /**
     * Test plugin initialization.
     */
    public function test_init(): void {
        $this->core->init();
        $this->assertGreaterThan(0, has_filter('query_vars', array($this->core, 'add_query_vars')));
        $this->assertGreaterThan(0, has_action('init', array($this->core, 'register_post_types')));
        $this->assertGreaterThan(0, has_action('init', array($this->core, 'register_taxonomies')));
    }

    /**
     * Test admin theme handling.
     */
    public function test_admin_theme_handling(): void {
        $this->core->activate();
        $this->assertEquals( 'screenly-cast', get_stylesheet() );
    }

    /**
     * Test parse query.
     */
    public function test_parse_query(): void {
        // Set up the test environment
        switch_theme('twentytwentyfour');

        // First activate the plugin to ensure theme is installed
        $this->core->activate();

        // Switch back to twentytwentyfour for the test
        switch_theme('twentytwentyfour');

        $query = new MockQuery();
        $query->set('srly', '1');
        $query->query_vars['srly'] = '1';  // Ensure query var is set in both places

        // Prevent redirects during testing
        add_filter('wp_redirect', function($location) {
            throw new \Exception('Redirect intercepted');
            return $location;
        });

        // Use output buffering to prevent any output
        ob_start();

        try {
            $this->core->parse_query($query);
        } catch (\Exception $e) {
            // Expected exception from redirect
        }

        ob_end_clean();

        // Verify the theme was switched
        $this->assertFalse($query->is_admin(), 'Query should not be admin');
        $this->assertTrue($query->is_main_query(), 'Should be main query');
        $this->assertEquals('screenly-cast', get_stylesheet(), 'Theme should be switched to screenly-cast');

        // Clean up
        remove_all_filters('wp_redirect');
        switch_theme('twentytwentyfour');
    }
}
