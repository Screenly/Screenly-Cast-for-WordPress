<?php
/**
 * ScreenlyCastTest class test for themes.
 *
 * @category PHP
 * @package  ScreenlyCast
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 * @group   ScreenlyCast_theme_test
 */

/**
 * Including theme functions to be tested
 * @package ScreenlyCast
 */
require_once SRLY_THEME_DIR.'/functions.php';

/**
     *  This Class tests all themes on plugin ScreenlyCast.
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test
     *
*/
class TestThemeFunctions extends WP_UnitTestCase {
    /**
     *  This method is a PHPUnit function runs before the test method runs e.g. TestThemeFunctions::testscreenlyCast() it is intended to set up the right environment for the test to run.
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test
     *
    */

    public function setup() {
        parent::setUp();

    }

    /**
     *  This method is a PHPUnit function runs after the test method runs e.g. TestThemeFunctions::testscreenlyCast() it is intended to destroy the environment set by setup() method.
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test
     *
    */
    public function tearDown() {
        parent::tearDown();
    }

    /**
     *  This method tests theme theme/screenly_cast.
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test
     *  @return boolean Returns true if all tests are passed, on failiure the function returns a string describing the kind of error that occured.
     *
    */
    public function testscreenlyCast() {
        $postId = $this->factory->post->create();
        $post = get_post($postId );

        $this->assertTrue( is_string(srly_allowed_content_tags()) );
        $this->assertTrue( is_string(srly_the_post_content('hallo_world')) );
        $this->assertTrue( is_bool(srly_has_the_featured_image( $post )) );
        $this->assertTrue( is_string(srly_get_featured_image( $post)) );
        $this->assertTrue( is_bool(srly_the_featured_image($post)));
        $this->assertTrue( is_string(srly_get_short_link( 'sample.com/path?var1=5' )) );
        $this->assertTrue( is_bool(srly_the_short_link( 'sample.com/path?var1=5' )) );
        $this->assertTrue( is_string(srly_get_qrcode_link('var=3')) );
        $this->assertTrue( is_bool(srly_the_qrcode_link('var=3' )) );
        $this->assertTrue( is_bool(srly_enqueue_theme_assets()) );
    }
}
