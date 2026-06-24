
## 2026-06-24 - Array Injection and Double-Escaping via $_POST
**Vulnerability:** Missing type validation and unslashing on $_POST['bdwp_engraving_text'] before sanitization.
**Learning:** In WordPress, superglobals must be type-checked (e.g., using is_string) to prevent array injection attacks that cause fatal errors in sanitization functions like sanitize_text_field. They must also be unslashed (wp_unslash) to avoid double-escaping issues due to WordPress's magic quotes behavior.
**Prevention:** Always validate the type of input received from superglobals and apply wp_unslash() before passing data to WordPress sanitization functions.
