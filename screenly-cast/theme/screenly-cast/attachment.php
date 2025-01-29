<?php
 /**
 * The template for displaying attachment pages.
 *
 * @package ScreenlyCast
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

/**
 * Require header
 */
require_once 'header.php';
?>
    <main>
        <?php if ( have_posts() ) : the_post(); ?>
        <section>

            <div class="figure"<?php srlyTheFeaturedImage(); ?>></div>

            <article>
                <h1><?php the_title(); ?></h1>
                <time datetime="<?php echo get_the_date( 'T Y-m-d H:i' ); ?>">
                    <?php the_date( 'M d Y' ); ?>
                </time>
                <h3><?php the_excerpt(); ?></h3>
                <?php the_content(); ?>
            </article>

        </section>
        <?php endif; ?>
    </main>

<?php
/**
 * Require footer
 */
require_once 'footer.php';
?>
