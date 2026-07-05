
## 2026-07-05 - Missing wp_unslash and type validation on $_POST
**Vulnerability:** Directly passing $_POST data to sanitize_text_field() without wp_unslash() and type validation.
**Learning:** WordPress environments may add slashes to superglobals. Failing to unslash before sanitizing can lead to double-escaping issues. Also, missing type validation on superglobals can lead to array injection warnings or errors in sanitization functions.
**Prevention:** Always validate the type of superglobals (e.g., using is_string()) and apply wp_unslash() before passing them to sanitization functions like sanitize_text_field().
