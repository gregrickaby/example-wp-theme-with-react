<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @since WP Theme with React 1.0
 */

/**
 * Enqueue styles and scripts.
 *
 * @author Greg Rickaby <greg@gregrickaby.com>
 * @since 1.0.0
 */
function grd_scripts() {

	// Enqueue theme style.
	wp_enqueue_style( 'grd-theme-style', get_stylesheet_directory_uri() . '/build/index.css', [], wp_get_theme()->get( 'Version' ) );

	// Enqueue theme script.
	wp_enqueue_script( 'grd-theme-script', get_stylesheet_directory_uri() . '/build/index.js', [ 'wp-element' ], wp_get_theme()->get( 'Version' ), true );
	wp_script_add_data( 'grd-theme-script', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'grd_scripts' );
