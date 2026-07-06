## 2026-07-06 - Optimize WP_Query for performance
**Learning:** WP_Query inherently runs `SQL_CALC_FOUND_ROWS` and processes sticky posts, which causes unnecessary overhead for simple lists without pagination (like recently viewed products).
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments when pagination isn't needed.
