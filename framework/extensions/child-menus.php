<?php
/**
 * Register Additional Menus
 * register menus in WordPress
 * return menus used in theme
 *
 */


/**
 * Register navigation menus for a theme.
 *
 */
function child_register_menus() {

	$menus = get_theme_support( 'inti-menus' );
	
	if ( !is_array( $menus[0] ) ) {
		return;
	}
	
	// This is the menu that sits below the site footer
	if ( in_array( 'terms-menu', $menus[0] ) ) {
		register_nav_menu('terms-menu', __( 'Terms Menu', 'inti'));
	}
	
	
}
add_action('init', 'child_register_menus', 99); 
		



// The Terms Menu
function inti_get_footer_terms_menu() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-terms',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'terms-menu',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_terms_menu', $defaults);
} /* End Terms Menu */