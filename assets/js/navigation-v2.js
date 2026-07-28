(() => {
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
    }, { rootMargin: '-25% 0px -60% 0px', threshold: [0.01, 0.25, 0.6] });
    observed.forEach(section => observer.observe(section));
  }

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && mobileMenu?.classList.contains('is-open')) closeMobileMenu();
  });
})();
