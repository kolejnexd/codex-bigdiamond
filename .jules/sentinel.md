## 2026-06-16 - Missing wp_unslash on superglobals
**Vulnerability:** $_POST data was being passed directly to sanitize_text_field without prior wp_unslash() processing, and lacked type checking before string manipulation.
**Learning:** WordPress relies on magic quotes internally, meaning all superglobals are slashed. Failing to unslash them before sanitization can lead to data integrity issues or double-escaping, which can sometimes be exploited in edge cases. Type checks prevent fatal errors if an array is injected.
**Prevention:** Always use wp_unslash() on $_POST, $_GET, and $_COOKIE prior to applying WordPress sanitization functions, and validate input types (e.g., is_string) to ensure robustness.
