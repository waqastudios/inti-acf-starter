<?php
/**
 * Template Name: Full (Full Width)
 * Page template using Full grid-container and controlled with
 * framework/functions/layouts.php and framework/functions/xy-grid.php
 * @link https://foundation.zurb.com/sites/docs/xy-grid.html
 *
 * @package Inti
 * @subpackage Templates
 */


get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
			
			<?php inti_hook_grid_open(); ?>

				<?php inti_hook_inner_content_before(); ?>

				<?php // get the main loop
				get_template_part('loops/loop', 'page'); ?>
				
				<?php inti_hook_inner_content_after(); ?>
			
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>