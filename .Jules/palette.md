## 2026-07-02 - Dynamic ARIA labels for list item actions
**Learning:** Repeated icon buttons (like 'Remove' in a cart) without context are indistinguishable to screen reader users when multiple exist on a page.
**Action:** Always append the specific item's name (stripped of HTML tags using `wp_strip_all_tags`) to the ARIA label of repeated icon buttons, ensuring proper escaping with `esc_attr`.
