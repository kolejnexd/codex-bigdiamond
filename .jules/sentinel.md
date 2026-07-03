## 2026-07-03 - Add wp_unslash and type checking to $_POST data
**Vulnerability:** Directly processing $_POST data without wp_unslash() and type validation, which can lead to array injection errors and double-escaping issues.
**Learning:** In WordPress, superglobals like $_POST may contain magic quotes data, so wp_unslash() is necessary before sanitization. Missing type validation like is_string() can also lead to fatal errors if an array is passed instead of a string.
**Prevention:** Always validate superglobal input types and apply wp_unslash() before sanitization functions like sanitize_text_field().
