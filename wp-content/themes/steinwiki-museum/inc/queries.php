<?php
/**
 * Query helpers.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Archive defaults for large collections.
 */
function steinwiki_archive_query_defaults( WP_Query $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'museum_object' ) || $query->is_tax( array( 'object_type', 'object_classification', 'object_region' ) ) ) {
		$query->set( 'posts_per_page', 24 );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	}
}
add_action( 'pre_get_posts', 'steinwiki_archive_query_defaults' );

/**
 * Select taxonomy and terms for automatic similarity.
 */
function steinwiki_get_similarity_terms( $post_id ) {
	$classification_terms = wp_get_post_terms( $post_id, 'object_classification', array( 'fields' => 'ids' ) );
	if ( ! empty( $classification_terms ) ) {
		return array(
			'taxonomy' => 'object_classification',
			'terms'    => $classification_terms,
		);
	}

	$region_terms = wp_get_post_terms( $post_id, 'object_region', array( 'fields' => 'ids' ) );
	if ( ! empty( $region_terms ) ) {
		return array(
			'taxonomy' => 'object_region',
			'terms'    => $region_terms,
		);
	}

	return array();
}

function steinwiki_get_similar_objects( $post_id, $limit = 6 ) {
	$similarity = steinwiki_get_similarity_terms( $post_id );
	if ( empty( $similarity ) ) {
		return array();
	}

	return get_posts(
		array(
			'post_type'           => 'museum_object',
			'post_status'         => 'publish',
			'post__not_in'        => array( $post_id ),
			'posts_per_page'      => $limit,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'tax_query'           => array(
				array(
					'taxonomy' => $similarity['taxonomy'],
					'field'    => 'term_id',
					'terms'    => $similarity['terms'],
				),
			),
		)
	);
}
