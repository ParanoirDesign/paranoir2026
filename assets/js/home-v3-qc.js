(() => {
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const apply = () => {
    if (!document.body.classList.contains('home-v3')) {
      requestAnimationFrame(apply);
      return;
    }

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

    // Les cercles sont des schémas explicatifs, pas de simples blocs décoratifs.
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
