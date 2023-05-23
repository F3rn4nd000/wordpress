<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Section_Header_Template_Block' ) ) {

	class Blockspare_Section_Header_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Section Header'],
						'key'      => 'bs_section_header_1',
						'imagePath'=> 'section-header',
						'name'     => esc_html__( 'Section Header 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-section-header {"uniqueClass":"blockspare-4c915a21-aca1-4","headerTitle":"Legal Practice Area","headerSubTitle":"Our Services","headertitleColor":"#1f2839","headersubtitleColor":"#666666","headermarginTop":0,"headermarginBottom":0,"headerlayoutOption":"blockspare-style2","titlePaddingBottom":10,"subtitlePaddingTop":20,"dashColor":"#b69d74","titleFontFamily":"Helvetica","titleFontWeight":"800","subTitleFontSize":16,"subTitleFontFamily":"Helvetica"} -->
						<div class="wp-block-blockspare-blockspare-section-header aligncenter blockspare-4c915a21-aca1-4 blockspare-section-header-wrapper blockspare-blocks aligncenter" blockspare-animation=""><style>.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap{background-color:transparent;text-align:center;margin-top:0px;margin-right:30px;margin-bottom:0px;margin-left:30px}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-title{color:#1f2839;font-size:32px;font-family:Helvetica;font-weight:800;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:0px}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-subtitle{color:#666666;font-size:16px;font-family:Helvetica;font-weight:500;padding-top:20px;padding-right:0px;padding-bottom:0px;padding-left:0px}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style2 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style4 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style5 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style6 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style7 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style8 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style9 .blockspare-title-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-upper-dash{color:#b69d74}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style11 .blockspare-title-wrapper .blockspare-title:after,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style15 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style15.blockspare-center .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper .blockspare-title,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style19 .blockspare-title-wrapper .blockspare-title:before{background-color:#b69d74}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-title,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper{border-bottom-color:#b69d74}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title:before{border-top-color:#b69d74}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-upper-dash{background-color:#E5EFE3}@media screen and (max-width:1025px){.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-title{font-size:26px}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:16px}}@media screen and (max-width:768px){.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-title{font-size:20px}.blockspare-4c915a21-aca1-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:14px}}</style><div class="blockspare-section-head-wrap blockspare-style2 blockspare-center blockspare-hover-item"><div class="blockspare-title-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><h2 class="blockspare-title">Legal Practice Area</h2><span class="blockspare-title-dash blockspare-lower-dash"></span></div><div class="blockspare-subtitle-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><p class="blockspare-subtitle">Our Services</p><span class="blockspare-title-dash blockspare-lower-dash"></span></div></div></div>
						<!-- /wp:blockspare/blockspare-section-header -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Section Header'],
						'key'      => 'bs_section_header_2',
						'imagePath'=> 'section-header',
						'name'     => esc_html__( 'Section Header 2', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-section-header {"uniqueClass":"blockspare-4696cae1-6c69-4","sectionAlignment":"left","headerTitle":"We offer great and premium prices.","titleFontSize":36,"headerSubTitle":"OUR PRICING","headermarginTop":50,"headermarginRight":0,"headermarginBottom":0,"headermarginLeft":0,"headerlayoutOption":"blockspare-style3","headerTagOption":"h4","titleFontWeight":"600","subTitleFontSize":14} -->
						<div class="wp-block-blockspare-blockspare-section-header aligncenter blockspare-4696cae1-6c69-4 blockspare-section-header-wrapper blockspare-blocks aligncenter" blockspare-animation=""><style>.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap{background-color:transparent;text-align:left;margin-top:50px;margin-right:0px;margin-bottom:0px;margin-left:0px}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-title{color:#404040;font-size:36px;font-weight:600;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-subtitle{color:#6d6d6d;font-size:14px;font-weight:500;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style2 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style4 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style5 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style6 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style7 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style8 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style9 .blockspare-title-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-upper-dash{color:#8b249c}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style11 .blockspare-title-wrapper .blockspare-title:after,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style15 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style15.blockspare-center .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper .blockspare-title,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style19 .blockspare-title-wrapper .blockspare-title:before{background-color:#8b249c}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-title,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper{border-bottom-color:#8b249c}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title:before{border-top-color:#8b249c}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-upper-dash{background-color:#E5EFE3}@media screen and (max-width:1025px){.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-title{font-size:26px}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:16px}}@media screen and (max-width:768px){.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-title{font-size:20px}.blockspare-4696cae1-6c69-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:14px}}</style><div class="blockspare-section-head-wrap blockspare-style3 blockspare-left blockspare-hover-item"><div class="blockspare-title-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><h4 class="blockspare-title">We offer great and premium prices.</h4><span class="blockspare-title-dash blockspare-lower-dash"></span></div><div class="blockspare-subtitle-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><p class="blockspare-subtitle">OUR PRICING</p><span class="blockspare-title-dash blockspare-lower-dash"></span></div></div></div>
						<!-- /wp:blockspare/blockspare-section-header -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Section Header'],
						'key'      => 'bs_section_header_3',
						'imagePath'=> 'section-header',
						'name'     => esc_html__( 'Section Header 3', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Section Header'],
						'key'      => 'bs_section_header_4',
						'imagePath'=> 'section-header',
						'name'     => esc_html__( 'Section Header 4', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
					),
                    array(
						'type'     => 'block',
						'item'     => ['Section Header'],
						'key'      => 'bs_section_header_5',
						'imagePath'=> 'section-header',
						'name'     => esc_html__( 'Section Header 5', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
					)
                
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Section_Header_Template_Block::get_instance()->run();