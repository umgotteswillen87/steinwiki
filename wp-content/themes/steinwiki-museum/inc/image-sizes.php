<?php
/**
 * Image sizes and helpers.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_register_image_sizes() {
	add_image_size( 'steinwiki-hero', 1800, 1200, true );
	add_image_size( 'steinwiki-card', 800, 600, true );
	add_image_size( 'steinwiki-gallery', 1400, 1400, false );
}
add_action( 'after_setup_theme', 'steinwiki_register_image_sizes' );
