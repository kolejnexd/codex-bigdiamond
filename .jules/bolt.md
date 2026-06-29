## 2026-06-29 - WP_Query Performance Flags
**Learning:** Custom WP_Query calls that don't require pagination still perform expensive SQL_CALC_FOUND_ROWS calculations and check for sticky posts by default.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when querying a fixed number of posts where pagination is not used.
