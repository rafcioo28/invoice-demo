<?php
/**
 * Main function file.
 *
 * @package WordPress
 */

// Includes.
require get_theme_file_path( '/includes/cpt/invoice-cpt.php' );
require get_theme_file_path( '/includes/cpt/restaurant-cpt.php' );
require get_theme_file_path( '/includes/acf-local.php' );


// Supports. 
add_theme_support( 'post-thumbnails' );

/**
 * Styles and scripts.
 */
function enqueue_files() {
	wp_enqueue_script( 'main-js', get_theme_file_uri( '/build/scripts.js' ), array(), '1.0', true );
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800', array(), '1.0' );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0' );
	wp_enqueue_style( 'main-styles', get_theme_file_uri( '/build/style.css' ) );
}

add_action( 'wp_enqueue_scripts', 'enqueue_files' );


// Hooks.
add_action( 'init', 'ci_restaurant_post_type' ); // Init custom post type - restaurant.
add_action( 'init', 'ci_invoice_post_type' ); // Init custom post type - invoice.

// Filters.
add_filter( 'acf/settings/save_json', 'ci_acf_json_save' ); // ACF local save.
add_filter( 'acf/settings/load_json', 'ci_acf_json_load' ); // ACF local load.
