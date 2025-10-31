// assets/js/pdp.js — sticky gallery + CTA without CLS
(function () {
  if (typeof window === 'undefined' || typeof document === 'undefined') {
    return;
  }

  if (window.bdwpPdpStickyInit) {
    return;
  }

  window.bdwpPdpStickyInit = true;

  const onReady = (cb) => {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', cb, { once: true });
    } else {
      cb();
    }
  };

  onReady(() => {
    const sticky = document.getElementById('bdwpPdpSticky');
    const summary = document.getElementById('bdwp-pdp-summary');

    if (!sticky || !summary) {
      return;
    }

    const body = document.body;
    const sentinel = document.createElement('div');
    sentinel.className = 'bdwp-pdp-sentinel';
    summary.parentNode.insertBefore(sentinel, summary);

    const toggleSticky = (shouldHide) => {
      sticky.hidden = shouldHide;
      sticky.classList.toggle('is-active', !shouldHide);
      body.classList.toggle('bdwp-sticky-visible', !shouldHide);
    };

    toggleSticky(true);

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.target !== sentinel) {
            return;
          }

          if (document.querySelector('.pswp--open, .pswp__bg, .zoomImg')) {
            return;
          }

          window.requestAnimationFrame(() => {
            toggleSticky(entry.isIntersecting);
          });
        });
      }, {
        rootMargin: '0px 0px -35% 0px',
        threshold: 0,
      });

      observer.observe(sentinel);
      window.addEventListener('pagehide', () => observer.disconnect(), { once: true });
    } else {
      const fallback = () => {
        const rect = sentinel.getBoundingClientRect();
        toggleSticky(rect.bottom > 0);
      };

      window.addEventListener('scroll', fallback, { passive: true });
      fallback();
    }

    const stickyPrice = sticky.querySelector('[data-bdwp-sticky-price]');
    const stickyTitle = sticky.querySelector('[data-bdwp-sticky-title]');
    const summaryTitle = summary.querySelector('.product_title');

    if (stickyTitle && summaryTitle) {
      stickyTitle.textContent = summaryTitle.textContent.trim();
    }

    const syncPriceFromSummary = () => {
      if (!stickyPrice) {
        return;
      }

      let source = summary.querySelector('.woocommerce-variation-price .price');
      if (!source || source.textContent.trim() === '') {
        source = summary.querySelector('.price');
      }

      if (source) {
        stickyPrice.innerHTML = source.innerHTML;
      }
    };

    syncPriceFromSummary();

    if ('MutationObserver' in window) {
      const target = summary.querySelector('.summary, .bdwp-single-product__summary-inner') || summary;
      const observer = new MutationObserver(() => {
        window.requestAnimationFrame(syncPriceFromSummary);
      });

      observer.observe(target, {
        childList: true,
        subtree: true,
        characterData: true,
      });

      window.addEventListener('pagehide', () => observer.disconnect(), { once: true });
    }

    if (window.jQuery) {
      const $ = window.jQuery;
      $(document.body).on('found_variation reset_data hide_variation', () => {
        window.requestAnimationFrame(syncPriceFromSummary);
      });
    }

    window.addEventListener('resize', () => {
      window.requestAnimationFrame(syncPriceFromSummary);
    }, { passive: true });

    const summaryForm = summary.querySelector('form.cart');
    const stickySubmit = sticky.querySelector('[data-bdwp-sticky-submit]');

    if (stickySubmit && summaryForm) {
      stickySubmit.addEventListener('click', () => {
        const submitButton = summaryForm.querySelector('.single_add_to_cart_button');

        if (submitButton && submitButton.disabled) {
          summaryForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
          submitButton.focus({ preventScroll: true });
          return;
        }

        if (typeof summaryForm.requestSubmit === 'function') {
          summaryForm.requestSubmit();
          return;
        }

        if (submitButton) {
          submitButton.click();
          return;
        }

        summaryForm.submit();
      });
    }
  });
})();
