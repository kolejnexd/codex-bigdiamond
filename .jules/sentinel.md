## 2024-05-24 - Missing wp_unslash on WordPress Superglobals
**Vulnerability:** Superglobals like $_POST were being sanitized without first being unslashed (e.g., `sanitize_text_field( $_POST['bdwp_engraving_text'] )`).
**Learning:** WordPress uses magic quotes and automatically slashes input. Processing superglobals directly can lead to double-escaping or data integrity issues (like saving extra slashes in the database).
**Prevention:** Always apply `wp_unslash()` to WordPress superglobals (like $_POST, $_GET, $_COOKIE) before passing them to sanitization functions.
