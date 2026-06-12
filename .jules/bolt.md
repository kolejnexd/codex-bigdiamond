## 2026-06-12 - Optimize WP_Query for fixed-size lists
**Learning:** In WordPress, `WP_Query` defaults to calculating total matching rows (`SQL_CALC_FOUND_ROWS`) to support pagination and checking for sticky posts. For widgets or lists where the exact items are known (like recently viewed products fetched via `post__in`), these operations add unnecessary database load.
**Action:** When creating a `WP_Query` for a specific list of posts where pagination is not needed, always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to skip expensive calculations and sticky post logic.
