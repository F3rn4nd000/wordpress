<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Icon_Template_Block' ) ) {

	class Blockspare_Icon_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Icon'],
						'key'      => 'bs_icon_1',
						'name'     => esc_html__( 'Icon 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-iconset {"uniqueClass":"blockspare-036fde77-8429-4","name":"fas fa-user-graduate","iconBackgroundColor":"#b69d74","marginTop":0,"marginBottom":0} -->
						<div class="wp-block-blockspare-blockspare-iconset blockspare-036fde77-8429-4 blockspare-blocks" blockspare-animation=""><style>.blockspare-036fde77-8429-4 .blockspare-block-icon-wrapper{text-align:center;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px}.blockspare-036fde77-8429-4 .blockspare-block-icon-wrapper .blockspare-block-icon{background-color:#b69d74;border-color:#8b249c;color:#fff;border-radius:50%}</style><div class="blockspare-block-icon-wrapper"><div class="blockspare-block-icon blockspare-icon-size-small blockspare-icon-style2 blockspare-hover-item"><i class="fas fa-user-graduate"></i></div></div></div>
						<!-- /wp:blockspare/blockspare-iconset -->',
						'imagePath'    => 'icon',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Icon'],
						'key'      => 'bs_icon_2',
						'name'     => esc_html__( 'Icon 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-iconset {"uniqueClass":"blockspare-072d13a5-575a-4","name":"fas fa-air-freshener","iconSize":"blockspare-icon-size-medium","iconStyles":"blockspare-icon-style3","iconBorderColor":"#345C00","iconColor":"#345C00","borderRadius":45} -->
						<div class="wp-block-blockspare-blockspare-iconset blockspare-072d13a5-575a-4 blockspare-blocks" blockspare-animation=""><style>.blockspare-072d13a5-575a-4 .blockspare-block-icon-wrapper{text-align:center;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px}.blockspare-072d13a5-575a-4 .blockspare-block-icon-wrapper .blockspare-block-icon{background-color:transparent;border-color:#345C00;color:#345C00;border-radius:45%}</style><div class="blockspare-block-icon-wrapper"><div class="blockspare-block-icon blockspare-icon-size-medium blockspare-icon-style3 blockspare-hover-item"><i class="fas fa-air-freshener"></i></div></div></div>
						<!-- /wp:blockspare/blockspare-iconset -->',
						'imagePath'    => 'icon',

                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Icon'],
						'key'      => 'bs_icon_3',
						'name'     => esc_html__( 'Icon 3', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-iconset {"uniqueClass":"blockspare-bb18ddbb-0d59-4","name":"fas fa-calendar-alt","iconSize":"blockspare-icon-size-large","iconStyles":"blockspare-icon-style1","iconColor":"#0346b2"} -->
						<div class="wp-block-blockspare-blockspare-iconset blockspare-bb18ddbb-0d59-4 blockspare-blocks" blockspare-animation=""><style>.blockspare-bb18ddbb-0d59-4 .blockspare-block-icon-wrapper{text-align:center;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px}.blockspare-bb18ddbb-0d59-4 .blockspare-block-icon{color:#0346b2}</style><div class="blockspare-block-icon-wrapper"><div class="blockspare-block-icon blockspare-icon-size-large blockspare-icon-style1 blockspare-hover-item"><i class="fas fa-calendar-alt"></i></div></div></div>
						<!-- /wp:blockspare/blockspare-iconset -->',
						'imagePath'    => 'icon',
                    ),
					
                    array(
						'type'     => 'block',
						'item'     => ['Icon'],
						'key'      => 'bs_icon_4',
						'name'     => esc_html__( 'Icon 4', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-iconset {"uniqueClass":"blockspare-62458350-5f88-4","name":"fas fa-comment","iconSize":"blockspare-icon-size-medium","iconBackgroundColor":"#fad500","iconColor":"#000000","borderRadius":0,"marginTop":0,"marginBottom":0} -->
						<div class="wp-block-blockspare-blockspare-iconset blockspare-62458350-5f88-4 blockspare-blocks" blockspare-animation=""><style>.blockspare-62458350-5f88-4 .blockspare-block-icon-wrapper{text-align:center;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px}.blockspare-62458350-5f88-4 .blockspare-block-icon-wrapper .blockspare-block-icon{background-color:#fad500;border-color:#8b249c;color:#000000;border-radius:0%}</style><div class="blockspare-block-icon-wrapper"><div class="blockspare-block-icon blockspare-icon-size-medium blockspare-icon-style2 blockspare-hover-item"><i class="fas fa-comment"></i></div></div></div>
						<!-- /wp:blockspare/blockspare-iconset -->',
						'imagePath'    => 'icon',
					)
                
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Icon_Template_Block::get_instance()->run();