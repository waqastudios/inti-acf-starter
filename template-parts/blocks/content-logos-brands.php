<?php
/**
 * Block Name: Logos/Brands
 * Type: Inti Content Block
 *
 * This lists inti-logo post types in one of two display formats
 * Useful for partners, as seen in, product used, clients we work with
 * and other concepts.
 */

$display_as = get_field('display_as');
$column_count = count(get_field('logos_selected'));

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
$id = 'logos-' . $block['id'];

if( !empty($block['className']) ) $classes .= " " . $block['className'];

?>
<section class="inti-content-block logos <?php echo $classes; ?>" id="<?php echo $id; ?>"<?php echo $style; ?>>		
	<?php if( have_rows('logos_selected') ): ?>
		<?php if ($display_as == 'slides'): ?>	
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-12 cell">
						<div class="inti-carousel inti-logos-carousel clearfix">
							<?php 
							// loop through the rows of data
							while ( have_rows('logos_selected') ) : the_row();  
								$logo = get_sub_field('logo');
							?>
							
								<div class="slide">
									<?php 
									if ( has_post_thumbnail($logo->ID) ) :

										// Get the meta data 
										$logo_url = get_field('logo_link', $logo->ID);
										if ( $logo_url ) : ?>
											<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
												<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class' => 'square-small', 'alt' => $logo->post_title ) ); ?>
											</a>
										<?php 
										else : ?>
											<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class' => 'square-small', 'alt' => $logo->post_title ) ); ?>
										<?php 
										endif; ?>
									<?php 
									endif; ?>
								</div>

							<?php 
							endwhile; ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ($display_as == 'list'): 
		?>			
			<div class="grid-container to-animate">
				<div class="grid-x grid-margin-x grid-margin-y mlarge-up-<?php echo $column_count ?>">

				<?php
					// loop through the rows of data
					while ( have_rows('logos_selected') ) : the_row(); 
						$logo = get_sub_field('logo');
					?>
						<div class="cell">
							<article id="post-<?php echo $logo->ID; ?>" class="inti-logo">
								<div class="entry-body">
									
									<article class="inti-logo">
										<?php 
										if ( has_post_thumbnail($logo->ID) ) :

											// Get the meta data 
											$logo_url = get_field('logo_link', $logo->ID);
											if ( $logo_url ) : ?>
												<a href="<?php echo esc_url($logo_url); ?>" target="_blank">
													<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class'	=> 'square-small', 'alt' => $logo->post_title ) ); ?>
												</a>
											<?php 
											else : ?>
												<?php echo get_the_post_thumbnail( $logo, 'square-small', array( 'class'	=> 'square-small', 'alt' => $logo->post_title ) ); ?>
											<?php 
											endif; ?>
										<?php 
										endif; ?>
									</article>

								</div><!-- .entry-body -->
							</article><!-- #post -->
						</div><!-- .cell -->
											
					<?php
					endwhile;
				?>

				</div>
			</div>


		<?php else : ?>	
			<div class="grid-container">
				<div class="callout warning" data-closable>
					<p><?php _e('No Display As value has been set.', 'inti-child'); ?></p>
					<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php endif; ?>

	<?php else : ?>	
		<div class="grid-container">
			<div class="callout warning" data-closable>
				<p><?php _e('You must select logos to display here', 'inti-child'); ?></p>
				<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	<?php endif; ?>

</section>
<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $bgcolor; ?>;
	}
</style>