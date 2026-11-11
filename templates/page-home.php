<?php
/**
 * Template Name: Home
 * Page: Home (front page) — hero + services + projects + testimonials + pricing + CTA.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Digital Studio', 'alify' ),
		'title'   => __( 'We build brands that move business forward', 'alify' ),
		'text'    => __( 'Strategy-led design, development and growth for companies that want measurable results — not just a pretty website.', 'alify' ),
		'flush'   => true,
	)
);
?>

<main id="primary" class="site-main">

	<?php /* ---------- Services ---------- */ ?>
	<section class="alify-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'What we do', 'alify' ),
					'title'   => __( 'Services built around outcomes', 'alify' ),
					'text'    => __( 'From positioning to production — one team, one roadmap.', 'alify' ),
				)
			);

			alify_render_cpt_cards( 'services', 'service-card', 6 );
			?>

			<div class="section-foot">
				<?php
				echo wp_kses(
					alify_button(
						array(
							'text'  => __( 'View all services', 'alify' ),
							'url'   => alify_cpt_archive_url( 'services' ),
							'style' => 'arrow-link',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>
		</div>
	</section>

	<?php /* ---------- Projects ---------- */ ?>
	<section class="alify-section alify-section--alt">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'Selected work', 'alify' ),
					'title'   => __( 'Projects we are proud of', 'alify' ),
					'text'    => __( 'A few recent builds — strategy, design and engineering in one place.', 'alify' ),
				)
			);

			alify_render_cpt_cards( 'project', 'project-card', 6 );
			?>

			<div class="section-foot">
				<?php
				echo wp_kses(
					alify_button(
						array(
							'text'  => __( 'See all projects', 'alify' ),
							'url'   => alify_cpt_archive_url( 'project' ),
							'style' => 'arrow-link',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>
		</div>
	</section>

	<?php /* ---------- Testimonials ---------- */ ?>
	<section class="alify-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'Client love', 'alify' ),
					'title'   => __( 'What our clients say', 'alify' ),
					'center'  => true,
				)
			);

			alify_render_cpt_cards( 'testimonials', 'testimonial-card', 6 );
			?>
		</div>
	</section>

	<?php /* ---------- Pricing ---------- */ ?>
	<section class="alify-section alify-section--alt">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'Pricing', 'alify' ),
					'title'   => __( 'Transparent packages', 'alify' ),
					'text'    => __( 'Clear scope, clear price, clear timeline.', 'alify' ),
					'center'  => true,
				)
			);

			alify_render_cpt_cards( 'pricing', 'pricing-card', 3 );
			?>
		</div>
	</section>

	<?php /* ---------- FAQs ---------- */ ?>
	<section class="alify-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'FAQs', 'alify' ),
					'title'   => __( 'Questions we hear a lot', 'alify' ),
				)
			);

			alify_render_cpt_cards( 'faqs', 'faq-item', 6, 'alify-grid--two' );
			?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
