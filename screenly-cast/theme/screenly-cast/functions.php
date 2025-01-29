<?php
/**
 * Screenly Cast theme functions and definitions
 *
 * @package ScreenlyCast
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );


/**
 * Filter content so that we limit the amount of tags allowed.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srly_allowed_content_tags() {
	$tags = '<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<br>,<em>,<i>,<strong>,<b>,<ul>,<ol>,';
	$tags .= '<li>,<blockquote>,<ins>,<code>,<pre>,<del>,<p>';
	return $tags;
}
add_filter( 'get_the_content_limit_custom_allowedtags', 'srly_allowed_content_tags' );
add_filter( 'get_the_content_limit_allowedtags', 'srly_allowed_content_tags' );


/**
 * Let's add the filter to content method.
 *
 * @param string $content Post content.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srly_the_post_content( $content ) {
	$content = strip_tags( $content, srly_allowed_content_tags() );
	return '<div class="content">' . $content . '</div>';
}
add_filter( 'the_content', 'srly_the_post_content' );


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
function srly_has_the_featured_image( $post = null ) {
	if ( empty( $post ) ) {
		global $post;
	}
	return is_attachment( $post->ID ) || has_post_thumbnail( $post->ID );
}


/**
 * Gets the featured image.
 *
 * @param stdClass $post The post to focus on.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srly_get_featured_image( $post = null ) {
	if ( empty( $post ) ) {
		global $post;
	}

	if ( is_attachment( $post->ID ) ) {
		$featured = wp_get_attachment_image_src( $post->ID, 'full' );
		if ( ! empty( $featured ) ) {
			$featured = $featured[0];
		}
	} else if ( has_post_thumbnail( $post->ID ) ) {
		$featured = get_the_post_thumbnail_url( $post->ID, 'full' );
	}

	if ( ! empty( $featured ) ) {
		echo ' style="background-image:url(' . esc_url( $featured ) . ');"';
	}
	return '';
}


/**
 * Function prints out {srly_get_featured_image}.
 *
 * @param stdClass $post The post to focus on.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srly_the_featured_image( $post = null ) {
	echo wp_kses_post( srly_get_featured_image( $post ) );
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
function srly_get_short_link( $url ) {
	$link = parse_url( $url );
	if ( ! empty( $link['host'] ) ) {
		$link = str_replace( 'www.', '', $link['host'] ) . $link['path'] . '?' . $link['query'];
		return $link;
	}
	return '';
}


/**
 * Function prints out {srly_get_short_link}.
 *
 * @param string $url Full url string.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srly_the_short_link( $url ) {
	echo esc_html( srly_get_short_link( $url ) );
	return true;
}


/**
 * We use this function to create a simple QRCODE.
 *
 * @param string  $data Full url string.
 * @param integer $w    Width of image.
 * @param integer $h    Height of image.
 * @param integer $m    Image padding size.
 *
 * @package ScreenlyCast
 * @return  string
 */
function srly_get_qrcode_link( $data, $w = 200, $h = 200, $m = 0 ) {
	$str = 'https://api.qrserver.com/v1/create-qr-code/?qzone=';
	$str .= $m;
	$str .= '&size=';
	$str .= $w;
	$str .= 'x';
	$str .= $h;
	$str .= '&data=';
	$str .= $data;
	return $str;
}


/**
 * Function prints out {srly_get_qrcode_link}.
 *
 * @param string  $data Full url string.
 * @param integer $w    Width of image.
 * @param integer $h    Height of image.
 * @param integer $m    Image padding size.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srly_the_qrcode_link( $data, $w = 200, $h = 200, $m = 0 ) {
	echo esc_url( srly_get_qrcode_link( $data, $w, $h, $m ) );
	return true;
}



/**
 * Enqueue and register theme styles and scripts
 *
 * @package ScreenlyCast
 * @return  boolean
 */
function srly_enqueue_theme_assets() {
	$path = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'work-sans', 'https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500', array(), null );
	wp_enqueue_style( SRLY_THEME, $path . 'style.css', array(), SRLY_VERSION, 'all' );
	wp_enqueue_script( SRLY_THEME, $path . 'assets/js/scripts.js', array(), SRLY_VERSION, true );

	return true;
}
add_action( 'wp_enqueue_scripts', 'srly_enqueue_theme_assets', 9999 );


/**
 * Remove admin bar. No interaction is applied on the TV. Call remove_action is to
 * make sure we don't get a `margin-top` on html tag.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
show_admin_bar( false );
remove_action( 'wp_head', '_admin_bar_bump_cb' );


/**
 * Remove WordPress Emojis.
 *
 * @package ScreenlyCast
 * @return  boolean
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */
function screenly_cast_scripts() {
	wp_enqueue_style(
		'screenly-cast-style',
		esc_url( get_stylesheet_uri() ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'screenly_cast_scripts' );
