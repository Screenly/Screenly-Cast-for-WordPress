<?php
/**
 * The main template file
 *
 * @package ScreenlyCast
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
  Template Name: Homepage
*/
require_once 'header.php';
?>

<main>
	<?php
	if ( have_posts() ) :
		the_post();
		?>
	<section>

		<?php if ( srly_has_the_featured_image() ) : ?>
		<div class="figure"<?php srly_the_featured_image(); ?>></div>
		<?php endif; ?>

		<article>
			<h1><?php the_title(); ?></h1>
			<time datetime="<?php echo get_the_date( 'T Y-m-d H:i' ); ?>">
				<?php the_date( 'M d Y' ); ?>
			</time>
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
