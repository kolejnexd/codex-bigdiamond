## 2026-07-04 - Prevent array injection and double-escaping on $_POST data
**Vulnerability:** A missing `is_string()` check and missing `wp_unslash()` on `$_POST['bdwp_engraving_text']` could allow array injection or lead to double-escaping in `sanitize_text_field()`.
**Learning:** WordPress sanitization functions like `sanitize_text_field()` expect strings. Passing an array (e.g., via `bdwp_engraving_text[]=...`) can trigger PHP warnings or bypass some logic, and `wp_unslash()` is needed to handle magic quotes correctly.
**Prevention:** Always validate the type of data retrieved from `$_POST`/`$_GET` (e.g., `is_string()`) and apply `wp_unslash()` before sanitization.
