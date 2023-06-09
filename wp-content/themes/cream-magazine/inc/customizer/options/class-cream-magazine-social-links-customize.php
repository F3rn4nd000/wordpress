<?php
/**
 * Customize sections and settings for social links.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Social_Links_Customize' ) ) {
	/**
	 * Define and register sections and settings for social links.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Social_Links_Customize {

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
				'cream_magazine_social_links_options',
				array(
					'title' => esc_html__( 'Social Links', 'cream-magazine' ),
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
				'cream_magazine_facebook_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_facebook_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_facebook_link',
				array(
					'label'   => esc_html__( 'Facebook Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_twitter_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_twitter_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_twitter_link',
				array(
					'label'   => esc_html__( 'Twitter Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_instagram_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_instagram_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_instagram_link',
				array(
					'label'   => esc_html__( 'Instagram Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_youtube_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_youtube_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_youtube_link',
				array(
					'label'   => esc_html__( 'Youtube Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_vk_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_vk_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_vk_link',
				array(
					'label'   => esc_html__( 'VK Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_linkedin_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_linkedin_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_linkedin_link',
				array(
					'label'   => esc_html__( 'Linkedin Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_vimeo_link',
				array(
					'sanitize_callback' => 'esc_url_raw',
					'default'           => $defaults['cream_magazine_vimeo_link'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_vimeo_link',
				array(
					'label'   => esc_html__( 'Vimeo Link', 'cream-magazine' ),
					'section' => 'cream_magazine_social_links_options',
					'type'    => 'url',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_social_links_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_social_links_separator_1',
					array(
						'section' => 'cream_magazine_social_links_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_show_social_links_in_new_tab',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_show_social_links_in_new_tab'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_show_social_links_in_new_tab',
					array(
						'label'   => esc_html__( 'Show Pages On New Tab', 'cream-magazine' ),
						'section' => 'cream_magazine_social_links_options',
						'type'    => 'checkbox',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Social_Links_Customize();
