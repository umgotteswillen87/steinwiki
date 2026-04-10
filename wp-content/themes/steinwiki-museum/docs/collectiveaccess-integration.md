# CollectiveAccess Integration (Providence + Pawtucket2)

## Zielbild für SteinWiki
**SteinWiki – sächsische Fundsammlung – Privatsammlung – Marcus Frank Heinzig – Leipzig** nutzt WordPress als kuratierte Premium-Museum-Experience und ergänzt optional um CollectiveAccess für professionelle Sammlungsverwaltung und externe Präsentation.

## Rollenverteilung
- **WordPress / SteinWiki Theme:**
  - private Kurationsoberfläche
  - hochwertige museumartige Präsentation
  - QR-Workflows, Labeldruck, Hardware-Integration (Pi/ESP32)
- **CollectiveAccess Providence:**
  - tiefes Sammlungsmanagement, normierte Metadaten, komplexe Katalogpflege
- **CollectiveAccess Pawtucket2:**
  - optionales öffentliches Discovery-Frontend auf Basis Providence-Daten

## Technische Kopplung im Theme
- REST-Bridge im Theme:
  - `GET /wp-json/steinwiki/v1/ca/export/object/{id}`
  - `GET /wp-json/steinwiki/v1/ca/config`
- Header-basierte Authentifizierung:
  - `X-SteinWiki-CA-Token`
- Bridge kann über Option deaktiviert werden (`collectiveaccess_enabled`).

## Datenmapping (erste Version)
`museum_object` ➜ CA-Objekt-Payload:
- `idno` = SteinWiki Object-ID (`SW-######`)
- `preferred_labels.name` = WordPress Titel
- `descriptions.public` = Inhaltsbeschreibung
- `attributes` = country, locality, rarity, scientific_name, chemical_formula, mohs_hardness

## Betriebsmodus (empfohlen)
1. SteinWiki bleibt primäres Frontend für die private Sammlung.
2. Providence wird als optionaler zweiter Datenkatalog angebunden.
3. Pawtucket2 wird nur aktiviert, wenn eine separate öffentliche Publikation gewünscht ist.
4. Synchronisierung zunächst „export on demand“, später per Cron/Webhook ausbauen.
