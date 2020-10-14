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
			<div class = "footer-post">
				<?php
					// the query
					$the_query = new WP_Query( array(
						'posts_per_page' => 1,
					) );

					if ( $the_query->have_posts() ) :
						$the_query->the_post();
				?>
						<p class="title"><a href="<?php echo get_post_permalink(); ?>"><?php echo get_the_title(); ?> </a></p>
						<p class="para"> <?php echo get_the_excerpt(); ?> </p>
				<?php
					wp_reset_postdata();

					else :
						__('No Posts found');
					endif;
				?>
			</div>
			<div class="footer__contact">
				<p class="contact__title"><?php esc_html_e( 'Contact Us', 'designfly' ); ?></p>
				<p class="contact__address"> <?php echo get_theme_mod( 'designfly-footer-contact' ); ?>
			</div>
		</div>
		<div class="site-info text-center">
			<span><?php designfly_copyright_text(); ?></span>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
