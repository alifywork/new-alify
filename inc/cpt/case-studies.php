<?php
/**
 * CPT: Case Studies — single + archive + "Case Study Categories" taxonomy.
 *
 * URLs (hyphen slug — SEO clean):
 *   /case-studies/  |  /case-studies/{slug}/  |  /case-studies/category/{term}/
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_case_studies_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Case Studies', 'alify' ),
		'singular_name'      => esc_html__( 'Case Study', 'alify' ),
		'menu_name'          => esc_html__( 'Case Studies', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Case Study', 'alify' ),
		'all_items'          => esc_html__( 'All Case Studies', 'alify' ),
		'add_new'            => esc_html__( 'Add New Case Study', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Case Study', 'alify' ),
		'new_item'           => esc_html__( 'New Case Study', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Case Study', 'alify' ),
		'view_item'          => esc_html__( 'View Case Study', 'alify' ),
		'search_items'       => esc_html__( 'Search Case Studies', 'alify' ),
		'not_found'          => esc_html__( 'No case studies found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No case studies found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Case Study Cover', 'alify' ),
		'set_featured_image' => esc_html__( 'Set case study cover', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove case study cover', 'alify' ),
	);

	register_post_type(
		'case-studies',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 24,
			'menu_icon'          => 'dashicons-clipboard',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'case-studies', // hyphen, underscore nahi (SEO)
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_case_studies_cpt' );

function alify_register_case_study_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Case Study Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Case Study Category', 'alify' ),
		'menu_name'         => esc_html__( 'Case Study Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Case Study Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Case Study Category', 'alify' ),
		'view_item'         => esc_html__( 'View Case Study Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Case Study Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Case Study Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Case Study Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Case Study Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Case Study Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Case Study Categories', 'alify' ),
		'not_found'         => esc_html__( 'No case study categories found.', 'alify' ),
	);

	register_taxonomy(
		'case_study_category',
		array( 'case-studies' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'case-studies/category', // URL: /case-studies/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_case_study_category_taxonomy' );
