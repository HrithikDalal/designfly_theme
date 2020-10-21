<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Designfly
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<hr>
		<h2 class="comments-title">
			Comments
		</h2>
		<hr>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through?
			?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'designfly' ); ?></h2>
				<div class="nav-links clearfix">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'designfly' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'designfly' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php
		} // Check for comment navigation.
		?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'type' => 'comment',
					'callback' => 'designfly_custom_comments',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through?
			?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'designfly' ); ?></h2>
				<div class="nav-links clearfix">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'designfly' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'designfly' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
		} // Check for comment navigation.

	} // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'designfly' ); ?></p>
		<?php
	}
	?>
	<hr>
		<p class="post-comment"><?php esc_html_e( 'Post your comment', 'designfly' ); ?></p>
	<?php
	$comment_args=array(
		'submit_button' => '<input name="submit" type="submit" id="submit" class="submit" value="Submit" />',
	);
	comment_form($comment_args);
	?>

</div><!-- #comments -->
