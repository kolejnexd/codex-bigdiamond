## 2024-05-23 - WP_Query Pagination Performance
**Learning:** In WordPress, custom WP_Query instances calculate total found rows by default using SQL_CALC_FOUND_ROWS, which is an expensive database operation.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when building queries that do not require pagination.
