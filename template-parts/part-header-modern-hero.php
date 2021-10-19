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

	// default size
	$size = 'background';

	$hero_bgs = get_field('hero_backgrounds');
	if (is_array($hero_bgs)) {
		$hero_bgs = count($hero_bgs); 
		if ($hero_bgs > 1) {
			$banner_type = 'dynamic';
		}
	} else {
		$hero_bgs = 0;
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
	} elseif ( (is_home() || is_archive()) && 'post' == get_post_type() )  {
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
	<?php if ($banner_type == 'dynamic') : ?>
		<div class="site-hero frontpage dynamic">
			<div class="inti-main-slider clearfix" data-equalizer data-equalize-on="small">

				<?php if( have_rows('hero_backgrounds') ): ?>
					<?php 
						// loop through the rows of data
						while ( have_rows('hero_backgrounds') ) : the_row();  
							$dynamic_bg = get_sub_field('background_image');
							$hero_button_url = esc_url(get_sub_field('hero_button_url'));
							$hero_button_text = get_sub_field('hero_button_text');

							$size = 'background';
						?>
							
								<div class="slide" style="background-image: url(<?php echo wp_get_attachment_image_url( $dynamic_bg, $size ); ?>);" data-equalizer-watch>
									<div class="overlay"></div>
									<div class="hero-container">
										<div class="grid-x grid-margin-x grid-padding-x align-center">
											<div class="cell medium-10 mlarge-8 large-7">
												<div class="hero-message">
													<?php the_sub_field('hero_message'); ?>
												</div>
												<?php if ($hero_button_url && $hero_button_text) : ?>
													<div class="hero-button">
														<a href="<?php echo $hero_button_url; ?>" class="button hollow white"><?php echo $hero_button_text; ?></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
						<?php 
						endwhile; ?>
				<?php endif; ?>

			</div>
		</div>
	<?php else : // $banner_type == static ?>
		<?php if( have_rows('hero_backgrounds') ): 
			while ( have_rows('hero_backgrounds') ) : the_row();  
				
				$static_bg = get_sub_field('background_image');
				$hero_button_url = esc_url(get_sub_field('hero_button_url'));
				$hero_button_text = get_sub_field('hero_button_text');

				$size = 'background';
			 ?>

				<div class="site-hero frontpage static" style="background-image: url(<?php echo wp_get_attachment_image_url( $static_bg, $size ); ?>);">
					<div class="overlay"></div>
					<div class="hero-container">
						<div class="grid-x align-center">
							<div class="cell medium-10 mlarge-8 large-7">
								<div class="hero-message">
									<?php the_sub_field('hero_message'); ?>
								</div>
								<?php if ($hero_button_url && $hero_button_text) : ?>
									<div class="hero-button">
										<a href="<?php echo $hero_button_url; ?>" class="button hollow white"><?php echo $hero_button_text; ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

			<?php 
			endwhile; ?>
		<?php else : ?>
			<div class="site-hero frontpage static" style="background-image: url(<?php echo $static_bg; ?>);">
				<div class="overlay"></div>
				<div class="hero-container">
					<div class="grid-x align-center">
						<div class="cell medium-10 mlarge-8 large-7">
							<div class="hero-message">
								<?php // the_sub_field('hero_message'); ?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) : 
		get_template_part('template-parts/part-opt-in', 'header');
	endif; ?>
	<?php if (get_field('welcome_message')) : ?>
	<div class="site-welcome">
		<div class="grid-container">
			<div class="grid-x align-center">
				<div class="cell mlarge-10 large-9">
					<article class="entry-body">
						<div class="entry-content">
							<?php the_field('welcome_message') ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>


<?php /***
	elseif ( is_post_type_archive('inti-service') || is_tax('inti-service-category') ) : ?>
	<div class="site-hero inti-service static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>
	
		<div class="grid-container hero-container">
			<div class="grid-x align-center">
				<div class="cell mlarge-6">
					<div class="hero-message">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_field('section_title', 'services-config') ?></h1>
						</header><!-- .entry-header -->
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
	
		<div class="grid-container hero-container">
			<div class="grid-x align-center">
				<div class="cell">
					<div class="hero-message">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title() ?></h1>
						</header><!-- .entry-header -->
					</div>
				</div>
			</div>
		</div>

	</div>


<?php elseif ( is_single() ) : ?>
	<div class="site-hero post single static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>

		<div class="grid-container hero-container">
			<div class="grid-x align-center">
				<div class="cell">
					<div class="hero-message">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_field('section_title', 'posts-config') ?></h1>
						</header><!-- .entry-header -->
					</div>
				</div>
			</div>
		</div>

	</div>


<?php elseif ( is_home() || is_archive() ) : ?>
	<div class="site-hero post archive static" <?php if ( $static_bg ) echo ' style="background-image: url('. $static_bg .');"'; ?>>
		<div class="overlay"></div>
	
		<div class="grid-container hero-container">
			<div class="grid-x align-center">
				<div class="cell">
					<div class="hero-message">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_field('section_title', 'posts-archives-config') ?></h1>
						</header><!-- .entry-header -->
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
	
		<div class="grid-container hero-container">
			<div class="grid-x align-center">
				<div class="cell">
					<h1><?php _e('Example text', 'inti-child'); ?></h1>
				</div>
			</div><!-- .grid-x-->
		</div><!-- .grid-container -->
	</div> <?php */ ?>
<?php endif; ?>

	<?php inti_hook_site_banner_after(); // inti_do_main_dropwdown_menu() is placed above or below banner ?>


	<?php if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) : 
		get_template_part('template-parts/part-opt-in', 'header');
	endif; ?>
</div>

<?php inti_hook_site_header_after(); ?>