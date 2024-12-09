<?php
/**
 * PHPUnit bootstrap file
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
    $_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
    require dirname( dirname( __FILE__ ) ) . '/screenly-cast/screenly-cast.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Set up admin environment for tests that need it
function _setup_admin_environment() {
    if (!defined('WP_ADMIN')) {
        define('WP_ADMIN', true);
    }
    $GLOBALS['is_admin'] = true;
}
tests_add_filter( 'admin_init', '_setup_admin_environment' );

// Set up default theme
function _setup_default_theme() {
    switch_theme('twentyfifteen');
}
tests_add_filter( 'after_setup_theme', '_setup_default_theme' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';