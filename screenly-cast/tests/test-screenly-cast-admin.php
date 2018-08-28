<?php
use PHPUnit\Framework\TestCase;

/**
 * ScreenlyCastTest class test for admin user..
 *
 * @package  ScreenlyCast
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 * @group   ScreenlyCast_initialization_and_setting
 */
class ScreenlyCastAdminTest extends WP_UnitTestCase {

    public function setup() {
        parent::setUp();
        $user_id = $this->factory->user->create(["role"=>'administrator']);
        $user = wp_get_current_user($user_id);
        set_current_screen('edit-post');
    }
    
    public function tearDown() {
        parent::tearDown();
    }
    /*
         * 
         * Test if ScreenlyCast::parseQuery execute without an error
         * for admin users
         * 
    */
    public function testparseQuery() {
        if (isset($wp_query->query['srly'])) {
            $this->assertTrue(has_filter('template_include'));
        } else {
            $this->assertFalse(has_filter('template_include'));            
        }
    }
    
    /*
         * 
         * Test if ScreenlyCast::templateInclude execute without an error
         * for admin users
         * 
    */
    
    public function testtemplateInclude() {
        $this->assertEquals("sample_template",ScreenlyCast::templateInclude("sample_template"));
    }
}