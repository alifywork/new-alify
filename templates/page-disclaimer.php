<?php
/**
 * Template Name: Disclaimer
 * Page: Disclaimer — legal content page.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'template-parts/sections/page-hero',
	null,
	array(
		'eyebrow' => __( 'Legal', 'alify' ),
		'title'   => __( 'Disclaimer', 'alify' ),
		'text'    => __( 'Important information about the content on this site.', 'alify' ),
		'light'   => true,
	)
);
?>

<main id="primary" class="site-main">

	<section class="alify-section">
		<div class="container">
			<div class="alify-legal">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<span class="alify-legal__updated">
						<?php
						printf(
							/* translators: %s: last modified date */
							esc_html__( 'Last updated: %s', 'alify' ),
							esc_html( get_the_modified_date() )
						);
						?>
					</span>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php
				endwhile;
				?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
