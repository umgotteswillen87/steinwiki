# SteinWiki Implementation Plan

## 1) Architecture Decision (Finalized Before Implementation)

### Platform baseline
- **CMS/Core:** Self-hosted WordPress (latest stable)
- **Theme:** `steinwiki-museum` custom theme (no page builder dependency)
- **Data layer:**
  - Custom Post Type: `museum_object`
  - Taxonomies:
    - `object_type` (mineral, crystal, fossil, meteorite, shard, artifact, soil_find, fragment)
    - `object_classification` (scientific/classification tree)
    - `object_region` (regional grouping for discovery context)
  - Advanced Custom Fields (ACF Pro) local JSON + PHP registration
- **Asset strategy:** responsive image sizes + WebP/AVIF aware rendering
- **Future modules:** QR labels, 360° viewer, hardware endpoints (Pi/ESP32)

### Non-functional goals
- Mobile-first and iPhone-first rendering
- Scales to 2,000+ objects with performant archive queries
- Modular theme architecture (`inc/` split by domain)
- Museum-grade visual language (dark ambiance, glass, spotlight)

## 2) Repository File Tree (Finalized)

```txt
.
├── AGENTS.md
├── PLANS.md
├── README.md
└── wp-content/
    └── themes/
        └── steinwiki-museum/
            ├── style.css
            ├── functions.php
            ├── index.php
            ├── archive-museum_object.php
            ├── single-museum_object.php
            ├── taxonomy-object_type.php
            ├── assets/
            │   ├── css/
            │   │   └── museum.css
            │   ├── js/
            │   │   ├── museum.js
            │   │   └── object-viewer.js
            │   └── img/
            │       └── category-default.jpg
            ├── templates/
            │   ├── parts/
            │   │   ├── object-card.php
            │   │   ├── object-hero.php
            │   │   ├── object-meta.php
            │   │   └── similar-discoveries.php
            │   └── qr/
            │       └── label-template.php
            ├── inc/
            │   ├── setup.php
            │   ├── cpt-museum-object.php
            │   ├── taxonomies.php
            │   ├── acf-fields.php
            │   ├── queries.php
            │   ├── image-sizes.php
            │   ├── qr-service.php
            │   ├── rest-hardware.php
            │   └── compatibility.php
            ├── acf-json/
            │   └── (placeholder for synced field JSON)
            └── docs/
                ├── milestones.md
                ├── qr-workflow.md
                ├── media-strategy.md
                └── hardware-expansion.md
```

## 3) Milestones

### Milestone A — MVP Foundation
- Theme scaffold, setup, assets pipeline
- `museum_object` CPT + taxonomies
- ACF field groups for scientific and curatorial metadata
- Object single template and archive template
- Admin UX for object editing

### Milestone B — Museum Enhancement
- Cinematic visual system (spotlights, reflections, vitrines)
- Category background handling and presets
- Similar discoveries and storytelling sections
- Related objects logic by classification/region

### Milestone C — Media / 360° Readiness
- Multi-image gallery patterns
- 360° viewer placeholder architecture (`object-viewer.js`)
- Zoom integration points
- Photogrammetry field placeholders

### Milestone D — QR Logistics
- Object ID autogeneration
- QR generation service + label template
- Print-ready main label workflow
- Extension hooks for box/drawer labels

### Milestone E — Hardware Expansion
- REST endpoint namespace for local devices
- Pi mirror sync integration points
- Synology backup strategy documentation
- ESP32 actions: label reprint + OLED status model

### Milestone F — CollectiveAccess Interop
- Optional Providence bridge for cataloging depth
- Optional Pawtucket2 publication coupling
- REST export mapping between `museum_object` and CA object payloads

## 4) Data Model (MVP)

### Required core fields per object
- Object ID (auto)
- Title
- Type (`object_type` taxonomy)
- Multiple categories / classifications (`object_classification` taxonomy)
- Scientific name/data (ACF group)
- Region/country/locality
- Description
- Historical notes
- Rarity
- Gallery images
- Related objects (manual override + automatic)

## 5) Implementation Sequence
1. Create policy docs (`AGENTS.md`, this plan).
2. Scaffold theme and core bootstrap.
3. Register CPT and taxonomies.
4. Register ACF local fields and prepare JSON sync folder.
5. Build single/archive/taxonomy museum templates.
6. Add QR service architecture.
7. Add media + 360° extension points.
8. Add hardware REST skeleton and documentation.
9. Add optional CollectiveAccess interoperability layer.
10. Validate PHP syntax and repo structure.

