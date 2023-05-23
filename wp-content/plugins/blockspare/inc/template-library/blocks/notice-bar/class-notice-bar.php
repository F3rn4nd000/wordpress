<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Notice_Bar_Template_Block' ) ) {

	class Blockspare_Notice_Bar_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Notice Bar'],
						'key'      => 'bs_notice_bar_1',
						'imagePath'=>'notice-bar',
						'name'     => esc_html__( 'Notice Bar 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-notice-bar {"uniqueClass":"blockspare-af93734c-f501-4","buttonText":"Accept","buttonBackgroundColor":"#d31600","buttonHoverEffect":"hover-style-1","align":"wide","backGroundColor":"#ffdddb","boxBorderColor":"#d31600","noticeContent":"We use your information – collected through cookies and similar technologies – to improve your experience on our site, analyze how you use it and show you personalized advertising.","marginTop":100,"marginBottom":100,"enableNoticeIcons":true,"name":"blockspare-notice-bell-outline","iconColor":"#d31600","iconSize":40} -->
						<div class="wp-block-blockspare-blockspare-notice-bar blockspare-af93734c-f501-4 blockspare-notice-block alignwide" blockspare-animation=""><style>.blockspare-af93734c-f501-4 .blockspare-noticebar-wrapper{background-color:#ffdddb;border-color:#d31600;text-align:left;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px;margin-top:100px;margin-bottom:100px}.blockspare-af93734c-f501-4 .blockspare-noticebar-wrapper .blockspare-notice-icon{color:#d31600;font-size:40px}.blockspare-af93734c-f501-4 .blockspare-section-notice-wrap{text-align:left}.blockspare-af93734c-f501-4 .blockspare-notice-content{color:#4c4c4c;font-size:18px!important;font-weight:500}@media screen and (max-width:1025px){.blockspare-af93734c-f501-4 .blockspare-notice-content{font-size:16px!important}}@media screen and (max-width:768px){.blockspare-af93734c-f501-4 .blockspare-notice-content{font-size:14px!important}}</style><div class="blockspare-noticebar-wrapper blockspare-blocks blockspare-hover-item"><div class="blockspare-section-notice-wrap notice-img-icon"><span class="blockspare-notice-icon blockspare-notice-bell-outline"></span><div class="blockspare-title-wrap"><div><div class="blockspare-notice-content">We use your information – collected through cookies and similar technologies – to improve your experience on our site, analyze how you use it and show you personalized advertising.</div></div></div></div></div></div>
						<!-- /wp:blockspare/blockspare-notice-bar -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Notice Bar'],
						'key'      => 'bs_notice_bar_2',
						'imagePath'=>'notice-bar',
						'name'     => esc_html__( 'Notice Bar 2', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Notice_Bar_Template_Block::get_instance()->run();