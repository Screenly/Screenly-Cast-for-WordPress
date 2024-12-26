<?php
/**
 * Core functionality for the plugin.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Class Core
 *
 * Handles core plugin functionality.
 */
class Core {
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
	 * The theme manager instance.
	 *
	 * @var Contracts\ThemeManager
	 */
	private Contracts\ThemeManager $theme_manager;

	/**
	 * The version checker instance.
	 *
	 * @var Contracts\VersionChecker
	 */
	private Contracts\VersionChecker $version_checker;

	/**
	 * Core constructor.
	 *
	 * @param Contracts\Logger $logger The logger instance.
	 * @param Contracts\Paths $paths The paths instance.
	 * @param Contracts\ThemeManager $theme_manager The theme manager instance.
	 * @param Contracts\VersionChecker $version_checker The version checker instance.
	 */
	public function __construct(
		Contracts\Logger $logger,
		Contracts\Paths $paths,
		Contracts\ThemeManager $theme_manager,
		Contracts\VersionChecker $version_checker
	) {
		$this->logger = $logger;
		$this->paths = $paths;
		$this->theme_manager = $theme_manager;
		$this->version_checker = $version_checker;
	}

	/**
	 * Initialize the core functionality.
	 */
	public function init(): void {
		add_filter('query_vars', array($this, 'addQueryVars'));
		add_action('init', array($this, 'registerPostTypes'));
		add_action('init', array($this, 'registerTaxonomies'));
	}

	/**
	 * Add query vars.
	 *
	 * @param array $vars The query vars.
	 * @return array
	 */
	public function addQueryVars( array $vars ): array {
		$vars[] = 'srly';
		return $vars;
	}

	/**
	 * Register post types.
	 */
	public function registerPostTypes(): void {
		register_post_type(
			'screenly_cast',
			array(
				'labels'      => array(
					'name'          => esc_html__( 'Screenly Casts', 'screenly-cast' ),
					'singular_name' => esc_html__( 'Screenly Cast', 'screenly-cast' ),
				),
				'public'      => true,
				'has_archive' => true,
				'supports'    => array( 'title', 'editor', 'thumbnail' ),
				'menu_icon'   => 'dashicons-desktop',
			)
		);
	}

	/**
	 * Register taxonomies.
	 */
	public function registerTaxonomies(): void {
		register_taxonomy(
			'screenly_cast_category',
			'screenly_cast',
			array(
				'labels'            => array(
					'name'          => esc_html__( 'Cast Categories', 'screenly-cast' ),
					'singular_name' => esc_html__( 'Cast Category', 'screenly-cast' ),
				),
				'hierarchical'      => true,
				'show_admin_column' => true,
			)
		);
	}

	/**
	 * Activate the plugin.
	 */
	public function activate(): void {
		$theme_dir = $this->paths->get_theme_root();

		if ( ! is_dir( $theme_dir ) ) {
			$this->logger->error( 'Theme source directory does not exist.' );
			return;
		}

		$destination = get_theme_root() . '/screenly-cast';
		if ( ! wp_mkdir_p( $destination ) ) {
			$this->logger->error( 'Failed to create theme directory.' );
			return;
		}

		$this->copy_directory( $theme_dir, $destination );

		wp_clean_themes_cache();
		search_theme_directories( true );

		$theme = wp_get_theme( 'screenly-cast' );
		if ( ! $theme->exists() ) {
			$this->logger->error( 'Theme does not exist after installation.' );
			return;
		}

		switch_theme( 'screenly-cast' );
	}

	/**
	 * Copy a directory recursively.
	 *
	 * @param string $source      The source directory.
	 * @param string $destination The destination directory.
	 */
	private function copy_directory( string $source, string $destination ): void {
		$dir = opendir( $source );
		if ( ! $dir ) {
			$this->logger->error( 'Could not open source directory.' );
			return;
		}

		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( '.' === $file || '..' === $file ) {
				continue;
			}

			$src = $source . '/' . $file;
			$dst = $destination . '/' . $file;

			if ( is_dir( $src ) ) {
				if ( ! is_dir( $dst ) ) {
					wp_mkdir_p( $dst );
				}
				$this->copy_directory( $src, $dst );
			} else {
				copy( $src, $dst );
			}
		}

		closedir( $dir );
	}

	/**
	 * Deactivate the plugin.
	 */
	public function deactivate(): void {
		if ( get_stylesheet() === 'screenly-cast' ) {
			$default_theme = get_option( 'theme_switched' ) ?: 'twentytwentyfour';
			switch_theme( $default_theme );
		}

		delete_option( 'screenly_cast_enabled' );
		flush_rewrite_rules();
	}

	/**
	 * Initialize admin functionality.
	 */
	public function adminInit(): void {
		if ( ! $this->version_checker->isWordPressVersionCompatible() ) {
			add_action( 'admin_notices', array( $this, 'displayVersionError' ) );
		}
	}

	/**
	 * Get the logger instance.
	 *
	 * @return Contracts\Logger The logger instance.
	 */
	public function getLogger(): Contracts\Logger {
		return $this->logger;
	}

	/**
	 * Parse the query.
	 *
	 * @param \WP_Query $query The WordPress query object.
	 */
	public function parseQuery( \WP_Query $query ): void {
		if ( ! is_admin() && $query->is_main_query() ) {
			$srly = $query->get( 'srly' );
			if ( $srly ) {
				$query->set( 'post_type', 'screenly_cast' );
				$query->set( 'posts_per_page', 1 );
			}
		}
	}

	/**
	 * Display version error notice.
	 */
	public function displayVersionError(): void {
		$message = sprintf(
			/* translators: %s: Required WordPress version */
			esc_html__( 'Screenly Cast requires WordPress version %s or higher.', 'screenly-cast' ),
			$this->version_checker->getRequiredWordPressVersion()
		);
		echo '<div class="notice notice-error"><p>' . esc_html( $message ) . '</p></div>';
	}
}