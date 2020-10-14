<?php
/**
 * Template for post entry header
 *
 * @package Designfly
 */

$designfly_the_post_id   = get_the_ID();
$designfly_hide_title    = get_post_meta( $designfly_the_post_id, '_hide_page_title', true );
$designfly_heading_class = ( ! empty( $designfly_hide_title ) && 'yes' === $hide_title ) ? 'hide d-none' : '';

$designfly_has_post_thumbnail = get_the_post_thumbnail( $designfly_the_post_id );

?>
<header class="entry-header">
	<?php

	// Title.
	if ( is_single() || is_page() ) {
		printf(
			'<h1 class="page-title %1$s">%2$s</h1>',
			esc_attr( $designfly_heading_class ),
			wp_kses_post( get_the_title() )
		);
	} else {
		?>
		<div class="blog__post__date">
			<div><?php echo get_the_date( 'd' ); ?></div>
			<div><?php echo get_the_date( 'M' ); ?></div>
		</div>
		<?php
		printf(
			'<h2 class="entry-title mb-3"><a href="%1$s">%2$s</a></h2>',
			esc_url( get_the_permalink() ),
			wp_kses_post( get_the_title() )
		);
	}

	// Featured image.
	if ( ! is_single() && $designfly_has_post_thumbnail ) {
		?>
		<div class="entry-image mb-3">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php
				designfly_the_post_custom_thumbnail(
					$designfly_the_post_id,
					'featured-thumbnail',
					array(
						'sizes' => '(max-width: 350px) 350px, 233px',
						'class' => 'blog__attachment',
					)
				)
				?>
			</a>
		</div>
		<?php
	}

	?>
</header>
