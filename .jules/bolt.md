## 2024-05-24 - Optimize Recently Viewed Products Query
**Learning:** Custom WP_Query calls for non-paginated blocks (like recently viewed products) will still execute expensive SQL_CALC_FOUND_ROWS and check for sticky posts by default, wasting database resources.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments when pagination is not required.
