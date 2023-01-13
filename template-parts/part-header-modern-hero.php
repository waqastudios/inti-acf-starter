<?php inti_hook_site_header_before(); ?>

<?php 
	// default all
	$hero_bg = get_inti_option('header_hero_bg', 'inti_customizer_options', get_stylesheet_directory_uri() . '/library/dist/img/default_background.jpg');

	// default media/blog post archives
	$hero_bg_archives = get_inti_option('header_hero_bg_archives', 'inti_customizer_options', get_stylesheet_directory_uri() . '/library/dist/img/default_background.jpg');

	// dyanamic or static?
	$banner_type = 'static';
	$static_bg = '';
	$dynamic_bg = '';
	$hero_bgs_count = 0;

	// default size
	$size = 'background';

	$hero_bgs = get_field('hero_backgrounds');
	if (is_array($hero_bgs)) {
		while ( have_rows('hero_backgrounds') ) : the_row();  
			if (get_sub_field('show')) $hero_bgs_count++;
		endwhile;
		if ($hero_bgs_count > 1) {
			$banner_type = 'dynamic';
		}
	} else {
		$hero_bgs_count = 0;
	}

	// check for a internal static page bg
	if (get_field('static_background_image')) {
		$static_bg = get_field('static_background_image');
	}

	// Get Final Static Image
	if (is_front_page()) {
		if ($banner_type == 'static') { // if there is NO a static image set for this page
			$static_bg = $hero_bg; // take the default customizer image
		}	
	} elseif ( ( is_home() || (is_archive() && 'post' == get_post_type()) ) || 'post' == get_post_type() )  {
		$static_bg = $hero_bg_archives; // take the default customizer image
	} else {
		if (!$static_bg) { // if there is NO a static image set for this page
			$static_bg = $hero_bg; // take the default customizer image
		}	
	}
?>

<div id="site-header-modern-hero" class="site-header modern-hero">

	<?php inti_hook_site_banner_before(); ?>
	<div class="site-banner-overlay-container">
		<div id="site-banner-sticky-container" class="sticky-container" data-sticky-container>
			<div class="sticky" data-sticky data-sticky-on="small" data-margin-top="0">	


				<div class="site-banner" role="banner">
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-middle">
							
							<div class="mlarge-4 large-3 cell show-for-mlarge">
								<?php inti_hook_site_banner_site_logo_before(); ?>
								<?php  
								/**
								* Add logo or site title to the site-banner, hidden in on smaller screens where another logo is shown on top-bar
								*/
								$logo = get_inti_option('logo_image', 'inti_customizer_options');
								$sticky_logo = get_inti_option('nav_logo_image', 'inti_customizer_options');
								$show_mobile_logo = get_inti_option('show_nav_logo_title', 'inti_customizer_options', 'none');

								if ( $logo ) : ?>
								<div class="site-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<?php inti_do_srcset_image(get_inti_option('logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
									</a>
								</div><!-- .site-logo -->
								<?php inti_hook_site_banner_site_logo_after(); ?>
								<?php inti_hook_site_banner_title_area_before(); ?>
								<?php endif; // end of logo 

								if ( $sticky_logo && $show_mobile_logo ) : ?>
									<div class="site-logo sticky-logo">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
											<?php inti_do_srcset_image(get_inti_option('nav_logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
										</a>
									</div><!-- .site-logo -->
									<?php inti_hook_site_banner_site_logo_after(); ?>
									<?php inti_hook_site_banner_title_area_before(); ?>
								<?php endif; // end of logo ?>
								<div class="title-area" >
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
									<p class="site-description"><?php bloginfo('description'); ?></p>
								</div>
								<div class="">
									<?php inti_hook_site_banner_title_area_after(); ?>
								</div>
							</div><!-- .cell -->
							<div class="mlarge-8 large-9 cell" >
								<?php if ( has_nav_menu('dropdown-menu') ) : ?>
									<nav class="top-bar" id="top-bar-menu">
										
										<?php

										/**
										* Add logo or site title to the navigation bar, in addition or instead of having the site banner
										*/
										if ($show_mobile_logo != 'none') : ?>
											<div class="top-bar-left hide-for-mlarge mobile-logo">
											<?php  
												/**
												* Add logo or site title to the site-banner, hidden in on smaller screens where another logo is shown on top-bar
												*/
												$logo = get_inti_option('logo_image', 'inti_customizer_options');
												$sticky_logo = get_inti_option('nav_logo_image', 'inti_customizer_options');
												$show_mobile_logo = get_inti_option('show_nav_logo_title', 'inti_customizer_options', 'none');

												if ( $logo ) : ?>
												<div class="site-logo">
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
														<?php inti_do_srcset_image(get_inti_option('logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
													</a>
												</div><!-- .site-logo -->
												<?php endif; 

													if ( $sticky_logo && $show_mobile_logo ) : ?>
													<div class="site-logo sticky-logo">
														<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
															<?php inti_do_srcset_image(get_inti_option('nav_logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
														</a>
													</div><!-- .site-logo -->
												<?php endif; ?>
												<div class="site-title"><?php bloginfo('name'); ?></div>
											</div>
										<?php
										else : ?>
											<div class="top-bar-left hide-for-mlarge no-mobile-logo"></div>
										<?php 
										endif; ?>

											<div class="top-bar-right show-for-mlarge main-dropdown-menu">
												<div class="grid-container">
													<div class="grid-x grid-margin-x">
														<div class="auto cell">
															<?php echo inti_get_dropdown_menu(); ?>
														</div>
														<?php 
															$showsocial = get_inti_option('nav_social', 'inti_headernav_options');
															if ($showsocial) :  ?>
																<div class="shrink cell">
																	<?php echo inti_get_dropdown_social_links(); ?>
																</div>
														<?php 
															endif; ?>
													</div>
												</div>
											</div>
											<div class="top-bar-right hide-for-mlarge">
												<div class="off-canvas-button">
													<a data-toggle="inti-off-canvas-menu">
														<div class="hamburger">
															<span></span>
															<span></span>
															<span></span>
														</div>
													</a>
												</div>
											</div>

									</nav>
								<?php endif; ?>
							</div>
						</div><!-- .grid-x . grid-margin-x -->
					</div><!-- .grid-container -->
				</div><!-- .site-banner -->	
			</div>
		</div>
	</div>

<?php if ( is_front_page() ) : ?>

	<div class="site-hero frontpage <?php echo $banner_type ?>"<?php 
		if ( $hero_bgs_count == 0 ) {
			// If there are no hero_backgrounds, add a default background here
			echo ' style="background-image: url(' . $static_bg . ');"';
		}
	?>>
		<?php 
			// If there are multiple hero_backgrounds, make this a slider
			if ( $banner_type == 'dynamic') {
				echo '<div class="inti-main-slider clearfix" data-equalizer data-equalize-on="small">';
			}
		?>

		<?php if( have_rows('hero_backgrounds') && $hero_bgs_count > 0 ): ?>
			<?php 
				// loop through the rows of data
				while ( have_rows('hero_backgrounds') ) : the_row();  
					$show = get_sub_field('show'); 
					if (!$show) continue;

					$media_type = get_sub_field('background_type'); 
					$localvideo_bg = get_sub_field('background_video');
					$videoid = get_sub_field('video_id');
					$source = get_sub_field('video_source');
					$aspect = get_sub_field('aspect_ratio');

					$background = get_sub_field('background_image');
					$hero_button_url = esc_url(get_sub_field('hero_button_url'));
					$hero_button_text = get_sub_field('hero_button_text');

					$size = 'background';
				?>
				<?php 
					// Again, if there are multiple hero_backgrounds, make this a slider
					if ( $banner_type == 'dynamic') {
						echo '
						<div class="slide">
							<div class="site-hero-slide-background" style="background-image: url(' . wp_get_attachment_image_url( $background, $size ) . ');"  data-equalizer-watch>	
						';
					}
				?>

							<div class="site-hero-type <?php 
								// Add a div and class to say whether this is an image or video
								// and so turn on or off the hero-container position:absolute
								if ( !$localvideo_bg || $media_type == "image" ) {
									echo "image";
								} else {
									echo "video";
								}
							?>">

								<div class="overlay"></div>

								<?php if ( $localvideo_bg && $media_type == "local" ) : ?>
									<div class="image-container hide-for-mlarge">&nbsp;</div>
									<div class="video-container local show-for-mlarge remove-on-mobile">
										<video id="header-hero" 
											width="100%" height="100%" 
											autoplay="" loop="" playsinline muted
											class="hero-video<?php echo $classes; ?>" 
											poster="<?php if ($static_bg) echo wp_get_attachment_image_url($static_bg); ?>">
											<?php if( have_rows('background_video') ): ?>
												<?php while ( have_rows('background_video') ) : the_row(); 
													$file = get_sub_field('video');
												?>
													<source src="<?php echo $file['url']; ?>" type="<?php echo $file['mime_type']; ?>">
												<?php endwhile; ?>
											<?php endif; ?>
											<?php if ($static_bg) :  ?>
											<img src="<?php echo wp_get_attachment_image_url($static_bg); ?>" title="Your browser does not support the <video> tag">
											<?php endif; ?>

										</video>
									</div>
								<?php elseif ( $media_type == "hosted" ) : ?>
									<div class="image-container hide-for-mlarge">&nbsp;</div>
									<div class="video-container hosted">
										<?php if ($videoid) : ?>
											<div class="flex-video <?php echo $aspect; ?>">
											<?php
												switch ($source) {
													case 'youtube':
														?> 
															<iframe src="//www.youtube.com/embed/<?php echo $videoid; ?>?wmode=opaque&loop=1&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=0&autoplay=1&mute=1&disablekb=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" frameborder="0"></iframe>
														<?php
														break;
													case 'vimeo':
														?>
															<iframe src="//player.vimeo.com/video/<?php echo $videoid; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179&amp;autoplay=1&amp;loop=1&amp;muted=1 " width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; fullscreen"></iframe>
														<?php
														break;
													case 'wistia':
														?> 
															<iframe src="//fast.wistia.net/embed/iframe/<?php echo $videoid; ?>?plugin%5Bsocialbar-v1%5D%5Bon%5D=false&autoPlay=true&loop=true" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no" allow="autoplay; fullscreen"></iframe>
														<?php
														break;
												}
											?>
											</div>
										<?php endif; ?>
									</div>
								<?php else : // image ?>
									<div class="image-container">
										<img src="<?php echo wp_get_attachment_image_url( $background, $size ) ?>" alt="">
									</div>
								<?php endif; ?>

								<div class="hero-container">
									<div class="grid-container">
										<div class="grid-x grid-margin-x align-middle align-center">
											<div class="cell">
												<div class="hero-message">
													<header class="hero-header">
														<?php the_sub_field('hero_message'); ?>
													</header>
													<?php if ($hero_button_url && $hero_button_text) : ?>
													<div class="hero-button">
														<a href="<?php echo $hero_button_url; ?>" class="button primary"><?php echo $hero_button_text; ?></a>
													</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- .site-hero-type -->
				
				<?php 
					// Again, if there are multiple hero_backgrounds, make this a slider
					if ( $banner_type == 'dynamic') {
						echo '
							</div><!-- .site-hero-slide-background -->
						</div><!-- .slide -->';
					}
				?>

			<?php endwhile; ?>
		
		<?php else: // there are no backgrounds ?>

			<div class="overlay"></div>
			<div class="hero-container">
				<div class="grid-container">
					<div class="grid-x align-middle">
						<div class="cell">
							<div class="hero-message">
								<header class="hero-header">
									<?php // the_sub_field('hero_message'); there is none ?>
								</header>
							</div>
							
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

		<?php 
			// If there are multiple hero_backgrounds, make this a slider
			if ( $banner_type == 'dynamic') {
				echo '</div><!-- .slider -->';
			}
		?>
	</div>


<?php /***
	elseif ( is_post_type_archive('inti-service') || is_tax('inti-service-category') ) : ?>
	<div class="site-hero inti-service static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>
	
		<div class="hero-container">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell">
						<div class="hero-message">
							<header class="hero-header">
								<h1 class="hero-title"><?php the_field('section_title', 'services-config') ?></h1>
							</header><!-- .hero-header -->
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>	
	 */
?>

<?php elseif ( 'inti-service' == get_post_type() ) : ?>


<?php elseif ( is_page() ) : ?>
	<div class="site-hero page static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>
	
		<div class="hero-container">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell">
						<div class="hero-message">
							<header class="hero-header">
								<h1 class="hero-title"><?php the_title() ?></h1>
							</header><!-- .hero-header -->
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>


<?php elseif ( is_single() ) : ?>
	<div class="site-hero post single static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>

		<div class="hero-container">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell">
						<div class="hero-message">
							<header class="hero-header">
								<h1 class="hero-title"><?php the_field('section_title', 'posts-config') ?></h1>
							</header><!-- .hero-header -->
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


<?php elseif ( is_home() || is_archive() ) : ?>
	<div class="site-hero post archive static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>
	
		<div class="hero-container">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell">
						<div class="hero-message">
							<header class="hero-header">
								<h1 class="hero-title"><?php the_field('section_title', 'posts-archives-config') ?></h1>
							</header><!-- .hero-header -->
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
<?php 
	/**
	 * Add header for specific post types and their archive pages – move before is_single() or is_archive()
	 */
	/*** elseif ( 'inti-example-post-type' == get_post_type() || is_post_type_archive('inti-example-post-type') ) : ?>
	<div class="site-hero inti-example-post-type inti-example-taxonomy">
		<div class="overlay"></div>
	
		<div class="hero-container">
			<div class="grid-container">
				<div class="grid-x align-middle">
					<div class="cell">
						<div class="hero-message">
							<header class="hero-header">
								<h1 class="hero-title"><?php _e('Example text', 'inti-child'); ?></h1>
							</header><!-- .hero-header -->
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php */ ?>
<?php endif; ?>

	<?php inti_hook_site_banner_after(); // inti_do_main_dropwdown_menu() is placed above or below banner ?>


	<?php if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) : 
		get_template_part('template-parts/part-opt-in', 'header');
	endif; ?>
</div>

<?php inti_hook_site_header_after(); ?>