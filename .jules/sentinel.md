
## 2024-05-22 - Fix missing wp_unslash on POST superglobal
**Vulnerability:** Missing `wp_unslash()` before `sanitize_text_field()` on `$_POST['bdwp_engraving_text']` in `functions.php`.
**Learning:** WordPress automatically adds slashes to superglobals. Failing to unslash before sanitization can lead to data integrity issues (like double escaping) and potentially bypass sanitization checks.
**Prevention:** Always apply `wp_unslash()` to data directly retrieved from WordPress superglobals (`$_POST`, `$_GET`, `$_COOKIE`, etc.) before passing it to sanitization functions.
