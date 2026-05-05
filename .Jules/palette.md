## 2024-05-24 - Dynamic ARIA labels for list item actions
**Learning:** Hardcoded ARIA labels on repeated icon buttons (like "Remove" in a cart) cause poor accessibility as screen readers announce identical labels for all items.
**Action:** Always append the item's name (stripped of HTML tags) to the ARIA label of repeated icon buttons to ensure they are distinguishable.
