/* ============================================================
   button-components.js — sirf demo/preview page ke liye
   ============================================================ */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // Buttons ka koi JS behaviour nahi — pure CSS. Yeh file convention ke liye hai.
    document.querySelectorAll('.is-disabled').forEach(function (el) {
      el.addEventListener('click', function (e) {
        e.preventDefault();
      });
    });
  });
})();
