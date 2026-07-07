## 2026-07-07 - Prevent Array Injection and Double Escaping in Superglobals
**Vulnerability:** $_POST data was processed without a type check and passed to sanitize_text_field() without wp_unslash(), risking array injection and data integrity issues.
**Learning:** WordPress sanitization functions like sanitize_text_field() expect string input and process slashed data. Missing is_string() allows arrays, and missing wp_unslash() causes double-escaping.
**Prevention:** Always validate superglobal input types (e.g., is_string()) and apply wp_unslash() before passing data to sanitization functions.
