<?php
/**
 * CPT: Testimonials — sirf ARCHIVE, single page NAHI + "Testimonial Categories" taxonomy.
 *
 * URLs: /testimonials/ (archive)  |  /testimonials/category/{term}/
 * Single URL par 301 redirect (inc/templates.php).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_testimonials_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Testimonials', 'alify' ),
		'singular_name'      => esc_html__( 'Testimonial', 'alify' ),
		'menu_name'          => esc_html__( 'Testimonials', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Testimonial', 'alify' ),
		'all_items'          => esc_html__( 'All Testimonials', 'alify' ),
		'add_new'            => esc_html__( 'Add New Testimonial', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Testimonial', 'alify' ),
		'new_item'           => esc_html__( 'New Testimonial', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Testimonial', 'alify' ),
		'view_item'          => esc_html__( 'View Testimonial', 'alify' ),
		'search_items'       => esc_html__( 'Search Testimonials', 'alify' ),
		'not_found'          => esc_html__( 'No testimonials found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No testimonials found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Client Photo', 'alify' ),
		'set_featured_image' => esc_html__( 'Set client photo', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove client photo', 'alify' ),
	);

	register_post_type(
		'testimonials',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false, // Single page NAHI
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 27,
			'menu_icon'          => 'dashicons-format-quote',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			'has_archive'        => true, // Archive HAAN
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'testimonials',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_testimonials_cpt' );

function alify_register_testimonial_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Testimonial Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Testimonial Category', 'alify' ),
		'menu_name'         => esc_html__( 'Testimonial Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Testimonial Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Testimonial Category', 'alify' ),
		'view_item'         => esc_html__( 'View Testimonial Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Testimonial Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Testimonial Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Testimonial Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Testimonial Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Testimonial Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Testimonial Categories', 'alify' ),
		'not_found'         => esc_html__( 'No testimonial categories found.', 'alify' ),
	);

	register_taxonomy(
		'testimonial_category',
		array( 'testimonials' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'testimonials/category', // URL: /testimonials/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_testimonial_category_taxonomy' );
