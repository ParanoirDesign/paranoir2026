(() => {
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

  const linkedinUrl = 'https://www.linkedin.com/in/victoria-dury-paranoir/';
  const instagramUrl = 'https://www.instagram.com/paranoir_studio/';
  const whatsappBase = 'https://wa.me/33637432180';

  const section = (className, id, inner) => {
    const el = document.createElement('section');
    el.className = `home-section ${className}`;
    if (id) el.id = id;
    el.innerHTML = `<div class="home-section__inner">${inner}</div>`;
    return el;
  };

  const cycleNode = (index, text) => `<div class="cycle-node cycle-node--${index}">${text}</div>`;

  const problemSection = () => section('cycle-section cycle-section--problem', 'approche', `
    <div class="cycle-wrap">
      <div class="cycle-copy">
        <p class="home-kicker">Quand le message se dérègle</p>
        <h2>Le client ne devrait pas avoir à deviner ce que vous faites.</h2>
        <p class="home-lede">Votre activité peut évoluer plus vite que votre communication. Le problème commence souvent là.</p>
        <div class="cycle-copy__note">La solution n’est pas d’en dire davantage. C’est de repartir d’une base commune.</div>
      </div>
      <div class="cycle-visual" aria-label="Cercle vicieux de la perte de clarté">
        <div class="cycle-ring">
          <div class="cycle-arrow" aria-hidden="true"></div>
          <div class="cycle-center"><strong>Plus de communication.<br>Pas forcément plus de clarté.</strong></div>
          ${cycleNode(1, 'Votre activité évolue')}
          ${cycleNode(2, 'Votre offre devient plus difficile à résumer')}
          ${cycleNode(3, 'Site, réseaux et Google ne racontent plus la même chose')}
          ${cycleNode(4, 'Le client hésite ou comprend mal votre différence')}
          ${cycleNode(5, 'Vous ajoutez du contenu pour mieux expliquer')}
          ${cycleNode(6, 'Votre message devient encore plus difficile à suivre')}
        </div>
      </div>
    </div>
  `);

  const processSection = () => section('process-section', 'methode', `
    <div class="home-section__head">
      <p class="home-kicker">Du diagnostic à la mise en ligne</p>
      <h2>Vous savez ce qu’on fait, ce que vous recevez et ce qui vient ensuite.</h2>
    </div>
    <div class="process-grid">
      <article class="home-card process-step">
        <span class="process-step__num">01</span>
        <h3>Vous nous donnez le contexte</h3>
        <p>Votre activité, vos offres, vos clients, ce qui existe déjà et ce qui vous pose problème.</p>
        <p class="process-step__accent">Pas besoin de préparer un dossier. Nous allons chercher l’information avec vous.</p>
      </article>
      <article class="home-card process-step">
        <span class="process-step__num">02</span>
        <h3>Nous mettons tout à plat ensemble</h3>
        <p>Nous confrontons ce que vous voulez transmettre à ce que vos clients doivent réellement comprendre.</p>
        <p class="process-step__accent">Nous décidons ensemble ce qui doit rester, ce qui doit évoluer et ce qui doit passer en premier.</p>
      </article>
      <article class="home-card process-step">
        <span class="process-step__num">03</span>
        <h3>Vous recevez votre dossier stratégique complet</h3>
        <div class="deliverables">
          <div class="deliverable"><strong>Fondations</strong><span>Analyse de l’existant · Mission & vision · Positionnement</span></div>
          <div class="deliverable"><strong>Offres & message</strong><span>Offres · Messages clés · Réponses aux objections clients</span></div>
          <div class="deliverable"><strong>Identité & site</strong><span>Charte graphique · Arborescence · Organisation des contenus</span></div>
          <div class="deliverable"><strong>Déploiement</strong><span>Guide réseau social · Guide fiche Google · Plan d’action 30 jours</span></div>
        </div>
        <p class="process-step__accent">Vous savez quoi dire, comment le montrer et dans quel ordre avancer.</p>
      </article>
      <article class="home-card process-step">
        <span class="process-step__num">04</span>
        <h3>Nous le déployons avec vous</h3>
        <p>Nous construisons et mettons votre site en ligne, optimisons votre réseau social principal et votre fiche Google Business Profile, puis nous vous accompagnons dans leur mise en œuvre.</p>
        <p>La restitution validée ensemble devient le document de référence de tout le déploiement.</p>
        <p class="process-step__accent">Vous ne repartez pas avec un rapport à appliquer seul. Vous repartez avec une stratégie déjà mise en mouvement.</p>
      </article>
    </div>
  `);

  const diagnosticMarkup = () => `
    <div class="home-card diagnostic-shell">
      <div class="diagnostic-intro">
        <h2>Faites votre diagnostic gratuit</h2>
        <p class="diagnostic-promise">7 questions. 3 minutes max. Une première réponse claire, sans engagement.</p>
      </div>
      <form class="diagnostic-form" id="diagnosticForm" novalidate>
        <div class="diagnostic-progress" aria-live="polite">
          <span id="diagProgressLabel">Question 1 sur 7</span>
          <span class="diagnostic-progress__track" aria-hidden="true"><span class="diagnostic-progress__bar" id="diagProgressBar"></span></span>
        </div>

        <fieldset class="diagnostic-step is-active" data-step="0" data-name="etat">
          <legend><h3>Où en est votre activité aujourd’hui ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="etat" value="launch">Je lance mon activité</label>
            <label class="diagnostic-choice"><input type="radio" name="etat" value="active_comms">Mon activité fonctionne déjà, mais ma communication ne suit plus</label>
            <label class="diagnostic-choice"><input type="radio" name="etat" value="change">Je change de positionnement ou d’offres</label>
            <label class="diagnostic-choice"><input type="radio" name="etat" value="site_gap">J’ai déjà un site, mais il ne correspond plus à mon activité</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="1" data-name="offres">
          <legend><h3>Combien d’offres vos clients doivent-ils comprendre ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="offres" value="one">Une offre principale</label>
            <label class="diagnostic-choice"><input type="radio" name="offres" value="few">Deux ou trois offres</label>
            <label class="diagnostic-choice"><input type="radio" name="offres" value="many">Quatre offres ou plus</label>
            <label class="diagnostic-choice"><input type="radio" name="offres" value="unknown">Je ne sais pas encore comment les organiser</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="2" data-name="comprehension">
          <legend><h3>Quelqu’un qui vous découvre comprend-il rapidement ce que vous vendez ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="comprehension" value="yes">Oui, sans problème</label>
            <label class="diagnostic-choice"><input type="radio" name="comprehension" value="roughly">À peu près</label>
            <label class="diagnostic-choice"><input type="radio" name="comprehension" value="no">Non</label>
            <label class="diagnostic-choice"><input type="radio" name="comprehension" value="unknown">Je ne sais pas</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="3" data-name="alignement">
          <legend><h3>Votre site, votre réseau social et votre fiche Google racontent-ils la même chose ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="alignement" value="yes">Oui</label>
            <label class="diagnostic-choice"><input type="radio" name="alignement" value="partial">En partie</label>
            <label class="diagnostic-choice"><input type="radio" name="alignement" value="no">Non</label>
            <label class="diagnostic-choice"><input type="radio" name="alignement" value="missing">Je n’ai pas encore les trois</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="4" data-name="existant">
          <legend><h3>Qu’avez-vous déjà aujourd’hui ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="checkbox" name="existant" value="site">Un site internet</label>
            <label class="diagnostic-choice"><input type="checkbox" name="existant" value="social">Un réseau social actif</label>
            <label class="diagnostic-choice"><input type="checkbox" name="existant" value="gmb">Une fiche Google Business Profile</label>
            <label class="diagnostic-choice"><input type="checkbox" name="existant" value="identity">Une identité visuelle</label>
            <label class="diagnostic-choice"><input type="checkbox" name="existant" value="nothing" data-exclusive="true">Rien de vraiment structuré</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez au moins une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="5" data-name="frein">
          <legend><h3>Qu’est-ce qui vous freine le plus aujourd’hui ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="frein" value="visibility">On ne me trouve pas assez</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="clarity">Les gens ne comprennent pas assez vite ce que je propose</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="conversion">J’ai des visites, mais trop peu de demandes</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="scatter">Ma communication part dans tous les sens</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="site_old">Mon site ne correspond plus à mon activité</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="offer_change">Mon offre a changé et je dois tout remettre au clair</label>
            <label class="diagnostic-choice"><input type="radio" name="frein" value="starting">Je démarre et je ne sais pas par quoi commencer</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour continuer.</p>
        </fieldset>

        <fieldset class="diagnostic-step" data-step="6" data-name="priorite">
          <legend><h3>Quelle est votre priorité maintenant ?</h3></legend>
          <div class="diagnostic-options">
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="understood">Être compris plus rapidement</label>
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="qualified">Obtenir davantage de demandes qualifiées</label>
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="offers">Mieux présenter mes différentes offres</label>
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="site">Refaire mon site</label>
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="align">Aligner mon site, mes réseaux et Google</label>
            <label class="diagnostic-choice"><input type="radio" name="priorite" value="plan">Savoir clairement quoi faire dans les prochaines semaines</label>
          </div>
          <p class="diagnostic-error" role="alert">Choisissez une réponse pour obtenir votre diagnostic.</p>
        </fieldset>

        <div class="diagnostic-actions">
          <button class="diagnostic-btn" id="diagBack" type="button" disabled>Retour</button>
          <button class="diagnostic-btn diagnostic-btn--primary" id="diagNext" type="button">Continuer</button>
          <button class="diagnostic-btn diagnostic-btn--primary" id="diagSubmit" type="submit" hidden>Voir mon diagnostic</button>
        </div>
      </form>
      <div class="diagnostic-result" id="diagnosticResult" tabindex="-1"></div>
    </div>
  `;

  const diagnosticSection = () => section('diagnostic-section', 'diagnostic', diagnosticMarkup());

  const offersSection = () => section('offers-section', 'projets', `
    <div class="home-section__head">
      <p class="home-kicker">Deux situations, deux formats</p>
      <h2>Le bon format dépend surtout de ce que vos clients doivent comprendre.</h2>
      <p class="home-lede">Le diagnostic nous permet de confirmer le format adapté avant de commencer.</p>
    </div>
    <div class="offers-grid">
      <article class="home-card offer-card-v3">
        <p class="offer-card-v3__kicker">Vous avez une offre principale</p>
        <h3>Une page claire peut suffire.</h3>
        <p class="offer-card-v3__price">990 € HT</p>
        <p class="offer-card-v3__intro">Ce format correspond notamment à une entreprise qui :</p>
        <ul class="offer-situations">
          <li>se lance ou relance son activité ;</li>
          <li>vend principalement une offre ou un service ;</li>
          <li>possède un ancien site qui ne correspond plus à ce qu’elle fait aujourd’hui ;</li>
          <li>a besoin d’expliquer clairement son activité, rassurer et permettre une prise de contact ;</li>
          <li>n’a pas besoin de multiplier les pages pour être comprise.</li>
        </ul>
        <div class="offer-delivery">
          <span>Site en une page</span>
          <span>Réseau social principal optimisé</span>
          <span>Fiche Google Business Profile optimisée</span>
        </div>
        <p class="offer-card-v3__intro">Avec le travail stratégique nécessaire pour que les trois racontent la même chose.</p>
        <a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a>
      </article>
      <article class="home-card offer-card-v3">
        <p class="offer-card-v3__kicker">Vous avez plusieurs offres, publics ou sujets à expliquer</p>
        <h3>Il faut organiser avant d’ajouter des pages.</h3>
        <p class="offer-card-v3__price">À partir de 3 290 € HT</p>
        <p class="offer-card-v3__intro">Ce format correspond notamment à une entreprise qui :</p>
        <ul class="offer-situations">
          <li>propose plusieurs services ou plusieurs offres ;</li>
          <li>s’adresse à plusieurs types de clients ;</li>
          <li>possède un site devenu difficile à suivre au fil des années ;</li>
          <li>a fait évoluer son activité sans faire évoluer toute sa communication ;</li>
          <li>doit créer des pages spécifiques pour être trouvée sur Google ;</li>
          <li>doit aider différents visiteurs à trouver rapidement ce qui les concerne.</li>
        </ul>
        <div class="offer-delivery">
          <span>Site de 5 à 15 pages</span>
          <span>Organisation du site et de la navigation</span>
          <span>Réseau social principal optimisé</span>
          <span>Fiche Google Business Profile optimisée</span>
        </div>
        <p class="offer-card-v3__intro">Avec un travail plus approfondi sur vos offres, vos messages et l’organisation des contenus.</p>
        <a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a>
      </article>
    </div>
  `);

  const aiSection = () => section('ai-section', 'ia', `
    <div class="home-card ai-section__panel">
      <div class="ai-grid">
        <div class="ai-manifesto">
          <p class="home-kicker">L’IA accélère. Elle ne décide pas.</p>
          <h2>L’IA peut construire un site. Elle ne sait pas décider à votre place.</h2>
          <p>Chez Paranoir, nous utilisons l’intelligence artificielle pour rechercher, analyser, prototyper, automatiser et produire plus efficacement.</p>
          <p>Mais nous ne lui confions pas les décisions qui devront encore être bonnes demain : votre message, l’organisation de vos contenus, les choix techniques et la manière dont votre site devra évoluer.</p>
          <div class="ai-callout">L’IA est un outil.<br>Pas un technicien.</div>
        </div>
        <div class="ai-points">
          <div class="ai-point"><strong>Un site généré peut sembler terminé très vite.</strong><span>La vraie difficulté apparaît quand il faut ajouter une offre, une page, une fonctionnalité ou faire évoluer le référencement.</span></div>
          <div class="ai-point"><strong>Une architecture non pensée vieillit mal.</strong><span>Chaque évolution peut devenir plus fragile, plus compliquée ou plus coûteuse si personne n’a prévu comment le site devait être repris et maintenu.</span></div>
          <div class="ai-point"><strong>Nous utilisons l’IA pour aller plus vite.</strong><span>Nous gardons les décisions humaines qui rendent votre site maintenable, évolutif et pérenne.</span></div>
          <div class="ai-point"><strong>Votre activité va évoluer.</strong><span>Votre site doit pouvoir suivre sans devoir être entièrement reconstruit à chaque changement.</span></div>
        </div>
      </div>
    </div>
  `);

  const experienceSection = () => section('cycle-section cycle-section--positive', 'experience', `
    <div class="cycle-wrap">
      <div class="cycle-copy">
        <p class="home-kicker">Ce que vous vivez avec nous</p>
        <h2>Pas de boîte noire entre le premier échange et la mise en ligne.</h2>
        <span class="editorial-accent">Vous comprenez les choix. Vous savez où on va. Vous gardez la main.</span>
      </div>
      <div class="cycle-visual" aria-label="Cercle vertueux de l’accompagnement Paranoir">
        <div class="cycle-ring">
          <div class="cycle-arrow" aria-hidden="true"></div>
          <div class="cycle-center"><strong>Un projet compris est plus facile à faire vivre.</strong></div>
          ${cycleNode(1, 'Vous nous expliquez votre activité avec vos mots')}
          ${cycleNode(2, 'Nous remettons les informations dans le bon ordre')}
          ${cycleNode(3, 'Nous expliquons chaque recommandation simplement')}
          ${cycleNode(4, 'Vous validez les décisions importantes')}
          ${cycleNode(5, 'Vous les voyez prendre forme sur vos supports')}
          ${cycleNode(6, 'Vous gardez les repères pour continuer et évoluer')}
        </div>
      </div>
    </div>
  `);

  const studioSection = () => section('studio-v3', 'studio', `
    <div class="studio-grid">
      <div class="home-card studio-photo">
        <picture>
          <source srcset="/assets/images/alexandre-victoria-paranoir-opti.webp" type="image/webp">
          <img src="/assets/images/alexandre-victoria-paranoir-opti.png" alt="Victoria et Alexandre, Paranoir Studio" width="800" height="1202" loading="lazy">
        </picture>
      </div>
      <div class="home-card studio-copy">
        <p class="home-kicker">Victoria + Alexandre</p>
        <h2>Deux expertises. Un seul projet.</h2>
        <div class="studio-copy__roles">
          <div class="studio-role"><strong>Victoria</strong><span>Clarifie l’offre, le message, l’expérience et la direction visuelle.</span></div>
          <div class="studio-role"><strong>Alexandre</strong><span>Transforme ces choix en un site fiable, rapide et capable d’évoluer avec votre activité.</span></div>
        </div>
        <p class="home-lede">Vous travaillez directement avec nous, du premier échange à la mise en ligne.</p>
        <p class="studio-signature">La stratégie sait où aller. La technique sait comment y arriver.</p>
        <div class="credentials">
          <h3>Diplômes & certifications</h3>
          <div class="credentials-grid">
            <div class="credential-person">
              <strong>Victoria Dury</strong>
              <ul>
                <li><b>Accessibilité numérique RGAA</b> · UX Vision</li>
                <li><b>Marketing Digital</b> · Learning Shelter</li>
                <li><b>Directrice artistique UX-UI</b> · Fonderie de l’image</li>
                <li><b>UI Designer / Intégration web</b> · Fonderie de l’image</li>
              </ul>
            </div>
            <div class="credential-person">
              <strong>Alexandre Dury</strong>
              <ul>
                <li><b>Développeur WordPress</b> · CFM</li>
                <li><b>Direction artistique</b> · Fonderie de l’image</li>
                <li><b>Chef de projet</b> · Fonderie de l’image</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  `);

  const experienceRailSection = () => section('experience-rail', 'experiences', `
    <div class="experience-rail__head">
      <div><p class="home-kicker">Au fil de nos parcours</p><h2>Nous avons travaillé avec des entreprises de toutes tailles.</h2></div>
    </div>
    <div class="brand-marquee" aria-label="Entreprises rencontrées au fil de nos parcours professionnels">
      <div class="brand-marquee__track">
        ${['Aéroport de Paris','Michelin','Alfa Romeo','AG2R','MMA','MSA','Aéroport de Paris','Michelin','Alfa Romeo','AG2R','MMA','MSA'].map(name => `<span class="brand-word">${name}</span>`).join('')}
      </div>
    </div>
  `);

  const faqSection = () => section('faq-v3', 'faq', `
    <div class="home-section__head">
      <h2>FAQ</h2>
    </div>
    <div class="faq-v3__list">
      <details><summary>Pourquoi commencer par le diagnostic gratuit ?</summary><p>Parce qu’avant de parler de pages, de fonctionnalités ou de budget, il faut comprendre ce qui bloque réellement. En 7 questions, vous obtenez une première direction et évitez de choisir seul une solution qui n’est peut-être pas adaptée.</p></details>
      <details><summary>Que se passe-t-il après le diagnostic ?</summary><p>Vous obtenez une première lecture de votre situation. Nous pouvons ensuite reprendre vos réponses avec vous, approfondir les points importants et confirmer le format adapté. Vous n’avez pas besoin de tout réexpliquer.</p></details>
      <details><summary>Quelle différence entre le projet à 990 € HT et celui à partir de 3 290 € HT ?</summary><p>Le premier correspond aux activités qui peuvent concentrer leur offre et leur message sur une seule page. Le second convient aux entreprises qui doivent présenter plusieurs offres, plusieurs publics, davantage de contenus ou travailler leur visibilité sur plusieurs pages. Le diagnostic permet de confirmer le bon format.</p></details>
      <details><summary>Pourquoi travailler avec Paranoir plutôt qu’avec une agence classique ?</summary><p>Parce que vous ne venez pas simplement acheter un site. Paranoir est un studio implanté sur son territoire, avec une volonté de travailler durablement avec les entreprises qui l’entourent et de faire circuler les compétences localement. Nous avons plusieurs années d’expérience et plus de 60 entreprises accompagnées. Vous pouvez venir nous voir pour un site. Vous repartez avec une stratégie claire, un plan d’action, un site construit autour de cette stratégie et des supports alignés pour continuer à communiquer. Et vous travaillez directement avec un binôme stratégie + technique qui a déjà fait ses preuves.</p></details>
      <details><summary>Peut-on tout faire à distance ?</summary><p>Oui. Nous travaillons aussi bien avec des entreprises du territoire qu’avec des clients ailleurs en France. Les échanges peuvent se faire en visioconférence et sur WhatsApp.</p></details>
    </div>
  `);

  const finalSection = () => section('final-v3', 'cta-final', `
    <div class="final-v3__panel">
      <h2>Vous ne savez pas encore ce qu’il faut refaire ? C’est justement par là qu’on commence.</h2>
      <p><strong>7 questions. 3 minutes max.</strong><br>Identifiez ce qui brouille votre communication avant d’engager du temps ou du budget au mauvais endroit.</p>
      <div class="final-v3__actions">
        <a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a>
        <a class="diagnostic-btn" href="${whatsappBase}?text=${encodeURIComponent('Bonjour Paranoir, je souhaite échanger sur mon projet et mon diagnostic.')}" target="_blank" rel="noopener noreferrer">Échanger sur WhatsApp</a>
      </div>
      <p class="final-v3__micro">Gratuit · Sans engagement</p>
    </div>
  `);

  const proofSection = () => section('home-proof', 'preuve', `
    <div class="home-proof__grid">
      <div class="home-proof__item"><strong>+60</strong><span>entreprises accompagnées</span></div>
      <div class="home-proof__item"><strong>★★★★★ 5/5</strong><span>sur Google</span></div>
      <div class="home-proof__item"><strong>Des conseils en continu</strong><div class="home-proof__links"><a href="${linkedinUrl}" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a><a href="${instagramUrl}" target="_blank" rel="noopener noreferrer">Instagram ↗</a></div></div>
    </div>
  `);

  const enhanceRealisations = (realisations) => {
    if (!realisations) return;
    realisations.id = 'realisations';
    const kicker = $('.real-header .kicker', realisations);
    const title = $('.real-header h2', realisations);
    if (kicker) kicker.textContent = 'Réalisations';
    if (title) title.innerHTML = 'Des problèmes différents. <span class="highlight">Des réponses visibles.</span>';

    const tags = [
      ['Positionnement','Message','Site'],
      ['Positionnement','Site','Référencement'],
      ['Identité','Message','Site']
    ];
    $$('.real-card', realisations).forEach((card, index) => {
      const offer = $('.real-offer', card);
      if (!offer) return;
      offer.innerHTML = (tags[index] || []).map(tag => `<span>${tag}</span>`).join('');
    });
  };

  const enhanceReviews = (reviews) => {
    if (!reviews) return;
    reviews.id = 'avis';
    const kicker = $('.reviews-head .kicker', reviews);
    const title = $('.reviews-head h2', reviews);
    if (kicker) kicker.textContent = 'Ils ont travaillé avec nous';
    if (title) title.textContent = 'Le résultat compte. La façon d’y arriver aussi.';
  };

  const updateNavigation = () => {
    const navLinks = $$('.site-header__links .site-header__link');
    const navMap = [
      ['Approche','#approche'],
      ['Diagnostic','#diagnostic'],
      ['Offres','#projets'],
      ['Réalisations','#realisations'],
      ['Avis','#avis'],
      ['Studio','#studio'],
      ['FAQ','#faq']
    ];
    navLinks.forEach((link, index) => {
      if (!navMap[index]) return;
      link.textContent = navMap[index][0];
      link.setAttribute('href', navMap[index][1]);
    });

    const mobileLinks = $$('.site-mobile-menu__links a');
    mobileLinks.forEach((link, index) => {
      if (!navMap[index]) return;
      link.textContent = navMap[index][0];
      link.setAttribute('href', navMap[index][1]);
    });

    $$('.site-header__cta').forEach(link => {
      link.textContent = 'Diagnostic gratuit';
      link.setAttribute('href', '#diagnostic');
    });

    const heroCta = $('.hero .hero-actions .cta');
    if (heroCta) {
      heroCta.innerHTML = 'Commencer mon diagnostic gratuit <span>→</span>';
      heroCta.setAttribute('href', '#diagnostic');
    }
  };

  const updateFooter = () => {
    const footerNav = $('.site-footer nav:not(.site-footer-links)');
    if (footerNav) {
      footerNav.innerHTML = `
        <a href="#approche">Approche</a>
        <a href="#diagnostic">Diagnostic gratuit</a>
        <a href="#projets">Offres</a>
        <a href="#realisations">Réalisations</a>
        <a href="#avis">Avis</a>
        <a href="#studio">Studio</a>
        <a href="#faq">FAQ</a>`;
    }
    const footerContact = $('.footer-contact');
    if (footerContact) {
      footerContact.innerHTML = `
        <a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a>
        <a href="${linkedinUrl}" target="_blank" rel="noopener noreferrer">LinkedIn →</a>
        <a href="${instagramUrl}" target="_blank" rel="noopener noreferrer">Instagram →</a>`;
    }
  };

  const initSmoothLinks = () => {
    document.addEventListener('click', event => {
      const link = event.target.closest('a[href^="#"]');
      if (!link) return;
      const href = link.getAttribute('href');
      if (!href || href === '#') return;
      const target = $(href);
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block: 'start' });
    });
  };

  const diagnosticResults = {
    A: {
      title: 'Votre priorité : clarifier avant de communiquer davantage.',
      text: 'Votre principal frein semble être le message. Si un client doit réfléchir pour comprendre ce que vous vendez, ajouter des pages ou des publications ne corrigera pas le problème de fond.',
      priority: ['Offre','Message','Preuves','Supports']
    },
    B: {
      title: 'Votre priorité : remettre vos supports dans le même sens.',
      text: 'Votre offre semble comprise, mais votre communication ne raconte pas encore exactement la même chose partout. Vous n’avez probablement pas besoin de tout jeter. Il faut d’abord réaligner ce qui existe.',
      priority: ['Message commun','Site','Réseau social','Fiche Google']
    },
    C: {
      title: 'Votre priorité : organiser une activité devenue plus complexe.',
      text: 'Votre entreprise a évolué plus vite que sa communication. Plusieurs offres, contenus ou types de clients demandent maintenant une organisation plus claire.',
      priority: ['Offres','Hiérarchie','Organisation du site','Messages']
    },
    D: {
      title: 'Votre priorité : mieux exploiter des bases déjà solides.',
      text: 'Votre message paraît cohérent et plusieurs supports sont déjà en place. L’enjeu est maintenant de mieux transformer cette base en visibilité et en demandes.',
      priority: ['Appels à l’action','Référencement','Fiche Google','Contenus','Suivi']
    },
    E: {
      title: 'Votre priorité : construire dans le bon ordre.',
      text: 'Vous démarrez avec encore peu de choses en place. C’est justement l’occasion d’éviter de construire des supports qu’il faudra reprendre quelques mois plus tard.',
      priority: ['Offre','Message','Identité','Site','Réseau social','Fiche Google']
    }
  };

  const calculateResult = (data) => {
    const score = { A: 0, B: 0, C: 0, D: 0, E: 0 };
    const add = (key, points) => { score[key] += points; };
    const etat = data.get('etat');
    const offres = data.get('offres');
    const comprehension = data.get('comprehension');
    const alignement = data.get('alignement');
    const existant = data.getAll('existant');
    const frein = data.get('frein');
    const priorite = data.get('priorite');

    if (etat === 'launch') add('E', 4);
    if (etat === 'active_comms') { add('B', 3); add('D', 1); }
    if (etat === 'change') { add('C', 2); add('A', 2); }
    if (etat === 'site_gap') { add('B', 3); add('C', 1); }

    if (offres === 'one') add('D', 1);
    if (offres === 'few') add('C', 2);
    if (offres === 'many') add('C', 5);
    if (offres === 'unknown') { add('A', 2); add('C', 3); }

    if (comprehension === 'yes') add('D', 3);
    if (comprehension === 'roughly') { add('A', 3); add('B', 1); }
    if (comprehension === 'no') add('A', 5);
    if (comprehension === 'unknown') add('A', 4);

    if (alignement === 'yes') add('D', 3);
    if (alignement === 'partial') add('B', 4);
    if (alignement === 'no') add('B', 5);
    if (alignement === 'missing') { add('E', 2); add('B', 1); }

    if (existant.includes('nothing')) add('E', 5);
    const structuredCount = ['site','social','gmb','identity'].filter(item => existant.includes(item)).length;
    if (structuredCount >= 3) add('D', 3);
    else if (structuredCount === 2) add('B', 1);

    if (frein === 'visibility') add('D', 4);
    if (frein === 'clarity') add('A', 5);
    if (frein === 'conversion') { add('D', 4); add('A', 1); }
    if (frein === 'scatter') add('B', 5);
    if (frein === 'site_old') add('B', 4);
    if (frein === 'offer_change') { add('C', 4); add('A', 2); }
    if (frein === 'starting') add('E', 5);

    if (priorite === 'understood') add('A', 5);
    if (priorite === 'qualified') add('D', 4);
    if (priorite === 'offers') add('C', 5);
    if (priorite === 'site') { add('B', 2); add('C', 2); }
    if (priorite === 'align') add('B', 5);
    if (priorite === 'plan') { add('E', 3); add('A', 1); }

    const order = ['E','C','A','B','D'];
    let winner = order.reduce((best, key) => score[key] > score[best] ? key : best, order[0]);

    if ((etat === 'launch' || existant.includes('nothing')) && score.E >= score[winner] - 1) winner = 'E';
    else if ((offres === 'many' || priorite === 'offers') && score.C >= score[winner] - 1) winner = 'C';
    else if ((comprehension === 'no' || comprehension === 'unknown') && score.A >= score[winner] - 1) winner = 'A';
    else if ((alignement === 'no' || priorite === 'align') && score.B >= score[winner] - 1) winner = 'B';

    return { code: winner, score };
  };

  const initDiagnostic = () => {
    const form = $('#diagnosticForm');
    if (!form) return;
    const steps = $$('.diagnostic-step', form);
    const back = $('#diagBack', form);
    const next = $('#diagNext', form);
    const submit = $('#diagSubmit', form);
    const label = $('#diagProgressLabel', form);
    const bar = $('#diagProgressBar', form);
    const resultBox = $('#diagnosticResult');
    let current = 0;
    let latestPayload = null;

    const render = () => {
      steps.forEach((step, index) => step.classList.toggle('is-active', index === current));
      label.textContent = `Question ${current + 1} sur ${steps.length}`;
      bar.style.width = `${((current + 1) / steps.length) * 100}%`;
      back.disabled = current === 0;
      next.hidden = current === steps.length - 1;
      submit.hidden = current !== steps.length - 1;
      steps[current]?.querySelector('input')?.focus({ preventScroll: true });
    };

    const validate = () => {
      const step = steps[current];
      if (!step) return true;
      const name = step.dataset.name;
      const checked = $$(`input[name="${name}"]:checked`, step);
      const valid = checked.length > 0;
      step.classList.toggle('has-error', !valid);
      return valid;
    };

    form.addEventListener('change', event => {
      const input = event.target;
      const step = input.closest('.diagnostic-step');
      step?.classList.remove('has-error');
      if (input.type === 'checkbox' && input.name === 'existant') {
        const exclusive = input.dataset.exclusive === 'true';
        const group = $$('input[name="existant"]', step);
        if (exclusive && input.checked) group.forEach(other => { if (other !== input) other.checked = false; });
        if (!exclusive && input.checked) group.forEach(other => { if (other.dataset.exclusive === 'true') other.checked = false; });
      }
    });

    back.addEventListener('click', () => {
      current = Math.max(0, current - 1);
      render();
    });

    next.addEventListener('click', () => {
      if (!validate()) return;
      current = Math.min(steps.length - 1, current + 1);
      render();
    });

    form.addEventListener('submit', event => {
      event.preventDefault();
      if (!validate()) return;
      const data = new FormData(form);
      const outcome = calculateResult(data);
      const result = diagnosticResults[outcome.code];
      const whatsappText = encodeURIComponent(`Bonjour Paranoir, je viens de faire mon diagnostic gratuit. Mon résultat est : ${result.title} Je souhaite en parler avec vous.`);

      latestPayload = {
        etat: data.get('etat'),
        offres: data.get('offres'),
        comprehension: data.get('comprehension'),
        alignement: data.get('alignement'),
        existant: data.getAll('existant'),
        frein: data.get('frein'),
        priorite: data.get('priorite'),
        resultatCode: outcome.code,
        resultat: result.title
      };

      form.hidden = true;
      resultBox.innerHTML = `
        <p class="diagnostic-result__label">Votre diagnostic</p>
        <h3>${result.title}</h3>
        <p class="diagnostic-result__text">${result.text}</p>
        <div class="diagnostic-priority" aria-label="Ordre de traitement recommandé">${result.priority.map(item => `<span>${item}</span>`).join('<b aria-hidden="true">→</b>')}</div>
        <div class="diagnostic-result__cta">
          <h4>Vous voulez transformer ce diagnostic en plan concret ?</h4>
          <p>Nous reprenons vos réponses avec vous et vous montrons ce que nous traiterions en priorité. Vous n’aurez pas besoin de tout réexpliquer.</p>
          <div class="diagnostic-result__buttons">
            <button class="diagnostic-btn diagnostic-btn--primary" id="openDiagnosticContact" type="button">Parler de mon diagnostic</button>
            <a class="diagnostic-btn" href="${whatsappBase}?text=${whatsappText}" target="_blank" rel="noopener noreferrer">Continuer sur WhatsApp</a>
          </div>
          <div class="diagnostic-contact" id="diagnosticContact">
            <div class="diagnostic-contact__grid">
              <label>Prénom<input id="diagPrenom" name="prenom" autocomplete="given-name" required></label>
              <label>Email<input id="diagEmail" name="email" type="email" autocomplete="email" required></label>
            </div>
            <button class="diagnostic-btn diagnostic-btn--primary" id="sendDiagnostic" type="button" style="margin-top:14px">Envoyer mes réponses</button>
            <p class="diagnostic-contact__status" id="diagnosticContactStatus" aria-live="polite"></p>
          </div>
          <p class="diagnostic-result__text" style="font-size:12px;margin-top:16px">Sans engagement.</p>
        </div>`;
      resultBox.classList.add('is-active');
      resultBox.focus({ preventScroll: true });
      resultBox.scrollIntoView({ behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block: 'center' });

      $('#openDiagnosticContact')?.addEventListener('click', () => {
        const contact = $('#diagnosticContact');
        contact.classList.add('is-open');
        $('#diagPrenom')?.focus();
      });

      $('#sendDiagnostic')?.addEventListener('click', async () => {
        const prenom = $('#diagPrenom')?.value.trim() || '';
        const email = $('#diagEmail')?.value.trim() || '';
        const status = $('#diagnosticContactStatus');
        const button = $('#sendDiagnostic');
        if (!prenom || !email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          status.textContent = 'Renseignez un prénom et une adresse email valide.';
          return;
        }
        button.disabled = true;
        status.textContent = 'Envoi en cours…';
        try {
          const response = await fetch('/mail.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ...latestPayload, prenom, email })
          });
          const json = await response.json();
          if (!response.ok || !json.ok) throw new Error(json.error || 'Erreur');
          status.textContent = 'C’est envoyé. Nous avons vos réponses, vous n’aurez pas à recommencer.';
          button.textContent = '✓ Diagnostic envoyé';
        } catch (error) {
          status.textContent = 'L’envoi n’a pas abouti. Vous pouvez réessayer ou continuer sur WhatsApp.';
          button.disabled = false;
        }
      });
    });

    render();
  };

  const initReveal = () => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const targets = $$('.home-v3 .home-section__head, .home-v3 .home-card, .home-v3 .cycle-copy, .home-v3 .cycle-visual, .home-v3 .home-proof__item');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.animate([
          { opacity: 0, transform: 'translateY(14px)' },
          { opacity: 1, transform: 'translateY(0)' }
        ], { duration: 520, easing: 'cubic-bezier(.2,.7,.2,1)', fill: 'both' });
        observer.unobserve(entry.target);
      });
    }, { threshold: .12 });
    targets.forEach(target => observer.observe(target));
  };

  const mount = () => {
    const main = $('#main');
    const hero = $('.hero', main);
    if (!main || !hero || document.body.classList.contains('home-v3')) return;
    document.body.classList.add('home-v3');

    const realisations = $('.realisations', main);
    const reviews = $('.google-reviews', main);
    enhanceRealisations(realisations);
    enhanceReviews(reviews);

    $$(':scope > section', main).forEach(currentSection => {
      if (currentSection !== hero && currentSection !== realisations && currentSection !== reviews) currentSection.remove();
    });

    const sequenceBeforeWorks = [
      proofSection(),
      problemSection(),
      processSection(),
      diagnosticSection(),
      offersSection(),
      aiSection(),
      experienceSection()
    ];

    sequenceBeforeWorks.forEach(item => main.insertBefore(item, realisations || reviews || null));

    if (realisations) main.appendChild(realisations);
    if (reviews) main.appendChild(reviews);

    [studioSection(), experienceRailSection(), faqSection(), finalSection()].forEach(item => main.appendChild(item));

    updateNavigation();
    updateFooter();
    initSmoothLinks();
    initDiagnostic();
    initReveal();
  };

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mount), { once: true });
  else requestAnimationFrame(mount);
})();
