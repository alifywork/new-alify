<?php
/**
 * Template routing:
 * - Static pages -> templates/page-{slug}.php
 * - CPT single/archive/taxonomy queries -> templates/ folder ke files
 * - No-single CPT (pricing, faqs, testimonials) ke single URLs -> 301 archive par
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * templates/ folder se CPT template load karo (sanitize_key = path traversal safe).
 *
 * @param string $template Current template path.
 * @return string
 */
function alify_map_cpt_templates( $template ) {
	/* ---------- Static pages: slug -> templates/page-{slug}.php ---------- */
	if ( is_page() ) {
		$alify_page_id   = get_queried_object_id();
		$alify_page_slug = $alify_page_id ? get_post_field( 'post_name', $alify_page_id ) : '';

		if ( $alify_page_slug ) {
			$alify_page_slug = sanitize_key( $alify_page_slug );
			$alify_loc       = locate_template( array( "templates/page-{$alify_page_slug}.php" ) );

			if ( $alify_loc ) {
				return $alify_loc;
			}
		}

		return $template;
	}

	if ( is_singular() ) {
		$alify_pt = get_post_type();
		if ( $alify_pt ) {
			$alify_pt  = sanitize_key( $alify_pt );
			$alify_loc = locate_template( array( "templates/single-{$alify_pt}.php" ) );
			if ( $alify_loc ) {
				return $alify_loc;
			}
		}
		return $template;
	}

	if ( is_post_type_archive() ) {
		$alify_pt = get_query_var( 'post_type' );
		if ( is_array( $alify_pt ) ) {
			$alify_pt = reset( $alify_pt );
		}
		if ( $alify_pt ) {
			$alify_pt  = sanitize_key( $alify_pt );
			$alify_loc = locate_template( array( "templates/archive-{$alify_pt}.php" ) );
			if ( $alify_loc ) {
				return $alify_loc;
			}
		}
		return $template;
	}

	if ( is_tax() ) {
		$alify_term = get_queried_object();
		if ( $alify_term && ! empty( $alify_term->taxonomy ) ) {
			$alify_tax = sanitize_key( $alify_term->taxonomy );

			// Agar koi dedicated taxonomy template ho to wo.
			$alify_loc = locate_template( array( "templates/taxonomy-{$alify_tax}.php" ) );
			if ( $alify_loc ) {
				return $alify_loc;
			}

			// Warna us CPT ka archive template (term archive = CPT look).
			$alify_tax_obj = get_taxonomy( $alify_tax );
			if ( $alify_tax_obj && ! empty( $alify_tax_obj->object_type ) ) {
				foreach ( $alify_tax_obj->object_type as $alify_obj_pt ) {
					$alify_obj_pt = sanitize_key( $alify_obj_pt );
					$alify_loc    = locate_template( array( "templates/archive-{$alify_obj_pt}.php" ) );
					if ( $alify_loc ) {
						return $alify_loc;
					}
				}
			}
		}
	}

	return $template;
}
add_filter( 'template_include', 'alify_map_cpt_templates', 20 );

/**
 * No-single CPT ke single URLs ko 301 se archive par bhejo (SEO: 404 nahi, 301).
 *
 * @package Alify
 */
function alify_redirect_no_single_cpt() {
	if ( ! is_singular() || is_preview() ) {
		return;
	}

	$alify_no_single = array( 'pricing', 'faqs', 'testimonials' );
	$alify_pt        = get_post_type();

	if ( in_array( $alify_pt, $alify_no_single, true ) ) {
		$alify_archive = get_post_type_archive_link( $alify_pt );
		if ( $alify_archive ) {
			wp_safe_redirect( $alify_archive, 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'alify_redirect_no_single_cpt', 0 );
