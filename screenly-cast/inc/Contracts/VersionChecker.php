<?php
/**
 * Version checker interface.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface for checking WordPress version compatibility.
 */
interface VersionChecker {
	/**
	 * Check if the current WordPress version meets the minimum requirement.
	 *
	 * @param string $min_version The minimum required version.
	 * @return bool True if the version requirement is met, false otherwise.
	 */
	public function check_wordpress_version( string $min_version ): bool;
}
