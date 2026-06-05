## 2024-05-18 - Avoid SQL_CALC_FOUND_ROWS on non-paginated WP_Query
**Learning:** WP_Query inherently runs `SQL_CALC_FOUND_ROWS` to calculate pagination, which is highly expensive for large databases. For custom loops that don't require pagination (e.g., small widgets or related products), this is a significant bottleneck.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to WP_Query arguments if pagination is not required, as this skips expensive calculations and unnecessary sticky post checks.
