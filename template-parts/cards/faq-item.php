<?php
/**
 * FAQ accordion item (single nahi — archive/shortcode).
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;
?>

<details class="faq-item" id="faq-<?php echo esc_attr( get_the_ID() ); ?>">
	<summary class="faq-question"><?php echo esc_html( get_the_title() ); ?></summary>
	<div class="faq-answer"><?php the_content(); ?></div>
</details>
