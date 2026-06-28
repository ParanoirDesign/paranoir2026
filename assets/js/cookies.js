(function () {
  const GA_ID = 'G-7YTZZHZ0XB';
  const KEY   = 'cookie_consent'; // 'accepted' | 'refused' | null

  // ── GA4 loader ────────────────────────────────────────────────
  function loadGA4() {
    if (document.getElementById('ga4-script')) return;
    const s = document.createElement('script');
    s.id  = 'ga4-script';
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
    s.async = true;
    document.head.appendChild(s);
    window.dataLayer = window.dataLayer || [];
    function gtag(){ window.dataLayer.push(arguments); }
    window.gtag = gtag;
    gtag('js', new Date());
    gtag('config', GA_ID, { anonymize_ip: true });
  }

  function removeGA4() {
    // Efface les cookies GA déjà déposés
    ['_ga', '_gid', '_gat', '_ga_' + GA_ID.replace('G-','')].forEach(function(name) {
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;domain=.' + location.hostname;
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
    });
  }

  // ── Bandeau HTML ──────────────────────────────────────────────
  var BANNER_CSS = `
    #cookie-banner{
      position:fixed;bottom:20px;left:50%;transform:translateX(-50%);
      z-index:9999;width:min(calc(100% - 32px),560px);
      background:#fffaf2;
      border:1px solid rgba(25,18,16,.12);
      border-radius:20px;
      box-shadow:0 16px 56px rgba(25,18,16,.14),inset 0 1px 0 rgba(255,255,255,.9);
      padding:20px 24px;
      font-family:'Poppins',system-ui,sans-serif;
      display:flex;flex-direction:column;gap:14px;
      animation:cb-in .3s ease;
    }
    @keyframes cb-in{from{opacity:0;transform:translateX(-50%) translateY(12px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}
    #cookie-banner.cb-out{animation:cb-out .25s ease forwards}
    @keyframes cb-out{to{opacity:0;transform:translateX(-50%) translateY(12px)}}
    #cookie-banner p{margin:0;font-size:13.5px;line-height:1.65;color:rgba(25,18,16,.72)}
    #cookie-banner a{color:#b11235;text-decoration:underline;text-underline-offset:3px}
    .cb-actions{display:flex;gap:10px;flex-wrap:wrap}
    .cb-btn{
      flex:1;min-width:120px;
      height:40px;border-radius:999px;border:none;cursor:pointer;
      font-family:'Poppins',system-ui,sans-serif;font-size:13px;font-weight:700;
      transition:transform .18s,box-shadow .18s;
    }
    .cb-btn:hover{transform:translateY(-2px)}
    .cb-accept{background:#b11235;color:#fff;box-shadow:0 8px 24px rgba(177,18,53,.22)}
    .cb-accept:hover{box-shadow:0 12px 32px rgba(177,18,53,.32)}
    .cb-refuse{background:rgba(25,18,16,.07);color:rgba(25,18,16,.78)}
    .cb-refuse:hover{background:rgba(25,18,16,.12)}
    .footer-cookie-btn{
      background:none;border:none;cursor:pointer;padding:0;
      font-family:'Poppins',system-ui,sans-serif;font-size:inherit;
      font-weight:800;color:rgba(25,18,16,.56);
      text-decoration:underline;text-underline-offset:3px;
    }
    .footer-cookie-btn:hover{color:#b11235}
  `;

  function injectStyle() {
    if (document.getElementById('cookie-css')) return;
    var st = document.createElement('style');
    st.id = 'cookie-css';
    st.textContent = BANNER_CSS;
    document.head.appendChild(st);
  }

  function createBanner() {
    injectStyle();
    var el = document.createElement('div');
    el.id = 'cookie-banner';
    el.setAttribute('role', 'dialog');
    el.setAttribute('aria-label', 'Gestion des cookies');
    el.innerHTML =
      '<p>Ce site utilise <strong>Google Analytics</strong> pour mesurer l\'audience, avec votre accord. ' +
      'Vos données restent anonymisées. <a href="/politique-cookies.html">En savoir plus</a>.</p>' +
      '<div class="cb-actions">' +
        '<button class="cb-btn cb-accept" id="cbAccept">Accepter</button>' +
        '<button class="cb-btn cb-refuse" id="cbRefuse">Refuser</button>' +
      '</div>';
    document.body.appendChild(el);

    document.getElementById('cbAccept').addEventListener('click', function() { setConsent('accepted'); });
    document.getElementById('cbRefuse').addEventListener('click', function() { setConsent('refused'); });
  }

  function hideBanner() {
    var el = document.getElementById('cookie-banner');
    if (!el) return;
    el.classList.add('cb-out');
    setTimeout(function() { el && el.remove(); }, 280);
  }

  function setConsent(choice) {
    localStorage.setItem(KEY, choice);
    hideBanner();
    if (choice === 'accepted') { loadGA4(); }
    else { removeGA4(); }
  }

  function showBanner() {
    if (!document.getElementById('cookie-banner')) createBanner();
  }

  // ── Bouton "Gérer les cookies" dans le footer ─────────────────
  function bindManageBtn() {
    var btn = document.getElementById('manageCookies');
    if (!btn) return;
    injectStyle();
    btn.addEventListener('click', function() {
      localStorage.removeItem(KEY);
      showBanner();
    });
  }

  // ── Init ──────────────────────────────────────────────────────
  function init() {
    bindManageBtn();
    var stored = localStorage.getItem(KEY);
    if (stored === 'accepted') { loadGA4(); return; }
    if (stored === 'refused')  { return; }
    // Pas encore de choix → bandeau
    showBanner();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
