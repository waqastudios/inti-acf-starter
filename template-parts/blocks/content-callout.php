<?php
/**
 * Block Name: Callout (Foundation 6)
 * Type: Gutenberg Block
 *
 * This is the template that displays the callout block.
 */

$type = get_field('type');
$style = get_field('style');
$closeable = get_field('closeable');

$classes = "";
if ($type) $classes .= " type";	
if ($style) $classes .= " style";	

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'callout-' . $block['id'];



?>
<div class="inti-gutenberg-block callout<?php echo $classes; ?>" id="<?php echo $id; ?>"<?php if ($closeable) echo ' data-closeable' ?>>		
	<?php the_field('content'); ?>
	<?php if ($closeable) : ?>
		<button class="close-button" aria-label="Dismiss Alert" type="button" data-close><span aria-hidden="true">&times;</span></button>
	<?php endif; ?>
</div>