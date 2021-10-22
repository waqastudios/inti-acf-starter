<?php
/**
 * Block Name: Recent Posts
 * Type: Inti Content Block
 *
 * Shows recent posts but in a visually appealing format
 */
$number_posts = get_field('number_posts');

$small = get_field('post_columns_small');
$medium = get_field('post_columns_medium');
$mlarge = get_field('post_columns_mlarge');
$large = get_field('post_columns_large');

$order = get_field('order');
$post_category = "";
if (get_field('only_show_posts_from')) {
	$post_category = implode(',', get_field('only_show_posts_from'));
}
$showlinktoblog = get_field('show_link_to_blog_index');
$blogindexurl = get_field('select_page_set_as_blog_index');
$bloglinktext = get_field('text_for_the_button_to_view');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'recent-posts-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];


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
<section class="inti-content-block recent-posts <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<div class="grid-container to-animate">
		<?php if ( $recent_posts_query->have_posts() ) : ?>
		
			<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">
			
				<?php while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); global $more; $more = 0; ?>
					
					<div class="cell">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark">
							<?php include(locate_template('template-parts/part-post-mini-2.php')); ?>
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
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>