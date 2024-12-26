<?php
/**
 * WordPress version checker class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class WordPressVersionChecker
 *
 * Checks WordPress version compatibility.
 */
class WordPressVersionChecker implements Contracts\VersionChecker {
	/**
	 * The minimum required WordPress version.
	 */
	private const REQUIRED_VERSION = '6.3';

	/**
	 * Check if the current WordPress version meets the minimum requirement.
	 *
	 * @param string $min_version The minimum required version.
	 * @return bool True if the version requirement is met, false otherwise.
	 */
	public function check_wordpress_version( string $min_version ): bool {
		global $wp_version;
		return version_compare( $wp_version, $min_version, '>=' );
	}

	/**
	 * Get the current WordPress version.
	 *
	 * @return string The current WordPress version.
	 */
	public function getWordPressVersion(): string {
		global $wp_version;
		return $wp_version;
	}

	/**
	 * Get the required WordPress version.
	 *
	 * @return string The required WordPress version.
	 */
	public function getRequiredWordPressVersion(): string {
		return self::REQUIRED_VERSION;
	}

	/**
	 * Check if WordPress version is compatible.
	 *
	 * @return bool True if compatible, false otherwise.
	 */
	public function isWordPressVersionCompatible(): bool {
		return $this->check_wordpress_version( self::REQUIRED_VERSION );
	}
}
