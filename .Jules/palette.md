## 2024-05-24 - Unique ARIA labels for repeated icon buttons
**Learning:** Repeated icon-only buttons (like "Remove" in a cart) with identical ARIA labels are confusing for screen reader users because they don't know which item the action applies to.
**Action:** Always append the specific item's name (stripped of HTML tags) to the ARIA label of repeated icon buttons.
