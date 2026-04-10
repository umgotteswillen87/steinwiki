# QR Workflow

1. Curator creates `museum_object`.
2. On first save, object receives `SW-######` ID.
3. QR service payload resolves canonical object URL.
4. Main display label template renders title + object ID + QR image.
5. Future extension adds box and drawer label types through payload `label_type`.
