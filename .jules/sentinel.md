## 2026-06-28 - Missing unslash and type validation for $_POST
**Vulnerability:** The `bdwp_engraving_text` parameter from `$_POST` was passed directly to `sanitize_text_field()` without checking its type or unslashing.
**Learning:** In WordPress, superglobals like `$_POST` can contain arrays, leading to array injection errors if passed directly to string functions. Furthermore, WordPress may apply magic quotes (slashes) to superglobals, which can cause double-escaping if `wp_unslash()` is not used before sanitization.
**Prevention:** Always validate the type of superglobals (e.g., using `is_string()`) and apply `wp_unslash()` before sanitization functions like `sanitize_text_field()`.
