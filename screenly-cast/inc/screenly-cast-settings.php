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
    //body style
    register_setting('screenly', 'srly_body_font_family');
    register_setting('screenly', 'srly_body_background');

    //logo
    register_setting('screenly', 'srly_brand_logo_width');
    register_setting('screenly', 'srly_brand_logo_height');
    register_setting('screenly', 'srly_brand_logo_display');

    //time
    register_setting('screenly', 'srly_time_color');
    register_setting('screenly', 'srly_time_display');
    register_setting('screenly', 'srly_time_font_size');
    register_setting('screenly', 'srly_time_font_weight');

    //heading
    register_setting('screenly', 'srly_h1_margin');
    register_setting('screenly', 'srly_h1_padding');
    register_setting('screenly', 'srly_h1_font_size');
    register_setting('screenly', 'srly_h1_font_weight');
    register_setting('screenly', 'srly_h1_color');

    //link
    register_setting('screenly', 'srly_a_color');
    register_setting('screenly', 'srly_a_text_decoration');
    register_setting('screenly', 'srly_a_font_weight');
    register_setting('screenly', 'srly_a_font_size');

    //content
    register_setting('screenly', 'srly_content_margin_top');
    register_setting('screenly', 'srly_content_line_height');
    register_setting('screenly', 'srly_content_color');
    register_setting('screenly', 'srly_content_font_weight');
    register_setting('screenly', 'srly_content_font_size');
    
    register_setting('screenly', 'srly_category_switch_period');

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
    add_settings_field(
        'srly_brand_logo_width',
        __('Logo width', SRLY_THEME),
        'srlyBrandLogowidthField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_brand_logo_width',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_brand_logo_height',
        __('Logo Height', SRLY_THEME),
        'srlyBrandLogoHeightField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_brand_logo_height',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_brand_logo_display',
        __('Logo Display', SRLY_THEME),
        'srlyBrandLogoDisplayField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_brand_logo_display',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_body_font_family',
        __('Body Font Family', SRLY_THEME),
        'srlyBodyFontField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_body_font_family',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_time_color',
        __('Time color', SRLY_THEME),
        'srlyTimeColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_time_color',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_time_display',
        __('Display time', SRLY_THEME),
        'srlyTimeDisplayField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_time_display',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_time_font_size',
        __('Time font size', SRLY_THEME),
        'srlyTimeFontSizeField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_time_font_size',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_time_font_weight',
        __('Time font weight', SRLY_THEME),
        'srlyTimeFontWeightField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_time_font_weight',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_h1_margin',
        __('Heading margin', SRLY_THEME),
        'srlyHeadMarginField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_h1_margin',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_h1_padding',
        __('Heading padding', SRLY_THEME),
        'srlyHeadPaddingField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_h1_padding',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_h1_font_size',
        __('Heading font size', SRLY_THEME),
        'srlyHeadFontSizeField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_h1_font_size',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_h1_font_weight',
        __('Heading font weight', SRLY_THEME),
        'srlyHeadFontWeightField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_h1_font_weight',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_h1_color',
        __('Heading font color', SRLY_THEME),
        'srlyHeadFontColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_h1_color',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_a_color',
        __('Link color', SRLY_THEME),
        'srlyLinkColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_a_color',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_a_text_decoration',
        __('Link decoration', SRLY_THEME),
        'srlyLinkTextDecorationColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_a_text_decoration',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_a_font_weight',
        __('Link font weight', SRLY_THEME),
        'srlyLinkFontWeightColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_a_font_weight',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_a_font_size',
        __('Link font size', SRLY_THEME),
        'srlyLinkFontSizeField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_a_font_size',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    
    add_settings_field(
        'srly_content_margin_top',
        __('Content margin top', SRLY_THEME),
        'srlyContentMarginTopField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_content_margin_top',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_content_line_height',
        __('Content line height', SRLY_THEME),
        'srlyContentLineHeightField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_content_line_height',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_content_color',
        __('Content color', SRLY_THEME),
        'srlyContentColorField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_content_color',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_content_font_weight',
        __('Content Font Weight', SRLY_THEME),
        'srlyContentFontWeightField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_content_font_weight',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
    add_settings_field(
        'srly_content_font_size',
        __('Content font Size', SRLY_THEME),
        'srlyContentFontSizeField',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_content_font_size',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    ); 
    add_settings_field(
        'srly_category_switch_period',
        __('Category switch period', SRLY_THEME),
        'srlyCategorySwitchPeriod',
        'screenly',
        'screenly_section',
        array(
            'label_for' => 'srly_category_switch_period',
            'class' => 'screenly-row',
            'screenly_custom_data' => 'custom'
        )
    );
}

/**
 * Print Content Margin Top Field input
 *
 * @param $args srlyContentMarginTopField can accept an $args parameter, which is an array
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
function srlyContentMarginTopField($args) {
    $path = get_option('srly_content_margin_top');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}
/**
 * Print Category Switch Period input
 *
 * @param $args srlyCategorySwitchPeriod can accept an $args parameter, which is an array
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
function srlyCategorySwitchPeriod($args) {
    $path = get_option('srly_category_switch_period');
    $var = esc_attr($args['label_for']);
    ?>
        <input type="range" min="5000" max="500000" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
        <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
    <?php
}

/**
 * Print Content Line Height Field input
 *
 * @param $args srlyContentLineHeightField can accept an $args parameter, which is an array
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
function srlyContentLineHeightField($args) {
    $path = get_option('srly_content_line_height');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Content Color Field input
 *
 * @param $args srlyContentColorField can accept an $args parameter, which is an array
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
function srlyContentColorField($args) {
    $path = get_option('srly_content_color');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_color_picker">
<?php
}


/**
 * Print Content Font Size Field input
 *
 * @param $args srlyContentFontSizeField can accept an $args parameter, which is an array
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
function srlyContentFontSizeField($args) {
    $path = get_option('srly_content_font_size');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Content Font Weight Field input
 *
 * @param $args srlyContentFontWeightField can accept an $args parameter, which is an array
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
function srlyContentFontWeightField($args) {
    $path = get_option('srly_content_font_weight');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="800" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Link Font Size Field input
 *
 * @param $args srlyLinkFontSizeField can accept an $args parameter, which is an array
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
function srlyLinkFontSizeField($args) {
    $path = get_option('srly_a_font_size');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Link Font Weight Color Field input
 *
 * @param $args srlyLinkFontWeightColorField can accept an $args parameter, which is an array
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
function srlyLinkFontWeightColorField($args) {
    $path = get_option('srly_a_font_weight');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="800" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Link Text Decoration Color Field input
 *
 * @param $args srlyLinkTextDecorationColorField can accept an $args parameter, which is an array
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
function srlyLinkTextDecorationColorField($args) {
    $path = get_option('srly_a_text_decoration');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">

<?php
}


/**
 * Print Link Color Field input
 *
 * @param $args srlyLinkColorField can accept an $args parameter, which is an array
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
function srlyLinkColorField($args) {
    $path = get_option('srly_a_color');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_color_picker">

<?php
}


/**
 * Print Head Font Color Field input
 *
 * @param $args srlyHeadFontColorField can accept an $args parameter, which is an array
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
function srlyHeadFontColorField($args) {
    $path = get_option('srly_h1_color');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_color_picker">

<?php
}


/**
 * Print Head Font Weight Field input
 *
 * @param $args srlyHeadFontWeightField can accept an $args parameter, which is an array
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
function srlyHeadFontWeightField($args) {
    $path = get_option('srly_h1_font_weight');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="800" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Head Font Size Field input
 *
 * @param $args srlyHeadFontSizeField can accept an $args parameter, which is an array
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
function srlyHeadFontSizeField($args) {
     $path = get_option('srly_h1_font_size');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="300" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Head Padding Field input
 *
 * @param $args srlyHeadPaddingField can accept an $args parameter, which is an array
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
function srlyHeadPaddingField($args) {
     $path = get_option('srly_h1_padding');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Head Margin Field input
 *
 * @param $args srlyHeadMarginField can accept an $args parameter, which is an array
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
function srlyHeadMarginField($args) {
     $path = get_option('srly_h1_margin');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Time Font Weight Field input
 *
 * @param $args srlyTimeFontWeightField can accept an $args parameter, which is an array
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
function srlyTimeFontWeightField($args) {
     $path = get_option('srly_time_font_weight');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="800" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Time Font Size Field input
 *
 * @param $args srlyTimeFontSizeField can accept an $args parameter, which is an array
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
function srlyTimeFontSizeField($args) {
     $path = get_option('srly_time_font_size');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="300" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php
}


/**
 * Print Time Display Field input
 *
 * @param $args srlyTimeDisplayField can accept an $args parameter, which is an array
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
function srlyTimeDisplayField($args) {
     $path = get_option('srly_time_display');
    $var = esc_attr($args['label_for']);
?>
    <select name="<?php echo $var?>" id="<?php echo $var?>" class="large-text" >
	<option value="">(no selection)</option>
        <option class="" value="block" <?php ($path=='block')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >Show time</option>
        <option class="" value="none"  <?php ($path=='none')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?>>Hide time</option>
    </select>

<?php	
}


/**
 * Print Time Color Field input
 *
 * @param $args srlyTimeColorField can accept an $args parameter, which is an array
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
function srlyTimeColorField($args) {
     $path = get_option('srly_time_color');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_color_picker">

<?php	
}


/**
 * Print Brand Logo Display Field input
 *
 * @param $args srlyBrandLogoDisplayField can accept an $args parameter, which is an array
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
function srlyBrandLogoDisplayField($args) {
     $path = get_option('srly_brand_logo_display');
    $var = esc_attr($args['label_for']);
?>
    <select name="<?php echo $var?>" id="<?php echo $var?>" class="large-text" >
	<option value="">(no selection)</option>
        <option class="" value="block" <?php ($path=='block')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >Show logo</option>
        <option class="" value="none"  <?php ($path=='none')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >Hide logo</option>
    </select>

<?php	
}

/**
 * Print Brand Logo Height Field input
 *
 * @param $args srlyBrandLogoHeightField can accept an $args parameter, which is an array
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
function srlyBrandLogoHeightField($args)
{
    $path = get_option('srly_brand_logo_height');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="500" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php	
}


/**
 * Print Brand Logo width Field input
 *
 * @param $args srlyBrandLogowidthField can accept an $args parameter, which is an array
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
function srlyBrandLogowidthField($args)
{
    $path = get_option('srly_brand_logo_width');
    $var = esc_attr($args['label_for']);
?>
    <input type="range" min="0" max="800" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_slider">
    <p> <span id="<?php echo $var.'_slider_output'?>"></span></p>
<?php	
}


/**
 * Print Body Font Field input
 *
 * @param $args srlyBodyFontField can accept an $args parameter, which is an array
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
function srlyBodyFontField($args)
{
    $path = get_option('srly_body_font_family');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">

<?php	
}


/**
 * Print Body Background Field input
 *
 * @param $args srlyBodyBackgroundField can accept an $args parameter, which is an array
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
function srlyBodyBackgroundField($args)
{
    $path = get_option('srly_body_background');
    $var = esc_attr($args['label_for']);
?>
    <input id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text srly_color_picker">

<?php	
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
    <p><button id='srlySelectImage' >Select Logo</button></p>
    <input type="url" id="<?php echo $var?>" name="<?php echo $var?>" value="<?php echo $path;?>" class="large-text">
    <p><img id='media_image' src='' width='350px'></p>
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
