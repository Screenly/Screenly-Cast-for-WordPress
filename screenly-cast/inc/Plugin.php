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
	 * Constructor.
	 */
	public function __construct() {
		$this->paths           = new WordPressPaths();
		$this->theme_manager   = new WordPressThemeManager( $this->paths );
		$this->version_checker = new WordPressVersionChecker();
		$this->logger          = new WordPressLogger();
		$this->settings        = new Settings( $this->paths, $this->logger );
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
			$this->activate_theme();
			$this->settings->init();
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
	 * Check WordPress version requirements.
	 *
	 * @throws PluginInitializationException If requirements are not met.
	 */
	private function check_requirements(): void {
		if ( ! $this->version_checker->check_wordpress_version( '6.4.0' ) ) {
			throw new PluginInitializationException(
				esc_html__( 'WordPress version 6.4.0 or higher is required.', 'screenly-cast' )
			);
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
			$installer->install();
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
