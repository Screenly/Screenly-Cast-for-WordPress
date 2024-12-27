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

    /**
     * Test theme installation.
     */
    public function test_install_theme(): void {
        $this->installer->install_theme();
        $this->assertTrue( is_dir( get_theme_root() . '/screenly-cast' ) );
    }

    /**
     * Test theme switching.
     */
    public function test_switch_to_theme(): void {
        $this->installer->switch_to_theme( 'screenly-cast' );
        $this->assertEquals( 'screenly-cast', get_stylesheet() );
    }

    /**
     * Test theme removal.
     */
    public function test_remove_theme(): void {
        $this->installer->remove_theme( 'screenly-cast' );
        $this->assertFalse( is_dir( get_theme_root() . '/screenly-cast' ) );
    }
}