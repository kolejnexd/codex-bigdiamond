## 2026-06-19 - Dynamic ARIA labels for repeated icon buttons
**Learning:** Repeated icon-only buttons (like cart remove buttons) with identical static ARIA labels are indistinguishable to screen readers, providing poor context for users navigating via keyboard or assistive technologies.
**Action:** Always append the specific item's name (stripped of HTML tags using wp_strip_all_tags and properly escaped with esc_attr) to the ARIA label of repeated icon buttons to ensure they are uniquely identifiable.
