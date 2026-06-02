## 2024-05-30 - Fix Missing wp_unslash on $_POST variable
**Vulnerability:** The $_POST['bdwp_engraving_text'] input was sanitized with sanitize_text_field() but lacked wp_unslash().
**Learning:** WordPress can add magic quotes to superglobals. Failing to use wp_unslash() before sanitization can lead to data corruption or double-escaping, creating subtle vulnerabilities.
**Prevention:** Always wrap superglobals ($_POST, $_GET, $_COOKIE) in wp_unslash() before passing them to sanitization functions like sanitize_text_field().
