# AUDYT_FIX — plan napraw BigDIAMOND White Prestige

## 1. Header & Nawigacja

- `assets/js/header.js`
  - Guard przeciw podwójnej inicjalizacji (`window.bdwpHeaderInit`).
  - Przełączanie klasy `is-scrolled` na `document.body`, wspólne zamykanie overlayów (ESC, klik poza, resize), focus-trap w szufladzie, blokada scrolla.
  - Ujednolicony mechanizm `aria-expanded`, `aria-controls`, synchronizacja wielu przycisków burgera/szukajki.

- `header.php`
  - Sanitacja `aria-label` logotypu (`esc_attr( get_bloginfo( 'name', 'display' ) )`).

- `assets/css/white-prestige.css`
  - Rezerwa wysokości nagłówka od pierwszego renderu (`body { padding-top: var(--bdwp-header-h); }`).
  - Jedna dekoracja linii pod headerem (gradient jako `box-shadow`), usunięcie konfliktu `border-bottom` + `::after`.

## 2. Hero & Bridge

- `template-parts/hero.php`
  - Po `get_terms()` obsługa `WP_Error`.
  - Zmiana klas kafli na `bdwp-hero-cats__*` (zgodność z CSS).

- `assets/css/white-prestige.css`
  - Dopasowanie selektorów (`bdwp-hero-cats__*`) i korekta dekoracji kart (pojedynczy cień zamiast podwójnej ramki).

- `assets/css/main.min.css`
  - Usunięcie/ograniczenie zduplikowanych skórek kart przy zachowaniu jednego źródła (przeniesienie do `white-prestige.css`).

## 3. PDP & WooCommerce

- `woocommerce/single-product.php`
  - Minimalny wrapper pobierający nowy template `content-single-product.php`.

- `woocommerce/content-single-product.php`
  - Layout 2 kolumny: galeria (sticky desktop) + podsumowanie (`id="bdwp-pdp-summary"`).
  - Sekcje: USP, zakładki, sekcja 4C + link certyfikatu, rekomendacje, sticky CTA (`#bdwpPdpSticky`).
  - Slot grawerunku z komunikatem, wpięte hooki Woo.

- `assets/js/pdp.js`
  - Guard `window.bdwpPdpStickyInit`, IntersectionObserver z sentinelem, fallbacki na brak `IntersectionObserver`.
  - Sterowanie sticky CTA bez migotania, obsługa preferencji redukcji ruchu.

- `assets/css/woo.min.css`
  - Dwukolumnowy grid z sticky mediami (`position: sticky; top: calc(var(--bdwp-header-h) + 1.5rem)` desktop).
  - Ujednolicone przyciski (transparent + złoty outline), styl sekcji 4C, sticky CTA (z @supports dla `backdrop-filter`).
  - Rekomendacje/USP bez podwójnych ramek.

- `inc/woo.php`
  - Nonce (`wp_nonce_field`) dla grawerunku z walidacją (`wp_verify_nonce`, `sanitize_text_field( wp_unslash() )`, limit znaków, `wc_add_notice`).
  - Zapis grawerunku do koszyka i zamówienia po walidacji.
  - Rejestracja danych 4C/certyfikatu (odczyt z meta, fallback) oraz integracja w zakładkach.

- `inc/seo-product.php`
  - Rozszerzenie JSON-LD o `additionalProperty` (4C) i `hasCertification` (URL do certyfikatu), warunek pomijania gdy aktywny Yoast/RankMath.

## 4. Assets & kolejność ładowania

- `inc/assets.php`
  - Kolejność enqueue: `critical-core.css` (preload + inline kluczowych zmiennych/font-face) → `white-prestige.css` → warunkowy `woo.min.css` → `main.min.css`/`blog.min.css`.
  - Warunkowe ładowanie `assets/js/pdp.js` tylko na PDP.
  - Redukcja duplikatów styli (przeniesienie wspólnych komponentów do jednego pliku).

- `assets/css/critical-core.css` / `white-prestige.css`
  - Uporządkowane deklaracje fontów; brak powielania w pozostałych arkuszach.

## 5. Testy / raportowanie

- `POST_RUN.md`
  - Instrukcja Lighthouse Mobile (CWV budżet), scenariusze testów (header scroll, hero łączenie, sticky CTA, grawer E2E, sekcja 4C/certyfikat).
  - Wynik z ostatniego uruchomienia + obserwacje.

- `CHANGES.md`
  - Podsumowanie wdrożonych zmian i ryzyk (np. zależność od meta certyfikatu, dodatkowe obserwatory).

