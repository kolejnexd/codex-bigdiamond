## 2024-03-24 - Missing wp_unslash on superglobal handling
**Vulnerability:** Found direct usage of `sanitize_text_field( $_POST['...'] )` without first applying `wp_unslash()`.
**Learning:** WordPress automatically adds magic quotes (slashes) to superglobals (`$_POST`, `$_GET`, `$_COOKIE`, `$_REQUEST`). Passing these directly to sanitization functions can lead to double-escaping issues or data integrity bugs.
**Prevention:** Always wrap superglobals with `wp_unslash()` before passing them to sanitization functions like `sanitize_text_field()` or saving to the database.
