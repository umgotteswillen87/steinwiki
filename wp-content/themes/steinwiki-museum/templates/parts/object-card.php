<?php
/**
 * Object card.
 *
 * @package SteinWikiMuseum
 */

$object_id = steinwiki_get_object_id( get_the_ID() );
?>
<article class="object-card">
	<a href="<?php the_permalink(); ?>" class="object-card__link">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'steinwiki-card' ); ?>
		<?php endif; ?>
		<h3><?php the_title(); ?></h3>
		<?php if ( $object_id ) : ?>
			<p class="object-card__id"><?php echo esc_html( $object_id ); ?></p>
		<?php endif; ?>
	</a>
</article>
