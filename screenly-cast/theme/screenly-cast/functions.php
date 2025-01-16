<?php
/**
 * Theme functions and definitions
 *
 * @package ScreenlyCast
 */

if ( ! function_exists( 'screenly_cast_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function screenly_cast_setup() {
		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'screenly_cast_setup' );

/**
 * Enqueue scripts and styles.
 */
function screenly_cast_scripts() {
	wp_enqueue_style(
		'screenly-cast-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'screenly_cast_scripts' );
