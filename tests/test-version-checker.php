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

    public function testGetWordPressVersion(): void {
        global $wp_version;
        $this->assertEquals($wp_version, $this->checker->getWordPressVersion());
    }

    public function testGetRequiredWordPressVersion(): void {
        $this->assertEquals('6.3', $this->checker->getRequiredWordPressVersion());
    }

    public function testIsCompatibleWithCompatibleVersion(): void {
        global $wp_version;
        $wp_version = '6.3';
        $this->checker = new WordPressVersionChecker();
        $this->assertTrue($this->checker->isWordPressVersionCompatible());
    }

    public function testIsCompatibleWithIncompatibleVersion(): void {
        global $wp_version;
        $wp_version = '6.2';
        $this->checker = new WordPressVersionChecker();
        $this->assertFalse($this->checker->isWordPressVersionCompatible());
    }
}