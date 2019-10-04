<?php 
/**
 * Helpers for this child theme
 *
 * @since 1.0.2
 */


/**
 * Remove the readmore link for excerpts because we'll add out own
 * read more buttons manually outside of the the_excerpt()s HTML tags
 */
function new_excerpt_more( $more ) {
	return '…';
}
add_filter('excerpt_more', 'new_excerpt_more',9999);


/**
 * Get an excerpt outside the Loop even if a manual one was
 * never added
 */
function get_forced_excerpt($post){
	if ( empty( $post->post_excerpt ) ) {
		echo wp_kses_post( wp_trim_words( $post->post_content, 20 ) );
	} else {
		echo wp_kses_post( $post->post_excerpt ); 
	}
}


/**
 * Using the post id of a testimonail, get the metadata and return it with
 * formatting
 */
function get_testimonial_owner($id) {

	$post_t = get_post($id);

	/* Build owner info */
	$testimonial_role = get_field('role', $post_t->ID);
	$testimonial_company = get_field('company', $post_t->ID);
	$testimonial_url = get_field('url', $post_t->ID);
	$testimonial_new = get_field('new_tab', $post_t->ID);

	$owner_html = '<span class="testimonial-name">'.$post_t->post_title.'</span>';
	if ($testimonial_role) {
		$owner_html .= ', <span class="testimonial-role">'.$testimonial_role.'</span>';
		if ($testimonial_company) $owner_html .= ', ';          
	}
	if ($testimonial_company) {
		if ($post_t->post_title && !$testimonial_role) $owner_html .= ', '; 
		$owner_html .= '<span class="testimonial-company">';
		if ($testimonial_url) {
			if ($testimonial_new) {
				$owner_html .= '<a href="'.$testimonial_url.'" target="_blank">'.$testimonial_company.'</a>';
			} else {
				$owner_html .= '<a href="'.$testimonial_url.'">'.$testimonial_company.'</a>';
			}
		} else {
			$owner_html .= $testimonial_company;
		}
		$owner_html .= '</span>';
	}

	return $owner_html;
}


/**
 * Output the formated metadata from get_testimonial_owner()
 */
function the_testimonial_owner($id) {
	$owner_html = get_testimonial_owner($id);

	echo $owner_html;
}

/**
 * Overwrite Inti 25. Check the value of the cookie permissions in Theme Options / Inti Options
 *     against those stored in cookies
 * 
 * @package Inti
 * @since 1.6.1
 */
function inti_check_cookie_allowed( $perms ) {
	if ( current_theme_supports('inti-cookies') ) {
		// get status of cookies
		// Warning: this loads cookies on first visit, with the option to
		// remove them shortly thereafter in the options, which is not strictly
		// how it should be done. 
		// In the future we'll need to load all cookie types asychronously AFTER
		// settings have been accepted by the client.
		if ( isset($_COOKIE["needed-cookies"]) ) {
			$needed = $_COOKIE["needed-cookies"];
		} else {
			$needed = 'true';
		}
		if ( isset($_COOKIE["functional-cookies"]) ) {
			$functional = $_COOKIE["functional-cookies"];
		} else {
			$functional = 'true';
		}
		if ( isset($_COOKIE["optional-cookies"]) ) {
			$optional = $_COOKIE["optional-cookies"];
		} else {
			$optional = 'true';
		}

		$allow = false;

		switch ($perms) {
			case 'NEEDED':
				$allow = ($needed == 'true') ? true : false;
			break;

			case 'FUNCTIONAL':
				$allow = ($functional == 'true') ? true : false;
			break;

			case 'OPTIONAL':
				$allow = ($optional == 'true') ? true : false;
			break;
		}

		return $allow;
	} else {
		return true;
	}
}