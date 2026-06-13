## 2026-06-13 - Missing wp_unslash on $_POST superglobal
**Vulnerability:** Found missing `wp_unslash()` before `sanitize_text_field($_POST['bdwp_engraving_text'])`.
**Learning:** WordPress can still simulate magic quotes. Passing unslashed superglobals to sanitization functions can lead to data integrity issues or double-escaping of quotes and slashes.
**Prevention:** Always apply `wp_unslash()` to WordPress superglobals (`$_POST`, `$_GET`, `$_COOKIE`) before sanitizing and using the data.
