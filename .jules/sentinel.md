## 2024-06-05 - Missing wp_unslash on WordPress Superglobals
**Vulnerability:** User input from `$_POST` was passed directly to `sanitize_text_field()` without being unslashed first.
**Learning:** WordPress automatically adds slashes to `$_POST`, `$_GET`, `$_COOKIE`, and `$_REQUEST` via `wp_magic_quotes()`. If input is not unslashed before sanitization, it can result in double-escaped data, unexpected backslashes in stored data, and potential data integrity issues.
**Prevention:** Always apply `wp_unslash()` to WordPress superglobals before passing them to sanitization functions.
