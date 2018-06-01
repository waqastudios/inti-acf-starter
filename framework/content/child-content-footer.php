<?php
/**
 * Content - Child Footer
 * Adds alternate layouts for different footer styles
 *
 * @package Inti
 * @since 1.0.5
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * 
 */
function child_remove_footer_content_actions(){
	remove_action( 'inti_hook_footer_inside', 'inti_do_footer_widget', 1);
    remove_action( 'inti_hook_footer_inside', 'inti_do_footer_menu', 2);
    remove_action( 'inti_hook_footer_inside', 'inti_do_footer_info', 4);
    remove_action( 'inti_hook_footer_inside', 'inti_do_footer_social', 3);
}
add_action( 'after_setup_theme', 'child_remove_footer_content_actions', 15 );


/**
 * Footer widgets
 * Adds a row in which a sidebar is displayed in the footer
 * See sidebar.php for details of how it is displayed horizontally
 * 
 * @since 1.1.0
 */
function child_do_footer_widgets() { ?>
	<div class="footer-widgets">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell">
					<?php get_sidebar('footer'); ?>  
				</div><!-- .cell -->
			</div><!-- .grid-x -->  
		</div> 

	</div><!-- .footer-widgets -->
<?php 
}
add_action('inti_hook_footer_inside', 'child_do_footer_widgets', 1);


/**
 * Footer opt-in
 * Adds opt-in form above footer
 * 
 * @since 1.0.5
 */
function child_do_footer_opt_in() { 
	if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) : 
		get_template_part('template-parts/part-opt-in', 'footer');
	endif; 
}
add_action('inti_hook_footer_inside', 'child_do_footer_opt_in', 1);


/**
 * Footer menu
 * Adds a menu to the footer
 * 
 * @since 1.0.5
 */
function child_do_footer_menu() { 
	if ( has_nav_menu('footer-menu') ) : ?>
		<div class="footer-menu">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-12 cell">
						<?php echo inti_get_footer_menu();	?>
					</div><!-- .cell -->
				</div><!-- .grid-x -->
			</div>
		</div><!-- .footer-menu -->
<?php
	endif;
}
add_action('inti_hook_footer_inside', 'child_do_footer_menu', 2);


/**
 * Footer info, copyright etc
 * Adds spurious details such as copyright messages, could also
 * be a home for terms and conditions links etc.
 * 
 * @since 1.0.2
 */
function child_do_footer_info() { ?>
	<div class="footer-info">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="shrink cell">
					<?php 
					$logo = get_inti_option('footer_logo', 'inti_customizer_options');
					if ($logo) : ?> 
						<div class="footer-logo">
							<div class="site-logo">
								<img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>">
							</div>
						</div>
					<?php
						endif;
					?>
				</div>
				<div class="auto cell">		
						<?php 
						if ( get_inti_option('custom_copyright', 'inti_customizer_options') ) : 
							echo do_shortcode(wpautop(get_inti_option('custom_copyright', 'inti_customizer_options'))); 
						else : ?>
							<p><span class="copyright">Copyright &copy; <?php echo date_i18n('Y'); ?> <?php bloginfo('name'); ?> | </span>
							<span class="site-credits"><?php _e('Powered by', 'inti'); ?> <a href="<?php echo esc_url('http://wordpress.org/'); ?>" title="<?php esc_attr_e('Personal Publishing Platform', 'inti'); ?>">WordPress</a> &amp; <a href="<?php echo esc_url('http://inti.waqastudios.com/') ?>" title="<?php esc_attr_e('Foundation 6 WordPress Framework', 'inti'); ?>" rel="nofollow">Inti Foundation</a> |</span> 
							<?php if ( current_theme_supports('inti-cookies') ) : ?>
								<span><?php echo do_shortcode("[cookie_manager]Manage Cookies[/cookie_manager]"); ?></span>
							<?php endif; ?>
							</p>
						<?php endif; ?>
				</div><!-- .cell -->
			</div><!-- .grid-x .grid-margin-x -->
		</div>
	</div><!-- .footer-info -->
<?php 
}
add_action('inti_hook_footer_inside', 'child_do_footer_info', 4);


/**
 * Footer social media
 * Adds linked icons to various social media profiles set in theme options
 * 
 * @since 1.0.5
 */
function child_do_footer_social() { 
	if ( get_inti_option('footer_social', 'inti_footer_options') ) { ?>
		<div class="footer-social">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-12 cell">
						<?php echo inti_get_footer_social_links(); ?>
					</div><!-- .cell -->
					
				</div><!-- .grid-x .grid-margin-x -->
			</div>
		</div><!-- .footer-social -->
<?php 
	}
}
add_action('inti_hook_footer_inside', 'child_do_footer_social', 3);


/**
 * Scroll to Top floating button
 * 
 * 
 * @since 1.1.0
 */
function child_do_scroll_to_top() { 
	if ( current_theme_supports( 'inti-scroll-to-top' ) ) { ?>
	<a href="#page" id="inti-scroll-to-top" data-smooth-scroll>
		<i class="fa fa-angle-up"></i>
	</a>
<?php 
	}
}
// add_action('inti_hook_footer_inside', 'child_do_scroll_to_top');
add_action('inti_hook_site_after', 'child_do_scroll_to_top');

?>