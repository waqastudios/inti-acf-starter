<?php
/**
 * Content - Advanced Custom Field Layout Blocks
 * Adds blocks to page templates that suport them.
 *
 * @package Inti
 * @since 1.0.0
 */

add_action( 'child_hook_front_page_blocks', 'child_front_page_blocks' );
function child_front_page_blocks() {
	if( class_exists('acf') ) {
		// Check to see if ACF is installed and activated.
		
		if( have_rows('blocks') ):

			// loop through the rows of data
			while ( have_rows('blocks') ) : the_row();



				/**
				 * Page/Post  - Add a publihed page or post as a section of this page
				 */
				if( get_row_layout() == 'page_post' ):

					$selected = get_sub_field('page_post_selected');	
				?>
					<section class="inti-block page-post">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									
									<article  id="post-<?php echo $selected->post_id; ?>" class="entry-body <?php echo $selected->post_type; ?>">
										<div class="entry-body">

											<?php inti_hook_page_header_before(); ?>

											<header class="entry-header">
												<?php inti_hook_page_header(); ?>
											</header><!-- .entry-header -->
											
											<?php inti_hook_page_header_after(); ?>
													
											<div class="entry-content">
												<?php inti_hook_page_content_before_the_content(); ?>
												<?php echo apply_filters('the_content', $selected->post_content); ?>
												<?php inti_hook_page_content_after_the_content(); ?>
											</div><!-- .entry-content -->
											
											<footer class="entry-footer">
												<?php inti_hook_page_footer(); ?>
											</footer><!-- .entry-footer -->
											
										</div><!-- .entry-body -->
									</article><!-- #post -->

								</div>
							</div>
						</div>
					</section>





				<?php
				/**
				 * Content Block  - Add standard HTML through a wysiwyg interface
				 */
				elseif( get_row_layout() == 'content_block' ): 

					$content = get_sub_field('content');
				?>
					<section class="inti-block content-block">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									
									<article  id="post-<?php echo $selected->post_id; ?>" class="entry-body <?php echo $selected->post_type; ?>">
										<div class="entry-body">

											<div class="entry-content">
												<?php inti_hook_page_content_before_the_content(); ?>
												<?php echo apply_filters('the_content', $content); ?>
												<?php inti_hook_page_content_after_the_content(); ?>
											</div><!-- .entry-content -->
											
										</div><!-- .entry-body -->
									</article><!-- #post -->

								</div>
							</div>
						</div>
					</section>





				<?php
				/**
				 * Content Block Columns - Add standard HTML through a wysiwyg interface
				 * but in multiple columns.
				 */
				elseif( get_row_layout() == 'content_block_columns' ):
					$columns = get_sub_field('content_column');
					$column_count = count($columns);
					$breakpoint = get_sub_field('breakpoint');

					if( have_rows('content_column') ):
						if (!$breakpoint) $breakpoint = "mlarge"; if (!$column_count) $column_count = 3;
						?>
							<section class="inti-block content-block columns">
								<div class="grid-container">
									<div class="grid-x grid-padding-x <?php echo $breakpoint . "-up-" . $column_count ?>">

									<?php while ( have_rows('content_column') ) : the_row(); ?>
										<div class="small-12 cell">
											
											<article  id="post-<?php echo $selected->post_id; ?>" class="entry-body <?php echo $selected->post_type; ?>">
												<div class="entry-body">

													<div class="entry-content">
														<?php inti_hook_page_content_before_the_content(); ?>
														<?php the_sub_field('content'); ?>
														<?php inti_hook_page_content_after_the_content(); ?>
													</div><!-- .entry-content -->
													
												</div><!-- .entry-body -->
											</article><!-- #post -->

										</div>
									<?php endwhile; ?>

									</div>
								</div>
							</section>
					<?php endif; ?>






				<?php
				/**
				 * Recent Posts - lists recent blog posts based on selected category.
				 * Modify the appearance by changing how many posts to show in how
				 * many columns.
				 */
				elseif( get_row_layout() == 'recent_post_list' ):
					$number_posts = get_sub_field('number_posts');
					$post_columns = get_sub_field('post_columns');
					$order = get_sub_field('order');
					$post_category = implode(',', get_sub_field('only_show_posts_from'));
					$showlinktoblog = get_sub_field('show_link_to_blog_index');
					$blogindexurl = get_sub_field('select_page_set_as_blog_index');
					$bloglinktext = get_sub_field('text_for_the_button_to_view');

					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'post_type'           => 'post',
						'cat'                 => $post_category,
						'posts_per_page'      => $number_posts,
						'order'               => $order,
						'ignore_sticky_posts' => 1,
						'paged'               => $paged );

					$recent_posts_query = new WP_Query( $args ); 
				?>
					<section class="inti-block recent-posts">
						<?php if ($title || $description) : ?>	
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<div class="small-12 cell">
										<header class="block-header">
											<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
											<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
										</header>
									</div><!-- .cell -->
								</div><!-- .grid-x .grid-container-x -->
							</div><!-- .grid-container -->
						<?php endif; ?>
						<div class="grid-container">
							<?php if ( $recent_posts_query->have_posts() ) : ?>
							
							
								<?php // if more than one cell use block-grid
								if ( $post_columns != 1 ) echo '<div class="grid-x grid-padding-x small-up-1 medium-up-1 mlarge-up-' . $post_columns . '">'; ?>
								
									<?php while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); global $more; $more = 0; ?>
										
										<?php inti_hook_post_before(); ?>
										
										<?php if ( $post_columns != 1 ) echo '<div class="cell">'; ?>
											
											<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
												<div class="entry-body">
													<?php  if ( has_post_thumbnail() ) : ?>
													<div class="grid-x grid-padding-x">
														<div class="cell">
															<div class="entry-thumbnail">
																<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
																	<?php the_post_thumbnail( 'blog-thumbnail', array( 'class' => 'blog-thumbnail', 'alt' => get_the_title() ) ); ?>
																</a>
															</div>
														</div>
													</div>
													<?php endif; ?>
													<div class="grid-x grid-padding-x">
														<div class="cell"> 

															
															<header class="entry-header">
																	
																<?php 
																	$args = array( 
																		'show_author' => false,
																		'show_date'   => false,
																		'show_cat'    => true,
																		'show_tag'    => false,
																		'show_icons'  => false,
																		'show_uncategorized' => false,
																	 );
																	echo inti_get_post_header_meta($args); 
																?>
																
																<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
																<div class="grid-x grid-padding-x">
																	<div class="medium-6 cell">
																		<?php 
																			$args = array( 
																				'show_author' => false,
																				'show_date'   => true,
																				'show_cat'    => false,
																				'show_tag'    => false,
																				'show_icons'  => false,
																				'show_uncategorized' => false,
																			);
																			echo inti_get_post_header_meta($args); 
																		?>
																	</div>
																	<div class="medium-6 cell">
																		<?php 
																			echo inti_get_post_page_footer_comments_link();
																		?>
																	</div>
																</div>
															</header><!-- .entry-header -->
															

															<div class="entry-summary">
																<?php the_excerpt(); ?>
																<a href="<?php the_permalink(); ?>" class="button read-more"><?php echo get_inti_option('read_more_text', 'inti_general_options', __('Read more >', 'inti')); ?></a>
															</div><!-- .entry-content -->               

															<footer class="entry-footer">
																
															</footer><!-- .entry-footer -->

														</div>
													</div>

													
														


												</div><!-- .entry-body -->
											</article><!-- #post -->
											
										<?php if ( $post_columns != 1 ) echo '</div>'; ?> 
										
										<?php inti_hook_post_after(); ?>

									<?php endwhile; // end of the loop 
										wp_reset_query(); ?>
									
								<?php if ( $post_columns != 1 ) echo '</div>'; // close the block-grid ?>
								
							<?php else: ?>
								<div class="grid-container">
									<div class="callout warning" data-closable>
										<p><?php _e('There are currently no published blog posts in this category.', 'inti-child'); ?></p>
										<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							<?php endif; // end have_posts() check ?>
							<?php if ($showlinktoblog) : ?>
								<div class="grid-container">
									<nav class="content-navigation block-blog-posts-navigation" role="navigation">
										<div class="grid-x grid-padding-x">
											<div class="small-12 cell">
												<a href="<?php echo $bloglinkurl; ?>" class="button"><?php echo $bloglinktext; ?></a>
											</div>
										</div><!-- .grid-x -->
									</nav>
								</div>
							<?php endif; ?>
						</div><!-- .grid-container -->
					</section>





				<?php
				/**
				 * Personal Bio - a content area with a second column for a featured image on that post.
				 * Useful for for things like personal bios. Add featured image as a img element or place
				 * it in the div as a background image
				 */
				elseif( get_row_layout() == 'personal_bio' ): 
					$image = get_sub_field('featured_image');
				?>
					<section class="inti-block personal-bio">							
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 mlarge-6 cell">
									<article class="entry-body">
										<?php if ($title) : ?>	
											<header class="block-header">
												<h3><?php the_sub_field('title');; ?></h3>
											</header>
										<?php endif; ?>
										<?php the_sub_field('content'); ?>
									</article>
								</div>
								<div class="small-12 mlarge-6 cell">
									<div class="entry-thumbnail" <?php // if($image) echo 'style="height:100%;background-image: url('. $image .');"' ?>>
										<?php echo '<img src="' . $image . '" alt="' . get_sub_field('title') . '">'; ?>
									</div>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					</section>




				<?php
				/**
				 * Services - Shows inti-service post types
				 */
				elseif( get_row_layout() == 'services' ):				

					$post_columns = get_sub_field('post_columns');

					$title = get_sub_field('title');
					$description = get_sub_field('description');
				?>
					<section class="inti-block services">							
					<?php if ($title || $description) : ?>	
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>					
						<div class="grid-container">
							<div class="grid-x grid-padding-x mlarge-up-<?php echo $post_columns ?>">

						<?php
							if( have_rows('services_selected') ): 
								// loop through the rows of data
								while ( have_rows('services_selected') ) : the_row(); 
									$service = get_sub_field('service');

									$action_text = get_post_meta($service->ID, '_inti_service_action_text', true);
									$action_url = get_post_meta($service->ID, '_inti_service_url', true);
									$action_new = get_post_meta($service->ID, '_inti_service_new', true);


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
									<article id="post-<?php echo $service->ID; ?>" class="inti-service">
										<div class="entry-body">
											<?php  if ( has_post_thumbnail($service->ID) ) : ?>
											<div class="grid-x grid-padding-x">
												<div class="cell">
													<div class="entry-thumbnail">
														<a href="<?php echo $final_url; ?>" 
														    rel="bookmark" 
														    title="<?php echo $service->post_title; ?>"
														    <?php if ($action_new) echo 'target="_blank"' ?>>
															<?php echo get_the_post_thumbnail($service, 'service-thumbnail', array( 'class' => 'service-thumbnail', 'alt' => $final_action_text ) ); ?>
														</a>
													</div>
												</div>
											</div>
											<?php endif; ?>
											<div class="grid-x grid-padding-x">
												<div class="cell"> 

													
													<header class="entry-header">
														<h3 class="entry-title">
															<a href="<?php the_permalink($service->ID); ?>" rel="bookmark"><?php echo $service->post_title; ?></a>
														</h3>
													</header><!-- .entry-header -->
													

													<div class="entry-summary">
														<?php // echo apply_filters('the_excerpt', get_forced_excerpt($service)); ?>
														<p><?php echo get_forced_excerpt($service); ?></p>
														<a href="<?php echo $final_url; ?>" 
														    rel="bookmark"
														    <?php if ($action_new) echo 'target="_blank"' ?>
														    class="button read-more">
															<?php echo $final_action_text; ?>
														</a>
													</div><!-- .entry-content -->               

													 <footer class="entry-footer">
														
													</footer><!-- .entry-footer -->

												</div>
											</div>

										</div><!-- .entry-body -->
									</article><!-- #post -->
								</div><!-- .cell -->
														
								<?php
								endwhile;

							endif;
						?>
		
						</div>
					</section>





				<?php
				/**
				 * Video - shows a video, responsively, from one of three services
				 */
				elseif( get_row_layout() == 'video' ): 
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					$aspect = get_sub_field('aspect_ratio');
					$source = get_sub_field('video_source');
					$videoid = get_sub_field('video_id');
				?>
					<section class="inti-block video">	
					<?php if ($title || $description) : ?>	
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>								
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									
									<article>
										<?php if ($videoid) : ?>
										<div class="flex-video <?php echo $aspect; ?>">

										<?php 
											switch ($source) {
												case 'youtube':
													?> 
														<iframe src="http://www.youtube.com/embed/<?php echo $videoid; ?>?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0"></iframe>
													<?php
													break;
												case 'vimeo':
													?> 
														<iframe src="http://player.vimeo.com/video/<?php echo $videoid; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
													<?php
													break;
												case 'wistia':
													?> 
														<iframe src="http://fast.wistia.net/embed/iframe/<?php echo $videoid; ?>?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>
													<?php
													break;
											}
										?>
										</div>
										<?php endif; ?>
										
									</article>

								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					</section>





				<?php
				/**
				 * Map - displays a Google Map, or really anything in an iframe
				 */
				elseif( get_row_layout() == 'map' ): 
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					$mapurl = get_sub_field('map_url');
				?>
					<section class="inti-block map">	
					<?php if ($title || $description) : ?>	
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>								
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									
									<iframe src="<?php echo $mapurl; ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					</section>




				<?php
				/**
				 * Logos - lists inti-logo post types in one of two display formats
				 * Useful for partners, as seen in, product used, clients we work with
				 * and other concepts.
				 */
				elseif( get_row_layout() == 'logos_brands' ):				
					$display_as = get_sub_field('display_as');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					$column_count = count(get_sub_field('logos_selected'));
				?>
					<section class="inti-block logos <?php echo $display_as; ?>">							
					<?php if ($title || $description) : ?>	
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>	
						
					<?php if( have_rows('logos_selected') ): ?>
						<?php if ($display_as == 'slides'): ?>	
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<div class="small-12 cell">
										<div class="inti-carousel inti-logos-carousel clearfix">
											<?php 
											// loop through the rows of data
											while ( have_rows('logos_selected') ) : the_row();  
												$logo = get_sub_field('logo');
											?>
											
												<div class="slide">
													<?php 
													if ( has_post_thumbnail($logo->ID) ) :

														// Get the meta data 
														$logo_url = get_post_meta( $logo->ID, "_inti_logo_url", true );
														if ( $logo_url ) : ?>
															<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
																<?php echo get_the_post_thumbnail( $logo, 'logo-thumbnail', array( 'class' => 'logo-thumbnail', 'alt' => $logo->post_title ) ); ?>
															</a>
														<?php 
														else : ?>
															<?php echo get_the_post_thumbnail( $logo, 'logo-thumbnail', array( 'class' => 'logo-thumbnail', 'alt' => $logo->post_title ) ); ?>
														<?php 
														endif; ?>
													<?php 
													endif; ?>
												</div>

											<?php 
											endwhile; ?>
										</div>
									</div>
								</div>
							</div>

						<?php elseif ($display_as == 'list'): 
						?>			
							<div class="grid-container">
								<div class="grid-x grid-padding-x mlarge-up-<?php echo $column_count ?>">

								<?php
									// loop through the rows of data
									while ( have_rows('logos_selected') ) : the_row(); 
										$logo = get_sub_field('logo');
									?>
										<div class="cell">
											<article id="post-<?php echo $logo->ID; ?>" class="inti-logo">
												<div class="entry-body">
													
													<article class="inti-logo">
														<?php 
														if ( has_post_thumbnail($logo->ID) ) :

															// Get the meta data 
															$logo_url = get_post_meta( $logo->ID, "_inti_logo_url", true );
															if ( $logo_url ) : ?>
																<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
																	<?php echo get_the_post_thumbnail( $logo, 'logo-thumbnail', array( 'class'	=> 'logo-thumbnail', 'alt' => $logo->post_title ) ); ?>
																</a>
															<?php 
															else : ?>
																<?php echo get_the_post_thumbnail( $logo, 'logo-thumbnail', array( 'class'	=> 'logo-thumbnail', 'alt' => $logo->post_title ) ); ?>
															<?php 
															endif; ?>
														<?php 
														endif; ?>
													</article>

												</div><!-- .entry-body -->
											</article><!-- #post -->
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

					<?php else : ?>	
						<div class="grid-container">
							<div class="callout warning" data-closable>
								<p><?php _e('You must select logos to display here', 'inti-child'); ?></p>
								<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					<?php endif; ?>
				</section>				





				<?php
				/**
				 * Testimonials - lists inti-testimonial post types in one of two display formats
				 */
				elseif( get_row_layout() == 'testimonials' ):				
		
					$display_as = get_sub_field('display_as');
					$align = get_sub_field('align');
					$content = get_sub_field('what_to_display');

					$hide_photos = get_sub_field('hide_photos');
					$linkto_type = get_sub_field('link_testimonials_to');
					$linkto_page = get_sub_field('linked_page');

					$title = get_sub_field('title');
					$description = get_sub_field('description');
				?>
				<section class="inti-block testimonials <?php echo $display_as; ?>">							
					<?php if ($title || $description) : ?>	
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>					
					
					<?php if( have_rows('testimonials_selected') ): ?>
						<?php 
						/**
						 * The slide format is displays testimonials in a slider.
						 */
						if ($display_as == 'slides'): ?>	
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<div class="small-12 cell">
										<div class="inti-slider inti-testimonial-slider clearfix">
											<?php 
											// loop through the rows of data
											while ( have_rows('testimonials_selected') ) : the_row();  
												$testimonial = get_sub_field('testimonial');

												// Get the meta data 
												$testimonial_role = get_post_meta( $testimonial->ID, "_inti_testimonial_role", true );
												$testimonial_company = get_post_meta( $testimonial->ID, "_inti_testimonial_company", true );
												$testimonial_url = get_post_meta( $testimonial->ID, "_inti_testimonial_url", true ); 
															
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
														<div class="grid-x grid-padding-x">
															
															<?php // if it has a thumbnail, create two cells, else just one
															if ( has_post_thumbnail($testimonial->ID) && $hide_photos == 0 ) : ?>
															<div class="medium-5 mlarge-4 cell">
																<div class="testimonial-image">
																	<?php 
																		if ($link) {
																			echo $link;
																		} 
																	?>
																		<?php echo get_the_post_thumbnail($testimonial->ID, 'testimonial-thumbnail'); ?>
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
								<div class="grid-x grid-padding-x">

								<?php

									$right = false; // used for 'mixed'

									// loop through the rows of data
									while ( have_rows('testimonials_selected') ) : the_row(); 
										$testimonial = get_sub_field('testimonial');

										// Get the meta data 
										$testimonial_role = get_post_meta( $testimonial->ID, "_inti_testimonial_role", true );
										$testimonial_company = get_post_meta( $testimonial->ID, "_inti_testimonial_company", true );
										$testimonial_url = get_post_meta( $testimonial->ID, "_inti_testimonial_url", true ); 
													
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

											<blockquote class="testimonial left">
												<?php // if it has a thumbnail, create two cells, else just one
												if ( $has_image && $hide_photos == 0 ) : ?>
													<div class="grid-x grid-padding-x">
														<div class="medium-5 mlarge-4 cell">
															<div class="testimonial-image">
																<?php echo get_the_post_thumbnail($testimonial->ID, 'testimonial-thumbnail'); ?>
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
													<div class="grid-x grid-padding-x">
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

											<blockquote class="testimonial right">
												<?php // if it has a thumbnail, create two cells, else just one
												if ( $has_image && $hide_photos == 0 ) : ?>
													<div class="grid-x grid-padding-x">
														<div class="medium-5 medium-order-2 mlarge-4 cell">
															<div class="testimonial-image">
																<?php echo get_the_post_thumbnail($testimonial->ID, 'testimonial-thumbnail'); ?>
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
													<div class="grid-x grid-padding-x">
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
												<blockquote class="testimonial mixed right">
													<?php // if it has a thumbnail, create two cells, else just one
													if ( $has_image && $hide_photos == 0 ) : ?>
														<div class="grid-x grid-padding-x">
															<div class="medium-5 medium-order-2 mlarge-4 cell">
																<div class="testimonial-image">
																	<?php echo get_the_post_thumbnail($testimonial->ID, 'testimonial-thumbnail'); ?>
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
														<div class="grid-x grid-padding-x">
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
												<blockquote class="testimonial mixed left">
												<?php // if it has a thumbnail, create two cells, else just one
												if ( $has_image && $hide_photos == 0 ) : ?>
													<div class="grid-x grid-padding-x">
														<div class="medium-5 mlarge-4 cell">
															<div class="testimonial-image">
																<?php echo get_the_post_thumbnail($testimonial->ID, 'testimonial-thumbnail'); ?>
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
													<div class="grid-x grid-padding-x">
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






				<?php
				else :
				?>
				<div class="grid-container">
					<div class="grid-x grid-padding-x">
						<div class="small-12 cell">
							<div class="callout warning" data-closable>
								<p>Please go ahead and <?php edit_post_link( __('Edit', 'inti'), '<span class="edit-link"><span>', '</span></span>'); ?> this page to add content.</p>
								<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
				</div>

				<?php
				endif;
				?>
			<?php 
			endwhile; 
		endif; ?>	

	<?php } else { ?>

			<div class="grid-container">
				<div class="grid-x grid-padding-x">
					<div class="small-12 cell">
						<div class="callout warning" data-closable>
							<p>This theme requires ACF PRO to work correctly.</p>
							<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			
	<?php } //acf 

}