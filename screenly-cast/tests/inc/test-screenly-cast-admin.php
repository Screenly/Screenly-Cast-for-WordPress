<?php
use PHPUnit\Framework\TestCase;

/**
 * ScreenlyCastTest class test for admin user..
 *
 * @category PHP
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
    
    public function remove_admin_user() {
        parent::tearDown();
    }
    
    public function testparseQuery() {
        if (isset($wp_query->query['srly'])) {
            $this->assertTrue(has_filter('template_include'));
        } else {
            $this->assertFalse(has_filter('template_include'));
            $wp_query->query['srly']='';
        }
    }
    
    public function testtemplateInclude() {
        $this->assertEquals("sample_template",ScreenlyCast::templateInclude("sample_template"));
    }
        
}