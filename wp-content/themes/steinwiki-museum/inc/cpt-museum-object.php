<?php
/**
 * Register museum_object post type.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_register_museum_object_cpt() {
	$labels = array(
		'name'               => __( 'Museum Objects', 'steinwiki-museum' ),
		'singular_name'      => __( 'Museum Object', 'steinwiki-museum' ),
		'add_new_item'       => __( 'Add New Museum Object', 'steinwiki-museum' ),
		'edit_item'          => __( 'Edit Museum Object', 'steinwiki-museum' ),
		'new_item'           => __( 'New Museum Object', 'steinwiki-museum' ),
		'view_item'          => __( 'View Museum Object', 'steinwiki-museum' ),
		'search_items'       => __( 'Search Museum Objects', 'steinwiki-museum' ),
		'not_found'          => __( 'No museum objects found', 'steinwiki-museum' ),
		'not_found_in_trash' => __( 'No museum objects found in trash', 'steinwiki-museum' ),
	);

	register_post_type(
		'museum_object',
		array(
			'labels'             => $labels,
			'public'             => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-art',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
			'has_archive'        => true,
			'rewrite'            => array( 'slug' => 'collection' ),
			'menu_position'      => 21,
			'publicly_queryable' => true,
		)
	);
}
add_action( 'init', 'steinwiki_register_museum_object_cpt' );

function steinwiki_assign_object_id( $post_id, $post, $update ) {
	if ( 'museum_object' !== $post->post_type || wp_is_post_revision( $post_id ) ) {
		return;
	}

	$existing = get_post_meta( $post_id, '_steinwiki_object_id', true );
	if ( ! empty( $existing ) ) {
		return;
	}

	$object_id = sprintf( 'SW-%06d', (int) $post_id );
	update_post_meta( $post_id, '_steinwiki_object_id', $object_id );
}
add_action( 'save_post', 'steinwiki_assign_object_id', 10, 3 );
