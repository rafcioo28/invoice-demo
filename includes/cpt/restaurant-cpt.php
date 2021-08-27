<?php
/**
 * Register restaurant Post Type file.
 *
 * @package WordPress.
 */

/**
 * Register restaurant Post Type function.
 */
function ci_restaurant_post_type() {

	$labels = array(
		'name'                  => _x( 'Restaurants', 'Post Type General Name', 'CreateIt-demo' ),
		'singular_name'         => _x( 'Restaurant', 'Post Type Singular Name', 'CreateIt-demo' ),
		'menu_name'             => __( 'Restaurant', 'CreateIt-demo' ),
		'name_admin_bar'        => __( 'Restaurant', 'CreateIt-demo' ),
		'archives'              => __( 'Item Archives', 'CreateIt-demo' ),
		'attributes'            => __( 'Item Attributes', 'CreateIt-demo' ),
		'parent_item_colon'     => __( 'Parent Item:', 'CreateIt-demo' ),
		'all_items'             => __( 'All Items', 'CreateIt-demo' ),
		'add_new_item'          => __( 'Add New Item', 'CreateIt-demo' ),
		'add_new'               => __( 'Add New', 'CreateIt-demo' ),
		'new_item'              => __( 'New Item', 'CreateIt-demo' ),
		'edit_item'             => __( 'Edit Item', 'CreateIt-demo' ),
		'update_item'           => __( 'Update Item', 'CreateIt-demo' ),
		'view_item'             => __( 'View Item', 'CreateIt-demo' ),
		'view_items'            => __( 'View Items', 'CreateIt-demo' ),
		'search_items'          => __( 'Search Item', 'CreateIt-demo' ),
		'not_found'             => __( 'Not found', 'CreateIt-demo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'CreateIt-demo' ),
		'featured_image'        => __( 'Featured Image', 'CreateIt-demo' ),
		'set_featured_image'    => __( 'Set featured image', 'CreateIt-demo' ),
		'remove_featured_image' => __( 'Remove featured image', 'CreateIt-demo' ),
		'use_featured_image'    => __( 'Use as featured image', 'CreateIt-demo' ),
		'insert_into_item'      => __( 'Insert into item', 'CreateIt-demo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'CreateIt-demo' ),
		'items_list'            => __( 'Items list', 'CreateIt-demo' ),
		'items_list_navigation' => __( 'Items list navigation', 'CreateIt-demo' ),
		'filter_items_list'     => __( 'Filter items list', 'CreateIt-demo' ),
	);

	$args = array(
		'label'               => __( 'Restaurant', 'CreateIt-demo' ),
		'description'         => __( 'Post Type Description', 'CreateIt-demo' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'menu_icon'           => 'dashicons-food',
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
		'rewrite'             => array( 'slug' => 'restaurants' ),
	);

	register_post_type( 'restaurant', $args );
}
