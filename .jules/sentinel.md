## 2024-06-01 - Missing Unslash on Superglobals Before Sanitization
**Vulnerability:** Direct use of `$_POST` in `sanitize_text_field()` without `wp_unslash()`.
**Learning:** WordPress adds slashes to `$_POST`/`$_GET`/`$_COOKIE`/`$_REQUEST` by default. Failing to unslash this data before sanitization can lead to double-escaped quotes and data integrity issues, potentially hiding payloads or breaking validations.
**Prevention:** Always use `wp_unslash( $_POST['...'] )` before applying sanitization functions like `sanitize_text_field()` in WordPress.
