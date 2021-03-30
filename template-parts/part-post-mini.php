<article id="post-<?php the_ID(); ?>" <?php post_class('short'); ?>>
	<div class="entry-body">
		<?php  if ( has_post_thumbnail() ) : ?>
			<div class="grid-x grid-margin-x grid-margin-y large-up-2">
				<div class="large-4 cell">
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( 'blog-thumbnail', array( 'class' => 'blog-thumbnail', 'alt' => get_the_title() ) ); ?>
						</a>
					</div>
				</div>

			
				<div class="large-8 cell"> 

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
			</div>
		<?php else : ?>

			<?php inti_hook_post_header_before(); ?>
			<header class="entry-header">
				<?php inti_hook_post_header(); ?>
			</header><!-- .entry-header -->
			<?php inti_hook_post_header_after(); ?>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			 <footer class="entry-footer">
				<?php inti_hook_post_footer(); ?>
			</footer><!-- .entry-footer -->
			
			
		<?php endif; ?>


	</div><!-- .entry-body -->
</article><!-- #post -->