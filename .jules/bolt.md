## 2024-05-16 - Skip SQL_CALC_FOUND_ROWS in unpaginated queries
**Learning:** `WP_Query` calculates pagination by default using `SQL_CALC_FOUND_ROWS`, which is very slow on large tables. If a query doesn't need pagination (like fetching a fixed list of recently viewed products), this calculation is pure overhead.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` arguments when pagination is not required in this codebase.
