<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Social_Links_Template_Block' ) ) {

	class Blockspare_Social_Links_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Social Link'],
						'key'      => 'bs_social_link_1',
						'name'     => esc_html__( 'Social Link 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-social-links {"uniqueClass":"blockspare-f1c1b0bc-3dd3-4","youtubeUrl":"www.youtube.com","buttonShapes":"blockspare-social-icon-circle"} -->
						<div class="wp-block-blockspare-blockspare-social-links blockspare-f1c1b0bc-3dd3-4 blockspare-socaillink-block" blockspare-animation=""><style>.blockspare-f1c1b0bc-3dd3-4 .blockspare-social-wrapper{text-align:center;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px}</style><div class="blockspare-social-wrapper"><ul class="blockspare-social-links blockspare-default-official-color blockspare-social-icon-circle blockspare-social-icon-small blockspare-icon-only blockspare-social-icon-solid blockspare-social-links-horizontal"><li><a href="https://facebook.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-facebook-f"></i> <span class="screen-reader-text">Facebook</span></span></a></li><li><a href="https://twitter.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-twitter"></i><span class="screen-reader-text">Twitter</span></span></a></li><li><a href="https://instagram.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-instagram"></i><span class="screen-reader-text">Instagram</span></span></a></li><li><a href="www.youtube.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-youtube"></i><span class="screen-reader-text">YouTube</span></span></a></li></ul></div></div>
						<!-- /wp:blockspare/blockspare-social-links -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Social Link'],
						'key'      => 'bs_social_link_2',
						'name'     => esc_html__( 'Social Link 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-social-links {"uniqueClass":"blockspare-8ed7156f-c8dc-4","instagramUrl":"","youtubeUrl":"www.youtube.com","pinterestUrl":"www.pinterest.com","buttonFills":"blockspare-social-icon-border","buttonShapes":"blockspare-social-icon-circle"} -->
						<div class="wp-block-blockspare-blockspare-social-links blockspare-8ed7156f-c8dc-4 blockspare-socaillink-block" blockspare-animation=""><style>.blockspare-8ed7156f-c8dc-4 .blockspare-social-wrapper{text-align:center;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px}</style><div class="blockspare-social-wrapper"><ul class="blockspare-social-links blockspare-default-official-color blockspare-social-icon-circle blockspare-social-icon-small blockspare-icon-only blockspare-social-icon-border blockspare-social-links-horizontal"><li><a href="https://facebook.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-facebook-f"></i> <span class="screen-reader-text">Facebook</span></span></a></li><li><a href="https://twitter.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-twitter"></i><span class="screen-reader-text">Twitter</span></span></a></li><li><a href="www.youtube.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-youtube"></i><span class="screen-reader-text">YouTube</span></span></a></li><li><a href="www.pinterest.com" class="" target="_blank" rel="noopener noreferrer"><span class="blockspare-social-icons"><i class="fab fa-pinterest"></i><span class="screen-reader-text">Pinterest</span></span></a></li></ul></div></div>
						<!-- /wp:blockspare/blockspare-social-links -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Social Link'],
						'key'      => 'bs_social_link_3',
						'name'     => esc_html__( 'Social Link 3', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Social Link'],
						'key'      => 'bs_social_link_4',
						'name'     => esc_html__( 'Social Link 4', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
					),
                    array(
						'type'     => 'block',
						'item'     => ['Social Link'],
						'key'      => 'bs_social_link_5',
						'name'     => esc_html__( 'Social Link 5', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
					)
                
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Social_Links_Template_Block::get_instance()->run();