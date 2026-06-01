## 2024-06-01 - Distinguishable ARIA labels for repeated list actions
**Learning:** Icon-only remove buttons in lists (like WooCommerce carts) are announced identically by screen readers (e.g., "Remove product, button") for every item, making it impossible for visually impaired users to know which specific item they are removing.
**Action:** Always append the specific item's name (stripped of HTML tags and properly escaped) to the ARIA label of repeated action buttons in lists to ensure they are uniquely distinguishable.
