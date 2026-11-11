<?php
/**
 * Template Name: Thank You
 * Page: Thank You — form submit ke baad.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Thank you', 'alify' ),
		'title'   => __( 'Your message is on its way', 'alify' ),
		'text'    => __( 'We have received your request and will reply within one business day.', 'alify' ),
	)
);
?>

<main id="primary" class="site-main">

	<section class="alify-section">
		<div class="container">
			<div class="entry-content">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>

			<div class="alify-grid" style="max-width: 40rem;">
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
							'text'  => __( 'Read our insights', 'alify' ),
							'url'   => get_permalink( get_option( 'page_for_posts' ) ),
							'style' => 'outline',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
