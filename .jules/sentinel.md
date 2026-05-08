## 2024-05-08 - Missing wp_unslash on superglobal sanitization
**Vulnerability:** Missing `wp_unslash` before `sanitize_text_field` when accessing `$_POST` superglobals in `bigdiamond-white-prestige/functions.php`.
**Learning:** WordPress security standards dictate that `wp_unslash()` must be applied to superglobals (e.g., `$_POST`, `$_GET`, `$_COOKIE`) before passing the data to sanitization functions like `sanitize_text_field()`. This complies with WordPress security standards and prevents double-escaping or data integrity issues caused by magic quotes.
**Prevention:** Always use `wp_unslash()` on superglobal data prior to sanitization in WordPress codebases.
