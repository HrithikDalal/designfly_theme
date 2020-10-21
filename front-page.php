<?php
/**
 * Front page template
 *
 * @package Designfly
 */

get_header();
?>
		<?php
		// Portfolio Items.
		$designfly_query = new WP_Query(
			array(
				'post_type'      => 'portfolio',
				'posts_per_page' => 6,
			)
		);
		if ( $designfly_query->have_posts() ) :
			?>
				<div id="lightbox" class="lightbox">
					<div class="lightbox__content">
						<img src="" />
						<span class="close">&#10005;</span>
					</div>
				</div>
			<div id="portfolio-wrapper" class="portfolio-content">

				<!-- top bar -->
				<div class="portfolio-content-top">
					<p class="title"> D'SIGN IS THE SOUL </p>
					<a class = "portfolio__button" href="<?php echo get_permalink( get_page_by_path( 'portfollio' ) ) ?>">
					view all
					</a>

					<hr />
				</div>

				<?php
				while ( $designfly_query->have_posts() ) :
					$designfly_query->the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div> <!-- #portfolio-content -->

			<?php
		else :
			?>
			<p>
				<?php esc_html_e( 'No items found.', 'designfly' ); ?>
			</p>
			<?php
		endif;
		?>
<?php
get_footer();
