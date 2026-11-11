<?php
/**
 * CPT: Services — single + archive, Koi taxonomy nahi.
 *
 * URLs: /services/  |  /services/{service-slug}/
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_register_services_cpt() {
	$labels = array(
		'name'               => esc_html__( 'Services', 'alify' ),
		'singular_name'      => esc_html__( 'Service', 'alify' ),
		'menu_name'          => esc_html__( 'Services', 'alify' ),
		'name_admin_bar'     => esc_html__( 'Service', 'alify' ),
		'all_items'          => esc_html__( 'All Services', 'alify' ),
		'add_new'            => esc_html__( 'Add New Service', 'alify' ),
		'add_new_item'       => esc_html__( 'Add New Service', 'alify' ),
		'new_item'           => esc_html__( 'New Service', 'alify' ),
		'edit_item'          => esc_html__( 'Edit Service', 'alify' ),
		'view_item'          => esc_html__( 'View Service', 'alify' ),
		'search_items'       => esc_html__( 'Search Services', 'alify' ),
		'not_found'          => esc_html__( 'No services found.', 'alify' ),
		'not_found_in_trash' => esc_html__( 'No services found in Trash.', 'alify' ),
		'featured_image'     => esc_html__( 'Service Image', 'alify' ),
		'set_featured_image' => esc_html__( 'Set service image', 'alify' ),
		'remove_featured_image' => esc_html__( 'Remove service image', 'alify' ),
	);

	register_post_type(
		'services',
		array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-hammer',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array(
				'slug'       => 'services',
				'with_front' => false,
			),
			'capability_type'    => 'post',
		)
	);
}
add_action( 'init', 'alify_register_services_cpt' );
