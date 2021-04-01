<?php 
/**
 * Child Theme Customizer
 *
 * The majority of the customizer options for the Kitchen Sink child theme come from the parent theme.
 * But, we're going to do a few things to customize and expand on them.
 *
 * @since 1.0.3
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
/**
 * Add Customizer generated CSS to header
 *
 * @since 1.0.3
 */
function child_customizer_css() {
	do_action('child_customizer_css');
		
	$output = '';	


	echo ( $output ) ? '<style>' . apply_filters('child_customizer_css', $output) . "\n" . '</style>' . "\n" : '';
}
add_action('wp_head', 'child_customizer_css');


/**
 * JavaScript handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.3
 */
function child_customize_preview_js() {
	wp_enqueue_script('child-inti-customizer-preview', get_stylesheet_directory_uri() . '/framework/customizer/js/child-theme-customizer-preview.js', array('customize-preview'), filemtime(get_stylesheet_directory() . '/framework/customizer/js/child-theme-customizer-preview.js'), true );
}
add_action('customize_preview_init', 'child_customize_preview_js');


/**
 * JavaScript handlers to make Theme Customizer controls perform interesting functions.
 *
 * @since 1.0.3
 */
function child_customize_controls_js() {
	wp_enqueue_script('child-inti-customizer-controls', get_stylesheet_directory_uri() . '/framework/customizer/js/child-theme-customizer-controls.js', array('customize-controls'), filemtime(get_stylesheet_directory() . '/framework/customizer/js/child-theme-customizer-controls.js'), true );
}
add_action('customize_controls_enqueue_scripts', 'child_customize_controls_js');


/**
 * Register Customizer
 *
 * 1) Defines classes for custom controls
 * 2) Adds all sections and settings
 *
 * @since 1.0.3
 */
add_action('inti_customize_register', 'child_new_section');
function child_new_section($wp_customize) {
	
	/**
	 * 1) Defines classes for custom controls
	 */	

	/** 
	 * Dropdown Categories
	 * Shows select for category taxonomy for posts
	 */
	class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';	
		
		public function render_content() {
			$dropdown = wp_dropdown_categories( 
				array( 
					'name'             => '_customize-dropdown-categories-' . $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => '&mdash; ' . __("All Categories", 'inti-child') . ' &mdash;',
					'option_none_value'  => '0',
					'show_count' => true,
					'hide_if_empty'    => false,
					'selected'         => $this->value(),
				 )
			 );

			$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

			printf( 
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			 );
		}
	}

	/** 
	 * Dropdown Services Categories
	 * Shows select for inti-service-category taxonomy created for inti-service custom type
	 */
	class WP_Customize_Dropdown_Services_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-services-categories';	
		
		public function render_content() {
			$dropdown = wp_dropdown_categories( 
				array( 
					'name'             => '_customize-dropdown-services-categories-' . $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_all'  => '&mdash; ' . __("All Categories", 'inti-child') . ' &mdash;',
					'show_count'       => true,
					'taxonomy'         => 'inti-service-category',
					'hide_if_empty'    => false,
					'selected'         => $this->value(),
				 )
			 );

			$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

			printf( 
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			 );
		}
	}

	/** 
	 * Dropdown Testimonials Categories
	 * Shows select for inti-testimonial-category taxonomy created for inti-testimonial custom type
	 */
	class WP_Customize_Dropdown_Testimonials_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-testimonials-categories';	
		
		public function render_content() {
			$dropdown = wp_dropdown_categories( 
				array( 
					'name'             => '_customize-dropdown-testimonials-categories-' . $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_all'  => '&mdash; ' . __("All Categories", 'inti-child') . ' &mdash;',
					'show_count'       => true,
					'taxonomy'         => 'inti-testimonial-category',
					'hide_if_empty'    => false,
					'selected'         => $this->value(),
				 )
			 );

			$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

			printf( 
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			 );
		}
	}

	/** 
	 * WP Editor
	 * Allows for creation of WP Editor WYSIWYG fields
	 */
	class WP_Customize_WPEditor_Control extends WP_Customize_Control {
		public $type = 'wysiwyg';

		public function render_content() { 
			static $i = 1;

			// Important
			static $number_of_editors = 1; // You'll have to manually tell this control how many there'll be
			
			?>
			<style>
				.mce-container {
					z-index: 99999999999999 !important;
				}
				#wp-link-wrap {
					z-index: 99999999999999 !important;
				}
				#wp-link-backdrop {
					z-index: 99999999999999 !important;
				}
			</style>
			<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
				<?php
				$content = $this->value();
				$editor_id = str_replace('[', '_', $this->id);
				$editor_id = str_replace(']', '', $editor_id);
				$settings = array( 
					'textarea_name' => $this->id,
					'media_buttons' => false, 
					'drag_drop_upload'=>false 
				);

				wp_editor( $content, $editor_id, $settings );

				do_action('admin_footer');

				if ($i == $number_of_editors ) {
					do_action('admin_print_footer_scripts');
				}
				$i++;

				?>
			
			</label>
		<?php
		}
	}
	
	/** 
	 * Dropdown Pages 
	 * Shows select for pages
	 */
	class WP_Customize_Dropdown_Pages_Control extends WP_Customize_Control {
		public $type = 'dropdown-pages';	
		
		public function render_content() {

			$args = array(
				'post_type' => 'page',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => 100,
			);
			$optins = new WP_Query($args);

			$dropdown = '<select name="_customize-dropdown-page-'.$this->id.'" 
								 id="_customize-dropdown-page-'.$this->id.'" 
								 class="postform">';

			$dropdown .= '<option value="-1">&mdash; ' . __('Select Page', 'inti-child') . ' &mdash;</option>';


			while($optins->have_posts()) : $optins->the_post();

				$dropdown .= '<option value="'. get_the_ID(). '">'.get_the_title().'</option>';

			endwhile;

				

			$dropdown .= '</select>';

			$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

			printf( 
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			 );
		}

	}

	/** 
	 * Opt-Ins
	 * Shows select for opt ins
	 */
	class WP_Customize_Dropdown_Opt_In_Control extends WP_Customize_Control {
		public $type = 'dropdown-optins';	
		
		public function render_content() {

			$args = array(
				'post_type' => 'inti-opt-in',
				'order' => 'ASC',
				'posts_per_page' => 100,
			);
			$optins = new WP_Query($args);

			$dropdown = '<select name="_customize-dropdown-opt-in-'.$this->id.'" 
								 id="_customize-dropdown-opt-in-'.$this->id.'" 
								 class="postform">';

			$dropdown .= '<option value="-1">&mdash; ' . __('Select Opt-In', 'inti-child') . ' &mdash;</option>';


			while($optins->have_posts()) : $optins->the_post();

				$dropdown .= '<option value="'. get_the_ID(). '">'.get_the_title().'</option>';

			endwhile;

				

			$dropdown .= '</select>';

			$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

			printf( 
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			 );
		}

	}

	/**
	 * Add your customize controls here
	 */

	





	/**
	 * General/Header section exists in parent theme, let's add to it here
	 * Section: inti_customizer_general
	 */
		$wp_customize->add_setting('inti_customizer_options[header_hero_bg]', array( 
			'default'    => get_stylesheet_directory_uri() . '/library/dist/img/default_background.jpg',
			'type'       => 'option',
			'capability' => 'manage_options',
		 ) );	
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 
					'inti_customizer_options[header_hero_bg]', 
					array( 
						'label'    => __('Hero Background Image', 'inti-child'),
						'description' => __('Background image for the hero area (if applicable). Also the default background image for the internal page hero areas (if applicable)', 'inti-child'),
						'section'  => 'inti_customizer_general',
						'settings' => 'inti_customizer_options[header_hero_bg]',
						'priority' => 15,
					)
				)
			);	

	if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) {
			$wp_customize->add_setting('inti_customizer_options[header_opt_in]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );	
				$wp_customize->add_control(
					new WP_Customize_Dropdown_Opt_In_Control(
						$wp_customize,
						'inti_customizer_options[header_opt_in]',
						array(
							'label'    => "Opt-In Form to display",
							'settings' => 'inti_customizer_options[header_opt_in]',
							'section'  => 'inti_customizer_general',
							'priority' => 22,
						)
					)
				);
	}

	/**
	 * Layouts section exists in parent theme, let's add to it here
	 * Section: inti_customizer_posts
	 */

	if (inti_current_theme_supports( 'inti-post-types', 'opt-in' )) {
			$wp_customize->add_setting('inti_customizer_options[footer_opt_in]', array( 
				'default'    => 1,
				'type'       => 'option',
				'capability' => 'manage_options',
			 ) );	
				$wp_customize->add_control(
					new WP_Customize_Dropdown_Opt_In_Control(
						$wp_customize,
						'inti_customizer_options[footer_opt_in]',
						array(
							'label'    => "Opt-In Form to display",
							'settings' => 'inti_customizer_options[footer_opt_in]',
							'section'  => 'inti_customizer_footer',
							'priority' => 2,
						)
					)
				);
	}		
		$wp_customize->add_setting('inti_customizer_options[footer_logo]', array( 
			'default'    => get_option('inti_customizer_options[footer_logo]'),
			'type'       => 'option',
			'capability' => 'manage_options',
			// 'transport'  => 'postMessage',
		 ) );
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize, 
					'inti_customizer_options[footer_logo]', 
					array( 
						'label'    => __('Footer Logo', 'inti-child'),
						'section'  => 'inti_customizer_footer',
						'settings' => 'inti_customizer_options[footer_logo]',
						'priority' => 8,
					)
				)
			);
	/**
	 * Main Styles section exists in parent theme, let's add to it here
	 * Section: inti_customizer_main_styles
	 */

	/**
	 * Content Styles section exists in parent theme, let's add to it here
	 * Section: inti_customizer_content_styles
	 */

	/**
	 * Footer section exists in parent theme, let's add to it here
	 * Section: inti_customizer_footer
	 */


}