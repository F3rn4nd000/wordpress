<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Progressbar_Template_Block' ) ) {

	class Blockspare_Progressbar_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Progressbar'],
						'key'      => 'bs_progressbar_1',
						'name'     => esc_html__( 'Progressbar 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-container {"enableGradient":true,"backgroundColor1":"#00d084","backgroundColor2":"#7bdcb5","uniqueClass":"blockspare-91f4179a-b8c6-4"} -->
						<div class="wp-block-blockspare-blockspare-container alignfull blockspare-91f4179a-b8c6-4" blockspare-animation=""><style>.blockspare-91f4179a-b8c6-4 .blockspare-block-container-wrapper{background-image:linear-gradient(-90deg,#00d084 30%,#7bdcb5 70%);padding-top:20px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-right:0px;margin-bottom:30px;margin-left:0px;border-radius:0}.blockspare-91f4179a-b8c6-4 .blockspare-image-wrap{background-image:none}</style><div class="blockspare-block-container-wrapper blockspare-hover-item"><div class="blockspare-container-background blockspare-image-wrap has-background-opacity-100 has-background-opacity"></div><div class="blockspare-container"><div class="blockspare-inner-blocks blockspare-inner-wrapper-blocks"><!-- wp:columns {"align":"wide"} -->
						<div class="wp-block-columns alignwide"><!-- wp:column {"width":"66.66%"} -->
						<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:image {"id":154,"sizeSlug":"large"} -->
						<figure class="wp-block-image size-large"><img src="https://www.blockspare.com/wp-content/uploads/2020/03/woman-in-a-multicolored-swimsuit-sitting-on-beach-3722173-683x1024.jpg" alt="" class="wp-image-154"/></figure>
						<!-- /wp:image -->
						
						<!-- wp:paragraph -->
						<p></p>
						<!-- /wp:paragraph --></div>
						<!-- /wp:column -->
						
						<!-- wp:column {"width":"33.33%"} -->
						<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:blockspare/blockspare-section-header {"uniqueClass":"blockspare-f393039e-5690-4","sectionAlignment":"left","headerTitle":"Why Me?","titleFontSize":45,"headerSubTitle":"MY SKILLS","headertitleColor":"#f7f7f7","headersubtitleColor":"#f7f7f7","headermarginTop":100,"headermarginBottom":0,"headerlayoutOption":"blockspare-style4","subtitlePaddingBottom":10,"dashColor":"#f7f7f7"} -->
						<div class="wp-block-blockspare-blockspare-section-header aligncenter blockspare-f393039e-5690-4 blockspare-section-header-wrapper blockspare-blocks aligncenter" blockspare-animation=""><style>.blockspare-f393039e-5690-4 .blockspare-section-head-wrap{background-color:transparent;text-align:left;margin-top:100px;margin-right:30px;margin-bottom:0px;margin-left:30px}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-title{color:#f7f7f7;font-size:45px;font-weight:500;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-subtitle{color:#f7f7f7;font-size:18px;font-weight:500;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:0px}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style2 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style4 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style5 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style6 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style7 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style8 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style9 .blockspare-title-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style16 .blockspare-title-wrapper .blockspare-upper-dash{color:#f7f7f7}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style11 .blockspare-title-wrapper .blockspare-title:after,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style15 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style15.blockspare-center .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper .blockspare-title,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style19 .blockspare-title-wrapper .blockspare-title:before{background-color:#f7f7f7}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-title,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style18 .blockspare-title-wrapper{border-bottom-color:#f7f7f7}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style17 .blockspare-title-wrapper .blockspare-title:before{border-top-color:#f7f7f7}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style10 .blockspare-title-wrapper .blockspare-upper-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style12 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style13 .blockspare-title-wrapper .blockspare-lower-dash,.blockspare-f393039e-5690-4 .blockspare-section-head-wrap.blockspare-style14 .blockspare-title-wrapper .blockspare-upper-dash{background-color:#E5EFE3}@media screen and (max-width:1025px){.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-title{font-size:26px}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:16px}}@media screen and (max-width:768px){.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-title{font-size:20px}.blockspare-f393039e-5690-4 .blockspare-section-head-wrap .blockspare-subtitle{font-size:14px}}</style><div class="blockspare-section-head-wrap blockspare-style4 blockspare-left blockspare-hover-item"><div class="blockspare-title-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><h2 class="blockspare-title">Why Me?</h2><span class="blockspare-title-dash blockspare-lower-dash"></span></div><div class="blockspare-subtitle-wrapper"><span class="blockspare-title-dash blockspare-upper-dash"></span><p class="blockspare-subtitle">MY SKILLS</p><span class="blockspare-title-dash blockspare-lower-dash"></span></div></div></div>
						<!-- /wp:blockspare/blockspare-section-header -->
						
						<!-- wp:paragraph {"textColor":"base"} -->
						<p class="has-base-color has-text-color">Maecenas nec odio et ante tincidunt tempus. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Suspendisse non nisl sit amet velit hendrerit rutrum. Phasellus blandit leo ut odio. Fusce fermentum.</p>
						<!-- /wp:paragraph -->
						
						<!-- wp:paragraph {"textColor":"base"} -->
						<p class="has-base-color has-text-color">Fusce egestas elit eget lorem. Phasellus tempus. Vivamus laoreet. Aenean massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
						<!-- /wp:paragraph -->
						
						<!-- wp:blockspare/blockspare-empty-section {"height":20,"uniqueClass":"blockspare-158b4ce0-bd5c-4","fillType":"transparent"} -->
						<div class="wp-block-blockspare-blockspare-empty-section blockspare-158b4ce0-bd5c-4 blockspare-blocks blockspare-empty-section-wrapper" blockspare-animation=""><style>.blockspare-158b4ce0-bd5c-4 .blockspare-emptysection{height:20px;width:100%}</style><div class="blockspare-emptysection blockspare-hover-item"></div></div>
						<!-- /wp:blockspare/blockspare-empty-section -->
						
						<!-- wp:blockspare/blockspare-linearprogressbar {"uniqueClass":"blockspare-2316431d-0eb6-4","className":"blockspare-block-progress-bar blockspare-b32c23a5-9fe5-4","uniqueId":"231643"} -->
						<div class="wp-block-blockspare-blockspare-linearprogressbar aligncenter blockspare-block-progress-bar blockspare-b32c23a5-9fe5-4 blockspare-2316431d-0eb6-4 blockspare-block-interaction blockspare-block-231643 aligncenter" blockspare-animation=""><div class="blockspare-block-progress-bar"><style>.blockspare-2316431d-0eb6-4 .blockspare-block-progress-bar{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;margin-top:30px;margin-bottom:30px}</style><!-- wp:blockspare/blockspare-skillbar {"uniqueClass":"blockspare-659032b7-2483-4","title":"\u003cstrong\u003ePhotoshop\u003c/strong\u003e","textColor":"#f7f7f7","percentageTextColor":"#f7f7f7","percentage":90,"barColor":"#f7f7f7","backgroundColor":"#030f3e","barThickness":1} -->
						<div class="wp-block-blockspare-blockspare-skillbar blockspare-659032b7-2483-4 blockspare-progressbar-wrap"><style>.blockspare-659032b7-2483-4 .blockspare-title{text-align:left;color:#f7f7f7;font-size:20px!important;font-weight:500}.blockspare-659032b7-2483-4 .blockspare_progress-bar-label{color:#f7f7f7}.blockspare-659032b7-2483-4 .blockspare-skillbar{background-color:#030f3e}.blockspare-659032b7-2483-4 .blockspare-skillbar-bar{background-color:#f7f7f7}@media screen and (max-width:1025px){.blockspare-659032b7-2483-4 .blockspare-title{font-size:16px!important}}@media screen and (max-width:768px){.blockspare-659032b7-2483-4 .blockspare-title{font-size:14px!important}}</style><div class="blockspare_progress-bar-container"><div class="blockspare-precent-text-wrap"><div class="blockspare-title blockspare-progress-title"><strong>Photoshop</strong></div><div class="blockspare_progress-bar-label">90%</div></div><div class="blockspare-skillbar-item" data-percent="90"><div class="blockspare-skillbar barthickness-1 blockspare-hover-item"><div class="blockspare-skillbar-bar"></div></div></div></div></div>
						<!-- /wp:blockspare/blockspare-skillbar -->
						
						<!-- wp:blockspare/blockspare-skillbar {"uniqueClass":"blockspare-174d18d8-2dba-4","title":"Illustrator","textColor":"#f7f7f7","percentageTextColor":"#f7f7f7","percentage":95,"barColor":"#f7f7f7","backgroundColor":"#030f3e","barThickness":1} -->
						<div class="wp-block-blockspare-blockspare-skillbar blockspare-174d18d8-2dba-4 blockspare-progressbar-wrap"><style>.blockspare-174d18d8-2dba-4 .blockspare-title{text-align:left;color:#f7f7f7;font-size:20px!important;font-weight:500}.blockspare-174d18d8-2dba-4 .blockspare_progress-bar-label{color:#f7f7f7}.blockspare-174d18d8-2dba-4 .blockspare-skillbar{background-color:#030f3e}.blockspare-174d18d8-2dba-4 .blockspare-skillbar-bar{background-color:#f7f7f7}@media screen and (max-width:1025px){.blockspare-174d18d8-2dba-4 .blockspare-title{font-size:16px!important}}@media screen and (max-width:768px){.blockspare-174d18d8-2dba-4 .blockspare-title{font-size:14px!important}}</style><div class="blockspare_progress-bar-container"><div class="blockspare-precent-text-wrap"><div class="blockspare-title blockspare-progress-title">Illustrator</div><div class="blockspare_progress-bar-label">95%</div></div><div class="blockspare-skillbar-item" data-percent="95"><div class="blockspare-skillbar barthickness-1 blockspare-hover-item"><div class="blockspare-skillbar-bar"></div></div></div></div></div>
						<!-- /wp:blockspare/blockspare-skillbar -->
						
						<!-- wp:blockspare/blockspare-skillbar {"uniqueClass":"blockspare-607b99da-5cff-4","title":"Indesign","textColor":"#f7f7f7","percentageTextColor":"#f7f7f7","percentage":80,"barColor":"#f7f7f7","backgroundColor":"#030f3e","barThickness":1} -->
						<div class="wp-block-blockspare-blockspare-skillbar blockspare-607b99da-5cff-4 blockspare-progressbar-wrap"><style>.blockspare-607b99da-5cff-4 .blockspare-title{text-align:left;color:#f7f7f7;font-size:20px!important;font-weight:500}.blockspare-607b99da-5cff-4 .blockspare_progress-bar-label{color:#f7f7f7}.blockspare-607b99da-5cff-4 .blockspare-skillbar{background-color:#030f3e}.blockspare-607b99da-5cff-4 .blockspare-skillbar-bar{background-color:#f7f7f7}@media screen and (max-width:1025px){.blockspare-607b99da-5cff-4 .blockspare-title{font-size:16px!important}}@media screen and (max-width:768px){.blockspare-607b99da-5cff-4 .blockspare-title{font-size:14px!important}}</style><div class="blockspare_progress-bar-container"><div class="blockspare-precent-text-wrap"><div class="blockspare-title blockspare-progress-title">Indesign</div><div class="blockspare_progress-bar-label">80%</div></div><div class="blockspare-skillbar-item" data-percent="80"><div class="blockspare-skillbar barthickness-1 blockspare-hover-item"><div class="blockspare-skillbar-bar"></div></div></div></div></div>
						<!-- /wp:blockspare/blockspare-skillbar -->
						
						<!-- wp:blockspare/blockspare-skillbar {"uniqueClass":"blockspare-92de185a-304c-4","title":"XD","textColor":"#f7f7f7","percentageTextColor":"#f7f7f7","percentage":85,"barColor":"#f7f7f7","backgroundColor":"#030f3e","barThickness":1} -->
						<div class="wp-block-blockspare-blockspare-skillbar blockspare-92de185a-304c-4 blockspare-progressbar-wrap"><style>.blockspare-92de185a-304c-4 .blockspare-title{text-align:left;color:#f7f7f7;font-size:20px!important;font-weight:500}.blockspare-92de185a-304c-4 .blockspare_progress-bar-label{color:#f7f7f7}.blockspare-92de185a-304c-4 .blockspare-skillbar{background-color:#030f3e}.blockspare-92de185a-304c-4 .blockspare-skillbar-bar{background-color:#f7f7f7}@media screen and (max-width:1025px){.blockspare-92de185a-304c-4 .blockspare-title{font-size:16px!important}}@media screen and (max-width:768px){.blockspare-92de185a-304c-4 .blockspare-title{font-size:14px!important}}</style><div class="blockspare_progress-bar-container"><div class="blockspare-precent-text-wrap"><div class="blockspare-title blockspare-progress-title">XD</div><div class="blockspare_progress-bar-label">85%</div></div><div class="blockspare-skillbar-item" data-percent="85"><div class="blockspare-skillbar barthickness-1 blockspare-hover-item"><div class="blockspare-skillbar-bar"></div></div></div></div></div>
						<!-- /wp:blockspare/blockspare-skillbar --></div></div>
						<!-- /wp:blockspare/blockspare-linearprogressbar --></div>
						<!-- /wp:column --></div>
						<!-- /wp:columns --></div></div></div></div>
						<!-- /wp:blockspare/blockspare-container -->',
						'imagePath'    => 'progressbar',
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Progressbar_Template_Block::get_instance()->run();