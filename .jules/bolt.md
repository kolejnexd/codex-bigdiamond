## 2024-06-15 - Optimize WP_Query for Recently Viewed
**Learning:** WordPress `WP_Query` calculates `SQL_CALC_FOUND_ROWS` by default, even if pagination is not needed. This is an unnecessary database overhead for queries returning a fixed set of posts.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination and sticky posts are not required to improve query performance.
