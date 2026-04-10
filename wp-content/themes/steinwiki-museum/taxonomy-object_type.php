<?php
/**
 * Object type taxonomy archive.
 *
 * @package SteinWikiMuseum
 */

get_header();
$term      = get_queried_object();
$bg_id     = function_exists( 'get_field' ) ? get_field( 'category_background_image', 'object_type_' . $term->term_id ) : 0;
$bg_fallback = function_exists( 'get_field' ) ? get_field( 'default_category_background', 'option' ) : 0;
$bg_image  = wp_get_attachment_image_url( $bg_id ?: $bg_fallback, 'steinwiki-hero' );
$style_attr = $bg_image ? ' style="background-image:url(' . esc_url( $bg_image ) . ')"' : '';
?>
<main class="museum-shell museum-shell--taxonomy">
	<section class="museum-panel museum-panel--taxonomy-hero"<?php echo $style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
		<h1><?php echo esc_html( single_term_title( '', false ) ); ?></h1>
		<?php if ( ! empty( $term->description ) ) : ?>
			<p><?php echo esc_html( $term->description ); ?></p>
		<?php endif; ?>
	</section>

	<section class="museum-panel">
		<div class="object-grid">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'templates/parts/object', 'card' ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php the_posts_pagination(); ?>
	</section>
</main>
<?php
get_footer();
