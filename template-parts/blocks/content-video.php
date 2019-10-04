<?php
/**
 * Block Name: Video
 * Type: Inti Content Block
 *
 * This is the template that displays the testimonial block.
 */

$aspect = get_field('aspect_ratio');
$source = get_field('video_source');
$videoid = get_field('video_id');

$bgcolor = get_field('background_color');
$bgimg = get_field('background_image');
$invert = get_field('invert_text');

$classes = ""; $style = "";
if ($invert) $classes .= "invert-text";	
if ($bgimg) $classes .= "cover";
if ($bgimg) $style = " background-image:url('" . $bgimg . "');";

if ($style) $style = ' style="' . $style . '"';

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'video-' . $block['id'];



?>
<section class="inti-content-block video <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<div class="grid-container to-animate">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				
				<article>
					<?php if ($videoid) : ?>
					<div class="flex-video <?php echo $aspect; ?>">

					<?php 
						switch ($source) {
							case 'youtube':
								?> 
									<iframe src="http://www.youtube.com/embed/<?php echo $videoid; ?>?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0"></iframe>
								<?php
								break;
							case 'vimeo':
								?> 
									<iframe src="http://player.vimeo.com/video/<?php echo $videoid; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								<?php
								break;
							case 'wistia':
								?> 
									<iframe src="http://fast.wistia.net/embed/iframe/<?php echo $videoid; ?>?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>
								<?php
								break;
						}
					?>
					</div>
					<?php endif; ?>
					
				</article>

			</div><!-- .cell -->
		</div><!-- .grid-x .grid-container-x -->
	</div><!-- .grid-container -->
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>