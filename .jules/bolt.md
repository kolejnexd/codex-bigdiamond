## 2026-06-01 - Optimize WP_Query for non-paginated queries
**Learning:** Default WP_Query executions calculate total rows and check sticky posts, which adds unnecessary database overhead for non-paginated queries like "recently viewed" widgets.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments if pagination is not required to skip expensive operations.
