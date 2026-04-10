<?php
/**
 * Header template.
 *
 * @package SteinWikiMuseum
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'steinwiki-body' ); ?>>
<?php wp_body_open(); ?>
<header class="museum-header">
	<div class="museum-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="museum-logo"><?php bloginfo( 'name' ); ?></a>
	</div>
</header>
