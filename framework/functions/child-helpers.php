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
 * Scrape Instagram profile
 * Based on: https://gist.github.com/cosmocatalano/4544576
 */
function inti_scrape_instagram( $username, $slice = 9 ) {

	$username = strtolower( $username );

	$remote = wp_remote_get( 'https://www.instagram.com/'.trim( $username ) );

	if ( is_wp_error( $remote ) )
		return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'inti-child' ) );

	if ( 200 != wp_remote_retrieve_response_code( $remote ) )
		return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200. ('.wp_remote_retrieve_response_code( $remote ).')', 'inti-child' ) );

	$shards = explode( 'window._sharedData = ', $remote['body'] );
	$insta_json = explode( ';</script>', $shards[1] );
	$insta_array = json_decode( $insta_json[0], TRUE );


	if ( !$insta_array )
		return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'inti-child' ) );


	if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
		$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
	} else {
		return new WP_Error( 'bad_json_2', __( 'Instagram has returned invalid data.', 'inti-child' ) );
	}

	if ( !is_array( $images ) )
		return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'inti-child' ) );

	$instagram = array();

	
	foreach ( $images as $image ) {

		if ( $image['node']['is_video']  == true ) {
			$type = 'video';
		} else {
			$type = 'image';
		}

		$instagram[] = array(
			'description'   => __( 'Instagram Image', 'inti-child' ),
			'link'          => '//instagram.com/p/' . $image['node']['shortcode'],
			'time'          => $image['node']['taken_at_timestamp'],
			'comments'      => $image['node']['edge_media_to_comment']['count'],
			'likes'         => $image['node']['edge_liked_by']['count'],
			'thumbnail'     => $image['node']['thumbnail_src'],
			'type'          => $type
		);
	}



	// do not set an empty transient - should help catch private or empty accounts
	if ( ! empty( $instagram ) ) {
		$instagram = base64_encode( serialize( $instagram ) );
		set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
	}


	if ( ! empty( $instagram ) ) {

		$instagram = unserialize( base64_decode( $instagram ) );
		return array_slice( $instagram, 0, $slice );

	} else {

		return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'inti-child' ) );

	}
}