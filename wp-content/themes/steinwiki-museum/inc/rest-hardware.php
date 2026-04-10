<?php
/**
 * Hardware extension REST endpoints.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Validate token passed by hardware client.
 */
function steinwiki_hardware_permission_callback( WP_REST_Request $request ) {
	$stored_token = (string) get_option( 'steinwiki_hardware_token', '' );
	$sent_token   = (string) $request->get_header( 'x-steinwiki-token' );

	if ( empty( $stored_token ) ) {
		return new WP_Error( 'hardware_not_configured', __( 'Hardware token not configured.', 'steinwiki-museum' ), array( 'status' => 500 ) );
	}

	if ( hash_equals( $stored_token, $sent_token ) ) {
		return true;
	}

	return new WP_Error( 'forbidden', __( 'Invalid hardware token.', 'steinwiki-museum' ), array( 'status' => 403 ) );
}

function steinwiki_register_hardware_routes() {
	register_rest_route(
		'steinwiki/v1',
		'/hardware/status',
		array(
			'methods'             => 'GET',
			'callback'            => 'steinwiki_hardware_status',
			'permission_callback' => 'steinwiki_hardware_permission_callback',
		)
	);

	register_rest_route(
		'steinwiki/v1',
		'/labels/reprint/(?P<id>\\d+)',
		array(
			'methods'             => 'POST',
			'callback'            => 'steinwiki_hardware_label_reprint',
			'permission_callback' => 'steinwiki_hardware_permission_callback',
		)
	);
}
add_action( 'rest_api_init', 'steinwiki_register_hardware_routes' );

function steinwiki_hardware_status() {
	return rest_ensure_response(
		array(
			'ok'          => true,
			'service'     => 'steinwiki-hardware',
			'generatedAt' => gmdate( 'c' ),
		)
	);
}

function steinwiki_hardware_label_reprint( WP_REST_Request $request ) {
	$post_id = (int) $request->get_param( 'id' );
	if ( 'museum_object' !== get_post_type( $post_id ) ) {
		return new WP_Error( 'invalid_object', __( 'Object not found', 'steinwiki-museum' ), array( 'status' => 404 ) );
	}

	return rest_ensure_response(
		array(
			'ok'      => true,
			'message' => __( 'Reprint request queued.', 'steinwiki-museum' ),
			'payload' => steinwiki_generate_label_payload( $post_id ),
		)
	);
}
