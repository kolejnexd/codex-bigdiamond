## 2026-06-25 - WP_Query Performance Flags
**Learning:** By default, WP_Query executes expensive SQL_CALC_FOUND_ROWS calculations for pagination and checks for sticky posts. For simple UI queries (like recently viewed products), these add unnecessary database overhead.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when building lists that do not require pagination or sticky logic.
