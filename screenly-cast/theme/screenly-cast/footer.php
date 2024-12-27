<?php
/**
 * The template for displaying the footer.
 *
 * @package ScreenlyCast
 */

?>
		</div><!-- #content -->

		<footer class="site-footer">
			<div class="site-info">
				<?php
				$screenly_link = '<a href="https://www.screenly.io">Screenly</a>';
				/* translators: %s: HTML link to Screenly website */
				echo wp_kses(
					sprintf(
						/* translators: %s: HTML link to Screenly website */
						esc_html__( 'Powered by %s', 'screenly-cast' ),
						$screenly_link
					),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				);
				?>
			</div>
		</footer>
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
