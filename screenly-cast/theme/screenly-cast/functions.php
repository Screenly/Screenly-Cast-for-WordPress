<?php
/**
 * Functions, where all main methods are declared.
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
defined('ABSPATH') or die("No script kiddies please!");


/**
 * Filter content so that we limit the amount of tags allowed.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyAllowedContentTags()
{
    $tags = '<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<br>,<em>,<i>,<strong>,<b>,<ul>,<ol>,';
    $tags .= '<li>,<blockquote>,<ins>,<code>,<pre>,<del>,<p>,<img>,<dl>,<dt>,<dd>,'
            . '<figure>, <figcaption>';
    return $tags;
}
add_filter('get_the_content_limit_custom_allowedtags', 'srlyAllowedContentTags');
add_filter('get_the_content_limit_allowedtags', 'srlyAllowedContentTags');


/**
 * Let's add the filter to content method.
 *
 * @param string $content Post content.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyThePostContent($content)
{
    $content = strip_tags($content, srlyAllowedContentTags());
    return '<div class="content">'.$content.'</div>';
}
add_filter('the_content', 'srlyThePostContent');


/**
 * Checks if one of the two conditions exist: - Contains a post thumbnail, - Is an
 * attachment post these two conditions are display with css background cover
 * property.
 *
 * @param stdClass $post The post to focus on.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srlyHasTheFeaturedImage($post=null)
{
    if (empty($post)) {
        global $post;
    }
    return is_attachment($post->ID) || has_post_thumbnail($post->ID);
}


/**
 * Gets the featured image.
 *
 * @param stdClass $post The post to focus on.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyGetFeaturedImage($post=null)
{
    if (empty($post)) {
        global $post;
    }

    if (is_attachment($post->ID)) {
        $featured = wp_get_attachment_image_src($post->ID, 'full');
        if (!empty($featured)) {
            $featured = $featured[0];
        }
    } else if (has_post_thumbnail($post->ID)) {
        $featured = get_the_post_thumbnail_url($post->ID, 'full');
    }

    if (!empty($featured)) {
        echo ' style="background-image:url('.$featured.');"';
    }
    return '';
}


/**
 * Function prints out {srlyGetFeaturedImage}.
 *
 * @param stdClass $post The post to focus on.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srlyTheFeaturedImage($post=null)
{
    echo srlyGetFeaturedImage($post);
    return true;
}


/**
 * We use this function to get the shortness url
 *
 * @param string $url Full url string.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyGetShortLink($url)
{
    $link = parse_url($url);
    if (!empty($link['host'])) {
        $link = str_replace('www.', '', $link['host']) . $link['path'] . '?' . $link['query'];
        return $link;
    }
    return '';
}


/**
 * Function prints out {srlyGetShortLink}.
 *
 * @param string $url Full url string.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srlyTheShortLink($url)
{
    echo srlyGetShortLink($url);
    return true;
}


/**
 * We use this function to create a simple QRCODE.
 *
 * @param string  $data Full url string.
 * @param integer $w    Width of image
 * @param integer $h    Height of image
 * @param integer $m    Image padding size
 *
 * @package ScreenlyCast
 * @return  string
 */
function srlyGetQrcodeLink($data, $w=200, $h=200, $m=0)
{
    $str = "https://api.qrserver.com/v1/create-qr-code/?qzone=";
    $str .= $m;
    $str .= "&size=";
    $str .= $w;
    $str .= "x";
    $str .= $h;
    $str .= "&data=";
    $str .= $data;
    return $str;
}


/**
 * Function prints out {srlyGetQrcodeLink}.
 *
 * @param string  $data Full url string.
 * @param integer $w    Width of image
 * @param integer $h    Height of image
 * @param integer $m    Image padding size
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srlyTheQrcodeLink($data, $w=200, $h=200, $m=0)
{
    echo srlyGetQrcodeLink($data, $w, $h, $m);
    return true;
}

function srlyCategoryBottomNavigation($no_of_posts='') {
    
    $loop_times=$no_of_posts-1;
    $display_nav = '<div class="srly_category_nav"><center> <span class="srly_category_nav_center">'
            . '<span class="srly_category_nav_item srly_category_nav_item_active" id="srly_category_nav_0"></span>';
    
    for($i=0 ; $i<$loop_times; $i++) {
        $span_id=$i+1;
        $display_nav .='<span class="srly_category_nav_item" id="srly_category_nav_'.$span_id.'"></span>';
    }
    
    $display_nav .='</span></center></div>';
    
    echo $display_nav;
}

/**
 * Enqueue and register theme styles and scripts
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srlyEnqueueThemeAssets()
{
    $path = plugin_dir_url(__FILE__);
    if(is_singular()){
        // CSS
        wp_enqueue_style(SRLY_THEME, $path.'style.php', array(), SRLY_VERSION, 'all');
        // JS
        wp_enqueue_script(SRLY_THEME, $path.'assets/js/scripts.js', array(), SRLY_VERSION, true);
    }
    else{
        // CSS
        wp_enqueue_style(SRLY_THEME, $path.'category_style.php', array(), SRLY_VERSION, 'all');
        // JS
        wp_enqueue_script(SRLY_THEME, $path.'assets/js/category_scripts.js', array('jquery'), SRLY_VERSION, true);
    }

    return true;
}
add_action('wp_enqueue_scripts', 'srlyEnqueueThemeAssets', 9999);


/**
 * Remove admin bar. No interaction is applied on the TV. Call remove_action is to
 * make sure we don't get a `margin-top` on html tag.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
show_admin_bar(false);
remove_action('wp_head', '_admin_bar_bump_cb');


/**
 * Remove WordPress Emojis.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
?>
