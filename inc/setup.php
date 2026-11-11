<?php
/**
 * Theme setup: supports, menus, image sizes, i18n, rewrite flush.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_theme_setup() {
	// Text domain (translation ready).
	load_theme_textdomain( 'alify', ALIFY_DIR . '/languages' );

	// Core supports.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Image sizes (cards + hero).
	add_image_size( 'alify-card', 640, 420, true );
	add_image_size( 'alify-hero', 1600, 900, true );

	// Navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'alify' ),
			'drawer'  => esc_html__( 'Drawer Menu (header panel)', 'alify' ),
			'footer'  => esc_html__( 'Footer Menu', 'alify' ),
		)
	);
}
add_action( 'after_setup_theme', 'alify_theme_setup' );

/**
 * Theme activate par rewrite rules flush (CPT/permalink URLs sahi chalein).
 */
function alify_flush_rewrites_on_activate() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'alify_flush_rewrites_on_activate' );

/**
 * Body class: page slug ke hisaab se (per-page CSS/JS pattern ke liye).
 *
 * @param array $classes Classes.
 * @return array
 */
function alify_body_classes( $classes ) {
	if ( is_singular() ) {
		$alify_object = get_queried_object();
		if ( $alify_object && ! empty( $alify_object->post_name ) ) {
			$classes[] = 'page-slug-' . sanitize_html_class( $alify_object->post_name );
		}
	}

	/* Header context: solid header -> content ko neeche karo; transparent -> hero overlap. */
	$classes[] = alify_header_is_transparent() ? 'alify-has-transparent-header' : 'alify-has-solid-header';

	if ( alify_header_is_transparent() && alify_header_on_light() ) {
		$classes[] = 'alify-header-on-light';
	}

	return $classes;
}
add_filter( 'body_class', 'alify_body_classes' );
