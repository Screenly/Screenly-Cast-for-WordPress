<?php
/**
 * Class testThemeFunctions
 *
 * @package ScreenlyCast
 */

require_once SRLY_THEME_DIR.'/functions.php';
/**
 * Begin the testing
 */
class TestThemeFunctions extends WP_UnitTestCase {

    public function setup() {
        parent::setUp();
        
    }
    
    public function tearDown() {
        parent::tearDown();
    }
    /**
     * 
     */
    public function testscreenlyCast() {
        $postId = $this->factory->post->create();
        $post = get_post($postId );
        
        $this->assertTrue( is_string(srlyAllowedContentTags()) );
        $this->assertTrue( is_string(srlyThePostContent('hallo_world')) );
        $this->assertTrue( is_bool(srlyHasTheFeaturedImage( $post )) );
        $this->assertTrue( is_string(srlyGetFeaturedImage( $post)) );
        $this->assertTrue( is_bool(srlyTheFeaturedImage($post)));
        $this->assertTrue( is_string(srlyGetShortLink( 'sample.com/path?var1=5' )) );
        $this->assertTrue( is_bool(srlyTheShortLink( 'sample.com/path?var1=5' )) );
        $this->assertTrue( is_string(srlyGetQrcodeLink('var=3')) );
        $this->assertTrue( is_bool(srlyTheQrcodeLink('var=3' )) );
        $this->assertTrue( is_bool(srlyEnqueueThemeAssets()) );       
            
    }
}
