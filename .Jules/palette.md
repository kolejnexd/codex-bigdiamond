## 2024-05-24 - Distinguishable ARIA labels for repeated icon buttons
**Learning:** Repeated icon-only actions (like "Remove" in a cart) with generic ARIA labels ("Remove product") are ambiguous for screen reader users when traversing a list of items.
**Action:** Always append the specific item's name (e.g., `wp_strip_all_tags( $item_name )`) to the ARIA label of repeated action buttons to ensure they are fully descriptive and distinguishable.
