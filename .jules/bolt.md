## 2024-05-24 - [Optimization: Disable pagination overhead for custom WP_Query]
**Learning:** In this WordPress codebase, instantiating a custom `WP_Query` without pagination triggers an expensive `SQL_CALC_FOUND_ROWS` query operation.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when the query does not require pagination.
