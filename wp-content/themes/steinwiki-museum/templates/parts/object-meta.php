<?php
/**
 * Object metadata.
 *
 * @package SteinWikiMuseum
 */

$scientific_group = function_exists( 'get_field' ) ? (array) get_field( 'scientific_group' ) : array();
$country          = function_exists( 'get_field' ) ? get_field( 'country' ) : '';
$locality         = function_exists( 'get_field' ) ? get_field( 'rough_locality' ) : '';
$rarity           = function_exists( 'get_field' ) ? get_field( 'rarity' ) : '';
$historical       = function_exists( 'get_field' ) ? get_field( 'historical_notes' ) : '';
$gallery          = function_exists( 'get_field' ) ? (array) get_field( 'object_gallery' ) : array();
$label_payload    = steinwiki_generate_label_payload( get_the_ID() );
?>
<div class="object-meta">
	<h2><?php esc_html_e( 'Scientific and Curatorial Data', 'steinwiki-museum' ); ?></h2>
	<ul>
		<li><strong><?php esc_html_e( 'Scientific Name:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) ( $scientific_group['scientific_name'] ?? '' ) ); ?></li>
		<li><strong><?php esc_html_e( 'Formula / Composition:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) ( $scientific_group['chemical_formula'] ?? '' ) ); ?></li>
		<li><strong><?php esc_html_e( 'Mohs Hardness:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) ( $scientific_group['mohs_hardness'] ?? '' ) ); ?></li>
		<li><strong><?php esc_html_e( 'Country:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) $country ); ?></li>
		<li><strong><?php esc_html_e( 'Locality:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) $locality ); ?></li>
		<li><strong><?php esc_html_e( 'Rarity:', 'steinwiki-museum' ); ?></strong> <?php echo esc_html( (string) $rarity ); ?></li>
	</ul>

	<?php if ( ! empty( $historical ) ) : ?>
		<div class="object-historical-notes">
			<h3><?php esc_html_e( 'Historical Notes', 'steinwiki-museum' ); ?></h3>
			<?php echo wp_kses_post( $historical ); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $gallery ) ) : ?>
		<div class="object-gallery">
			<h3><?php esc_html_e( 'Gallery', 'steinwiki-museum' ); ?></h3>
			<div class="object-gallery__grid">
				<?php foreach ( $gallery as $image ) : ?>
					<?php echo wp_get_attachment_image( (int) $image['ID'], 'steinwiki-gallery' ); ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $label_payload['qr_image_url'] ) ) : ?>
		<div class="object-qr">
			<h3><?php esc_html_e( 'Museum Label QR', 'steinwiki-museum' ); ?></h3>
			<img src="<?php echo esc_url( $label_payload['qr_image_url'] ); ?>" alt="<?php esc_attr_e( 'QR code to object page', 'steinwiki-museum' ); ?>" loading="lazy" width="160" height="160" />
		</div>
	<?php endif; ?>
</div>
