(function () {
  'use strict';

  var nav = document.getElementById('vqmenuMobileNav');
  if (!nav) return;

  var links = nav.querySelectorAll('.vqmenu-mobile-nav__link');
  if (!links.length) return;

  var navBar = nav.closest('.vqmenu-mobile-nav');
  var navHeight = navBar ? navBar.offsetHeight : 56;
  var isScrolling = false;

  // ── Scroll-fade indicators on the nav bar ────────────────────────────
  function updateScrollIndicators() {
    if (!navBar) return;
    var scrollLeft = nav.scrollLeft;
    var maxScroll  = nav.scrollWidth - nav.clientWidth;

    navBar.classList.toggle('can-scroll-left',  scrollLeft > 2);
    navBar.classList.toggle('can-scroll-right', scrollLeft < maxScroll - 2);
  }

  nav.addEventListener('scroll', updateScrollIndicators, { passive: true });
  window.addEventListener('resize', updateScrollIndicators);
  // Run once on load (the right fade should appear immediately)
  updateScrollIndicators();

  // ── Click handler: smooth-scroll to section ──────────────────────────
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

      // Release lock after scroll settles
      setTimeout(function () { isScrolling = false; }, 800);
    });
  });

  // ── Intersection Observer: highlight active nav pill on scroll ───────
  var sections = [];
  links.forEach(function (link) {
    var id = link.getAttribute('data-section');
    var el = document.getElementById(id);
    if (el) sections.push({ el: el, link: link });
  });

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      if (isScrolling) return;

      // Find the topmost visible section
      var visible = [];
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          visible.push(entry);
        }
      });

      if (!visible.length) return;

      // Pick section closest to top of viewport
      visible.sort(function (a, b) {
        return a.boundingClientRect.top - b.boundingClientRect.top;
      });

      var topId = visible[0].target.id;
      sections.forEach(function (s) {
        if (s.el.id === topId) {
          setActive(s.link);
        }
      });
    }, {
      rootMargin: '-' + (navHeight + 16) + 'px 0px -60% 0px',
      threshold: 0
    });

    sections.forEach(function (s) { observer.observe(s.el); });
  }

  // ── Helpers ──────────────────────────────────────────────────────────
  function setActive(activeLink) {
    links.forEach(function (l) { l.classList.remove('is-active'); });
    activeLink.classList.add('is-active');
    scrollNavToLink(activeLink);
  }

  function scrollNavToLink(link) {
    if (!navBar) return;
    var list = nav;
    var linkRect = link.getBoundingClientRect();
    var listRect = list.getBoundingClientRect();

    // Centre the pill in the visible nav area
    var offset = link.offsetLeft - (list.clientWidth / 2) + (link.offsetWidth / 2);
    list.scrollTo({ left: offset, behavior: 'smooth' });
  }
})();
