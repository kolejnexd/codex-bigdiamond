## 2024-05-23 - WP_Query Performance Flags
**Learning:** Custom WP_Query calls without pagination execute expensive SQL_CALC_FOUND_ROWS calculations and sticky post checks by default.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query args when fetching unpaginated lists (like recently viewed products).
