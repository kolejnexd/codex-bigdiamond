## 2024-05-24 - Optimizing WP_Query Performance
**Learning:** In WordPress, `WP_Query` performs an expensive `SQL_CALC_FOUND_ROWS` by default for pagination, and checks for sticky posts. When fetching a specific list of posts by ID without needing pagination, these default behaviors create unnecessary database overhead.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination is not required.
