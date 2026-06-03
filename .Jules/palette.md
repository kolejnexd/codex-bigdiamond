## 2026-06-03 - Contextual ARIA labels for repeated icon buttons
**Learning:** Screen reader users encounter multiple generic icon buttons (e.g., "Usuń produkt") in lists like the shopping cart. Without specific context, they cannot determine which item each button affects.
**Action:** Always append the specific item's name (stripped of HTML tags using wp_strip_all_tags and escaped using esc_attr) to the ARIA label of repeated icon buttons to ensure they are distinguishable.
