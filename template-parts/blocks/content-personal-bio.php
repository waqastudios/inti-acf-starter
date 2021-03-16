<?php
/**
 * Block Name: Personal Bio
 * Type: Inti Content Block
 *
 * This is the template that displays a personal bio, useful for personal brands, solopreneurs.
 */

$image = get_field('featured_image');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'personal-bio-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

?>
<section class="inti-content-block personal-bio <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<div class="grid-container to-animate">
		<div class="grid-x grid-margin-x">
			<div class="small-12 mlarge-6 cell">
				<article class="entry-body">
					<div class="entry-content">
						<?php the_field('biography'); ?>
					</div>
				</article>
			</div>
			<div class="small-12 mlarge-6 cell">
				<div class="entry-thumbnail" <?php // if($image) echo 'style="height:100%;background-image: url('. $image .');"' ?>>
					<?php echo wp_get_attachment_image( $image, 'large', true, array('alt' => get_field('alt')) ); ?>
				</div>
			</div><!-- .cell -->
		</div><!-- .grid-x .grid-container-x -->
	</div><!-- .grid-container -->
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>