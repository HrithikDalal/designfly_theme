<?php
/**
 * Contains custom functions used for the theme
 *
 * @package Designfly
 */

/**
 * An extension to get_template_part function to allow variables to be passed to the template.
 *
 * @param  string $slug file slug like you use in get_template_part without php extension.
 * @param  array  $variables pass an array of variables you want to use in array keys.
 *
 * @return void
 */
function designfly_get_template_part( $slug, $variables = [] ) {
	$template         = sprintf( '%s.php', $slug );
	$located_template = locate_template( $template, false, false );

	if ( '' === $located_template ) {
		return;
	}

	if ( ! empty( $variables ) && is_array( $variables ) ) {
		extract( $variables, EXTR_SKIP ); // @codingStandardsIgnoreLine - Used as an exception as there is no better alternative.
	}

	include $located_template;
}


/**
 * Function for registering custom post type 'portfolio'.
 *
 * @since 1.0.3
 */
function designfly_custom_post_type() {

	$labels = array(
		'name'               => esc_html__( 'Portfolio Posts', 'designfly' ),
		'singular_name'      => esc_html__( 'Portfolio Post', 'designfly' ),
		'add_new'            => esc_html__( 'Add Portfolio Item', 'designfly' ),
		'all_items'          => esc_html__( 'All Portfolio Items', 'designfly' ),
		'add_new_item'       => esc_html__( 'Add Portfolio item', 'designfly' ),
		'edit_item'          => esc_html__( 'Edit Portfolio Item', 'designfly' ),
		'new_item'           => esc_html__( 'New Portfolio Item', 'designfly' ),
		'view_item'          => esc_html__( 'View Portfolio Item', 'designfly' ),
		'search_item'        => esc_html__( 'Search Portfolio', 'designfly' ),
		'not_found'          => esc_html__( 'No portfolio items found', 'designfly' ),
		'not_found_in_trash' => esc_html__( 'No portfolio items found in trash', 'designfly' ),
		'parent_item_colon'  => esc_html__( 'Parent Item', 'designfly' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_icon'           => 'dashicons-format-image',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'revision',
		),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'menu_position'       => 5,
		'exclude_from_search' => false,
		'rewrite'             => array( 'slug' => 'portfolio' ),
		// 'show_in_rest'        => true,
	);

	register_post_type( 'portfolio', $args );
}

add_action( 'init', 'designfly_custom_post_type' );


/**
 * Function for registering custom post type 'Carousel'.
 *
 * @since 1.0.3
 */
function designfly_custom_post_type_2() {

	$labels = array(
		'name'               => esc_html__( 'Carousel Posts', 'designfly' ),
		'singular_name'      => esc_html__( 'Carousel Post', 'designfly' ),
		'add_new'            => esc_html__( 'Add Carousel Item', 'designfly' ),
		'all_items'          => esc_html__( 'All Carousel Items', 'designfly' ),
		'add_new_item'       => esc_html__( 'Add Carousel item', 'designfly' ),
		'edit_item'          => esc_html__( 'Edit Carousel Item', 'designfly' ),
		'new_item'           => esc_html__( 'New Carousel Item', 'designfly' ),
		'view_item'          => esc_html__( 'View Carousel Item', 'designfly' ),
		'search_item'        => esc_html__( 'Search Carousel', 'designfly' ),
		'not_found'          => esc_html__( 'No Carousel items found', 'designfly' ),
		'not_found_in_trash' => esc_html__( 'No Carousel items found in trash', 'designfly' ),
		'parent_item_colon'  => esc_html__( 'Parent Item', 'designfly' )
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_icon'           => 'dashicons-format-quote',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'revision',
		),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'menu_position'       => 4,
		'exclude_from_search' => false,
		'rewrite'             => array( 'slug' => 'carousel' ),
		'show_in_rest'        => true,
	);

	register_post_type( 'carousel', $args );
}

add_action( 'init', 'designfly_custom_post_type_2' );
