<?php
/**
 * Customize sections and settings for post single.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Post_Single_Customize' ) ) {
	/**
	 * Define and register sections and settings for post single.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Post_Single_Customize {

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
				'cream_magazine_single_post_options',
				array(
					'title' => esc_html__( 'Single Post', 'cream-magazine' ),
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
				'cream_magazine_enable_post_single_author_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_author_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_author_meta',
					array(
						'label'   => esc_html__( 'Enable Post Author Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_date_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_date_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_date_meta',
					array(
						'label'   => esc_html__( 'Enable Posted Date Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_cmnts_no_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_cmnts_no_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_cmnts_no_meta',
					array(
						'label'   => esc_html__( 'Enable Post Comments Number Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_categories_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_categories_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_categories_meta',
					array(
						'label'   => esc_html__( 'Enable Post Categories Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_tags_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_tags_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_tags_meta',
					array(
						'label'   => esc_html__( 'Enable Post Tags Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_post_single_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_post_single_separator_1',
					array(
						'section' => 'cream_magazine_single_post_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_featured_image',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_featured_image'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_featured_image',
					array(
						'label'   => esc_html__( 'Enable Featured Image', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_single_featured_image_caption',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_single_featured_image_caption'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_single_featured_image_caption',
					array(
						'label'   => esc_html__( 'Show Featured Image&rsquo;s Caption', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_post_single_separator_2',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_post_single_separator_2',
					array(
						'section' => 'cream_magazine_single_post_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_author_section',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_author_section'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_author_section',
					array(
						'label'   => esc_html__( 'Enable Author Section', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_post_single_separator_3',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_post_single_separator_3',
					array(
						'section' => 'cream_magazine_single_post_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_related_section',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_related_section'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_related_section',
					array(
						'label'   => esc_html__( 'Enable Related Posts Section', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_related_section_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => $defaults['cream_magazine_related_section_title'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'cream_magazine_related_section_title',
				array(
					'label'           => esc_html__( 'Related Posts Section Title', 'cream-magazine' ),
					'section'         => 'cream_magazine_single_post_options',
					'type'            => 'text',
					'active_callback' => 'cream_magaine_is_related_section_active',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_related_section_posts_number',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_number',
					'default'           => $defaults['cream_magazine_related_section_posts_number'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_related_section_posts_number',
				array(
					'label'           => esc_html__( 'Related Section Posts Number', 'cream-magazine' ),
					'section'         => 'cream_magazine_single_post_options',
					'type'            => 'number',
					'active_callback' => 'cream_magaine_is_related_section_active',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_related_section_author_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_related_section_author_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_related_section_author_meta',
					array(
						'label'           => esc_html__( 'Enable Post Author Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_single_post_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_related_section_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_related_section_date_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_related_section_date_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_related_section_date_meta',
					array(
						'label'           => esc_html__( 'Enable Posted Date Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_single_post_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_related_section_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_related_section_cmnts_no_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_related_section_cmnts_no_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_related_section_cmnts_no_meta',
					array(
						'label'           => esc_html__( 'Enable Post Comments Number Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_single_post_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_related_section_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_related_section_categories_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_related_section_categories_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_related_section_categories_meta',
					array(
						'label'           => esc_html__( 'Enable Post Categories Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_single_post_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_related_section_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_post_single_separator_4',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_post_single_separator_4',
					array(
						'section' => 'cream_magazine_single_post_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_post_common_sidebar_position',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_post_common_sidebar_position'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_post_common_sidebar_position',
					array(
						'label'   => esc_html__( 'Enable Common Sidebar Position', 'cream-magazine' ),
						'section' => 'cream_magazine_single_post_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_select_post_common_sidebar_position',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_select',
					'default'           => $defaults['cream_magazine_select_post_common_sidebar_position'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Radio_Image_Control(
					$wp_customize,
					'cream_magazine_select_post_common_sidebar_position',
					array(
						'label'           => esc_html__( 'Select Sidebar Position', 'cream-magazine' ),
						'section'         => 'cream_magazine_single_post_options',
						'type'            => 'select',
						'choices'         => cream_magazine_sidebar_positions(),
						'active_callback' => 'cream_magazine_is_post_common_sidebar_position_active',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Post_Single_Customize();
