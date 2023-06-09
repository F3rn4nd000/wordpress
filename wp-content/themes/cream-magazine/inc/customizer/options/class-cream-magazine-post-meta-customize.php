<?php
/**
 * Customize sections and settings for post meta.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Post_Meta_Customize' ) ) {
	/**
	 * Define and register sections and settings for post meta.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Post_Meta_Customize {

		/**
		 * Register sections and settings.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'register_sections' ) );

			add_action( 'customize_register', array( $this, 'register_settings' ) );
		}

		/**
		 * Sets up the customizer sections.
		 *
		 * @since  2.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_sections( $wp_customize ) {

			$wp_customize->add_section(
				'cream_magazine_post_meta_options',
				array(
					'title' => esc_html__( 'Global Post Meta', 'cream-magazine' ),
					'panel' => 'cream_magazine_theme_customization',
				)
			);
		}

		/**
		 * Sets up the customizer sections.
		 *
		 * @since  2.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_settings( $wp_customize ) {

			$defaults = cream_magazine_get_default_theme_options();

			$wp_customize->add_setting(
				'cream_magazine_enable_author_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_author_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_author_meta',
					array(
						'label'   => esc_html__( 'Enable Post Author Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_post_meta_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_date_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_date_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_date_meta',
					array(
						'label'   => esc_html__( 'Enable Posted Date Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_post_meta_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_comment_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_comment_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_comment_meta',
					array(
						'label'   => esc_html__( 'Enable Post Comments Number Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_post_meta_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_category_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_category_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_category_meta',
					array(
						'label'   => esc_html__( 'Enable Post Categories Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_post_meta_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_tag_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_tag_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_tag_meta',
					array(
						'label'   => esc_html__( 'Enable Post Tags Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_post_meta_options',
						'type'    => 'checkbox',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Post_Meta_Customize();
