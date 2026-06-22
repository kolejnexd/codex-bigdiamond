## 2026-06-22 - Missing wp_unslash and type validation on $_POST
**Vulnerability:** Found unvalidated and non-unslashed usage of $_POST['bdwp_engraving_text'] passed directly to sanitize_text_field().
**Learning:** WordPress environments process superglobals with magic quotes logic; failing to use wp_unslash() can lead to double escaping. Passing raw superglobals without type checking (like is_string()) can cause array injection warnings/errors during sanitization.
**Prevention:** Always validate the type of superglobals (e.g., is_string()) and apply wp_unslash() before passing data to sanitization functions like sanitize_text_field().
