(function () {
  'use strict';

  // ── Top-level menu tab switcher (Dinner / Lunch / Brunch on mobile) ──
  var tabButtons = document.querySelectorAll('.vqmenu-mobile-tabs__btn');
  var panes      = document.querySelectorAll('[data-vqmenu-pane]');

  if (tabButtons.length && panes.length) {
    tabButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var targetId = btn.getAttribute('data-vqmenu-tab');
        if (!targetId) return;

        tabButtons.forEach(function (b) {
          var active = (b === btn);
          b.classList.toggle('is-active', active);
          b.setAttribute('aria-selected', active ? 'true' : 'false');
        });

        panes.forEach(function (pane) {
          var show = (pane.id === targetId);
          pane.classList.toggle('is-active', show);
          if (show) {
            pane.removeAttribute('hidden');
          } else {
            pane.setAttribute('hidden', '');
          }
        });

        // Recompute scroll indicators for the newly visible section nav.
        var navList = document.querySelector('#' + cssEscape(targetId) + ' .vqmenu-mobile-nav__list');
        if (navList && navList._vqUpdateIndicators) navList._vqUpdateIndicators();
      });
    });
  }

  // ── Per-pane section navs ───────────────────────────────────────────
  var navs = document.querySelectorAll('.vqmenu-mobile-nav__list');
  if (!navs.length) return;

  navs.forEach(initNav);

  function initNav(nav) {
    var links = nav.querySelectorAll('.vqmenu-mobile-nav__link');
    if (!links.length) return;

    var navBar = nav.closest('.vqmenu-mobile-nav');
    var navHeight = navBar ? navBar.offsetHeight : 56;
    var isScrolling = false;

    // ── Scroll-fade indicators on the nav bar ────────────────────────
    function updateScrollIndicators() {
      if (!navBar) return;
      var scrollLeft = nav.scrollLeft;
      var maxScroll  = nav.scrollWidth - nav.clientWidth;
      navBar.classList.toggle('can-scroll-left',  scrollLeft > 2);
      navBar.classList.toggle('can-scroll-right', scrollLeft < maxScroll - 2);
    }
    nav._vqUpdateIndicators = updateScrollIndicators;

    nav.addEventListener('scroll', updateScrollIndicators, { passive: true });
    window.addEventListener('resize', updateScrollIndicators);
    updateScrollIndicators();

    // ── Click handler: smooth-scroll to section ──────────────────────
    links.forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        var id = link.getAttribute('data-section');
        var target = document.getElementById(id);
        if (!target) return;

        isScrolling = true;
        setActive(link);

        var top = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 12;
        window.scrollTo({ top: top, behavior: 'smooth' });
        setTimeout(function () { isScrolling = false; }, 800);
      });
    });

    // ── Intersection Observer: highlight active nav pill on scroll ───
    var sections = [];
    links.forEach(function (link) {
      var id = link.getAttribute('data-section');
      var el = document.getElementById(id);
      if (el) sections.push({ el: el, link: link });
    });

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        if (isScrolling) return;
        var visible = [];
        entries.forEach(function (entry) {
          if (entry.isIntersecting) visible.push(entry);
        });
        if (!visible.length) return;
        visible.sort(function (a, b) {
          return a.boundingClientRect.top - b.boundingClientRect.top;
        });
        var topId = visible[0].target.id;
        sections.forEach(function (s) {
          if (s.el.id === topId) setActive(s.link);
        });
      }, {
        rootMargin: '-' + (navHeight + 16) + 'px 0px -60% 0px',
        threshold: 0
      });
      sections.forEach(function (s) { observer.observe(s.el); });
    }

    function setActive(activeLink) {
      links.forEach(function (l) { l.classList.remove('is-active'); });
      activeLink.classList.add('is-active');
      scrollNavToLink(activeLink);
    }

    function scrollNavToLink(link) {
      if (!navBar) return;
      var list = nav;
      var offset = link.offsetLeft - (list.clientWidth / 2) + (link.offsetWidth / 2);
      list.scrollTo({ left: offset, behavior: 'smooth' });
    }
  }

  function cssEscape(str) {
    return (window.CSS && CSS.escape) ? CSS.escape(str) : str.replace(/([^a-zA-Z0-9_-])/g, '\\$1');
  }
})();
