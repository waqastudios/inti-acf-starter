<?php
/**
 * Template Name: Advanced Page
 * Standard Page template but with ACF support
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
				get_template_part('loops/loop', 'page'); ?>

				<?php child_hook_standard_page_blocks() ?>
				
				<?php inti_hook_inner_content_after(); ?>
			
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>