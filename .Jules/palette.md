## 2026-06-17 - Distinct ARIA labels for repeated icon buttons
**Learning:** Using identical ARIA labels (like "Usuń produkt") for multiple repeated icon buttons in lists or tables causes screen readers to announce indistinguishable actions, making it impossible for users to know which specific item they are interacting with.
**Action:** Always append the specific item's name (stripped of HTML tags and properly escaped) to the ARIA label of repeated icon-only buttons to ensure they are unique and clearly distinguishable.
