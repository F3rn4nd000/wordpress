<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Logo_Grid_Template_Block' ) ) {

	class Blockspare_Logo_Grid_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Logo Grid'],
						'key'      => 'bs_logo_grid_1',
						'name'     => esc_html__( 'Logo Grid 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-logos {"uniqueClass":"blockspare-ef0c60be-7e63-4","images":[{"alt":"","id":291,"link":"http://blockspare.com/home/image-carousel-image/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/image-carousel-image.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/image-carousel-image.png","imgLink":""},{"alt":"","id":288,"link":"http://blockspare.com/home/cta-image-2/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/cta-image-1.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/cta-image-1.png","imgLink":""},{"alt":"","id":285,"link":"http://blockspare.com/home/content-box-image-2/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/content-box-image-1.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/content-box-image-1.png","imgLink":""},{"alt":"","id":298,"link":"http://blockspare.com/home/post-list-image/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/post-list-image.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/post-list-image.png","imgLink":""},{"alt":"","id":292,"link":"http://blockspare.com/home/image-slider-image/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/image-slider-image.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/image-slider-image.png","imgLink":""},{"alt":"","id":304,"link":"http://blockspare.com/home/shape-divider-image/","caption":"","sizes":{"full":{"url":"http://blockspare.com/wp-content/uploads/2020/03/shape-divider-image.png","height":150,"width":150,"orientation":"landscape"}},"url":"http://blockspare.com/wp-content/uploads/2020/03/shape-divider-image.png","imgLink":""}],"columns":3,"gutter":50,"className":"blockspare-c2144358-f9cd-4"} -->
<div class="blockspare-blocks blockspare-logos-wrapper has-gap-50 has-colums-3 wp-block-blockspare-blockspare-logos blockspare-c2144358-f9cd-4 blockspare-ef0c60be-7e63-4" blockspare-animation=""><style>.blockspare-ef0c60be-7e63-4 .blockspare-logo-grid-main{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px}</style><div class="blockspare-logo-grid-main"><ul class="blockspare-logo-wrap"><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/image-carousel-image.png" alt="" data-id="291" data-imglink="" data-link="http://blockspare.com/home/image-carousel-image/" class="wp-image-291 blockspare-hover-item"/></figure></li><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/cta-image-1.png" alt="" data-id="288" data-imglink="" data-link="http://blockspare.com/home/cta-image-2/" class="wp-image-288 blockspare-hover-item"/></figure></li><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/content-box-image-1.png" alt="" data-id="285" data-imglink="" data-link="http://blockspare.com/home/content-box-image-2/" class="wp-image-285 blockspare-hover-item"/></figure></li><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/post-list-image.png" alt="" data-id="298" data-imglink="" data-link="http://blockspare.com/home/post-list-image/" class="wp-image-298 blockspare-hover-item"/></figure></li><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/image-slider-image.png" alt="" data-id="292" data-imglink="" data-link="http://blockspare.com/home/image-slider-image/" class="wp-image-292 blockspare-hover-item"/></figure></li><li class="blockspare-gallery-item"><figure class="blockspare-gallery-figure"><img src="http://blockspare.com/wp-content/uploads/2020/03/shape-divider-image.png" alt="" data-id="304" data-imglink="" data-link="http://blockspare.com/home/shape-divider-image/" class="wp-image-304 blockspare-hover-item"/></figure></li></ul></div></div>
<!-- /wp:blockspare/blockspare-logos -->',
						'imagePath'    => 'logo-grid',

                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Logo Grid'],
						'key'      => 'bs_logo_grid_2',
						'name'     => esc_html__( 'Logo Grid 2', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
						'imagePath'    => 'logo-grid',
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Logo_Grid_Template_Block::get_instance()->run();