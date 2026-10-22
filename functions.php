<?php
/**
 * Fabrement theme setup.
 *
 * @package Fabrement_Theme
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function (): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'responsive-embeds' );
	}
);

// Head tags nobody needs. Front end only: the editor keeps its emoji support. Block, global and
// classic-theme styles stay — Fabrement blocks, templates and local fonts depend on them.
add_action(
	'init',
	static function (): void {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
	}
);

/**
 * The welcome page shows while the front page lists the latest posts (a fresh site);
 * it goes once a page is set as the homepage.
 */
function fabrement_theme_is_welcome(): bool {
	return is_front_page() && is_home();
}

add_action(
	'wp_enqueue_scripts',
	static function (): void {
		if ( ! fabrement_theme_is_welcome() ) {
			return;
		}
		wp_enqueue_style(
			'fabrement-theme-welcome',
			get_theme_file_uri( 'assets/css/welcome.css' ),
			array(),
			(string) wp_get_theme()->get( 'Version' )
		);
	}
);

add_filter(
	'body_class',
	static function ( array $classes ): array {
		if ( fabrement_theme_is_welcome() ) {
			$classes[] = 'fabrement-welcome';
		}
		return $classes;
	}
);
