## 2026-07-03 - Optimize WP_Query for non-paginated lists
**Learning:** By default, WordPress WP_Query executes an expensive SQL_CALC_FOUND_ROWS query to support pagination and checks for sticky posts. For widgets like "recently viewed" that have a fixed limit and no pagination, this adds unnecessary database overhead.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required to skip these expensive checks.
