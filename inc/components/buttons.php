<?php
/**
 * Button components — ek hi jagah se puri website ke buttons.
 *
 * 4 designs (CSS: assets/css/components.css):
 *   fill       — teal pill + white text          (More Insights)
 *   outline    — white pill + border             (Schedule a Call)
 *   arrow-link — text + arrow circle             (Careers)
 *   split      — pill + alag arrow circle        (Let's get started)
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Allowed button styles.
 *
 * @return string[]
 */
function alify_button_styles() {
	return apply_filters( 'alify_button_styles', array( 'fill', 'outline', 'arrow-link', 'split' ) );
}

/**
 * Allowed Phosphor icon names (whitelist — user input se mask class safe rahay).
 *
 * @return string[]
 */
function alify_button_icons() {
	return apply_filters( 'alify_button_icons', array( 'arrow-up-right', 'arrow-right', 'arrow-up-left', 'arrow-down-right', 'caret-right', 'plus' ) );
}

/**
 * Icon markup (Phosphor regular).
 *
 * @param string $icon Icon name (bina `ph-` ke).
 * @return string Escaped HTML ya khali string.
 */
function alify_button_icon( $icon ) {
	$icon = sanitize_key( $icon );
	$icon = str_replace( '_', '-', $icon );

	if ( ! in_array( $icon, alify_button_icons(), true ) ) {
		return '';
	}

	return '<i class="ph ph-' . esc_attr( $icon ) . '" aria-hidden="true"></i>';
}

/**
 * URL ko safe protocols tak mehdood karta hai (defense in depth).
 * javascript:, data:, vbscript: waghera reject.
 *
 * @param string $url Raw URL.
 * @return string Escaped safe URL ya khali string.
 */
function alify_safe_url( $url ) {
	$url = trim( (string) $url );

	if ( '' === $url ) {
		return '';
	}

	/* Relative (site ke andar) URL — safe. */
	if ( in_array( $url[0], array( '/', '#', '?' ), true ) ) {
		return esc_url( $url );
	}

	$scheme = strtolower( (string) wp_parse_url( $url, PHP_URL_SCHEME ) );

	if ( ! in_array( $scheme, array( 'http', 'https', 'mailto', 'tel' ), true ) ) {
		return '';
	}

	return esc_url( $url );
}

/**
 * Render a button.
 *
 * @param array $args {
 *     @type string $text       Button label (required).
 *     @type string $url        Link URL.
 *     @type string $style      fill | outline | arrow-link | split.
 *     @type string $icon       Phosphor icon name (default arrow-up-right).
 *     @type bool   $new_tab    Open in new tab.
 *     @type string $size       '' | sm | lg.
 *     @type string $class      Extra CSS classes.
 *     @type string $aria_label Accessible label (jab text short ho).
 *     @type bool   $disabled   Disabled state.
 * }
 * @return string Escaped HTML.
 */
function alify_button( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'text'       => '',
			'url'        => '',
			'style'      => 'fill',
			'icon'       => '',
			'new_tab'    => false,
			'size'       => '',
			'class'      => '',
			'aria_label' => '',
			'disabled'   => false,
		)
	);

	$text = trim( (string) $args['text'] );

	if ( '' === $text ) {
		return '';
	}

	$style = sanitize_key( $args['style'] );
	$style = str_replace( '_', '-', $style );

	if ( ! in_array( $style, alify_button_styles(), true ) ) {
		$style = 'fill';
	}

	$size = sanitize_key( $args['size'] );

	if ( ! in_array( $size, array( 'sm', 'lg' ), true ) ) {
		$size = '';
	}

	/* ---------- Classes ---------- */
	if ( in_array( $style, array( 'fill', 'outline' ), true ) ) {
		$classes = array( 'alify-btn', 'btn', 'btn-' . $style );

		if ( '' !== $size ) {
			$classes[] = 'btn-' . $size;
		}
	} else {
		$classes = array( 'alify-btn', 'btn-' . $style );
	}

	if ( ! empty( $args['class'] ) ) {
		foreach ( explode( ' ', (string) $args['class'] ) as $extra_class ) {
			$extra_class = sanitize_html_class( $extra_class );

			if ( '' !== $extra_class ) {
				$classes[] = $extra_class;
			}
		}
	}

	$class_attr = esc_attr( implode( ' ', array_unique( $classes ) ) );

	/* ---------- Link attributes ---------- */
	$url      = alify_safe_url( $args['url'] );
	$tag      = ( '' !== $url && empty( $args['disabled'] ) ) ? 'a' : 'span';
	$text_out = esc_html( $text );
	$icon_out = alify_button_icon( $args['icon'] );

	$attr = ' class="' . $class_attr . '"';

	if ( 'a' === $tag ) {
		$attr .= ' href="' . $url . '"';

		if ( ! empty( $args['new_tab'] ) ) {
			$attr .= ' target="_blank" rel="noopener noreferrer"';
		}
	} else {
		$attr .= ' aria-disabled="true"';

		if ( ! empty( $args['disabled'] ) ) {
			$attr .= ' aria-hidden="false"';
		} else {
			$attr .= ' role="button" tabindex="0"';
		}
	}

	if ( ! empty( $args['aria_label'] ) ) {
		$attr .= ' aria-label="' . esc_attr( $args['aria_label'] ) . '"';
	}

	/* ---------- Markup per style ---------- */
	switch ( $style ) {
		case 'arrow-link':
			if ( '' === $icon_out ) {
				$icon_out = '<i class="ph ph-arrow-up-right" aria-hidden="true"></i>';
			}

			$html = '<' . $tag . $attr . '>'
				. '<span class="alify-btn__label">' . $text_out . '</span>'
				. '<span class="btn-circle btn-circle-accent" aria-hidden="true">' . $icon_out . '</span>'
				. '</' . $tag . '>';
			break;

		case 'split':
			if ( '' === $icon_out ) {
				$icon_out = '<i class="ph ph-arrow-up-right" aria-hidden="true"></i>';
			}

			$pill_class = 'btn btn-fill' . ( '' !== $size ? ' btn-' . $size : '' );

			/* Do icons: hover par pehla upar ja kar ghayab, dusra neeche se
			   pehle wali jagah aa jata hai (btn-circle__icons). */
			$html = '<' . $tag . $attr . '>'
				. '<span class="' . esc_attr( $pill_class ) . '">' . $text_out . '</span>'
				. '<span class="btn-circle" aria-hidden="true">'
				. '<span class="btn-circle__icons">' . $icon_out . $icon_out . '</span>'
				. '</span>'
				. '</' . $tag . '>';
			break;

		case 'outline':
		case 'fill':
		default:
			$html = '<' . $tag . $attr . '>'
				. $text_out
				. ( '' !== $icon_out ? '<span class="alify-btn__icon">' . $icon_out . '</span>' : '' )
				. '</' . $tag . '>';
			break;
	}

	return $html;
}

/**
 * Echo helper.
 *
 * @param array $args Same as alify_button().
 * @return void
 */
function alify_the_button( $args = array() ) {
	echo wp_kses( alify_button( $args ), alify_button_allowed_html() );
}

/**
 * KSES allowlist — button markup ke liye safe tags/attributes.
 *
 * @return array
 */
function alify_button_allowed_html() {
	$span = array(
		'class'       => true,
		'aria-hidden' => true,
	);

	return array(
		'a'    => array(
			'class'       => true,
			'href'        => true,
			'target'      => true,
			'rel'         => true,
			'aria-label'  => true,
			'aria-hidden' => true,
		),
		'span' => $span,
		'i'    => $span,
	);
}

/**
 * Shortcode: [alify_button text="Schedule a Call" url="/contact/" style="outline"]
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function alify_button_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'text'       => '',
			'url'        => '',
			'style'      => 'fill',
			'icon'       => '',
			'size'       => '',
			'class'      => '',
			'new_tab'    => 'no',
			'aria_label' => '',
		),
		$atts,
		'alify_button'
	);

	return alify_button(
		array(
			'text'       => $atts['text'],
			'url'        => $atts['url'],
			'style'      => $atts['style'],
			'icon'       => $atts['icon'],
			'size'       => $atts['size'],
			'class'      => $atts['class'],
			'new_tab'    => in_array( strtolower( (string) $atts['new_tab'] ), array( 'yes', 'true', '1' ), true ),
			'aria_label' => $atts['aria_label'],
		)
	);
}
add_shortcode( 'alify_button', 'alify_button_shortcode' );
