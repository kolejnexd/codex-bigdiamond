## 2024-10-24 - Missing wp_unslash on superglobal
**Vulnerability:** Data integrity issue and potential escaping bypass via magic quotes when sanitizing `$_POST` directly.
**Learning:** WordPress expects superglobals to be unslashed via `wp_unslash()` before sanitization functions like `sanitize_text_field()` are applied to avoid double-escaping.
**Prevention:** Always wrap `$_POST`, `$_GET`, `$_COOKIE`, and `$_REQUEST` values with `wp_unslash()` prior to sanitization.
