<?php
/**
 * Template for entry meta
 *
 * @package Designfly
 */

?>

<div class="entry-meta">
	<?php
	designfly_posted_by();
	designfly_posted_on();
	?>
	<span class="comments"><?php echo wp_kses_post( get_comments_number() ); ?> Comment(s) </span>
	<hr>
</div>
