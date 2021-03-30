<?php
/**
 * Inti Flexible Content Blocks - Advanced Custom Field Flexible Content
 * Adds blocks to page templates that suport them.
 *
 * An alternative to Gutenberg are the Flexible Content Blocks using the 
 * Flexible Content field in ACF. These are a drop and drag alternative to 
 * Gutenberg Blocks.
 * 
 * To use them, see /page-templates/acf-page.php, Flexible Content Blocks 
 * field group in ACF and the blocks themselves below. You'll find the style
 * sheet in /library/src/scss/inti-partials/_content-blocks-acf.scss
 *
 * @package Inti
 * @since 1.0.0
 */

add_action( 'child_hook_flexible_front_page_blocks', 'child_flexible_content_blocks' );
add_action( 'child_hook_flexible_content_page_blocks', 'child_flexible_content_blocks' );
function child_flexible_content_blocks() {
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

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';	
				?>
					<section class="inti-block page-post<?php echo $classes; ?>"<?php echo $style; ?>>
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									
									<article id="post-<?php echo $selected->ID; ?>" class="inti-block-entry <?php echo $selected->post_type; ?>">
										<div class="entry-body">

											<?php inti_hook_page_header_before(); ?>

											<header class="entry-header">
												<h1 class="entry-title"><?php echo $selected->post_title; ?></h1>
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
					$title = get_sub_field('title');
					$content = get_sub_field('content');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block content-block<?php echo $classes; ?>"<?php echo $style; ?>>
						<?php if ($title) : ?>	
							<div class="grid-container to-animate">
								<div class="grid-x grid-margin-x">
									<div class="small-12 cell">
										<header class="block-header">
											<h3><?php echo $title; ?></h3>
										</header>
									</div><!-- .cell -->
								</div><!-- .grid-x .grid-container-x -->
							</div><!-- .grid-container -->
						<?php endif; ?>
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									
									<article class="inti-block-entry">
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

					$title = get_sub_field('title');

					$small = get_sub_field('post_columns_small');
					$medium = get_sub_field('post_columns_medium');
					$mlarge = get_sub_field('post_columns_mlarge');
					$large = get_sub_field('post_columns_large');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';

					if( have_rows('content_column') ):
						?>
							<section class="inti-block content-block columns<?php echo $classes; ?>"<?php echo $style; ?>>
								<?php if ($title) : ?>	
									<div class="grid-container to-animate">
										<div class="grid-x grid-margin-x">
											<div class="small-12 cell">
												<header class="block-header">
													<h3><?php echo $title; ?></h3>
												</header>
											</div><!-- .cell -->
										</div><!-- .grid-x .grid-container-x -->
									</div><!-- .grid-container -->
								<?php endif; ?>
								<div class="grid-container to-animate">
									<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">

									<?php
										$c = 1; 
										while ( have_rows('content_column') ) : the_row(); ?>
										<div class="small-12 cell">
											
											<article id="inti-block-entry-<?php echo $c; ?>" class="inti-block-entry">
												<div class="entry-body">

													<div class="entry-content">
														<?php inti_hook_page_content_before_the_content(); ?>
														<?php the_sub_field('content'); ?>
														<?php inti_hook_page_content_after_the_content(); ?>
													</div><!-- .entry-content -->
													
												</div><!-- .entry-body -->
											</article><!-- #post -->

										</div>
									<?php $c++; endwhile; ?>

									</div>
								</div>
							</section>
					<?php endif; ?>



				<?php
				/**
				 * Content Block Grid
				 */
				elseif( get_row_layout() == 'content_block_grid' ):

					$title = get_sub_field('title');

					$small = get_sub_field('post_columns_small');
					$medium = get_sub_field('post_columns_medium');
					$mlarge = get_sub_field('post_columns_mlarge');
					$large = get_sub_field('post_columns_large');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';

			
					if( have_rows('content_column') ):
						?>
							<section class="inti-block paragraph-grid<?php echo $classes; ?>"<?php echo $style; ?>>
								<?php if ($title) : ?>	
									<div class="grid-container to-animate">
										<div class="grid-x grid-margin-x">
											<div class="small-12 cell">
												<header class="block-header">
													<h3><?php echo $title; ?></h3>
												</header>
											</div><!-- .cell -->
										</div><!-- .grid-x .grid-container-x -->
									</div><!-- .grid-container -->
								<?php endif; ?>
								<div class="grid-container to-animate">
									<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">

									<?php
										$c = 1; 
										while ( have_rows('content_column') ) : the_row(); ?>
										<div class="small-12 cell">
											
											<article id="inti-block-entry-<?php echo $c; ?>" class="inti-block-entry">
												<div class="entry-body">

													<div class="entry-content">
														<?php inti_hook_page_content_before_the_content(); ?>
														<?php the_sub_field('content'); ?>
														<?php inti_hook_page_content_after_the_content(); ?>
													</div><!-- .entry-content -->
													
												</div><!-- .entry-body -->
											</article><!-- #post -->

										</div>
									<?php $c++; endwhile; ?>

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

					$small = get_sub_field('post_columns_small');
					$medium = get_sub_field('post_columns_medium');
					$mlarge = get_sub_field('post_columns_mlarge');
					$large = get_sub_field('post_columns_large');

					$order = get_sub_field('order');
					$post_category = '';
					if (get_sub_field('only_show_posts_from')) {
						$post_category = implode(',', get_sub_field('only_show_posts_from'));
					}
					$showlinktoblog = get_sub_field('show_link_to_blog_index');
					$blogindexurl = get_sub_field('select_page_set_as_blog_index');
					$bloglinktext = get_sub_field('text_for_the_button_to_view');

					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';

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
					<section class="inti-block recent-posts<?php echo $classes; ?>"<?php echo $style; ?>>
						<?php if ($title || $description) : ?>	
							<div class="grid-container to-animate">
								<div class="grid-x grid-margin-x">
									<div class="small-12 cell">
										<header class="block-header">
											<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
											<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
										</header>
									</div><!-- .cell -->
								</div><!-- .grid-x .grid-container-x -->
							</div><!-- .grid-container -->
						<?php endif; ?>
						<div class="grid-container to-animate">
							<?php if ( $recent_posts_query->have_posts() ) : ?>
							
								<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">
								
									<?php while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); global $more; $more = 0; ?>
										
										<div class="cell">
											<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark">
												<?php include(locate_template('template-parts/part-post-mini.php')); ?>
											</a>
										</div><!-- .cell -->										

									<?php endwhile; // end of the loop 
										wp_reset_query(); ?>
									
								</div><!-- .grid-x -->
								
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
										<div class="grid-x grid-margin-x">
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
				 * Services - Shows inti-service post types
				 */
				elseif( get_row_layout() == 'services' ):				

					$small = get_sub_field('post_columns_small');
					$medium = get_sub_field('post_columns_medium');
					$mlarge = get_sub_field('post_columns_mlarge');
					$large = get_sub_field('post_columns_large');

					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block services<?php echo $classes; ?>"<?php echo $style; ?>>		
					<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>					
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
															<?php echo get_the_post_thumbnail($service, 'square-medium', array( 'class' => 'square-medium', 'alt' => $final_action_text ) ); ?>
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





				<?php
				/**
				 * Personal Bio - a content area with a second column for a featured image on that post.
				 * Useful for for things like personal bios. Add featured image as a img element or place
				 * it in the div as a background image
				 */
				elseif( get_row_layout() == 'personal_bio' ): 
					$title = get_sub_field('title');
					$image = get_sub_field('featured_image');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block personal-bio<?php echo $classes; ?>"<?php echo $style; ?>>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 mlarge-6 cell">
									<article class="entry-body">
										<?php if ($title) : ?>	
											<header class="block-header">
												<h3><?php echo $title; ?></h3>
											</header>
										<?php endif; ?>
										<div class="entry-content">
											<?php the_sub_field('content'); ?>
										</div>
									</article>
								</div>
								<div class="small-12 mlarge-6 cell">
									<div class="entry-thumbnail" <?php // if($image) echo 'style="height:100%;background-image: url('. $image .');"' ?>>
										<?php echo wp_get_attachment_image( $image, 'large', true, array('alt' => get_sub_field('title')) ); ?>
									</div>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					</section>





				<?php
				/**
				 * Featured Image
				 */
				elseif( get_row_layout() == 'featured_image' ): 
					$image = get_sub_field('image');
					$loc = get_sub_field('image_location');
					$alt = get_sub_field('image_alt');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block featured-image<?php echo $classes; ?>"<?php echo $style; ?>>							
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">

								<?php 
									switch ($loc) {
										case "left" : ?>
											<div class="small-12 mlarge-4 cell">
												<div class="entry-thumbnail">
													<?php echo wp_get_attachment_image( $image, 'large', false, array('alt' => get_sub_field('image_alt')) ); ?>
												</div>
											</div>
											<div class="small-12 mlarge-8 cell">
												<article class="entry-body">
													<div class="entry-content">
														<?php the_sub_field('content'); ?>
													</div>
												</article>
											</div><!-- .cell -->


									<?php
      									break;
										case "right" : ?>
											<div class="small-12 mlarge-8 cell">
												<article class="entry-body">
													<div class="entry-content">
														<?php the_sub_field('content'); ?>
													</div>
												</article>
											</div>
											<div class="small-12 mlarge-4 cell">
												<div class="entry-thumbnail">
													<?php echo wp_get_attachment_image( $image, 'large', false, array('alt' => get_sub_field('image_alt')) ); ?>
												</div>
											</div><!-- .cell -->


									<?php
      									break;
										case "top" : ?>
											<div class="small-12 cell">
												<div class="entry-thumbnail">
													<?php echo wp_get_attachment_image( $image, 'large', false, array('alt' => get_sub_field('image_alt')) ); ?>
												</div>
											</div>
											<div class="small-12 cell">
												<article class="entry-body">
													<div class="entry-content">
														<?php the_sub_field('content'); ?>
													</div>
												</article>
											</div><!-- .cell -->


									<?php
      									break;
										case "bottom" : ?>
											<div class="small-12 cell">
												<article class="entry-body">
													<div class="entry-content">
														<?php the_sub_field('content'); ?>
													</div>
												</article>
											</div>
											<div class="small-12 cell">
												<div class="entry-thumbnail">
													<?php echo wp_get_attachment_image( $image, 'large', false, array('alt' => get_sub_field('image_alt')) ); ?>
												</div>
											</div><!-- .cell -->

									<?php
      									break;
									}
								 ?>
								
							
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					</section>





				<?php
				/**
				 * Icon Buttons
				 */
				elseif( get_row_layout() == 'icon_buttons' ): 
					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$small = get_sub_field('post_columns_small');
					$medium = get_sub_field('post_columns_medium');
					$mlarge = get_sub_field('post_columns_mlarge');
					$large = get_sub_field('post_columns_large');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block icon-buttons<?php echo $classes; ?>"<?php echo $style; ?>>	
						<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x align-center">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3 class="default"><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
						<?php endif; ?>	
					
						<div class="grid-container">
							<div class="grid-x grid-margin-x grid-padding-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">
								
								<?php if( have_rows('icons') ): ?>

										<?php 
										// loop through the rows of data
										while ( have_rows('icons') ) : the_row();  
											$img = get_sub_field('icon');
											$icon_title = get_sub_field('icon_title');
											$icon_text = get_sub_field('icon_text');

											$link = get_sub_field('link');
											$link_url = get_sub_field('link_url');
											$link_text = get_sub_field('link_text');
											$make_button = get_sub_field('make_button');
										?>	

										<div class="cell to-animate">
											<article class="icon">
												<div class="entry-thumbnail">
													<?php if ($link) : ?>
														<a href="<?php echo $link_url; ?>">
													<?php endif; ?>
													<?php echo wp_get_attachment_image( $img, 'square-small', true, array('alt' => $icon_title) ); ?>
													<?php if ($link) : ?>
														</a>
													<?php endif; ?>
												</div>
												<?php if ($icon_title || $icon_text) : ?>	
												<div class="entry-header">
													<h3>
													<?php if ($link) : ?>
														<a href="<?php echo $link_url; ?>">
													<?php endif; ?>
													<?php if ($icon_title) : ?><?php echo $icon_title; ?><?php endif; ?>
													<?php if ($link) : ?>
														</a>
													<?php endif; ?>
													</h3>
													<?php if ($icon_text) : ?><div class="entry-summary"><?php echo $icon_text; ?></div><?php endif; ?>
													<?php if ($link) : ?>
														<?php if ($make_button != "no") : ?>
															<a href="<?php echo $link_url ?>" class="button <?php echo $make_button; ?>"><?php echo $link_text; ?></a>
														<?php else : ?>
															<a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
														<?php endif; ?>
													<?php endif; ?>
												</div>
												<?php endif; ?>
											</article>
										</div>

										<?php
										endwhile;
										?>

								<?php endif; ?>
							</div>
						</div>

					</section>





				<?php
				/**
				 * Accordion Content
				 */
				elseif( get_row_layout() == 'accordion' ):
					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invite_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';

			
					if( have_rows('items') ):
						?>
						<section class="inti-block accordion-block<?php echo $classes; ?>"<?php echo $style; ?>>
						<?php if ($title || $description) : ?>	
							<div class="grid-container to-animate">
								<div class="grid-x grid-margin-x">
									<div class="small-12 cell">
										<header class="block-header">
											<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
											<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
										</header>
									</div><!-- .cell -->
								</div><!-- .grid-x .grid-container-x -->
							</div><!-- .grid-container -->
						<?php endif; ?>
							<div class="grid-container to-animate">
								<div class="grid-x">
									<div class="cell">
										<?php $id = md5(uniqid(rand(), true)); ?>
										<ul class="accordion" data-accordion role="tablist" id="accordion-<?php echo $id; ?>" data-multi-expand="true" data-allow-all-closed="true">
										<?php while ( have_rows('items') ) : the_row(); ?>
											<li class="accordion-item" data-accordion-item>
												<?php $id = md5(uniqid(rand(), true)); ?>
												<a href="#accordion-panel-<?php echo $id; ?>" 
													role="tab" id="accordion-panel-<?php echo $id; ?>-heading" 
													class="accordion-title" aria-controls="accordion-panel-<?php echo $id; ?>">
														<?php the_sub_field('title') ?>
												</a>
												<div class="accordion-content" roll="tabpanel" data-tab-content aria-labelledby="accordion-panel-heading">
													<?php the_sub_field('content') ?>
												</div>
											</li>
										<?php endwhile; ?>
										</ul>
									</div>
								</div>
							</div>
						</section>
					<?php endif; ?>





				<?php
				/**
				 * Tabs Content
				 */
				elseif( get_row_layout() == 'tabs' ):

					$tabs = get_sub_field('items');
					$tab_count = count($tabs);
					$orientation = get_sub_field('orientation');

					$title = get_sub_field('title');
					$description = get_sub_field('description');

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';

					if( have_rows('items') ):
						?>
						<section class="inti-block tabs-block<?php echo $classes; ?>"<?php echo $style; ?>>
						<?php if ($title || $description) : ?>	
							<div class="grid-container to-animate">
								<div class="grid-x grid-margin-x">
									<div class="small-12 cell">
										<header class="block-header">
											<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
											<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
										</header>
									</div><!-- .cell -->
								</div><!-- .grid-x .grid-container-x -->
							</div><!-- .grid-container -->
						<?php endif; ?>
							<div class="grid-container to-animate">

								<?php $id = md5(uniqid(rand(), true)); ?>

								<?php if ($orientation == "horizontal") : ?>
									<div class="grid-x grid-margin-x">
										<div class="cell tabs-wrapper">
											<ul class="tabs <?php echo $orientation ?>" data-tabs id="inti-tabs-<?php echo $id; ?>">
												<?php  
													$c = 0;
													while ( have_rows('items') ) : the_row();
												?>
													<li class="tabs-title<?php if ($c == 0) echo " is-active" ?>">
														<a href="#tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('title') ?></a>
													</li>
													
												<?php 
													$c++;
													endwhile; 
												?>
											</ul>
											<div class="tabs-content" data-tabs-content="inti-tabs-<?php echo $id; ?>">
												<?php 
													$c = 0;
													while ( have_rows('items') ) : the_row(); 
												?>
													<div class="tabs-panel <?php echo $orientation ?><?php if ($c == 0) echo " is-active" ?> <?php echo $orientation ?>" id="tabpanel-<?php echo $id; ?>-<?php echo $c; ?>">
														<?php the_sub_field('content') ?>
													</div>
												<?php 
													$c++;
													endwhile; 
												?>
											</div>
										</div>
									</div>

								<?php else : ?>

									<div class="grid-x tabs-wrapper">
										<div class="small-4 medium-3 cell">
											<ul class="tabs <?php echo $orientation ?>" data-tabs id="inti-tabs-<?php echo $id; ?>">
												<?php  
													$c = 0;
													while ( have_rows('items') ) : the_row();
												?>
													<li class="tabs-title<?php if ($c == 0) echo " is-active" ?>">
														<a href="#tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('title') ?></a>
													</li>
													
												<?php 
													$c++;
													endwhile; 
												?>
											</ul>
										</div>
										<div class="small-8 medium-9 cell">
											<div class="tabs-content <?php echo $orientation ?>" data-tabs-content="inti-tabs-<?php echo $id; ?>">
												<?php 
													$c = 0;
													while ( have_rows('items') ) : the_row(); 
												?>
													<div class="tabs-panel<?php if ($c == 0) echo " is-active" ?>" id="tabpanel-<?php echo $id; ?>-<?php echo $c; ?>">
														<?php the_sub_field('content') ?>
													</div>
												<?php 
													$c++;
													endwhile; 
												?>
											</div>
										</div>
									</div>

								<?php endif; ?>


							</div>
						</section>
					<?php endif; ?>





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

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block video<?php echo $classes; ?>"<?php echo $style; ?>>
					<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>								
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									
									<article>
										<?php if ($videoid) : ?>
										<div class="flex-video <?php echo $aspect; ?>">

										<?php 
											switch ($source) {
												case 'youtube':
													?> 
														<iframe src="//www.youtube.com/embed/<?php echo $videoid; ?>?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0"></iframe>
													<?php
													break;
												case 'vimeo':
													?> 
														<iframe src="//player.vimeo.com/video/<?php echo $videoid; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
													<?php
													break;
												case 'wistia':
													?> 
														<iframe src="//fast.wistia.net/embed/iframe/<?php echo $videoid; ?>?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>
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

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block map<?php echo $classes; ?>"<?php echo $style; ?>>	
					<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
								<div class="small-12 cell">
									<header class="block-header">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($description) : ?><div class="entry-summary"><?php echo $description; ?></div><?php endif; ?>
									</header>
								</div><!-- .cell -->
							</div><!-- .grid-x .grid-container-x -->
						</div><!-- .grid-container -->
					<?php endif; ?>								
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
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

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
					<section class="inti-block logos <?php echo $display_as; ?><?php echo $classes; ?>"<?php echo $style; ?>>						
					<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
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
								<div class="grid-x grid-margin-x">
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
														$logo_url = get_field('logo_link', $logo->ID);
														if ( $logo_url ) : ?>
															<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
																<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class' => 'square-small', 'alt' => $logo->post_title ) ); ?>
															</a>
														<?php 
														else : ?>
															<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class' => 'square-small', 'alt' => $logo->post_title ) ); ?>
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
							<div class="grid-container to-animate">
								<div class="grid-x grid-margin-x grid-margin-y mlarge-up-<?php echo $column_count ?>">

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
															$logo_url = get_field('logo_link', $logo->ID);
															if ( $logo_url ) : ?>
																<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
																	<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class'	=> 'square-small', 'alt' => $logo->post_title ) ); ?>
																</a>
															<?php 
															else : ?>
																<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class'	=> 'square-small', 'alt' => $logo->post_title ) ); ?>
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

					$bgcolor = get_sub_field('background_color');
					$bgimg = get_sub_field('background_image');
					$invert = get_sub_field('invert_text');
					$cssclass = get_sub_field('css_class');

					$classes = ""; $style = "";
					if ($invert) $classes .= " invert-text";	
					if ($bgimg) $classes .= " cover";
					if ($cssclass) $classes .= " " . preg_replace("~[^a-zA-Z0-9- ]+~", "", $cssclass);
					if ($bgcolor != "#FFFFFF") $style = " background-color:" . $bgcolor . ";";
					if ($bgimg) $style = " background-image:url('" . $bgimg . "');";
					if ($style) $style = ' style="' . $style . '"';
				?>
				<section class="inti-block testimonials <?php echo $display_as; ?><?php echo $classes; ?>"<?php echo $style; ?>>							
					<?php if ($title || $description) : ?>	
						<div class="grid-container to-animate">
							<div class="grid-x grid-margin-x">
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





				<?php
				else :
				?>
				<div class="grid-container">
					<div class="grid-x grid-margin-x">
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
				<div class="grid-x grid-margin-x">
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