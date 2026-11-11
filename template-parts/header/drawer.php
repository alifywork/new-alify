<?php
/**
 * Right side slide drawer — 6-dots icon aur mobile hamburger dono isi ko kholte hain.
 *
 * Contents: saare pages ka menu, About Alify, CTAs, social icons.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_drawer = alify_header_settings();
?>
<div id="alify-drawer" class="alify-drawer" data-alify-drawer aria-hidden="true">
	<div class="alify-drawer__overlay" data-alify-drawer-close tabindex="-1" aria-hidden="true"></div>

	<aside class="alify-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="alify-drawer-title">

		<div class="alify-drawer__head">
			<h2 id="alify-drawer-title" class="screen-reader-text"><?php esc_html_e( 'Menu', 'alify' ); ?></h2>
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

			<?php /* ---------- Menu (saare pages) ---------- */ ?>
			<nav class="alify-drawer__nav" aria-label="<?php esc_attr_e( 'Drawer menu', 'alify' ); ?>">
				<?php
				alify_render_nav(
					array(
						'theme_location' => alify_drawer_menu_location(),
						'menu_class'     => 'alify-drawer__list',
					)
				);
				?>
			</nav>

			<?php /* ---------- About Alify ---------- */ ?>
			<?php if ( ! empty( $alify_drawer['show_about'] ) ) : ?>
				<div class="alify-drawer__about">
					<p class="eyebrow"><i class="ph ph-triangle" aria-hidden="true"></i><?php echo esc_html( $alify_drawer['about_eyebrow'] ); ?></p>
					<h3 class="alify-drawer__about-title"><?php echo esc_html( $alify_drawer['about_title'] ); ?></h3>
					<p class="alify-drawer__about-text"><?php echo esc_html( $alify_drawer['about_text'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php /* ---------- CTAs ---------- */ ?>
			<?php if ( ! empty( $alify_drawer['show_cta'] ) ) : ?>
				<div class="alify-drawer__ctas">
					<?php
					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_drawer['cta_primary_text'],
								'url'   => $alify_drawer['cta_primary_url'],
								'style' => 'split',
								'class' => 'alify-drawer__cta',
							)
						),
						alify_button_allowed_html()
					);

					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_drawer['cta_secondary_text'],
								'url'   => $alify_drawer['cta_secondary_url'],
								'style' => 'outline',
								'class' => 'alify-drawer__cta',
							)
						),
						alify_button_allowed_html()
					);
					?>
				</div>
			<?php endif; ?>

			<?php /* ---------- Social icons ---------- */ ?>
			<?php
			$alify_socials  = alify_social_links();
			$alify_networks = alify_social_networks();

			if ( ! empty( $alify_drawer['show_social'] ) && ! empty( $alify_socials ) ) :
				?>
				<div class="alify-drawer__social">
					<p class="alify-drawer__social-label"><?php esc_html_e( 'Follow us', 'alify' ); ?></p>
					<ul class="alify-drawer__social-list">
						<?php
						foreach ( $alify_socials as $alify_key => $alify_url ) :
							if ( empty( $alify_url ) || ! isset( $alify_networks[ $alify_key ] ) ) {
								continue;
							}

							$alify_network = $alify_networks[ $alify_key ];
							?>
							<li>
								<a class="alify-drawer__social-link" href="<?php echo esc_url( $alify_url ); ?>" target="_blank" rel="noopener noreferrer me" aria-label="<?php echo esc_attr( $alify_network['label'] ); ?>">
									<i class="ph ph-<?php echo esc_attr( $alify_network['icon'] ); ?>" aria-hidden="true"></i>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

		</div>
	</aside>
</div>
