## 2024-05-23 - Optimize WP_Query for Recent Products
**Learning:** Custom WP_Query calls run expensive SQL_CALC_FOUND_ROWS operations and evaluate sticky posts by default, which is wasteful when we only need a small fixed number of results without pagination.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query configurations where pagination is not used.
