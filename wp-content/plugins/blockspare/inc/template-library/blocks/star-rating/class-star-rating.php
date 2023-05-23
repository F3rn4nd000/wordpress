<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Blockspare_Star_Rating_Template_Block' ) ) {

	class Blockspare_Star_Rating_Template_Block extends Blockspare_Import_Block_Base{
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
						'item'     => ['Star Rating'],
						'key'      => 'bs_star_rating_1',
						'name'     => esc_html__( 'Star Rating 1', 'blockspare' ),
						'content'  => '<!-- wp:blockspare/blockspare-star-ratings {"uniqueClass":"blockspare-504edda6-3a53-4","starCount":8,"starSize":30,"starColor":"#e74c3c","selectedStars":4.5} -->
						<div class="wp-block-blockspare-blockspare-star-ratings blockspare-504edda6-3a53-4 blockspare-ratings" blockspare-animation=""><style>.blockspare-504edda6-3a53-4 .blockspare-block-star-ratings-wrap{background-color:transparent;margin-top:30px;margin-bottom:30px;margin-left:0px;margin-right:0px}.blockspare-504edda6-3a53-4 .empty-star-rating{opacity:0.4}</style><div class="blockspare-block-star-ratings-wrap"><div class="blockspare-star-inner-container star-align-center"><div class="blockspare-ratings"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><polygon points="255,402.212 412.59,497.25 370.897,318.011 510,197.472 326.63,181.738 255,12.75 183.371,181.738 0,197.472 139.103,318.011 97.41,497.25"></polygon></svg></div><div class="blockspare-ratings"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><polygon points="255,402.212 412.59,497.25 370.897,318.011 510,197.472 326.63,181.738 255,12.75 183.371,181.738 0,197.472 139.103,318.011 97.41,497.25"></polygon></svg></div><div class="blockspare-ratings"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><polygon points="255,402.212 412.59,497.25 370.897,318.011 510,197.472 326.63,181.738 255,12.75 183.371,181.738 0,197.472 139.103,318.011 97.41,497.25"></polygon></svg></div><div class="blockspare-ratings"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><polygon points="255,402.212 412.59,497.25 370.897,318.011 510,197.472 326.63,181.738 255,12.75 183.371,181.738 0,197.472 139.103,318.011 97.41,497.25"></polygon></svg></div><div class="blockspare-ratings"> <svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><path d="M510,197.472l-183.37-15.734L255,12.75l-71.629,168.988L0,197.472l0,0l0,0l139.103,120.539L97.41,497.25L255,402.186l0,0 l157.59,95.039l-41.692-179.239L510,197.472z M255,354.348V117.172l43.605,102.918l111.689,9.588l-84.711,73.389l25.398,109.166 L255,354.348z"></path></svg></div><div class="blockspare-ratings empty-star-rating"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><path d="M510,197.472l-183.37-15.734L255,12.75l-71.629,168.988L0,197.472l139.103,120.539L97.41,497.25L255,402.186 l157.59,95.064l-41.692-179.239L510,197.472z M255,354.348l-95.957,57.886l25.398-109.166l-84.736-73.389l111.69-9.588 L255,117.172l43.605,102.918l111.689,9.588l-84.711,73.389l25.398,109.166L255,354.348z"></path></svg></div><div class="blockspare-ratings empty-star-rating"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><path d="M510,197.472l-183.37-15.734L255,12.75l-71.629,168.988L0,197.472l139.103,120.539L97.41,497.25L255,402.186 l157.59,95.064l-41.692-179.239L510,197.472z M255,354.348l-95.957,57.886l25.398-109.166l-84.736-73.389l111.69-9.588 L255,117.172l43.605,102.918l111.689,9.588l-84.711,73.389l25.398,109.166L255,354.348z"></path></svg></div><div class="blockspare-ratings empty-star-rating"><svg xmlns="http://www.w3.org/2000/svg" fill="#e74c3c" width="30" height="30" viewBox="0 0 510 510"><path d="M510,197.472l-183.37-15.734L255,12.75l-71.629,168.988L0,197.472l139.103,120.539L97.41,497.25L255,402.186 l157.59,95.064l-41.692-179.239L510,197.472z M255,354.348l-95.957,57.886l25.398-109.166l-84.736-73.389l111.69-9.588 L255,117.172l43.605,102.918l111.689,9.588l-84.711,73.389l25.398,109.166L255,354.348z"></path></svg></div></div></div></div>
						<!-- /wp:blockspare/blockspare-star-ratings -->',
                    ),
                    array(
						'type'     => 'block',
						'item'     => ['Star Rating'],
						'key'      => 'bs_star_rating_2',
						'name'     => esc_html__( 'Star_Rating 2', 'blockspare' ),
						'content'  => BLOCKSPARE_PRO_PATH,
                    )
				);

            return array_merge_recursive( $blocks_lists, $block_library_list );
        }
	}
}
Blockspare_Star_Rating_Template_Block::get_instance()->run();