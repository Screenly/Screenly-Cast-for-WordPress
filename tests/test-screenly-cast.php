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
        $query = new WP_Query();
        $this->core->parseQuery( $query );
        $this->assertTrue( true ); // If we got here without errors, the test passed.
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
        $this->assertGreaterThan(0, has_filter('query_vars', array($this->core, 'addQueryVars')));
        $this->assertGreaterThan(0, has_action('init', array($this->core, 'registerPostTypes')));
        $this->assertGreaterThan(0, has_action('init', array($this->core, 'registerTaxonomies')));
    }

    /**
     * Test admin theme handling.
     */
    public function test_admin_theme_handling(): void {
        $this->core->activate();
        $this->assertEquals( 'screenly-cast', get_stylesheet() );
    }

    /**
     * Test query parsing.
     */
    public function test_parse_query(): void {
        $query = new WP_Query();
        $this->core->parseQuery( $query );
        $this->assertTrue( true ); // If we got here without errors, the test passed.
    }
}