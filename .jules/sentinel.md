## 2024-05-23 - Missing wp_unslash on superglobals
**Vulnerability:** $_POST data was passed directly to sanitize_text_field() without wp_unslash().
**Learning:** WordPress adds magic quotes to superglobals. Failing to unslash them before sanitization can lead to double escaping and corrupted data when handling user inputs with quotes.
**Prevention:** Always use wp_unslash() on $_POST, $_GET, $_COOKIE, and $_REQUEST values before passing them to sanitization functions.
