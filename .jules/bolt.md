## 2026-07-04 - Optimize non-paginated WP_Query
**Learning:** WP_Query calculates found rows (SQL_CALC_FOUND_ROWS) and checks sticky posts by default, which adds unnecessary overhead for non-paginated queries.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query when pagination is not required to improve database performance.
