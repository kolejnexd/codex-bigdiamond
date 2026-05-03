## 2026-05-03 - Added ARIA Label to Blog Read More Links
**Learning:** Generic 'Read More' links present a significant accessibility barrier. Adding an `aria-label` combining the action and the post title (e.g., 'Czytaj dalej: [Post Title]') provides crucial context for screen reader users without altering the visual design.
**Action:** Always check links containing generic text (like 'Read more', 'Click here', 'Continue reading') and add contextual `aria-label`s or visually hidden text when linking to specific content.
