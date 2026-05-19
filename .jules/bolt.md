## 2024-05-18 - Optimize WP_Query for performance
**Learning:** In WordPress, `WP_Query` calculates total rows (`SQL_CALC_FOUND_ROWS`) and checks for sticky posts by default, which is expensive and unnecessary if pagination is not used.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when fetching a limited number of items without pagination.
