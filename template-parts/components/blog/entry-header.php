<?php
/**
 * Template for post entry header
 *
 * @package Designfly
 */

$designfly_the_post_id        = get_the_ID();
$designfly_has_post_thumbnail = get_the_post_thumbnail( $designfly_the_post_id );

?>
<header class="entry-header">
	<?php

	// Title.
	if ( is_single() || is_page() ) {
		printf(
			'<h1 class="page-title">%1$s</h1>',
			wp_kses_post( get_the_title() )
		);
	} else {
		?>
		<a href="<?php esc_url( the_permalink() ); ?>">
			<div class="blog__post__date">
				<div class="blog__post__day"><?php echo get_the_date( 'd' ); ?></div>
				<div class="blog__post__month"><?php echo get_the_date( 'M' ); ?></div>
			</div>
			<p class="entry-title"> <?php wp_kses_post( the_title() ); ?></p>
		</a>
		<?php
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
