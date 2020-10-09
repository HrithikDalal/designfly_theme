<?php
/**
 * Template for entry footer.
 *
 * To be used inside of WordPress The Loop.
 *
 * @package Designfly
 */

$designfly_the_post_id   = get_the_ID();
$designfly_article_terms = wp_get_post_terms( $designfly_the_post_id, [ 'category', 'post_tag' ] );

if ( empty( $designfly_article_terms ) || ! is_array( $designfly_article_terms ) ) {
	return;
}
if ( is_single() || is_page() ) {
	?>
	<div class="entry-footer mt-4">
		<span class="post-tags">TAGS: </span>
		<?php
		foreach ( $designfly_article_terms as $designfly_key => $designfly_article_term ) {
			?>
			<a class="entry-footer-link text-black-50" href="<?php echo esc_url( get_term_link( $designfly_article_term ) ); ?>">
					<?php echo esc_html( $designfly_article_term->name ); ?>
			</a>
			<?php
		}
		?>
	</div>
<?php
}
