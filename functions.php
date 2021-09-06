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
require get_theme_file_path( '/includes/ajax-pagination.php' );

// Supports.
add_theme_support( 'post-thumbnails' );
add_theme_support(
	'html5',
	array(
		'script',
		'style',
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	)
);

// Image sizes.
add_image_size( 'restaurant_thumbnail', 40, 40, array( 'center', 'center' ) );

/**
 * Styles and scripts.
 */
function enqueue_files() {
	wp_enqueue_style( 'jquery-style', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );
	wp_enqueue_script( 'main-js', get_theme_file_uri( '/build/scripts.js' ), array(), '1.0', true );
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800', array(), '1.0' );
	wp_enqueue_style( 'main-styles', get_theme_file_uri( '/build/style.css' ) );

	wp_localize_script(
		'main-js',
		'ciInvoiceData',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'enqueue_files' );


// Hooks.
add_action( 'init', 'ci_restaurant_post_type' ); // Init custom post type - restaurant.
add_action( 'init', 'ci_invoice_post_type' ); // Init custom post type - invoice.
add_action( 'wp_ajax_ci_invoices_pagination', 'ci_invoices_pagination' ); // Ajax pagination.
add_action( 'wp_ajax_nopriv_ci_invoices_pagination', 'ci_invoices_pagination' ); // Ajax pagination.
// Filters.
add_filter( 'acf/settings/save_json', 'ci_acf_json_save' ); // ACF local save.
add_filter( 'acf/settings/load_json', 'ci_acf_json_load' ); // ACF local load.
