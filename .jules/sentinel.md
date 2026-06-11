## 2026-06-11 - Missing wp_unslash on $_POST data
**Vulnerability:** The codebase was passing $_POST['bdwp_engraving_text'] directly to sanitize_text_field() without first applying wp_unslash().
**Learning:** WordPress automatically adds magic quotes (slashes) to superglobals like $_POST, $_GET, and $_COOKIE. Failing to unslash them before sanitization can lead to double-escaping or corrupted data if the user input contains quotes.
**Prevention:** Always use wp_unslash() on data retrieved from WordPress superglobals before passing it to sanitization functions.
