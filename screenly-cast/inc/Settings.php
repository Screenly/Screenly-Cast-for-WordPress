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
		// Register settings immediately
		$this->registerSettings();

		// Add settings menu item.
		add_action( 'admin_menu', array( $this, 'addSettingsPage' ) );

		// Remove default theme menu items.
		add_action(
			'admin_menu', function (): void {
				global $submenu;
				// Remove 'Themes' submenu item.
				if ( isset( $submenu['themes.php'] ) ) {
					foreach ( $submenu['themes.php'] as $key => $item ) {
						if ( 'themes.php' === $item[2] ) {
							unset( $submenu['themes.php'][ $key ] );
							break;
						}
					}
				}
			}
		);
	}

	/**
	 * Add settings menu item.
	 */
	private function add_settings_menu(): void {
		add_options_page(
			esc_html__( 'Screenly Cast Settings', 'screenly-cast' ),
			esc_html__( 'Screenly Cast', 'screenly-cast' ),
			'manage_options',
			'screenly-cast',
			array( $this, 'render_settings_page' )
		);
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
	 * Render settings page.
	 */
	private function render_settings_page(): void {
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

		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'screenly-cast' );
				do_settings_sections( 'screenly-cast' );
				submit_button( esc_html__( 'Save Changes', 'screenly-cast' ) );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Add settings page to the admin menu.
	 */
	public function addSettingsPage(): void {
		global $submenu;
		add_options_page(
			__( 'Screenly Cast Settings', 'screenly-cast' ),
			__( 'Screenly Cast', 'screenly-cast' ),
			'manage_options',
			'screenly-cast',
			array( $this, 'renderSettingsPage' )
		);
		$submenu['options-general.php'][] = array(
			__( 'Screenly Cast', 'screenly-cast' ),
			'manage_options',
			'screenly-cast',
		);
	}

	/**
	 * Register plugin settings.
	 */
	public function registerSettings(): void {
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
				'sanitize_callback' => array( $this, 'sanitizeCacheDuration' ),
				'default'           => 3600,
				'show_in_rest'      => true,
			)
		);

		// Set default values if not set
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
	public function sanitizeCacheDuration( $value ): int {
		if ( $value === 0 || $value === '0' || !is_numeric($value) || (int)$value <= 0 ) {
			return 3600;
		}
		return (int)$value;
	}

	/**
	 * Render the settings page.
	 */
	public function renderSettingsPage(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check nonce
		if ( isset( $_POST['_wpnonce'] ) && ! wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'screenly-cast-options' ) ) {
			wp_die( esc_html__( 'Invalid nonce.', 'screenly-cast' ) );
		}

		// Show success message if settings were updated
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
				'screenly_cast_messages',
				'screenly_cast_message',
				esc_html__( 'Settings Saved', 'screenly-cast' ),
				'updated'
			);
		}

		// Show error messages
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