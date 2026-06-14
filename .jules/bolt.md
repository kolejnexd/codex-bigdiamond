## 2024-05-18 - First entry
**Learning:** Initial setup
**Action:** Ready to optimize
## 2026-06-14 - Optimize WP_Query without pagination
**Learning:** In WordPress, new WP_Query() triggers expensive SQL_CALC_FOUND_ROWS and sticky post checks by default. When pagination is not required (like in recently viewed products list), these are pure overhead. Note that get_posts() sets these flags automatically, but WP_Query does not.
**Action:** Always add 'no_found_rows' => true and 'ignore_sticky_posts' => true to custom WP_Query arguments when building lists or blocks that don't need pagination.
