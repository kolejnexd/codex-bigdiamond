## 2024-05-10 - Missing wp_unslash on superglobal input
**Vulnerability:** Missing wp_unslash before sanitizing $_POST input
**Learning:** In WordPress, superglobals must be unslashed using wp_unslash() prior to sanitization to avoid data integrity and double escaping issues due to magic quotes behavior.
**Prevention:** Always apply wp_unslash() on superglobals before passing them to sanitization functions like sanitize_text_field()
