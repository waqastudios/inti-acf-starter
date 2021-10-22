<article id="post-<?php the_ID(); ?>" <?php post_class('mini mini-type-1'); ?>>
	<div class="entry-body">
		<div class="grid-x grid-margin-x">
			<div class="cell">
				<div class="entry-thumbnail">
					<?php  if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'square-medium', array( 'class' => 'square-medium', 'alt' => get_the_title() ) ); ?>
					<?php else : ?>
						<?php inti_do_srcset_image(get_stylesheet_directory_uri() . '/library/dist/img/default_square-medium.jpg', esc_attr( get_the_title())); ?>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .grid-x -->

		<div class="grid-x grid-margin-x">
			<div class="cell"> 

				<?php inti_hook_post_header_before(); ?>
				<header class="entry-header">
					<?php inti_hook_post_header(); ?>
				</header><!-- .entry-header -->
				<?php inti_hook_post_header_after(); ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-content -->               

				 <footer class="entry-footer">
					<?php inti_hook_post_footer(); ?>
				</footer><!-- .entry-footer -->

			</div>
		</div><!-- .grid-x -->
	</div><!-- .entry-body -->
</article><!-- #post -->