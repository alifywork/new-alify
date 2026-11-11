<?php
/**
 * Section: closing CTA band (har page ke end mein).
 *
 * Args: title, text, primary_text, primary_url, secondary_text, secondary_url
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

$alify_cta = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'title'          => __( 'Ready to build something that performs?', 'alify' ),
		'text'           => __( "Tell us about your goals — we'll come back with a clear plan, timeline and budget.", 'alify' ),
		'primary_text'   => __( "Let's get started", 'alify' ),
		'primary_url'    => home_url( '/start-a-project/' ),
		'secondary_text' => __( 'Schedule a Call', 'alify' ),
		'secondary_url'  => home_url( '/contact-us/' ),
	)
);
?>
<section class="cta-band">
	<div class="container">
		<div class="cta-band__inner">

			<div class="cta-band__content">
				<h2 class="cta-band__title"><?php echo esc_html( $alify_cta['title'] ); ?></h2>
				<?php if ( $alify_cta['text'] ) : ?>
					<p class="cta-band__text"><?php echo esc_html( $alify_cta['text'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="cta-band__actions">
				<?php
				echo wp_kses(
					alify_button(
						array(
							'text'  => $alify_cta['primary_text'],
							'url'   => $alify_cta['primary_url'],
							'style' => 'split',
						)
					),
					alify_button_allowed_html()
				);

				echo wp_kses(
					alify_button(
						array(
							'text'  => $alify_cta['secondary_text'],
							'url'   => $alify_cta['secondary_url'],
							'style' => 'outline',
						)
					),
					alify_button_allowed_html()
				);
				?>
			</div>
		</div>
	</div>
</section>
