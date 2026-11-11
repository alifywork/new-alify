<?php
/**
 * Template Name: Contact Us
 * Page: Contact Us — contact details + content.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Contact', 'alify' ),
		'title'   => __( "Let's talk about your project", 'alify' ),
		'text'    => __( 'Tell us what you are building — we usually reply within one business day.', 'alify' ),
	)
);
?>

<main id="primary" class="site-main">

	<section class="alify-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<div class="entry-content">
						<?php
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
						?>
					</div>
				</div>

				<div class="col-lg-5">
					<div class="alify-contact-details">
						<?php
						get_template_part(
							'template-parts/sections/section-head',
							null,
							array(
								'eyebrow' => __( 'Contact details', 'alify' ),
								'title'   => __( 'Reach us directly', 'alify' ),
							)
						);
						?>
						<ul class="alify-contact-list">
							<li><i class="ph ph-envelope-simple" aria-hidden="true"></i><a href="mailto:hello@alify.com">hello@alify.com</a></li>
							<li><i class="ph ph-phone" aria-hidden="true"></i><a href="tel:+10000000000">+1 (000) 000-0000</a></li>
							<li><i class="ph ph-map-pin" aria-hidden="true"></i><span><?php esc_html_e( 'Remote-first studio', 'alify' ); ?></span></li>
						</ul>
						<?php
						echo wp_kses(
							alify_button(
								array(
									'text'  => __( 'Start a project', 'alify' ),
									'url'   => home_url( '/start-a-project/' ),
									'style' => 'split',
								)
							),
							alify_button_allowed_html()
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
