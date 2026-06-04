## 2026-06-04 - Missing wp_unslash before sanitize_text_field
**Vulnerability:** Found `sanitize_text_field( $_POST['bdwp_engraving_text'] )` without `wp_unslash()`.
**Learning:** WordPress core automatically adds magic quotes (slashes) to superglobals (`$_POST`, `$_GET`, `$_COOKIE`). Sanitizing them directly can result in double-escaping or data integrity issues (e.g., escaping a valid apostrophe as `\'`).
**Prevention:** Always apply `wp_unslash()` to WordPress superglobals before passing them to sanitization functions like `sanitize_text_field()`.
