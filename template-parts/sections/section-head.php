<?php
/**
 * Section: heading block (eyebrow + title + text).
 *
 * Args: eyebrow, title, text, center (bool)
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_head = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'eyebrow' => '',
		'title'   => '',
		'text'    => '',
		'center'  => false,
	)
);

$alify_class = 'section-head' . ( $alify_head['center'] ? ' section-head--center' : '' );
?>
<div class="<?php echo esc_attr( $alify_class ); ?>">
	<?php if ( $alify_head['eyebrow'] ) : ?>
		<p class="eyebrow"><i class="ph ph-triangle" aria-hidden="true"></i><?php echo esc_html( $alify_head['eyebrow'] ); ?></p>
	<?php endif; ?>

	<?php if ( $alify_head['title'] ) : ?>
		<h2 class="section-head__title"><?php echo esc_html( $alify_head['title'] ); ?></h2>
	<?php endif; ?>

	<?php if ( $alify_head['text'] ) : ?>
		<p class="section-head__text"><?php echo esc_html( $alify_head['text'] ); ?></p>
	<?php endif; ?>
</div>
