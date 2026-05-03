## 2024-05-03 - Unslashing before sanitization
**Vulnerability:** Input data from `$_POST` was passed directly to `sanitize_text_field()` without being unslashed first.
**Learning:** In WordPress, superglobals are automatically slashed (magic quotes). Failing to apply `wp_unslash()` before sanitizing can lead to double-escaping or improperly processed input data, which violates WordPress coding standards and security best practices.
**Prevention:** Always wrap superglobals in `wp_unslash()` before passing them to sanitization functions.
