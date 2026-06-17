## 2026-06-17 - Optimize WP_Query for Recent Products
**Learning:** By default, WP_Query executes an expensive SQL_CALC_FOUND_ROWS query for pagination and fetches sticky posts, even when fetching a fixed small number of products based on IDs.
**Action:** Always append 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arrays when pagination and sticky functionality are unnecessary to significantly reduce database overhead.
