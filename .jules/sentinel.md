## 2025-02-18 - Missing wp_unslash on $_POST data
**Vulnerability:** The `$_POST['bdwp_engraving_text']` superglobal was passed directly to `sanitize_text_field` without being unslashed first.
**Learning:** WordPress core automatically slashes superglobals. Passing slashed data directly to sanitization functions can result in double-escaping or data corruption.
**Prevention:** Always wrap WordPress superglobal accesses with `wp_unslash()` before passing them to sanitization functions like `sanitize_text_field()`.
