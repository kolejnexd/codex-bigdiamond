## 2026-05-29 - Missing wp_unslash on POST superglobals
**Vulnerability:** Superglobals like `$_POST` were being directly passed to `sanitize_text_field()` without `wp_unslash()`.
**Learning:** WordPress adds magic quotes (slashes) to superglobals. If you don't unslash them before sanitization, the slashes will be incorrectly preserved in the data, potentially leading to double escaping or integrity issues caused by magic quotes.
**Prevention:** Always apply `wp_unslash()` to superglobal arrays (`$_POST`, `$_GET`, `$_COOKIE`, `$_REQUEST`) before passing them to sanitization functions like `sanitize_text_field()`.
