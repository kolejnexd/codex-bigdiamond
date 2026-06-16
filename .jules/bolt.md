## 2026-06-16 - WP_Query Pagination Performance
**Learning:** By default, WordPress runs SQL_CALC_FOUND_ROWS and checks for sticky posts on WP_Query, even when pagination isn't used (like in the recently viewed widget), causing unnecessary database overhead.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required.
