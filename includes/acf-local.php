<?php
/**
 * ACF Local settings.
 *
 * @package WordPress.
 */

/**
 * ACF save fields function.
 *
 * @param    string $path     Path to json files.
 */
function ci_acf_json_save( $path ) {

	$path = get_stylesheet_directory() . '/acf-json';

	return $path;
}

/**
 * ACF load fields function.
 *
 * @param    array $paths     Paths to json files.
 */
function ci_acf_json_load( $paths ) {

	// remove original path (optional).
	unset( $paths[0] );

	// append path.
	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}
