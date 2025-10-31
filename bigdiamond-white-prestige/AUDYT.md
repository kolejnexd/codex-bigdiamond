# AUDYT — BigDIAMOND White Prestige

## Header & nawigacja
- **Brak rezerwy miejsca na sticky header** – `white-prestige.css` wyzerowuje `padding-top` na `body` i oczekuje klasy `.is-scrolled` na korzeniu, ale `header.js` przełącza stan na `.bdwp-header`. Efekt: nagłówek nachodzi na hero i powstaje CLS przy późniejszym dodaniu odstępu.

```3326:3328:/assets/css/white-prestige.css
body{ padding-top: 0 !important; }
body.is-scrolled{ padding-top: var(--bdwp-header-h) !important; }
```

```219:220:/assets/js/header.js
header.classList.toggle('is-scrolled', (window.scrollY || window.pageYOffset) > 10);
```

  *Rekomendacja:* przenieść klasę offsetu na `document.body` (np. `body.classList.toggle('is-scrolled', …)`), albo wprowadzić placeholder/`padding-top` sterowany zmienną CSS, tak by wysokość nagłówka była zarezerwowana jeszcze przed przewinięciem.

- **Podwójna linia pod nagłówkiem** – jednoczesne `border-bottom` i pseudo-element `::after` generują dwa równoległe paski.

```240:268:/assets/css/white-prestige.css
.site-header {
        ...
        border-bottom: 1px solid rgba(212, 175, 55, 0.18);
}
.site-header::after {
        ...
        background: linear-gradient(90deg, rgba(0, 0, 0, 0) 0%, var(--gold) 35%, var(--gold) 65%, rgba(0, 0, 0, 0) 100%);
}
```

  *Rekomendacja:* pozostawić tylko jedną dekorację (np. gradient jako `border-image` lub `box-shadow`) aby uniknąć „podwójnej ramki”.

- **Brak guardu przed podwójną inicjalizacją** – w przeciwieństwie do `pdp.js`, plik `header.js` nie ustawia flagi w `window`. W podglądzie w Customizerze lub przy hot-reloadzie event listenery są dublowane.

```9:20:/assets/js/header.js
(() => {
  'use strict';
  const $  = (s, c = document) => c.querySelector(s);
```

  *Rekomendacja:* dodać na początku skryptu blok `if (window.bdwpHeaderInit) return; window.bdwpHeaderInit = true;` zgodnie z wymaganiem guardu.

- **Atrybut ARIA logo bez sanitacji** – `aria-label` dla linku logo używa `bloginfo()` bez `esc_attr`, co pozwala na wstrzyknięcie znaków specjalnych w panelu WP.

```28:35:/header.php
<a class="bdwp-header__logo-link" href="<?= esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo('name'); ?>">
```

  *Rekomendacja:* zastąpić `bloginfo()` wersją `esc_attr( get_bloginfo( 'name', 'display' ) )`.

## Hero & bridge
- **Niespójne klasy siatki kategorii** – szablon generuje klasy `bdwp-bridge-cats__…`, natomiast CSS styluje `bdwp-hero-cats__…`. Karty pozostają bez docelowego wyglądu i pojawiają się „białe prostokąty”.

```48:60:/template-parts/hero.php
    <ul class="bdwp-bridge-cats__grid">
      ...
        <a class="bdwp-bridge-cats__card" ...>
```

```3218:3235:/assets/css/white-prestige.css
.bdwp-hero-cats__grid{ ... }
.bdwp-hero-cats__card{ background:#fff; box-shadow: 0 18px 40px rgba(0,0,0,.10); }
```

  *Rekomendacja:* ujednolicić nazewnictwo (najlepiej `bdwp-hero-cats__*`) albo dodać równoległe reguły dla wariantu `bdwp-bridge-cats__*`.

- **Brak obsługi błędu `get_terms`** – przy pustej taksonomii `get_terms()` może zwrócić `WP_Error`, który następnie jest iterowany.

```12:19:/template-parts/hero.php
$top_cats = get_terms([
  'taxonomy'   => 'product_cat',
  ...
]);
```

  *Rekomendacja:* po wywołaniu dodać `if ( is_wp_error( $top_cats ) ) { $top_cats = []; }` oraz fallbackową listę linków.

- **Podwójne ramki na kartach sekcji (border + cień)** – w `main.min.css` nadal funkcjonuje kombinacja `border` + `box-shadow`, która daje efekt „podwójnej ramki”.

```72:88:/assets/css/main.min.css
.expertise__card{background:#fafafa;border:1px solid #e9e9e9;...;box-shadow:0 18px 40px rgba(10,10,10,.04);}
```

  *Rekomendacja:* zastąpić `border` efektem inset (`box-shadow: inset …`) albo pozostawić samo delikatne `box-shadow`.

## PDP & WooCommerce
- **Skrypt sticky panelu nie ma do czego się podpiąć** – `pdp.js` szuka elementów `#bdwpPdpSticky` i `#bdwp-pdp-summary`, których nie ma w szablonie produktu. Skrypt przerywa działanie w 9. wierszu.

```7:15:/assets/js/pdp.js
const sticky  = document.getElementById('bdwpPdpSticky');
const summary = document.getElementById('bdwp-pdp-summary');
if (!sticky || !summary) return;
```

```31:66:/woocommerce/single-product.php
<div class="bdwp-single-product__summary">
  ...
</div>
```

  *Rekomendacja:* nadać wymagane identyfikatory w markup (`id="bdwp-pdp-summary"`, wrapper sticky), a następnie rozwinąć layout w trybie dwukolumnowym (`media` sticky + `summary`).

- **`pdp.js` w ogóle nie jest ładowany** – `inc/assets.php` enqueue’uje jedynie `header.js` i opcjonalny `main.js`. Skrypt PDP nie dociera na stronę produktu.

```91:119:/inc/assets.php
if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $header_js_rel) ) {
    wp_enqueue_script('bdwp-header', ...);
}
// brak rejestracji assets/js/pdp.js
```

  *Rekomendacja:* dodać rejestrację `pdp.js` warunkowo dla `is_product()`.

- **Galeria produktu nie jest klejona** – `woo.min.css` zawiera siatkę 2×1, ale brakuje `position: sticky` na kolumnie z mediami i wyrównania wysokości do nagłówka.

```37:46:/assets/css/woo.min.css
.bdwp-single-product{
  display:grid!important;grid-template-columns:minmax(0,1fr) minmax(0,1fr)!important;
  ...
}
.bdwp-single-product__gallery{...padding:1.5rem;}
```

  *Rekomendacja:* rozszerzyć reguły o `position: sticky; top: calc(var(--bdwp-header-h) + 1.5rem);` i ustawić wspólne `gap`/`max-width` zgodnie z wymaganym layoutem.

- **Grawerunek bez zabezpieczeń** – pole formularza nie posiada nonce, wartości są pobierane bez `wp_unslash`, a brak walidacji powoduje ciche przycięcie tekstu.

```409:458:/functions.php
echo '<fieldset class="bdwp-engraving-field">';
...
if ( isset( $_POST['bdwp_engraving_text'] ) && ! empty( $_POST['bdwp_engraving_text'] ) ) {
    $engraving_text = sanitize_text_field( $_POST['bdwp_engraving_text'] );
    $cart_item_data['bdwp_engraving'] = substr( $engraving_text, 0, 30 );
}
```

  *Rekomendacja:* dodać nonce i walidację (`wp_verify_nonce`, `wp_unslash`), komunikat o błędzie przy przekroczeniu limitu oraz zapis do meta zamówienia w oparciu o oczyszczone dane.

- **Brak sticky CTA / rekomendacji** – w szablonie produktu nie ma bloku sticky CTA, sekcji 4C ani miksu rekomendacji opisanego w wymaganiach (np. brak dedykowanych hooków na certyfikat GIA/IGI).

## Assets & wydajność
- **Brak wczytania krytycznego CSS** – `inc/assets.php` ładuje tylko `white-prestige.css`; `critical-core.css` oraz dedykowane style blog/woo nie są uporządkowane wg priorytetów CWV.

```41:74:/inc/assets.php
$main_css_rel = '/assets/css/white-prestige.css';
if ( file_exists(...) ) {
    wp_enqueue_style('bdwp-white-prestige', ...);
}
```

  *Rekomendacja:* zarejestrować `critical-core.css` jako preload/inline, ustawić kolejność: critical → white-prestige → sekcje warunkowe.

- **Powielone deklaracje komponentów** – zarówno `main.min.css`, jak i `white-prestige.css` zawierają pełne skiny przycisków i kart, co zwiększa transfer i komplikuje utrzymanie.

```35:52:/assets/css/main.min.css
.btn,.bdwp-button,... { ... }
```

```1155:1251:/assets/css/white-prestige.css
.btn,
.bdwp-button,
.btn-cta,
.hero__cta { ... }
```

  *Rekomendacja:* pozostawić jeden zestaw bazowy (np. w `white-prestige.css`) i usunąć dublujące się sekcje z `main.min.css`.

## SEO & dane strukturalne
- **Schema Product bez danych 4C i linku do certyfikatu** – obecny JSON-LD nie uwzględnia wymaganych właściwości (`additionalProperty`, `hasCertification`).

```45:115:/inc/seo-product.php
$schema = array(
    '@type'       => 'Product',
    ...
    'offers'      => array(
        '@type' => 'Offer',
        ...
    ),
);
```

  *Rekomendacja:* rozszerzyć strukturę o `additionalProperty` (4C), `isAccessoryOrSparePartFor`/`hasCertification` z linkiem do GIA/IGI oraz `url` oferty zgodnie z wymaganiami.

