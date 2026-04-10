<?php
/**
 * Single museum object template.
 *
 * @package SteinWikiMuseum
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<main class="museum-shell museum-shell--single">
			<?php get_template_part( 'templates/parts/object', 'hero' ); ?>
			<section class="museum-panel museum-panel--meta">
				<?php get_template_part( 'templates/parts/object', 'meta' ); ?>
			</section>
			<section class="museum-panel museum-panel--story">
				<h2><?php esc_html_e( 'Educational Storytelling', 'steinwiki-museum' ); ?></h2>
				<div class="museum-story"><?php the_content(); ?></div>
			</section>
			<?php get_template_part( 'templates/parts/similar', 'discoveries' ); ?>
		</main>
		<?php
	endwhile;
endif;

get_footer();
