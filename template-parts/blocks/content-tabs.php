<?php
/**
 * Block Name: Tabs (Foundation 6)
 * Type: Gutenberg Block
 *
 * This is the template that displays the accordion block.
 */

$orientation = get_field('orientation');

$classes = "";

$classes .= $block['align'] ? 'align' . $block['align'] : '';
$id = 'tabs-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

if ( $orientation == 'horizontal' ) : ?>
	<div class="inti-gutenberg-block tabs<?php echo $classes; ?>" id="<?php echo $id; ?>">
		<div class="tabs-wrapper">
			<ul class="tabs <?php echo $orientation; ?>" data-tabs id="inti-tabs-<?php echo $id; ?>">
			<?php if( have_rows('tabs') ): ?>
				<?php 
				$c = 0;
				// loop through the rows of data
				while ( have_rows('tabs') ) : the_row(); 
					$item_id = md5(uniqid(rand(), true));
				?>
					<li class="tabs-title<?php if ($c==0) echo ' is-active'; ?>"><a href="#tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('tab_title'); ?></a></li>
				<?php
				$c++;
				endwhile;
			endif; ?> 
			</ul>

			<div class="tabs-content <?php echo $orientation; ?>" data-tabs-content="inti-tabs-<?php echo $id; ?>">
			<?php if( have_rows('tabs') ): ?>
				<?php 
				$c = 0;
				// loop through the rows of data
				while ( have_rows('tabs') ) : the_row(); 
					$item_id = md5(uniqid(rand(), true));
				?>
					<div class="tabs-panel<?php if ($c==0) echo ' is-active'; ?>" id="tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('tab_content'); ?></div>
				<?php
				$c++;
				endwhile;
			endif; ?> 
			</div><!-- /.tabs-content -->
		</div><!-- /.tabs-wrapper -->
	</div>
<?php elseif ( $orientation == 'vertical' ) : ?>
	<div class="inti-gutenberg-block tabs<?php echo $classes; ?>" id="<?php echo $id; ?>">
		<div class="tabs-wrapper grid-x">
			<div class="cell medium-3">
				<ul class="tabs <?php echo $orientation; ?>" data-tabs id="inti-tabs-<?php echo $id; ?>">
				<?php if( have_rows('tabs') ): ?>
					<?php 
					$c = 0;
					// loop through the rows of data
					while ( have_rows('tabs') ) : the_row(); 
						$item_id = md5(uniqid(rand(), true));
					?>
						<li class="tabs-title<?php if ($c==0) echo ' is-active'; ?>"><a href="#tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('tab_title'); ?></a></li>
					<?php
					$c++;
					endwhile;
				endif; ?> 
				</ul>
			</div>
			<div class="cell medium-9">
				<div class="tabs-content <?php echo $orientation; ?>" data-tabs-content="inti-tabs-<?php echo $id; ?>">
				<?php if( have_rows('tabs') ): ?>
					<?php 
					$c = 0;
					// loop through the rows of data
					while ( have_rows('tabs') ) : the_row(); 
						$item_id = md5(uniqid(rand(), true));
					?>
						<div class="tabs-panel<?php if ($c==0) echo ' is-active'; ?>" id="tabpanel-<?php echo $id; ?>-<?php echo $c; ?>"><?php the_sub_field('tab_content'); ?></div>
					<?php
					$c++;
					endwhile;
				endif; ?> 
				</div><!-- /.tabs-content -->
			</div>
		</div><!-- /.tabs-wrapper -->
	</div>
<?php endif; ?>