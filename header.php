<?php
/**
 * Site header.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'alify' ); ?></a>

<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
				</p>
				<?php $alify_desc = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $alify_desc ) : ?>
					<p class="site-description"><?php echo esc_html( $alify_desc ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'alify' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>
	</div>
</header>

<div id="content" class="site-content">
