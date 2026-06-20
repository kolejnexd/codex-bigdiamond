## 2026-06-20 - WP_Query Performance Optimization
**Learning:** In WordPress, `WP_Query` automatically runs expensive `SQL_CALC_FOUND_ROWS` and checks for sticky posts by default, which can slow down database queries unnecessarily when pagination is not required.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` arguments when fetching specific sets of posts (like recently viewed products) where pagination and sticky post ordering are not needed.
