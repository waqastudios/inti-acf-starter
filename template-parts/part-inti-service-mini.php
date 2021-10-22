<article id="post-<?php echo $service->ID; ?>" class="inti-service mini" ontouchstart="this.classList.toggle('hover');">
	<div class="entry-body">

		<?php  if ( has_post_thumbnail($service->ID) ) : ?>
		<div class="img-wrap" style="background-image: url(<?php echo get_the_post_thumbnail_url( $service->ID, 'wide-medium' ); ?>);">
			<!-- hidden -->
			<?php echo get_the_post_thumbnail($service, 'wide-medium', array( 'class' => 'wide-medium invisible', 'alt' => $final_action_text ) ); ?>
		<?php else : ?>
		<div class="img-wrap" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/library/dist/img/default_wide-medium.jpg'; ?>);">
			<?php inti_do_srcset_image(get_stylesheet_directory_uri() . '/library/dist/img/default_wide-medium.jpg', esc_attr( get_the_title())); ?>
		<?php endif; ?>
		</div>

		
		<div class="txt-wrap">
			<div class="grid-x grid-margin-x">
				<div class="cell"> 

					<header class="entry-header">
						<span class="entry-title">
							<?php echo $service->post_title; ?>
						</span>
					</header><!-- .entry-header -->

				</div>
			</div>
		</div>

		

	</div><!-- .entry-body -->
</article><!-- #post -->