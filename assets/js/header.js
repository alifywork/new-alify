/* ============================================================
   header.js — Site header behaviour
   ------------------------------------------------------------
   1. Sticky state   -> .is-scrolled (thin height + white bg + sticky logo)
   2. Drawers        -> do alag panels:
                         6 dots   -> #alify-drawer-about  (About Alify)
                         hamburger-> #alify-drawer-menu   (saare pages)
                        open/close, overlay, ESC, focus trap, scroll lock
   3. Submenus       -> menu drawer ke andar accordion toggles
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
     2. DRAWERS (multiple)
     --------------------------------------------------------- */
  var drawers = Array.prototype.slice.call(document.querySelectorAll('[data-alify-drawer]'));

  if (!drawers.length) {
    return;
  }

  var triggers = Array.prototype.slice.call(document.querySelectorAll('[data-alify-drawer-open]'));
  var activeDrawer = null;
  var lastTrigger = null;
  var focusablesSelector =
    'a[href], button:not([disabled]), input:not([disabled]), select, textarea, [tabindex]:not([tabindex="-1"])';

  var getPanel = function (drawer) {
    return drawer.querySelector('.alify-drawer__panel');
  };

  var getFocusable = function (drawer) {
    var panel = getPanel(drawer);
    if (!panel) {
      return [];
    }
    return Array.prototype.filter.call(panel.querySelectorAll(focusablesSelector), function (el) {
      return el.offsetParent !== null;
    });
  };

  var syncTriggers = function () {
    triggers.forEach(function (btn) {
      var target = btn.getAttribute('aria-controls');
      var isOpen = activeDrawer && activeDrawer.id === target;
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  };

  var openDrawer = function (drawer, trigger) {
    // doosra drawer khula ho to pehle band karo
    if (activeDrawer && activeDrawer !== drawer) {
      closeDrawer(activeDrawer, false);
    }

    drawer.classList.add('is-open');
    drawer.setAttribute('aria-hidden', 'false');
    document.body.classList.add('alify-drawer-open');

    activeDrawer = drawer;
    lastTrigger = trigger || document.activeElement;
    syncTriggers();

    var focusable = getFocusable(drawer);
    if (focusable.length) {
      window.setTimeout(function () {
        focusable[0].focus();
      }, 80);
    }
  };

  var closeDrawer = function (drawer, restoreFocus) {
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');

    if (activeDrawer === drawer) {
      activeDrawer = null;
    }

    if (!activeDrawer) {
      document.body.classList.remove('alify-drawer-open');
    }

    if (restoreFocus !== false && lastTrigger && typeof lastTrigger.focus === 'function') {
      lastTrigger.focus();
    }

    syncTriggers();
  };

  triggers.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      event.preventDefault();

      var name = btn.getAttribute('data-alify-drawer-open') || 'menu';
      var drawer = null;

      drawers.forEach(function (d) {
        if (d.getAttribute('data-alify-drawer') === name) {
          drawer = d;
        }
      });

      if (!drawer) {
        return;
      }

      if (drawer.classList.contains('is-open')) {
        closeDrawer(drawer, true);
      } else {
        openDrawer(drawer, btn);
      }
    });
  });

  drawers.forEach(function (drawer) {
    /* overlay / close button */
    Array.prototype.forEach.call(drawer.querySelectorAll('[data-alify-drawer-close]'), function (el) {
      el.addEventListener('click', function () {
        closeDrawer(drawer, true);
      });
    });

    /* andar link click -> band + normal navigation */
    drawer.addEventListener('click', function (event) {
      var link = event.target.closest ? event.target.closest('a[href]') : null;
      if (link) {
        closeDrawer(drawer, false);
      }
    });
  });

  /* ESC + focus trap (sirf khule drawer ke andar) */
  document.addEventListener('keydown', function (event) {
    if (!activeDrawer) {
      return;
    }

    if (event.key === 'Escape' || event.key === 'Esc') {
      event.preventDefault();
      closeDrawer(activeDrawer, true);
      return;
    }

    if (event.key !== 'Tab') {
      return;
    }

    var focusable = getFocusable(activeDrawer);
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

  /* Desktop par aa jayein to menu drawer band (about drawer desktop ka hai) */
  var desktopQuery = window.matchMedia('(min-width: 992px)');
  var onDesktop = function (event) {
    if (!event.matches) {
      return;
    }
    drawers.forEach(function (drawer) {
      if (drawer.classList.contains('is-open') && drawer.getAttribute('data-alify-drawer') === 'menu') {
        closeDrawer(drawer, false);
      }
    });
  };

  if (desktopQuery.addEventListener) {
    desktopQuery.addEventListener('change', onDesktop);
  } else if (desktopQuery.addListener) {
    desktopQuery.addListener(onDesktop);
  }

  /* ---------------------------------------------------------
     3. SUBMENUS (menu drawer ke andar accordion)
     --------------------------------------------------------- */
  drawers.forEach(function (drawer) {
    var list = drawer.querySelector('.alify-drawer__list');

    if (!list) {
      return;
    }

    Array.prototype.forEach.call(list.querySelectorAll('.menu-item-has-children'), function (item) {
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
  });
})();
