<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use PHPUnit\Framework\TestCase;
use ScreenlyCast\WordPressVersionChecker;

class TestVersionChecker extends TestCase {
    private WordPressVersionChecker $checker;
    private string $originalVersion;

    protected function setUp(): void {
        parent::setUp();
        global $wp_version;
        $this->originalVersion = $wp_version;
        $this->checker = new WordPressVersionChecker();
    }

    protected function tearDown(): void {
        global $wp_version;
        $wp_version = $this->originalVersion;
        parent::tearDown();
    }

    public function test_get_wordpress_version(): void {
        global $wp_version;
        $this->assertEquals($wp_version, $this->checker->get_wordpress_version());
    }

    public function test_get_required_wordpress_version(): void {
        $this->assertEquals('6.3', $this->checker->get_required_wordpress_version());
    }

    public function test_is_compatible_with_compatible_version(): void {
        global $wp_version;
        $wp_version = '6.3';
        $this->checker = new WordPressVersionChecker();
        $this->assertTrue($this->checker->is_wordpress_version_compatible());
    }

    public function test_is_compatible_with_incompatible_version(): void {
        global $wp_version;
        $wp_version = '6.2';
        $this->checker = new WordPressVersionChecker();
        $this->assertFalse($this->checker->is_wordpress_version_compatible());
    }
}