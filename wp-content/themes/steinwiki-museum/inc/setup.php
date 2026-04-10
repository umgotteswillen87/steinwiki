<?php
/**
 * Theme setup and assets.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'steinwiki_theme_setup' );

function steinwiki_enqueue_assets() {
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style(
		'steinwiki-museum',
		get_theme_file_uri( 'assets/css/museum.css' ),
		array(),
		$version
	);

	wp_enqueue_script(
		'steinwiki-museum',
		get_theme_file_uri( 'assets/js/museum.js' ),
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'steinwiki_enqueue_assets' );
