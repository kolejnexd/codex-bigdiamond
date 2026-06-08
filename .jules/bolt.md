## 2024-05-24 - WP_Query Performance Overhead
**Learning:** WordPress `WP_Query` defaults to calculating total rows (`SQL_CALC_FOUND_ROWS`) and fetching sticky posts, which causes a significant DB bottleneck for secondary loops (like "recently viewed products") where pagination is never used.
**Action:** Always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments in this codebase when pagination is not required.
