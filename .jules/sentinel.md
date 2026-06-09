## 2024-05-24 - Missing wp_unslash on $_POST variables
**Vulnerability:** A `$_POST` superglobal (`$_POST['bdwp_engraving_text']`) was passed directly to a sanitization function (`sanitize_text_field()`) without first being unslashed.
**Learning:** In WordPress, superglobals like `$_POST`, `$_GET`, and `$_COOKIE` are automatically slashed (magic quotes) by WordPress core. Passing them directly to sanitization functions without `wp_unslash()` can lead to double-escaping issues and data corruption.
**Prevention:** Always use `wp_unslash()` on superglobal variables before passing them to sanitization functions like `sanitize_text_field()`.
