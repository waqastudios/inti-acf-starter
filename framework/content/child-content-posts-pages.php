<?php
/**
 * Content - Posts and Pages
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * 
 */
function child_remove_posts_pages_actions(){
    remove_action( 'inti_hook_page_header', 'inti_do_page_header_title');
}
add_action( 'after_setup_theme', 'child_remove_posts_pages_actions', 15 );


/**
 * Page Title 
 * Title for the <header> of each page, we don't show this on a front-page.
 *
 * This child copy can be made dependent on ACF options.
 *
 * (We sometimes place page title in a hero bar instead of the article.
 * Archive headings/titles can found inside each archive file, such as category.php, 
 * archive, tag, author, search, which can be copied from Inti to move their headings 
 * to a hero area – some of these only available after fully initialized, even as late
 * as body_class hook, as with is_category() )
 */
function child_do_page_header_title() {
	if ( !is_front_page() ) : 
		if ( !is_search() ) :
		?>
			<?php $acf_show = get_field('hide_main_page_title'); ?>
			<?php if (!$acf_show): ?>		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>
		<?php else : ?>

				
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif;
	endif;
}
add_action('inti_hook_page_header', 'child_do_page_header_title');
?>