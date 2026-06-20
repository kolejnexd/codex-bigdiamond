
## 2026-06-20 - Missing wp_unslash and type validation on $_POST data
**Vulnerability:** The code accessed `$_POST['bdwp_engraving_text']` and passed it directly to `sanitize_text_field()` without checking if it was a string or using `wp_unslash()`.
**Learning:** In WordPress, `$_POST` data is slashed, so omitting `wp_unslash()` can lead to double escaping and corrupted data. Also, if a malicious user passes an array instead of a string, `sanitize_text_field()` may trigger a PHP error or misbehave, leading to potential array injection vulnerabilities.
**Prevention:** Always validate the type of incoming superglobal data (e.g., `is_string()`) and apply `wp_unslash()` before sanitization.
