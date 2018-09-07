<?php
use PHPUnit\Framework\TestCase;

/**
     *  This Class tests the normal(non-admin) user in class ScreenlyCast.
     *  @package ScreenlyCast
     *  @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @group   ScreenlyCast_initialization_and_setting
     *  @test 
     * 
*/
class ScreenlyCastTest extends WP_UnitTestCase
{
    /**
     *  This method is a PHPUnit function runs before the test method runs e.g. ScreenlyCastTest::testadminInit() it is intended to set up the right environment for the test to run.
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
     *  This method is a PHPUnit function runs after the test method runs e.g. ScreenlyCastTest::testadminInit() it is intended to destroy the environment set by setup() method.
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
     *  This method tests if ScreenlyCast::adminInit execute without an erro
     * * 1. When the PHP version is compatible and
     * * 2. When the PHP version is not compatible in two cases
     * 
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test 
     *  @return boolean Returns true if all tests are passed, on failiure the function returns a string describing the kind of error that occured.
     * 
    */
    
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
       
    /**
     *  This method tests
     * 1. If ScreenlyCast::init execute without an error
     * 2. If file SRLY_PLUGIN_DIR.'/inc/screenly-cast-settings.php' exists
     * 
     *  @package ScreenlyCast
     *  @author Gilbert Karogo <gilbertkarogo@gmail.com>
     *  @uses PHPunit A testing framework
     *  @test 
     *  @return boolean Returns true if all tests are passed, on failiure the function returns a string describing the kind of error that occured.
     * 
    */
    public function testinit() {
        
        $this->assertFileExists(SRLY_PLUGIN_DIR.'/inc/screenly-cast-settings.php');
        $this->assertTrue(ScreenlyCast::init());
    }
     
    /**
     * This method tests if ScreenlyCast::templateInclude execute without an error
     * 1. If ScreenlyCast::init execute without an error
     * 2. If file SRLY_PLUGIN_DIR.'/inc/screenly-cast-settings.php' exists
     * 
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
