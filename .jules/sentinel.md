## 2026-07-06 - Unslashed and Unvalidated Superglobals Risk Array Injection and Double-Escaping
**Vulnerability:** Directly passing `$_POST` values to `sanitize_text_field()` without `wp_unslash()` or type validation (`is_string()`).
**Learning:** WordPress adds magic quotes (slashes) to superglobals. Failing to use `wp_unslash()` before sanitization can lead to double-escaping issues. Not validating the input type allows potential array injection errors since `sanitize_text_field()` expects a string.
**Prevention:** Always use `is_string()` to validate the type and `wp_unslash()` before passing superglobals like `$_POST` or `$_GET` to WordPress sanitization functions.
