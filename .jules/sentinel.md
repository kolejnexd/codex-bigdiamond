## 2026-06-12 - Add wp_unslash to $_POST data
**Vulnerability:** Missing wp_unslash on $_POST data before passing it to sanitize_text_field() in WooCommerce cart item data filter.
**Learning:** WordPress superglobals like $_POST may be affected by magic quotes, so they must be explicitly unslashed before sanitization to prevent double-escaping or data corruption.
**Prevention:** Always wrap $_POST, $_GET, and $_COOKIE access in wp_unslash() when sanitizing.
