## 2026-06-28 - WP_Query Performance Pattern
**Learning:** Custom WooCommerce queries that use `WP_Query` without pagination default to running expensive `SQL_CALC_FOUND_ROWS` queries and checking sticky posts, which impacts database performance on product pages.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments for custom blocks where pagination is disabled.
