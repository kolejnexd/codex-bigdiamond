## 2024-05-18 - Optimize WP_Query for non-paginated lists
**Learning:** Custom WP_Query calls without pagination still execute expensive SQL_CALC_FOUND_ROWS queries and sticky post checks by default.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination isn't needed.
