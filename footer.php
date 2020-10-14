<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Designfly
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<hr />
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</aside>
		<?php } ?>
		<div class="footer-content">
			<div class = "footer__post">
				<?php
					// the query.
					$designfly_the_query = new WP_Query(
						array(
							'posts_per_page' => 1,
						)
					);

					if ( $designfly_the_query->have_posts() ) :
						$designfly_the_query->the_post();
						?>
						<p class="title"><a href="<?php echo get_post_permalink(); ?>"><?php echo get_the_title(); ?> </a></p>

						<?php
						designfly_the_excerpt( 200 );
						if ( has_excerpt() ) {
							printf( '<br>' );
							designfly_excerpt_more();
						}
						wp_reset_postdata();

					else :
						__('No Posts found');
					endif;
				?>
			</div>
			<div class="footer__contact">
				<p class="contact__title"><?php esc_html_e( 'Contact Us', 'designfly' ); ?></p>
				<p>
					<span class="contact__address"><?php echo get_theme_mod( 'designfly-footer-address' ); ?></span><br>
					Tel: <span class="contact__telephone"><?php echo get_theme_mod( 'designfly-footer-telephone' ); ?></span>
					Fax: <span class="contact__fax"><?php echo get_theme_mod( 'designfly-footer-fax' ); ?></span><br>
					Email :<span class="contact__email"><?php echo get_theme_mod( 'designfly-footer-email' ); ?></span><br>
					<div>
						<img src=" <?php echo wp_get_attachment_url( get_theme_mod( 'designfly-footer-social' ) ); ?> "/>
					</div>
				</p>
			</div>
		</div>
		<hr />
		<div class="site-info text-center">
			<span><?php designfly_copyright_text(); ?></span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
