<?php
/**
 * Template part for displaying posts.
 *
 * @package ScreenlyCast
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				printf(
					'<time class="entry-date published" datetime="%1$s">%2$s</time>',
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				?>
			</div>
			<?php
		endif;
		?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content();
		else :
			the_excerpt();
			?>
			<p><a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Continue reading', 'screenly-cast' ); ?></a></p>
			<?php
		endif;
		?>
	</div>
</article>