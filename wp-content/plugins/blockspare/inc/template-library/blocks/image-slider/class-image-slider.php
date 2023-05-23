<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Image_Slider_Template_Block' ) ) {

	class Blockspare_Image_Slider_Template_Block extends Blockspare_Import_Block_Base{
		public static function get_instance() {

			static $instance = null;
			if ( null === $instance ) {
				$instance = new self();
			}
			return $instance;

		}
        public function add_block_template_library( $blocks_lists ){

            $block_library_list = array(
					array(
						'type'     => 'block',
						'item'     => ['Image Slider'],
						'key'      => 'bs_image_slider_1',
						'name'     => esc_html__( 'Image Slider 1', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
						),

						array(
							'type'     => 'block',
							'item'     => ['Image Slider'],
							'key'      => 'bs_image_slider_2',
							'name'     => esc_html__( 'Image Slider 2', 'blockspare' ),
							'content'  => BLOCKSPARE_PRO_PATH,
						)
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Image_Slider_Template_Block::get_instance()->run();