<?php
/**
 * For security reasons file must run only if in chain with WP API.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  ScreenlyCast
 * @author   Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @since    0.0.1
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 */
defined('ABSPATH') or die("No script kiddies please!");


/**
 * Screenly main class. Called by screenly-cast.php.
 *
 * @category PHP
 * @package  ScreenlyCast
 * @author   Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 */
class ScreenlyCast
{
    /**
     * CONSTANTS
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @var     string QUERY_VAR The var that will be present on query.
     * @var     string THEME_STYLESHEET The Stylesheet name.
     * @var     string THEME_TEMPLATE The name given to the template.
     * @see     style.css file under theme folder
     */
    const QUERY_VAR  = 'srly';
    const THEME_STYLESHEET = 'screenly-cast';
    const THEME_TEMPLATE = 'screenly-cast';

    /**
     * Used to determine if class was initialized or not.
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @static
     * @var     boolean
     */
    private static $_running = false;



    /**
     * Runs on Admin Init
     *
     * @package ScreenlyCast
     * @since   0.0.16
     * @static
     * @return  boolean
     */
    public static function adminInit()
    {
        /**
         * Check for WP version compatability before any other action.
         */
        if (!self::checkWPVersion()) {
            add_action('admin_notices', array('ScreenlyCast', 'notifyWPVersion'));
            add_action('network_admin_notices', array('ScreenlyCast', 'notifyWPVersion')); // for multisite
            deactivate_plugins(SRLY_PLUGIN_NAME);
            return false;
        }
    }




    /**
     * Initializes Plugin. Called on screenly-cast.php.
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @static
     * @return  boolean
     */
    public static function init()
    {
        if (!self::$_running) {
            /**
             * We use post thumbnail(Featured Image) to display big covers
             * on the screen.
             */
            add_theme_support('post-thumbnails');

            /**
             * Add screenly var to save query vars.
             */
            global $wp;
            $wp->add_query_var('srly');

            /**
             * Registers Screenly theme
             */
            $theme = wp_get_theme(SRLY_THEME);
            if (!$theme->exists()) {
                register_theme_directory(SRLY_PLUGIN_DIR.'theme');
            }

            /**
             * Reverse to previous theme while in admin mode.
             */
            if (is_admin()) {
                self::reverseToPreviousTheme();
            }

            /**
             * Adds admin page for plugin settings.
             */
            include_once 'screenly-cast-settings.php';

            /**
             * Mark plugin as running.
             */
            self::$_running = true;
        }

        return true;
    }


    /**
     * Saves the previous theme in use.
     *
     * @package ScreenlyCast
     *
     * @return boolean
     * @static
     * @since  0.0.1
     */
    private static function savePreviousTheme()
    {
        $currTheme = wp_get_theme();
        if (!empty($currTheme) && $currTheme->exists()) {
            if ($currTheme->stylesheet!=SRLY_THEME) {
                update_option (SRLY_PREFIX.'saved_theme', $currTheme);
                return true;
            }
        }

        return true;
    }


    /**
     * Get the previous saved theme.
     *
     * @package ScreenlyCast
     *
     * @return string
     * @static
     * @since  0.0.1
     */
    private static function getPreviousTheme()
    {
        $saved = get_option (SRLY_PREFIX.'saved_theme');
        if (!empty($saved)) {
            return $saved;
        }
        return '';
    }


    /**
     * Activates Screenly theme.
     *
     * @package ScreenlyCast
     *
     * @return boolean
     * @static
     * @since  0.0.1
     */
    private static function activateScreenlyTheme()
    {
        if (self::savePreviousTheme()) {
            switch_theme(SRLY_THEME);
            update_option('theme_switched', SRLY_THEME);
            return true;
        }
        return false;
    }


    /**
     * Activates previously active theme.
     *
     * @package ScreenlyCast
     *
     * @return boolean
     * @static
     * @since  0.0.1
     */
    private static function reverseToPreviousTheme()
    {
        $prevTheme = self::getPreviousTheme();
        if (!empty($prevTheme->stylesheet)) {
            if ($prevTheme->stylesheet!=get_option('stylesheet')) {
                switch_theme($prevTheme->stylesheet);
                update_option('theme_switched', $prevTheme->stylesheet);
                return true;
            }
        }
        return false;
    }


    /**
     * Parse WP Query to find our var.
     *
     * @param WP_Query $wp_query WordPress query object
     *
     * @package ScreenlyCast
     *
     * @static
     * @since  0.0.1
     */
    public static function parseQuery($wp_query)
    {
        if (!is_admin()) {
            $scope = array('ScreenlyCast', 'templateInclude');
            if (isset($wp_query->query['srly'])) {
                self::activateScreenlyTheme();
                add_filter('template_include', $scope);
            } else {
                self::reverseToPreviousTheme();
                remove_filter('template_include', $scope);
            }
        }
    }


    /**
     * Provide Screenly theme templates.
     *
     * @param string $template Template name to be included
     *
     * @package ScreenlyCast
     *
     * @return string
     * @static
     * @since  0.0.1
     */
    public static function templateInclude($template)
    {
        global $wp_query;

        if (!is_admin()) {
            if (isset($wp_query->query['srly'])) {
                $path = SRLY_THEME_DIR."/";
                include $path."functions.php";
                if (is_attachment()) {
                    return $path . 'attachment.php';
                } else {
                    return $path . 'index.php';
                }
            }
        }

        return $template;
    }



    /**
     * Check if WordPress version is compatable with plugin's version.
     *
     * @package ScreenlyCast
     * @since   0.0.16
     * @return  boolean
     * @static
     */
    public static function checkWPVersion()
    {
        if (version_compare($GLOBALS['wp_version'], SRLY_WP_VERSION, '<')) {
            return false;
        }

        return true;
    }



    /**
     * Create admin notice markup.
     *
     * @package ScreenlyCast
     * @since   0.0.16
     * @return  boolean
     * @static
     */
    public static function notifyWPVersion()
    {
        load_plugin_textdomain(self::THEME_STYLESHEET);
        $message = '<strong>'.
                    sprintf(
                        esc_html__('Screenly Cast %s requires WordPress %s or higher.', SRLY_THEME),
                        SRLY_VERSION, SRLY_WP_VERSION
                    )
                    .'</strong> '
                    .sprintf(
                        __('Please <a href="%1$s">upgrade WordPress</a> to a current version.', SRLY_THEME),
                        'https://codex.wordpress.org/Upgrading_WordPress'
                    );
?>
<div class="notice notice-success is-dismissible">
    <?php
        echo sprintf('<p>Screenly Cast <b>%s</b></p>',
            __('deactivated', SRLY_THEME)
        );
    ?>
</div>
<div class="notice notice-error is-dismissible">
    <p><?php echo $message;?></p>
</div>
<?php
        return true;
    }


    /**
     * Attached to activate_{ plugin_basename(__FILES__) }
     * by register_activation_hook().
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @return  boolean
     * @static
     */
    public static function pluginActivation()
    {
        return true;
    }


    /**
     * Attached to deactivate_{ plugin_basename(__FILES__) }
     * by register_activation_hook().
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @return  boolean
     * @static
     */
    public static function pluginDeactivation()
    {
        self::_log('plugin deactivated');
        return true;
    }


    /**
     * Log debugging.
     *
     * @param string $data The data to be logged
     *
     * @package ScreenlyCast
     * @since   0.0.1
     * @return  boolean
     * @static
     */
    private static function _log($data)
    {
        if (apply_filters(
            'screenly_cast_debug_log',
            defined('WP_DEBUG')
            && WP_DEBUG
            && defined('WP_DEBUG_LOG')
            && WP_DEBUG_LOG
        )
        ) {
            error_log(print_r(compact('data'), true));
            return true;
        }
        return false;
    }
}
