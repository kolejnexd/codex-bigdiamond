## 2024-05-28 - Missing wp_unslash on superglobals
**Vulnerability:** Found `$_POST['bdwp_engraving_text']` being passed directly to `sanitize_text_field()` without prior unslashing. This can cause data integrity issues or double-escaping due to magic quotes in WordPress.
**Learning:** The codebase has instances where superglobals are processed directly. WordPress security standards mandate applying `wp_unslash()` before sanitizing to ensure data integrity and prevent double-escaping.
**Prevention:** Always apply `wp_unslash()` to all WordPress superglobals (`$_POST`, `$_GET`, `$_COOKIE`) before passing them to sanitization functions like `sanitize_text_field()`.
