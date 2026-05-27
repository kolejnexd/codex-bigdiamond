## 2024-05-24 - Optimize WP_Query for unpaginated queries
**Learning:** In WordPress, `WP_Query` calculates total found rows by default for pagination (`SQL_CALC_FOUND_ROWS`), which is an expensive database operation.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` when pagination is not needed.
