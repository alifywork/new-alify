<?php
/**
 * Hardening — XML-RPC, user enumeration, version leaks, REST data leaks band.
 *
 * SERVER-SIDE YEH ADD KAREIN (wp-config.php) — theme ye constants set nahi kar sakta:
 *   define( 'DISALLOW_FILE_EDIT', true );        // Admin se file editing band
 *   define( 'DISALLOW_FILE_MODS', true );        // Plugin/theme install/update band (optional)
 *   define( 'FORCE_SSL_ADMIN', true );           // Admin hamesha SSL par
 *   define( 'WP_AUTO_UPDATE_CORE', 'minor' );    // Sirf security minor updates auto
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/* ---------- XML-RPC band (brute-force amplification + pingback abuse) ---------- */
add_filter( 'xmlrpc_enabled', '__return_false' );

/* ---------- Trackbacks/Pingbacks band (link spam) ---------- */
add_filter( 'pings_open', '__return_false' );

/* ---------- Fingerprinting: version + discovery links ---------- */
function alify_remove_head_clutter() {
	remove_action( 'wp_head', 'wp_generator' );          // WP version meta
	remove_action( 'wp_head', 'rsd_link' );              // RSD (XML-RPC discovery)
	remove_action( 'wp_head', 'wlwmanifest_link' );      // Windows Live Writer
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 ); // Shortlink
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // (belt + suspenders)
}
add_action( 'init', 'alify_remove_head_clutter' );

/**
 * Visitor ke CSS/JS URLs se ?ver= version query hatao (fingerprinting kam).
 * Logged-in editors ko version dikhaye debugging ke liye.
 *
 * @param string $src URL.
 * @return string
 */
function alify_strip_asset_version( $src ) {
	if ( is_user_logged_in() || empty( $src ) ) {
		return $src;
	}
	$src = preg_replace( '/(\?|&)ver=[^&]+/', '', $src );
	return rtrim( $src, '?&' );
}
add_filter( 'style_loader_src', 'alify_strip_asset_version' );
add_filter( 'script_loader_src', 'alify_strip_asset_version' );

/* ---------- User enumeration band (?author=1 se username leak) ---------- */
function alify_block_author_enumeration( $wp ) {
	if ( isset( $wp->query_vars['author'] ) && ! current_user_can( 'list_users' ) ) {
		// Author ID chupao -> koi post match nahi -> 404.
		$wp->query_vars['author'] = 0;
	}
}
add_action( 'parse_request', 'alify_block_author_enumeration' );

/* ---------- REST API: anonymous users ke liye users endpoints band ---------- */
function alify_restrict_rest_users( $endpoints ) {
	if ( is_user_logged_in() ) {
		return $endpoints;
	}
	foreach ( array_keys( $endpoints ) as $alify_key ) {
		if ( 0 === strpos( $alify_key, '/wp/v2/users' ) ) {
			unset( $endpoints[ $alify_key ] );
		}
	}
	return $endpoints;
}
add_filter( 'rest_endpoints', 'alify_restrict_rest_users' );
