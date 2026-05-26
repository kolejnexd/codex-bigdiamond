## 2024-05-30 - Missing wp_unslash on superglobal
**Vulnerability:** $_POST['bdwp_engraving_text'] was sanitized without prior unslashing, which can lead to double-escaping or data integrity issues due to WordPress's magic quotes.
**Learning:** WordPress automatically adds slashes to superglobals. Failing to unslash them before sanitization can result in corrupted user input being processed.
**Prevention:** Always apply wp_unslash() to $_POST, $_GET, $_REQUEST, and $_COOKIE before passing the data to sanitization functions like sanitize_text_field().
