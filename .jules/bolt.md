## 2026-06-11 - Optimize WP_Query when pagination is unnecessary
**Learning:** WordPress `WP_Query` calculates total matching rows by default (`SQL_CALC_FOUND_ROWS`) to support pagination, which can be an expensive database operation.
**Action:** Always add `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to custom `WP_Query` arguments unless pagination or sticky posts are explicitly required.
