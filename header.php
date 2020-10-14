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
			<form class="form-inline" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ), 'designfly' ); ?>">
				<div><label class="screen-reader-text" for="s">Search Box</label>
					<input class="form-control" type="text" value="" name="s" id="s" />
					<input class="search-button" type="submit" id="searchsubmit" value="Search" />
				</div>
			</form>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content ">
