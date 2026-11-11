<?php
/**
 * Shortcode: [alify_services] — services listing.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_services_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'limit' => '12',
		),
		$atts,
		'alify_services'
	);

	$alify_query = new WP_Query(
		array(
			'post_type'      => 'services',
			'posts_per_page' => alify_sanitize_int( $atts['limit'] ),
			'post_status'    => 'publish',
		)
	);

	ob_start();

	if ( $alify_query->have_posts() ) {
		echo '<div class="alify-services-grid">';
		while ( $alify_query->have_posts() ) {
			$alify_query->the_post();
			get_template_part( 'template-parts/cards/service-card' );
		}
		echo '</div>';
		wp_reset_postdata();
	}

	return ob_get_clean();
}
add_shortcode( 'alify_services', 'alify_services_shortcode' );
