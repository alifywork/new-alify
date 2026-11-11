<?php
/**
 * Shortcode: [alify_pricing] — pricing plans listing.
 *
 * Usage: [alify_pricing category="monthly"]
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_pricing_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
			'limit'    => '12',
		),
		$atts,
		'alify_pricing'
	);

	$args = array(
		'post_type'      => 'pricing',
		'posts_per_page' => alify_sanitize_int( $atts['limit'] ),
		'post_status'    => 'publish',
	);

	$alify_cat = alify_sanitize_key( $atts['category'] );
	if ( $alify_cat ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'         => 'pricing_category',
				'field'            => 'slug',
				'terms'            => $alify_cat,
				'include_children' => false,
			),
		);
	}

	$alify_query = new WP_Query( $args );

	ob_start();

	if ( $alify_query->have_posts() ) {
		echo '<div class="alify-pricing-grid">';
		while ( $alify_query->have_posts() ) {
			$alify_query->the_post();
			get_template_part( 'template-parts/cards/pricing-card' );
		}
		echo '</div>';
		wp_reset_postdata();
	}

	return ob_get_clean();
}
add_shortcode( 'alify_pricing', 'alify_pricing_shortcode' );
