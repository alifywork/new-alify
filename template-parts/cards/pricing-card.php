<?php
/**
 * Pricing plan card (single nahi — sirf archive/shortcode).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pricing-card' ); ?>>
	<div class="card-body">
		<?php
		$alify_terms = get_the_term_list( get_the_ID(), 'pricing_category', '<div class="card-terms">', '</div>', '' );
		if ( $alify_terms && ! is_wp_error( $alify_terms ) ) {
			echo $alify_terms; // phpcs:ignore WordPress.Security.EscapeOutput -- core get_the_term_list escaped.
		}
		?>
		<h3 class="card-title"><?php echo esc_html( get_the_title() ); ?></h3>
		<div class="card-text"><?php the_content(); ?></div>
	</div>
</article>
