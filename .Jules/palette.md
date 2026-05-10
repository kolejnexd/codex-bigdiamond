## 2026-05-10 - Contextual ARIA labels for repeated icon buttons
**Learning:** For repeated icon-only buttons (like WooCommerce cart remove buttons), generic labels like "Remove product" are insufficient for screen readers because users cannot distinguish which item the button corresponds to. Appending the specific item's name dynamically ensures clear and accessible navigation.
**Action:** Always append the specific item's name (using functions like wp_strip_all_tags to strip HTML tags) to the ARIA label of repeated icon buttons within loops or lists.
