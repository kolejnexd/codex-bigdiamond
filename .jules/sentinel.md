## 2024-06-07 - Missing wp_unslash on superglobal
**Vulnerability:** $_POST array data was passed directly to sanitize_text_field() without wp_unslash().
**Learning:** WordPress automatically slashes superglobals (simulating magic quotes). Failing to unslash before sanitization can lead to double-escaping issues and data integrity corruption.
**Prevention:** Always use wp_unslash() on data from $_POST, $_GET, $_COOKIE, and $_REQUEST before sanitizing or validating it.
