<?php
/**
 * The template for displaying attachment pages.
 *
 * @package ScreenlyCast
 */

get_header();

?>

<div class="content-area">
	<main class="site-main">
		<?php
		if ( ! have_posts() || ! is_attachment() ) {
			get_template_part( 'template-parts/content', 'none' );
		} else {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			}
		}
		?>
	</main>
</div>

<?php
get_footer();
?>
