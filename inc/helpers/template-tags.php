<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Designfly
 */

/**
 * Gets the thumbnail with Lazy Load.
 * Should be called in the WordPress Loop.
 *
 * @param int|null $post_id               Post ID.
 * @param string   $size                  The registered image size.
 * @param array    $additional_attributes Additional attributes.
 *
 * @return string
 */
function designfly_get_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	$custom_thumbnail = '';

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$default_attributes = [
			'loading' => 'lazy',
		];

		$attributes = array_merge( $additional_attributes, $default_attributes );

		$custom_thumbnail = wp_get_attachment_image(
			get_post_thumbnail_id( $post_id ),
			$size,
			false,
			$attributes
		);
	}

	return $custom_thumbnail;
}

/**
 * Renders Custom Thumbnail with Lazy Load.
 *
 * @param int    $post_id               Post ID.
 * @param string $size                  The registered image size.
 * @param array  $additional_attributes Additional attributes.
 */
function designfly_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	printf( designfly_get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
/**
 * Display post posted date.
 *
 * @return void
 */
function designfly_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date( 'j M Y' ) ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date( 'j M Y' ) )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( ' on %s', 'post date', 'designfly' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	printf( '<span class="posted-on">%s</span>', $posted_on ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Prints HTML with meta information for the current author.
 */
function designfly_posted_by() {

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'designfly' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	printf( '<span class="byline"> %s</span>', $byline ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function designfly_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'designfly' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'designfly' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'designfly' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'designfly' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'designfly' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'designfly' ),
				[
					'span' => [
						'class' => [],
					],
				]
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

}

/**
 * Get site title.
 *
 * @param string $title_class Show or hide title.
 *
 * @return void
 */
function designfly_site_title( $title_class = '' ) {
	$title_format = '<h2 class="site-title %s"><a href="%s" rel="home">%s</a></h2>';

	if ( is_front_page() && is_home() ) {
		$title_format = '<h1 class="site-title %s"><a href="%s" rel="home">%s</a></h1>';
	}

	printf(
		$title_format, // phpcs:ignore
		esc_attr( $title_class ),
		esc_url( home_url( '/' ) ),
		get_bloginfo( 'name', 'display' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}

/**
 * Get site description.
 *
 * @return void
 */
function designfly_site_description() {
	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		printf(
			'<p class="site-description">%s</p>',
			$description // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
}

/**
 * Get the trimmed version of post excerpt.
 *
 * This is for modifing manually entered excerpts,
 * NOT automatic ones WordPress will grab from the content.
 *
 * It will display the first given characters ( e.g. 100 ) characters of a manually entered excerpt,
 * but instead of ending on the nth( e.g. 100th ) character,
 * it will truncate after the closest word.
 *
 * @param int $trim_character_count Charter count to be trimmed.
 *
 * @return bool|string
 */
function designfly_the_excerpt( $trim_character_count = 0 ) {
	if ( ! has_excerpt() || 0 === $trim_character_count ) {
		the_excerpt();
		return;
	}

	$excerpt = wp_strip_all_tags( get_the_excerpt() );
	$excerpt = substr( $excerpt, 0, $trim_character_count );
	$excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

	printf( '<span class="excerpt"> %s</span>', $excerpt . '.' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 */
function designfly_excerpt_more( $more = '' ) {

	if ( ! is_single() ) {
		$more = sprintf(
			'<a class="designfly-read-more " href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read more', 'designfly' )
		);
	}

	printf( '<span class="excerpt__more"> %s</span>', $more ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Designfly Pagination.
 *
 * @return void
 */
function designfly_pagination() {

	$allowed_tags = [
		'span' => [
			'class' => [],
		],
		'a'    => [
			'class' => [],
			'href'  => [],
		],
		'img' => [
			'src'   => [],
			'class' => [],
			'alt'   => [],
		],
	];

	printf(
		'<nav class="designfly-pagination clearfix">%s</nav>',
		wp_kses(
			paginate_links(
				array(
					'prev_text' => '<img class="pagination-arrow-left" alt="prev" src="' . get_template_directory_uri() . '/assets/src/img/pagination-arrow-prev.png" />',
					'next_text' => '<img class="pagination-arrow-right" alt="next" src="' . get_template_directory_uri() . '/assets/src/img/pagination-arrow-next.png" />',
				)
			),
			$allowed_tags
		)
	);
}

/**
 * Designfly Pagination for Portfolio Items.
 *
 * @param Object $custom_query requires the query object to get pagination.
 */
function designfly_portfolio_pagination( $custom_query ) {

	$total_pages = $custom_query->max_num_pages;
	$big         = 999999999; // need an unlikely integer.

	if ( $total_pages > 1 ) {
		$current_page = max( 1, get_query_var( 'paged' ) );

		$pages = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => $current_page,
				'total'     => $total_pages,
				'type'      => 'array',
				'prev_text' => '<img class="pagination-arrow-left" alt="prev" src="' . get_template_directory_uri() . '/assets/src/img/pagination-arrow-prev.png" />',
				'next_text' => '<img class="pagination-arrow-right" alt="next" src="' . get_template_directory_uri() . '/assets/src/img/pagination-arrow-next.png" />',
			)
		);

		/* for echoing out with custom html tags */
		if ( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged' ) === 0 ) ? 1 : get_query_var( 'paged' );
			foreach ( $pages as $page ) {
					echo wp_kses_post( $page );
			}
		}
	}
}

/**
 * Displays custom comments.
 *
 * @param object  $comment comment.
 * @param array   $args standard arguments.
 * @param integer $depth depth of the comments.
 */
function designfly_custom_comments( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>

	<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' !== $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment__conatiner">
		<?php endif; ?>
		<div class = "comment__icon">
			<p>&#128172</p>
		</div>
		<div class = "comment__body">
			<p class="comment__header">
				<?php
				/* translators: 1: Author*/
				printf( wp_kses_post( '<span class = "comment__author"><cite class="fn">%s</cite> <span class="author-said">said on </span></span>' ), get_comment_author_link() );
				?>

			<span class="comment__meta ">
				<?php
				/* translators: 1: date, 2: time */
				printf( esc_html_x( '%1$s at %2$s', 'post date', 'designfly' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
				?>
				<?php
				edit_comment_link( __( '(Edit)', 'designfly' ), '  ', '' );
				?>
				</span>
			</p>

			<?php if ( '0' === $comment->comment_approved ) : ?>
					<em class="comment--awaiting-moderation">
						<?php esc_attr_e( 'Your comment is awaiting moderation.', 'designfly' ); ?>
					</em>
					<br />
			<?php endif; ?>

			<div class="comment__content">
				<?php comment_text(); ?>
			</div>

			<div class="comment__reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below'  => $add_below,
							'reply_text' => '&#10150 reply',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						)
					)
				);
				?>
			</div>
		</div>
	<?php if ( 'div' !== $args['style'] ) : ?>
	</div>

	<?php endif; ?>
	<?php
}

/**
 * Set post views count using post meta
 *
 * @param int $post_id Post ID.
 */
function designfly_set_post_views( $post_id ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $post_id, $count_key, true );
	if ( '' === $count ) {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}

/**
 * Copyright text.
 */
function designfly_copyright_text() {
	$theme_uri = 'https://rtcamp.com/';

	$default = sprintf(
		/* translators: 1: Theme name, 2: Theme copyright date, 3: Theme author. */
		esc_html__( '&copy; %1$s %2$s by %3$s', 'designfly' ),
		date_i18n(
			/* translators: Copyright date format, see https://secure.php.net/date */
			_x( 'Y', 'copyright date format', 'designfly' )
		),
		esc_html__( 'Designfly', 'designfly' ),
		'<a href="' . esc_url( $theme_uri ) . '" rel="designer">' . esc_html__( 'rtCamp', 'designfly' ) . '</a>'
	);

	echo $default; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
