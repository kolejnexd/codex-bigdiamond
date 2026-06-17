## 2026-06-17 - Prevent Array Injection and Double Escaping in Superglobals
**Vulnerability:** Missing type checking and unslashing on `$_POST['bdwp_engraving_text']` before passing to `sanitize_text_field`.
**Learning:** Passing an array via POST when a string is expected causes a PHP fatal error in sanitization functions. Additionally, WordPress adds slashes to superglobals; failing to use `wp_unslash()` leads to double escaping.
**Prevention:** Always validate input types (e.g., `is_string()`) from `$_POST` or `$_GET` and always use `wp_unslash()` before `sanitize_text_field()`.
