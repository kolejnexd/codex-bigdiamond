## 2024-05-24 - WP_Query Performance
**Learning:** When pagination is not needed, `WP_Query` still runs `SQL_CALC_FOUND_ROWS` by default to calculate the total number of items found. Also it queries sticky posts by default. These default behaviours perform unnecessary queries and negatively impact performance.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to `WP_Query` arguments when fetching simple lists of posts where pagination is not needed.
