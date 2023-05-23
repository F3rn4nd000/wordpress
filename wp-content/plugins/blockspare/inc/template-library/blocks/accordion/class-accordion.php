<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Accordion_Template_Block' ) ) {

	class Blockspare_Accordion_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Accordion'],
						'key'      => 'bs_accrodion_1',
						'name'     => esc_html__( 'Accordion 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-accordion {"uniqueClass":"blockspare-ca6b2358-41fb-4","className":"blockspare-block blockspare-block-34a78d","uniqueId":"ca6b23"} -->
						<div class="blockspare-block-accordion wp-block-blockspare-blockspare-accordion blockspare-block blockspare-block-34a78d blockspare-ca6b2358-41fb-4" data-item-toggle="true" blockspare-animation=""><div class=" blockspare-block-accordion-wraps blockspare-block-ca6b23"><style>.blockspare-ca6b2358-41fb-4 .blockspare-block-accordion-wraps{padding-top:20px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-bottom:30px}.blockspare-ca6b2358-41fb-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:18px;font-weight:500}@media screen and (max-width:1025px){.blockspare-ca6b2358-41fb-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:16px}}@media screen and (max-width:768px){.blockspare-ca6b2358-41fb-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:14px}}</style><!-- wp:blockspare/accordion-item {"uniqueId":"e0d902","itemNumber":0,"heading":"Collect Ideas","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","panelColor":"#cffbf1","panelActiveColor":"#cffbf1","textColor":"#2e947d","marginBottom":15,"activeTextColor":"#2e947d"} -->
						<div class="wp-block-blockspare-accordion-item blockspare-block-e0d902"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#2e947d" data-txt-color="#2e947d" data-active="#cffbf1" data-pan="#cffbf1" style="margin-bottom:15px"><div class="blockspare-accordion-panel  blockspare-right" style="background-color:#cffbf1"><span class="blockspare-accordion-panel-handler" role="button" style="color:#2e947d"><span class="blockspare-accordion-icon fa fa-plus"></span><span class="blockspare-accordion-panel-handler-label">Collect Ideas</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
						<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
						<!-- /wp:paragraph --></div></div></div>
						<!-- /wp:blockspare/accordion-item -->
						
						<!-- wp:blockspare/accordion-item {"uniqueId":"f3be57","itemNumber":1,"heading":"Data Analysis","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","panelColor":"#cffbf1","panelActiveColor":"#cffbf1","textColor":"#2e947d","marginBottom":15,"activeTextColor":"#2e947d"} -->
						<div class="wp-block-blockspare-accordion-item blockspare-block-f3be57"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#2e947d" data-txt-color="#2e947d" data-active="#cffbf1" data-pan="#cffbf1" style="margin-bottom:15px"><div class="blockspare-accordion-panel  blockspare-right" style="background-color:#cffbf1"><span class="blockspare-accordion-panel-handler" role="button" style="color:#2e947d"><span class="blockspare-accordion-icon fa fa-plus"></span><span class="blockspare-accordion-panel-handler-label">Data Analysis</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
						<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
						<!-- /wp:paragraph --></div></div></div>
						<!-- /wp:blockspare/accordion-item -->
						
						<!-- wp:blockspare/accordion-item {"uniqueId":"576291","itemNumber":2,"heading":"Finalize Product","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","panelColor":"#cffbf1","panelActiveColor":"#cffbf1","textColor":"#2e947d","marginBottom":15,"activeTextColor":"#2e947d"} -->
						<div class="wp-block-blockspare-accordion-item blockspare-block-576291"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#2e947d" data-txt-color="#2e947d" data-active="#cffbf1" data-pan="#cffbf1" style="margin-bottom:15px"><div class="blockspare-accordion-panel  blockspare-right" style="background-color:#cffbf1"><span class="blockspare-accordion-panel-handler" role="button" style="color:#2e947d"><span class="blockspare-accordion-icon fa fa-plus"></span><span class="blockspare-accordion-panel-handler-label">Finalize Product</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
						<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
						<!-- /wp:paragraph --></div></div></div>
						<!-- /wp:blockspare/accordion-item -->
						
						<!-- wp:blockspare/accordion-item {"uniqueId":"88ad0c","itemNumber":2,"heading":"Submit Product ","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","panelColor":"#cffbf1","panelActiveColor":"#cffbf1","textColor":"#2e947d","marginBottom":15,"activeTextColor":"#2e947d"} -->
						<div class="wp-block-blockspare-accordion-item blockspare-block-88ad0c"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#2e947d" data-txt-color="#2e947d" data-active="#cffbf1" data-pan="#cffbf1" style="margin-bottom:15px"><div class="blockspare-accordion-panel  blockspare-right" style="background-color:#cffbf1"><span class="blockspare-accordion-panel-handler" role="button" style="color:#2e947d"><span class="blockspare-accordion-icon fa fa-plus"></span><span class="blockspare-accordion-panel-handler-label">Submit Product </span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
						<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
						<!-- /wp:paragraph --></div></div></div>
						<!-- /wp:blockspare/accordion-item --></div></div>
						<!-- /wp:blockspare/blockspare-accordion -->',
						'imagePath'    => 'accordions',
				),
				array(
					'type'     => 'block',
					'item'     => ['Accordion'],
					'key'      => 'bs_accrodion_2',
					'name'     => esc_html__( 'Accordion 2', 'blockspare' ),
					'content'  => '<!-- wp:blockspare/blockspare-accordion {"uniqueClass":"blockspare-37c0ca77-8e87-4","className":"blockspare-block blockspare-block-76ea48","uniqueId":"37c0ca","titleFontFamily":"Helvetica"} -->
					<div class="blockspare-block-accordion wp-block-blockspare-blockspare-accordion blockspare-block blockspare-block-76ea48 blockspare-37c0ca77-8e87-4" data-item-toggle="true" blockspare-animation=""><div class=" blockspare-block-accordion-wraps blockspare-block-37c0ca"><style>.blockspare-37c0ca77-8e87-4 .blockspare-block-accordion-wraps{padding-top:20px;padding-right:0px;padding-bottom:20px;padding-left:0px;margin-top:30px;margin-bottom:30px}.blockspare-37c0ca77-8e87-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:18px;font-family:Helvetica;font-weight:500}@media screen and (max-width:1025px){.blockspare-37c0ca77-8e87-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:16px}}@media screen and (max-width:768px){.blockspare-37c0ca77-8e87-4 .blockspare-accordion-item .blockspare-accordion-panel span.blockspare-accordion-panel-handler-label{font-size:14px}}</style><!-- wp:blockspare/accordion-item {"uniqueId":"2e8ccc","itemNumber":0,"heading":"Accordion Item 1","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","name":"fas fa-arrow-up","iconPosition":"blockspare-left","panelColor":"#b69d74","panelActiveColor":"#efe7d9","activeTextColor":"#b69d74"} -->
					<div class="wp-block-blockspare-accordion-item blockspare-block-2e8ccc"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#b69d74" data-txt-color="#fff" data-active="#efe7d9" data-pan="#b69d74" style="margin-bottom:10px"><div class="blockspare-accordion-panel  blockspare-left" style="background-color:#b69d74"><span class="blockspare-accordion-panel-handler" role="button" style="color:#fff"><span class="blockspare-accordion-icon fas fa-arrow-up"></span><span class="blockspare-accordion-panel-handler-label">Accordion Item 1</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
					<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
					<!-- /wp:paragraph --></div></div></div>
					<!-- /wp:blockspare/accordion-item -->
					
					<!-- wp:blockspare/accordion-item {"uniqueId":"a97fcd","itemNumber":1,"heading":"Accordion Item 2","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","name":"fas fa-arrow-up","iconPosition":"blockspare-left","panelColor":"#b69d74","panelActiveColor":"#efe7d9","activeTextColor":"#b69d74"} -->
					<div class="wp-block-blockspare-accordion-item blockspare-block-a97fcd"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#b69d74" data-txt-color="#fff" data-active="#efe7d9" data-pan="#b69d74" style="margin-bottom:10px"><div class="blockspare-accordion-panel  blockspare-left" style="background-color:#b69d74"><span class="blockspare-accordion-panel-handler" role="button" style="color:#fff"><span class="blockspare-accordion-icon fas fa-arrow-up"></span><span class="blockspare-accordion-panel-handler-label">Accordion Item 2</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
					<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
					<!-- /wp:paragraph --></div></div></div>
					<!-- /wp:blockspare/accordion-item -->
					
					<!-- wp:blockspare/accordion-item {"uniqueId":"8ceaa9","itemNumber":2,"heading":"Accordion Item 3","defaultText":"Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.","name":"fas fa-arrow-up","iconPosition":"blockspare-left","panelColor":"#b69d74","panelActiveColor":"#efe7d9","activeTextColor":"#b69d74"} -->
					<div class="wp-block-blockspare-accordion-item blockspare-block-8ceaa9"><div class="blockspare-accordion-item blockspare-hover-item blockspare-type-fill " data-act-color="#b69d74" data-txt-color="#fff" data-active="#efe7d9" data-pan="#b69d74" style="margin-bottom:10px"><div class="blockspare-accordion-panel  blockspare-left" style="background-color:#b69d74"><span class="blockspare-accordion-panel-handler" role="button" style="color:#fff"><span class="blockspare-accordion-icon fas fa-arrow-up"></span><span class="blockspare-accordion-panel-handler-label">Accordion Item 3</span></span></div><div class="blockspare-accordion-body" style="background-color:#fff" data-bg="#fff"><!-- wp:paragraph -->
					<p>Ipsam per dolores minus natoque? Rutrum dolorem voluptates euismod pharetra! Rhoncus distinctio cupiditate accusantium. Cillum aliquid.</p>
					<!-- /wp:paragraph --></div></div></div>
					<!-- /wp:blockspare/accordion-item --></div></div>
					<!-- /wp:blockspare/blockspare-accordion -->',
					'imagePath'    => 'accordions',
				)	
			);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Accordion_Template_Block::get_instance()->run();