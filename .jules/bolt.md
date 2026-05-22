## 2024-05-18 - Optimize WP_Query for non-paginated queries
**Learning:** By default, WP_Query executes an expensive SQL_CALC_FOUND_ROWS to calculate pagination and handles sticky posts, which is unnecessary for simple queries like fetching a fixed list of recently viewed products.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required, as this skips expensive calculations and sticky post checks.
