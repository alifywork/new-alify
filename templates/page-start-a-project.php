<?php
/**
 * Template Name: Start a Project
 * Page: Start a Project / Let's Talk.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( "Let's talk", 'alify' ),
		'title'   => __( 'Start a project with Alify', 'alify' ),
		'text'    => __( 'Share your goals, scope and timeline. We will respond with a plan and a fixed estimate.', 'alify' ),
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

	<?php
	get_template_part(
		'template-parts/sections/cta-band',
		null,
		array(
			'title'          => __( 'Prefer a quick call?', 'alify' ),
			'text'           => __( 'Book a 20 minute intro call and we will scope it together.', 'alify' ),
			'primary_text'   => __( 'Schedule a Call', 'alify' ),
			'primary_url'    => home_url( '/contact-us/' ),
			'secondary_text' => __( 'See our work', 'alify' ),
			'secondary_url'  => alify_cpt_archive_url( 'project' ),
		)
	);
	?>

</main>

<?php
get_footer();
