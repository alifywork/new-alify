<?php
/**
 * Testimonial card (single nahi — archive/shortcode).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'testimonial-card' ); ?>>
	<div class="card-body">
		<?php
		$alify_terms = get_the_term_list( get_the_ID(), 'testimonial_category', '<div class="card-terms">', '</div>', '' );
		if ( $alify_terms && ! is_wp_error( $alify_terms ) ) {
			echo $alify_terms; // phpcs:ignore WordPress.Security.EscapeOutput -- core get_the_term_list escaped.
		}
		?>
		<blockquote class="testimonial-quote">
			<?php the_content(); ?>
		</blockquote>
		<div class="testimonial-author">
			<?php if ( has_post_thumbnail() ) : ?>
				<span class="author-avatar"><?php the_post_thumbnail( 'thumbnail' ); ?></span>
			<?php endif; ?>
			<span class="author-name"><?php echo esc_html( get_the_title() ); ?></span>
		</div>
	</div>
</article>
