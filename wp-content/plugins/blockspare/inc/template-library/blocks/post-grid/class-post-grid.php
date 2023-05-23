<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Post_Grid_Template_Block' ) ) {

	class Blockspare_Post_Grid_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Post Grid'],
						'key'      => 'bs_post_grid_1',
						'name'     => esc_html__( 'Post Grid 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-latest-posts-grid {"uniqueClass":"blockspare-f8ab86b3-8372-4","postsToShow":3,"displayPostAuthor":false,"postTitleColor":"#34495e","postTitleFontSize":24,"titleFontFamily":"Kurale","titleFontWeight":"400","titleFontSubset":"devanagari","titleLoadGoogleFonts":true,"linkColor":"#9b59b6","generalColor":"#a8a4a4","columns":3,"align":"wide","marginTop":0,"marginBottom":0,"backGroundColor":"#eeeeee","borderRadius":5,"contentOrder":"content-order-2","enableBoxShadow":true} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post Grid'],
						'key'      => 'bs_post_grid_2',
						'name'     => esc_html__( 'Post Grid 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-latest-posts-grid {"uniqueClass":"blockspare-476ee700-b7c3-4","postTitleColor":"#2c3e50","postTitleFontSize":24,"titleFontFamily":"Gothic A1","titleFontWeight":"900","titleFontSubset":"latin","titleLoadGoogleFonts":true,"linkColor":"#b23804","generalColor":"#34495e","displayPostCategory":false,"design":"blockspare-grid-layout-3","align":"wide","marginTop":0,"marginBottom":0,"backGroundColor":"#dad5d1","borderRadius":5,"enableBoxShadow":true} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post Grid'],
						'key'      => 'bs_post_grid_3',
						'name'     => esc_html__( 'Post Grid 3', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-latest-posts-grid {"uniqueClass":"blockspare-9bf64e6d-450e-4","postsToShow":3,"displayPostDate":false,"displayPostAuthor":false,"postTitleColor":"#2c3e50","postTitleFontSize":26,"titleFontFamily":"Source Sans Pro","titleFontWeight":"600","titleFontSubset":"vietnamese","titleLoadGoogleFonts":true,"linkColor":"#1f94e1","generalColor":"#34495e","displayPostCategory":false,"design":"blockspare-grid-layout-4","columns":3,"align":"wide","marginTop":0,"marginBottom":0,"backGroundColor":"#c5def8","borderRadius":5} /-->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Post Grid'],
						'key'      => 'bs_post_grid_4',
						'name'     => esc_html__( 'Post Grid 4', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-container {"enableGradient":true,"backgroundColor1":"#4b134f","backgroundColor2":"#c94b4b","paddingTop":50,"color":"#f7f7f7","enableBottomSeperator":true,"bottomDesign":"curve","bottomColor":"#f7f7f7","uniqueClass":"blockspare-cc3e51a3-e607-4","separatorEnable":true} -->
                        <div class="wp-block-blockspare-blockspare-container alignfull blockspare-cc3e51a3-e607-4"><style>.blockspare-cc3e51a3-e607-4 .blockspare-block-container-wrapper{background-image:linear-gradient(-90deg,#4b134f 30%,#c94b4b 70%);padding-top:50px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px;border-radius:null}.blockspare-cc3e51a3-e607-4 .blockspare-image-wrap{background-image:}.blockspare-cc3e51a3-e607-4 .blockspare-top-separator{top:0px;z-index:}.blockspare-cc3e51a3-e607-4 .blockspare-block-container-wrapper .blockspare-top-svg-wrap{color:#f7f7f7;height:150px}.blockspare-cc3e51a3-e607-4 .blockspare-block-container-wrapper .blockspare-bottom-separator{bottom:0px;z-index:}.blockspare-cc3e51a3-e607-4 .blockspare-block-container-wrapper .blockspare-bottom-svg-wrap{color:#f7f7f7;height:150px}</style><div class="blockspare-block-container-wrapper has-separator-top has-separator-bottom"><div class="blockspare-container-background blockspare-image-wrap has-background-opacity-100 has-background-opacity"></div><div class="blockspare-top-separator"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-top-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-cc3e51a3-e607-4 is-vertically-flipped"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="double-wave" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1946 175"><path class="st0" d="M-.5 27.7v146.8h1946V10.7s-170.6 20.4-265 57.2c0 0-374.1 116.7-794.2 24.7 0 0-414.1-100.9-673.1-92-.1 0-102.9 5.2-213.7 27.1z"></path><path class="st1" d="M1945.5 69.9s-425.5-100-888 20.5c0 0-342.6 63.3-611.4 43.8 0 0-224.9-40.3-446.6-84.4V174h1946V69.9z"></path><path d="M-.5 88s425.5-100 888 20.5c0 0 342.6 63.3 611.4 43.8 0 0 224.9-20.2 446.6-64.3v87H-.5V88z"></path></svg></div></div></div><div class="blockspare-container"><div class="blockspare-inner-blocks blockspare-inner-wrapper-blocks"><!-- wp:blockspare/blockspare-latest-posts-grid {"uniqueClass":"blockspare-7358acb8-ecd0-4","postsToShow":3,"columns":3,"align":"wide","marginTop":0,"marginBottom":0} /--></div></div><div class="blockspare-bottom-separator"><div class="blockspare-blocks blockspare-svg-wrapper blockspare-bottom-svg-wrap has-width-1 wp-block-blockspare-blockspare-container alignfull blockspare-cc3e51a3-e607-4"><div class="blockspare-svg-svg-inner blockspare-separator-wrapper"><svg class="curve" preserveaspectratio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 630 120"><path class="st1" d="M0 108.1h630V0S475 104.6 314 104.6 0 0 0 0z"></path><path class="st2" d="M0 106.9h630V17.8s-155 87.9-316 87.9S0 19 0 19z"></path><path d="M0 120h630V45.1s-155 61.8-316 61.8S0 45.1 0 45.1z"></path></svg></div></div></div></div></div>
                        <!-- /wp:blockspare/blockspare-container -->',
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Post_Grid_Template_Block::get_instance()->run();