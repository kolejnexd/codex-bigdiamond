## 2026-05-01 - [Security Headers]
**Vulnerability:** Missing fundamental security headers (X-Content-Type-Options, X-Frame-Options, Referrer-Policy).
**Learning:** Adding defense in depth headers via the `send_headers` hook in WordPress `functions.php` provides a quick and robust security improvement for the front-end.
**Prevention:** Ensure new WordPress themes automatically include security headers or have them configured at the web server layer.
