<?php
/**
 * Secure AJAX helpers — nonce + capability check ke bina koi action mat chalao.
 *
 * Usage (kisi bhi wp_ajax_* handler mein):
 *   alify_verify_ajax_nonce( 'my_action' );
 *   alify_require_capability( 'edit_posts' ); // zaroori ho to
 *   alify_ajax_success( $data );
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Nonce verify — fail par 403 JSON error + exit.
 *
 * @param string $action Nonce action name.
 * @return true
 */
function alify_verify_ajax_nonce( $action = 'alify_ajax' ) {
	$alify_nonce = isset( $_REQUEST['_wpnonce'] )
		? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) )
		: ( isset( $_REQUEST['nonce'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) )
			: '' );

	if ( ! $alify_nonce || ! wp_verify_nonce( $alify_nonce, $action ) ) {
		wp_send_json_error(
			array( 'message' => esc_html__( 'Security check failed.', 'alify' ) ),
			403
		);
	}
	return true;
}

/**
 * Capability check — fail par 403 JSON error + exit.
 *
 * @param string $capability Capability name.
 * @return true
 */
function alify_require_capability( $capability = 'read' ) {
	if ( ! current_user_can( $capability ) ) {
		wp_send_json_error(
			array( 'message' => esc_html__( 'You are not allowed to do that.', 'alify' ) ),
			403
		);
	}
	return true;
}

/**
 * Secure success response.
 *
 * @param mixed $data Data.
 * @return void
 */
function alify_ajax_success( $data = array() ) {
	wp_send_json_success( $data );
}

/**
 * Secure error response.
 *
 * @param string $message Message.
 * @param int    $code    HTTP code.
 * @return void
 */
function alify_ajax_error( $message = '', $code = 400 ) {
	wp_send_json_error(
		array( 'message' => esc_html( $message ) ),
		$code
	);
}
