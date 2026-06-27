## 2026-06-27 - Optimize WP_Query for recently viewed products
**Learning:** WP_Query calculates SQL_CALC_FOUND_ROWS and checks sticky posts by default, which is expensive and unnecessary for non-paginated widget queries.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required.
