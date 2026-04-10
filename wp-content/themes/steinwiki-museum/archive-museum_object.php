<?php
/**
 * Museum object archive.
 *
 * @package SteinWikiMuseum
 */

get_header();
?>
<main class="museum-shell museum-shell--archive">
	<section class="museum-panel">
		<h1><?php post_type_archive_title(); ?></h1>
		<div class="object-grid">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'templates/parts/object', 'card' ); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<p><?php esc_html_e( 'No objects found yet.', 'steinwiki-museum' ); ?></p>
			<?php endif; ?>
		</div>
		<?php the_posts_pagination(); ?>
	</section>
</main>
<?php
get_footer();
