<?php
/**
 * Security headers — malware/hacking protection ka pehla layer.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_send_security_headers() {
	if ( headers_sent() ) {
		return;
	}

	// MIME sniffing band (drive-by content-type attacks).
	header( 'X-Content-Type-Options: nosniff' );

	// Clickjacking protection (sirf apni site frame kar sakti hai).
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( "Content-Security-Policy: frame-ancestors 'self'" );

	// Referrer mein sensitive URLs leak na hon.
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );

	// Browser features jo site ko zaroorat nahi — off.
	header( 'Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=()' );

	// Flash/PDF jaise legacy clients ko cross-domain requests se roko.
	header( 'X-Permitted-Cross-Domain-Policies: none' );

	// HTTPS par HSTS (browser sirf HTTPS par aaye).
	if ( is_ssl() ) {
		header( 'Strict-Transport-Security: max-age=31536000' );
	}

	// PHP fingerprint chupao (agar SAPI allow kare).
	if ( function_exists( 'header_remove' ) ) {
		header_remove( 'X-Powered-By' );
	}
}
add_action( 'send_headers', 'alify_send_security_headers' );
