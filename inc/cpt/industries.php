<?php
/**
 * CPT: Industries — single + archive + "Industry Categories" taxonomy.
 *
 * URLs: /industries/  |  /industries/{industry-slug}/  |  /industries/category/{term-slug}/
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_industries_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Industries', 'alify' ),
		'singular_name'      => esc_html__( 'Industry', 'alify' ),
		'menu_name'          => esc_html__( 'Industries', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Industry', 'alify' ),
		'all_items'          => esc_html__( 'All Industries', 'alify' ),
		'add_new'            => esc_html__( 'Add New Industry', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Industry', 'alify' ),
		'new_item'           => esc_html__( 'New Industry', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Industry', 'alify' ),
		'view_item'          => esc_html__( 'View Industry', 'alify' ),
		'search_items'       => esc_html__( 'Search Industries', 'alify' ),
		'not_found'          => esc_html__( 'No industries found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No industries found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Industry Image', 'alify' ),
		'set_featured_image' => esc_html__( 'Set industry image', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove industry image', 'alify' ),
	);

	register_post_type(
		'industries',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 23,
			'menu_icon'          => 'dashicons-building',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'industries',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_industries_cpt' );

function alify_register_industry_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Industry Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Industry Category', 'alify' ),
		'menu_name'         => esc_html__( 'Industry Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Industry Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Industry Category', 'alify' ),
		'view_item'         => esc_html__( 'View Industry Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Industry Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Industry Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Industry Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Industry Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Industry Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Industry Categories', 'alify' ),
		'not_found'         => esc_html__( 'No industry categories found.', 'alify' ),
	);

	register_taxonomy(
		'industry_category',
		array( 'industries' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'industries/category', // URL: /industries/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_industry_category_taxonomy' );
