<?php
/**
 * Block Name: Testimonials
 * Type: Inti Content Block
 *
 * This is the template that displays the testimonial block.
 */

$display_as = get_field('display_as');

$align = get_field('align');
$content = get_field('what_to_display');

$hide_photos = get_field('hide_photos');
$linkto_type = get_field('link_testimonials_to');
$linkto_page = get_field('linked_page');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'testimonials-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

?>
<section class="inti-content-block testimonials <?php echo $display_as; ?> <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>				
	
	<?php if( have_rows('testimonials_selected') ): ?>
		<?php 
		/**
		 * The slide format is displays testimonials in a slider.
		 */
		if ($display_as == 'slides'): ?>	
			<div class="grid-container">
				<div class="grid-x grid-margin-x align-center">
					<div class="small-12 mlarge-11 cell">
						<div class="inti-slider inti-testimonial-slider clearfix">
							<?php 
							// loop through the rows of data
							while ( have_rows('testimonials_selected') ) : the_row();  
								$testimonial = get_sub_field('testimonial');
											
								$link = "";
								if ($linkto_type == "permalink") {
									$link = '<a href="' . get_the_permalink($testimonial->ID) . '">';
								} elseif ($linkto_type == "url" && $linkto_page != "-1") {
									$link = '<a href="' . get_the_permalink($linkto_page) . '">';
								} else {
									// Do nothing
								}
							?>
							
								<div class="slide">
									

									<blockquote class="testimonial">
										<div class="grid-x grid-margin-x">
											
											<?php // if it has a thumbnail, create two cells, else just one
											if ( has_post_thumbnail($testimonial->ID) && $hide_photos == 0 ) : ?>
											<div class="medium-5 mlarge-4 cell">
												<div class="testimonial-image">
													<?php 
														if ($link) {
															echo $link;
														} 
													?>
														<?php echo get_the_post_thumbnail($testimonial->ID, 'square-medium'); ?>
													<?php 
														if ($link) {
															echo '</a>';
														} 
													?>
												</div>
											</div>
											<div class="medium-7 mlarge-8 cell">
												
												<div class="testimonial-text">
													<?php
														if ($content == "excerpt") {
															the_excerpt();
														} else {
															echo apply_filters('the_content', $testimonial->post_content);
														}
													 ?>
													<cite class="testimonial-owner">	
														<?php the_testimonial_owner($testimonial->ID); ?>		
													</cite>
												</div>
												
											</div>
											<?php else : ?>
											<div class="small-12 cell">
												
												<div class="testimonial-text">
													<?php 
														if ($content == "excerpt") {
															echo get_forced_excerpt($testimonial);
														} else {
															echo apply_filters('the_content', $testimonial->post_content);
														}
													 ?>
													<cite class="testimonial-owner">	
														<?php the_testimonial_owner($testimonial->ID); ?>		
													</cite>
												</div>
												
											</div>
											<?php endif; ?>	

										</div>
									</blockquote>
							

									
								</div>

							<?php 
							endwhile; ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ($display_as == 'list'): 
		/**
		 * The list format is displays testimonials one below another. It isn't linked by default like the slides, but is easy to do.
		 */
		?>			
			<div class="grid-container">
				<div class="grid-x grid-margin-x grid-margin-y">

				<?php

					$right = false; // used for 'mixed'

					// loop through the rows of data
					while ( have_rows('testimonials_selected') ) : the_row(); 
						$testimonial = get_sub_field('testimonial');
									
						$link = "";
						if ($linkto_type == "permalink") {
							$link = '<a href="' . get_the_permalink($testimonial->ID) . '">';
						} elseif ($linkto_type == "url" && $linkto_page != "-1") {
							$link = '<a href="' . get_the_permalink($linkto_page) . '">';
						} else {
							// Do nothing
						}

						$has_image = has_post_thumbnail($testimonial->ID);
					?>
						<div class="small-12 cell">
							<?php if ($align == "left" || $align == "") : ?>

							<blockquote class="testimonial left to-animate">
								<?php // if it has a thumbnail, create two cells, else just one
								if ( $has_image && $hide_photos == 0 ) : ?>
									<div class="grid-x grid-margin-x">
										<div class="medium-5 mlarge-4 cell">
											<div class="testimonial-image">
												<?php echo get_the_post_thumbnail($testimonial->ID, 'square-medium'); ?>
											</div>
										</div>
										<div class="medium-7 mlarge-8 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php else : ?>
									<div class="grid-x grid-margin-x">
										<div class="small-12 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</blockquote>



						<?php elseif ($align == "right") : ?>

							<blockquote class="testimonial right to-animate">
								<?php // if it has a thumbnail, create two cells, else just one
								if ( $has_image && $hide_photos == 0 ) : ?>
									<div class="grid-x grid-margin-x">
										<div class="medium-5 medium-order-2 mlarge-4 cell">
											<div class="testimonial-image">
												<?php echo get_the_post_thumbnail($testimonial->ID, 'square-medium'); ?>
											</div>
										</div>
										<div class="medium-7 medium-order-1 mlarge-8 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php else : ?>
									<div class="grid-x grid-margin-x">
										<div class="small-12 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</blockquote>



						<?php elseif ($align == "mixed") : ?>
							<?php if ($right) : ?>
								<blockquote class="testimonial mixed right to-animate">
									<?php // if it has a thumbnail, create two cells, else just one
									if ( $has_image && $hide_photos == 0 ) : ?>
										<div class="grid-x grid-margin-x">
											<div class="medium-5 medium-order-2 mlarge-4 cell">
												<div class="testimonial-image">
													<?php echo get_the_post_thumbnail($testimonial->ID, 'square-medium'); ?>
												</div>
											</div>
											<div class="medium-7 medium-order-1 mlarge-8 cell">
												<div class="testimonial-text">
													<?php 
														if ($content == "excerpt") {
															echo get_forced_excerpt($testimonial);
														} else {
															echo apply_filters('the_content', $testimonial->post_content);
														}
													?>
													<cite class="testimonial-owner">
														<?php the_testimonial_owner($testimonial->ID); ?>
													</cite>
												</div>
											</div>
										</div>
									<?php else : ?>
										<div class="grid-x grid-margin-x">
											<div class="small-12 cell">
												<div class="testimonial-text">
													<?php 
														if ($content == "excerpt") {
															echo get_forced_excerpt($testimonial);
														} else {
															echo apply_filters('the_content', $testimonial->post_content);
														}
													?>
													<cite class="testimonial-owner">
														<?php the_testimonial_owner($testimonial->ID); ?>
													</cite>
												</div>
											</div>
										</div>
									<?php endif; ?>

							<?php $right = false; else : ?>
								<blockquote class="testimonial mixed left to-animate">
								<?php // if it has a thumbnail, create two cells, else just one
								if ( $has_image && $hide_photos == 0 ) : ?>
									<div class="grid-x grid-margin-x">
										<div class="medium-5 mlarge-4 cell">
											<div class="testimonial-image">
												<?php echo get_the_post_thumbnail($testimonial->ID, 'square-medium'); ?>
											</div>
										</div>
										<div class="medium-7 mlarge-8 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php else : ?>
									<div class="grid-x grid-margin-x">
										<div class="small-12 cell">
											<div class="testimonial-text">
												<?php 
													if ($content == "excerpt") {
														echo get_forced_excerpt($testimonial);
													} else {
														echo apply_filters('the_content', $testimonial->post_content);
													}
												?>
												<cite class="testimonial-owner">
													<?php the_testimonial_owner($testimonial->ID); ?>
												</cite>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<?php $right = true; endif; ?>
							</blockquote>

						<?php endif; ?>
						</div><!-- .cell -->
											
					<?php
					endwhile;
				?>

				</div>
			</div>


		<?php else : ?>	
			<div class="grid-container">
				<div class="callout warning" data-closable>
					<p><?php _e('No Display As value has been set.', 'inti-child'); ?></p>
					<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>