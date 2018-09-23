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
            <?php the_content();?>
        </article>
        
    </section>
    <?php 
    $srly_category_section_id++;
    endwhile;
    srlyCategoryBottomNavigation($srly_category_section_id);
    endif; ?>
</main>

<script type="text/javascript">
srly_category_switch_period= <?php echo get_option('srly_category_switch_period'); ?>

</script>

<?php
/**
 * Require footer
 */
require_once 'footer.php';
?>
