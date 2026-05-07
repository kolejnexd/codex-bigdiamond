## 2024-10-24 - Improved Cart Remove Button ARIA Label
**Learning:** The WooCommerce cart template had generic "Usuń produkt" (Remove product) ARIA labels for all remove buttons. When multiple items are in the cart, screen readers couldn't distinguish which product the button would remove. Adding the specific product name makes it accessible.
**Action:** When adding or modifying interactive icon-only elements (like a remove/delete button) in a list or table, always append the specific item's name or title to the ARIA label so it's clear what the action affects.
