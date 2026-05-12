## 2024-05-14 - Add dynamic ARIA labels to repeated remove buttons in WooCommerce cart
**Learning:** Using a static ARIA label like "Usuń produkt" for a list of products makes it impossible for screen reader users to distinguish between the remove buttons. Repeated icon buttons need distinct labels.
**Action:** Always append the specific item's name (stripped of HTML tags using `wp_strip_all_tags`) to the ARIA label of repeated icon buttons to ensure they are accessible.
