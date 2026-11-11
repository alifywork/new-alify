<?php
/**
 * Shortcode: [alify_faqs] — FAQ listing (accordion).
 *
 * Usage: [alify_faqs category="general"]
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_faqs_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
			'limit'    => '50',
		),
		$atts,
		'alify_faqs'
	);

	$args = array(
		'post_type'      => 'faqs',
		'posts_per_page' => alify_sanitize_int( $atts['limit'] ),
		'post_status'    => 'publish',
	);

	$alify_cat = alify_sanitize_key( $atts['category'] );
	if ( $alify_cat ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'         => 'faq_category',
				'field'            => 'slug',
				'terms'            => $alify_cat,
				'include_children' => false,
			),
		);
	}

	$alify_query = new WP_Query( $args );

	ob_start();

	if ( $alify_query->have_posts() ) {
		echo '<div class="alify-faq-list">';
		while ( $alify_query->have_posts() ) {
			$alify_query->the_post();
			get_template_part( 'template-parts/cards/faq-item' );
		}
		echo '</div>';
		wp_reset_postdata();
	}

	return ob_get_clean();
}
add_shortcode( 'alify_faqs', 'alify_faqs_shortcode' );
