## 2024-05-24 - WP_Query Performance Pattern
**Learning:** WP_Query performs expensive SQL_CALC_FOUND_ROWS calculations by default for pagination, even when pagination isn't used (like recently viewed widgets).
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments when pagination isn't required to save database cycles.
