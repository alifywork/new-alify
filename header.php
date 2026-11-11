<?php
/**
 * Site header — left logo, center menu, right CTAs + 6-dots drawer trigger.
 *
 * Hero ke upar overlap karta hai (front page), thin + sticky.
 * 6 dots -> About drawer | Hamburger (mobile) -> Menu drawer.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_header        = alify_header_settings();
$alify_transparent   = alify_header_is_transparent();
$alify_on_light      = alify_header_on_light();
$alify_header_classes = 'alify-header ' . ( $alify_transparent ? 'alify-header--transparent' : 'alify-header--solid' );

if ( $alify_transparent && $alify_on_light ) {
	$alify_header_classes .= ' alify-header--on-light';
}
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

<header id="masthead" class="<?php echo esc_attr( $alify_header_classes ); ?>" data-alify-header>

	<div class="alify-header__inner container">

		<?php /* ---------- LEFT: logo ---------- */ ?>
		<div class="alify-header__brand">
			<?php get_template_part( 'template-parts/header/brand' ); ?>
		</div>

		<?php /* ---------- CENTER: main menu ---------- */ ?>
		<nav class="alify-header__nav" aria-label="<?php esc_attr_e( 'Primary menu', 'alify' ); ?>">
			<?php alify_render_nav( array( 'theme_location' => 'primary' ) ); ?>
		</nav>

		<?php /* ---------- RIGHT: CTAs + drawer triggers ---------- */ ?>
		<div class="alify-header__actions">

			<?php if ( ! empty( $alify_header['show_cta'] ) ) : ?>
				<div class="alify-header__cta alify-header__cta--secondary">
					<?php
					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_header['cta_secondary_text'],
								'url'   => $alify_header['cta_secondary_url'],
								'style' => 'outline',
								'size'  => 'sm',
							)
						),
						alify_button_allowed_html()
					);
					?>
				</div>

				<div class="alify-header__cta alify-header__cta--primary">
					<?php
					echo wp_kses(
						alify_button(
							array(
								'text'  => $alify_header['cta_primary_text'],
								'url'   => $alify_header['cta_primary_url'],
								'style' => 'split',
								'size'  => 'sm',
							)
						),
						alify_button_allowed_html()
					);
					?>
				</div>
			<?php endif; ?>

			<?php /* 6 dots — ABOUT drawer (desktop) */ ?>
			<button type="button" class="alify-header__dots" data-alify-drawer-open="about" aria-expanded="false" aria-controls="alify-drawer-about" aria-label="<?php esc_attr_e( 'Open about panel', 'alify' ); ?>">
				<i class="ph ph-dots-six" aria-hidden="true"></i>
			</button>

			<?php /* Hamburger — MENU drawer (mobile/tablet) */ ?>
			<button type="button" class="alify-header__burger" data-alify-drawer-open="menu" aria-expanded="false" aria-controls="alify-drawer-menu" aria-label="<?php esc_attr_e( 'Open menu', 'alify' ); ?>">
				<i class="ph ph-list" aria-hidden="true"></i>
			</button>

		</div>
	</div>
</header>

<?php
/* Do alag drawers: about (6 dots) + menu (hamburger) */
get_template_part( 'template-parts/header/drawer-about' );
get_template_part( 'template-parts/header/drawer-menu' );
?>

<div id="content" class="site-content">
