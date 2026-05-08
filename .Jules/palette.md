## 2024-05-08 - Accessible ARIA labels for repeated icon buttons
**Learning:** Repeated icon-only buttons (like remove buttons in a cart) must have unique, descriptive ARIA labels to be distinguishable for screen reader users. A generic "Remove" is insufficient.
**Action:** Always append the specific item's name (stripped of HTML tags) to the ARIA label of such buttons.
