## 2026-07-03 - Appending product names to repeated ARIA labels
**Learning:** Generic ARIA labels on repeated icon buttons (like "Remove item") cause screen readers to announce the same action repeatedly without context.
**Action:** Always append the specific item's name (stripped of HTML tags using `wp_strip_all_tags`) to the ARIA label to make each button distinguishable and accessible.
