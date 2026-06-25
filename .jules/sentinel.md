## 2026-06-25 - Missing Type Validation and Unslash for $_POST
**Vulnerability:** The $_POST['bdwp_engraving_text'] parameter was being processed without verifying it was a string and without using wp_unslash(), potentially causing array injection errors or double-escaping issues.
**Learning:** WordPress superglobals need explicit type validation (like is_string()) and wp_unslash() prior to sanitization, because WordPress environment and PHP behaviors can introduce unexpected types or magic quotes.
**Prevention:** Always validate superglobal input types and use wp_unslash() prior to sanitizing (e.g. sanitize_text_field) in WordPress templates and plugins.
