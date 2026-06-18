## 2026-06-18 - Optimize WP_Query for unpaginated lists
**Learning:** In WordPress, `WP_Query` automatically executes `SQL_CALC_FOUND_ROWS` for pagination and checks for sticky posts. This causes unnecessary database overhead for widgets or fixed-size lists that don't need pagination.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when fetching unpaginated post lists to improve query performance.
