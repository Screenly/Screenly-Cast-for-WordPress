<?php
/**
 * Main plugin class.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

use ScreenlyCast\Exceptions\ThemeInstallationException;
use ScreenlyCast\Exceptions\PluginInitializationException;
use ScreenlyCast\Exceptions\ThemeActivationException;
use ScreenlyCast\Contracts\Logger;
use ScreenlyCast\Contracts\Paths;
use ScreenlyCast\Contracts\ThemeManager;
use ScreenlyCast\Contracts\VersionChecker;
use ScreenlyCast\Contracts\Settings as SettingsInterface;

/**
 * Main plugin class responsible for initialization and setup.
 */
class Plugin {
	/**
	 * The WordPress paths manager.
	 *
	 * @var Paths
	 */
	private Paths $paths;

	/**
	 * The WordPress theme manager.
	 *
	 * @var ThemeManager
	 */
	private ThemeManager $theme_manager;

	/**
	 * The WordPress version checker.
	 *
	 * @var VersionChecker
	 */
	private VersionChecker $version_checker;

	/**
	 * The WordPress logger.
	 *
	 * @var Logger
	 */
	private Logger $logger;

	/**
	 * The WordPress settings.
	 *
	 * @var SettingsInterface
	 */
	private SettingsInterface $settings;

	/**
	 * The core functionality instance.
	 *
	 * @var Core
	 */
	private Core $core;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->paths           = new WordPressPaths();
		$this->theme_manager   = new WordPressThemeManager( $this->paths );
		$this->version_checker = new WordPressVersionChecker();
		$this->logger          = new WordPressLogger();
		$this->settings        = new Settings( $this->paths, $this->logger );
		$this->core           = new Core(
			$this->logger,
			$this->paths,
			$this->theme_manager,
			$this->version_checker
		);
	}

	/**
	 * Initialize the plugin.
	 *
	 * @throws PluginInitializationException If initialization fails.
	 */
	public function init(): void {
		try {
			$this->check_requirements();
			$this->install_theme();
			$this->settings->init();
			$this->core->init();
			$this->core->admin_init();
			add_action( 'parse_query', array( $this->core, 'parse_query' ) );
		} catch ( ThemeInstallationException $e ) {
			$this->logger->error( esc_html( $e->getMessage() ) );
			throw new PluginInitializationException(
				esc_html__( 'Failed to install theme.', 'screenly-cast' )
			);
		} catch ( ThemeActivationException $e ) {
			$this->logger->error( esc_html( $e->getMessage() ) );
			throw new PluginInitializationException(
				esc_html__( 'Failed to activate theme.', 'screenly-cast' )
			);
		}
	}

	/**
	 * Get plugin data from header.
	 *
	 * @return array Plugin data.
	 */
	private function get_plugin_data(): array {
		if ( ! function_exists( 'get_file_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		return get_file_data(
			dirname( __DIR__ ) . '/screenly-cast.php',
			array(
				'requires_php' => 'Requires PHP',
			)
		);
	}

	/**
	 * Check WordPress version requirements.
	 *
	 * @throws PluginInitializationException If WordPress or PHP version requirements are not met.
	 */
	private function check_requirements(): void {
		if ( ! $this->version_checker->check_wordpress_version( $this->version_checker->get_required_wordpress_version() ) ) {
			$wp_version = esc_html( $this->version_checker->get_required_wordpress_version() );
			$message = sprintf(
				/* translators: %s: Required WordPress version number */
				esc_html__( 'Screenly Cast requires WordPress version %s or higher.', 'screenly-cast' ),
				$wp_version
			);
			throw new PluginInitializationException( esc_html( $message ) );
		}

		$plugin_data = $this->get_plugin_data();
		if ( version_compare( PHP_VERSION, $plugin_data['requires_php'], '<' ) ) {
			$php_version = esc_html( $plugin_data['requires_php'] );
			$message = sprintf(
				/* translators: %s: Required PHP version number */
				esc_html__( 'Screenly Cast requires PHP version %s or higher.', 'screenly-cast' ),
				$php_version
			);
			throw new PluginInitializationException( esc_html( $message ) );
		}
	}

	/**
	 * Install the theme.
	 *
	 * @throws ThemeInstallationException If theme installation fails.
	 */
	private function install_theme(): void {
		try {
			$installer = new ThemeInstaller( $this->paths );
			$installer->install_theme();
		} catch ( \Exception $e ) {
			throw new ThemeInstallationException(
				esc_html__( 'Failed to install theme files.', 'screenly-cast' )
			);
		}
	}

	/**
	 * Activate the theme.
	 *
	 * @throws ThemeActivationException If theme activation fails.
	 */
	private function activate_theme(): void {
		try {
			$this->theme_manager->activate( 'screenly-cast' );
		} catch ( \Exception $e ) {
			throw new ThemeActivationException(
				esc_html__( 'Failed to activate theme.', 'screenly-cast' )
			);
		}
	}
}
