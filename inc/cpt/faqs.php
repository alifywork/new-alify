<?php
/**
 * CPT: FAQs — sirf ARCHIVE, single page NAHI + "FAQ Categories" taxonomy.
 *
 * URLs: /faqs/ (archive)  |  /faqs/category/{term}/
 * Single URL par 301 redirect (inc/templates.php).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_faqs_cpt() {
	$labels = array(
		'name'               => esc_html__( 'FAQs', 'alify' ),
		'singular_name'      => esc_html__( 'FAQ', 'alify' ),
		'menu_name'          => esc_html__( 'FAQs', 'alify' ),
		'name_admin_bar'     => esc_html__( 'FAQ', 'alify' ),
		'all_items'          => esc_html__( 'All FAQs', 'alify' ),
		'add_new'            => esc_html__( 'Add New FAQ', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New FAQ', 'alify' ),
		'new_item'           => esc_html__( 'New FAQ', 'alify' ),
		'edit_item'          => esc_html__( 'Edit FAQ', 'alify' ),
		'view_item'          => esc_html__( 'View FAQ', 'alify' ),
		'search_items'       => esc_html__( 'Search FAQs', 'alify' ),
		'not_found'          => esc_html__( 'No FAQs found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No FAQs found in Trash.', 'alify' ),
	);

	register_post_type(
		'faqs',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false, // Single page NAHI
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 26,
			'menu_icon'          => 'dashicons-editor-help',
			'supports'           => array( 'title', 'editor' ),
			'has_archive'        => true, // Archive HAAN
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'faqs',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_faqs_cpt' );

function alify_register_faq_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'FAQ Categories', 'alify' ),
		'singular_name'     => esc_html__( 'FAQ Category', 'alify' ),
		'menu_name'         => esc_html__( 'FAQ Categories', 'alify' ),
		'all_items'         => esc_html__( 'All FAQ Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit FAQ Category', 'alify' ),
		'view_item'         => esc_html__( 'View FAQ Category', 'alify' ),
		'update_item'       => esc_html__( 'Update FAQ Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New FAQ Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New FAQ Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent FAQ Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent FAQ Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search FAQ Categories', 'alify' ),
		'not_found'         => esc_html__( 'No FAQ categories found.', 'alify' ),
	);

	register_taxonomy(
		'faq_category',
		array( 'faqs' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'faqs/category', // URL: /faqs/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_faq_category_taxonomy' );
