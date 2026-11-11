<?php
/**
 * Brand / logo — light, dark aur sticky (scroll) variants.
 *
 * get_template_part se args:
 *   $args['class']   extra class
 *   $args['variant'] 'default' (teeno, header) | 'dark' | 'light' (sirf ek)
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

$alify_logos  = alify_logo_urls();
$alify_class  = trim( 'alify-brand ' . $alify_brand_args['class'] );
$alify_name   = get_bloginfo( 'name' );
$alify_variant = sanitize_key( $alify_brand_args['variant'] );
?>
<div class="<?php echo esc_attr( $alify_class ); ?>">
	<a class="alify-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( $alify_name . ' — ' . __( 'Home', 'alify' ) ); ?>">

		<?php if ( in_array( $alify_variant, array( 'dark', 'light' ), true ) ) : ?>

			<img class="alify-brand__img alify-brand__img--<?php echo esc_attr( $alify_variant ); ?> is-active" src="<?php echo esc_url( $alify_logos[ $alify_variant ] ); ?>" alt="<?php echo esc_attr( $alify_name ); ?>" width="469" height="125" loading="eager" decoding="async">

		<?php else : ?>

			<img class="alify-brand__img alify-brand__img--light" src="<?php echo esc_url( $alify_logos['light'] ); ?>" alt="<?php echo esc_attr( $alify_name ); ?>" width="469" height="125" loading="eager" decoding="async">
			<img class="alify-brand__img alify-brand__img--dark" src="<?php echo esc_url( $alify_logos['dark'] ); ?>" alt="" width="469" height="125" loading="eager" decoding="async" aria-hidden="true">
			<img class="alify-brand__img alify-brand__img--sticky" src="<?php echo esc_url( $alify_logos['sticky'] ); ?>" alt="" width="469" height="125" loading="eager" decoding="async" aria-hidden="true">

		<?php endif; ?>

	</a>
</div>
