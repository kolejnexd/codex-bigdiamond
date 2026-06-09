## 2024-05-24 - Optimize WP_Query for Recent Products
**Learning:** In WordPress custom database queries (like `WP_Query`), if pagination is not required, expensive SQL_CALC_FOUND_ROWS calculations and sticky post checks are still performed by default.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments for non-paginated lists to improve backend performance and reduce database load.
