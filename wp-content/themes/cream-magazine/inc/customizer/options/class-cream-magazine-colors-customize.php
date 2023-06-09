<?php
/**
 * Customize sections and settings for colors.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Colors_Customize' ) ) {
	/**
	 * Define and register sections and settings for colors.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Colors_Customize {

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
				'cream_magazine_theme_color_options',
				array(
					'title' => esc_html__( 'Theme Color', 'cream-magazine' ),
					'panel' => 'cream_magazine_color_customization',
				)
			);

			$wp_customize->add_section(
				'cream_magazine_category_color_options',
				array(
					'title' => esc_html__( 'Category Meta Color', 'cream-magazine' ),
					'panel' => 'cream_magazine_color_customization',
				)
			);

			$wp_customize->add_section(
				'cream_magazine_single_link_color_options',
				array(
					'title' => esc_html__( 'Post/Page Single Link Color', 'cream-magazine' ),
					'panel' => 'cream_magazine_color_customization',
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
				'cream_magazine_tagline_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_tagline_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_tagline_color',
					array(
						'label'   => esc_html__( 'Tagline Color', 'cream-magazine' ),
						'section' => 'title_tagline',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_primary_theme_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_primary_theme_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_primary_theme_color',
					array(
						'label'   => esc_html__( 'Primary Theme Color', 'cream-magazine' ),
						'section' => 'cream_magazine_theme_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_common_cat_color',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_common_cat_color'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_common_cat_color',
					array(
						'label'   => esc_html__( 'Enable Common Color For Category Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_category_color_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_color_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_color_separator_1',
					array(
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_common_cat_bg_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_common_cat_bg_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_common_cat_bg_color',
					array(
						'label'           => esc_html__( 'Common Background Color', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_1',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_1'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_1',
					array(
						'label'           => esc_html__( 'Background Color - 1', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_2',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_2'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_2',
					array(
						'label'           => esc_html__( 'Background Color - 2', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_3',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_3'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_3',
					array(
						'label'           => esc_html__( 'Background Color - 3', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_4',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_4'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_4',
					array(
						'label'           => esc_html__( 'Background Color - 4', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_5',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_5'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_5',
					array(
						'label'           => esc_html__( 'Background Color - 5', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);
			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_6',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_6'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_6',
					array(
						'label'           => esc_html__( 'Background Color - 6', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_7',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_7'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_7',
					array(
						'label'           => esc_html__( 'Background Color - 7', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_8',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_8'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_8',
					array(
						'label'           => esc_html__( 'Background Color - 8', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_bg_color_9',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_bg_color_9'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_bg_color_9',
					array(
						'label'           => esc_html__( 'Background Color - 9', 'cream-magazine' ),
						'section'         => 'cream_magazine_category_color_options',
						'active_callback' => 'cream_magazine_is_common_categories_bg_color_not_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_color_separator_2',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_color_separator_2',
					array(
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_common_cat_txt_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_common_cat_txt_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_common_cat_txt_color',
					array(
						'label'   => esc_html__( 'Common Text Color', 'cream-magazine' ),
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_color_separator_3',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_color_separator_3',
					array(
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_hover_bg_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_hover_bg_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_hover_bg_color',
					array(
						'label'   => esc_html__( 'Background Color - On Hover', 'cream-magazine' ),
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_color_separator_4',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_color_separator_4',
					array(
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_cat_hover_txt_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_cat_hover_txt_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_cat_hover_txt_color',
					array(
						'label'   => esc_html__( 'Text Color - On Hover', 'cream-magazine' ),
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_color_separator_5',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_color_separator_5',
					array(
						'section' => 'cream_magazine_category_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_content_link_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_content_link_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_content_link_color',
					array(
						'label'   => esc_html__( 'Content&rsquo;s Link Color', 'cream-magazine' ),
						'section' => 'cream_magazine_single_link_color_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_content_link_hover_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
					'default'           => $defaults['cream_magazine_content_link_hover_color'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'cream_magazine_content_link_hover_color',
					array(
						'label'   => esc_html__( 'Content&rsquo;s Link Color - On Hover', 'cream-magazine' ),
						'section' => 'cream_magazine_single_link_color_options',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Colors_Customize();
