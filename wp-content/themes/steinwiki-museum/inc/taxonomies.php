<?php
/**
 * Register taxonomies for museum objects.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_register_object_taxonomies() {
	register_taxonomy(
		'object_type',
		'museum_object',
		array(
			'label'        => __( 'Object Types', 'steinwiki-museum' ),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'type' ),
		)
	);

	register_taxonomy(
		'object_classification',
		'museum_object',
		array(
			'label'        => __( 'Classifications', 'steinwiki-museum' ),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'classification' ),
		)
	);

	register_taxonomy(
		'object_region',
		'museum_object',
		array(
			'label'        => __( 'Regions', 'steinwiki-museum' ),
			'public'       => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'region' ),
		)
	);
}
add_action( 'init', 'steinwiki_register_object_taxonomies' );
