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
			<div class="portfolio-content">

				<!-- top bar -->
				<div class="portfolio-content-top">
					<p class="title"> D'SIGN IS THE SOUL </p>
					<hr />
				</div>

				<?php
				while ( $designfly_query->have_posts() ) :
					$designfly_query->the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div> <!-- #portfolio-content -->
			<div class = "designfly-pagination">
				<?php
					designfly_pagination( $designfly_query );
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
