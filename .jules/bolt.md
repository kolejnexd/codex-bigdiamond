## 2026-07-07 - WP_Query Pagination Overhead
**Learning:** By default, WP_Query executes SQL_CALC_FOUND_ROWS and checks for sticky posts, which causes unnecessary overhead when pagination is not required (e.g., retrieving a fixed number of recently viewed items).
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when building lists that do not require pagination.
