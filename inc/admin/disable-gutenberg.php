<?php
/**
 * Gutenberg (block editor) disable — poora classic editor.
 *
 * Kya kya band hota hai:
 *   1. Post/page/CPT edit screens par block editor (classic editor chalta hai)
 *   2. Widgets ka block editor (purana widgets screen wapas)
 *   3. Frontend par block CSS (wp-block-library, global-styles, classic-theme-styles)
 *   4. Block patterns (local + remote), block directory suggestions
 *   5. Editor ke andar "Blocks" tab / inserter
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Block editor band karo — sab post types ke liye (page, post, saare CPT).
 *
 * @param bool   $use_block_editor Block editor use karein?
 * @param string $post_type        Post type.
 * @return bool
 */
function alify_disable_block_editor( $use_block_editor, $post_type ) {
	$excluded = apply_filters( 'alify_block_editor_post_types', array() );

	if ( is_array( $excluded ) && in_array( $post_type, $excluded, true ) ) {
		return $use_block_editor;
	}

	return false;
}
add_filter( 'use_block_editor_for_post_type', 'alify_disable_block_editor', 10, 2 );
add_filter( 'use_block_editor_for_post', 'alify_disable_block_editor', 10, 2 );

/**
 * Widgets ka block editor band karo (classic widgets screen wapas).
 *
 * @return bool
 */
function alify_disable_widgets_block_editor() {
	return false;
}
add_filter( 'use_widgets_block_editor', 'alify_disable_widgets_block_editor' );

/**
 * Block patterns (core + remote) band.
 *
 * @return bool
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * Block directory / inserter suggestions band.
 *
 * @return void
 */
function alify_remove_block_directory() {
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
}
add_action( 'init', 'alify_remove_block_directory' );

/**
 * Frontend se block CSS hatao (hum blocks use nahi karte).
 *
 * @return void
 */
function alify_dequeue_block_assets() {
	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library' );

	wp_dequeue_style( 'wp-block-library-theme' );
	wp_deregister_style( 'wp-block-library-theme' );

	wp_dequeue_style( 'global-styles' );
	wp_deregister_style( 'global-styles' );

	wp_dequeue_style( 'classic-theme-styles' );
	wp_deregister_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'alify_dequeue_block_assets', 100 );

/**
 * Separate core block assets load na hon.
 *
 * @return bool
 */
add_filter( 'should_load_separate_core_block_assets', '__return_false' );

/**
 * Block editor ke liye enqueue honay wale assets hatao (agar koi CPT
 * ke block editor ko filter se allow karay).
 *
 * @return void
 */
function alify_remove_block_editor_assets() {
	wp_dequeue_style( 'wp-block-editor' );
	wp_dequeue_style( 'wp-edit-blocks' );
	wp_dequeue_script( 'wp-edit-post' );
}
add_action( 'admin_enqueue_scripts', 'alify_remove_block_editor_assets', 100 );
