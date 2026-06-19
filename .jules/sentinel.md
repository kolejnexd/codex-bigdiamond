## 2026-06-19 - Prevent Array Injection and Double Escaping in Superglobals
**Vulnerability:** `$_POST` parameter was directly passed to `sanitize_text_field()` without checking if it was a string or unslashing it, risking array injection crashes and data double-escaping.
**Learning:** In WordPress, superglobals must be type-checked (e.g. `is_string()`) to avoid array-to-string conversion errors, and `wp_unslash()` must be applied before sanitization functions because WP adds slashes to `$_POST` / `$_GET` payloads by default.
**Prevention:** Always validate superglobal input types and wrap them in `wp_unslash()` prior to sanitization.
