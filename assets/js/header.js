/* ============================================================
   header.js — Site header behaviour
   ------------------------------------------------------------
   1. Sticky state      -> .is-scrolled (thin height + white bg + sticky logo)
   2. Drawer            -> open/close (6 dots + hamburger), overlay, ESC,
                           focus trap, scroll lock, aria-expanded
   3. Drawer submenus   -> accordion toggle buttons
   ============================================================ */
(function () {
  'use strict';

  document.documentElement.classList.add('alify-js');

  /* ---------------------------------------------------------
     1. STICKY HEADER
     --------------------------------------------------------- */
  var header = document.querySelector('[data-alify-header]');

  if (header) {
    var stuckAt = 10;
    var ticking = false;

    var updateHeader = function () {
      header.classList.toggle('is-scrolled', window.scrollY > stuckAt);
      ticking = false;
    };

    updateHeader();

    window.addEventListener(
      'scroll',
      function () {
        if (!ticking) {
          ticking = true;
          window.requestAnimationFrame(updateHeader);
        }
      },
      { passive: true }
    );
  }

  /* ---------------------------------------------------------
     2. DRAWER
     --------------------------------------------------------- */
  var drawer = document.querySelector('[data-alify-drawer]');

  if (!drawer) {
    return;
  }

  var panel = drawer.querySelector('.alify-drawer__panel');
  var openers = document.querySelectorAll('[data-alify-drawer-open]');
  var closers = drawer.querySelectorAll('[data-alify-drawer-close]');
  var focusablesSelector =
    'a[href], button:not([disabled]), input:not([disabled]), select, textarea, [tabindex]:not([tabindex="-1"])';
  var lastFocused = null;

  function setExpanded(state) {
    openers.forEach(function (btn) {
      btn.setAttribute('aria-expanded', state ? 'true' : 'false');
    });
  }

  function getFocusable() {
    if (!panel) {
      return [];
    }
    return Array.prototype.filter.call(panel.querySelectorAll(focusablesSelector), function (el) {
      return el.offsetParent !== null || el === document.activeElement;
    });
  }

  function openDrawer(trigger) {
    lastFocused = trigger || document.activeElement;
    drawer.classList.add('is-open');
    drawer.setAttribute('aria-hidden', 'false');
    document.body.classList.add('alify-drawer-open');
    setExpanded(true);

    var focusable = getFocusable();
    if (focusable.length) {
      window.setTimeout(function () {
        focusable[0].focus();
      }, 80);
    }
  }

  function closeDrawer() {
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('alify-drawer-open');
    setExpanded(false);

    if (lastFocused && typeof lastFocused.focus === 'function') {
      lastFocused.focus();
    }
  }

  openers.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      event.preventDefault();

      if (drawer.classList.contains('is-open')) {
        closeDrawer();
      } else {
        openDrawer(btn);
      }
    });
  });

  closers.forEach(function (el) {
    el.addEventListener('click', closeDrawer);
  });

  /* Drawer ke andar link click -> band + normal navigation */
  drawer.addEventListener('click', function (event) {
    var link = event.target.closest ? event.target.closest('a[href]') : null;
    if (link && !link.matches('[data-alify-drawer-close]')) {
      closeDrawer();
    }
  });

  /* ESC + focus trap */
  document.addEventListener('keydown', function (event) {
    if (!drawer.classList.contains('is-open')) {
      return;
    }

    if (event.key === 'Escape' || event.key === 'Esc') {
      event.preventDefault();
      closeDrawer();
      return;
    }

    if (event.key !== 'Tab') {
      return;
    }

    var focusable = getFocusable();
    if (!focusable.length) {
      return;
    }

    var first = focusable[0];
    var last = focusable[focusable.length - 1];

    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });

  /* Desktop par aa jayein to drawer band */
  var desktopQuery = window.matchMedia('(min-width: 992px)');
  var onDesktop = function (event) {
    if (event.matches && drawer.classList.contains('is-open')) {
      closeDrawer();
    }
  };

  if (desktopQuery.addEventListener) {
    desktopQuery.addEventListener('change', onDesktop);
  } else if (desktopQuery.addListener) {
    desktopQuery.addListener(onDesktop);
  }

  /* ---------------------------------------------------------
     3. DRAWER SUBMENUS (accordion)
     --------------------------------------------------------- */
  var drawerList = drawer.querySelector('.alify-drawer__list');

  if (drawerList) {
    Array.prototype.forEach.call(drawerList.querySelectorAll('.menu-item-has-children'), function (item) {
      var link = item.querySelector(':scope > a');
      var submenu = item.querySelector(':scope > .sub-menu');

      if (!link || !submenu) {
        return;
      }

      var toggle = document.createElement('button');
      toggle.type = 'button';
      toggle.className = 'alify-drawer__toggle';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Open submenu');
      toggle.innerHTML = '<i class="ph ph-caret-down" aria-hidden="true"></i>';

      link.parentNode.insertBefore(toggle, link.nextSibling);

      toggle.addEventListener('click', function (event) {
        event.preventDefault();
        var isOpen = toggle.getAttribute('aria-expanded') === 'true';

        toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        toggle.setAttribute('aria-label', isOpen ? 'Open submenu' : 'Close submenu');
        submenu.classList.toggle('is-open', !isOpen);
      });
    });
  }
})();
