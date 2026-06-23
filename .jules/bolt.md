## 2026-06-23 - Optimize WP_Query for non-paginated lists
**Learning:** WP_Query inherently performs expensive SQL_CALC_FOUND_ROWS calculations and sticky post checks by default, even for small UI lists like "recently viewed" products, causing a hidden performance bottleneck.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required to skip these unnecessary database operations.
