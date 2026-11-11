<?php
/**
 * Blog index — "Blogs" page (page_for_posts).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Insights', 'alify' ),
		'title'   => __( 'Blogs and insights', 'alify' ),
		'text'    => __( 'Notes on strategy, design, development and growth from the Alify team.', 'alify' ),
	)
);
?>

<main id="primary" class="site-main">

	<section class="alify-section">
		<div class="container">

			<?php if ( have_posts() ) : ?>

				<div class="alify-post-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'alify-post-card' ); ?>>

							<?php if ( has_post_thumbnail() ) : ?>
								<a class="alify-post-card__thumb" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'alify-card' ); ?>
								</a>
							<?php endif; ?>

							<div class="alify-post-card__body">
								<p class="alify-post-card__meta">
									<?php echo esc_html( get_the_date() ); ?>
								</p>

								<h2 class="alify-post-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>

								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					?>
				</div>

				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => esc_html__( '&larr; Previous', 'alify' ),
						'next_text' => esc_html__( 'Next &rarr;', 'alify' ),
					)
				);
				?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
