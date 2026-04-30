
## 2024-05-17 - Optimize WP_Query for non-paginated lists
**Learning:** `WP_Query` by default calculates the total number of found rows in the database (SQL `SQL_CALC_FOUND_ROWS`), which is expensive, especially for large datasets. This is unnecessary when pagination is not required (e.g., for "Recently Viewed Products" or "Related Posts" blocks).
**Action:** Always add `'no_found_rows' => true` to `WP_Query` parameters if pagination is not used. Additionally, use `'ignore_sticky_posts' => true` if sticky posts are not meant to disrupt the query order.
