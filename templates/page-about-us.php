<?php
/**
 * Template Name: About Us
 * Page: About Us — intro + content + team + CTA.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'About Alify', 'alify' ),
		'title'   => __( 'A studio built on strategy, craft and accountability', 'alify' ),
		'text'    => __( 'We are a small senior team that works directly with founders and marketing leaders.', 'alify' ),
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
		</div>
	</section>

	<section class="alify-section alify-section--alt">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/sections/section-head',
				null,
				array(
					'eyebrow' => __( 'Our team', 'alify' ),
					'title'   => __( 'The people behind the work', 'alify' ),
					'center'  => true,
				)
			);

			alify_render_cpt_cards( 'teams', 'team-card', 8 );
			?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

</main>

<?php
get_footer();
