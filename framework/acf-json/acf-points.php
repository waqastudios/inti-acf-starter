<?php
/**
 * ACF Save and Load Points
 * For ACF local JSON
 *
 * @package Inti
 * @author Elliot Condon
 * @since 1.3.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


add_filter('acf/settings/save_json', 'inti_acf_json_save_point');
function inti_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/framework/acf-json';
	return $path;
}

add_filter('acf/settings/load_json', 'inti_acf_json_load_point');
function inti_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset($paths[0]);
	
	// append path
	$paths[] = get_stylesheet_directory() . '/framework/acf-json';
	return $paths;
}

?>