<?php
/**
 * Block Name: Map
 * Type: Inti Content Block
 *
 * This is the template that displays the testimonial block.
 */

$mapurl = get_field('map_url');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'map-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

?>
<section class="inti-content-block map <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		<div class="grid-container to-animate">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				
				<iframe src="<?php echo $mapurl; ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div><!-- .cell -->
		</div><!-- .grid-x .grid-container-x -->
	</div><!-- .grid-container -->
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>