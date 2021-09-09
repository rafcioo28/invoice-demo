<?php
/**
 * Register invoice Post Type file.
 *
 * @package WordPress.
 */

/**
 * Register invoice Post Type function.
 */
function ci_invoice_post_type() {

	$labels = array(
		'name'                  => _x( 'Invoices', 'Post Type General Name', 'createit-demo' ),
		'singular_name'         => _x( 'Invoice', 'Post Type Singular Name', 'createit-demo' ),
		'menu_name'             => __( 'Invoice', 'createit-demo' ),
		'name_admin_bar'        => __( 'Invoice', 'createit-demo' ),
		'archives'              => __( 'Item Archives', 'createit-demo' ),
		'attributes'            => __( 'Item Attributes', 'createit-demo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'createit-demo' ),
		'all_items'             => __( 'All Items', 'createit-demo' ),
		'add_new_item'          => __( 'Add New Item', 'createit-demo' ),
		'add_new'               => __( 'Add New', 'createit-demo' ),
		'new_item'              => __( 'New Item', 'createit-demo' ),
		'edit_item'             => __( 'Edit Item', 'createit-demo' ),
		'update_item'           => __( 'Update Item', 'createit-demo' ),
		'view_item'             => __( 'View Item', 'createit-demo' ),
		'view_items'            => __( 'View Items', 'createit-demo' ),
		'search_items'          => __( 'Search Item', 'createit-demo' ),
		'not_found'             => __( 'Not found', 'createit-demo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'createit-demo' ),
		'featured_image'        => __( 'Featured Image', 'createit-demo' ),
		'set_featured_image'    => __( 'Set featured image', 'createit-demo' ),
		'remove_featured_image' => __( 'Remove featured image', 'createit-demo' ),
		'use_featured_image'    => __( 'Use as featured image', 'createit-demo' ),
		'insert_into_item'      => __( 'Insert into item', 'createit-demo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'createit-demo' ),
		'items_list'            => __( 'Items list', 'createit-demo' ),
		'items_list_navigation' => __( 'Items list navigation', 'createit-demo' ),
		'filter_items_list'     => __( 'Filter items list', 'createit-demo' ),
	);

	$args = array(
		'label'               => __( 'Invoice', 'createit-demo' ),
		'description'         => __( 'Post Type Description', 'createit-demo' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'menu_icon'           => 'dashicons-text-page',
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_rest'        => true,
		'rewrite'             => array( 'slug' => 'invoices' ),
	);

	register_post_type( 'invoice', $args );
}
