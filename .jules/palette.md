## 2024-05-18 - ARIA labels on repeated icon buttons
**Learning:** Screen readers need context to distinguish repeated icon-only buttons (like cart remove links). If all buttons have aria-label="Usuń produkt", the user doesn't know which product is being removed.
**Action:** Always append the specific item's name (stripped of HTML tags) to the ARIA label of repeated icon buttons to ensure they are distinguishable.
