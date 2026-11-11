<?php
/**
 * Generic loop content (blog + fallback).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_singular() ) : ?>
			<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<?php else : ?>
			<h2 class="entry-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php echo esc_html( get_the_title() ); ?>
				</a>
			</h2>
		<?php endif; ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'alify-card' ); ?>
		</a>
	<?php endif; ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>">
			<?php esc_html_e( 'Read more', 'alify' ); ?>
		</a>
	</footer>
</article>
