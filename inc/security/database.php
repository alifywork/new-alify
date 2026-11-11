<?php
/**
 * Safe database helpers — SQL injection se bachne ke liye hamesha $wpdb->prepare.
 * Direct $wpdb->query() kabhi mat likhein; ye wrappers use karein.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Prepared SELECT — rows return karo.
 *
 * @param string $sql    SQL with %s / %d placeholders.
 * @param array  $args   Arguments (prepare ke liye).
 * @return array
 */
function alify_db_results( $sql, $args = array() ) {
	global $wpdb;

	if ( empty( $sql ) || false === strpos( $sql, '%') ) {
		return array();
	}

	$alify_prepared = $wpdb->prepare( $sql, $args ); // phpcs:ignore WordPress.DB.PreparedSQL
	if ( ! $alify_prepared ) {
		return array();
	}

	$alify_results = $wpdb->get_results( $alify_prepared, ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL
	return is_array( $alify_results ) ? $alify_results : array();
}

/**
 * Prepared SELECT — single value.
 *
 * @param string $sql  SQL with placeholders.
 * @param array  $args Arguments.
 * @return mixed
 */
function alify_db_var( $sql, $args = array() ) {
	global $wpdb;

	if ( empty( $sql ) || false === strpos( $sql, '%') ) {
		return null;
	}

	$alify_prepared = $wpdb->prepare( $sql, $args ); // phpcs:ignore WordPress.DB.PreparedSQL
	if ( ! $alify_prepared ) {
		return null;
	}

	return $wpdb->get_var( $alify_prepared ); // phpcs:ignore WordPress.DB.PreparedSQL
}
