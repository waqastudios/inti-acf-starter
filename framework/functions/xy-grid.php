<?php
/**
 * XY Grid cells
 * Handles the switch to define grid layout and cells
 *
 * @package Inti
 * @since 1.5.0
 */

add_action('inti_hook_grid_open', 'inti_xy_grid_open'); 
if (!function_exists('inti_xy_grid_open')) {
	function inti_xy_grid_open() {

		$layout = inti_get_layout(get_inti_option('', '', '', '_inti_layout_radio'));
		
		switch ( $layout ) { 
			case '1c': ?>

			<div class="grid-container layout-1c">
				<div class="grid-x grid-margin-x">
					<div class="small-12 medium-12 large-12 cell">
			


		<?php break;
			case '2c-l': ?>

			<div class="grid-container layout-2c-l">
				<div class="grid-x grid-margin-x">
					<div class="small-12 medium-7 large-8 cell">
			


		<?php break;
			case '2c-r': ?>

			<div class="grid-container layout-2c-r">
				<div class="grid-x grid-margin-x">
					<div class="small-12 medium-7 medium-order-2 large-8 cell">
			


		<?php break;
			case '1c-thin': ?>

			<div class="grid-container layout-1c-thin">
				<div class="grid-x grid-margin-x align-center-middle">
					<div class="small-12 medium-10 large-9 cell">
			


		<?php break;
			case 'blog-standard': ?>

			<div class="grid-container blog layout-blog">
				<div class="grid-x" id="loadposts">
			


		<?php break;
			case 'blog-grid': ?>

			<div class="grid-container blog layout-blog">
				<div class="grid-x grid-margin-x grid-margin-y mlarge-up-2 large-up-3" id="loadposts">



		<?php break;
			case 'full-xygrid': ?>

			<div class="grid-container full layout-full-grid">
				<div class="grid-x">
					<div class="cell">
			


		<?php break;
			case 'fluid-xygrid': ?>

			<div class="grid-container fluid layout-fluid-grid">
				<div class="grid-x">
					<div class="cell">


		<?php } //end switch 
	}
}

add_action('inti_hook_grid_close', 'inti_xy_grid_close'); 
if (!function_exists('inti_xy_grid_close')) {
	function inti_xy_grid_close() { 
		$layout = inti_get_layout(get_inti_option('', '', '', '_inti_layout_radio')); 
		?>

		<?php 	
		switch ( $layout ) { 
			case 'blog-standard': ?>

				</div><!-- .grid-x -->
			</div><!-- .grid-container -->	
			

		<?php break;
			case 'blog-grid': ?>

				</div><!-- .grid-x -->
			</div><!-- .grid-container -->	
			

		<?php break;
			case 'full-xygrid': ?>
					</div><!-- .cell -->
				</div><!-- .grid-x -->
			</div><!-- .grid-container -->	
			

		<?php break;
			case 'fluid-xygrid': ?>
					</div><!-- .cell -->
				</div><!-- .grid-x -->
			</div><!-- .grid-container -->	
			
		<?php break;
			default: ?>

					</div><!-- .cell -->
					
				<?php get_sidebar(); ?>

				</div><!-- .grid-x -->
			</div><!-- .grid-container -->	

		<?php } ?>			

<?php
	}
} ?>