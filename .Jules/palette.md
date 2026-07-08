## 2026-07-08 - Dynamic ARIA labels for repeated icon buttons
**Learning:** Repeated icon buttons (like "Remove product" in a cart) without context are indistinguishable to screen readers. They need dynamic context (e.g. the product name) appended to the aria-label.
**Action:** Always append the specific item's name (stripped of HTML tags) to the ARIA label of repeated icon buttons to ensure they are accessible.
