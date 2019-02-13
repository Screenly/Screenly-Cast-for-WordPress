<?php header('Content-type: text/css'); 
/**
Theme Name: Screenly Cast for WordPress
Theme URI: https://github.com/Screenly/Screenly-Cast-for-WordPress
Description: WordPress plugin to enable direct cast of pages, posts and media on Screenly devices.
Author: Screenly, Inc
Author URI: http: //www.screenly.io
Version: VERSION_PLACEHOLDER
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: full-page, screenly, tv, digital-signage, no-intereact, zero-ui
Text Domain: screenly-cast
*/

require_once dirname(__FILE__).'/../../inc/functions.php';

$srly_css_values = srly_get_css_values();
$srly_body_color=$srly_css_values['srly_body_color'];
$srly_body_font_size=$srly_css_values['srly_body_font_size'];
$srly_body_font_weight=$srly_css_values['srly_body_font_weight'];
$srly_body_font_family=$srly_css_values['srly_body_font_family'];
$srly_body_background=$srly_css_values['srly_body_background'];

//logo
$srly_brand_logo_width=$srly_css_values['srly_brand_logo_width'];
$srly_brand_logo_height=$srly_css_values['srly_brand_logo_height'];
$srly_brand_logo_display=$srly_css_values['srly_brand_logo_display'];
$srly_brand_logo_left = $srly_css_values['srly_brand_logo_left'];
$srly_brand_logo_top = $srly_css_values['srly_brand_logo_top'];
$srly_brand_logo_z_index = $srly_css_values['srly_brand_logo_z_index'];
$srly_brand_logo_position = $srly_css_values['srly_brand_logo_position'];

//h1
$srly_h1_margin =$srly_css_values['srly_h1_margin'];
$srly_h1_padding =$srly_css_values['srly_h1_padding'];
$srly_h1_font_size =$srly_css_values['srly_h1_font_size'];
$srly_h1_font_weight =$srly_css_values['srly_h1_font_weight'];
$srly_h1_color=$srly_css_values['srly_h1_color'];

$srly_time_color=$srly_css_values['srly_time_color'];
$srly_time_display=$srly_css_values['srly_time_display'];
$srly_time_font_size=$srly_css_values['srly_time_font_size'];
$srly_time_font_weight=$srly_css_values['srly_time_font_weight'];

$srly_a_color=$srly_css_values['srly_a_color'];
$srly_a_text_decoration=$srly_css_values['srly_a_text_decoration'];
$srly_a_font_weight=$srly_css_values['srly_a_font_weight'];
$srly_a_font_size=$srly_css_values['srly_a_font_size'];

$srly_content_margin_top=$srly_css_values['srly_content_margin_top'];
$srly_content_line_height=$srly_css_values['srly_content_line_height'];
$srly_content_color=$srly_css_values['srly_content_color'];
$srly_content_font_weight=$srly_css_values['srly_content_font_weight'];
$srly_content_font_size=$srly_css_values['srly_content_font_size'];

$srly_blockquote_font_weight=$srly_css_values['srly_blockquote_font_weight'];
$srly_blockquote_font_style=$srly_css_values['srly_blockquote_font_style'];
$srly_blockquote_letter_spacing=$srly_css_values['srly_blockquote_letter_spacing'];
$srly_blockquote_font_size=$srly_css_values['srly_blockquote_font_size'];

$srly_h23456_margin =$srly_css_values['srly_h23456_margin'];
$srly_h23456_font_weight =$srly_css_values['srly_h23456_font_weight'];

$srly_h2_font_size=$srly_css_values['srly_h2_font_size'];
$srly_h4_font_size=$srly_css_values['srly_h4_font_size'];

$srly_h5_color=$srly_css_values['srly_h5_color'];
$srly_h5_font_size=$srly_css_values['srly_h5_font_size'];
$srly_h5_font_weight=$srly_css_values['srly_h5_font_weight'];

$srly_h6_font_size=$srly_css_values['srly_h6_font_size'];
$srly_h6_font_weight=$srly_css_values['srly_h6_font_weight'];
$srly_h6_text_transform=$srly_css_values['srly_h6_text_transform'];

$srly_b_strong_font_weight=$srly_css_values['srly_b_strong_font_weight'];

$srly_ul_ol_padding_left=$srly_css_values['srly_ul_ol_padding_left'];

$srly_ul_list_style_type=$srly_css_values['srly_ul_list_style_type'];

$srly_ul_li_padding_left=$srly_css_values['srly_ul_li_padding_left'];

$srly_h3_color=$srly_css_values['srly_h3_color'];
$srly_h3_font_size=$srly_css_values['srly_h3_font_size'];
$srly_h3_font_weight=$srly_css_values['srly_h3_font_weight'];
?>

html, body
{
    margin: 0;
    padding: 0;
    width: 98%;
    height: 100%;
    color: <?= $srly_body_color ?>;
    font-size: <?= $srly_body_font_size ?>;
    font-weight: <?= $srly_body_font_weight ?>;
    letter-spacing: 0.04em;
    font-family:<?= $srly_body_font_family ?>;
}

body
{
    width: 98%;
    height: 100%;
    background: <?= $srly_body_background ?>;
}

/*
 * There is no interaction so let's improve performance by
 * reducing interaction events
*/

body:not(.debug)
{
    user-select: none;
    pointer-events: none;
}

h1
{
    margin: <?= $srly_h1_margin ?>;
    padding: <?= $srly_h1_padding ?>;
    font-size: <?= $srly_h1_font_size ?>;
    text-indent: -.7%;
    font-weight: <?= $srly_h1_font_weight ?>;
    color: <?= $srly_h1_color ?>;
}

h2, h3, h4, h5, h6
{
    margin: <?= $srly_h23456_margin ?>;
    font-weight: <?= $srly_h23456_font_weight ?>;
}

h2 {
    font-size: <?= $srly_h2_font_size ?>;
}

h3 {
    color: <?= $srly_h3_color ?> ;
    font-size: <?= $srly_h3_font_size ?>;
    font-weight: <?= $srly_h3_font_weight ?>;
}

h4 {
    font-size: <?= $srly_h4_font_size ?>;
}

h5 {
    color: <?= $srly_h5_color ?>;
    font-size: <?= $srly_h5_font_size ?>;
    font-weight: <?= $srly_h5_font_weight ?>;
}

h6 {
    font-size: <?= $srly_h6_font_size ?>;
    font-weight: <?= $srly_h6_font_weight ?>;
    text-transform: <?= $srly_h6_text_transform ?>;
}

blockquote
{
    font-weight: <?= $srly_blockquote_font_weight ?>;
    font-style: <?= $srly_blockquote_font_style ?>;
    letter-spacing: <?= $srly_blockquote_letter_spacing ?>;
    font-size: <?= $srly_blockquote_font_size ?>;
}

p
{
    margin: .3em 0;
}

a
{
    color: <?= $srly_a_color ?>;
    text-decoration: <?= $srly_a_text_decoration ?> ;
    font-weight:<?= $srly_a_font_weight ?>;
    font-size;<?= $srly_a_font_size ?>;
}

b, strong
{
    font-weight: <?= $srly_b_strong_font_weight ?>;
}

ul, ol
{
    padding-left: <?= $srly_ul_ol_padding_left ?>;
}

ul
{
    list-style-type: <?= $srly_ul_list_style_type ?>;
}

ul li
{
    padding-left: <?= $srly_ul_li_padding_left ?>;
}

ul li:before
{
    content: '○';
    left: -20px;
    font-size: 3vw;
    line-height: 0;
    color: #00b6d4;
    margin-left: -10px;
    position: relative;
    vertical-align: middle;
}

ul li + li,
ol li + li
{
    margin-top: 10px;
}

time
{
    color: <?= $srly_time_color ?>;
    display: <?= $srly_time_display ?>;
    font-size: <?= $srly_time_font_size ?>;
    font-weight: <?= $srly_time_font_weight ?>;
    letter-spacing: 0;
}

#brand-logo
{
    left: <?= $srly_brand_logo_left ?>;
    top: <?= $srly_brand_logo_top ?>;
    width: <?= $srly_brand_logo_width ?>;
    height: <?= $srly_brand_logo_height ?>;
    z-index: <?= $srly_brand_logo_z_index?>;
    display: <?=  $srly_brand_logo_display ?>;
    position: <?= $srly_brand_logo_position ?>;
}



.figure
{
    top: 0;
    left: 0;
    right: 50%;
    bottom: 0;
    margin: 0;
    padding: 0;
    position: absolute;
    background-color: black;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
}

.figure img
{
    width: 100%;
    height: auto;
}

article
{
    top: 0;
    left: 0;
    right: 0;
    bottom: 5%;
    overflow: hidden;
    padding: 5% 5% 0 5%;
    position: absolute;
}

.figure + article
{
    left: 50%;
}

.content
{
    margin-top: <?= $srly_content_margin_top ?>;
    line-height: <?= $srly_content_line_height ?>;
    color: <?= $srly_content_color ?>;
    font-weight: <?= $srly_content_font_weight ?>;
    font-size: <?= $srly_content_font_size ?>;
}

.qrcode
{
    position: fixed;
    bottom: 0;
    right: 0;
    max-width: 8%;
    height: auto;
    display: block;
    padding: 2%;
    background: white;
    z-index: 999;
}


#pagging
{
    left: 55%;
    bottom: 5%;
    margin: 0;
    padding: 0;
    position: fixed;
}

#pagging li
{
    margin: 0;
    padding: 0;
    width: 1.2vw;
    height: 1.2vw;
    overflow: hidden;
    list-style: none;
    border-radius: 50%;
    text-indent: -100%;
    border: 1px solid #00b6d4;
    display: inline-block;
    transition: background .4s;
}

#pagging li.active
{
    background: #00b6d4;
}

#pagging li + li
{
    margin-left: .8vw;
}

#pagging li:before
{
    content: none;
}

body.attachment #brand-logo
{
    top: 0;
    left: 5%;
    botto: auto;
}

body.attachment main:after
{
    top: 35%;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    content: '';
    display: block;
    position: absolute;

    background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);
    background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);
}

body.attachment .figure
{
    right: 0;
}

body.attachment article
{
    left: 0;
    top: auto;
    bottom: 7%;
    color: white;
    z-index: 99;
}

body.attachment article h1
{
    text-indent: 0;
    margin-bottom: 10px;
}

body.attachment article .content
{
    margin-top: 0;
}

.srly_category_nav{
    width:95%;
    position:absolute;
    bottom:20px;
    left:0%;
    right:0%;
    padding-bottom:10px;
}

.srly_category_nav_item
{
    width:15px;
    background-color:;
    margin:10px;
    color:#443344b3;
}

.srly_category_nav_item:before
{
   content:'\25CF';
   font-size:20px;
}
.srly_category_nav_item_active:before{
    content:'\25CF';
   font-size:40px;
}
.srly_category_nav_item_active{
    color:#009200;
}
section{
    display:none;
    width:95%;
}
.srly_category_nav_center{
    background-color:#fff;
    padding:30px 20px 20px 20px;
    border-radius:5px;
}

.alignleft{
	float: left;
	margin: 0.5em 1em 0.5em 0;
}
.alignright {
    float: right;
    margin: 0.5em 0 0.5em 1em;
}
.aligncenter {
    display: block;
    margin-left: auto;
    margin-right: auto;
}