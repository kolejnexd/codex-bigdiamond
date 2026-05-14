## 2024-05-14 - Missing wp_unslash on superglobal
**Vulnerability:** Missing wp_unslash before sanitizing $_POST data
**Learning:** WordPress adds magic quotes to superglobals like $_POST, $_GET, and $_COOKIE. If wp_unslash is not used before passing the data to sanitization functions like sanitize_text_field(), it can lead to double-escaping or data integrity issues.
**Prevention:** Always apply wp_unslash() to $_POST, $_GET, $_COOKIE, and $_REQUEST data before sanitization in WordPress environments.
