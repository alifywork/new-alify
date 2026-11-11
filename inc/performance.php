<?php
/**
 * Performance: emoji scripts/styles aur s.w.org hints hatao.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_remove_emoji_assets() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'alify_remove_emoji_assets' );

/**
 * s.w.org (WordPress.com emoji CDN) ke liye dns-prefetch hatao.
 *
 * @param array  $hints       Resource hints.
 * @param string $relation_type Relation type.
 * @return array
 */
function alify_remove_s_worg_hints( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type && is_array( $hints ) ) {
		foreach ( $hints as $alify_key => $alify_hint ) {
			if ( false !== strpos( $alify_hint, 's.w.org' ) ) {
				unset( $hints[ $alify_key ] );
			}
		}
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'alify_remove_s_worg_hints', 10, 2 );
