<?php
/**
 * Service card (archive + [alify_services]).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'service-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="card-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'alify-card' ); ?>
		</a>
	<?php endif; ?>

	<div class="card-body">
		<h3 class="card-title">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo esc_html( get_the_title() ); ?>
			</a>
		</h3>
		<div class="card-text"><?php the_excerpt(); ?></div>
	</div>
</article>
