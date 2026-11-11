<?php
/**
 * CPT: Pricing — sirf ARCHIVE, single page NAHI + "Pricing Categories" taxonomy.
 *
 * URLs: /pricing/ (archive)  |  /pricing/category/{term}/
 * Single URL par301 redirect (inc/templates.php) — SEO ke liye 404 nahi.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_pricing_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Pricing', 'alify' ),
		'singular_name'      => esc_html__( 'Pricing Plan', 'alify' ),
		'menu_name'          => esc_html__( 'Pricing', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Pricing Plan', 'alify' ),
		'all_items'          => esc_html__( 'All Plans', 'alify' ),
		'add_new'            => esc_html__( 'Add New Plan', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Pricing Plan', 'alify' ),
		'new_item'           => esc_html__( 'New Pricing Plan', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Pricing Plan', 'alify' ),
		'view_item'          => esc_html__( 'View Pricing Plan', 'alify' ),
		'search_items'       => esc_html__( 'Search Plans', 'alify' ),
		'not_found'          => esc_html__( 'No pricing plans found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No pricing plans found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Plan Image', 'alify' ),
		'set_featured_image' => esc_html__( 'Set plan image', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove plan image', 'alify' ),
	);

	register_post_type(
		'pricing',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false, // Single page NAHI
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-money-alt',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'has_archive'        => true, // Archive HAAN
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'pricing',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_pricing_cpt' );

function alify_register_pricing_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Pricing Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Pricing Category', 'alify' ),
		'menu_name'         => esc_html__( 'Pricing Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Pricing Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Pricing Category', 'alify' ),
		'view_item'         => esc_html__( 'View Pricing Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Pricing Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Pricing Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Pricing Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Pricing Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Pricing Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Pricing Categories', 'alify' ),
		'not_found'         => esc_html__( 'No pricing categories found.', 'alify' ),
	);

	register_taxonomy(
		'pricing_category',
		array( 'pricing' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'pricing/category', // URL: /pricing/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_pricing_category_taxonomy' );
