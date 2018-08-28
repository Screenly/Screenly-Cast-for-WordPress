<?php
use PHPUnit\Framework\TestCase;

//include_once plugin_dir_url((__FILE__)).'/screenly-cast.php';
/**
 * ScreenlyCast class test for normal user.
 *
 * @category PHP
 * @package  ScreenlyCast
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 * @group   ScreenlyCast_initialization_and_setting
 */
class ScreenlyCastTest extends WP_UnitTestCase
{
    public function setup() {
        parent::setUp();
        //$user_id = $this->factory->user->create(["role"=>'subscriber']);
        //$user = wp_get_current_user($user_id);
    }
    
    public function tearDown() {
        parent::tearDown();
    }
    
    public function testadminInit(){
        
        if(! ScreenlyCast::checkWPVersion()){
            $this->assertFalse(ScreenlyCast::adminInit());
        }
        else {
            $this->assertNull(ScreenlyCast::adminInit());
            $GLOBALS['wp_version'] = 4.0;
            $this->assertFalse(ScreenlyCast::adminInit());
        }
    }
   
    public function testinit() {
        
        $this->assertFileExists(SRLY_PLUGIN_DIR.'/inc/screenly-cast-settings.php');            
        $this->assertTrue(ScreenlyCast::init());
      
    }
         
    public function testtemplateInclude() {
       
        $this->assertEquals("sample_template",ScreenlyCast::templateInclude("sample_template"));

    }
}
