<?php
/**
 * Block Name: Paragraph Grid
 * Type: Inti Content Block
 *
 * This is the template that displays the a grid of paragraphs.
 */

$small = get_field('post_columns_small');
$medium = get_field('post_columns_medium');
$mlarge = get_field('post_columns_mlarge');
$large = get_field('post_columns_large');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'paragraph-grid-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

?>
<section class="inti-content-block paragraph-grid <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<?php
		if( have_rows('paragraph_items') ):
			?>

		<div class="grid-container to-animate">
			<div class="grid-x grid-margin-x grid-margin-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">

			<?php 
				$c = 1;
				while ( have_rows('paragraph_items') ) : the_row(); ?>
				<div class="small-12 cell">
					
					<article id="inti-block-entry-<?php echo $c; ?>" class="inti-block-entry">
						<div class="entry-body">

							<div class="entry-content">
								<?php inti_hook_page_content_before_the_content(); ?>
								<?php the_sub_field('paragraph'); ?>
								<?php inti_hook_page_content_after_the_content(); ?>
							</div><!-- .entry-content -->
							
						</div><!-- .entry-body -->
					</article><!-- #post -->

				</div><!-- .cell -->
			<?php $c++; endwhile; ?>


			</div><!-- .grid-x .grid-container-x -->
		</div><!-- .grid-container -->

	<?php endif; ?>
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>