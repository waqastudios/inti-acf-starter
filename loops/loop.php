<?php
/**
 * The main loop for displaying posts
 *
 * @package Inti
 * @subpackage loops
 * @since 1.0.0
 */
?>

	<?php if ( have_posts() ) : ?>
						
		<?php inti_hook_loop_before(); ?>
						
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php inti_hook_post_before(); ?>

			<?php 
				/**
				 * On all archive's, wrap the post with a cell for the x-grid added in xy-grid.php
				 */
				if (!is_single()) {
					echo '<div class="cell">';
				}

				if ( !get_post_format() ) : get_template_part('post-formats/format', 'standard');
				else : get_template_part('post-formats/format', get_post_format()); endif;

				/**
				 * On all archive's, wrap the post with a cell for the x-grid added in xy-grid.php
				 */
				if (!is_single()) {
					echo '</div>';
				}
			?>
							
			<?php inti_hook_post_after(); ?>
							
		<?php endwhile; // end of the loop ?>
						
		<?php inti_hook_loop_after(); ?>
						
		<?php // if no posts are found
		else : inti_hook_loop_else(); ?>
	
	<?php endif; // end have_posts() check ?> 