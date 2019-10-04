<?php
/**
 * Advanced Custom Field Blocks
 * Adds blocks to page templates that suport them.
 *
 * "Gutenberg Blocks" refers to those blocks designed to be used within
 * a standard page or post with predefined wrappers for the entirety of
 * those pages/posts.
 *
 * "Content Blocks" minick the Flexible Content Blocks using the Flexible
 * Content field in ACF. Gutenberg Blocks added to this category will/should
 * have wrappers that can have background colors and padding applied.
 *
 * @package Inti
 * @since 1.0.0
 */



/**
 * Register Gutenberg Blocks with Advanced Custom Fields
 * 
 */
add_action('acf/init', 'child_register_acf_gutenberg_blocks');
function child_register_acf_gutenberg_blocks() {
	
	// check that function exists
	if( function_exists('acf_register_block') ) {

		// register a callout block
		acf_register_block(array(
			'name'				=> 'callout',
			'title'				=> __('Callout', 'inti-child'),
			'description'		=> __('A standard Foundation 6 callout container.', 'inti-child'),
			'render_callback'	=> 'inti_gutenberg_block_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'welcome-comments',
			'keywords'			=> array( 'callout', 'alert', 'message', 'warning' ),
		));

		// register a accordion block
		acf_register_block(array(
			'name'				=> 'accordion',
			'title'				=> __('Accordion', 'inti-child'),
			'description'		=> __('A standard Foundation 6 accordion container.', 'inti-child'),
			'render_callback'	=> 'inti_gutenberg_block_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'list-view',
			'keywords'			=> array( 'accordion', 'dropdown' ),
		));

		// register a tabs block
		acf_register_block(array(
			'name'				=> 'tabs',
			'title'				=> __('Tabs', 'inti-child'),
			'description'		=> __('A standard Foundation 6 tabs container.', 'inti-child'),
			'render_callback'	=> 'inti_gutenberg_block_render_callback',
			'category'			=> 'layout',
			'icon'				=> 'menu-alt2',
			'keywords'			=> array( 'tabs', 'navigation' ),
		));
	}
}

/**
 * Render functions for each of our Gutenberg Blocks
 */
function inti_gutenberg_block_render_callback( $block ) {
	
	// convert name ("acf/block-name") into path friendly slug ("block-name")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/blocks" folder
	if( file_exists( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") );
	}
}



/**
 * Register Flexible Content Blocks with Advanced Custom Fields
 * 
 */
add_action('acf/init', 'child_register_content_acf_blocks');
function child_register_content_acf_blocks() {
	
	// check that function exists
	if( function_exists('acf_register_block') ) {
		
		// register a recent-posts
		acf_register_block(array(
			'name'				=> 'recent-posts',
			'title'				=> __('Recent Posts', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A tidy grid of posts showing summaries and featured images.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'excerpt-view',
			'keywords'			=> array( 'posts', 'recent', 'blog' ),
		));
		
		// register a paragraph block
		acf_register_block(array(
			'name'				=> 'paragraph-block',
			'title'				=> __('Paragraph Block', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('Like \'Classic\' block but with wrapper like a Content Block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'editor-paragraph',
			'keywords'			=> array( 'editor', 'classic', 'paragraph' ),
		));
		
		// register a paragraph grid
		acf_register_block(array(
			'name'				=> 'paragraph-grid',
			'title'				=> __('Paragraph Grid', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A grid of paragraphs with different breakpoint settings.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'editor-paragraph',
			'keywords'			=> array( 'grid', 'matrix', 'paragraph' ),
		));
		
		// register a icon buttons
		acf_register_block(array(
			'name'				=> 'icon-buttons',
			'title'				=> __('Icon Buttons', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A grid of icons with different breakpoint settings.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'screenoptions',
			'keywords'			=> array( 'icons', 'buttons' ),
		));

		// register a testimonials block
		acf_register_block(array(
			'name'				=> 'testimonials',
			'title'				=> __('Testimonials', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A custom testimonials block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'smiley',
			'keywords'			=> array( 'testimonials', 'quote' ),
		));

		// register a services block
		acf_register_block(array(
			'name'				=> 'services',
			'title'				=> __('Services', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A custom services block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'smiley',
			'keywords'			=> array( 'services' ),
		));
		
		// register a personal bio
		acf_register_block(array(
			'name'				=> 'personal-bio',
			'title'				=> __('Personal Bio', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('Similar to the Media & Text block, this is for displaying a bio, photo and link to about page.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'businesswoman',
			'keywords'			=> array( 'bio', 'about', 'personal', 'welcome', 'profile' ),
		));

		// register a logos/brands block
		acf_register_block(array(
			'name'				=> 'logos-brands',
			'title'				=> __('Logos/Brands', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A custom logos block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'images-alt',
			'keywords'			=> array( 'logos', 'brands', 'as seen in', 'carousel' ),
		));

		// register a map block
		acf_register_block(array(
			'name'				=> 'map',
			'title'				=> __('Map', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A custom map block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'admin-site',
			'keywords'			=> array( 'map', 'location', 'google' ),
		));

		// register a video block
		acf_register_block(array(
			'name'				=> 'video',
			'title'				=> __('Video', 'inti-child') . " " . __('[Content Block]', 'inti-child'),
			'description'		=> __('A custom video block.', 'inti-child'),
			'render_callback'	=> 'inti_content_block_render_callback',
			'category'			=> 'inti-content-blocks',
			'icon'				=> 'video-alt3',
			'keywords'			=> array( 'video', 'location', 'youtube' ),
		));
	}
}

/**
 * Render functions for each of our Content Blocks
 */
function inti_content_block_render_callback( $block ) {
	
	// convert name ("acf/block-name") into path friendly slug ("block-name")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/blocks" folder
	if( file_exists( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/content-{$slug}.php") );
	}
}

/**
 * Create a category to contain those blocks that are structual, like our Flexible Content Blocks
 * using the Flexible Content field in ACF. Gutenberg Blocks added to this category will/should
 * have wrappers that can have background colors and padding applied.
 */
function inti_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'inti-content-blocks',
				'title' => __( 'Inti Content Blocks', 'inti-child' ),
				'icon' => 'admin-home'
			),
		)
	);
}
add_filter( 'block_categories', 'inti_block_category', 10, 2);


?>