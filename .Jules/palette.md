## 2024-05-24 - FAQ Accessibility Improvement
**Learning:** Found that some generic template parts (`template-parts/contact-form.php`) lacked the same detailed ARIA attributes as dedicated page templates (`page-faq.php`). The FAQ accordion was missing `aria-controls` on the toggle button and matching `id` values on the expandable panels.
**Action:** Always verify custom loops or generalized template parts against their fully-featured page equivalents to ensure ARIA attributes are propagated correctly.
