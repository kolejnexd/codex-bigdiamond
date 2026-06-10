## 2024-05-24 - WP_Query Pagination Overhead
**Learning:** Custom WP_Query instances without pagination suffer from a performance bottleneck due to unnecessary SQL_CALC_FOUND_ROWS calculations and sticky post checks.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required.
