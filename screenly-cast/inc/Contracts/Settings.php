<?php
/**
 * Settings interface.
 *
 * @package ScreenlyCast\Contracts
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface Settings
 *
 * Defines the contract for plugin settings management.
 */
interface Settings {
    /**
     * Initialize settings.
     */
    public function init(): void;

    /**
     * Register plugin settings.
     */
    public function registerSettings(): void;

    /**
     * Add settings page to the admin menu.
     */
    public function addSettingsPage(): void;

    /**
     * Sanitize cache duration value.
     *
     * @param mixed $value The value to sanitize.
     * @return int The sanitized value.
     */
    public function sanitizeCacheDuration( $value ): int;

    /**
     * Render the settings page.
     */
    public function renderSettingsPage(): void;
}