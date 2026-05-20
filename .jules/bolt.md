## 2024-05-20 - Skip Expensive SQL Calcs in WP_Query
**Learning:** Using `WP_Query` without `no_found_rows` in custom loops (like "recently viewed products") triggers an expensive `SQL_CALC_FOUND_ROWS` calculation which slows down the database response.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when pagination is unnecessary.
