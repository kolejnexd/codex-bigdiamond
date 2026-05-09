## 2024-05-24 - Missing wp_unslash on superglobal before sanitization
**Vulnerability:** The codebase read from `$_POST` without calling `wp_unslash()` prior to `sanitize_text_field()`.
**Learning:** WordPress standard practice requires unslashing all data coming from `$_GET`, `$_POST`, `$_REQUEST`, and `$_COOKIE` before passing it into any sanitization functions. This prevents issues with double-escaping or data integrity, as WordPress automatically slashes these superglobals.
**Prevention:** Always use `wp_unslash()` on variables coming from superglobals before doing any other operation or sanitization on them.
