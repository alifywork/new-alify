<?php
/**
 * Loop helpers — page templates ke liye (CPT cards, archive links).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * CPT ke posts ka query.
 *
 * @param string $post_type Post type.
 * @param int    $limit     Kitne posts.
 * @param array  $extra     Extra WP_Query args.
 * @return WP_Query
 */
function alify_cpt_query( $post_type, $limit = 6, $extra = array() ) {
	$args = wp_parse_args(
		$extra,
		array(
			'post_type'           => sanitize_key( $post_type ),
			'posts_per_page'      => absint( $limit ),
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);

	return new WP_Query( $args );
}

/**
 * CPT cards grid render karo.
 *
 * @param string $post_type Post type.
 * @param string $card      template-parts card file (e.g. 'service-card').
 * @param int    $limit     Posts.
 * @param string $grid_class Extra grid class.
 * @return void
 */
function alify_render_cpt_cards( $post_type, $card, $limit = 6, $grid_class = '' ) {
	$alify_query = alify_cpt_query( $post_type, $limit );

	if ( ! $alify_query->have_posts() ) {
		return;
	}

	$alify_grid = trim( 'alify-grid ' . $grid_class );

	echo '<div class="' . esc_attr( $alify_grid ) . '">';

	while ( $alify_query->have_posts() ) {
		$alify_query->the_post();
		get_template_part( 'template-parts/cards/' . sanitize_file_name( $card ) );
	}

	echo '</div>';

	wp_reset_postdata();
}

/**
 * CPT archive ka link (SEO: listing pages CPT archives par rehti hain).
 *
 * @param string $post_type Post type.
 * @return string
 */
function alify_cpt_archive_url( $post_type ) {
	$alify_url = get_post_type_archive_link( sanitize_key( $post_type ) );

	return $alify_url ? $alify_url : home_url( '/' );
}
