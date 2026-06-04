
## 2024-05-24 - Optimize WP_Query for simple loops
**Learning:** By default, WP_Query executes an expensive `SQL_CALC_FOUND_ROWS` query for pagination and checks for sticky posts. When fetching a small, fixed list of posts (like recently viewed products) where pagination isn't needed, these defaults cause unnecessary database load.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments if pagination and sticky posts are not required, especially for simple loops or widget-like queries.
