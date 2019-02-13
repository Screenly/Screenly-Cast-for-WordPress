<?php
/**
 * Main file for archive, page and single posts
 *
 * PHP version 5
 *
 * @category PHP
 * @package  ScreenlyCast
 * @author   Peter Monte <pmonte@screenly.io>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html  GPLv2
 * @link     https://github.com/Screenly/Screenly-Cast-for-WordPress
 * @since    0.0.1
 */
defined('ABSPATH') or die("No script kiddies please!");

/**
  Template Name: Homepage
*/
require_once 'header.php';
?>

<main>
    <?php 

    $srly_category_section_id = 0;
	
    if (have_posts()) : 
        while(have_posts()) : the_post();     
    ?>
	
			<section id="srly_category_section_<?php echo $srly_category_section_id; ?>">
				
				<?php if (srlyHasTheFeaturedImage()) : ?>
				<div class="figure"<?php srlyTheFeaturedImage();?>></div>
				<?php endif; ?>

				<article>
					<h1><?php the_title();?></h1>
					<time datetime="<?php echo get_the_date('T Y-m-d H:i'); ?>">
						<?php the_date('M d Y'); ?>
					</time>
					<?php the_content();

					?>					
				</article>
				
			</section>
			
			<?php
			
			$srly_category_section_id++;
		endwhile;
		
		srlyCategoryBottomNavigation($srly_category_section_id);
		
    endif; ?>
</main>

<script type="text/javascript">
var srly_post_ceiling = <?php 
$srly_category_section_id--;
echo $srly_category_section_id; ?> ;

var srly_category_switch_period= <?php

$get_option_srly_category_switch_period=get_option('srly_category_switch_period');

if(isset($get_option_srly_category_switch_period)){
	echo $get_option_srly_category_switch_period; 
}
else{
	echo '5000';
}
?>;

<?php $srly_css_values = srly_get_css_values(); ?>


jQuery(document).ready(function($) {

	$("html, body").css({    
		"color": "<?= $srly_css_values['srly_body_color'] ?>",
		"font-size": "<?= $srly_css_values['srly_body_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_body_font_weight'] ?>",
		"font-family": "<?= $srly_css_values['srly_body_font_family'] ?>"
	});

	$("body").css("background", "<?= $srly_css_values['srly_body_background'] ?>");

	$("h1").css({
		"margin": "<?= $srly_css_values['srly_h1_margin'] ?>",
		"padding": "<?= $srly_css_values['srly_h1_padding'] ?>",
		"font-size": "<?= $srly_css_values['srly_h1_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_h1_font_weight'] ?>",
		"color": "<?= $srly_css_values['srly_h1_color'] ?>"
	});

	$("h2, h3, h4, h5, h6").css({
		"margin": "<?= $srly_css_values['srly_h23456_margin'] ?>",
		"font-weight": "<?= $srly_css_values['srly_h23456_font_weight'] ?>"
	});

	$("h2").css("font-size", "<?= $srly_css_values['srly_h2_font_size'] ?>");

	$("h3").css({
		"color": "<?= $srly_css_values['srly_h3_color'] ?>" ,
		"font-size": "<?= $srly_css_values['srly_h3_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_h3_font_weight'] ?>"
	});

	$("h4").css("font-size", "<?= $srly_css_values['srly_h4_font_size'] ?>");

	$("h5").css({
		"color": "<?= $srly_css_values['srly_h5_color'] ?>",
		"font-size": "<?= $srly_css_values['srly_h5_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_h5_font_weight'] ?>"
	});


	$("h6").css({
		"font-size": "<?= $srly_css_values['srly_h6_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_h6_font_weight'] ?>",
		"text-transform": "<?= $srly_css_values['srly_h6_text_transform'] ?>"
	})

	$("blockquote").css({
		"font-weight": "<?= $srly_css_values['srly_blockquote_font_weight'] ?>" ,
		"font-style": "<?= $srly_css_values['srly_blockquote_font_style'] ?>",
		"letter-spacing": "<?= $srly_css_values['srly_blockquote_letter_spacing'] ?>",
		"font-size": "<?= $srly_css_values['srly_blockquote_font_size'] ?>"
	});

	$("a").css({
		"color": "<?= $srly_css_values['srly_a_color'] ?>",
		"text-decoration": "<?= $srly_css_values['srly_a_text_decoration'] ?>",
		"font-weight": "<?= $srly_css_values['srly_a_font_weight'] ?>",
		"font-size": "<?= $srly_css_values['srly_a_font_size'] ?>"
	});


	$("b, strong").css("font-weight", "<?= $srly_css_values['srly_b_strong_font_weight'] ?>");

	$("ul, ol").css("padding-left", "<?= $srly_css_values['srly_ul_ol_padding_left'] ?>");

	$("ul").css("list-style-type", "<?= $srly_css_values['srly_ul_list_style_type'] ?>");

	$("ul li").css("padding-left", "<?= $srly_css_values['srly_ul_li_padding_left'] ?>");

	$("time").css({
		"color": "<?= $srly_css_values['srly_time_color'] ?>",
		"display": "<?= $srly_css_values['srly_time_display'] ?>",
		"font-size": "<?= $srly_css_values['srly_time_font_size'] ?>",
		"font-weight": "<?= $srly_css_values['srly_time_font_weight'] ?>"
	});

	$("#brand-logo").css({
		"left": "<?= $srly_css_values['srly_brand_logo_left'] ?>",
		"top": "<?= $srly_css_values['srly_brand_logo_top'] ?>",
		"width": "<?= $srly_css_values['srly_brand_logo_width'] ?>",
		"height": "<?= $srly_css_values['srly_brand_logo_height'] ?>",
		"z-index": "<?= $srly_css_values['srly_brand_logo_z_index'] ?>",
		"display": "<?=  $srly_css_values['srly_brand_logo_display'] ?>",
		"position": "<?= $srly_css_values['srly_brand_logo_position'] ?>"
	});

	$(".content").css({
		"margin-top": "<?= $srly_css_values['srly_content_margin_top'] ?>",
		"line-height": "<?= $srly_css_values['srly_content_line_height'] ?>",
		"color": "<?= $srly_css_values['srly_content_color'] ?>",
		"font-weight": "<?= $srly_css_values['srly_content_font_weight'] ?>",
		"font-size": "<?= $srly_css_values['srly_content_font_size'] ?>"
	});
});
</script>


<?php
/**
 * Require footer
 */

require_once 'footer.php';
?>
