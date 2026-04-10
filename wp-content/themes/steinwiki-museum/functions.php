<?php
/**
 * SteinWiki Museum theme bootstrap.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steinwiki_includes = array(
	'inc/setup.php',
	'inc/cpt-museum-object.php',
	'inc/taxonomies.php',
	'inc/acf-fields.php',
	'inc/queries.php',
	'inc/image-sizes.php',
	'inc/qr-service.php',
	'inc/rest-hardware.php',
	'inc/collectiveaccess-bridge.php',
	'inc/admin-settings.php',
	'inc/compatibility.php',
);

foreach ( $steinwiki_includes as $steinwiki_file ) {
	require_once get_theme_file_path( $steinwiki_file );
}
