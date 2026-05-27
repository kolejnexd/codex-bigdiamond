## 2024-05-27 - Missing wp_unslash() on Superglobals Before Sanitization
**Vulnerability:** Found `sanitize_text_field( $_POST['bdwp_engraving_text'] )` without `wp_unslash()`.
**Learning:** WordPress automatically adds slashes to superglobals like `$_POST` and `$_GET` (similar to magic quotes). Passing these directly to sanitization functions without unslashing can cause data integrity issues, double-escaping, or unintended backslashes in database entries (e.g., `John\'s` instead of `John's`), which could lead to edge-case vulnerabilities when rendered.
**Prevention:** Always apply `wp_unslash()` to any data originating from WordPress superglobals before it is sanitized, validated, or saved to the database.
