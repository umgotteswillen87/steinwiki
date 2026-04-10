<?php
/**
 * QR architecture service.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_get_object_id( $post_id ) {
	return get_post_meta( $post_id, '_steinwiki_object_id', true );
}

/**
 * Resolve QR URL for a museum object.
 *
 * Filter `steinwiki_qr_provider_url` to switch provider or local endpoint.
 */
function steinwiki_get_qr_url( $post_id ) {
	$object_url = get_permalink( $post_id );
	if ( empty( $object_url ) ) {
		return '';
	}

	$provider = apply_filters( 'steinwiki_qr_provider_url', 'https://api.qrserver.com/v1/create-qr-code/' );

	return add_query_arg(
		array(
			'size' => '400x400',
			'data' => $object_url,
		),
		$provider
	);
}

function steinwiki_generate_label_payload( $post_id ) {
	$payload = array(
		'object_id'    => steinwiki_get_object_id( $post_id ),
		'title'        => get_the_title( $post_id ),
		'object_url'   => get_permalink( $post_id ),
		'qr_image_url' => steinwiki_get_qr_url( $post_id ),
		'label_type'   => 'main_display',
	);

	return apply_filters( 'steinwiki_label_payload', $payload, $post_id );
}
