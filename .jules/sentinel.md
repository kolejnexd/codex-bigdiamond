## 2024-05-20 - Missing wp_unslash on superglobals
**Vulnerability:** WordPress superglobals (like $_POST) were being passed directly to sanitize_text_field() without first being unslashed.
**Learning:** WordPress core adds magic quotes (slashes) to all superglobals. If wp_unslash() is omitted before sanitization, it can lead to double-escaping vulnerabilities and data corruption.
**Prevention:** Always wrap superglobal accesses (like $_POST, $_GET) in wp_unslash() before applying sanitization functions.
