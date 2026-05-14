(function () {
  'use strict';

  var COOKIE_NAME = 'gs_consent';
  var COOKIE_DAYS = 395; // 13 mois (recommandation CNIL)

  function gs_getCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : null;
  }

  function gs_setCookie(name, value, days) {
    var expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/; SameSite=Lax';
  }

  function gs_pushConsent(granted) {
    var state = granted ? 'granted' : 'denied';
    window.gtag('consent', 'update', {
      'analytics_storage':   state,
      'ad_storage':          state,
      'ad_user_data':        state,
      'ad_personalization':  state
    });
  }

  function gs_showModal() {
    var modal = document.getElementById('gs-consent');
    if (!modal) return;
    modal.style.display = 'flex';
    modal.removeAttribute('aria-hidden');
    var firstBtn = modal.querySelector('button');
    if (firstBtn) firstBtn.focus();
  }

  function gs_hideModal() {
    var modal = document.getElementById('gs-consent');
    if (!modal) return;
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden', 'true');
  }

  function gs_accept() {
    gs_setCookie(COOKIE_NAME, 'granted', COOKIE_DAYS);
    gs_pushConsent(true);
    gs_hideModal();
  }

  function gs_refuse() {
    gs_setCookie(COOKIE_NAME, 'denied', COOKIE_DAYS);
    gs_pushConsent(false);
    gs_hideModal();
  }

  document.addEventListener('DOMContentLoaded', function () {
    var consent = gs_getCookie(COOKIE_NAME);

    if (consent === 'granted') {
      gs_pushConsent(true);
    } else if (consent === null) {
      gs_showModal();
    }
    // Si 'denied' : GTM reste en mode refusé, pas d'action

    var btnAccept = document.getElementById('gs-consent-accept');
    var btnRefuse = document.getElementById('gs-consent-refuse');
    var btnRevoke = document.getElementById('gs-consent-revoke');

    if (btnAccept) btnAccept.addEventListener('click', gs_accept);
    if (btnRefuse) btnRefuse.addEventListener('click', gs_refuse);
    if (btnRevoke) btnRevoke.addEventListener('click', function (e) {
      e.preventDefault();
      gs_showModal();
    });
  });
})();
