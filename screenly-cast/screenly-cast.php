<?php
/**
Plugin Name: Screenly Cast for WordPress
Plugin URI: https://github.com/Screenly/Screenly-Cast-for-WordPress
Description: WordPress plugin to enable casting of content on Screenly devices.
Version: VERSION_PLACEHOLDER
Author: Screenly, Inc
Author URI: https://www.screenly.io/
License: GPLv2
Text Domain: screenly-cast
*/
/**
 * Make sure we don't expose any info if called directly.
 *
 * @category ScreenlyCast
 * @package  ScreenlyCast
 * @author   Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 */
if (!function_exists('add_action')) {
    echo "No script kiddies please!";
    exit;
}

/**
 * Define constants to make info about plugin available
 */
define('SRLY_VERSION', 'VERSION_PLACEHOLDER');
define('SRLY_WP_VERSION', '4.4.0');
define('SRLY_PLUGIN_URI', plugin_dir_url(__FILE__));
define('SRLY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SRLY_PLUGIN_NAME', plugin_basename(__FILE__));
define('SRLY_INC_DIR', SRLY_PLUGIN_DIR . 'inc');
define('SRLY_THEME', 'screenly-cast');
define('SRLY_THEME_URI', SRLY_PLUGIN_URI . 'theme/screenly-cast');
define('SRLY_THEME_DIR', SRLY_PLUGIN_DIR . 'theme/screenly-cast');
define('SRLY_PREFIX', 'srly_');


/**
 * Ready, Steady, Go!
 */
require_once SRLY_INC_DIR.'/screenly-cast.php';
require_once SRLY_INC_DIR.'/functions.php';

/**
 * Let's deal with the install and uninstall process correctly
 */
register_activation_hook(__FILE__, array('ScreenlyCast', 'pluginActivation'));
register_deactivation_hook(__FILE__, array('ScreenlyCast', 'pluginDeactivation'));

/**
 * Init
 */
add_action('admin_init', array('ScreenlyCast', 'adminInit'), 0);
add_action('init', array('ScreenlyCast', 'init'), 0);
/**
 * Add action immediately after the query is parsed so that we can catch
 * our var.
 */
add_action('parse_query', array('ScreenlyCast', 'parseQuery'), 0);
add_action('admin_init', 'srlyAddAdminAssets',9999);//add admin css and JS