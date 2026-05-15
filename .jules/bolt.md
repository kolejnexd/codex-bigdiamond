## 2024-05-24 - [Optimize Unpaginated Database Queries in WP_Query]
**Learning:** WP_Query calculates `SQL_CALC_FOUND_ROWS` by default for pagination, which can be expensive and is unnecessary if pagination isn't used (like for recent products). `get_posts` automatically skips this, but `WP_Query` does not unless instructed.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when the query results will not be paginated.
