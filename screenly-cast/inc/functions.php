<?php
/**
 * Improve user experience on the admin settings page for screenlycast.
 *
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyAddAdminAssets()
{
    wp_enqueue_style('admin_init', '/wp-content/plugins/screenly-cast/inc/assets/css/style.css', 'style');
        
    //Core media script
    wp_enqueue_media();
    
    //add color picker css file
    wp_enqueue_style('wp-color-picker');

    // Your custom js file
    wp_enqueue_script( 'media-lib-uploader-js', '/wp-content/plugins/screenly-cast/inc/assets/js/scripts.js' , array('jquery', 'wp-color-picker') );
}


/**
 * Get custom styles settings, they will be used on the frontend theme. You need to have created them on the admin settings page and format them accordingly.
 *
 *
 * @package ScreenlyCast
 * @return  string
 */
function srly_get_css_settings_from_db() {
    require_once  dirname(__FILE__).'/../../../../wp-config.php';
    $srly_brand_logo_width= get_option('srly_brand_logo_width');
    $srly_brand_logo_width=!empty($srly_brand_logo_width)? $srly_brand_logo_width."px": "";
    //get css settings from db and present it as an array
    $css_values_from_db= array(
    'srly_body_font_family' =>get_option('srly_body_font_family'),
    'srly_body_background'=>get_option('srly_body_background'),
    'srly_brand_logo_width'=>  $srly_brand_logo_width,
    'srly_brand_logo_height'=> !empty(get_option('srly_brand_logo_height'))? get_option('srly_brand_logo_height')."px":"",
    'srly_brand_logo_display'=>get_option('srly_brand_logo_display'),

    'srly_h1_margin' =>  !empty(get_option('srly_h1_margin'))? get_option('srly_h1_margin')."px":"",
    'srly_h1_padding' =>get_option('srly_h1_padding'),
    'srly_h1_font_size' => !empty(get_option('srly_h1_font_size'))? get_option('srly_h1_font_size')."px":"",
    'srly_h1_font_weight' => !empty(get_option('srly_h1_font_weight'))? get_option('srly_h1_font_weight')."px":"",
    'srly_h1_color'=>get_option('srly_h1_color'),

    'srly_time_color'=>get_option('srly_time_color'),
    'srly_time_display'=>get_option('srly_time_display'),
    'srly_time_font_size'=> !empty(get_option('srly_time_font_size'))? get_option('srly_time_font_size')."px":"",
    'srly_time_font_weight'=>get_option('srly_time_font_weight'),

    'srly_a_color'=>get_option('srly_a_color'),
    'srly_a_text_decoration'=>get_option('srly_a_text_decoration'),
    'srly_a_font_weight'=>get_option('srly_a_font_weight'),
    'srly_a_font_size'=>get_option('srly_a_font_size')."px",

    'srly_content_margin_top'=>  !empty(get_option('srly_content_margin_top'))?get_option('srly_content_margin_top')."px":"",
    'srly_content_line_height'=>  !empty(get_option('srly_content_line_height'))?get_option('srly_content_line_height')."px":"",
    'srly_content_color'=>get_option('srly_content_color'),
    'srly_content_font_weight'=>get_option('srly_content_font_weight'),
    'srly_content_font_size'=> !empty(get_option('srly_content_font_size'))?get_option('srly_content_font_size')."px":"",

    'srly_blockquote_font_weight'=>get_option('srly_blockquote_font_weight'),
    'srly_blockquote_font_style'=>get_option('srly_blockquote_font_style'),
    'srly_blockquote_letter_spacing'=>get_option('srly_blockquote_letter_spacing'),
    'srly_blockquote_font_size'=> !empty(get_option('srly_blockquote_font_size'))?get_option('srly_blockquote_font_size')."px":"",

    'srly_h23456_margin' => !empty(get_option('srly_h23456_margin'))?get_option('srly_h23456_margin')."px":"",
    'srly_h23456_font_weight' =>get_option('srly_h23456_font_weight'),

    'srly_h2_font_size'=> !empty(get_option('srly_h2_font_size'))? get_option('srly_h2_font_size')."px":"",
    'srly_h4_font_size'=> !empty(get_option('srly_h4_font_size'))?get_option('srly_h4_font_size')."px":"",

    'srly_h5_color'=>get_option('srly_h5_color'),
    'srly_h5_font_size'=> !empty(get_option('srly_h5_font_size'))?get_option('srly_h5_font_size')."px":"",
    'srly_h5_font_weight'=>get_option('srly_h5_font_weight'),

    'srly_h6_font_size'=> !empty(get_option('srly_h6_font_size'))?get_option('srly_h6_font_size')."px":"",
    'srly_h6_font_weight'=>get_option('srly_h6_font_weight'),
    'srly_h6_text_transform'=>get_option('srly_h6_text_transform'),

    'srly_b_strong_font_weight'=>get_option('srly_b_strong_font_weight'),


    'srly_ul_ol_padding_left'=>get_option('srly_ul_ol_padding_left'),

    'srly_ul_list_style_type'=>get_option('srly_ul_list_style_type'),

    'srly_ul_li_padding_left'=>get_option('srly_ul_li_padding_left'),

    'srly_h3_color'=>get_option('srly_h3_color'),
    'srly_h3_font_size'=>get_option('srly_h3_font_size'),
    'srly_h3_font_weight'=>  get_option('srly_h3_font_weight')      
    );
    return $css_values_from_db;
}


/**
 * Set values for style script(this function is called in <screenly cast plugin base>/theme/screenly-cast/style.php ), if there are no custom values on the database.
 *
 *
 * @package ScreenlyCast
 * @return  string
 */

function srly_get_css_values(){
/* Set default style values */
$css_values=  array(
    'srly_body_color'=>'black',
    'srly_body_font_size'=>'16px',
    'srly_body_font_weight'=>'200',
    'srly_body_font_family' =>"'Work Sans', sans-serif",
    'srly_body_background'=>'white',
    
    'srly_brand_logo_left'=>'5%',
    'srly_brand_logo_top'=>'5px',
    'srly_brand_logo_width'=>'20%',
    'srly_brand_logo_height'=>'auto',
    'srly_brand_logo_z_index'=>'1000',
    'srly_brand_logo_display'=>'block',
    'srly_brand_logo_position'=>'absolute',

    'srly_h1_margin' =>'0',
    'srly_h1_padding' =>'0',
    'srly_h1_font_size' =>'31px',
    'srly_h1_font_weight' =>'300',
    'srly_h1_color'=>'#000',

    'srly_time_color'=>'#9e9e9e',
    'srly_time_display'=>'block',
    'srly_time_font_size'=>'1.6vw',
    'srly_time_font_weight'=>'300',

    'srly_a_color'=>'black',
    'srly_a_text_decoration'=>'none',
    'srly_a_font_weight'=>'',
    'srly_a_font_size'=>'',

    'srly_content_margin_top'=>'10%',
    'srly_content_line_height'=>'1.5em',
    'srly_content_color'=>'',
    'srly_content_font_weight'=>'',
    'srly_content_font_size'=>'',

    'srly_blockquote_font_weight'=>'100',
    'srly_blockquote_font_style'=>'italic',
    'srly_blockquote_letter_spacing'=>'.1em',
    'srly_blockquote_font_size'=>'1.7vw',

    'srly_h23456_margin' =>'.3em 0',
    'srly_h23456_font_weight' =>'300',

    'srly_h2_font_size'=>'3.3vw',
    'srly_h4_font_size'=>'2vw',

    'srly_h5_color'=>'#00b6d4',
    'srly_h5_font_size'=>'1.6vw',
    'srly_h5_font_weight'=>'400',

    'srly_h6_font_size'=>'1.5vw',
    'srly_h6_font_weight'=>'400',
    'srly_h6_text_transform'=>'uppercase',

    'srly_b_strong_font_weight'=>'500',


    'srly_ul_ol_padding_left'=>'30px',

    'srly_ul_list_style_type'=>'none',

    'srly_ul_li_padding_left'=>'10px',

    'srly_h3_color'=>'#00b6d4',
    'srly_h3_font_size'=>'2.6vw',
    'srly_h3_font_weight'=>'200'
);
/* Update with custom values if they have been defined */
    $css_values_from_settings = srly_get_css_settings_from_db();
    foreach ($css_values_from_settings as $key => $value) {
        if(!empty($css_values_from_settings[$key])){
            $css_values[$key]=$css_values_from_settings[$key];
        }
    }

    return $css_values;
}
?>
