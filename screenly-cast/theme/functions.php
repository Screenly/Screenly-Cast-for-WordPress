<?php
/**
 * Screenly Cast theme functions and definitions
 *
 * @package ScreenlyCast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function screenly_cast_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5', array(
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'screenly_cast_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function screenly_cast_scripts() {
	wp_enqueue_style( 'screenly-cast-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'screenly_cast_scripts' );
