<?php
/**
 * The template for displaying search results pages.
 *
 * @package Designfly
 */

get_header();
?>

<div id="primary" class="site-primary">
	<h1>Hello</h1>
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search phrase */
					printf( esc_html__( 'Search Results for: %s', 'designfly' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	<?php designfly_pagination(); ?>
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
