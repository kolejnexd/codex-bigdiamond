## 2026-06-18 - Add wp_unslash and type check to $_POST data
**Vulnerability:** $_POST['bdwp_engraving_text'] was processed without wp_unslash() and without checking if it was a string, which could lead to array injection errors and double-escaping issues.
**Learning:** WordPress environments automatically add magic quotes to superglobals like $_POST, and data should be unslashed before passing it to sanitization functions. Additionally, failing to verify the input type can lead to array-to-string conversion errors or bypassing sanitization logic.
**Prevention:** Always use `is_string()` to validate the type of superglobal data before processing it, and always apply `wp_unslash()` before using functions like `sanitize_text_field()`.
