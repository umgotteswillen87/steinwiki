# Hardware Expansion Architecture

## Raspberry Pi mirror
- Poll `/wp-json/steinwiki/v1/hardware/status` with `X-SteinWiki-Token` header.
- Cache selected collection pages for local offline kiosk mode.

## Synology backup
- Scheduled media + database snapshots.
- Optional immutable backup retention for archival integrity.

## ESP32 desk terminal
- Trigger label reprint via `/wp-json/steinwiki/v1/labels/reprint/{id}`.
- Send `X-SteinWiki-Token` per request.
- Receive condensed payload for OLED status display.

## Setup
1. Save a secret token in WordPress option `steinwiki_hardware_token`.
2. Configure ESP32/Pi to send that token header.
3. Rotate token periodically for security hardening.
