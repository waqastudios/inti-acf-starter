<?php
/**
 * Block Name: Services
 * Type: Inti Content Block
 *
 * This is the template that displays the services block.
 */

$small = get_field('post_columns_small');
$medium = get_field('post_columns_medium');
$mlarge = get_field('post_columns_mlarge');
$large = get_field('post_columns_large');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'services-' . $block['id'];



?>
<section class="inti-content-block services <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<div class="grid-container fluid to-animate">
		<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">

		<?php
			if( have_rows('services_selected') ): 
				// loop through the rows of data
				while ( have_rows('services_selected') ) : the_row(); 
					$service = get_sub_field('service');

					$action_text = get_field('action_text', $service->ID);
					$action_url = get_field('custom_url', $service->ID);
					$action_new = get_field('new_tab', $service->ID);


					$default_action_text = get_inti_option('read_more_text', 'inti_general_options', 'Read more &raquo;');

					// set a final text for button (or link, or alt text or whatever)
					$final_action_text = '';
					if ($action_text) {
						$final_action_text = $action_text;
					} else {
						$final_action_text = $default_action_text;
					}

					// set a final url
					$final_url = '';
					if ($action_url) {
						$final_url = $action_url;
					} else {
						$final_url = get_the_permalink($service->ID);
					}
				?>
				<div class="cell">
					<a href="<?php echo $final_url; ?>" 
						rel="bookmark" 
						title="<?php echo $service->post_title; ?>"
						<?php if ($action_new) echo 'target="_blank"' ?>>
						<article id="post-<?php echo $service->ID; ?>" class="inti-service">
							<div class="entry-body">
								<?php  if ( has_post_thumbnail($service->ID) ) : ?>
								<div class="grid-x grid-margin-x">
									<div class="cell">
										<div class="entry-thumbnail">
											<?php echo get_the_post_thumbnail($service, 'service-thumbnail', array( 'class' => 'service-thumbnail', 'alt' => $final_action_text ) ); ?>
										</div>
									</div>
								</div>
								<?php endif; ?>
								<div class="grid-x grid-margin-x">
									<div class="cell"> 

										
										<header class="entry-header">
											<h3 class="entry-title">
												<?php echo $service->post_title; ?>
											</h3>
										</header><!-- .entry-header -->
										

										<div class="entry-summary">
											<?php // echo apply_filters('the_excerpt', get_forced_excerpt($service)); ?>
											<p><?php echo get_forced_excerpt($service); ?></p>
											<span class="button read-more">
												<?php echo $final_action_text; ?>
											</span>
										</div><!-- .entry-content -->               

										 <footer class="entry-footer">
											
										</footer><!-- .entry-footer -->

									</div>
								</div>

							</div><!-- .entry-body -->
						</article><!-- #post -->
					</a>
				</div><!-- .cell -->
										
				<?php
				endwhile;

			endif;
		?>

	</div>
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>