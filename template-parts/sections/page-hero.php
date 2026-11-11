<?php
/**
 * Section: page hero (page templates ke top par).
 *
 * Args:
 *   eyebrow (string)  — badge text
 *   title   (string)  — h1; khali ho to page title
 *   text    (string)  — intro paragraph
 *   flush   (bool)    — transparent header ke saath (front page), zyada top padding
 *   light   (bool)    — light hero
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_hero = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'eyebrow' => '',
		'title'   => '',
		'text'    => '',
		'flush'   => false,
		'light'   => false,
	)
);

$alify_classes = 'page-hero';

if ( $alify_hero['flush'] ) {
	$alify_classes .= ' page-hero--flush';
}

if ( $alify_hero['light'] ) {
	$alify_classes .= ' page-hero--light';
}

$alify_title = $alify_hero['title'] ? $alify_hero['title'] : get_the_title();
?>
<section class="<?php echo esc_attr( $alify_classes ); ?>">
	<div class="container">
		<div class="page-hero__inner">

			<?php if ( $alify_hero['eyebrow'] ) : ?>
				<p class="eyebrow <?php echo $alify_hero['light'] ? '' : 'eyebrow-light'; ?>">
					<i class="ph ph-triangle" aria-hidden="true"></i><?php echo esc_html( $alify_hero['eyebrow'] ); ?>
				</p>
			<?php endif; ?>

			<h1 class="page-hero__title"><?php echo esc_html( $alify_title ); ?></h1>

			<?php if ( $alify_hero['text'] ) : ?>
				<p class="page-hero__text"><?php echo esc_html( $alify_hero['text'] ); ?></p>
			<?php endif; ?>

			<div class="page-hero__ctas">
				<?php
				echo wp_kses(
					alify_button(
						array(
							'text'  => __( "Let's get started", 'alify' ),
							'url'   => home_url( '/start-a-project/' ),
							'style' => 'split',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>
		</div>
	</div>
</section>
