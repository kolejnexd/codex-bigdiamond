# CHANGES

- **Header & Nawigacja (`assets/js/header.js`, `assets/css/white-prestige.css`, `header.php`)** – dodano focus trap, blokadę scrolla i jednolite atrybuty ARIA; w CSS stała rezerwa pod headerem oraz jedna dekoracja (box-shadow) eliminująca CLS i podwójne linie.
- **Hero & Bridge (`template-parts/hero.php`, `assets/css/white-prestige.css`, `assets/css/main.min.css`)** – ujednolicone klasy `bdwp-hero-cats__*`, obsłużone błędy `get_terms()`, karty z pojedynczym złotym ringiem (bez border+shadow).
- **PDP Layout (`woocommerce/single-product.php`, `woocommerce/content-single-product.php`, `assets/css/woo.min.css`, `assets/js/pdp.js`)** – wdrożono grid 2-kolumnowy z sticky mediami i CTA, przeprojektowano sticky bar z fallbackiem bez `backdrop-filter`, transparentne przyciski ze złotym obrysem.
- **Grawer & 4C (`inc/woo.php`)** – zabezpieczony nonce + walidacja, zapis grawerunku do koszyka/zamówień, sekcja 4C i link certyfikatu (także w zakładce Woo i sticky CTA).
- **SEO Schema (`inc/seo-product.php`)** – JSON-LD wzbogacony o `additionalProperty` (4C) i `hasCertification`, z guardem na aktywne Yoast/RankMath.
- **Assets (`inc/assets.php`)** – przebudowana kolejność enqueue (critical inline → white-prestige → woo → main/blog), warunkowy `pdp.js`, porządek CSS bez duplikatów.
- **Testy (`POST_RUN.md`)** – instrukcje Lighthouse Mobile, scenariusze manualne (header, hero, PDP, grawer, JSON-LD); wyniki do uzupełnienia po uruchomieniu w przeglądarce.

**Ryzyka:**
- Wydłużony `critical-core.css` inline – przy aktualizacjach należy pamiętać o spójności z plikiem źródłowym.
- Sticky CTA opiera się na domyślnym formularzu Woo (`form.cart`); niestandardowe pluginy edytujące markup mogą wymagać dostosowań.
- Sekcja 4C i certyfikat bazują na meta `_bdwp_4c_*` oraz `_bdwp_certificate_url`; brak danych skutkuje komunikatem informacyjnym (bez błędów).
