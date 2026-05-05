## 2026-05-05 - Optimize WP_Query Performance
**Learning:** In WordPress, WP_Query automatically runs a secondary SQL_CALC_FOUND_ROWS query to support pagination, and checks for sticky posts. If pagination isn't needed (like for 'Recently Viewed Products' or widgets), this is a significant and unnecessary database overhead.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` arguments when pagination is not required to skip expensive database calculations.
