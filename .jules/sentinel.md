## 2024-10-24 - [Unslashing Superglobals]
**Vulnerability:** Missing `wp_unslash()` before `sanitize_text_field($_POST['bdwp_engraving_text'])`.
**Learning:** WordPress adds slashes to superglobals. Passing slashed data to sanitization functions without `wp_unslash()` can lead to data integrity issues or double-escaping vulnerabilities.
**Prevention:** Always apply `wp_unslash()` to `$_POST`, `$_GET`, `$_COOKIE` before passing to WordPress sanitization functions.
