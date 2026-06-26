## 2026-06-26 - Input Validation and Sanitization of Superglobals
**Vulnerability:** Reading $_POST data without type validation and `wp_unslash()` before `sanitize_text_field()` in WooCommerce cart item data filter.
**Learning:** Superglobals in WordPress can sometimes be arrays (array injection) or contain escaped quotes (magic quotes), which can lead to fatals or double-escaped corrupted data.
**Prevention:** Always validate the expected type (e.g., `is_string()`) and apply `wp_unslash()` before applying sanitization functions on superglobals.
