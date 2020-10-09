
<?php
/**
 * Template for entry meta
 *
 * @package Designfly
 */

?>

<div class="entry-meta mb-3">
	<?php
	designfly_posted_by();
	designfly_posted_on();
	?>
	<span class="comments"><?php echo get_comments_number(); ?> Comment(s) </span>
	<hr>
</div>
