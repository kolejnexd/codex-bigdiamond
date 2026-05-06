## 2024-11-20 - Missing wp_unslash on superglobals before sanitization
**Vulnerability:** The $_POST variable was accessed directly without unslashing it before passing to sanitize_text_field.
**Learning:** WordPress automatically adds magic quotes (slashes) to all superglobals ($_GET, $_POST, $_COOKIE, $_REQUEST). Failing to use wp_unslash() on these superglobals before sanitizing them can result in data integrity issues or double-escaping, breaking application logic or leaving gaps for bypasses.
**Prevention:** Always wrap direct superglobal accesses with wp_unslash() prior to sanitization functions like sanitize_text_field() or sanitize_textarea_field().
