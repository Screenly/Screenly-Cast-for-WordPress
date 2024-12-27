<?php
/**
 * Logger interface.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast\Contracts;

/**
 * Interface for logging functionality.
 */
interface Logger {
	/**
	 * Log a debug message.
	 *
	 * @param string $message The message to log.
	 */
	public function debug( string $message ): void;

	/**
	 * Log an info message.
	 *
	 * @param string $message The message to log.
	 */
	public function info( string $message ): void;

	/**
	 * Log a warning message.
	 *
	 * @param string $message The message to log.
	 */
	public function warning( string $message ): void;

	/**
	 * Log an error message.
	 *
	 * @param string $message The message to log.
	 */
	public function error( string $message ): void;
}
