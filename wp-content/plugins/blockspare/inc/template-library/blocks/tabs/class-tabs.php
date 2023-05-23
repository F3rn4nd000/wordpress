<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Tabs_Template_Block' ) ) {

	class Blockspare_Tabs_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Tabs'],
						'key'      => 'bs_tabs_1',
                        'imagePath'    => 'tabs',
						'name'     => esc_html__( 'Tabs 1', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Tabs'],
						'key'      => 'bs_tabs_2',
                        'imagePath'    => 'tabs',
						'name'     => esc_html__( 'Tabs 2', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Tabs'],
						'key'      => 'bs_tabs_3',
                        'imagePath'    => 'tabs',
						'name'     => esc_html__( 'Tabs 3', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Tabs_Template_Block::get_instance()->run();