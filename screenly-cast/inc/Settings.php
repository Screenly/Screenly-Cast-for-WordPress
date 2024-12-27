<?php
/**
 * Plugin settings management class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

use ScreenlyCast\Contracts\Settings as SettingsInterface;

/**
 * Class Settings
 *
 * Manages plugin settings and admin menu integration.
 */
class Settings implements SettingsInterface {
	/**
	 * The WordPress paths manager.
	 *
	 * @var Contracts\Paths
	 */
	private Contracts\Paths $paths;

	/**
	 * The WordPress logger.
	 *
	 * @var Contracts\Logger
	 */
	private Contracts\Logger $logger;

	/**
	 * Constructor.
	 *
	 * @param Contracts\Paths  $paths  The WordPress paths manager.
	 * @param Contracts\Logger $logger The WordPress logger.
	 */
	public function __construct( Contracts\Paths $paths, Contracts\Logger $logger ) {
		$this->paths  = $paths;
		$this->logger = $logger;
	}

	/**
	 * Initialize settings.
	 */
	public function init(): void {
		// Register settings immediately.
		$this->register_settings();

		// Add settings menu item.
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );

		// Remove default theme menu items.
		add_action(
			'admin_menu',
			function (): void {
				remove_submenu_page( 'themes.php', 'themes.php' );
			}
		);
	}

	/**
	 * Add settings menu item.
	 */
	public function add_settings_page(): void {
		$page_title = esc_html__( 'Screenly Cast Settings', 'screenly-cast' );
		$menu_title = esc_html__( 'Screenly Cast', 'screenly-cast' );

		$hook = add_options_page(
			$page_title,
			$menu_title,
			'manage_options',
			'screenly-cast',
			array( $this, 'render_settings_page' )
		);

		// Add the submenu item using add_submenu_page instead of directly modifying globals.
		add_submenu_page(
			'options-general.php',
			$page_title,
			$menu_title,
			'manage_options',
			'screenly-cast'
		);
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings(): void {
		register_setting(
			'screenly_cast_settings',
			'screenly_cast_enabled',
			array(
				'type'              => 'boolean',
				'sanitize_callback' => 'rest_sanitize_boolean',
				'default'           => true,
				'show_in_rest'      => true,
			)
		);

		register_setting(
			'screenly_cast_settings',
			'screenly_cast_cache_duration',
			array(
				'type'              => 'integer',
				'sanitize_callback' => array( $this, 'sanitize_cache_duration' ),
				'default'           => 3600,
				'show_in_rest'      => true,
			)
		);

		// Set default values if not set.
		if ( false === get_option( 'screenly_cast_enabled' ) ) {
			update_option( 'screenly_cast_enabled', true );
		}
		if ( false === get_option( 'screenly_cast_cache_duration' ) ) {
			update_option( 'screenly_cast_cache_duration', 3600 );
		}
	}

	/**
	 * Sanitize cache duration value.
	 *
	 * @param mixed $value The value to sanitize.
	 * @return int The sanitized value.
	 */
	public function sanitize_cache_duration( $value ): int {
		if ( 0 === (int) $value || ! is_numeric( $value ) || 0 >= (int) $value ) {
			return 3600;
		}
		return (int) $value;
	}

	/**
	 * Render the settings page.
	 */
	public function render_settings_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check nonce.
		if ( isset( $_POST['_wpnonce'] ) && ! wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'screenly-cast-options' ) ) {
			wp_die( esc_html__( 'Invalid nonce.', 'screenly-cast' ) );
		}

		// Show success message if settings were updated.
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
				'screenly_cast_messages',
				'screenly_cast_message',
				esc_html__( 'Settings Saved', 'screenly-cast' ),
				'updated'
			);
		}

		// Show error messages.
		settings_errors( 'screenly_cast_messages' );

		echo '<div class="wrap">';
		echo '<h1>' . esc_html( get_admin_page_title() ) . '</h1>';
		echo '<form action="options.php" method="post">';
		settings_fields( 'screenly_cast_settings' );
		do_settings_sections( 'screenly-cast' );
		submit_button();
		echo '</form>';
		echo '</div>';
	}
}
