<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Buttons_Template_Block' ) ) {

	class Blockspare_Buttons_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Button'],
						'key'      => 'bs_button_1',
						'name'     => esc_html__( 'Button 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-buttons {"sectionAlignment":"left","uniqueClass":"blockspare-1517f5c5-5932-4","buttonBackgroundColor":"#2e947d","buttonShape":"blockspare-button-shape-square","marginBottom":0} -->
						<div class="wp-block-blockspare-blockspare-buttons blockspare-1517f5c5-5932-4 blockspare-block-button-wrap" blockspare-animation=""><style>.blockspare-1517f5c5-5932-4 .blockspare-block-button{text-align:left;margin-top:30px;margin-bottom:0px;margin-left:0px;margin-right:0px}.blockspare-1517f5c5-5932-4 .blockspare-block-button span{color:#fff;border-width:2px;font-size:16px;font-weight:500}.blockspare-1517f5c5-5932-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button{background-color:#2e947d}.blockspare-1517f5c5-5932-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:visited{background-color:#2e947d}.blockspare-1517f5c5-5932-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:focus{background-color:#2e947d}.blockspare-1517f5c5-5932-4 .blockspare-block-button a{padding-top:12px;padding-bottom:12px;padding-right:22px;padding-left:22px}@media screen and (max-width:1025px){.blockspare-1517f5c5-5932-4 .blockspare-block-button span{font-size:14px}}@media screen and (max-width:768px){.blockspare-1517f5c5-5932-4 .blockspare-block-button span{font-size:12px}}</style><div class="blockspare-block-button"><a class="blockspare-button blockspare-button-shape-square blockspare-button-size-small"><span>Get Started</span></a></div></div>
						<!-- /wp:blockspare/blockspare-buttons -->',
						'imagePath'    => 'buttons',
						),

						array(
							'type'     => 'block',
							'item'     => ['Button'],
							'key'      => 'bs_button_2',
							'name'     => esc_html__( 'Button 2', 'blockspare' ),
							'content'  => '<!-- wp:blockspare/blockspare-buttons {"uniqueClass":"blockspare-18609312-4cb1-4","buttonBackgroundColor":"#b69d74"} -->
							<div class="wp-block-blockspare-blockspare-buttons blockspare-18609312-4cb1-4 blockspare-block-button-wrap" blockspare-animation=""><style>.blockspare-18609312-4cb1-4 .blockspare-block-button{text-align:center;margin-top:30px;margin-bottom:30px;margin-left:0px;margin-right:0px}.blockspare-18609312-4cb1-4 .blockspare-block-button span{color:#fff;border-width:2px;font-size:16px;font-weight:500}.blockspare-18609312-4cb1-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button{background-color:#b69d74}.blockspare-18609312-4cb1-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:visited{background-color:#b69d74}.blockspare-18609312-4cb1-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:focus{background-color:#b69d74}.blockspare-18609312-4cb1-4 .blockspare-block-button a{padding-top:12px;padding-bottom:12px;padding-right:22px;padding-left:22px}@media screen and (max-width:1025px){.blockspare-18609312-4cb1-4 .blockspare-block-button span{font-size:14px}}@media screen and (max-width:768px){.blockspare-18609312-4cb1-4 .blockspare-block-button span{font-size:12px}}</style><div class="blockspare-block-button"><a class="blockspare-button blockspare-button-shape-rounded blockspare-button-size-small"><span>Get Started</span></a></div></div>
							<!-- /wp:blockspare/blockspare-buttons -->',
							'imagePath'    => 'buttons',
						),
						array(
							'type'     => 'block',
							'item'     => ['Button'],
							'key'      => 'bs_button_3',
							'name'     => esc_html__( 'Button 3', 'blockspare' ),
							'content'  => '<!-- wp:blockspare/blockspare-buttons {"sectionAlignment":"left","uniqueClass":"blockspare-6103c0ca-a61b-4","buttonBackgroundColor":"#648813"} -->
							<div class="wp-block-blockspare-blockspare-buttons blockspare-6103c0ca-a61b-4 blockspare-block-button-wrap" blockspare-animation=""><style>.blockspare-6103c0ca-a61b-4 .blockspare-block-button{text-align:left;margin-top:30px;margin-bottom:30px;margin-left:0px;margin-right:0px}.blockspare-6103c0ca-a61b-4 .blockspare-block-button span{color:#fff;border-width:2px;font-size:16px;font-weight:500}.blockspare-6103c0ca-a61b-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button{background-color:#648813}.blockspare-6103c0ca-a61b-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:visited{background-color:#648813}.blockspare-6103c0ca-a61b-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:focus{background-color:#648813}.blockspare-6103c0ca-a61b-4 .blockspare-block-button a{padding-top:12px;padding-bottom:12px;padding-right:22px;padding-left:22px}@media screen and (max-width:1025px){.blockspare-6103c0ca-a61b-4 .blockspare-block-button span{font-size:14px}}@media screen and (max-width:768px){.blockspare-6103c0ca-a61b-4 .blockspare-block-button span{font-size:12px}}</style><div class="blockspare-block-button"><a class="blockspare-button blockspare-button-shape-rounded blockspare-button-size-small"><span>Get Started</span></a></div></div>
							<!-- /wp:blockspare/blockspare-buttons -->',
							'imagePath'    => 'buttons',
						),
						array(
							'type'     => 'block',
							'item'     => ['Button'],
							'key'      => 'bs_button_4',
							'name'     => esc_html__( 'Button 4', 'blockspare' ),
							'content'  => '<!-- wp:blockspare/blockspare-buttons {"sectionAlignment":"left","uniqueClass":"blockspare-86787f49-a441-4","buttonText":"Download","buttonBackgroundColor":"#ea4b50","buttonShape":"blockspare-button-shape-circular","buttonFontFamily":"Poppins","buttonFontWeight":"400","buttonFontSubset":"latin","buttonLoadGoogleFonts":true,"marginTop":0,"marginBottom":0} -->
							<div class="wp-block-blockspare-blockspare-buttons blockspare-86787f49-a441-4 blockspare-block-button-wrap" blockspare-animation=""><style>.blockspare-86787f49-a441-4 .blockspare-block-button{text-align:left;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px}.blockspare-86787f49-a441-4 .blockspare-block-button span{color:#fff;border-width:2px;font-size:16px;font-family:Poppins;font-weight:400}.blockspare-86787f49-a441-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button{background-color:#ea4b50}.blockspare-86787f49-a441-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:visited{background-color:#ea4b50}.blockspare-86787f49-a441-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:focus{background-color:#ea4b50}.blockspare-86787f49-a441-4 .blockspare-block-button a{padding-top:12px;padding-bottom:12px;padding-right:22px;padding-left:22px}@media screen and (max-width:1025px){.blockspare-86787f49-a441-4 .blockspare-block-button span{font-size:14px}}@media screen and (max-width:768px){.blockspare-86787f49-a441-4 .blockspare-block-button span{font-size:12px}}</style><div class="blockspare-block-button"><a href="#" class="blockspare-button blockspare-button-shape-circular blockspare-button-size-small"><span>Download</span></a></div></div>
							<!-- /wp:blockspare/blockspare-buttons -->',
							'imagePath'    => 'buttons',
						),
						array(
							'type'     => 'block',
							'item'     => ['Button'],
							'key'      => 'bs_button_5',
							'name'     => esc_html__( 'Button 5', 'blockspare' ),
							'content'  => '<!-- wp:blockspare/blockspare-buttons {"sectionAlignment":"left","uniqueClass":"blockspare-b58b675e-aed8-4","buttonBackgroundColor":"#275be2","buttonFontFamily":"Helvetica","enableButtonIcon":true,"buttonIcon":"fas fa-hand-point-right","marginTop":0} -->
							<div class="wp-block-blockspare-blockspare-buttons blockspare-b58b675e-aed8-4 blockspare-block-button-wrap" blockspare-animation=""><style>.blockspare-b58b675e-aed8-4 .blockspare-block-button{text-align:left;margin-top:0px;margin-bottom:30px;margin-left:0px;margin-right:0px}.blockspare-b58b675e-aed8-4 .blockspare-block-button i{color:#fff}.blockspare-b58b675e-aed8-4 .blockspare-block-button span{color:#fff;border-width:2px;font-size:16px;font-family:Helvetica;font-weight:500}.blockspare-b58b675e-aed8-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button{background-color:#275be2}.blockspare-b58b675e-aed8-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:visited{background-color:#275be2}.blockspare-b58b675e-aed8-4.wp-block-blockspare-blockspare-buttons .blockspare-block-button .blockspare-button:focus{background-color:#275be2}.blockspare-b58b675e-aed8-4 .blockspare-block-button a{padding-top:12px;padding-bottom:12px;padding-right:22px;padding-left:22px}@media screen and (max-width:1025px){.blockspare-b58b675e-aed8-4 .blockspare-block-button span{font-size:14px}}@media screen and (max-width:768px){.blockspare-b58b675e-aed8-4 .blockspare-block-button span{font-size:12px}}</style><div class="blockspare-block-button"><a class="blockspare-button blockspare-button-shape-rounded blockspare-button-size-small btn-icon-left"><i class="fas fa-hand-point-right"></i><span>Get Started</span></a></div></div>
							<!-- /wp:blockspare/blockspare-buttons -->',
							'imagePath'    => 'buttons',
						)
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Buttons_Template_Block::get_instance()->run();