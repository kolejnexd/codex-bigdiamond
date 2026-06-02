## 2024-05-24 - [Optimize WP_Query for Fixed Lists]
**Learning:** WP_Query calculates total rows for pagination (`SQL_CALC_FOUND_ROWS`) and checks for sticky posts by default, causing unnecessary overhead when querying fixed lists where pagination isn't needed.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments when pagination is not required.
