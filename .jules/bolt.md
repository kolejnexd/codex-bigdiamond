## 2026-07-05 - Optimize WP_Query Performance
**Learning:** By default, WP_Query executes SQL_CALC_FOUND_ROWS for pagination and fetches sticky posts, adding unnecessary database load for simple lists where pagination isn't used.
**Action:** Always append 'no_found_rows' => true and 'ignore_sticky_posts' => true to custom WP_Query instances when pagination and sticky functionality are unneeded.
