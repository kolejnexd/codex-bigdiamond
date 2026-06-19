## 2026-06-19 - Optimize unpaginated WP_Query
**Learning:** WP_Query calculates found rows by default for pagination (SQL_CALC_FOUND_ROWS) and checks for sticky posts, which is expensive and unnecessary for fixed-length queries like 'recently viewed' products.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to WP_Query arguments when pagination is not required.
