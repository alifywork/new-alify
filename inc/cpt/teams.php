<?php
/**
 * CPT: Teams — single + archive + "Team Categories" taxonomy.
 *
 * URLs: /teams/  |  /teams/{member-slug}/  |  /teams/category/{term-slug}/
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_teams_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Teams', 'alify' ),
		'singular_name'      => esc_html__( 'Team Member', 'alify' ),
		'menu_name'          => esc_html__( 'Teams', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Team Member', 'alify' ),
		'all_items'          => esc_html__( 'All Team Members', 'alify' ),
		'add_new'            => esc_html__( 'Add New Member', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Team Member', 'alify' ),
		'new_item'           => esc_html__( 'New Team Member', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Team Member', 'alify' ),
		'view_item'          => esc_html__( 'View Team Member', 'alify' ),
		'search_items'       => esc_html__( 'Search Team Members', 'alify' ),
		'not_found'          => esc_html__( 'No team members found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No team members found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Member Photo', 'alify' ),
		'set_featured_image' => esc_html__( 'Set member photo', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove member photo', 'alify' ),
	);

	register_post_type(
		'teams',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 22,
			'menu_icon'          => 'dashicons-groups',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'teams',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_teams_cpt' );

function alify_register_team_category_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Team Categories', 'alify' ),
		'singular_name'     => esc_html__( 'Team Category', 'alify' ),
		'menu_name'         => esc_html__( 'Team Categories', 'alify' ),
		'all_items'         => esc_html__( 'All Team Categories', 'alify' ),
		'edit_item'         => esc_html__( 'Edit Team Category', 'alify' ),
		'view_item'         => esc_html__( 'View Team Category', 'alify' ),
		'update_item'       => esc_html__( 'Update Team Category', 'alify' ),
		'add_new_item'      => esc_html__( 'Add New Team Category', 'alify' ),
		'new_item_name'     => esc_html__( 'New Team Category Name', 'alify' ),
		'parent_item'       => esc_html__( 'Parent Team Category', 'alify' ),
		'parent_item_colon' => esc_html__( 'Parent Team Category:', 'alify' ),
		'search_items'      => esc_html__( 'Search Team Categories', 'alify' ),
		'not_found'         => esc_html__( 'No team categories found.', 'alify' ),
	);

	register_taxonomy(
		'team_category',
		array( 'teams' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'teams/category', // URL: /teams/category/{term}/
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'alify_register_team_category_taxonomy' );
