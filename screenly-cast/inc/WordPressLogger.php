<?php
/**
 * WordPress logger class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class WordPressLogger
 *
 * Implements logging functionality using WordPress functions.
 */
class WordPressLogger implements \ScreenlyCast\Contracts\Logger {
	/**
	 * Log a debug message.
	 *
	 * @param string $message The message to log.
	 */
	public function debug( string $message ): void {
		error_log( '[Screenly Cast Debug] ' . $message );
	}

	/**
	 * Log an info message.
	 *
	 * @param string $message The message to log.
	 */
	public function info( string $message ): void {
		do_action( 'screenly_cast_log', 'info', $message );
	}

	/**
	 * Log a warning message.
	 *
	 * @param string $message The message to log.
	 */
	public function warning( string $message ): void {
		do_action( 'screenly_cast_log', 'warning', $message );
	}

	/**
	 * Log an error message.
	 *
	 * @param string $message The message to log.
	 */
	public function error( string $message ): void {
		error_log( '[Screenly Cast Error] ' . $message );
	}
}
