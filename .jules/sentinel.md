
## 2024-05-18 - Fix missing wp_unslash on user input
**Vulnerability:** User input from `$_POST['bdwp_engraving_text']` was being sanitized with `sanitize_text_field` without first unslashing it via `wp_unslash`.
**Learning:** WordPress core automatically adds slashes to `$_POST`/`$_GET`/`$_REQUEST`/`$_COOKIE` data on initialization (magic quotes). Failing to unslash before sanitizing can result in double-escaping and unexpected backslashes stored in the database or displayed on screen.
**Prevention:** Always apply `wp_unslash()` on superglobal data in WordPress before sanitizing or processing it.
