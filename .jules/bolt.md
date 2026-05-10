## 2024-05-17 - Optimize WP_Query for better performance
**Learning:** In WordPress, `WP_Query` calculates the total number of found rows by default using `SQL_CALC_FOUND_ROWS`, which is an expensive database operation.
**Action:** When pagination is not required, always include `'no_found_rows' => true` and `'ignore_sticky_posts' => true` in `WP_Query` arguments to skip this expensive calculation.
