<?php
/**
 * Template Name: Portfolio Page
 *
 * Portfolio page template file.
 *
 * @package Designfly
 */

get_header();
?>
		<?php
		$designfly_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$designfly_query = new WP_Query(
			array(
				'post_type'      => 'portfolio',
				'posts_per_page' => 15,
				'paged'          => $designfly_paged,
			)
		);
		if ( $designfly_query->have_posts() ) :
			?>
			<div id="portfolio-wrapper" class="portfolio-content">

				<!-- top bar -->
				<div class="portfolio-content-top">
					<p class="title"> D'SIGN IS THE SOUL </p>
					<hr />
				</div>

				<?php
				$index = 1;
				$total_post = $designfly_query->post_count;
				while ( $designfly_query->have_posts() ) :
					if( $index === 1){
						$prev_index = $total_post;
					}
					else{
						$prev_index = $index - 1;
					}
					if( $index === $total_post){
						$next_index = 1;
					}
					else{
						$next_index = $index + 1;
					}
					$designfly_query->the_post();
					get_template_part( 'template-parts/content', get_post_type(), array(
						'id'     => $index,
						'previd' => $prev_index,
						'nextid' => $next_index,
					) );
					$index++;
				endwhile;
				?>
			</div> <!-- #portfolio-content -->
			<div class = "designfly-pagination">
				<?php
					designfly_portfolio_pagination( $designfly_query );
				?>
			</div>

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
