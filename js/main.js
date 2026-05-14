/* Main JS file for custom JS */

/* ============================================================
   HEADER GS — Comportements interactifs
   Maquette source : proposal-header-interactive-2026-05.html
   Mai 2026 — JS natif, pas de jQuery
============================================================ */
document.addEventListener('DOMContentLoaded', function () {

  // ─── Références DOM ───────────────────────────────────────
  var navBar               = document.getElementById('gs-nav-bar');
  var bttBtn               = document.getElementById('back-to-top');
  var siteFooter           = document.querySelector('footer');
  var mobileOverlay        = document.getElementById('gs-mobile-overlay');
  var hamburgerBtn         = document.getElementById('gs-hamburger-btn');
  var closeBtn             = document.getElementById('gs-close-btn');

  // Search desktop
  var searchIconBtn        = document.getElementById('gs-search-icon-btn');
  var navDesktopInner      = document.getElementById('gs-nav-desktop-inner');
  var searchOverlayDt      = document.getElementById('gs-search-overlay-desktop');
  var searchOverlayInput   = document.getElementById('gs-search-overlay-input');
  var searchOverlayClose   = document.getElementById('gs-search-overlay-close');

  // Search mobile
  var searchIconBtnMobile  = document.getElementById('gs-search-icon-btn-mobile');
  var navMobileInner       = document.getElementById('gs-nav-mobile-inner');
  var searchOverlayMobile  = document.getElementById('gs-search-overlay-mobile');
  var searchOverlayMobInp  = document.getElementById('gs-search-overlay-mobile-input');
  var searchOverlayMobClose= document.getElementById('gs-search-overlay-mobile-close');

  // État interne
  var menuOpen        = false;
  var searchOpen      = false;
  var searchMobOpen   = false;

  // ─── Effet scroll : nav + back-to-top ────────────────────
  function gs_onScroll() {
    var scrollY = window.scrollY;

    // Nav : passe en bleu nuit + liseré rouge après 40px
    if (navBar) {
      if (scrollY > 40) {
        navBar.classList.add('is-scrolled');
      } else {
        navBar.classList.remove('is-scrolled');
      }
    }

    // Back-to-top : visible entre 300px et le footer
    if (bttBtn) {
      var showBtn  = scrollY > 300;
      var hideAtFooter = false;

      if (showBtn && siteFooter) {
        // Se cache quand le bas de la fenêtre atteint le haut du footer
        var footerTop   = siteFooter.getBoundingClientRect().top + scrollY;
        var windowBottom = scrollY + window.innerHeight;
        hideAtFooter = windowBottom >= footerTop;
      }

      if (showBtn && !hideAtFooter) {
        bttBtn.classList.add('is-visible');
      } else {
        bttBtn.classList.remove('is-visible');
      }
    }
  }

  window.addEventListener('scroll', gs_onScroll, { passive: true });

  // ─── Back-to-top : click ─────────────────────────────────
  if (bttBtn) {
    bttBtn.addEventListener('click', function () {
      var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      window.scrollTo({
        top: 0,
        behavior: prefersReduced ? 'instant' : 'smooth',
      });
    });
  }

  // ─── Menu mobile : ouverture ───────────────────────────────
  // Ouvre l'overlay plein écran, piège le focus à l'intérieur
  function gs_openMobileMenu() {
    if (!mobileOverlay || !hamburgerBtn) return;
    menuOpen = true;
    mobileOverlay.classList.add('is-open');
    mobileOverlay.setAttribute('aria-hidden', 'false');
    hamburgerBtn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden'; // bloquer le scroll du body

    // Focus trap : au premier rendu, on place le focus sur la croix
    setTimeout(function () {
      if (closeBtn) closeBtn.focus();
    }, 50);
  }

  // ─── Menu mobile : fermeture ──────────────────────────────
  // Retourne le focus au bouton hamburger pour le SR
  function gs_closeMobileMenu() {
    if (!mobileOverlay) return;
    menuOpen = false;
    mobileOverlay.classList.remove('is-open');
    mobileOverlay.setAttribute('aria-hidden', 'true');
    if (hamburgerBtn) {
      hamburgerBtn.setAttribute('aria-expanded', 'false');
      hamburgerBtn.focus(); // retour focus au déclencheur
    }
    document.body.style.overflow = '';
  }

  // ─── Focus trap dans l'overlay mobile ────────────────────
  // Empêche Tab de sortir de la modale pendant qu'elle est ouverte
  function gs_trapFocus(e) {
    if (!menuOpen || !mobileOverlay) return;

    var focusable = mobileOverlay.querySelectorAll(
      'a[href], button:not([disabled]), input, [tabindex]:not([tabindex="-1"])'
    );
    if (focusable.length === 0) return;

    var first = focusable[0];
    var last  = focusable[focusable.length - 1];

    if (e.key === 'Tab') {
      if (e.shiftKey) {
        // Shift+Tab depuis le premier : sauter au dernier
        if (document.activeElement === first) {
          e.preventDefault();
          last.focus();
        }
      } else {
        // Tab depuis le dernier : sauter au premier
        if (document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    }
  }

  // ─── Search desktop : ouverture ──────────────────────────
  // Masque les liens nav, affiche la barre de recherche
  function gs_openSearchDesktop() {
    if (!searchOverlayDt) return;
    searchOpen = true;
    if (navDesktopInner) navDesktopInner.classList.add('search-open');
    searchOverlayDt.classList.add('is-open');
    searchOverlayDt.setAttribute('aria-hidden', 'false');
    if (searchIconBtn) searchIconBtn.setAttribute('aria-expanded', 'true');
    // Délai = durée de la transition CSS (250ms)
    setTimeout(function () {
      if (searchOverlayInput) searchOverlayInput.focus();
    }, 260);
  }

  // ─── Search desktop : fermeture ──────────────────────────
  function gs_closeSearchDesktop() {
    if (!searchOpen || !searchOverlayDt) return;
    searchOpen = false;
    if (navDesktopInner) navDesktopInner.classList.remove('search-open');
    searchOverlayDt.classList.remove('is-open');
    searchOverlayDt.setAttribute('aria-hidden', 'true');
    if (searchIconBtn) searchIconBtn.setAttribute('aria-expanded', 'false');
    if (navBar) navBar.classList.remove('search-focus');
    if (searchOverlayInput) searchOverlayInput.value = '';
  }

  // ─── Search mobile : ouverture ───────────────────────────
  function gs_openSearchMobile() {
    if (!searchOverlayMobile) return;
    searchMobOpen = true;
    if (navMobileInner) navMobileInner.classList.add('search-open');
    searchOverlayMobile.classList.add('is-open');
    searchOverlayMobile.setAttribute('aria-hidden', 'false');
    if (searchIconBtnMobile) searchIconBtnMobile.setAttribute('aria-expanded', 'true');
    setTimeout(function () {
      if (searchOverlayMobInp) searchOverlayMobInp.focus();
    }, 260);
  }

  // ─── Search mobile : fermeture ───────────────────────────
  function gs_closeSearchMobile() {
    if (!searchMobOpen || !searchOverlayMobile) return;
    searchMobOpen = false;
    if (navMobileInner) navMobileInner.classList.remove('search-open');
    searchOverlayMobile.classList.remove('is-open');
    searchOverlayMobile.setAttribute('aria-hidden', 'true');
    if (searchIconBtnMobile) searchIconBtnMobile.setAttribute('aria-expanded', 'false');
    if (navBar) navBar.classList.remove('search-focus');
    if (searchOverlayMobInp) searchOverlayMobInp.value = '';
  }

  // ─── Listeners : hamburger ────────────────────────────────
  if (hamburgerBtn) {
    hamburgerBtn.addEventListener('click', gs_openMobileMenu);
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', gs_closeMobileMenu);
  }

  // Fermeture overlay si on clique sur un lien du menu mobile
  if (mobileOverlay) {
    mobileOverlay.querySelectorAll('.gs-mobile-overlay__nav a').forEach(function (link) {
      link.addEventListener('click', gs_closeMobileMenu);
    });
  }

  // ─── Listeners : search desktop ──────────────────────────
  if (searchIconBtn) {
    searchIconBtn.addEventListener('click', gs_openSearchDesktop);
  }

  if (searchOverlayClose) {
    searchOverlayClose.addEventListener('click', function () {
      gs_closeSearchDesktop();
      if (searchIconBtn) searchIconBtn.focus();
    });
  }

  // Liseré rouge sur la barre quand l'input est actif
  if (searchOverlayInput) {
    searchOverlayInput.addEventListener('focus', function () {
      if (navBar) navBar.classList.add('search-focus');
    });
    searchOverlayInput.addEventListener('blur', function () {
      if (navBar) navBar.classList.remove('search-focus');
    });
  }

  // ─── Listeners : search mobile ───────────────────────────
  if (searchIconBtnMobile) {
    searchIconBtnMobile.addEventListener('click', gs_openSearchMobile);
  }

  if (searchOverlayMobClose) {
    searchOverlayMobClose.addEventListener('click', function () {
      gs_closeSearchMobile();
      if (searchIconBtnMobile) searchIconBtnMobile.focus();
    });
  }

  if (searchOverlayMobInp) {
    searchOverlayMobInp.addEventListener('focus', function () {
      if (navBar) navBar.classList.add('search-focus');
    });
    searchOverlayMobInp.addEventListener('blur', function () {
      if (navBar) navBar.classList.remove('search-focus');
    });
  }

  // ─── Escape : ferme search ou menu mobile ─────────────────
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;

    if (searchOpen) {
      gs_closeSearchDesktop();
      if (searchIconBtn) searchIconBtn.focus();
    } else if (searchMobOpen) {
      gs_closeSearchMobile();
      if (searchIconBtnMobile) searchIconBtnMobile.focus();
    } else if (menuOpen) {
      gs_closeMobileMenu();
    }
  });

  // ─── Focus trap (Tab piégé dans l'overlay mobile) ─────────
  document.addEventListener('keydown', gs_trapFocus);

}); // fin DOMContentLoaded
