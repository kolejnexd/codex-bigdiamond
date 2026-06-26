## 2026-06-26 - Optimize WP_Query by disabling SQL_CALC_FOUND_ROWS
**Learning:** By default, WordPress `WP_Query` executes an expensive `SQL_CALC_FOUND_ROWS` query to support pagination, and also performs lookups for sticky posts. When querying a fixed number of known IDs without pagination, this is wasted overhead.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination is unnecessary to significantly reduce database load.
