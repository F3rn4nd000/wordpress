<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Page_Template_Block' ) ) {

	class Blockspare_Page_Template_Block extends Blockspare_Import_Block_Base{
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
						'type'     => 'page',
                        'item'     => ['Frontpage','Agency'],
						'key'      => 'bs_page_1',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Agency  Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Agency'],
						'key'      => 'bs_page_2',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Agency  About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Agency'],
						'key'      => 'bs_page_3',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Agency  Services', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Contact Us','Agency'],
						'key'      => 'bs_page_4',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Agency  Contact Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Lawyer'],
						'key'      => 'bs_page_5',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Lawyer Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Contact Us','Lawyer'],
						'key'      => 'bs_page_6',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Lawyer Contact Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Restaurant'],
						'key'      => 'bs_page_7',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Restaurant Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Contact Us','Restaurant'],
						'key'      => 'bs_page_8',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Restaurant Contact Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Restaurant'],
						'key'      => 'bs_page_9',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Restaurant About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Menu','Restaurant'],
						'key'      => 'bs_page_10',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Restaurant Menu', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Restaurant'],
						'key'      => 'bs_page_11',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Restaurant Food Website', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Apps'],
						'key'      => 'bs_page_12',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Apps Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Education'],
						'key'      => 'bs_page_13',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Education Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Education'],
						'key'      => 'bs_page_14',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Education About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Education'],
						'key'      => 'bs_page_15',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Education Courses', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Fitness'],
						'key'      => 'bs_page_16',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Fitness Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Pricing Table','Fitness'],
						'key'      => 'bs_page_17',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Fitness Pricing Table', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Fitness'],
						'key'      => 'bs_page_18',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Fitness About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Fitness'],
						'key'      => 'bs_page_19',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Fitness Services', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Testimonial','Fitness'],
						'key'      => 'bs_page_20',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Fitness Team', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Real Estate'],
						'key'      => 'bs_page_21',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Real Estate Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Real Estate'],
						'key'      => 'bs_page_22',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Real Estate About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Property Details','Real Estate'],
						'key'      => 'bs_page_23',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Real Estate Property Details', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Medical'],
						'key'      => 'bs_page_24',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Medical Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Medical'],
						'key'      => 'bs_page_25',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Medical About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Medical'],
						'key'      => 'bs_page_26',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Medical Special Offer', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Frontpage','Charity'],
						'key'      => 'bs_page_27',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Charity Home', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Event','Charity'],
						'key'      => 'bs_page_28',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Charity Our Event', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['Services','Charity'],
						'key'      => 'bs_page_29',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Charity Volunteer', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    ),
					array(
						'type'     => 'page',
                        'item'     => ['About Us','Real Charity'],
						'key'      => 'bs_page_30',
                        'imagePath'=>'pages',
						'name'     => esc_html__( 'Charity About Us', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH	
                    )

			    );

             return array_merge_recursive( $blocks_lists, $block_library_list );
        }
    }
}
Blockspare_Page_Template_Block::get_instance()->run();