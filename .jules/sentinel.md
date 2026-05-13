## 2024-05-24 - Fix missing wp_unslash on user input
**Vulnerability:** WordPress automatically adds slashes to global variables like `$_POST`, `$_GET`, and `$_COOKIE`. The code was sanitizing the user input using `sanitize_text_field( $_POST['bdwp_engraving_text'] )` without unslashing the input first.
**Learning:** This is a WordPress-specific behavior that can lead to incorrectly sanitized data or data integrity issues (like double escaping) if `wp_unslash()` is omitted before passing superglobals to sanitization functions.
**Prevention:** Always apply `wp_unslash()` before sanitizing WordPress superglobal data (e.g., `sanitize_text_field( wp_unslash( $_POST['data'] ) )`).
