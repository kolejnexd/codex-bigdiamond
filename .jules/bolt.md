## 2026-06-24 - WP_Query Performance Anti-pattern
**Learning:** Found WP_Query instances lacking `no_found_rows` and `ignore_sticky_posts` when pagination isn't needed. This is a common bottleneck causing expensive SQL_CALC_FOUND_ROWS calculations.
**Action:** Always verify if pagination is required for custom WP_Query calls and explicitly set `no_found_rows => true` and `ignore_sticky_posts => true` if not.
