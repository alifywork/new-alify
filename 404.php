<?php
/**
 * 404 error template.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Page not found', 'alify' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php esc_html_e( 'The page you are looking for does not exist. Try a search instead?', 'alify' ); ?></p>
			<?php get_search_form(); ?>
			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Back to home', 'alify' ); ?>
				</a>
			</p>
		</div>
	</section>

</main>

<?php
get_footer();
