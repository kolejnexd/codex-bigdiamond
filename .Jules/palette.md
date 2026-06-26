## 2026-06-26 - ARIA labels for dynamic repeated icon buttons
**Learning:** Repeated icon-only buttons (like WooCommerce cart remove buttons) must have unique ARIA labels indicating their specific target (e.g., appending the stripped product name), otherwise screen readers will announce multiple identical generic actions (like "Remove product"), causing confusion.
**Action:** Always append the specific item's name to the ARIA label of repeated icon buttons in lists or carts, ensuring the string is properly escaped with esc_attr() and HTML tags are stripped.
