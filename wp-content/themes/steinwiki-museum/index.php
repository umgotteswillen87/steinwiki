<?php
/**
 * Fallback index template.
 *
 * @package SteinWikiMuseum
 */

get_header();
?>
<main class="museum-shell museum-shell--default">
	<section class="museum-panel">
		<h1><?php esc_html_e( 'SteinWiki Museum', 'steinwiki-museum' ); ?></h1>
		<p><?php esc_html_e( 'Use the museum object archive to browse the collection.', 'steinwiki-museum' ); ?></p>
	</section>
</main>
<?php
get_footer();
