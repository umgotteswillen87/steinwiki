<?php
/**
 * Admin settings and curation utilities.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register meta for term-level museum visuals.
 */
function steinwiki_register_term_meta() {
	register_term_meta(
		'object_type',
		'steinwiki_category_background_id',
		array(
			'type'              => 'integer',
			'description'       => 'Attachment ID for object type background image.',
			'single'            => true,
			'sanitize_callback' => 'absint',
			'show_in_rest'      => true,
		)
	);

	register_term_meta(
		'object_type',
		'steinwiki_vitrine_preset',
		array(
			'type'              => 'string',
			'description'       => 'Visual preset token for vitrinen rendering.',
			'single'            => true,
			'sanitize_callback' => 'sanitize_key',
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'steinwiki_register_term_meta' );

/**
 * Store API tokens and endpoints for hardware + CollectiveAccess integrations.
 */
function steinwiki_register_integration_settings() {
	register_setting(
		'steinwiki_integrations',
		'steinwiki_hardware_token',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		)
	);

	register_setting(
		'steinwiki_integrations',
		'steinwiki_collectiveaccess_enabled',
		array(
			'type'              => 'boolean',
			'sanitize_callback' => 'rest_sanitize_boolean',
			'default'           => false,
		)
	);

	register_setting(
		'steinwiki_integrations',
		'steinwiki_collectiveaccess_providence_url',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '',
		)
	);

	register_setting(
		'steinwiki_integrations',
		'steinwiki_collectiveaccess_pawtucket_url',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '',
		)
	);

	register_setting(
		'steinwiki_integrations',
		'steinwiki_collectiveaccess_api_token',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		)
	);
}
add_action( 'admin_init', 'steinwiki_register_integration_settings' );
