<?php
/**
 * The template for displaying post content
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

/**
 * In the Theme Options, users can choose whether post archives display the full posts
 * or a group of excerpts with a "read more" button to see the rest. Post formats should
 * check which option is set and modify the interface accordingly.
 * 1 == standard (shown on singles or on archives when option is set to 1)
 * 2 == short (shown on archives when option is set to 2)
 *
 */
$interface = get_inti_option('blog_interface', 'inti_general_options');

if ($interface == 1 || is_single()) : // standard interface
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-body">
		
			<?php inti_hook_post_header_before(); ?>

			<header class="entry-header">
				<?php inti_hook_post_header(); ?>
			</header><!-- .entry-header -->

			<?php inti_hook_post_header_after(); ?>
	
			<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php elseif ( is_single() ) : ?>
			<div class="entry-content">
				<?php inti_hook_post_content_before_the_content(); ?>
				<?php the_content(); ?>
				<?php inti_hook_post_content_after_the_content(); ?>
			</div><!-- .entry-content --> 
			<?php else : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php endif; ?>
	
			<footer class="entry-footer">
				<?php inti_hook_post_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php 
else : // short interface with excerpt ?>

	<div class="cell">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark">
			<?php include(locate_template('template-parts/part-post-mini.php')); ?>
		</a>
	</div>

<?php endif; ?>