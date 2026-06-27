## 2026-06-27 - Missing type validation and wp_unslash on superglobal
**Vulnerability:** $_POST data was processed without type validation (array injection risk) and without wp_unslash (double escaping/data integrity risk).
**Learning:** WordPress sanitization functions like sanitize_text_field() do not automatically strip slashes added by core's magic quotes setup, and can fail or error if an array is passed instead of a string.
**Prevention:** Always validate superglobal inputs using is_string() or similar, and apply wp_unslash() before passing data to WordPress sanitization functions.
