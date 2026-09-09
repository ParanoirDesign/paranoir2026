(() => {
  const ensureStylesheet = (href, id) => {
    if (document.getElementById(id)) return;
    const link = document.createElement('link');
    link.id = id;
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
  };

  ensureStylesheet('/assets/css/navigation-v2.css?v=3', 'navigation-v2-css');
  ensureStylesheet('/assets/css/hero-v2.css?v=11', 'hero-v2-css');

  const hero = document.querySelector('.hero');
  if (hero) {
    hero.classList.add('hero-v2');

    const eyebrow = hero.querySelector('.eyebrow');
    if (eyebrow) eyebrow.innerHTML = '<span class="dot"></span>Site internet · Réseau social · Fiche Google';

    const title = hero.querySelector('h1');
    if (title) title.innerHTML = 'Votre valeur reste floue.<span class="hero-line-two">Nous la rendons évidente.</span>';

    const sub = hero.querySelector('.sub');
    if (sub) sub.innerHTML = 'Nous clarifions <strong>ce que vous vendez</strong>, <strong>à qui vous le vendez</strong> et <strong>pourquoi vous êtes différent</strong>. Puis nous déployons cette clarté sur votre site, votre réseau social principal et votre fiche Google Business Profile.';

    const actions = hero.querySelector('.hero-actions');
    if (actions) {
      actions.innerHTML = '<a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a><p class="micro">3 minutes · Sans engagement · Un premier niveau de clarté immédiatement</p><div class="hero-proof-line"><span class="hero-proof-line__stars" aria-label="5 étoiles">★★★★★</span><span>5/5 sur Google</span><span class="hero-proof-line__separator" aria-hidden="true"></span><span>Plus de 60 entreprises accompagnées</span></div>';
    }

    const boardTop = hero.querySelector('.board-top');
    if (boardTop) boardTop.innerHTML = '<span>Système de clarté</span><span>Stratégie → déploiement</span>';

    const evidence = hero.querySelectorAll('.evidence');
    const evidenceContent = [
      ['Offre claire', 'ce que vous vendez'],
      ['Cible précise', 'à qui vous le vendez'],
      ['Différence forte', 'pourquoi vous choisir'],
      ['Message cohérent', 'ce que les gens retiennent'],
      ['Parcours lisible', 'ce qu’ils doivent faire'],
      ['Déploiement', 'site · social · fiche Google']
    ];

    evidence.forEach((item, index) => {
      const data = evidenceContent[index];
      if (!data) return;
      item.classList.remove('false');
      item.innerHTML = `<strong>${data[0]}</strong><span>${data[1]}</span>`;
    });

    const stamp = hero.querySelector('.stamp');
    if (stamp) stamp.textContent = 'Message aligné';

    const oldOffer = hero.querySelector('.hero-offer');
    if (oldOffer) {
      oldOffer.outerHTML = `
        <div class="hero-system-panel" aria-label="Les trois points de contact déployés">
          <div class="hero-system-panel__item"><small>01 · Site</small><strong>Le socle</strong><span>Une offre et un parcours compréhensibles immédiatement.</span></div>
          <div class="hero-system-panel__item"><small>02 · Réseau social</small><strong>La voix</strong><span>Un message cohérent sur votre canal principal.</span></div>
          <div class="hero-system-panel__item"><small>03 · Fiche Google</small><strong>La confiance</strong><span>Une présence locale alignée avec votre positionnement.</span></div>
        </div>`;
    }
  }

  const header = document.getElementById('site-header');
  const menuToggle = document.getElementById('menuToggle');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileBackdrop = document.getElementById('mobileMenuBackdrop');
  const intentModal = document.getElementById('intent-modal');
  const intentOpeners = document.querySelectorAll('[data-open-intent]');
  const intentClose = document.getElementById('intentModalClose');
  let lastIntentTrigger = null;

  const setBodyLock = locked => {
    document.body.style.overflow = locked ? 'hidden' : '';
  };

  const closeMobileMenu = () => {
    if (!menuToggle || !mobileMenu || !mobileBackdrop) return;
    menuToggle.setAttribute('aria-expanded', 'false');
    mobileMenu.classList.remove('is-open');
    mobileBackdrop.classList.remove('is-open');
    setBodyLock(false);
  };

  const openMobileMenu = () => {
    if (!menuToggle || !mobileMenu || !mobileBackdrop) return;
    menuToggle.setAttribute('aria-expanded', 'true');
    mobileMenu.classList.add('is-open');
    mobileBackdrop.classList.add('is-open');
    setBodyLock(true);
    mobileMenu.querySelector('a,button')?.focus();
  };

  menuToggle?.addEventListener('click', () => {
    const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
    expanded ? closeMobileMenu() : openMobileMenu();
  });
  mobileBackdrop?.addEventListener('click', closeMobileMenu);
  mobileMenu?.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMobileMenu));

  const openIntentModal = trigger => {
    if (!intentModal) return;
    lastIntentTrigger = trigger || document.activeElement;
    closeMobileMenu();
    intentModal.showModal();
    setBodyLock(true);
    intentClose?.focus();
    trigger?.setAttribute('aria-expanded', 'true');
  };

  const closeIntentModal = () => {
    if (!intentModal?.open) return;
    intentModal.close();
    setBodyLock(false);
    intentOpeners.forEach(button => button.setAttribute('aria-expanded', 'false'));
    lastIntentTrigger?.focus?.();
  };

  intentOpeners.forEach(button => button.addEventListener('click', () => openIntentModal(button)));
  intentClose?.addEventListener('click', closeIntentModal);
  intentModal?.addEventListener('click', event => {
    if (event.target === intentModal) closeIntentModal();
  });
  intentModal?.addEventListener('cancel', event => {
    event.preventDefault();
    closeIntentModal();
  });
  intentModal?.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      if (link.getAttribute('href')?.startsWith('#')) closeIntentModal();
    });
  });

  window.addEventListener('scroll', () => {
    header?.classList.toggle('is-scrolled', window.scrollY > 24);
  }, { passive: true });

  const navLinks = Array.from(document.querySelectorAll('.site-header__link[href^="#"]'));
  const observed = navLinks
    .map(link => document.querySelector(link.getAttribute('href')))
    .filter(Boolean);

  if ('IntersectionObserver' in window && observed.length) {
    const observer = new IntersectionObserver(entries => {
      const visible = entries
        .filter(entry => entry.isIntersecting)
        .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
      if (!visible) return;
      navLinks.forEach(link => {
        const active = link.getAttribute('href') === `#${visible.target.id}`;
        if (active) link.setAttribute('aria-current', 'location');
        else link.removeAttribute('aria-current');
      });
    }, { rootMargin: '-24% 0px -60% 0px', threshold: [0.01, 0.25, 0.6] });
    observed.forEach(section => observer.observe(section));
  }

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && mobileMenu?.classList.contains('is-open')) closeMobileMenu();
  });
})();
