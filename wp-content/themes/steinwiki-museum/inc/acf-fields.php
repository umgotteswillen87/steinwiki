<?php
/**
 * ACF field registration.
 *
 * @package SteinWikiMuseum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function steinwiki_acf_json_save_point( $path ) {
	return get_theme_file_path( 'acf-json' );
}
add_filter( 'acf/settings/save_json', 'steinwiki_acf_json_save_point' );

function steinwiki_register_acf_options_pages() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'SteinWiki Museum Settings', 'steinwiki-museum' ),
			'menu_title' => __( 'Museum Settings', 'steinwiki-museum' ),
			'menu_slug'  => 'steinwiki-museum-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'steinwiki_register_acf_options_pages' );

function steinwiki_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_steinwiki_object_metadata',
			'title'  => 'SteinWiki Object Metadata',
			'fields' => array(
				array(
					'key'        => 'field_steinwiki_scientific_group',
					'label'      => 'Scientific Data',
					'name'       => 'scientific_group',
					'type'       => 'group',
					'sub_fields' => array(
						array(
							'key'   => 'field_steinwiki_scientific_name',
							'label' => 'Scientific Name',
							'name'  => 'scientific_name',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_steinwiki_chemical_formula',
							'label' => 'Chemical Formula / Composition',
							'name'  => 'chemical_formula',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_steinwiki_mohs',
							'label' => 'Mohs Hardness',
							'name'  => 'mohs_hardness',
							'type'  => 'text',
						),
					),
				),
				array(
					'key'   => 'field_steinwiki_country',
					'label' => 'Country',
					'name'  => 'country',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_steinwiki_locality',
					'label' => 'Rough Locality',
					'name'  => 'rough_locality',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_steinwiki_historical_notes',
					'label' => 'Historical Notes',
					'name'  => 'historical_notes',
					'type'  => 'wysiwyg',
				),
				array(
					'key'          => 'field_steinwiki_rarity',
					'label'        => 'Rarity',
					'name'         => 'rarity',
					'type'         => 'select',
					'choices'      => array(
						'common'      => 'Common',
						'uncommon'    => 'Uncommon',
						'rare'        => 'Rare',
						'exceptional' => 'Exceptional',
					),
					'return_format' => 'value',
				),
				array(
					'key'          => 'field_steinwiki_gallery',
					'label'        => 'Object Gallery',
					'name'         => 'object_gallery',
					'type'         => 'gallery',
					'preview_size' => 'medium',
				),
				array(
					'key'        => 'field_steinwiki_related_objects',
					'label'      => 'Related Objects',
					'name'       => 'related_objects',
					'type'       => 'relationship',
					'post_type'  => array( 'museum_object' ),
					'filters'    => array( 'search', 'taxonomy' ),
					'return_format' => 'id',
				),
				array(
					'key'   => 'field_steinwiki_360_spin_set',
					'label' => '360° Spin Set (future)',
					'name'  => 'spin_set',
					'type'  => 'gallery',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'museum_object',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_steinwiki_type_display',
			'title'  => 'Object Type Display',
			'fields' => array(
				array(
					'key'           => 'field_steinwiki_type_bg',
					'label'         => 'Category Background Image',
					'name'          => 'category_background_image',
					'type'          => 'image',
					'return_format' => 'id',
				),
				array(
					'key'     => 'field_steinwiki_vitrine_preset',
					'label'   => 'Vitrine Preset',
					'name'    => 'vitrine_preset',
					'type'    => 'select',
					'choices' => array(
						'amber'   => 'Amber Spotlight',
						'obsidian'=> 'Obsidian Shadow',
						'ivory'   => 'Ivory Hall',
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'taxonomy',
						'operator' => '==',
						'value'    => 'object_type',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_steinwiki_museum_settings',
			'title'  => 'Museum Global Presets',
			'fields' => array(
				array(
					'key'           => 'field_steinwiki_default_category_bg',
					'label'         => 'Default Category Background',
					'name'          => 'default_category_background',
					'type'          => 'image',
					'return_format' => 'id',
				),
				array(
					'key'           => 'field_steinwiki_default_vitrine_preset',
					'label'         => 'Default Vitrine Preset',
					'name'          => 'default_vitrine_preset',
					'type'          => 'text',
					'default_value' => 'amber',
				),
				array(
					'key'           => 'field_steinwiki_ca_enabled',
					'label'         => 'Enable CollectiveAccess Bridge',
					'name'          => 'collectiveaccess_enabled',
					'type'          => 'true_false',
					'default_value' => 0,
				),
				array(
					'key'   => 'field_steinwiki_ca_providence_url',
					'label' => 'Providence URL',
					'name'  => 'collectiveaccess_providence_url',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_steinwiki_ca_pawtucket_url',
					'label' => 'Pawtucket2 URL',
					'name'  => 'collectiveaccess_pawtucket_url',
					'type'  => 'url',
				),

				array(
					'key'   => 'field_steinwiki_ca_api_token',
					'label' => 'CollectiveAccess API Token',
					'name'  => 'collectiveaccess_api_token',
					'type'  => 'text',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'steinwiki-museum-settings',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'steinwiki_register_acf_fields' );
