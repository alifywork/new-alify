<?php
/**
 * Generic archive template (blog dates, categories, authors, fallback).
 * CPT archives templates/ folder se load hote hain (inc/templates.php).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header>

	<?php
	if ( have_posts() ) :

		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;

		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( '&larr; Previous', 'alify' ),
				'next_text' => esc_html__( 'Next &rarr;', 'alify' ),
			)
		);

	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>

</main>

<?php
get_footer();
