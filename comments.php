<?php
/**
 * Comments template.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$alify_comment_count = (int) get_comments_number();
			printf(
				/* translators: %s: comment count */
				esc_html( _n( '%s Comment', '%s Comments', $alify_comment_count, 'alify' ) ),
				esc_html( number_format_i18n( $alify_comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( '&larr; Older comments', 'alify' ),
				'next_text' => esc_html__( 'Newer comments &rarr;', 'alify' ),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'alify' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php comment_form(); ?>

</div>
