<?php
declare(strict_types=1);

namespace ScreenlyCast\Tests;

use PHPUnit\Framework\TestCase;
use ScreenlyCast\WordPressPaths;

class TestPluginPaths extends TestCase {
    private WordPressPaths $paths;

    protected function setUp(): void {
        parent::setUp();
        $this->paths = new WordPressPaths();
    }

    public function testGetPluginDir(): void {
        $this->assertStringEndsWith('/', $this->paths->getPluginDir());
    }

    public function testGetPluginUrl(): void {
        $this->assertStringEndsWith('/', $this->paths->getPluginUrl());
    }

    public function testGetThemeDir(): void {
        $this->assertStringEndsWith('screenly-cast/', $this->paths->getThemeDir());
    }

    public function testGetThemeUrl(): void {
        $this->assertStringEndsWith('screenly-cast/', $this->paths->getThemeUrl());
    }

    public function testGetAssetsDir(): void {
        $this->assertStringEndsWith('assets/', $this->paths->getAssetsDir());
    }

    public function testGetAssetsUrl(): void {
        $this->assertStringEndsWith('assets/', $this->paths->getAssetsUrl());
    }
}