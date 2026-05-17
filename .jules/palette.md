## 2024-06-25 - Indicate Required Fields Explicitly
**Learning:** Implicit "required" attributes on forms (like the contact form) lack visual cues for sighted users until submission, causing friction.
**Action:** Always pair `required` / `aria-required="true"` inputs with a visual indicator (like an asterisk) hidden from screen readers, and a screen-reader-only text explaining the requirement.
