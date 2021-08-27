<?php
/**
 * Main function file.
 *
 * @package WordPress
 */

function enqueue_files() {
	wp_enqueue_script( 'main-js', get_theme_file_uri( '/build/index.js' ), array(), '1.0', true );
	wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', array(), '1.0' );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0' );
	wp_enqueue_style( 'main-styles', get_theme_file_uri( '/build/style-index.css' ) );
	wp_enqueue_style( 'extra-styles', get_theme_file_uri( '/build/index.css' ) );
}

add_action( 'wp_enqueue_scripts', 'enqueue_files' );
