<?php
/**
 * Plugin configuration class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class Configuration
 *
 * Manages plugin configuration settings.
 */
class Configuration {

	/**
	 * The WordPress paths manager.
	 *
	 * @var Paths
	 */
	private Paths $paths;

	/**
	 * The WordPress logger.
	 *
	 * @var Logger
	 */
	private Logger $logger;

	/**
	 * Constructor.
	 *
	 * @param Paths  $paths  The WordPress paths manager.
	 * @param Logger $logger The WordPress logger.
	 */
	public function __construct( Paths $paths, Logger $logger ) {
		$this->paths  = $paths;
		$this->logger = $logger;
	}

	/**
	 * Initialize configuration.
	 */
	public function init(): void {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Register plugin settings.
	 */
	private function register_settings(): void {
		register_setting(
			'screenly-cast',
			'screenly_cast_enabled',
			array(
				'type'              => 'boolean',
				'default'           => false,
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
	}

	/**
	 * Get a configuration value.
	 *
	 * @param string $key      The configuration key.
	 * @param mixed  $fallback The default value if the key doesn't exist.
	 * @return mixed The configuration value.
	 */
	public function get( string $key, $fallback = null ) {
		return get_option( 'screenly_cast_' . $key, $fallback );
	}

	/**
	 * Set a configuration value.
	 *
	 * @param string $key   The configuration key.
	 * @param mixed  $value The configuration value.
	 */
	public function set( string $key, $value ): void {
		update_option( 'screenly_cast_' . $key, $value );
	}
}
