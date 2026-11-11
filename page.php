<?php
/**
 * Static page template.
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
				<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'alify-hero' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alify' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
		<?php
	endwhile;
	?>

</main>

<?php
get_footer();
