<?php
/**
 * Widget areas.
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

function alify_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'alify' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Blog aur archive ke liye sidebar.', 'alify' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array(
				/* translators: %d: footer column number */
				'name'          => sprintf( esc_html__( 'Footer Column %d', 'alify' ), $i ),
				'id'            => "footer-{$i}",
				'description'   => esc_html__( 'Footer ke widgets.', 'alify' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'alify_widgets_init' );
