<?php
/**
 * Customizer.
 *
 * @package Designfly
 */

namespace Designfly\Inc;

use Designfly\Inc\Traits\Singleton;

/**
 * Class Customizer
 */
class Customizer {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'customize_register', [ $this, 'customize_register' ] );
		add_action( 'customize_preview_init', [ $this, 'enqueue_customizer_scripts' ] );

	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action customize_register
	 */
	public function customize_register( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				[
					'selector'        => '.site-title a',
					'render_callback' => [ $this, 'customize_partial_blog_name' ],
				]
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				[
					'selector'        => '.site-description',
					'render_callback' => [ $this, 'customize_partial_blog_description' ],
				]
			);

		}

		/**
		 * Theme options for Site Navigation
		 */
		$wp_customize->add_section(
			'designfly-navigation-section',
			array(
				'title'      => __( 'Navigation Bar', 'designfly' ),
				'priority'   => 120,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'designfly-site-navigation',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-site-navigation',
				array(
					'label'         => __( 'Add search icon', 'designfly' ),
					'description'   => esc_html__( 'Site Navigation Search Box Image Control', 'designfly' ),
					'section'       => 'designfly-navigation-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 20, // Optional. Default: 150.
					'height'        => 20, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);
		/**
		 * Theme options for Front Page Carousel.
		 */
		$wp_customize->add_section(
			'designfly-carousel-section',
			array(
				'title'      => __( 'Carousel', 'designfly' ),
				'priority'   => 130,
				'capability' => 'edit_theme_options',
			)
		);
		/* Settings Left Slider Arrow */
		$wp_customize->add_setting(
			'designfly-carousel-slider-left',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-carousel-slider-left',
				array(
					'label'         => __( 'Add Carousel Left Slider icon', 'designfly' ),
					'description'   => esc_html__( 'Carousel Left Slider Cropped Image Control', 'designfly' ),
					'section'       => 'designfly-carousel-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 50, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);

		/* Settings Right Slider Arrow */
		$wp_customize->add_setting(
			'designfly-carousel-slider-right',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-carousel-slider-right',
				array(
					'label'         => __( 'Add Carousel Right Slider icon', 'designfly' ),
					'description'   => esc_html__( 'Carousel right Slider Arrow Cropped Image Control', 'designfly' ),
					'section'       => 'designfly-carousel-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 50, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);

		/**
		 * Theme options for Service navbar Images
		 */
		$wp_customize->add_section(
			'designfly-service-section',
			array(
				'title'      => __( 'Service Navbar', 'designfly' ),
				'priority'   => 140,
				'capability' => 'edit_theme_options',
			)
		);

		/* ----------------Service-1-------------------- */

		/* Settings for Service -1 Heading */
		$wp_customize->add_setting(
			'designfly-service-1-heading',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Advertising',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-1-heading',
			array(
				'section'  => 'designfly-service-section',
				'label'    => __( 'Service-1 Heading', 'designfly' ),
			)
		);

		/* Settings for Service -1 Content */
		$wp_customize->add_setting(
			'designfly-service-1-content',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Lorem ipsum dolor sit amet, hehe a consectetur adipiscing elit dem.',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-1-content',
			array(
				'section'  => 'designfly-service-section',
				'type'     => 'textarea',
				'label'    => __( 'Service-1 Content', 'designfly' ),
			)
		);

		/* Settings for Service-1 Icon */
		$wp_customize->add_setting(
			'designfly-service-1-icon',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-service-1-icon',
				array(
					'label'         => __( 'Add Service-1 Icon', 'designfly' ),
					'description'   => esc_html__( 'Service-1 Cropped Image Control', 'designfly' ),
					'section'       => 'designfly-service-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 50, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);

		/* ----------------Service-2-------------------- */

		/* Settings for Service-2 Heading */
		$wp_customize->add_setting(
			'designfly-service-2-heading',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Multimedia',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-2-heading',
			array(
				'section'  => 'designfly-service-section',
				'label'    => __( 'Service-2 Heading', 'designfly' ),
			)
		);

		/* Settings for Service -2 Content */
		$wp_customize->add_setting(
			'designfly-service-2-content',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Lorem ipsum dolor sit amet, hehe a consectetur adipiscing elit dem.',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-2-content',
			array(
				'section'  => 'designfly-service-section',
				'type'     => 'textarea',
				'label'    => __( 'Service-2 Content', 'designfly' ),
			)
		);

		/* Settings for Service-2 Icon */
		$wp_customize->add_setting(
			'designfly-service-2-icon',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-service-2-icon',
				array(
					'label'         => __( 'Add Service-2 Icon', 'designfly' ),
					'description'   => esc_html__( 'Service-2 Cropped Image Control', 'designfly' ),
					'section'       => 'designfly-service-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 50, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);

		/* ----------------Service-3-------------------- */

		/* Settings for Service-3 Heading */
		$wp_customize->add_setting(
			'designfly-service-3-heading',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Photography',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-3-heading',
			array(
				'section'  => 'designfly-service-section',
				'label'    => __( 'Service-3 Heading', 'designfly' ),
			)
		);

		/* Settings for Service -3 Content */
		$wp_customize->add_setting(
			'designfly-service-3-content',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Lorem ipsum dolor sit amet, hehe a consectetur adipiscing elit dem.',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-service-3-content',
			array(
				'section'  => 'designfly-service-section',
				'type'     => 'textarea',
				'label'    => __( 'Service-3 Content', 'designfly' ),
			)
		);

		/* Settings for Service-3 Icon */
		$wp_customize->add_setting(
			'designfly-service-3-icon',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-service-3-icon',
				array(
					'label'         => __( 'Add Service-3 Icon', 'designfly' ),
					'description'   => esc_html__( 'Service-3 Cropped Image Control', 'designfly' ),
					'section'       => 'designfly-service-section',
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 50, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);

		/**
		 * Theme options for Footer Contact Area.
		 */

		$wp_customize->add_section(
			'designfly-footer-section',
			array(
				'title'      => __( 'Footer settings', 'designfly' ),
				'priority'   => 145,
				'capability' => 'edit_theme_options',
			)
		);

		/* Settings for Address */
		$wp_customize->add_setting(
			'designfly-footer-address',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'Street 21 Planet, A-11, dapibus tristique, 123551',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-footer-address',
			array(
				'section'  => 'designfly-footer-section',
				'priority' => 10,
				'label'    => __( 'Address', 'designfly' ),
			)
		);

		/* Settings for Telephone */
		$wp_customize->add_setting(
			'designfly-footer-telephone',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => '123 4567890',
				'transport'         => 'refresh',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
			)
		);

		$wp_customize->add_control(
			'designfly-footer-telephone',
			array(
				'section'   => 'designfly-footer-section',
				'priority'  => 11,
				'label'     => __( 'Telephone Number', 'designfly' ),
			)
		);
		/* Settings for Fax */
		$wp_customize->add_setting(
			'designfly-footer-fax',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => '123 456789',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-footer-fax',
			array(
				'section'  => 'designfly-footer-section',
				'priority' => 12,
				'label'    => __( 'Fax Number', 'designfly' ),
			)
		);

		/* Settings for email */
		$wp_customize->add_setting(
			'designfly-footer-email',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'contactus@dsignfly.com',
				'sanitize_callback' => array( __CLASS__, 'sanitize_custom_text' ),
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'designfly-footer-email',
			array(
				'section'  => 'designfly-footer-section',
				'priority' => 13,
				'label'    => __( 'E-mail Address', 'designfly' ),
			)
		);
		/* Settings for Social Icon Images */
		$wp_customize->add_setting(
			'designfly-footer-social',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'designfly-footer-social',
				array(
					'label'         => __( 'Add Social Media Icon Images', 'designfly' ),
					'description'   => esc_html__( 'Social Media Image Control', 'designfly' ),
					'section'       => 'designfly-footer-section',
					'priority'      => 14,
					'flex_width'    => false, // Optional. Default: false.
					'flex_height'   => true, // Optional. Default: false.
					'width'         => 250, // Optional. Default: 150.
					'height'        => 50, // Optional. Default: 150.
					'button_labels' => array( // Optional.
						'select'       => __( 'Select Image', 'designfly' ),
						'change'       => __( 'Change Image', 'designfly' ),
						'remove'       => __( 'Remove', 'designfly' ),
						'default'      => __( 'Default', 'designfly' ),
						'placeholder'  => __( 'No image selected', 'designfly' ),
						'frame_title'  => __( 'Select Image', 'designfly' ),
						'frame_button' => __( 'Choose Image', 'designfly' ),
					),
				)
			)
		);
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_name() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_description() {
		bloginfo( 'description' );
	}

	/**
	 * Enqueue customizer scripts.
	 *
	 * @action customize_preview_init
	 */
	public function enqueue_customizer_scripts() {

		Assets::get_instance()->register_script( 'designfly-customizer', 'js/admin/customizer.js', [ 'customize-preview' ] );

		wp_enqueue_script( 'designfly-customizer' );
	}

	/**
	 * Sanitizes Textarea Input
	 *
	 * @param string $input Input.
	 *
	 * @return String
	 */
	public function sanitize_custom_text( $input ) {
		return filter_var( $input, FILTER_SANITIZE_STRING );
	}

}
