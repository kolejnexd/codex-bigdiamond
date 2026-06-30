## 2026-06-30 - Optimize WP_Query for Recent Products
**Learning:** In WordPress, WP_Query automatically calculates total found rows for pagination by default (SQL_CALC_FOUND_ROWS) and checks for sticky posts. For custom, non-paginated lists like "recently viewed products", these checks are unnecessary performance bottlenecks.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` arguments unless pagination or sticky post logic is explicitly required.
