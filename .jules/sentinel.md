## 2026-06-23 - Missing Type Check and Unslashing for WP Superglobals
**Vulnerability:** $_POST data was being accessed without type validation and passed directly to sanitize_text_field() without wp_unslash(), risking array injection and double-escaping bugs due to magic quotes.
**Learning:** WordPress applies magic quotes to superglobals like $_POST. If wp_unslash() is not used before sanitization, single quotes may get double-escaped. Furthermore, failing to check if the input is a string before processing can lead to PHP fatal errors (array injection) when using string functions.
**Prevention:** Always validate superglobal data types (e.g., is_string()) and apply wp_unslash() prior to sanitization functions like sanitize_text_field().
