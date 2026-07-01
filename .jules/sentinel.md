## 2026-07-01 - Prevent Array Injection and Double-Escaping
**Vulnerability:** Directly passing $_POST variables to sanitization functions without checking if it's a string, and missing wp_unslash().
**Learning:** Without is_string(), attackers could pass arrays, causing errors. Without wp_unslash(), data may be double-escaped due to WordPress magic quotes.
**Prevention:** Always validate superglobal input types (e.g., using is_string()) and apply wp_unslash() before passing data to sanitization functions.
