<?php
/**
 * Make sure we don't expose any info if called directly.
 *
 * @category ScreenlyCast
 * @package  ScreenlyCast
 * @author   Original Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    VERSION_PLACEHOLDER
 */
/**
Plugin Name: Screenly Cast for WordPress
Plugin URI: https://github.com/wireload/screenly-wp-cast
Description: WordPress plugin to enable casting of content on Screenly devices.
Version: 0.0.1
Author: Screenly Inc
Author URI: https://www.screenly.io/
License:
Text Domain: screenly-cast
*/
if (!function_exists('add_action')) {
    echo 'Nothing to see here.';
    exit;
}

/**
 * Define constants to make info about plugin available
 */
define('SRLY_VERSION', '0.0.1');
define('SRLY_WP_VERSION', '3.7');
define('SRLY_PLUGIN_URI', plugin_dir_url(__FILE__));
define('SRLY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SRLY_INC_DIR', SRLY_PLUGIN_DIR . 'inc');
define('SRLY_THEME', 'screenly-wp-cast');
define('SRLY_THEME_URI', SRLY_PLUGIN_URI . 'theme/screenly-wp-cast');
define('SRLY_THEME_DIR', SRLY_PLUGIN_DIR . 'theme/screenly-wp-cast');
define('SRLY_PREFIX', 'srly_');


/**
 * Ready, Steady, Go!
 */
require_once SRLY_INC_DIR.'/screenly-cast.php';

/**
 * Let's deal with the install and uninstall process correctly
 */
register_activation_hook(__FILE__, array('ScreenlyCast', 'pluginActivation'));
register_deactivation_hook(__FILE__, array('ScreenlyCast', 'pluginDeactivation'));

/**
 * Init
 */
add_action('init', array('ScreenlyCast', 'init'), 0);

/**
 * Add action immediately after the query is parsed so that we can catch
 * our var.
 */
add_action('parse_query', array('ScreenlyCast', 'parseQuery'), 0);
