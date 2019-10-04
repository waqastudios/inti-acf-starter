<?php
/**
 * Template Name: ACF Blocks (Flexible Content Blocks)
 * This is a page built for Flexible Content Blocks, using the Flexible
 * Content field in ACF. These are a drop and drag alternative to Gutenberg Blocks.
 *
 * To use them see the Flexible Content Blocks 
 * field group in ACF and the blocks themselves in /framework/content/child-acf-blocks.php. 
 * You'll find the style sheet in /library/src/scss/inti-partials/_blocks-acf.scss
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
				// remove this if ACF pages will not have a normal content area before the blocks 
				// get_template_part('loops/loop', 'page'); ?>

				<?php child_hook_flexible_content_page_blocks() ?>
				
				<?php inti_hook_inner_content_after(); ?>
			
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>