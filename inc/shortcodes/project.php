<?php
/**
 * Shortcode: [alify_projects] — projects listing (category se filter).
 *
 * Usage: [alify_projects category="web-design" limit="9"]
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_projects_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
			'limit'    => '9',
		),
		$atts,
		'alify_projects'
	);

	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => alify_sanitize_int( $atts['limit'] ),
		'post_status'    => 'publish',
	);

	$alify_cat = alify_sanitize_key( $atts['category'] );
	if ( $alify_cat ) {
		$args['tax_query'] = array(
			array(
				'taxonomy'         => 'project_category',
				'field'            => 'slug',
				'terms'            => $alify_cat,
				'include_children' => false,
			),
		);
	}

	$alify_query = new WP_Query( $args );

	ob_start();

	if ( $alify_query->have_posts() ) {
		echo '<div class="alify-projects-grid">';
		while ( $alify_query->have_posts() ) {
			$alify_query->the_post();
			get_template_part( 'template-parts/cards/project-card' );
		}
		echo '</div>';
		wp_reset_postdata();
	}

	return ob_get_clean();
}
add_shortcode( 'alify_projects', 'alify_projects_shortcode' );
