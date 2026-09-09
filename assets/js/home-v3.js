(() => {
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const projectData = {
    one: {
      title: 'Page unique stratégique',
      text: 'Pour une activité avec une offre principale et un parcours simple. L’objectif est de faire comprendre rapidement ce que vous proposez, à qui et pourquoi vous choisir.',
      price: '990 € HT'
    },
    multi: {
      title: 'Site multipage',
      text: 'Pour plusieurs offres, plusieurs parcours ou un besoin SEO qui mérite une architecture plus développée. Jusqu’à 5 pages structurées autour d’une même stratégie.',
      price: '1 990 € HT'
    },
    custom: {
      title: 'Projet sur mesure',
      text: 'Pour les projets qui combinent des besoins plus complexes : boutique, espace de formation, automatisations, connexions métier ou architecture spécifique.',
      price: '2 990 € HT+'
    }
  };

  const bundleData = {
    shop: ['Commerce', 'Boutique en ligne', 'Pour vendre des produits ou services avec un parcours d’achat cohérent avec le reste du site.', ['Catalogue et fiches produit', 'Paiement', 'Emails transactionnels']],
    booking: ['Commerce', 'Réservation', 'Pour permettre au visiteur de réserver un créneau, une prestation ou une ressource sans rupture de parcours.', ['Calendrier ou disponibilités', 'Confirmation', 'Connexion à votre outil']],
    ticket: ['Commerce', 'Billetterie', 'Pour vendre ou distribuer des accès à un événement, une rencontre ou une activité.', ['Tarifs', 'Billets', 'Confirmation']],
    membership: ['Commerce', 'Adhésion', 'Pour gérer une adhésion, une cotisation ou un accès réservé à une communauté.', ['Formulaire', 'Paiement', 'Suivi']],
    quote: ['Commerce', 'Demande de devis avancée', 'Pour qualifier une demande avant qu’elle arrive dans votre boîte mail.', ['Questions conditionnelles', 'Qualification', 'Récapitulatif']],
    payment: ['Commerce', 'Paiement en ligne', 'Pour intégrer un règlement ponctuel ou un acompte sans construire une boutique complète.', ['Paiement sécurisé', 'Confirmation', 'Suivi']],
    multilingual: ['Contenu', 'Multilingue', 'Pour présenter la même stratégie dans plusieurs langues sans dupliquer un site ingérable.', ['Architecture', 'Navigation', 'SEO multilingue']],
    lms: ['Contenu', 'Espace formation / LMS', 'Pour organiser des contenus pédagogiques, des modules et une progression utilisateur.', ['Modules', 'Accès', 'Progression']],
    catalog: ['Contenu', 'Catalogue', 'Pour présenter une offre riche sans activer un achat en ligne.', ['Filtres', 'Fiches', 'Recherche']],
    directory: ['Contenu', 'Annuaire', 'Pour structurer et filtrer un ensemble de profils, lieux, partenaires ou ressources.', ['Filtres', 'Fiches', 'Recherche']],
    members: ['Contenu', 'Espace membre', 'Pour réserver certains contenus ou fonctionnalités à des utilisateurs identifiés.', ['Connexion', 'Rôles', 'Contenus privés']],
    resources: ['Contenu', 'Blog / ressources', 'Pour construire une bibliothèque éditoriale utile au SEO, au GEO et à la preuve d’expertise.', ['Catégories', 'Articles', 'Maillage interne']],
    crm: ['Connexions', 'CRM', 'Pour transmettre automatiquement les bons prospects vers votre outil commercial.', ['Champs', 'Synchronisation', 'Statuts']],
    api: ['Connexions', 'API / outil métier', 'Pour connecter le site à un logiciel existant lorsque le projet le justifie.', ['Lecture de données', 'Envoi de données', 'Sécurisation']],
    automation: ['Connexions', 'Automatisations', 'Pour éviter les copier-coller entre le site, les emails et vos outils internes.', ['Déclencheurs', 'Scénarios', 'Notifications']],
    migration: ['Connexions', 'Migration', 'Pour reprendre proprement les contenus, URLs ou données utiles d’un ancien site.', ['Inventaire', 'Redirections', 'Contrôle']],
    emailing: ['Connexions', 'Emailing / nurturing', 'Pour relier formulaires, séquences et contenus à votre stratégie de conversion.', ['Listes', 'Séquences', 'Consentements']]
  };

  const initProjectSelector = () => {
    const root = $('#projets');
    if (!root) return;
    const choices = $$('.v3-project-choice', root);
    const detail = $('.v3-project-detail', root);
    if (!choices.length || !detail) return;

    const render = key => {
      const data = projectData[key] || projectData.one;
      choices.forEach(choice => {
        const active = choice.dataset.project === key;
        choice.setAttribute('aria-selected', active ? 'true' : 'false');
        choice.tabIndex = active ? 0 : -1;
      });
      detail.innerHTML = `<div><h3>${data.title}</h3><p>${data.text}</p><p><strong>${data.price}</strong></p></div><a class="cta" href="#test">Faire le test gratuit <span>→</span></a>`;
    };

    choices.forEach((choice, index) => {
      choice.addEventListener('click', () => render(choice.dataset.project));
      choice.addEventListener('keydown', event => {
        if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();
        let nextIndex = index;
        if (event.key === 'ArrowLeft') nextIndex = (index - 1 + choices.length) % choices.length;
        if (event.key === 'ArrowRight') nextIndex = (index + 1) % choices.length;
        if (event.key === 'Home') nextIndex = 0;
        if (event.key === 'End') nextIndex = choices.length - 1;
        choices[nextIndex].focus();
        render(choices[nextIndex].dataset.project);
      });
    });
    render(choices.find(choice => choice.getAttribute('aria-selected') === 'true')?.dataset.project || 'one');
  };

  const initBundles = () => {
    const root = $('#fonctionnalites');
    if (!root) return;
    const buttons = $$('.v3-bundle-button', root);
    const detail = $('.v3-bundle-detail', root);
    if (!buttons.length || !detail) return;

    const render = key => {
      const data = bundleData[key] || bundleData.shop;
      buttons.forEach(button => button.setAttribute('aria-selected', button.dataset.bundle === key ? 'true' : 'false'));
      detail.innerHTML = `<small>${data[0]}</small><h3>${data[1]}</h3><p>${data[2]}</p><ul>${data[3].map(item => `<li>${item}</li>`).join('')}</ul>`;
    };

    buttons.forEach(button => button.addEventListener('click', () => render(button.dataset.bundle)));
    render(buttons.find(button => button.getAttribute('aria-selected') === 'true')?.dataset.bundle || buttons[0].dataset.bundle);
  };

  const initProcess = () => {
    const process = $('#methode');
    if (!process) return;
    const steps = $$('.v3-process-step', process);
    const progress = $('.v3-process-progress i', process);
    const counter = $('.v3-process-counter strong', process);
    if (!steps.length) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const mobile = window.matchMedia('(max-width: 760px)').matches;
    if (reducedMotion || mobile) {
      steps.forEach(step => step.classList.add('is-active'));
      return;
    }

    let active = -1;
    let scheduled = false;

    const render = () => {
      scheduled = false;
      const rect = process.getBoundingClientRect();
      const vh = window.innerHeight || 1;
      const travel = Math.max(1, rect.height - vh);
      const ratio = Math.max(0, Math.min(.9999, -rect.top / travel));
      const next = Math.min(3, Math.floor(ratio * 4));
      if (next === active) return;
      active = next;
      process.dataset.processStep = String(active);
      steps.forEach((step, index) => step.classList.toggle('is-active', index === active));
      if (progress) progress.style.width = `${(active + 1) * 25}%`;
      if (counter) counter.textContent = `0${active + 1} / 04`;
    };

    const schedule = () => {
      if (scheduled) return;
      scheduled = true;
      requestAnimationFrame(render);
    };

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });
    render();
  };

  const enhanceReviews = () => {
    const list = $('.reviews-list');
    const items = $$('.review-item', list || document);
    if (!list || items.length < 2) return;
    const featured = items.find(item => item.textContent.includes('Bruno U.')) || items[0];
    featured.classList.add('v3-featured-review');
    list.prepend(featured);
  };

  const init = () => {
    document.body.classList.add('home-v3-ready');
    initProjectSelector();
    initBundles();
    initProcess();
    enhanceReviews();
  };

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init, { once: true });
  else init();
})();
