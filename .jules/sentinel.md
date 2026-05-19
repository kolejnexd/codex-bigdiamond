## 2024-10-24 - Missing wp_unslash on superglobal sanitization
**Vulnerability:** Found `$_POST['bdwp_engraving_text']` being directly passed to `sanitize_text_field()` without `wp_unslash()`.
**Learning:** In WordPress, superglobals are automatically escaped via `wp_magic_quotes()`. Sanitizing them directly can lead to double-escaping issues and data integrity problems.
**Prevention:** Always wrap superglobal accesses in `wp_unslash()` before applying sanitization functions.
