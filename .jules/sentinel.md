## 2026-06-03 - Missing wp_unslash on superglobals
**Vulnerability:** Found `$_POST['bdwp_engraving_text']` being directly sanitized without prior unslashing.
**Learning:** WordPress environments historically add slashes to superglobals. Failing to use `wp_unslash()` before `sanitize_text_field()` can lead to data integrity bugs (persisting backslashes) or double-escaping issues.
**Prevention:** Always apply `wp_unslash()` to superglobals (`$_POST`, `$_GET`, `$_COOKIE`) before passing them to sanitization functions.
