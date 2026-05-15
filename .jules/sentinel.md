## 2024-05-24 - Missing wp_unslash on superglobal input
**Vulnerability:** User input from `$_POST['bdwp_engraving_text']` was passed directly to `sanitize_text_field()` without first being unslashed.
**Learning:** WordPress relies on Magic Quotes behavior internally (slashing superglobals). When processing WordPress superglobals (e.g., `$_POST`, `$_GET`, `$_COOKIE`), failing to apply `wp_unslash()` before passing the data to sanitization functions like `sanitize_text_field()` can lead to double-escaping or data integrity issues (e.g., escaping quotes becoming part of the saved string).
**Prevention:** Always apply `wp_unslash()` to data coming directly from WordPress superglobals before any sanitization or saving.
