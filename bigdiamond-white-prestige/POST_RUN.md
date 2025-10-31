# Post-Deployment Test Report

## Jak testować
- **Lighthouse (Mobile, 4G throttling)**: w Chrome DevTools → Lighthouse → Device: Mobile; strony do audytu: Home (`/`), kategoria (`/sklep` lub główna kategoria), PDP (dowolny produkt). Sprawdź LCP ≤ 2.5 s, CLS < 0.1, INP < 200 ms.
- **Header / Nawigacja (Desktop + Mobile)**: przewiń od topu strony, potwierdź brak skoku layoutu, hamburger z `aria-expanded`, zamykanie ESC, focus trap, brak scrolla w tle.
- **Hero + Bridge**: zweryfikuj płynne przejście czarnego tła, brak białych pasów, karty kategorii z pojedynczym ringiem i poprawnymi klasami.
- **PDP (Desktop)**:
  - Sticky media przy przewijaniu (zatrzymuje się pod headerem).
  - Sticky CTA pojawia się po wyjściu z sekcji podsumowania, przycisk „Dodaj do koszyka” wyzwala formularz.
  - Sekcja 4C + link do certyfikatu widoczna pod podsumowaniem.
  - Pole grawerunku z walidacją (limit znaków, komunikat przy braku nonce).
- **PDP (Mobile)**: sticky CTA nie nakłada się na treść (sprawdź paddings), przyciski przezroczyste ze złotym obrysem.
- **Koszyk / Zamówienie**: dodaj produkt z grawerem → sprawdź komunikat w koszyku, checkout i meta zamówienia (w panelu admina).
- **JSON-LD**: przy pomocy Rich Results Test potwierdź obecność `additionalProperty` (4C) oraz `hasCertification` bez duplikacji z wtyczkami SEO.

## Wyniki bieżące
- Testy Lighthouse i manualne scenariusze **do uruchomienia** po wdrożeniu (brak środowiska przeglądarkowego w tej sesji).
- Walidacja JSON-LD, sticky panel i focus-trap zweryfikowane manualnie w kodzie; zalecane potwierdzenie w środowisku przeglądarkowym.
