(() => {
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const escapeHtml = value => String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');

  const transformApproach = () => {
    $('#preuve.home-proof')?.remove();

    const section = $('#approche');
    if (!section || section.classList.contains('approach-frieze-v2')) return;

    const kicker = $('.home-kicker', section)?.textContent?.trim() || 'Quand le message se dérègle';
    const title = $('h2', section)?.textContent?.trim() || 'Le client ne devrait pas avoir à deviner ce que vous faites.';
    const lede = $('.home-lede', section)?.textContent?.trim() || 'Votre activité peut évoluer plus vite que votre communication. Le problème commence souvent là.';
    const note = $('.cycle-copy__note', section)?.textContent?.trim() || 'La solution n’est pas d’en dire davantage. C’est de repartir d’une base commune.';
    const steps = $$('.cycle-node', section).map(node => node.textContent.trim()).filter(Boolean);

    if (!steps.length) return;

    const noteText = escapeHtml(note);
    const noteHtml = noteText.replace('repartir d’une base commune', '<strong>repartir d’une base commune</strong>');
    const stepHtml = steps.map((text, index) => `
      <li class="approach-frieze-v2__step">
        <span class="approach-frieze-v2__connector" aria-hidden="true"></span>
        <span class="approach-frieze-v2__pin" aria-hidden="true"></span>
        <article class="approach-frieze-v2__card">
          <span class="approach-frieze-v2__number">${String(index + 1).padStart(2, '0')}</span>
          <p>${escapeHtml(text)}</p>
        </article>
      </li>`).join('');

    section.classList.remove('cycle-section', 'cycle-section--problem');
    section.classList.add('approach-frieze-v2');
    section.innerHTML = `
      <div class="home-section__inner">
        <header class="approach-frieze-v2__head">
          <p class="home-kicker">${escapeHtml(kicker)}</p>
          <h2>${escapeHtml(title)}</h2>
          <p class="home-lede">${escapeHtml(lede)}</p>
        </header>
        <div class="approach-frieze-v2__rail" aria-label="Les étapes qui font perdre de la clarté à votre communication">
          <svg class="approach-frieze-v2__thread" viewBox="0 0 1000 90" preserveAspectRatio="none" aria-hidden="true">
            <path class="approach-frieze-v2__thread-shadow" d="M0 46 C85 42 145 51 220 46 S365 41 445 47 S590 52 670 45 S820 40 1000 46"/>
            <path class="approach-frieze-v2__thread-main" d="M0 46 C85 42 145 51 220 46 S365 41 445 47 S590 52 670 45 S820 40 1000 46"/>
            <path class="approach-frieze-v2__thread-fiber" d="M0 44.8 C85 40.8 145 49.8 220 44.8 S365 39.8 445 45.8 S590 50.8 670 43.8 S820 38.8 1000 44.8"/>
          </svg>
          <ol class="approach-frieze-v2__steps">${stepHtml}</ol>
        </div>
        <p class="approach-frieze-v2__note">${noteHtml}</p>
      </div>`;
  };

  const apply = () => {
    if (!document.body.classList.contains('home-v3')) {
      requestAnimationFrame(apply);
      return;
    }

    transformApproach();

    // Nettoyage des anciennes ancres injectées avant la refonte.
    $$('#main > .nav-anchor').forEach(anchor => anchor.remove());

    // Corrige le compteur non vérifié dans le hero sans toucher à sa composition.
    const proofLine = $('.hero-proof-line');
    if (proofLine) {
      const parts = Array.from(proofLine.children);
      if (parts[1]) parts[1].textContent = '5/5 sur Google';
    }

    // Sémantique plus propre pour les questions du diagnostic.
    $$('.diagnostic-step legend h3').forEach(title => {
      const span = document.createElement('span');
      span.className = 'diagnostic-question';
      span.textContent = title.textContent;
      title.replaceWith(span);
    });

    // Les anciens schémas circulaires restants sont des schémas explicatifs.
    $$('.cycle-visual').forEach(visual => {
      visual.setAttribute('role', 'img');
      visual.setAttribute('tabindex', '0');
    });

    // Le modal ne doit plus présenter une offre de consulting autonome.
    const modal = $('#intent-modal');
    if (modal) {
      const eyebrow = $('.intent-modal__eyebrow', modal);
      const title = $('#intent-modal-title', modal);
      const intro = $('.intent-modal__intro', modal);
      if (eyebrow) eyebrow.textContent = 'Choisissez votre point d’entrée';
      if (title) title.textContent = 'Vous voulez quoi, exactement ?';
      if (intro) intro.textContent = 'Choisissez la manière la plus simple de commencer avec Paranoir.';

      const options = $$('.intent-option', modal);
      if (options[0]) {
        options[0].setAttribute('href', '#diagnostic');
        $('h3', options[0]).textContent = 'Clarifier et déployer';
        $('p', options[0]).textContent = 'Commencer par le diagnostic, clarifier votre stratégie puis la déployer sur le site, le réseau social principal et la fiche Google.';
      }
      if (options[1]) {
        options[1].setAttribute('href', '/formation');
        $('h3', options[1]).textContent = 'Former votre équipe';
        $('p', options[1]).textContent = 'Transmettre une méthode claire pour structurer les messages et la communication en interne.';
      }
      if (options[2]) {
        options[2].setAttribute('href', 'https://wa.me/33637432180?text=Bonjour%20Paranoir%2C%20je%20souhaite%20vous%20parler%20de%20mon%20projet.');
        options[2].setAttribute('target', '_blank');
        options[2].setAttribute('rel', 'noopener noreferrer');
        $('h3', options[2]).textContent = 'Parler de votre projet';
        $('p', options[2]).textContent = 'Vous avez une situation particulière ou vous préférez échanger directement avec nous sur WhatsApp.';
      }
    }

    // Active state recalculé sur les nouvelles sections.
    const navLinks = $$('.site-header__link[href^="#"]');
    const observed = navLinks.map(link => $(link.getAttribute('href'))).filter(Boolean);
    navLinks.forEach(link => link.removeAttribute('aria-current'));

    if ('IntersectionObserver' in window && observed.length) {
      const observer = new IntersectionObserver(entries => {
        const visible = entries
          .filter(entry => entry.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
        if (!visible) return;
        navLinks.forEach(link => {
          const isActive = link.getAttribute('href') === `#${visible.target.id}`;
          if (isActive) link.setAttribute('aria-current', 'location');
          else link.removeAttribute('aria-current');
        });
      }, { rootMargin: '-22% 0px -62% 0px', threshold: [0.01, 0.2, 0.5] });
      observed.forEach(target => observer.observe(target));
    }

    // Vérification défensive : aucun libellé visible ne doit encore parler de test ou de quiz.
    const replacements = new Map([
      ['Faire le test gratuit', 'Commencer mon diagnostic gratuit'],
      ['Test de clarté', 'Diagnostic gratuit'],
      ['test de clarté', 'diagnostic gratuit'],
      ['quiz', 'diagnostic']
    ]);
    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
    const nodes = [];
    while (walker.nextNode()) nodes.push(walker.currentNode);
    nodes.forEach(node => {
      const parent = node.parentElement;
      if (!parent || ['SCRIPT','STYLE','NOSCRIPT'].includes(parent.tagName)) return;
      let text = node.nodeValue;
      replacements.forEach((value, key) => { text = text.split(key).join(value); });
      if (text !== node.nodeValue) node.nodeValue = text;
    });
  };

  apply();
})();