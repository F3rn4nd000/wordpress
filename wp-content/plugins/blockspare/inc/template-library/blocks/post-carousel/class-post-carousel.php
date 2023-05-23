<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Post_Carousel_Template_Block' ) ) {

	class Blockspare_Post_Carousel_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Post Carousel'],
						'key'      => 'bs_post_carousel_1',
						'name'     => esc_html__( 'Post Carousel 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/latest-posts-block-carousel-grid {"uniqueClass":"blockspare-291fb3d3-096d-4","postTitleColor":"#00316c","postTitleFontSize":18,"titleFontFamily":"Amiri","titleFontWeight":"700","titleFontSubset":"latin","titleLoadGoogleFonts":true,"grid":"blockspare-posts-block-grid-layout-2","backGroundColor":"#f5feff","categoryBackgroundColor":"#000569"} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post Carousel'],
						'key'      => 'bs_post_carousel_2',
						'name'     => esc_html__( 'Post_Carousel 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/latest-posts-block-carousel-grid {"uniqueClass":"blockspare-2e3af31d-f55d-4","postTitleFontSize":17,"titleFontFamily":"Alike","titleFontWeight":"400","titleFontSubset":"latin","titleLoadGoogleFonts":true,"linkColor":"#8b249c","generalColor":"#5b5b5b","backGroundColor":"#dcd7ca","categoryBackgroundColor":"#8b249c","titleOnHoverColor":"#8b249c","enableEqualHeight":false} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post Carousel'],
						'key'      => 'bs_post_carousel_3',
						'name'     => esc_html__( 'Post_Carousel 3', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-container {"enableGradient":true,"backgroundColor1":"#4286f4","backgroundColor2":"#1b478e","color":"#f7f7f7","enableBottomSeperator":true,"bottomColor":"#f7f7f7","shapeHorizontalFlip":true,"enableBottomGap":true,"uniqueClass":"blockspare-efe2a4e9-f33b-4","separatorEnable":true,"enableGap":true} -->
                        <div class="wp-block-blockspare-blockspare-container alignfull blockspare-efe2a4e9-f33b-4"><style>.blockspare-efe2a4e9-f33b-4 .blockspare-block-container-wrapper{background-image:linear-gradient(-90deg,#4286f4 30%,#1b478e 70%);padding-top:20px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px;border-radius:null}.blockspare-efe2a4e9-f33b-4 .blockspare-image-wrap{background-image:}.blockspare-efe2a4e9-f33b-4 .blockspare-top-separator{top:0px;z-index:}.blockspare-efe2a4e9-f33b-4 .blockspare-block-container-wrapper .blockspare-top-svg-wrap{color:#f7f7f7;height:150px}.blockspare-efe2a4e9-f33b-4 .blockspare-block-container-wrapper .blockspare-bottom-separator{bottom:0px;z-index:}.blockspare-efe2a4e9-f33b-4 .blockspare-block-container-wrapper .blockspare-bottom-svg-wrap{color:#f7f7f7;height:150px}</style><div class="blockspare-block-container-wrapper has-gap-enable has-bottom-gap-enable has-separator-top has-separator-bottom"><div class="blockspare-container-background blockspare-image-wrap has-background-opacity-100 has-background-opacity"></div><div class="blockspare-top-separator"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-top-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-efe2a4e9-f33b-4 is-vertically-flipped"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="double-wave" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1946 175"><path class="st0" d="M-.5 27.7v146.8h1946V10.7s-170.6 20.4-265 57.2c0 0-374.1 116.7-794.2 24.7 0 0-414.1-100.9-673.1-92-.1 0-102.9 5.2-213.7 27.1z"></path><path class="st1" d="M1945.5 69.9s-425.5-100-888 20.5c0 0-342.6 63.3-611.4 43.8 0 0-224.9-40.3-446.6-84.4V174h1946V69.9z"></path><path d="M-.5 88s425.5-100 888 20.5c0 0 342.6 63.3 611.4 43.8 0 0 224.9-20.2 446.6-64.3v87H-.5V88z"></path></svg></div></div></div><div class="blockspare-container"><div class="blockspare-inner-blocks blockspare-inner-wrapper-blocks"><!-- wp:blockspare/latest-posts-block-carousel-grid {"uniqueClass":"blockspare-4e668885-ae0e-4","postTitleFontSize":24,"titleFontFamily":"Abel","titleFontWeight":"400","titleFontSubset":"latin","titleLoadGoogleFonts":true,"align":"wide","numberofSlide":3,"enableEqualHeight":false} /--></div></div><div class="blockspare-bottom-separator"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-bottom-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-efe2a4e9-f33b-4 is-bottom-horizontally-flipped"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="double-wave" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1946 175"><path class="st0" d="M-.5 27.7v146.8h1946V10.7s-170.6 20.4-265 57.2c0 0-374.1 116.7-794.2 24.7 0 0-414.1-100.9-673.1-92-.1 0-102.9 5.2-213.7 27.1z"></path><path class="st1" d="M1945.5 69.9s-425.5-100-888 20.5c0 0-342.6 63.3-611.4 43.8 0 0-224.9-40.3-446.6-84.4V174h1946V69.9z"></path><path d="M-.5 88s425.5-100 888 20.5c0 0 342.6 63.3 611.4 43.8 0 0 224.9-20.2 446.6-64.3v87H-.5V88z"></path></svg></div></div></div></div></div>
                        <!-- /wp:blockspare/blockspare-container -->',
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Post_Carousel_Template_Block::get_instance()->run();