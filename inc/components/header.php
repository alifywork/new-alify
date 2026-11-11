<?php
/**
 * Header component — settings, menus, logos, social links, drawer helpers.
 *
 * Files:
 *   header.php                              — markup
 *   template-parts/header/brand.php         — logo (light / dark / sticky)
 *   template-parts/header/drawer.php        — right side slide drawer
 *   assets/css/header.css                   — header styles
 *   assets/css/drawer.css                   — drawer styles
 *   assets/js/header.js                     — sticky + drawer behaviour
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Header transparent hai? (hero ke upar overlap)
 *
 * Front page par default YES. Filter se badlo:
 *   add_filter( 'alify_header_transparent', '__return_false' );
 *
 * @return bool
 */
function alify_header_is_transparent() {
	return (bool) apply_filters( 'alify_header_transparent', is_front_page() );
}

/**
 * Transparent header light hero ke upar hai? (tab dark text/logo)
 *
 * @return bool
 */
function alify_header_on_light() {
	return (bool) apply_filters( 'alify_header_on_light', false );
}

/**
 * Header settings (theme mods se override ho sakti hain, filterable).
 *
 * @return array
 */
function alify_header_settings() {
	$defaults = array(
		'cta_primary_text'   => __( "Let's get started", 'alify' ),
		'cta_primary_url'    => home_url( '/contact/' ),
		'cta_secondary_text' => __( 'Schedule a Call', 'alify' ),
		'cta_secondary_url'  => home_url( '/contact/' ),
		'about_eyebrow'      => __( 'About Alify', 'alify' ),
		'about_title'        => __( 'We build brands that move business forward', 'alify' ),
		'about_text'         => __( 'Alify is a strategy-led digital studio. We design, build and scale digital experiences that turn attention into revenue.', 'alify' ),
		'show_cta'           => true,
		'show_about'         => true,
		'show_social'        => true,
	);

	$saved = get_theme_mod( 'alify_header_settings', array() );

	if ( is_array( $saved ) ) {
		$defaults = wp_parse_args( $saved, $defaults );
	}

	/**
	 * Filter: header settings.
	 *
	 * @param array $defaults Settings.
	 */
	return apply_filters( 'alify_header_settings', $defaults );
}

/**
 * Logo URLs — light (dark bg), dark (light bg), sticky (scrolled).
 *
 * @return array
 */
function alify_logo_urls() {
	$logos = array(
		'light'  => ALIFY_URI . '/assets/images/logo/light-logo.png',
		'dark'   => ALIFY_URI . '/assets/images/logo/dark-logo.png',
		'sticky' => ALIFY_URI . '/assets/images/logo/sticky-logo.png',
	);

	/**
	 * Filter: logo URLs.
	 *
	 * @param array $logos Logo URLs.
	 */
	return apply_filters( 'alify_logo_urls', $logos );
}

/**
 * Social links (Customizer: theme_mod `alify_social_links`).
 *
 * @return array
 */
function alify_social_links() {
	$defaults = array(
		'linkedin'  => '#',
		'instagram' => '#',
		'x'         => '#',
		'facebook'  => '#',
		'youtube'   => '#',
	);

	$saved = get_theme_mod( 'alify_social_links', array() );

	$links = is_array( $saved ) ? wp_parse_args( $saved, $defaults ) : $defaults;

	/**
	 * Filter: social links (key => url). Khali value = skip.
	 *
	 * @param array $links Links.
	 */
	return apply_filters( 'alify_social_links', $links );
}

/**
 * Social network ke liye icon + label (whitelist — safe icon classes).
 *
 * @return array
 */
function alify_social_networks() {
	return apply_filters(
		'alify_social_networks',
		array(
			'linkedin'  => array(
				'label' => 'LinkedIn',
				'icon'  => 'linkedin-logo',
			),
			'instagram' => array(
				'label' => 'Instagram',
				'icon'  => 'instagram-logo',
			),
			'x'         => array(
				'label' => 'X',
				'icon'  => 'x-logo',
			),
			'facebook'  => array(
				'label' => 'Facebook',
				'icon'  => 'facebook-logo',
			),
			'youtube'   => array(
				'label' => 'YouTube',
				'icon'  => 'youtube-logo',
			),
			'whatsapp'  => array(
				'label' => 'WhatsApp',
				'icon'  => 'whatsapp-logo',
			),
		)
	);
}

/**
 * Nav menu render helper (fallback ke saath).
 *
 * @param array $args wp_nav_menu args.
 * @return void
 */
function alify_render_nav( $args = array() ) {
	wp_nav_menu(
		wp_parse_args(
			$args,
			array(
				'theme_location' => 'primary',
				'menu_class'     => 'alify-nav__list',
				'container'      => false,
				'depth'          => 3,
				'fallback_cb'    => 'alify_menu_fallback',
			)
		)
	);
}

/**
 * Menu fallback — jab tak admin menu assign na karay.
 * Pages + CPT archives ki list (SEO friendly).
 *
 * @param array $args wp_nav_menu args.
 * @return void
 */
function alify_menu_fallback( $args = array() ) {
	$items = array();

	$alify_pages = get_pages(
		array(
			'sort_column' => 'menu_order',
			'number'      => 8,
			'post_status' => 'publish',
		)
	);

	foreach ( $alify_pages as $alify_page ) {
		$items[] = array(
			'title' => get_the_title( $alify_page ),
			'url'   => get_permalink( $alify_page ),
		);
	}

	$alify_archives = array(
		'services'    => __( 'Services', 'alify' ),
		'project'     => __( 'Projects', 'alify' ),
		'industries'  => __( 'Industries', 'alify' ),
		'case-studies' => __( 'Case Studies', 'alify' ),
	);

	foreach ( $alify_archives as $alify_pt => $alify_label ) {
		$alify_link = get_post_type_archive_link( $alify_pt );

		if ( $alify_link ) {
			$items[] = array(
				'title' => $alify_label,
				'url'   => $alify_link,
			);
		}
	}

	if ( empty( $items ) ) {
		return;
	}

	$menu_class = isset( $args['menu_class'] ) ? sanitize_html_class( $args['menu_class'] ) : 'alify-nav__list';

	echo '<ul class="' . esc_attr( $menu_class ) . '">';

	foreach ( $items as $alify_item ) {
		echo '<li class="menu-item"><a href="' . esc_url( $alify_item['url'] ) . '">' . esc_html( $alify_item['title'] ) . '</a></li>';
	}

	echo '</ul>';
}

/**
 * Drawer ka menu location (drawer > primary fallback).
 *
 * @return string
 */
function alify_drawer_menu_location() {
	return has_nav_menu( 'drawer' ) ? 'drawer' : 'primary';
}
