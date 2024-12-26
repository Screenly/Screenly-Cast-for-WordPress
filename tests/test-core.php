<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\Core;
use ScreenlyCast\Configuration;
use ScreenlyCast\WordPressThemeManager;
use ScreenlyCast\WordPressLogger;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\Settings;
use ScreenlyCast\WordPressVersionChecker;

class TestCore extends WP_UnitTestCase {
    private Core $core;
    private WordPressPaths $paths;
    private WordPressLogger $logger;
    private WordPressThemeManager $theme_manager;
    private WordPressVersionChecker $version_checker;

    /**
     * Set up test environment.
     */
    protected function setUp(): void {
        parent::setUp();
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

    /**
     * Test plugin activation.
     */
    public function testActivate(): void {
        $this->core->activate();
        $this->assertEquals( 'screenly-cast', get_stylesheet() );
    }

    /**
     * Test plugin deactivation.
     */
    public function testDeactivate(): void {
        $this->core->deactivate();
        $this->assertNotEquals( 'screenly-cast', get_stylesheet() );
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
     * Test query variables.
     */
    public function test_add_query_vars(): void {
        $vars = array();
        $result = $this->core->add_query_vars( $vars );
        $this->assertContains( 'srly', $result );
    }
}