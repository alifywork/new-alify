/* ============================================================
   main.js — Site-wide JavaScript (sab se pehle yahi load karein)
   ------------------------------------------------------------
   - Common helpers + init
   - GSAP/ScrollTrigger ka ready-check (agar load ho to use karein)
   - Bootstrap components auto-init (BS5 data-api se chalte hain)
   ------------------------------------------------------------
   YAAD RAKHNA:
   Har page ki apni JS alag folder mein:
     assets/pages/<page-name>/js/<page-name>.js
   Us page ki file iske BAAD HTML mein load karein.
   Page JS mein apna IIFE/module banayein, idhar sirf shared cheezein.
   ============================================================ */

(function () {
  'use strict';

  /* ---------- Helpers ---------- */
  const $  = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

  /* ---------- Page detect (per-page JS pattern ke liye) ----------
     HTML mein: <body data-page="home">
     Phir assets/pages/home/js/home.js apna kaam karegi.            */
  const currentPage = document.body?.dataset?.page || 'default';

  /* ---------- GSAP ready check ----------
     GSAP files assets/gsap/ se load honi chahiye:
       <script src="assets/gsap/dist/gsap.min.js"></script>
       <script src="assets/gsap/dist/ScrollTrigger.min.js"></script>  */
  function initGsap() {
    if (typeof window.gsap === 'undefined') return false;

    if (window.ScrollTrigger) {
      window.gsap.registerPlugin(window.ScrollTrigger);
    }

    // Yahan site-wide GSAP animations daal sakte ho
    // example:
    // gsap.from('.hero-title', { y: 40, opacity: 0, duration: 1, ease: 'power3.out' });

    return true;
  }

  /* ---------- Mobile nav (agar header mein toggle ho) ----------
     <button class="nav-toggle" data-nav-toggle aria-label="Menu">
     <nav id="primary-nav" class="nav-menu">...</nav>               */
  function initNavToggle() {
    const toggle = $('[data-nav-toggle]');
    const menu   = $('#primary-nav');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => {
      const open = menu.classList.toggle('is-open');
      toggle.classList.toggle('is-active', open);
      toggle.setAttribute('aria-expanded', String(open));
      document.body.classList.toggle('nav-open', open);
    });
  }

  /* ---------- Year in footer ----------
     <span data-year></span>  -> 2026 likh dega                      */
  function initYear() {
    $$('[data-year]').forEach((el) => {
      el.textContent = String(new Date().getFullYear());
    });
  }

  /* ---------- Init ---------- */
  function init() {
    initYear();
    initNavToggle();
    initGsap();

    // Page-specific hook: window.PAGE_INIT agar define ho to chalao
    if (typeof window.PAGE_INIT === 'function') {
      window.PAGE_INIT({ page: currentPage, $, $$ });
    }

    document.documentElement.classList.add('js-ready');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  /* ---------- Expose helpers (page scripts ke liye) ---------- */
  window.Alify = {
    page: currentPage,
    $,
    $$,
    initGsap,
  };
})();
