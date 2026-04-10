<?php
/**
 * Compatibility helpers.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_body_class( $classes ) {
	$classes[] = 'theme-steinwiki-museum';
	return $classes;
}
add_filter( 'body_class', 'steinwiki_body_class' );
