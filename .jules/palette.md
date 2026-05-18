## 2024-05-18 - Contextualize Cart Remove Button ARIA Label
**Learning:** Generic aria-labels on repeated icon-only buttons (like "Usuń produkt" on cart items) make it difficult for screen reader users to know *which* item will be affected.
**Action:** Always append the specific item's name (e.g., `wp_strip_all_tags( $name )`) to the ARIA label of repeated action buttons to ensure contextual clarity.
