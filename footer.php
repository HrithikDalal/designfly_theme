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

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>
	<?php } ?>

	<p class="contact__title"><?php esc_html_e( 'Contact Us', 'designfly' ); ?></p>
	<p class="contact__address"> <?php echo get_theme_mod( 'designfly-footer-contact' ); ?>

	<div class="site-info text-center">
		<span><?php designfly_copyright_text(); ?></span>
	</div><!-- .site-info -->

</footer><!-- #colophon -->
</div><!-- #page -->
	</div>
<?php wp_footer(); ?>

</body>
</html>
