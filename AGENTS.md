# AGENTS.md — SteinWiki Repository Rules

Scope: Entire repository.

## Project intent
SteinWiki is a premium digital natural-history museum and private archive, built on self-hosted WordPress using a custom theme and structured museum object data.

## Core stack rules
- Use a **custom WordPress theme** (`wp-content/themes/steinwiki-museum`).
- Primary content type is `museum_object` (CPT).
- Use ACF (local PHP registration + `acf-json` sync folder).
- Keep code modular under `inc/` and reusable template parts under `templates/parts/`.

## Design rules
- Prioritize dark museum ambience and cinematic object presentation.
- No generic blog-like layouts for object pages.
- Mobile-first, iPhone-optimized spacing and typography.

## Data/architecture rules
- Preserve stable object IDs (`SW-######` format).
- Taxonomy-driven relations should be preferred for scale.
- Large collections (2000+) require performant queries:
  - avoid unbounded `posts_per_page = -1` on front-end archives
  - use selective fields and pagination

## Extensibility rules
- Maintain extension points for:
  - QR logistics (main, box, drawer labels)
  - 360° media viewers
  - Raspberry Pi mirror + ESP32 endpoints
- Hardware-facing API routes must live under a dedicated REST namespace.

## Coding standards
- Follow WordPress PHP coding standards where practical.
- Escape output (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`).
- Sanitize input in save/update hooks.
- Keep functions namespaced with `steinwiki_` prefix.

## Documentation rules
- Update `docs/milestones.md` whenever roadmap phases change.
- Document non-trivial architecture in `docs/` before major implementation.

