<?php
/**
 * Object hero vitrinen display.
 *
 * @package SteinWikiMuseum
 */

$object_id = steinwiki_get_object_id( get_the_ID() );
$types     = get_the_terms( get_the_ID(), 'object_type' );
$preset    = 'amber';

if ( ! empty( $types ) && ! is_wp_error( $types ) && function_exists( 'get_field' ) ) {
	$term_preset = get_field( 'vitrine_preset', 'object_type_' . $types[0]->term_id );
	if ( ! empty( $term_preset ) ) {
		$preset = sanitize_html_class( (string) $term_preset );
	}
}
?>
<section class="museum-hero museum-hero--<?php echo esc_attr( $preset ); ?>">
	<div class="museum-hero__glass"></div>
	<div class="museum-hero__spotlight"></div>
	<div class="museum-hero__content">
		<h1><?php the_title(); ?></h1>
		<?php if ( $object_id ) : ?>
			<p class="museum-hero__id"><?php echo esc_html( $object_id ); ?></p>
		<?php endif; ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="museum-hero__image"><?php the_post_thumbnail( 'steinwiki-hero' ); ?></div>
		<?php endif; ?>
	</div>
</section>
