<?php
/**
 * Sanitization helpers — har input yahan se guzre (XSS/ injection safety).
 * Templates mein output ke liye core esc_html()/esc_attr()/esc_url() use karein.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Plain text sanitize.
 *
 * @param mixed $value Value.
 * @return string
 */
function alify_sanitize_text( $value ) {
	return sanitize_text_field( (string) $value );
}

/**
 * Key sanitize (slug/taxonomy/post-type jaise).
 *
 * @param mixed $value Value.
 * @return string
 */
function alify_sanitize_key( $value ) {
	return sanitize_key( (string) $value );
}

/**
 * Safe HTML (allowed tags only) — koi script/style nahi guzregi.
 *
 * @param mixed $value Value.
 * @return string
 */
function alify_sanitize_html( $value ) {
	return wp_kses_post( (string) $value );
}

/**
 * URL sanitize.
 *
 * @param mixed $value Value.
 * @return string
 */
function alify_sanitize_url( $value ) {
	return esc_url_raw( (string) $value );
}

/**
 * Integer sanitize.
 *
 * @param mixed $value Value.
 * @return int
 */
function alify_sanitize_int( $value ) {
	return absint( $value );
}

/**
 * Poori array ko recursive sanitize karo (form/AJAX payloads ke liye).
 *
 * @param array $data Data.
 * @return array
 */
function alify_sanitize_array( $data ) {
	$clean = array();
	if ( ! is_array( $data ) ) {
		return $clean;
	}
	foreach ( $data as $alify_key => $alify_value ) {
		$alify_new_key           = alify_sanitize_key( $alify_key );
		$clean[ $alify_new_key ] = is_array( $alify_value )
			? alify_sanitize_array( $alify_value )
			: alify_sanitize_text( $alify_value );
	}
	return $clean;
}
