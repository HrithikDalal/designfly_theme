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
					<a class = "portfolio__button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'portfollio' ) ) ); ?>">
					view all
					</a>

					<hr />
				</div>

				<?php
				$designfly_index      = 1;
				$designfly_total_post = $designfly_query->post_count;
				while ( $designfly_query->have_posts() ) :
					if ( 1 === $designfly_index ) {
						$designfly_prev_index = $designfly_total_post;
					} else {
						$designfly_prev_index = $designfly_index - 1;
					}
					if ( $designfly_index === $designfly_total_post ) {
						$designfly_next_index = 1;
					} else {
						$designfly_next_index = $designfly_index + 1;
					}
					$designfly_query->the_post();
					get_template_part(
						'template-parts/content',
						get_post_type(),
						array(
							'id'     => $designfly_index,
							'previd' => $designfly_prev_index,
							'nextid' => $designfly_next_index,
						)
					);
					$designfly_index++;
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
