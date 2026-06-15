## 2026-06-15 - Optimize WP_Query for non-paginated queries
**Learning:** By default, WordPress WP_Query calculates total found rows (SQL_CALC_FOUND_ROWS) for pagination and fetches sticky posts. For queries that don't need pagination (like recently viewed products), this causes unnecessary database overhead.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when fetching a limited set of items without pagination.
