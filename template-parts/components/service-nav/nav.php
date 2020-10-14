<?php
/**
 * Template for Services Navbar.
 *
 * @package Designfly
 */

?>

<div class = "service-nav">
	<div class="service-nav-container">
		<div class = "service__advertising">
			<div class="service__advertising__icon">
				<img src=" <?php echo wp_get_attachment_url( get_theme_mod( 'designfly-service-advertising' ) ); ?> "/>
			</div><!-- .service__advertising__icon -->
			<div class="service__advertising__content">
				<h3>Advertising</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
			</div>
		</div>
		<div class = "service__multimedia">
			<div class="service__multimedia__icon">
				<img src=" <?php echo wp_get_attachment_url( get_theme_mod( 'designfly-service-multimedia' ) ); ?> "/>
			</div>
			<div class="service__multimedia__content">
				<h3>Multimedia</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
			</div>
		</div>
		<div class = "service__photography">
			<div class="service__photography__icon">
				<img src=" <?php echo wp_get_attachment_url( get_theme_mod( 'designfly-service-photography' ) ); ?> "/>
			</div>
			<div class="service__photography__content">
				<h3>Photography</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
			</div>
		</div>
	</div>
</div>
