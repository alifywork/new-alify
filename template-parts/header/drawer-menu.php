<?php
/**
 * Drawer: MENU (hamburger se khulta hai — mobile/tablet panel).
 *
 * Content: saare pages ka menu (submenus ke saath), contact details, CTA.
 * About drawer (6-dots) se bilkul alag content hai.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_menu_settings = alify_header_settings();
?>
<div id="alify-drawer-menu" class="alify-drawer alify-drawer--menu" data-alify-drawer="menu" aria-hidden="true">
	<div class="alify-drawer__overlay" data-alify-drawer-close tabindex="-1" aria-hidden="true"></div>

	<aside class="alify-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="alify-drawer-menu-title">

		<div class="alify-drawer__head">
			<h2 id="alify-drawer-menu-title" class="screen-reader-text"><?php esc_html_e( 'Menu', 'alify' ); ?></h2>

			<?php
			get_template_part(
				'template-parts/header/brand',
				null,
				array(
					'class'   => 'alify-brand--drawer',
					'variant' => 'dark',
				)
			);
			?>

			<button type="button" class="alify-drawer__close" data-alify-drawer-close aria-label="<?php esc_attr_e( 'Close menu', 'alify' ); ?>">
				<i class="ph ph-x" aria-hidden="true"></i>
			</button>
		</div>

		<div class="alify-drawer__body">

			<?php /* ---------- Saare pages ka menu ---------- */ ?>
			<nav class="alify-drawer__nav" aria-label="<?php esc_attr_e( 'Main menu', 'alify' ); ?>">
				<?php
				alify_render_nav(
					array(
						'theme_location' => alify_drawer_menu_location(),
						'menu_class'     => 'alify-drawer__list',
					)
				);
				?>
			</nav>

			<?php /* ---------- Contact ---------- */ ?>
			<div class="alify-drawer__contact">
				<p class="alify-drawer__social-label"><?php esc_html_e( 'Get in touch', 'alify' ); ?></p>
				<ul class="alify-drawer__contact-list">
					<?php if ( ! empty( $alify_menu_settings['contact_email'] ) ) : ?>
						<li>
							<i class="ph ph-envelope-simple" aria-hidden="true"></i>
							<a href="mailto:<?php echo esc_attr( antispambot( $alify_menu_settings['contact_email'] ) ); ?>"><?php echo esc_html( antispambot( $alify_menu_settings['contact_email'] ) ); ?></a>
						</li>
					<?php endif; ?>

					<?php if ( ! empty( $alify_menu_settings['contact_phone'] ) ) : ?>
						<li>
							<i class="ph ph-phone" aria-hidden="true"></i>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $alify_menu_settings['contact_phone'] ) ); ?>"><?php echo esc_html( $alify_menu_settings['contact_phone'] ); ?></a>
						</li>
					<?php endif; ?>
				</ul>

				<?php
				echo wp_kses(
					alify_button(
						array(
							'text'  => __( 'Start a project', 'alify' ),
							'url'   => home_url( '/start-a-project/' ),
							'style' => 'split',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>

		</div>
	</aside>
</div>
