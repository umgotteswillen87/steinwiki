<?php
/**
 * CollectiveAccess interoperability layer.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build export payload from SteinWiki object.
 */
function steinwiki_build_collectiveaccess_payload( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post || 'museum_object' !== $post->post_type ) {
		return array();
	}

	$scientific_group = function_exists( 'get_field' ) ? (array) get_field( 'scientific_group', $post_id ) : array();

	return array(
		'idno'             => steinwiki_get_object_id( $post_id ),
		'preferred_labels' => array(
			'name' => get_the_title( $post_id ),
		),
		'descriptions'     => array(
			'public' => wp_strip_all_tags( $post->post_content ),
		),
		'attributes'       => array(
			'country'          => function_exists( 'get_field' ) ? (string) get_field( 'country', $post_id ) : '',
			'locality'         => function_exists( 'get_field' ) ? (string) get_field( 'rough_locality', $post_id ) : '',
			'rarity'           => function_exists( 'get_field' ) ? (string) get_field( 'rarity', $post_id ) : '',
			'scientific_name'  => (string) ( $scientific_group['scientific_name'] ?? '' ),
			'chemical_formula' => (string) ( $scientific_group['chemical_formula'] ?? '' ),
			'mohs_hardness'    => (string) ( $scientific_group['mohs_hardness'] ?? '' ),
		),
		'links'            => array(
			'wordpress' => get_permalink( $post_id ),
			'pawtucket' => (string) get_option( 'steinwiki_collectiveaccess_pawtucket_url', '' ),
		),
	);
}

function steinwiki_collectiveaccess_enabled() {
	$acf_value = function_exists( 'get_field' ) ? get_field( 'collectiveaccess_enabled', 'option' ) : null;
	if ( null !== $acf_value ) {
		return (bool) $acf_value;
	}

	return (bool) get_option( 'steinwiki_collectiveaccess_enabled', false );
}

function steinwiki_collectiveaccess_permission_callback( WP_REST_Request $request ) {
	$token = '';
	if ( function_exists( 'get_field' ) ) {
		$token = (string) get_field( 'collectiveaccess_api_token', 'option' );
	}
	if ( empty( $token ) ) {
		$token = (string) get_option( 'steinwiki_collectiveaccess_api_token', '' );
	}
	$sent  = (string) $request->get_header( 'x-steinwiki-ca-token' );

	if ( ! steinwiki_collectiveaccess_enabled() ) {
		return new WP_Error( 'ca_disabled', __( 'CollectiveAccess bridge is disabled.', 'steinwiki-museum' ), array( 'status' => 403 ) );
	}

	if ( empty( $token ) || ! hash_equals( $token, $sent ) ) {
		return new WP_Error( 'ca_forbidden', __( 'Invalid CollectiveAccess token.', 'steinwiki-museum' ), array( 'status' => 403 ) );
	}

	return true;
}

function steinwiki_register_collectiveaccess_routes() {
	register_rest_route(
		'steinwiki/v1',
		'/ca/export/object/(?P<id>\\d+)',
		array(
			'methods'             => 'GET',
			'callback'            => 'steinwiki_collectiveaccess_export_object',
			'permission_callback' => 'steinwiki_collectiveaccess_permission_callback',
		)
	);

	register_rest_route(
		'steinwiki/v1',
		'/ca/config',
		array(
			'methods'             => 'GET',
			'callback'            => 'steinwiki_collectiveaccess_config',
			'permission_callback' => 'steinwiki_collectiveaccess_permission_callback',
		)
	);
}
add_action( 'rest_api_init', 'steinwiki_register_collectiveaccess_routes' );

function steinwiki_collectiveaccess_export_object( WP_REST_Request $request ) {
	$post_id = (int) $request->get_param( 'id' );
	$payload = steinwiki_build_collectiveaccess_payload( $post_id );

	if ( empty( $payload ) ) {
		return new WP_Error( 'not_found', __( 'Museum object not found.', 'steinwiki-museum' ), array( 'status' => 404 ) );
	}

	return rest_ensure_response( $payload );
}

function steinwiki_collectiveaccess_config() {
	return rest_ensure_response(
		array(
			'enabled'        => steinwiki_collectiveaccess_enabled(),
			'providence_url' => function_exists( 'get_field' ) ? (string) get_field( 'collectiveaccess_providence_url', 'option' ) : (string) get_option( 'steinwiki_collectiveaccess_providence_url', '' ),
			'pawtucket_url'  => function_exists( 'get_field' ) ? (string) get_field( 'collectiveaccess_pawtucket_url', 'option' ) : (string) get_option( 'steinwiki_collectiveaccess_pawtucket_url', '' ),
		)
	);
}
