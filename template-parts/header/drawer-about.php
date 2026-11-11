<?php
/**
 * Drawer: ABOUT (6-dots icon se khulta hai — desktop panel).
 *
 * Content: About Alify (eyebrow + title + text + focus chips), CTAs, social icons.
 * Menu drawer (hamburger) se bilkul alag content hai.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_about = alify_header_settings();
?>
<div id="alify-drawer-about" class="alify-drawer alify-drawer--about" data-alify-drawer="about" aria-hidden="true">
	<div class="alify-drawer__overlay" data-alify-drawer-close tabindex="-1" aria-hidden="true"></div>

	<aside class="alify-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="alify-drawer-about-title">

		<div class="alify-drawer__head">
			<h2 id="alify-drawer-about-title" class="screen-reader-text"><?php esc_html_e( 'About Alify', 'alify' ); ?></h2>

			<?php
			get_template_part(
				'template-parts/header/brand',
				null,
				array(
					'class'   => 'alify-brand--drawer',
					'variant' => 'light',
				)
			);
			?>

			<button type="button" class="alify-drawer__close" data-alify-drawer-close aria-label="<?php esc_attr_e( 'Close panel', 'alify' ); ?>">
				<i class="ph ph-x" aria-hidden="true"></i>
			</button>
		</div>

		<div class="alify-drawer__body">

			<?php /* ---------- About ---------- */ ?>
			<div class="alify-drawer__about">
				<p class="eyebrow"><i class="ph ph-triangle" aria-hidden="true"></i><?php echo esc_html( $alify_about['about_eyebrow'] ); ?></p>
				<h3 class="alify-drawer__about-title"><?php echo esc_html( $alify_about['about_title'] ); ?></h3>
				<p class="alify-drawer__about-text"><?php echo esc_html( $alify_about['about_text'] ); ?></p>
			</div>

			<?php /* ---------- Focus areas ---------- */ ?>
			<?php $alify_focus = alify_about_focus_areas(); ?>
			<?php if ( ! empty( $alify_focus ) ) : ?>
				<ul class="alify-drawer__chips">
					<?php foreach ( $alify_focus as $alify_focus_item ) : ?>
						<li class="alify-drawer__chip"><?php echo esc_html( $alify_focus_item ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php /* ---------- CTAs ---------- */ ?>
			<?php if ( ! empty( $alify_about['show_cta'] ) ) : ?>
				<div class="alify-drawer__ctas">
					<?php
					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_about['cta_primary_text'],
								'url'   => $alify_about['cta_primary_url'],
								'style' => 'split',
							)
						),
						alify_button_allowed_html()
					);

					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_about['cta_secondary_text'],
								'url'   => $alify_about['cta_secondary_url'],
								'style' => 'outline',
							)
						),
						alify_button_allowed_html()
					);
					?>
				</div>
			<?php endif; ?>

			<?php /* ---------- Social ---------- */ ?>
			<?php
			$alify_socials  = alify_social_links();
			$alify_networks = alify_social_networks();

			if ( ! empty( $alify_about['show_social'] ) && ! empty( $alify_socials ) ) :
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
