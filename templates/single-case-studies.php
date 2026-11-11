<?php
/**
 * Single: Case study.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php
				$alify_terms = get_the_term_list( get_the_ID(), 'case_study_category', '<div class="entry-terms">', '</div>', '' );
				if ( $alify_terms && ! is_wp_error( $alify_terms ) ) {
					echo $alify_terms; // phpcs:ignore WordPress.Security.EscapeOutput -- core escaped.
				}
				?>
				<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail"><?php the_post_thumbnail( 'alify-hero' ); ?></div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>

		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'alify' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'alify' ) . '</span> <span class="nav-title">%title</span>',
			)
		);
		?>
		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
