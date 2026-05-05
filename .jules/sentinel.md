## 2024-05-05 - Missing wp_unslash() on Superglobals
**Vulnerability:** `$_POST` superglobal was passed to `sanitize_text_field()` without first being unslashed via `wp_unslash()`.
**Learning:** In WordPress, superglobals like `$_POST`, `$_GET`, and `$_COOKIE` may have magic quotes applied (or are simulated to have them). Passing them directly to sanitization functions without `wp_unslash()` can lead to double-escaping issues and data integrity vulnerabilities, which is non-compliant with WordPress security standards.
**Prevention:** Always apply `wp_unslash()` to any incoming superglobal data before it undergoes sanitization.
