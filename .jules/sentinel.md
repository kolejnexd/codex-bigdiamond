## 2026-07-08 - Secure Superglobal Processing
**Vulnerability:** Missing array type validation and missing wp_unslash() before sanitize_text_field() when processing $_POST data.
**Learning:** WordPress sanitization functions like sanitize_text_field() can fail or behave unexpectedly if passed an array, enabling array injection. Furthermore, raw superglobals are often slashed by WordPress magic quotes; failing to unslash them can lead to double-escaping issues.
**Prevention:** Always validate that $_POST/$_GET variables are strings (e.g., using is_string()) and apply wp_unslash() before passing them to sanitization functions.
