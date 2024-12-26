<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use WP_UnitTestCase;
use ScreenlyCast\WordPressLogger;
use ScreenlyCast\WordPressPaths;
use ScreenlyCast\ThemeInstaller;
use ScreenlyCast\WordPressThemeManager;

class TestThemeInstaller extends WP_UnitTestCase {
    use TestFilesystemTrait;

    private ThemeInstaller $installer;
    private WordPressPaths $paths;
    private WordPressLogger $logger;

    protected function setUp(): void {
        parent::setUp();
        $this->initializeTestFilesystem();

        $this->paths = new WordPressPaths();
        $this->logger = new WordPressLogger();
        $this->installer = new ThemeInstaller($this->paths, $this->logger);

        // Ensure we start with a clean state
        $this->cleanupTestTheme();
    }

    protected function tearDown(): void {
        $this->cleanupTestTheme();
        parent::tearDown();
    }

    public function testThemeInstallation(): void {
        $this->installer->installTheme();
        $theme = wp_get_theme('screenly-cast');
        $this->assertTrue($theme->exists());
    }

    /**
     * Test theme switching.
     */
    public function testThemeSwitch(): void {
        $paths = new WordPressPaths();
        $theme_manager = new WordPressThemeManager($paths);
        $installer = new ThemeInstaller($paths, $theme_manager);
        $installer->switchToTheme('screenly-cast');
        $this->assertEquals('screenly-cast', get_stylesheet());
    }

    /**
     * Test theme removal.
     */
    public function testThemeRemoval(): void {
        $paths = new WordPressPaths();
        $theme_manager = new WordPressThemeManager($paths);
        $installer = new ThemeInstaller($paths, $theme_manager);
        $installer->removeTheme('screenly-cast');
        $this->assertFalse(wp_get_theme('screenly-cast')->exists());
    }
}