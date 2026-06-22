## 2026-06-22 - Optimize WP_Query for Recently Viewed Products
**Learning:** In WordPress, `WP_Query` calculations for `SQL_CALC_FOUND_ROWS` and checking for sticky posts can cause unnecessary overhead when fetching a small, specific set of IDs where pagination is not needed.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when fetching specific items without pagination.
