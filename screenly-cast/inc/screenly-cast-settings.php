<?php
/**
 * Make sure we don't expose any info if called directly.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  ScreenlyCast
 * @author   Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 */




/**
 * Custom option and settings
 *
 * @package ScreenlyCast
 * @since   0.0.1
 * @return  void
 */
function srlySettingsInit()
{
    // register a new setting for "wporg" page
    register_setting('screenly', 'screenly_options_logo');

    // register a new section in the "wporg" page
    add_settings_section(
        'screenly_section',
        __('Settings', SRLY_THEME),
        'srlySectionInput',
        'screenly'
    );

    // register a new field in the "screenly_section" section, inside the "wporg" page
    add_settings_field(
        'screenly_logo_field',
        __('Brand logo', SRLY_THEME),
        'srlyLogoField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'screenly_options_logo',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
}




/**
 * Register our srlySettingsInit to the admin_init action hook
 *
 * @package ScreenlyCast
 * @since   0.0.1
 */
add_action('admin_init', 'srlySettingsInit');



/**
 * Custom option and settings: callback functions section callbacks can accept an
 * $args parameter, which is an array. $args have the following keys defined:
 * title, id, callback. the values are defined at the add_settings_section()
 * function.
 *
 * @param $args section callbacks can accept an $args parameter, which is an array
 *        that has the following keys defined: title, id, callback. the values are
 *        defined at the add_settings_section() function - srlySettingsInit.
 *
 * @package ScreenlyCast
 * @since   0.0.1
 * @return  void
 */
function srlySectionInput($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>">
        <?php esc_html_e('Use this page to change your settings.', SRLY_THEME); ?>
    </p>
<?php
}



/**
 * Print logo input
 *
 * @param $args srlyLogoField can accept an $args parameter, which is an array
 *        defined at the add_settings_field() function - srlySettingsInit.
 *        Wordpress has magic interaction with the following keys: label_for,
 *        class. the "label_for" key value is used for the "for" attribute of the
 *        <label>. the "class" key value is used for the "class" attribute of the
 *        <tr> containing the field. you can add custom key value pairs to be used
 *        inside your callbacks.
 *
 * @package ScreenlyCast
 * @since   0.0.1
 * @return  void
 */
function srlyLogoField($args)
{
    $path = get_option('screenly_options_logo');
    $var = esc_attr($args['label_for']);
?>
    <input type="url" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">
    <p class="description"><?php esc_html_e('Upload an image to you media library. Check it\'s url and copy paste to the input above.', SRLY_THEME); ?></p>
    <p class="description"><?php _e('We recomend an image with the proportion of <b>314 x 98 px</b>.', SRLY_THEME); ?></p>
<?php
}



/**
 * Add the sub-menu item to main menu under Settings. Creates a dedicated page for
 * the plugin.
 *
 * @package ScreenlyCast
 * @since   0.0.1
 * @return  void
 */
function srlyOptionsPage()
{
    // add top level menu page
    add_submenu_page(
        'options-general.php',
        'Screenly Cast',
        'Screenly',
        'manage_options',
        'screenly',
        'srlyOptionsPageHTML'
    );
}



/**
 * Register our srlyOptionsPage to the admin_menu action hook
 *
 * @package ScreenlyCast
 * @since   0.0.1
 */
add_action('admin_menu', 'srlyOptionsPage');



/**
 * Prints out the form and also any succes message.
 *
 * @package ScreenlyCast
 * @since   0.0.1
 * @return  void
 */
function srlyOptionsPageHTML()
{
    /**
     * Check user capabilities
     */
    if (!current_user_can('manage_options')) {
        return;
    }
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('screenly');
        do_settings_sections('screenly');
        submit_button('Save Settings');
        ?>
    </form>
</div>
<?php
}
?>
