## 2024-05-18 - Optimizing WP_Query instances without pagination
**Learning:** `WP_Query` automatically includes SQL calculations for pagination and processes sticky posts, which is expensive on large stores.
**Action:** When using `WP_Query` for specific loops where pagination is unnecessary (e.g. recent views, limited sidebars), always append `'no_found_rows' => true` and `'ignore_sticky_posts' => true` to the array parameters.
