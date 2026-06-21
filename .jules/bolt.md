## 2026-06-21 - Optimize WP_Query for non-paginated lists
**Learning:** By default, `WP_Query` calculates total rows (`SQL_CALC_FOUND_ROWS`) and checks for sticky posts, which causes performance overhead even when pagination is not required.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when querying lists that do not require pagination (like recent products) to skip expensive database operations.
