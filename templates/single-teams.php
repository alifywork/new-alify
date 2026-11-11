<?php
/**
 * Single: Team member.
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
				$alify_terms = get_the_term_list( get_the_ID(), 'team_category', '<div class="entry-terms">', '</div>', '' );
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
	endwhile;
	?>
</main>

<?php
get_footer();
