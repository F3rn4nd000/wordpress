<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Post_List_Template_Block' ) ) {

	class Blockspare_Post_List_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Post List'],
						'key'      => 'bs_post_list_1',
						'name'     => esc_html__( 'Post List 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-latest-posts-list {"uniqueClass":"blockspare-7743fdf3-7d64-4","postsToShow":3,"postTitleColor":"#474747","postTitleFontSize":34,"titleFontFamily":"Gothic A1","titleFontWeight":"700","titleFontSubset":"korean","titleLoadGoogleFonts":true,"linkColor":"#249e5c","generalColor":"#a94747","design":"blockspare-posts-block-list-layout-3","align":"wide","backGroundColor":"#ffffff","borderRadius":4,"enableBoxShadow":true} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post List'],
						'key'      => 'bs_post_list_2',
						'name'     => esc_html__( 'Post List 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-latest-posts-list {"uniqueClass":"blockspare-7b2143f3-980c-4","postsToShow":3,"postTitleColor":"#474747","postTitleFontSize":34,"titleFontFamily":"Gothic A1","titleFontWeight":"700","titleFontSubset":"korean","titleLoadGoogleFonts":true,"linkColor":"#249e5c","generalColor":"#a94747","design":"blockspare-posts-block-list-layout-5","align":"wide","backGroundColor":"#ffffff","borderRadius":4,"contentOrder":"content-order-2"} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post List'],
						'key'      => 'bs_post_list_3',
						'name'     => esc_html__( 'Post List 3', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-container {"enableGradient":true,"backgroundColor1":"#ff6a00","backgroundColor2":"#ee0979","design":"grow","height":234,"color":"#f7f7f7","enableBottomSeperator":true,"bottomDesign":"grow","bottomHeight":234,"bottomColor":"#f7f7f7","shapeHorizontalFlip":true,"showBottomFront":true,"uniqueClass":"blockspare-e405d9a7-27f1-4","imgURL":"http://blockspare.com/wp-content/uploads/2020/03/selective-focus-photography-of-black-lamp-post-1043857-scaled.jpg","imgID":650,"imgAlt":"","opacityRatio":10,"backgroundFix":true,"separatorEnable":true,"showFront":true} -->
                        <div class="wp-block-blockspare-blockspare-container alignfull blockspare-e405d9a7-27f1-4"><style>.blockspare-e405d9a7-27f1-4 .blockspare-block-container-wrapper{background-image:linear-gradient(-90deg,#ff6a00 30%,#ee0979 70%);padding-top:20px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px;border-radius:null}.blockspare-e405d9a7-27f1-4 .blockspare-image-wrap{background-image:url(http://blockspare.com/wp-content/uploads/2020/03/selective-focus-photography-of-black-lamp-post-1043857-scaled.jpg)}.blockspare-e405d9a7-27f1-4 .blockspare-top-separator{top:0px;z-index:20}.blockspare-e405d9a7-27f1-4 .blockspare-block-container-wrapper .blockspare-top-svg-wrap{color:#f7f7f7;height:234px}.blockspare-e405d9a7-27f1-4 .blockspare-block-container-wrapper .blockspare-bottom-separator{bottom:0px;z-index:20}.blockspare-e405d9a7-27f1-4 .blockspare-block-container-wrapper .blockspare-bottom-svg-wrap{color:#f7f7f7;height:234px}</style><div class="blockspare-block-container-wrapper blockspare-background-fix has-separator-top has-separator-bottom"><div class="blockspare-container-background blockspare-image-wrap has-background-opacity-10 has-background-opacity"></div><div class="blockspare-top-separator blockspare-svg-show-front"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-top-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-e405d9a7-27f1-4 is-vertically-flipped"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="grow" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 630 80"><path class="st1" d="M261.2 64.9C367.6 54.7 499.6 39.7 630 18.5V0C497.8 31.4 363.7 52 261.2 64.9z"></path><path class="st2" d="M261.2 64.9c-41 3.9-78.2 7.1-110 9.6 13.2-.4 27-.9 41.5-1.6C315 67.7 478.4 59.4 630 34.8V18.5C499.1 39.8 367.3 54.8 261.2 64.9z"></path><path d="M192.7 72.9c-14.5.7-28.3 1.2-41.5 1.6C59.9 77.7 0 77.4 0 77.4V80h630V33.8C478.4 58.4 315 67.7 192.7 72.9z"></path></svg></div></div></div><div class="blockspare-container"><div class="blockspare-inner-blocks blockspare-inner-wrapper-blocks"><!-- wp:blockspare/blockspare-latest-posts-list {"uniqueClass":"blockspare-2f2c5b46-1816-4","postsToShow":3,"postTitleColor":"#2d3436","linkColor":"#e17055","generalColor":"#88847a","backGroundColor":"#f9e9b6","enableBoxShadow":true,"enableEqualHeight":false} /--></div></div><div class="blockspare-bottom-separator blockspare-svg-show-front"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-bottom-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-e405d9a7-27f1-4 is-bottom-horizontally-flipped"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="grow" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 630 80"><path class="st1" d="M261.2 64.9C367.6 54.7 499.6 39.7 630 18.5V0C497.8 31.4 363.7 52 261.2 64.9z"></path><path class="st2" d="M261.2 64.9c-41 3.9-78.2 7.1-110 9.6 13.2-.4 27-.9 41.5-1.6C315 67.7 478.4 59.4 630 34.8V18.5C499.1 39.8 367.3 54.8 261.2 64.9z"></path><path d="M192.7 72.9c-14.5.7-28.3 1.2-41.5 1.6C59.9 77.7 0 77.4 0 77.4V80h630V33.8C478.4 58.4 315 67.7 192.7 72.9z"></path></svg></div></div></div></div></div>
                        <!-- /wp:blockspare/blockspare-container -->',
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Post_List_Template_Block::get_instance()->run();