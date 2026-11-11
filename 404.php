<?php
/**
 * 404 error template.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Error 404', 'alify' ),
		'title'   => __( 'Page not found', 'alify' ),
		'text'    => __( 'The page you are looking for may have moved or no longer exists. Try a search, or head back home.', 'alify' ),
	)
);
?>

<main id="primary" class="site-main">

	<section class="alify-section">
		<div class="container">
			<div class="alify-404">

				<div class="alify-404__search">
					<?php get_search_form(); ?>
				</div>

				<div class="alify-grid">
					<?php
					echo wp_kses(
						alify_button(
							array(
								'text'  => __( 'Back to home', 'alify' ),
								'url'   => home_url( '/' ),
								'style' => 'split',
							)
						),
						alify_button_allowed_html()
					);

					echo wp_kses(
						alify_button(
							array(
								'text'  => __( 'Browse services', 'alify' ),
								'url'   => alify_cpt_archive_url( 'services' ),
								'style' => 'outline',
							)
						),
						alify_button_allowed_html()
					);

					echo wp_kses(
						alify_button(
							array(
								'text'  => __( 'Contact us', 'alify' ),
								'url'   => home_url( '/contact-us/' ),
								'style' => 'arrow-link',
							)
						),
						alify_button_allowed_html()
					);
					?>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
