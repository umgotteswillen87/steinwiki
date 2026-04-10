# SteinWiki

**SteinWiki – sächsische Fundsammlung – Privatsammlung – Marcus Frank Heinzig – Leipzig**

SteinWiki is a premium, museum-style private collection platform for minerals, crystals, fossils, meteorites, archaeological shards, and historical artifacts.

## Implemented foundation
- WordPress custom theme scaffold: `steinwiki-museum`
- Custom Post Type: `museum_object`
- Core taxonomies for type, classification, and region
- ACF local field registration for scientific metadata, galleries, type backgrounds, and museum presets
- Single and archive museum templates with related discovery logic
- QR payload and print-label architecture
- Token-protected hardware REST endpoints for future Raspberry Pi / ESP32 integrations
- Optional CollectiveAccess interoperability layer (Providence/Pawtucket2 bridge endpoints)

## Repository entry points
- Architecture and milestones: `PLANS.md`
- Repo rules for future agents: `AGENTS.md`
- Theme: `wp-content/themes/steinwiki-museum/`
