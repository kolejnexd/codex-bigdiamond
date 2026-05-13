## 2024-05-24 - Optimize WP_Query for Recently Viewed Products
**Learning:** When using `WP_Query` in WordPress to fetch a specific list of posts (like recently viewed products) without needing pagination, WordPress by default will still calculate the total number of found rows (`SQL_CALC_FOUND_ROWS`) and search for sticky posts, which adds unnecessary overhead.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination is not required to skip expensive database calculations.
