<?php
/**
 * Asset loading: bootstrap -> root style.css -> main CSS -> page CSS, GSAP -> main JS -> page JS.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Current singular/page ka slug (per-page assets ke liye).
 *
 * @return string
 */
function alify_current_page_slug() {
	if ( is_singular() ) {
		$alify_object = get_queried_object();
		if ( $alify_object && ! empty( $alify_object->post_name ) ) {
			return sanitize_title( $alify_object->post_name );
		}
	}
	if ( is_post_type_archive() ) {
		$alify_pt = get_query_var( 'post_type' );
		if ( is_array( $alify_pt ) ) {
			$alify_pt = reset( $alify_pt );
		}
		if ( $alify_pt ) {
			return sanitize_title( $alify_pt );
		}
	}
	return '';
}

function alify_enqueue_assets() {
	$ver = ALIFY_VERSION;

	/* ----- CSS: order matters ----- */
	wp_enqueue_style(
		'alify-bootstrap',
		ALIFY_URI . '/assets/bootstrap/dist/css/bootstrap.min.css',
		array(),
		$ver
	);
	wp_enqueue_style(
		'alify-style',
		get_stylesheet_uri(),
		array( 'alify-bootstrap' ),
		$ver
	);
	wp_enqueue_style(
		'alify-main',
		ALIFY_URI . '/assets/css/style.css',
		array( 'alify-style' ),
		$ver
	);

	/* ----- Sections (page templates ke shared sections) ----- */
	wp_enqueue_style(
		'alify-sections',
		ALIFY_URI . '/assets/css/sections.css',
		array( 'alify-main' ),
		$ver
	);

	/* ----- Header + drawer (component styles, hamesha site-wide) ----- */
	wp_enqueue_style(
		'alify-header',
		ALIFY_URI . '/assets/css/header.css',
		array( 'alify-sections' ),
		$ver
	);
	wp_enqueue_style(
		'alify-drawer',
		ALIFY_URI . '/assets/css/drawer.css',
		array( 'alify-header' ),
		$ver
	);

	/* ----- JS: GSAP -> ScrollTrigger -> Bootstrap -> main.js ----- */
	wp_enqueue_script(
		'alify-gsap',
		ALIFY_URI . '/assets/gsap/dist/gsap.min.js',
		array(),
		$ver,
		true
	);
	wp_enqueue_script(
		'alify-scrolltrigger',
		ALIFY_URI . '/assets/gsap/dist/ScrollTrigger.min.js',
		array( 'alify-gsap' ),
		$ver,
		true
	);
	wp_enqueue_script(
		'alify-bootstrap',
		ALIFY_URI . '/assets/bootstrap/dist/js/bootstrap.bundle.min.js',
		array(),
		$ver,
		true
	);
	wp_enqueue_script(
		'alify-main',
		ALIFY_URI . '/assets/js/main.js',
		array( 'alify-gsap' ),
		$ver,
		true
	);

	wp_enqueue_script(
		'alify-header-js',
		ALIFY_URI . '/assets/js/header.js',
		array( 'alify-main' ),
		$ver,
		true
	);

	// AJAX data (inc/security/ajax.php ke saath use hota hai).
	wp_localize_script(
		'alify-main',
		'alifyData',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'alify_ajax' ),
			'homeUrl' => home_url( '/' ),
		)
	);

	/* ----- Per-page assets: assets/pages/{slug}/css|js (alag folder pattern) ----- */
	$slug = alify_current_page_slug();

	if ( $slug ) {
		$page_css_rel = "/assets/pages/{$slug}/css/{$slug}.css";
		if ( file_exists( ALIFY_DIR . $page_css_rel ) ) {
			wp_enqueue_style(
				"alify-page-{$slug}",
				ALIFY_URI . $page_css_rel,
				array( 'alify-main' ),
				$ver
			);
		}

		$page_js_rel = "/assets/pages/{$slug}/js/{$slug}.js";
		if ( file_exists( ALIFY_DIR . $page_js_rel ) ) {
			wp_enqueue_script(
				"alify-page-{$slug}",
				ALIFY_URI . $page_js_rel,
				array( 'alify-main' ),
				$ver,
				true
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'alify_enqueue_assets' );
