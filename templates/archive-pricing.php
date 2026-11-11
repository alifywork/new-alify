<?php
/**
 * Archive: Pricing — sirf archive + pricing_category term archives (single NAHI).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<header class="page-header">
		<?php if ( is_tax() ) : ?>
			<?php $alify_term = get_queried_object(); ?>
			<h1 class="page-title"><?php echo esc_html( $alify_term->name ); ?></h1>
			<?php if ( ! empty( $alify_term->description ) ) : ?>
				<div class="archive-description"><?php echo wp_kses_post( $alify_term->description ); ?></div>
			<?php endif; ?>
		<?php else : ?>
			<?php
			$alify_pto   = get_post_type_object( 'pricing' );
			$alify_title = $alify_pto ? $alify_pto->labels->name : esc_html__( 'Pricing', 'alify' );
			?>
			<h1 class="page-title"><?php echo esc_html( $alify_title ); ?></h1>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="alify-pricing-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/pricing-card' );
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

</main>

<?php
get_footer();
