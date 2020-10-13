<?php
/**
 * Portfolio Widget
 *
 * @package Designfly
 */

namespace DESIGNFLY\Inc;

use WP_Widget;

use DESIGNFLY\Inc\Traits\Singleton;

class Portfolio_Widget extends WP_Widget {

	use Singleton;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$designfly_widget_ops = array(
			'classname'                   => 'widget_portfolio',
			'description'                 => __( 'Your site&#8217;s Portfolio Posts.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct(
			'portfolio-posts',
			__( 'Portfolio Posts', 'designfly' ),
			$designfly_widget_ops,
		);
		$this->alt_option_name = 'widget_custom_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Portfolio', 'designfly' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 8;
		if ( ! $number ) {
			$number = 8;
		}
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$recent_posts = wp_get_recent_posts(array(
			'post_type'   => 'portfolio',
			'numberposts' => $number, // Number of recent posts thumbnails to display.
			'post_status' => 'publish', // Show only the published posts.
		));
		// before and after widget arguments are defined by themes.
		echo $args['before_widget'];
		// This is where you run the code and display the output.
		foreach ( $recent_posts as $post ) : ?>
		<div class = " portfolio--widget">
		<a href="<?php echo get_permalink( get_page_by_path( 'portfollio' ) ) ?>">
			<?php echo get_the_post_thumbnail( $post['ID'], array( 45, 45), array( 'class' => 'portfolio__img' ) ); ?>
		</a>
		</div>
		<?php
		endforeach; wp_reset_postdata();
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Portfolio';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 8;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<?php
	}
}
