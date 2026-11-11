<?php
/**
 * Archive: Services (term archive nahi — services ki taxonomy nahi).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<header class="page-header">
		<?php
		$alify_pto = get_post_type_object( 'services' );
		$alify_title = $alify_pto ? $alify_pto->labels->name : esc_html__( 'Services', 'alify' );
		?>
		<h1 class="page-title"><?php echo esc_html( $alify_title ); ?></h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="alify-services-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/cards/service-card' );
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
