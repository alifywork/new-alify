<?php
/**
 * Theme activation: navigation menu auto create + locations assign.
 *
 * Menu items: auto pages + CPT archives (services, projects, case studies,
 * industries, team, testimonials, faqs, pricing).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main menu ke items.
 *
 * @return array
 */
function alify_auto_menu_items() {
	$items = array(
		array(
			'title' => __( 'Home', 'alify' ),
			'slug'  => 'home',
		),
		array(
			'title' => __( 'About Us', 'alify' ),
			'slug'  => 'about-us',
		),
		array(
			'title'  => __( 'Services', 'alify' ),
			'pt_arc' => 'services',
		),
		array(
			'title'  => __( 'Projects', 'alify' ),
			'pt_arc' => 'project',
		),
		array(
			'title'  => __( 'Case Studies', 'alify' ),
			'pt_arc' => 'case-studies',
		),
		array(
			'title'  => __( 'Industries', 'alify' ),
			'pt_arc' => 'industries',
		),
		array(
			'title' => __( 'Blogs', 'alify' ),
			'slug'  => 'blogs',
		),
		array(
			'title'  => __( 'Team', 'alify' ),
			'pt_arc' => 'teams',
		),
		array(
			'title'  => __( 'Testimonials', 'alify' ),
			'pt_arc' => 'testimonials',
		),
		array(
			'title'  => __( 'FAQs', 'alify' ),
			'pt_arc' => 'faqs',
		),
		array(
			'title'  => __( 'Pricing', 'alify' ),
			'pt_arc' => 'pricing',
		),
		array(
			'title' => __( 'Contact Us', 'alify' ),
			'slug'  => 'contact-us',
		),
	);

	/**
	 * Filter: auto menu items.
	 *
	 * @param array $items Items.
	 */
	return apply_filters( 'alify_auto_menu_items', $items );
}

/**
 * Menu + locations setup (theme activation par).
 *
 * @return void
 */
function alify_create_menu_on_activation() {
	$alify_menu_name = __( 'Alify Main Menu', 'alify' );
	$alify_menu      = wp_get_nav_menu_object( $alify_menu_name );

	if ( ! $alify_menu ) {
		$alify_menu_id = wp_create_nav_menu( $alify_menu_name );

		if ( is_wp_error( $alify_menu_id ) ) {
			return;
		}
	} else {
		$alify_menu_id = (int) $alify_menu->term_id;
	}

	/* Already items hain to dobara add na karo. */
	$alify_existing = wp_get_nav_menu_items( $alify_menu_id );

	if ( empty( $alify_existing ) ) {
		foreach ( alify_auto_menu_items() as $alify_item ) {
			$alify_object_id = 0;
			$alify_type      = 'custom';
			$alify_url       = home_url( '/' );

			if ( ! empty( $alify_item['slug'] ) ) {
				$alify_page = get_page_by_path( sanitize_title( $alify_item['slug'] ) );

				if ( $alify_page instanceof WP_Post ) {
					$alify_object_id = (int) $alify_page->ID;
					$alify_type      = 'post_type';
					$alify_url       = get_permalink( $alify_page );
				}
			} elseif ( ! empty( $alify_item['pt_arc'] ) ) {
				$alify_url = get_post_type_archive_link( sanitize_key( $alify_item['pt_arc'] ) );
			}

			if ( empty( $alify_url ) ) {
				continue;
			}

			wp_update_nav_menu_item(
				$alify_menu_id,
				0,
				array(
					'menu-item-title'     => $alify_item['title'],
					'menu-item-url'       => $alify_url,
					'menu-item-status'    => 'publish',
					'menu-item-type'      => $alify_type,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $alify_object_id,
				)
			);
		}
	}

	/* Locations assign (jab tak koi menu assigned na ho). */
	$alify_locations = get_theme_mod( 'nav_menu_locations', array() );

	foreach ( array( 'primary', 'drawer' ) as $alify_location ) {
		if ( empty( $alify_locations[ $alify_location ] ) ) {
			$alify_locations[ $alify_location ] = $alify_menu_id;
		}
	}

	set_theme_mod( 'nav_menu_locations', $alify_locations );
}
add_action( 'after_switch_theme', 'alify_create_menu_on_activation', 20 );
