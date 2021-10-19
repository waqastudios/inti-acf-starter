<?php
/**
 * The main template for a static front page. 
 *
 * Delete this template if you'll have no static front page.
 *
 *
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
			
			<?php inti_hook_grid_open(); ?>

				<?php inti_hook_inner_content_before(); ?>

				<?php // get the main loop, 

				// remove if ACF pages will not have normal content areas
				// get_template_part('loops/loop', 'frontpage-page');
				
				// remove if Gutenberg ACF blocks will be used instead of Flexible Content ACF Blocks
				child_hook_flexible_front_page_blocks() ?>
				
				<?php inti_hook_inner_content_after(); ?>
			
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>