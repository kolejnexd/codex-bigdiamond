
## 2024-05-23 - WP_Query Performance Anti-pattern
**Learning:** Custom WP_Query calls for non-paginated blocks (like recently viewed products) omit 'no_found_rows' and 'ignore_sticky_posts', causing unnecessary SQL_CALC_FOUND_ROWS calculations.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required.
