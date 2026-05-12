## 2024-05-24 - Fix missing wp_unslash() on $_POST data before sanitization
**Vulnerability:** Data integrity issue/improper sanitization due to WordPress magic quotes affecting $_POST superglobals. Data like `O\'Connor` gets stored with extra slashes and can potentially bypass certain strict validations.
**Learning:** In WordPress, `$_POST` and `$_GET` are automatically slashed by core. Passing slashed data directly to `sanitize_text_field()` violates WP standards.
**Prevention:** Always wrap `$_POST` and `$_GET` superglobals in `wp_unslash()` before applying standard WordPress sanitization or validation functions.
