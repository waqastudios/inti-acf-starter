<?php
/**
 * Block Name: Accordion (Foundation 6)
 * Type: Gutenberg Block
 *
 * This is the template that displays the accordion block.
 */

$allowmultiexpand = get_field('allowmultiexpand');
$allowallclosed = get_field('allowallclosed');

$classes = "";

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'accordion-' . $block['id'];



?>
<ul 
	class="inti-gutenberg-block accordion<?php echo $classes; ?>" 
	data-accordion 
	role="tablist" 
	id="<?php echo $id; ?>"
	<?php if ($allowmultiexpand) echo ' data-multi-expand="true"'; ?>
	<?php if ($allowallclosed) echo ' data-allow-all-closed="true"'; ?>
>		<?php if( have_rows('tabs') ): ?>
			<?php 

			// loop through the rows of data
			while ( have_rows('tabs') ) : the_row(); 
				$item_id = md5(uniqid(rand(), true));
			?>

				<li class="accordion-item" data-accordion-item>
					<a href="#accordion-panel-<?php echo $item_id; ?>" role="tab" id="accordion-panel-<?php echo $item_id; ?>-heading" class="accordion-title" aria-controls="accordion-panel-<?php echo $item_id; ?>"><?php the_sub_field('tab_title'); ?></a><div class="accordion-content" roll="tabpanel" data-tab-content aria-labelledby="accordion-panel-heading">
						<?php echo the_sub_field('tab_content'); ?>
					</div>
				</li>

			<?php
			endwhile;
			?>

		<?php endif; ?> 
</ul>