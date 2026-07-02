
## 2026-07-02 - Missing type validation and unslash on superglobals
**Vulnerability:** Direct access to `$_POST` data without checking type (leading to potential array injection) and passing to `sanitize_text_field` without `wp_unslash` (leading to potential double-escaping/data corruption).
**Learning:** WordPress relies on `wp_unslash()` before sanitization due to historical magic quotes handling. Omitting `is_string()` when accessing superglobals can cause fatal errors or bypasses if an array is submitted instead of a string.
**Prevention:** Always validate the type of incoming superglobal data (e.g., `is_string($_POST['var'])`) and always wrap the variable in `wp_unslash()` before passing it to sanitization functions like `sanitize_text_field()`.
