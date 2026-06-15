## 2026-06-15 - Missing wp_unslash on superglobals
**Vulnerability:** Found direct access to $_POST['bdwp_engraving_text'] being passed to sanitize_text_field() without first being unslashed.
**Learning:** WordPress automatically adds magic quotes to superglobals (like $_POST and $_GET). Passing them directly to sanitization functions without wp_unslash() can lead to double-escaping or data integrity issues.
**Prevention:** Always wrap WordPress superglobals in wp_unslash() before applying sanitization functions like sanitize_text_field().
