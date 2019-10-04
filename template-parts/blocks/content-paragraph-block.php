<?php
/**
 * Block Name: Paragraph Block
 * Type: Inti Content Block
 *
 * This is the template that displays the contents of a Classic editor in a wrapper.
 */

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'paragraph-block-' . $block['id'];



?>
<section class="inti-content-block paragraph-block <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		


	<div class="grid-container to-animate">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				
				<article class="entry-body">
					<div class="entry-body">

						<div class="entry-content">
							<?php inti_hook_page_content_before_the_content(); ?>
							<?php the_field('paragraph'); ?>
							<?php inti_hook_page_content_after_the_content(); ?>
						</div><!-- .entry-content -->
						
					</div><!-- .entry-body -->
				</article><!-- #post -->

			</div><!-- .cell -->
		</div><!-- .grid-x .grid-container-x -->
	</div><!-- .grid-container -->

</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>