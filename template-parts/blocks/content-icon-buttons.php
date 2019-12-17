<?php
/**
 * Block Name: Icon Buttons
 * Type: Inti Content Block
 *
 * This is the template that displays the services block.
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
$id = 'icon-buttons-' . $block['id'];



?>
<section class="inti-content-block icon-buttons <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-padding-y small-up-<?php echo $small ?> medium-up-<?php echo $medium ?> mlarge-up-<?php echo $mlarge ?> large-up-<?php echo $large ?>">
			
			<?php if( have_rows('icons') ): ?>

					<?php 
					// loop through the rows of data
					while ( have_rows('icons') ) : the_row();  
						$img = get_sub_field('icon');
						$icon_title = get_sub_field('icon_title');
						$icon_text = get_sub_field('icon_text');

						$link = get_sub_field('link');
						$link_url = get_sub_field('link_url');
						$link_text = get_sub_field('link_text');
						$make_button = get_sub_field('make_button');
					?>	

					<div class="cell to-animate">
						<article class="icon">
							<div class="entry-thumbnail">
								<?php if ($link) : ?>
									<a href="<?php echo $link_url; ?>">
								<?php endif; ?>
								<?php echo wp_get_attachment_image( $img, 'thumbnail-300', true, array('alt' => $icon_title) ); ?>
								<?php if ($link) : ?>
									</a>
								<?php endif; ?>
							</div>
							<?php if ($icon_title || $icon_text) : ?>	
							<div class="entry-header">
								<h3>
								<?php if ($link) : ?>
									<a href="<?php echo $link_url; ?>">
								<?php endif; ?>
								<?php if ($icon_title) : ?><?php echo $icon_title; ?><?php endif; ?>
								<?php if ($link) : ?>
									</a>
								<?php endif; ?>
								</h3>
								<?php if ($icon_text) : ?><div class="entry-summary"><?php echo $icon_text; ?></div><?php endif; ?>
								<?php if ($link) : ?>
									<?php if ($make_button != "no") : ?>
										<a href="<?php echo $link_url ?>" class="button <?php echo $make_button; ?>"><?php echo $link_text; ?></a>
									<?php else : ?>
										<a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</article>
					</div>

					<?php
					endwhile;
					?>

			<?php endif; ?>
		</div>
	</div>
</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>