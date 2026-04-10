<?php
/**
 * Similar discoveries section.
 *
 * @package SteinWikiMuseum
 */

$manual_ids = function_exists( 'get_field' ) ? (array) get_field( 'related_objects' ) : array();
$items      = array();

if ( ! empty( $manual_ids ) ) {
	$items = get_posts(
		array(
			'post_type'           => 'museum_object',
			'post__in'            => array_map( 'intval', $manual_ids ),
			'posts_per_page'      => 6,
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => true,
		)
	);
}

if ( empty( $items ) ) {
	$items = steinwiki_get_similar_objects( get_the_ID(), 6 );
}

if ( empty( $items ) ) {
	return;
}
?>
<section class="museum-panel museum-panel--similar">
	<h2><?php esc_html_e( 'Similar Discoveries', 'steinwiki-museum' ); ?></h2>
	<div class="object-grid">
		<?php foreach ( $items as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<?php get_template_part( 'templates/parts/object', 'card' ); ?>
		<?php endforeach; wp_reset_postdata(); ?>
	</div>
</section>
