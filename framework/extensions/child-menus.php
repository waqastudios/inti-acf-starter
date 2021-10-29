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
	
	/**
	 * Additional footer menus to make a column of menus as seen in an additional
	 * footer template. Activate by adding these names to 'inti-menus'
	 * in functions.php, otherwise they will not be usable.
	 */	
	if ( in_array( 'footer-menu-1', $menus[0] ) ) {
		register_nav_menu('footer-menu-1', __( 'Footer Menu 1', 'inti'));
	}
	if ( in_array( 'footer-menu-2', $menus[0] ) ) {
		register_nav_menu('footer-menu-2', __( 'Footer Menu 2', 'inti'));
	}
	if ( in_array( 'footer-menu-3', $menus[0] ) ) {
		register_nav_menu('footer-menu-3', __( 'Footer Menu 3', 'inti'));
	}
	if ( in_array( 'footer-menu-4', $menus[0] ) ) {
		register_nav_menu('footer-menu-4', __( 'Footer Menu 4', 'inti'));
	}
	if ( in_array( 'footer-menu-5', $menus[0] ) ) {
		register_nav_menu('footer-menu-5', __( 'Footer Menu 5', 'inti'));
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

/**
 * Additional footer menus to make a column of menus as seen in an additional
 * footer template. Activate by adding these names to 'inti-menus'
 * in functions.php, otherwise they will not be usable.
 */	
function inti_get_footer_menu_1() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu-1',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu_1', $defaults);
}
function inti_get_footer_menu_2() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu-2',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu_2', $defaults);
}
function inti_get_footer_menu_3() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu-3',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu_3', $defaults);
}
function inti_get_footer_menu_4() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu-4',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu_4', $defaults);
}
function inti_get_footer_menu_5() {
	$defaults = wp_nav_menu(array(
		'container' => false,
		'echo' => false,                           // Remove nav container
		'menu_class' => 'menu site-navigation site-navigation-footer',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'footer-menu-5',                 // Where it's located in the theme
		'depth' => 1,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
	return apply_filters('inti_filter_footer_menu_5', $defaults);
}


function get_menu_by_location( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}