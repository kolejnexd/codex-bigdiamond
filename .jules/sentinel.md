## 2026-06-29 - Prevent Array Injection and Double-Escaping in $_POST
**Vulnerability:** $_POST['bdwp_engraving_text'] was passed to `sanitize_text_field()` without checking its type (array injection risk) or applying `wp_unslash()` (double-escaping risk).
**Learning:** WordPress superglobals like $_POST must be unslashed before sanitization, and type-checking prevents unexpected behavior when arrays are provided.
**Prevention:** Always validate the input type (e.g., `is_string()`) and apply `wp_unslash()` before passing superglobal data to sanitization functions.
