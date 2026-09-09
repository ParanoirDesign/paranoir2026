(() => {
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const createSection = (className, id, html) => {
    const section = document.createElement('section');
    section.className = `v3-section ${className}`;
    if (id) section.id = id;
    section.innerHTML = html;
    return section;
  };

  const removeLegacyAnchor = id => {
    $$('.nav-anchor').filter(anchor => anchor.id === id).forEach(anchor => anchor.remove());
  };

  const initProjectSelector = root => {
    const choices = $$('.v3-project-choice', root);
    const detail = $('.v3-project-detail', root);
    if (!choices.length || !detail) return;

    const projects = {
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

    const render = key => {
      const data = projects[key] || projects.one;
      choices.forEach(choice => choice.setAttribute('aria-selected', choice.dataset.project === key ? 'true' : 'false'));
      detail.innerHTML = `
        <div>
          <h3>${data.title}</h3>
          <p>${data.text}</p>
          <p><strong>${data.price}</strong></p>
        </div>
        <a class="cta" href="#test">Faire le test gratuit <span>→</span></a>`;
    };

    choices.forEach(choice => choice.addEventListener('click', () => render(choice.dataset.project)));
    render('one');
  };

  const initBundles = root => {
    const buttons = $$('.v3-bundle-button', root);
    const detail = $('.v3-bundle-detail', root);
    if (!buttons.length || !detail) return;

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

    const render = key => {
      const data = bundleData[key] || bundleData.shop;
      buttons.forEach(button => button.setAttribute('aria-selected', button.dataset.bundle === key ? 'true' : 'false'));
      detail.innerHTML = `<small>${data[0]}</small><h3>${data[1]}</h3><p>${data[2]}</p><ul>${data[3].map(item => `<li>${item}</li>`).join('')}</ul>`;
    };

    buttons.forEach(button => button.addEventListener('click', () => render(button.dataset.bundle)));
    render(buttons[0].dataset.bundle);
  };

  const initProcess = process => {
    if (!process || window.matchMedia('(max-width: 760px)').matches || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const steps = $$('.v3-process-step', process);
    const progress = $('.v3-process-progress i', process);
    const counter = $('.v3-process-counter strong', process);
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

  const initReveals = root => {
    const items = $$('[data-v3-reveal]', root);
    if (!items.length || !('IntersectionObserver' in window)) {
      items.forEach(item => item.classList.add('is-v3-visible'));
      return;
    }
    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-v3-visible');
        io.unobserve(entry.target);
      });
    }, { threshold: .12 });
    items.forEach(item => io.observe(item));
  };

  const mount = () => {
    const main = $('#main');
    const hero = $('.hero', main);
    if (!main || !hero || document.body.classList.contains('home-v3-ready')) return;

    document.body.classList.add('home-v3-ready');

    ['approche','test','strategie','deploiement','projets','realisations','avis','studio','faq'].forEach(removeLegacyAnchor);

    const proof = $('.proof', main);
    if (proof) {
      proof.innerHTML = `
        <article class="v3-proof v3-glass"><strong>+60</strong><span>entreprises accompagnées</span></article>
        <article class="v3-proof v3-proof--stars v3-glass"><strong>★★★★★</strong><span>5/5 sur Google, 23 avis</span></article>
        <article class="v3-proof v3-glass"><strong>Conseils en continu</strong><span>Site, réseau social et fiche Google pensés comme un seul système</span></article>`;
    }

    const statement = $('.statement', main);
    if (statement) {
      statement.id = 'approche';
      statement.className = 'statement v3-manifesto';
      statement.innerHTML = `
        <div class="v3-manifesto-copy" data-v3-reveal>
          <p class="v3-kicker">Le problème n’est pas toujours là où il se voit</p>
          <h2 class="v3-title">Un site peut être parfaitement construit et envoyer <span class="editorial">les mauvais signaux.</span></h2>
          <p class="v3-lede">Un prospect peut vous découvrir sur Google, vérifier votre site, regarder votre réseau social puis lire vos avis. S’il rencontre quatre versions différentes de votre activité, il ne fait pas la synthèse à votre place.</p>
          <p class="v3-manifesto-note">Plus vous ajoutez de communication sur une base floue, plus le parcours devient difficile à suivre.</p>
        </div>
        <div class="v3-tangle" aria-label="Parcours d'un prospect entre Google, le site, le réseau social et les avis" data-v3-reveal>
          <svg viewBox="0 0 620 540" preserveAspectRatio="none" aria-hidden="true">
            <path class="soft" d="M130 120 L485 215 L195 390 L468 455"/>
            <path d="M130 120 L330 285 L485 215"/>
            <path d="M195 390 L330 285 L468 455"/>
            <path d="M468 455 L525 95 L130 120"/>
          </svg>
          <div class="v3-clue v3-clue--google">Fiche Google<small>premier signal de confiance</small></div>
          <div class="v3-clue v3-clue--site">Site<small>point de référence</small></div>
          <div class="v3-clue v3-clue--social">Réseau social<small>présence et relation</small></div>
          <div class="v3-clue v3-clue--reviews">Avis<small>preuve extérieure</small></div>
          <div class="v3-clue v3-clue--hesitation">Hésitation<small>les messages ne s’alignent pas</small></div>
        </div>`;
    }

    const prequiz = $('.prequiz', main);
    if (prequiz) {
      prequiz.id = 'test';
      prequiz.classList.add('v3-diagnostic');
      const head = $('.prequiz-head', prequiz);
      if (head) head.innerHTML = `
        <p class="kicker">Test de clarté gratuit</p>
        <h2>Une question à la fois.</h2>
        <p class="lede">En 3 minutes, vous obtenez un premier diagnostic sur ce qui brouille votre offre, votre message ou votre parcours.</p>`;
      const privacy = $('.quiz-privacy', prequiz);
      if (privacy) privacy.innerHTML = 'Vos réponses servent uniquement à établir votre diagnostic et à vous recontacter à son sujet. <a href="/politique-confidentialite.html">En savoir plus sur vos données.</a>';
    }

    const strategy = createSection('v3-strategy', 'strategie', `
      <div data-v3-reveal>
        <p class="v3-kicker">La stratégie est incluse</p>
        <h2 class="v3-title">Nous ne produisons pas d’abord pour <span class="editorial">réfléchir ensuite.</span></h2>
        <p class="v3-lede">Chaque projet payant commence par la même question : qu’est-ce que vos clients doivent comprendre, retenir et faire ensuite ?</p>
        <p class="v3-strategy-quote">La stratégie n’est pas une option ajoutée au devis. C’est la base du déploiement.</p>
      </div>
      <div class="v3-strategy-cloud v3-glass" data-v3-reveal aria-label="Éléments étudiés dans la stratégie">
        ${['activité','dirigeant','clients','marché','concurrence','offre','différence','message','positionnement','parcours','priorités'].map(item => `<span class="v3-pill">${item}</span>`).join('')}
      </div>`);

    const strategicDocument = createSection('v3-document', 'document-strategique', `
      <p class="v3-kicker">Un document de référence</p>
      <h2 class="v3-title">La stratégie devient <span class="editorial">utilisable.</span></h2>
      <p class="v3-lede">Vous repartez avec un document qui rassemble les décisions prises et sert de référence au site, aux contenus et aux prochaines actions.</p>
      <div class="v3-document-sheet" data-v3-reveal>
        <div class="v3-document-brand"><span>PARANOIR STUDIO</span><span>Document de référence</span></div>
        <div class="v3-document-grid">
          <div class="v3-document-block"><small>01 · Identité</small><strong>Ce que vous défendez</strong><p>Mission, vision, promesse, personnalité et principes qui doivent rester cohérents.</p></div>
          <div class="v3-document-block"><small>02 · Offre</small><strong>Ce que vous vendez</strong><p>Hiérarchie, bénéfices, objections, formulation et priorités commerciales.</p></div>
          <div class="v3-document-block"><small>03 · Clients</small><strong>À qui vous parlez</strong><p>Cibles, attentes, freins, critères de décision et niveau de compréhension attendu.</p></div>
          <div class="v3-document-block"><small>04 · Communication</small><strong>Ce qu’ils doivent retenir</strong><p>Messages clés, ton, preuves, appels à l’action et cohérence entre les points de contact.</p></div>
        </div>
        <div class="v3-document-foot">Un socle réutilisable pour arbitrer les décisions pendant au moins un an.</div>
      </div>`);

    const deployment = createSection('v3-deployment', 'deploiement', `
      <div data-v3-reveal>
        <p class="v3-kicker">Trois points de contact, un seul message</p>
        <h2 class="v3-title">Le fil se dénoue quand chaque support joue <span class="editorial">son vrai rôle.</span></h2>
        <p class="v3-lede">Le site devient le socle. Le réseau social porte votre voix. La fiche Google apporte la confiance locale. Ils ne doivent pas répéter mot pour mot la même chose, ils doivent raconter la même entreprise.</p>
      </div>
      <div class="v3-untangle v3-glass" data-v3-reveal aria-label="Déploiement cohérent sur le site, le réseau social et la fiche Google">
        <div class="v3-untangle-line" aria-hidden="true"></div>
        <div class="v3-channel v3-channel--site"><small>01 · Site</small><strong>Le socle</strong></div>
        <div class="v3-channel v3-channel--social"><small>02 · Réseau social</small><strong>La voix</strong></div>
        <div class="v3-channel v3-channel--google"><small>03 · Fiche Google</small><strong>La confiance</strong></div>
        <div class="v3-message-core">Message aligné</div>
        <div class="v3-confidence">Compréhension → confiance → action</div>
      </div>`);

    const projects = createSection('v3-projects', 'projets', `
      <p class="v3-kicker">Le format suit la complexité</p>
      <h2 class="v3-title">Quel projet correspond à <span class="editorial">votre situation ?</span></h2>
      <p class="v3-lede">On ne choisit pas un nombre de pages au hasard. On regarde d’abord ce que vos clients doivent comprendre et combien de parcours doivent coexister.</p>
      <div class="v3-project-switch" role="listbox" aria-label="Choisir une situation de projet">
        <button class="v3-project-choice" type="button" data-project="one" aria-selected="true"><small>Une offre principale</small><strong>Un parcours simple</strong><span>990 € HT</span></button>
        <button class="v3-project-choice" type="button" data-project="multi" aria-selected="false"><small>Plusieurs offres</small><strong>Plusieurs parcours</strong><span>1 990 € HT</span></button>
        <button class="v3-project-choice" type="button" data-project="custom" aria-selected="false"><small>Besoins complexes</small><strong>Fonctions sur mesure</strong><span>2 990 € HT+</span></button>
      </div>
      <div class="v3-project-detail v3-glass" aria-live="polite"></div>
      <p class="v3-project-included"><strong>Dans chaque projet payant :</strong> stratégie + document stratégique + site + réseau social principal + fiche Google.</p>`);

    const bundleGroups = [
      ['Commerce', [['shop','Boutique en ligne'],['booking','Réservation'],['ticket','Billetterie'],['membership','Adhésion'],['quote','Demande de devis avancée'],['payment','Paiement en ligne']]],
      ['Contenu', [['multilingual','Multilingue'],['lms','Espace formation / LMS'],['catalog','Catalogue'],['directory','Annuaire'],['members','Espace membre'],['resources','Blog / ressources']]],
      ['Connexions', [['crm','CRM'],['api','API / outil métier'],['automation','Automatisations'],['migration','Migration'],['emailing','Emailing / nurturing']]]
    ];

    const bundles = createSection('v3-bundles', 'fonctionnalites', `
      <div data-v3-reveal>
        <p class="v3-kicker">17 bundles disponibles</p>
        <h2 class="v3-title">On ajoute des fonctions quand elles servent <span class="editorial">le parcours.</span></h2>
        <p class="v3-lede">Une fonctionnalité n’est jamais intéressante parce qu’elle existe. Elle l’est lorsqu’elle retire une friction ou automatise quelque chose d’utile.</p>
      </div>
      <div class="v3-bundle-browser" data-v3-reveal>
        <div class="v3-bundle-list v3-glass">
          ${bundleGroups.map(group => `<div class="v3-bundle-group-title">${group[0]}</div>${group[1].map((item,index) => `<button class="v3-bundle-button" type="button" data-bundle="${item[0]}" aria-selected="${group[0] === 'Commerce' && index === 0 ? 'true' : 'false'}"><span>${item[1]}</span><span>→</span></button>`).join('')}`).join('')}
        </div>
        <div class="v3-bundle-detail v3-glass" aria-live="polite"></div>
      </div>`);

    const technical = createSection('v3-tech', 'technique', `
      <div class="v3-tech-inner">
        <p class="v3-kicker">Construction technique & IA</p>
        <h2 class="v3-title">L’IA va vite. <span class="editorial">Les mauvais choix aussi.</span></h2>
        <p class="v3-lede">Nous utilisons l’IA pour accélérer la recherche, le prototypage et certaines tâches de production. Elle ne décide ni de votre positionnement, ni de votre architecture, ni de la façon dont le site devra évoluer.</p>
        <div class="v3-tech-compare" data-v3-reveal>
          <div class="v3-tech-row v3-tech-row--head"><div>Critère</div><div>100 % généré</div><div>Paranoir</div></div>
          <div class="v3-tech-row"><div>Production</div><div class="muted">Rapide</div><div class="yes">Rapide</div></div>
          <div class="v3-tech-row"><div>Structure</div><div class="muted">Souvent générique</div><div class="yes">Pensée pour votre activité</div></div>
          <div class="v3-tech-row"><div>Message</div><div class="muted">Produit à partir d’un prompt</div><div class="yes">Décidé à partir de la stratégie</div></div>
          <div class="v3-tech-row"><div>Évolutivité</div><div class="muted">Variable</div><div class="yes">Prévue dès l’architecture</div></div>
          <div class="v3-tech-row"><div>Maintenance</div><div class="muted">Dépend de ce qui a été généré</div><div class="yes">Dépendances maîtrisées</div></div>
          <div class="v3-tech-row"><div>Autonomie</div><div class="muted">Pas toujours anticipée</div><div class="yes">Choisie selon vos besoins</div></div>
        </div>
        <p class="v3-tech-note"><strong>Notre règle :</strong> l’IA accélère. Les décisions restent humaines, documentées et maintenables.</p>
      </div>`);

    const process = createSection('v3-process', 'methode', `
      <div class="v3-process-track">
        <div class="v3-process-stage">
          <div class="v3-process-copy">
            <div class="v3-process-counter"><strong>01 / 04</strong><span class="v3-process-progress"><i></i></span></div>
            <article class="v3-process-step is-active"><small>01 · Comprendre</small><h3>Comprendre.</h3><p>On rassemble le contexte, l’existant, les offres, les clients et les symptômes. On distingue les faits des hypothèses.</p></article>
            <article class="v3-process-step"><small>02 · Décider</small><h3>Décider.</h3><p>On organise les informations, formule le positionnement et arbitre ce qui doit être compris en premier. Le document stratégique prend forme.</p></article>
            <article class="v3-process-step"><small>03 · Déployer</small><h3>Déployer.</h3><p>La stratégie devient un site, un réseau social principal et une fiche Google cohérents. Chaque support prend son rôle.</p></article>
            <article class="v3-process-step"><small>04 · Transmettre</small><h3>Transmettre.</h3><p>Vous récupérez les accès, les règles, le document stratégique et les repères nécessaires pour garder la main sur la suite.</p></article>
          </div>
          <div class="v3-process-scene" aria-hidden="true">
            <div class="v3-scene-layer" data-scene="0"><span class="v3-note n1">Offres</span><span class="v3-note n2">Clients</span><span class="v3-note n3">Concurrence</span><span class="v3-note n4">Messages</span><div class="v3-scene-thread"></div></div>
            <div class="v3-scene-layer" data-scene="1"><div class="v3-scene-doc"><strong>Document stratégique</strong><div class="bars"><i></i><i></i><i></i><i></i></div></div></div>
            <div class="v3-scene-layer" data-scene="2"><div class="v3-device-row"><div class="v3-device"><strong>Site</strong><i></i><i></i><i></i></div><div class="v3-device"><strong>Réseau</strong><i></i><i></i></div><div class="v3-device"><strong>Fiche Google</strong><i></i><i></i></div></div></div>
            <div class="v3-scene-layer" data-scene="3"><div class="v3-handoff"><div class="v3-handoff-card"><small>Transmission</small><strong>Vous gardez la main.</strong><p>Document, accès, règles et plan d’action restent avec vous.</p></div></div></div>
          </div>
        </div>
      </div>`);
    process.dataset.processStep = '0';

    const legacyMethod = $('.method', main);
    const legacyOffer = $('.offer', main);
    const legacyComparison = $('.offer-comparison', main);
    [legacyMethod, legacyOffer, legacyComparison].forEach(node => node?.remove());

    const realisations = $('.realisations', main);
    if (realisations) {
      realisations.id = 'realisations';
      const decisions = {
        'ANVL': 'Repositionner l’association comme experte du vivant et acteur territorial, pas comme simple association de niche.',
        'Laetitia Juet': 'Faire de la périnatalité et de la sexothérapie une différence lisible au lieu d’un message générique.',
        'Vision à la Maison': 'Recentrer l’expérience sur la mobilité, moderniser la réassurance et clarifier le parcours.'
      };
      $$('.real-card', realisations).forEach(card => {
        const name = $('.real-client strong', card)?.textContent.trim();
        if (!name || !decisions[name] || $('.v3-decision', card)) return;
        const note = document.createElement('div');
        note.className = 'v3-decision';
        note.innerHTML = `<strong>Décision stratégique</strong>${decisions[name]}`;
        const offer = $('.real-offer', card);
        if (offer) offer.before(note); else $('.real-body', card)?.append(note);
      });
    }

    const reviews = $('.google-reviews', main);
    if (reviews) {
      reviews.id = 'avis';
      const list = $('.reviews-list', reviews);
      const items = $$('.review-item', list);
      if (list && items[1]) {
        items[1].classList.add('v3-featured-review');
        list.prepend(items[1]);
      }
    }

    const about = $('.about', main);
    if (about) {
      about.id = 'studio';
      about.classList.add('v3-studio');
      const copy = $('.about-copy', about);
      if (copy) copy.innerHTML = `
        <p class="kicker">Le studio</p>
        <h2>Deux expertises associées. Les personnes qui pensent le projet sont aussi celles qui le livrent.</h2>
        <p>Paranoir réunit la stratégie, l’UX, les contenus et la construction technique dans la même équipe. Moins de passages de relais, moins de déperdition entre ce qui a été décidé et ce qui finit réellement en ligne.</p>
        <div class="v3-studio-members">
          <div class="v3-studio-member"><strong>Victoria</strong><span>Stratégie, UX, positionnement, contenus et accompagnement.</span></div>
          <div class="v3-studio-member"><strong>Alexandre</strong><span>Architecture technique, intégrations, performance et livraison.</span></div>
        </div>
        <div class="v3-credentials"><span class="v3-pill">UX & stratégie</span><span class="v3-pill">Développement</span><span class="v3-pill">Formation</span><span class="v3-pill">Performance</span><span class="v3-pill">Accessibilité</span></div>`;
    }

    const faq = $('.faq', main);
    if (faq) {
      faq.id = 'faq';
      faq.classList.add('v3-faq');
      const legacyFaq = $$('.faq details', main).map(detail => detail.outerHTML);
      faq.innerHTML = `
        <div class="v3-faq-head"><p class="v3-kicker">Questions fréquentes</p><h2 class="v3-title">Les réponses utiles, <span class="editorial">sans roman.</span></h2></div>
        <div class="v3-faq-priority">
          <article class="v3-glass"><h3>Le résultat du test est-il immédiat ?</h3><p>Oui. Votre première analyse s’affiche directement après vos réponses.</p></article>
          <article class="v3-glass"><h3>La stratégie est-elle réellement incluse ?</h3><p>Oui. Elle est intégrée à chaque projet payant et formalisée dans votre document stratégique.</p></article>
          <article class="v3-glass"><h3>Combien coûte un projet ?</h3><p>990 € HT, 1 990 € HT ou à partir de 2 990 € HT selon la complexité.</p></article>
        </div>
        <div class="v3-faq-list">
          ${legacyFaq.join('')}
          <details><summary>La fiche Google est-elle incluse ?</summary><p>Oui, son optimisation fait partie du déploiement prévu dans les projets payants.</p></details>
          <details><summary>Travaillez-vous uniquement avec WordPress ?</summary><p>Non. La solution technique dépend du projet, de son autonomie future et des dépendances réellement utiles.</p></details>
          <details><summary>Puis-je modifier mon site ensuite ?</summary><p>Oui. L’objectif est de vous laisser une structure que vous pouvez faire vivre sans dépendance inutile.</p></details>
        </div>`;
    }

    const final = $('.final', main);
    if (final) {
      final.id = 'cta-final';
      final.classList.add('v3-final');
      const inner = $('.final-inner', final);
      if (inner) inner.innerHTML = `
        <p class="v3-kicker" style="color:rgba(255,255,255,.72)">Votre prochain projet</p>
        <h2>Commence par une question : <span class="highlight" style="color:#fff">qu’est-ce qui doit devenir évident ?</span></h2>
        <p>Avant de choisir un nombre de pages, un outil ou une nouvelle campagne, vérifiez ce que votre activité a réellement besoin de clarifier.</p>
        <a class="cta" href="#test">Faire le test gratuit <span>→</span></a>
        <div class="v3-final-reassurance"><span>3 minutes</span><span>Gratuit</span><span>Résultat immédiat</span><span>Recommandation personnalisée</span></div>`;
    }

    const footer = $('.site-footer');
    if (footer) {
      const nav = $('.footer-nav', footer);
      if (nav) nav.innerHTML = `
        <a href="#approche">Approche</a>
        <a href="#strategie">Stratégie</a>
        <a href="#projets">Projets</a>
        <a href="#realisations">Réalisations</a>
        <span class="footer-upcoming">Formation <em>À venir</em></span>
        <span class="footer-upcoming">Consulting <em>À venir</em></span>
        <span class="footer-upcoming">Blog <em>À venir</em></span>`;
    }

    const ordered = [proof, statement, prequiz, strategy, strategicDocument, deployment, projects, bundles, technical, process, realisations, reviews, about, faq, final].filter(Boolean);
    ordered.forEach(node => main.append(node));

    const headerLinks = $('.site-header__links');
    if (headerLinks) headerLinks.innerHTML = `
      <a class="site-header__link" href="#approche">Approche</a>
      <a class="site-header__link" href="#strategie">Stratégie</a>
      <a class="site-header__link" href="#projets">Projets</a>
      <a class="site-header__link" href="#fonctionnalites">Bundles</a>
      <a class="site-header__link" href="#realisations">Réalisations</a>
      <a class="site-header__link" href="#avis">Avis</a>
      <a class="site-header__link" href="#studio">Studio</a>
      <a class="site-header__link" href="#faq">FAQ</a>`;

    const mobileLinks = $('.site-mobile-menu__links');
    if (mobileLinks) mobileLinks.innerHTML = `
      <a href="#approche">Approche</a><a href="#strategie">Stratégie</a><a href="#projets">Projets</a><a href="#fonctionnalites">Bundles</a><a href="#realisations">Réalisations</a><a href="#avis">Avis</a><a href="#studio">Studio</a><a href="#faq">FAQ</a>`;

    $$('a[href="#diagnostic"],a[href="#prediagnostic"]').forEach(link => link.setAttribute('href', '#test'));
    $$('.site-header__cta').forEach(link => { link.setAttribute('href', '#test'); link.textContent = 'Faire le test gratuit'; });

    initProjectSelector(projects);
    initBundles(bundles);
    initProcess(process);
    initReveals(main);
  };

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', mount, { once: true });
  else mount();
})();
