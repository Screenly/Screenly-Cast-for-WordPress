<?php
declare(strict_types=1);

/**
 * PHPUnit bootstrap file for WordPress plugin tests.
 */

// Composer autoloader must be loaded before WP_PHPUNIT__DIR will be available
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Give access to tests_add_filter() function.
require_once '/tmp/wordpress-tests-lib/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin(): void {
    require dirname(__DIR__) . '/screenly-cast/screenly-cast.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

/**
 * Set up the WordPress test environment.
 */
function _setup_test_environment(): void {
    // Load WordPress admin functions
    require_once ABSPATH . 'wp-admin/includes/admin.php';

    // Set up admin environment
    if (!defined('WP_ADMIN')) {
        define('WP_ADMIN', true);
    }

    // Set up default theme
    switch_theme('twentytwentyfour');
}
tests_add_filter('setup_theme', '_setup_test_environment');

// Start up the WP testing environment.
require '/tmp/wordpress-tests-lib/includes/bootstrap.php';