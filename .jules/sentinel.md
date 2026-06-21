## 2026-06-21 - Missing wp_unslash and type validation on superglobals
**Vulnerability:** Directly passing $_POST variables to sanitize_text_field without is_string() check or wp_unslash().
**Learning:** Failing to validate data type can lead to array injection and fatal errors. In WordPress, superglobals may have quotes escaped, leading to double-escaping issues if wp_unslash is omitted.
**Prevention:** Always validate the type of data from superglobals (e.g., using is_string()) and apply wp_unslash() prior to WordPress sanitization functions.
