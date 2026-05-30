## 2024-05-23 - Missing wp_unslash on $_POST Superglobals
**Vulnerability:** Found `$_POST['bdwp_engraving_text']` being passed directly to `sanitize_text_field()` without `wp_unslash()`.
**Learning:** WordPress automatically adds slashes to superglobals (`$_POST`, `$_GET`, `$_COOKIE`) to simulate magic quotes. Failing to `wp_unslash()` before sanitization can lead to double-escaping or data integrity issues, which could be exploited in edge cases or cause unexpected output behavior.
**Prevention:** Always wrap superglobals in `wp_unslash()` before passing them to sanitization functions like `sanitize_text_field()`.
