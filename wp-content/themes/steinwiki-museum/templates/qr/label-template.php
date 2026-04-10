<?php
/**
 * QR label template (print-focused).
 *
 * @package SteinWikiMuseum
 */

if ( empty( $args['payload'] ) ) {
	return;
}
$payload = $args['payload'];
?>
<article class="qr-label qr-label--main-display">
	<h1><?php echo esc_html( $payload['title'] ?? '' ); ?></h1>
	<p><?php echo esc_html( $payload['object_id'] ?? '' ); ?></p>
	<?php if ( ! empty( $payload['qr_image_url'] ) ) : ?>
		<img src="<?php echo esc_url( $payload['qr_image_url'] ); ?>" alt="QR code" />
	<?php endif; ?>
</article>
