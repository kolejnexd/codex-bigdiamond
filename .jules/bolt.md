## 2026-07-01 - Optimize WP_Query for non-paginated requests
**Learning:** In WordPress, `WP_Query` calculates total rows (`SQL_CALC_FOUND_ROWS`) and checks for sticky posts by default, unlike `get_posts()`. For non-paginated queries, this is an unnecessary performance bottleneck.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination is not required.
