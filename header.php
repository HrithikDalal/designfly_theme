<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Designfly
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site grid-wrapper">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'designfly' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( get_theme_mod( 'custom_logo' ) ) {
				the_custom_logo();
				designfly_site_title( 'screen-reader-text' );
			} else {
				designfly_site_title();
			}

			designfly_site_description();
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="designfly-main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'designfly' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'primary-menu menu',
					'depth'          => 3,
				)
			);
			?>
			<form class="navigation__form" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ), 'designfly' ); ?>">
				<label class="screen-reader-text" for="search-box">Search Box</label>
				<input class="navigation__form__box" type="text" value="" name="s" id="search-box" />
				<?php
				if ( wp_get_attachment_url( get_theme_mod( 'designfly-site-navigation' ) ) === false ) {
					?>
					<input id="searchsubmit" class="navigation__form__button" type="image" alt="Search" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/src/img/search-icon.png" />
					<?php
				} else {
					?>
					<input id="searchsubmit" class="navigation__form__button" type="image" alt="Search" src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-site-navigation' ) ) ); ?>" />
					<?php
				}
				?>
			</form>
		</nav><!-- #site-navigation -->
		<button id = "navigation--togller" class="navigation--togller">&#9776;</button>
	</header><!-- #masthead -->

	<!-- Home Page Carasoul -->
	<?php
	if ( is_front_page() ) :
		?>
		<div class="header-img" >
		<!-- Carousel Posts -->
			<?php
			$designfly_carousel_query = new WP_Query(
				array(
					'post_type' => 'carousel',
				)
			);
			if ( $designfly_carousel_query->have_posts() ) :
				?>
				<div id="carousel__container" class="carousel__content">
				<?php
				if ( wp_get_attachment_url( get_theme_mod( 'designfly-carousel-slider-left' ) ) === false ) {
					?>
					<input id="carousel__button--left" class="carousel__button--left" type="image" alt="Prev" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/src/img/slider-arrow-left.png" />
					<?php
				} else {
					?>
					<input id="carousel__button--left" class="carousel__button--left" type="image" alt="Prev" src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-carousel-slider-left' ) ) ); ?>" />
					<?php
				}
				if ( wp_get_attachment_url( get_theme_mod( 'designfly-carousel-slider-right' ) ) === false ) {
					?>
					<input id="carousel__button--right" class="carousel__button--right" type="image" alt="Next" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/src/img/slider-arrow-right.png" />
					<?php
				} else {
					?>
					<input id="carousel__button--right" class="carousel__button--right" type="image" alt="Next" src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-carousel-slider-right' ) ) ); ?>" />
					<?php
				}
				while ( $designfly_carousel_query->have_posts() ) :
					$designfly_carousel_query->the_post();
					?>
						<div class="carousel__slides">
							<div class="carousel__slides__title">
								<?php the_title(); ?>
							</div>
							<div class="carousel__slides__content">
								<?php the_content(); ?>
							</div>
						</div>
					<?php
				endwhile;
				?>
				</div>
				<?php
			else :
				?>
				<p>
					<?php esc_html_e( 'No portfolio items found. Please add some portfolio items in admin-dashboard', 'designfly' ); ?>
				</p>
				<?php
			endif;
			?>
		</div>
	<?php endif; ?>


	<!-- #Services Header -->
	<div class = "service-nav">
		<div class="service-nav-container">
			<div class = "service">
				<div class="service__icon" >
					<a href = '#'>
					<?php
					if ( wp_get_attachment_url( get_theme_mod( 'designfly-service-1-icon' ) ) === false ) {
						echo wp_kses_post( '<img alt="Service Icon" src="' . get_template_directory_uri() . '/assets/src/img/service-icon-1.png" />' );
					} else {
						?>
						<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-service-1-icon' ) ) ); ?> "/>
						<?php
					}
					?>
					</a>
				</div>
				<a href = '#' class="service__content">
					<h3><?php echo wp_kses_post( get_theme_mod( 'designfly-service-1-heading' ) ); ?></h3>
					<p><?php echo wp_kses_post( get_theme_mod( 'designfly-service-1-content' ) ); ?></p>
				</a>
			</div>
			<div class = "service">
				<div class="service__icon">
					<a href = '#'>
					<?php
					if ( wp_get_attachment_url( get_theme_mod( 'designfly-service-2-icon' ) ) === false ) {
						echo wp_kses_post( '<img alt="Service Icon" src="' . get_template_directory_uri() . '/assets/src/img/service-icon-2.png" />' );
					} else {
						?>
						<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-service-2-icon' ) ) ); ?> "/>
						<?php
					}
					?>
					</a>
				</div>
				<a href = '#' class="service__content">
				<h3><?php echo wp_kses_post( get_theme_mod( 'designfly-service-2-heading' ) ); ?></h3>
					<p><?php echo wp_kses_post( get_theme_mod( 'designfly-service-2-content' ) ); ?></p>
				</a>
			</div>
			<div class = "service">
				<div class="service__icon">
					<a href = '#'>
					<?php
					if ( wp_get_attachment_url( get_theme_mod( 'designfly-service-3-icon' ) ) === false ) {
						echo wp_kses_post( '<img alt="Service Icon" src="' . get_template_directory_uri() . '/assets/src/img/service-icon-3.png" />' );
					} else {
						?>
						<img src=" <?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'designfly-service-3-icon' ) ) ); ?> "/>
						<?php
					}
					?>
					</a>
				</div>
				<a href = '#' class="service__content">
				<h3><?php echo wp_kses_post( get_theme_mod( 'designfly-service-3-heading' ) ); ?></h3>
					<p><?php echo wp_kses_post( get_theme_mod( 'designfly-service-3-content' ) ); ?></p>
				</a>
			</div>
		</div>
	</div><!-- #Services Header -->


	<div id="content" class="site-content ">
