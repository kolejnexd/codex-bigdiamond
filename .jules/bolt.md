## 2024-05-09 - Optimize WP_Query performance for unpaginated queries
**Learning:** By default, WordPress `WP_Query` executes a second query using `SQL_CALC_FOUND_ROWS` to calculate pagination. This is an expensive operation that can cause performance bottlenecks.
**Action:** When querying posts without the need for pagination (such as returning a specific subset of IDs or fixed lists), ALWAYS explicitly add `'no_found_rows' => true` to bypass this unnecessary query. In addition, add `'ignore_sticky_posts' => true` to skip redundant processing of sticky posts.
