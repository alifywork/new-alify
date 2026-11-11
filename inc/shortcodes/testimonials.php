<?php
/**
 * Shortcode: [alify_testimonials] — testimonials listing.
 *
 * Usage: [alify_testimonials category="enterprise" limit="6"]
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_testimonials_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
			'limit'    => '6',
		),
		$atts,
		'alify_testimonials'
	);

	$args = array(
		'post_type'      => 'testimonials',
		'posts_per_page' => alify_sanitize_int( $atts['limit'] ),
		'post_status'    => 'publish',
	);

	$alify_cat = alify_sanitize_key( $atts['category'] );
	if ( $alify_cat ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'         => 'testimonial_category',
				'field'            => 'slug',
				'terms'            => $alify_cat,
				'include_children' => false,
			),
		);
	}

	$alify_query = new WP_Query( $args );

	ob_start();

	if ( $alify_query->have_posts() ) {
		echo '<div class="alify-testimonials-grid">';
		while ( $alify_query->have_posts() ) {
			$alify_query->the_post();
			get_template_part( 'template-parts/cards/testimonial-card' );
		}
		echo '</div>';
		wp_reset_postdata();
	}

	return ob_get_clean();
}
add_shortcode( 'alify_testimonials', 'alify_testimonials_shortcode' );
