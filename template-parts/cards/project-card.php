<?php
/**
 * Project card (archive + term archive + [alify_projects]).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="card-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'alify-card' ); ?>
		</a>
	<?php endif; ?>

	<div class="card-body">
		<?php
		$alify_terms = get_the_term_list( get_the_ID(), 'project_category', '<div class="card-terms">', '</div>', '' );
		if ( $alify_terms && ! is_wp_error( $alify_terms ) ) {
			echo $alify_terms; // phpcs:ignore WordPress.Security.EscapeOutput -- core get_the_term_list escaped.
		}
		?>
		<h3 class="card-title">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo esc_html( get_the_title() ); ?>
			</a>
		</h3>
		<div class="card-text"><?php the_excerpt(); ?></div>
	</div>
</article>
