<?php
/**
 * Brand / logo — light, dark aur sticky (scroll) variants.
 *
 * get_template_part se args:
 *   $args['class']        extra class
 *   $args['variant']      'default' (teeno) | 'dark' (sirf dark logo)
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_brand_args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'class'   => '',
		'variant' => 'default',
	)
);

$alify_logos = alify_logo_urls();
$alify_class = trim( 'alify-brand ' . $alify_brand_args['class'] );
?>
<div class="<?php echo esc_attr( $alify_class ); ?>">
	<a class="alify-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — ' . __( 'Home', 'alify' ) ); ?>">
		<?php if ( 'dark' === $alify_brand_args['variant'] ) : ?>
			<img class="alify-brand__img alify-brand__img--dark is-active" src="<?php echo esc_url( $alify_logos['dark'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="469" height="125" loading="eager" decoding="async">
		<?php else : ?>
			<img class="alify-brand__img alify-brand__img--light" src="<?php echo esc_url( $alify_logos['light'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="469" height="125" loading="eager" decoding="async">
			<img class="alify-brand__img alify-brand__img--dark" src="<?php echo esc_url( $alify_logos['dark'] ); ?>" alt="" width="469" height="125" loading="eager" decoding="async" aria-hidden="true">
			<img class="alify-brand__img alify-brand__img--sticky" src="<?php echo esc_url( $alify_logos['sticky'] ); ?>" alt="" width="469" height="125" loading="eager" decoding="async" aria-hidden="true">
		<?php endif; ?>
	</a>
</div>
