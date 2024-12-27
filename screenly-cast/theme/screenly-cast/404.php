<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package ScreenlyCast
 */

get_header();

?>

<div class="content-area">
	<main class="site-main">
		<?php
		if ( ! have_posts() || ! is_404() ) {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>
	</main>
</div>

<?php
get_footer();
