<?php
/**
 * Inti Foundation Kitchen Sink Functions
 *
 * @package Inti
 * @author Waqa Studios
 * @since 1.0.0
 * @copyright Copyright (c) 2015, Waqa Studios
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Child Theme Setup
 * Modify this function to deactivate features in the parent theme
 *
 * See functions.php in Inti Foundation
 * Remove the comment slashes (//) next to the functions
 * 
 * Remove or add array elements in add_theme_support() as needed
 */
function childtheme_override_setup() {

	/**
	 * Features to expand on Inti Foundation
	 */ 
	add_theme_support(
		'inti-post-types',
		array('slide', 'service', 'person', 'testimonial', 'logo', 'opt-in')
	);
	
	add_theme_support(
		'inti-page-templates',
		array('front-page', 'acf-page', 'portfolio', 'contact') //examples
	);

	/**
	 * Basic Inti Foundation Features to be support in this child theme
	 */ 
	add_theme_support(
		'inti-layouts',
		array('1c', '2c-l', '2c-r', '1c-thin')
	);

	add_theme_support(
		'inti-menus',
		array('dropdown-menu', 'off-canvas-menu', 'footer-menu', 'terms-menu')
	);
	
	add_theme_support(
		'inti-sidebars',
		array('primary')
	);

	add_theme_support('inti-customizer');

	add_theme_support('inti-theme-options');

	add_theme_support('inti-backgrounds');
	
	add_theme_support('inti-fonts');

	add_theme_support('inti-breadcrumbs');
	
	add_theme_support('inti-pagination');
	
	add_theme_support('inti-post-header-meta');
	
	add_theme_support('inti-shortcodes');
		
	add_theme_support('inti-sticky-sidebars');
	
	add_theme_support('inti-custom-login');

	add_theme_support('inti-scroll-to-top');	

	/** add_theme_support(
		'inti-cookies',
		array('NEEDED', 'FUNCTIONAL', 'OPTIONAL')
	); */
	
	/**
	 * 3rd Party Supprt
	 */
	// add_theme_support( 'woocommerce' );
	
	/**
	 * WordPress features
	 */ 
	add_theme_support('menus');

	add_theme_support('editor-styles');

	add_theme_support('align-wide');
	
	// different post formats for tumblog style posting
	add_theme_support(
		'post-formats',
		array('aside', 'gallery','link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
	);
	
	add_theme_support('post-thumbnails');

	// Some image sizes to use throughout the theme
	add_image_size('square-small', 300, 300, true);
	add_image_size('square-medium', 600, 600, true);
	add_image_size('wide-small', 600, 257, true); // 21x9
	add_image_size('wide-medium', 1200, 514, true); // 21x9
	add_image_size('wide-large', 2560, 1097, true); // 21x9
	add_image_size('background', 2560, 1440, true);

	// RSS feed links to header.php for posts and comments.
	add_theme_support('automatic-feed-links');

	// editor stylesheet for Gutenberg
	add_editor_style( get_stylesheet_directory_uri() . '/library/dist/css/editor.css' . '?ver=' . filemtime(get_stylesheet_directory()) . '/library/dist/css/editor.css' );

	// load parent translations
	load_theme_textdomain( 'inti' , get_template_directory() . '/languages');

	// load child theme translations
	load_child_theme_textdomain( 'inti-child' , get_stylesheet_directory() . '/languages');

	// Keep Yoast SEO metabox last on page
	add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );
		
	/**
	 * Load framework files from child theme's framework directory
	 * 
	 * locate_template() will first check the child theme for a file in that location,
	 * and if not found, will search the parent theme. Override parent theme files by giving
	 * the child theme versions the same name, set a unique name or add a prefix to load
	 * them in addition to parent theme files.
	 */

	require_once locate_template('/framework/blocks/blocks.php');
	require_once locate_template('/framework/content/child-acf-blocks.php');
	require_once locate_template('/framework/content/child-content-header.php');
	require_once locate_template('/framework/content/child-content-footer.php');
	require_once locate_template('/framework/content/child-content-posts-pages.php');
	require_once locate_template('/framework/functions/child-helpers.php');
	require_once locate_template('/framework/functions/theme-supports.php');
	require_once locate_template('/framework/customizer/child-customize.php');
	require_once locate_template('/framework/theme-options/child-theme-options.php');
	require_once locate_template('/framework/acf-json/acf-points.php');
	require_once locate_template('/framework/extensions/child-typography.php');
	require_once locate_template('/framework/extensions/child-menus.php');

	require_once locate_template('/framework/post-types/taxonomies.php');

	if (inti_current_theme_supports( 'inti-post-types', 'testimonial' )) {
		require_once locate_template('/framework/shortcodes/shortcode-testimonials.php');
		require_once locate_template('/framework/shortcodes/shortcode-testimonial-single.php');
		require_once locate_template('/framework/widgets/testimonials.php');
	}
	if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) {
		require_once locate_template('/framework/shortcodes/shortcode-opt-in.php');
		require_once locate_template('/framework/widgets/opt-in.php');
	}

}
add_action('after_setup_theme', 'childtheme_override_setup', 15);




/**
 * Add your own custom functions below
 */




/*
 * Declare some hooks
 */
function child_hook_flexible_front_page_blocks() {
	do_action('child_hook_flexible_front_page_blocks');
}
function child_hook_flexible_content_page_blocks() {
	do_action('child_hook_flexible_content_page_blocks');
}
function child_hook_site_banner_auxiliary_column() {
	do_action('child_hook_site_banner_auxiliary_column');
}