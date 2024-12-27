<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\WordPressLogger;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\WordPressThemeManager;
use ScreenlyCast\ThemeInstaller;

class TestThemeManager extends WP_UnitTestCase {
    use TestFilesystemTrait;

    private WordPressThemeManager $manager;
    private WordPressPaths $paths;
    private WordPressLogger $logger;

    protected function setUp(): void {
        parent::setUp();
        $this->initializeTestFilesystem();

        $this->paths = new WordPressPaths();
        $this->logger = new WordPressLogger();
        $this->manager = new WordPressThemeManager($this->paths, $this->logger);

        // Ensure we start with a clean state
        $this->cleanupTestTheme();
    }

    protected function tearDown(): void {
        $this->cleanupTestTheme();
        parent::tearDown();
    }

    /**
     * Test theme directory registration.
     */
    public function testRegisterThemeDirectory() {
        $paths = new WordPressPaths();
        $theme_manager = new WordPressThemeManager( $paths );
        $theme_manager->registerThemeDirectory( $paths->getThemePath() );
        $this->assertTrue( true ); // If we got here without errors, the test passed.
    }

    /**
     * Test switching to Screenly theme.
     */
    public function test_switch_to_screenly_theme(): void {
        $installer = new ThemeInstaller($this->paths);
        $installer->install_theme();
        $this->manager->activate('screenly-cast');
        $this->assertEquals('screenly-cast', get_stylesheet());
    }
}