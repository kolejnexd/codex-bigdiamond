
## 2026-06-14 - Missing wp_unslash on $_POST variable
**Vulnerability:** The `$_POST['bdwp_engraving_text']` variable was passed directly to `sanitize_text_field()` without first being unslashed.
**Learning:** WordPress core automatically adds slashes to `$_POST`/`$_GET`/`$_COOKIE` data. If `wp_unslash()` is not used before sanitization, slashes become permanent, leading to double-escaping issues and potential data integrity problems.
**Prevention:** Always wrap WordPress superglobals in `wp_unslash()` immediately upon access before passing them to sanitization functions like `sanitize_text_field()`.
