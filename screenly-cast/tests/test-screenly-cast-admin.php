<?php
use PHPUnit\Framework\TestCase;

/**
     *  This Class tests the admin user in class ScreenlyCast.
     *  @package ScreenlyCast
     *  @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @group   ScreenlyCast_initialization_and_setting
     *  @test 
     * 
*/
class ScreenlyCastAdminTest extends WP_UnitTestCase {
    /**
     *  This method sets up the environment by creating an admin user who is needed to run the methods in this class.
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test 
     * 
    */

    public function setup() {
        parent::setUp();
        $user_id = $this->factory->user->create(["role"=>'administrator']);
        $user = wp_get_current_user($user_id);
        set_current_screen('edit-post');
    }
    
     /**
     *  This method is a PHPUnit function runs after the test method runs e.g. ScreenlyCastAdminTest::testparseQuery() it is intended to destroy the environment set by setup() method.
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
     *  This method tests if ScreenlyCast::parseQuery execute without an error for admin users
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test 
     *  @return boolean Returns true if all tests are passed, on failiure the function returns a string describing the kind of error that occured.
     * 
    */
    public function testparseQuery() {
        if (isset($wp_query->query['srly'])) {
            $this->assertTrue(has_filter('template_include'));
        } else {
            $this->assertFalse(has_filter('template_include'));
        }
    }
    
    /**
     *  This method tests if ScreenlyCast::templateInclude execute without an error for admin users
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test 
     *  @return boolean Returns true if all tests are passed, on failiure the function returns a string describing the kind of error that occured.
     * 
    */
    
    public function testtemplateInclude() {
        $this->assertEquals("sample_template",ScreenlyCast::templateInclude("sample_template"));
    }
}
