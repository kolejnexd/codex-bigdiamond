
## 2024-05-24 - WP_Query Optimization for Recently Viewed Products
**Learning:** WordPress `WP_Query` calculates pagination row counts (`SQL_CALC_FOUND_ROWS`) by default, even when `posts_per_page` limits the result set and pagination isn't needed.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` calls unless pagination is explicitly required to save unnecessary database calculations.
