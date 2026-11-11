<?php
/**
 * CPT: Project — single + archive + "Project Categories" taxonomy.
 *
 * URLs (SEO friendly — "project_category" base URL mein NAHI aata):
 *   Archive : /project/
 *   Single  : /project/{project-slug}/
 *   Term    : /project/category/{term-slug}/
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_project_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Projects', 'alify' ),
		'singular_name'      => esc_html__( 'Project', 'alify' ),
		'menu_name'          => esc_html__( 'Projects', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Project', 'alify' ),
		'all_items'          => esc_html__( 'All Projects', 'alify' ),
		'add_new'            => esc_html__( 'Add New Project', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Project', 'alify' ),
		'new_item'           => esc_html__( 'New Project', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Project', 'alify' ),
		'view_item'          => esc_html__( 'View Project', 'alify' ),
		'search_items'       => esc_html__( 'Search Projects', 'alify' ),
		'not_found'          => esc_html__( 'No projects found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No projects found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Project Cover', 'alify' ),
		'set_featured_image' => esc_html__( 'Set project cover', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove project cover', 'alify' ),
	);

	register_post_type(
		'project',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'project',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_project_cpt' );

function alify_register_project_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Project Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Project Category', 'alify' ),
		'menu_name'         => esc_html__( 'Project Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Project Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Project Category', 'alify' ),
		'view_item'         => esc_html__( 'View Project Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Project Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Project Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Project Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Project Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Project Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Project Categories', 'alify' ),
		'not_found'         => esc_html__( 'No project categories found.', 'alify' ),
	);

	register_taxonomy(
		'project_category',
		array( 'project' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'project/category', // URL: /project/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_project_category_taxonomy' );
