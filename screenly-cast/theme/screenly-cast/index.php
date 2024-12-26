<?php
/**
 * The main template file
 *
 * @package ScreenlyCast
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</main>
</div>

<?php get_footer(); ?>
