from pathlib import Path
import json
import os
import re
from urllib.parse import quote

version = os.environ.get("BUILD_VERSION", "dev")[:8]
whatsapp = "https://wa.me/33637432180?text=" + quote("Bonjour Paranoir, je souhaite échanger sur mon projet.")
linkedin = "https://www.linkedin.com/in/victoria-dury-paranoir/"
instagram = "https://www.instagram.com/paranoir_studio/"

index = Path("index.html")
html = index.read_text(encoding="utf-8")


def extract(pattern: str, source: str, label: str) -> str:
    match = re.search(pattern, source, flags=re.S)
    if not match:
        raise RuntimeError(f"Bloc introuvable pendant le build : {label}")
    return match.group(0)


def ensure_stylesheet(source: str, href: str, element_id: str | None = None) -> str:
    base = href.split("?", 1)[0]
    if base in source:
        source = re.sub(
            rf'<link([^>]*?)href="{re.escape(base)}(?:\?v=[^"]*)?"([^>]*)/?>',
            lambda m: f'<link{m.group(1)}href="{base}?v={version}"{m.group(2)}/>',
            source,
            count=1,
        )
        return source
    id_attr = f' id="{element_id}"' if element_id else ""
    tag = f'<link{id_attr} rel="stylesheet" href="{base}?v={version}"/>'
    return source.replace("</head>", tag + "\n</head>", 1)


# Métadonnées et données structurées
meta_description = (
    "Paranoir Studio clarifie votre offre, votre message et votre positionnement, "
    "puis déploie cette stratégie sur votre site internet, votre réseau social principal "
    "et votre fiche Google. Commencez par le test gratuit."
)

html = re.sub(
    r"<title>.*?</title>",
    "<title>Paranoir Studio — Stratégie, site internet, réseau social & fiche Google</title>",
    html,
    count=1,
    flags=re.S,
)
html = re.sub(r'<meta name="description" content="[^"]*"/>', f'<meta name="description" content="{meta_description}"/>', html, count=1)
html = re.sub(r'<meta property="og:description" content="[^"]*"/>', f'<meta property="og:description" content="{meta_description}"/>', html, count=1)
html = re.sub(r'<meta name="twitter:description" content="[^"]*"/>', f'<meta name="twitter:description" content="{meta_description}"/>', html, count=1)

schema = [
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "@id": "https://paranoir.fr/#organization",
        "name": "Paranoir Studio",
        "url": "https://paranoir.fr/",
        "slogan": "Du flou à l'évidence",
        "logo": {"@type": "ImageObject", "url": "https://paranoir.fr/assets/images/logo-paranoir-studio-noir-illu-hd.png"},
        "image": "https://paranoir.fr/assets/images/alexandre-victoria-paranoir-opti.webp",
        "email": "victoria@paranoir.me",
        "telephone": "+33637432180",
        "description": "Studio de stratégie et de déploiement digital. Paranoir clarifie l'offre, le positionnement et le message, puis les déploie sur le site internet, le réseau social principal et la fiche Google.",
        "foundingDate": "2018",
        "areaServed": "FR",
        "inLanguage": "fr",
        "knowsAbout": ["Stratégie d'offre", "Positionnement de marque", "Message marketing", "Site internet", "UX", "Accessibilité numérique", "Réseaux sociaux", "Google Business Profile"],
        "sameAs": [linkedin, instagram],
    },
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "@id": "https://paranoir.fr/#website",
        "url": "https://paranoir.fr/",
        "name": "Paranoir Studio",
        "description": meta_description,
        "inLanguage": "fr",
        "publisher": {"@id": "https://paranoir.fr/#organization"},
    },
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Projets Paranoir Studio",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "item": {"@type": "Service", "name": "Test gratuit", "provider": {"@id": "https://paranoir.fr/#organization"}, "offers": {"@type": "Offer", "price": "0", "priceCurrency": "EUR"}}},
            {"@type": "ListItem", "position": 2, "item": {"@type": "Service", "name": "Page unique stratégique", "provider": {"@id": "https://paranoir.fr/#organization"}, "offers": {"@type": "Offer", "price": "990", "priceCurrency": "EUR"}}},
            {"@type": "ListItem", "position": 3, "item": {"@type": "Service", "name": "Site multipage", "provider": {"@id": "https://paranoir.fr/#organization"}, "offers": {"@type": "Offer", "price": "1990", "priceCurrency": "EUR"}}},
            {"@type": "ListItem", "position": 4, "item": {"@type": "Service", "name": "Projet sur mesure", "provider": {"@id": "https://paranoir.fr/#organization"}, "offers": {"@type": "Offer", "price": "2990", "priceCurrency": "EUR"}}},
        ],
    },
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {"@type": "Question", "name": "Le résultat du test est-il immédiat ?", "acceptedAnswer": {"@type": "Answer", "text": "Oui. Une première analyse s'affiche directement après vos réponses."}},
            {"@type": "Question", "name": "La stratégie est-elle réellement incluse ?", "acceptedAnswer": {"@type": "Answer", "text": "Oui. Elle est intégrée à chaque projet payant et formalisée dans votre document stratégique."}},
            {"@type": "Question", "name": "Combien coûte un projet ?", "acceptedAnswer": {"@type": "Answer", "text": "990 € HT pour une page unique stratégique, 1 990 € HT pour un multipage et à partir de 2 990 € HT pour un projet sur mesure."}},
        ],
    },
]

schema_html = '<script type="application/ld+json">\n' + json.dumps(schema, ensure_ascii=False, indent=2) + '\n</script>'
html = re.sub(r'<script type="application/ld\+json">.*?</script>', schema_html, html, count=1, flags=re.S)


# Hero : on conserve le dossier existant et on aligne la copie avant le JavaScript.
hero = extract(r'<section class="hero">.*?</section>', html, "hero")
hero = re.sub(r'<div class="eyebrow">.*?</div>', '<div class="eyebrow"><span class="dot"></span>Site internet · Réseau social · Fiche Google</div>', hero, count=1, flags=re.S)
hero = re.sub(r'<h1>.*?</h1>', '<h1>Votre valeur reste floue.<span class="hero-line-two">Nous la rendons évidente.</span></h1>', hero, count=1, flags=re.S)
hero = re.sub(r'<p class="sub">.*?</p>', '<p class="sub">Nous clarifions <strong>ce que vous vendez</strong>, <strong>à qui vous le vendez</strong> et <strong>pourquoi vous êtes différent</strong>. Puis nous déployons cette clarté sur votre site, votre réseau social principal et votre fiche Google Business Profile.</p>', hero, count=1, flags=re.S)
hero = re.sub(r'<div class="hero-actions">.*?</div>', '<div class="hero-actions"><a class="cta" href="#test">Faire le test gratuit <span>→</span></a><p class="micro">3 minutes · Sans engagement · Un premier niveau de clarté immédiatement</p><div class="hero-proof-line"><span class="hero-proof-line__stars" aria-label="5 étoiles">★★★★★</span><span>5/5 sur Google</span><span class="hero-proof-line__separator" aria-hidden="true"></span><span>Plus de 60 entreprises accompagnées</span></div></div>', hero, count=1, flags=re.S)
hero = hero.replace('<span>Dossier ouvert</span>\n<span>Enquête stratégique</span>', '<span>Système de clarté</span>\n<span>Stratégie → déploiement</span>')
hero = hero.replace('<div class="stamp">Cause trouvée</div>', '<div class="stamp">Message aligné</div>')

# Le quiz actuel reste la mécanique publique pendant cette phase de refonte.
quiz = extract(r'<section class="prequiz" id="prediagnostic">.*?</section>', html, "test gratuit")
quiz = quiz.replace('<section class="prequiz" id="prediagnostic">', '<section class="prequiz v3-diagnostic" id="test">', 1)
quiz = re.sub(
    r'<div class="prequiz-head reveal">.*?</div>\s*<form',
    '<div class="prequiz-head reveal"><p class="kicker">Test gratuit</p><h2>Une question à la fois.</h2><p class="lede">En 3 minutes, vous obtenez un premier diagnostic sur ce qui brouille votre offre, votre message ou votre parcours.</p></div>\n<form',
    quiz,
    count=1,
    flags=re.S,
)
quiz = re.sub(
    r'<p class="quiz-privacy">.*?</p>',
    '<p class="quiz-privacy">Vos réponses servent uniquement à établir votre diagnostic et à vous recontacter à son sujet. <a href="/politique-confidentialite.html">En savoir plus sur vos données.</a></p>',
    quiz,
    count=1,
    flags=re.S,
)

# Réalisations et avis réels.
realisations = extract(r'<section class="realisations">.*?</section>', html, "réalisations")
realisations = realisations.replace('<section class="realisations">', '<section class="realisations" id="realisations">', 1)
notes = iter([
    '<div class="v3-decision"><strong>Décision stratégique</strong>Repositionner l’association comme experte du vivant et acteur territorial, pas comme simple association de niche.</div>',
    '<div class="v3-decision"><strong>Décision stratégique</strong>Faire de la périnatalité et de la sexothérapie une différence lisible au lieu d’un message générique.</div>',
    '<div class="v3-decision"><strong>Décision stratégique</strong>Recentrer l’expérience sur la mobilité, moderniser la réassurance et clarifier le parcours.</div>',
])
realisations = re.sub(r'(<p class="real-offer">)', lambda m: next(notes) + m.group(1), realisations, count=3)

reviews = extract(r'<section class="google-reviews">.*?</section>', html, "avis")
reviews = reviews.replace('<section class="google-reviews">', '<section class="google-reviews" id="avis">', 1)

proof = '''
<section class="proof" aria-label="Preuves rapides">
<article class="v3-proof v3-glass"><strong>+60</strong><span>entreprises accompagnées</span></article>
<article class="v3-proof v3-proof--stars v3-glass"><strong>★★★★★</strong><span>5/5 sur Google</span></article>
<article class="v3-proof v3-glass"><strong>Conseils en continu</strong><span>Site, réseau social et fiche Google pensés comme un seul système</span></article>
</section>'''

manifesto = '''
<section class="statement v3-manifesto" id="approche">
<div class="v3-manifesto-copy"><p class="v3-kicker">Le problème n’est pas toujours là où il se voit</p><h2 class="v3-title">Un site peut être parfaitement construit et envoyer <span class="editorial">les mauvais signaux.</span></h2><p class="v3-lede">Un prospect peut vous découvrir sur Google, vérifier votre site, regarder votre réseau social puis lire vos avis. S’il rencontre quatre versions différentes de votre activité, il ne fait pas la synthèse à votre place.</p><p class="v3-manifesto-note">Plus vous ajoutez de communication sur une base floue, plus le parcours devient difficile à suivre.</p></div>
<div class="v3-tangle" aria-label="Parcours d'un prospect entre Google, le site, le réseau social et les avis"><svg viewBox="0 0 620 540" preserveAspectRatio="none" aria-hidden="true"><path class="soft" d="M130 120 L485 215 L195 390 L468 455"/><path d="M130 120 L330 285 L485 215"/><path d="M195 390 L330 285 L468 455"/><path d="M468 455 L525 95 L130 120"/></svg><div class="v3-clue v3-clue--google">Fiche Google<small>premier signal de confiance</small></div><div class="v3-clue v3-clue--site">Site<small>point de référence</small></div><div class="v3-clue v3-clue--social">Réseau social<small>présence et relation</small></div><div class="v3-clue v3-clue--reviews">Avis<small>preuve extérieure</small></div><div class="v3-clue v3-clue--hesitation">Hésitation<small>les messages ne s’alignent pas</small></div></div>
</section>'''

strategy = '''
<section class="v3-section v3-strategy" id="strategie"><div><p class="v3-kicker">La stratégie est incluse</p><h2 class="v3-title">Nous ne produisons pas d’abord pour <span class="editorial">réfléchir ensuite.</span></h2><p class="v3-lede">Chaque projet payant commence par la même question : qu’est-ce que vos clients doivent comprendre, retenir et faire ensuite ?</p><p class="v3-strategy-quote">La stratégie n’est pas une option ajoutée au devis. C’est la base du déploiement.</p></div><div class="v3-strategy-cloud v3-glass" aria-label="Éléments étudiés dans la stratégie">''' + ''.join(f'<span class="v3-pill">{item}</span>' for item in ['activité','dirigeant','clients','marché','concurrence','offre','différence','message','positionnement','parcours','priorités']) + '''</div></section>'''

document = '''
<section class="v3-section v3-document" id="document-strategique"><p class="v3-kicker">Un document de référence</p><h2 class="v3-title">La stratégie devient <span class="editorial">utilisable.</span></h2><p class="v3-lede">Vous repartez avec un document qui rassemble les décisions prises et sert de référence au site, aux contenus et aux prochaines actions.</p><div class="v3-document-sheet"><div class="v3-document-brand"><span>PARANOIR STUDIO</span><span>Document de référence</span></div><div class="v3-document-grid"><div class="v3-document-block"><small>01 · Identité</small><strong>Ce que vous défendez</strong><p>Mission, vision, promesse, personnalité et principes qui doivent rester cohérents.</p></div><div class="v3-document-block"><small>02 · Offre</small><strong>Ce que vous vendez</strong><p>Hiérarchie, bénéfices, objections, formulation et priorités commerciales.</p></div><div class="v3-document-block"><small>03 · Clients</small><strong>À qui vous parlez</strong><p>Cibles, attentes, freins, critères de décision et niveau de compréhension attendu.</p></div><div class="v3-document-block"><small>04 · Communication</small><strong>Ce qu’ils doivent retenir</strong><p>Messages clés, ton, preuves, appels à l’action et cohérence entre les points de contact.</p></div></div><div class="v3-document-foot">Un socle réutilisable pour arbitrer les décisions pendant au moins un an.</div></div></section>'''

deployment = '''
<section class="v3-section v3-deployment" id="deploiement"><div><p class="v3-kicker">Trois points de contact, un seul message</p><h2 class="v3-title">Le fil se dénoue quand chaque support joue <span class="editorial">son vrai rôle.</span></h2><p class="v3-lede">Le site devient le socle. Le réseau social porte votre voix. La fiche Google apporte la confiance locale. Ils ne doivent pas répéter mot pour mot la même chose, ils doivent raconter la même entreprise.</p></div><div class="v3-untangle v3-glass" aria-label="Déploiement cohérent sur le site, le réseau social et la fiche Google"><div class="v3-untangle-line" aria-hidden="true"></div><div class="v3-channel v3-channel--site"><small>01 · Site</small><strong>Le socle</strong></div><div class="v3-channel v3-channel--social"><small>02 · Réseau social</small><strong>La voix</strong></div><div class="v3-channel v3-channel--google"><small>03 · Fiche Google</small><strong>La confiance</strong></div><div class="v3-message-core">Message aligné</div><div class="v3-confidence">Compréhension → confiance → action</div></div></section>'''

projects = '''
<section class="v3-section v3-projects" id="projets"><p class="v3-kicker">Le format suit la complexité</p><h2 class="v3-title">Quel projet correspond à <span class="editorial">votre situation ?</span></h2><p class="v3-lede">On ne choisit pas un nombre de pages au hasard. On regarde d’abord ce que vos clients doivent comprendre et combien de parcours doivent coexister.</p><div class="v3-project-switch" role="tablist" aria-label="Choisir une situation de projet"><button class="v3-project-choice" role="tab" type="button" data-project="one" aria-selected="true"><small>Une offre principale</small><strong>Un parcours simple</strong><span>990 € HT</span></button><button class="v3-project-choice" role="tab" type="button" data-project="multi" aria-selected="false"><small>Plusieurs offres</small><strong>Plusieurs parcours</strong><span>1 990 € HT</span></button><button class="v3-project-choice" role="tab" type="button" data-project="custom" aria-selected="false"><small>Besoins complexes</small><strong>Fonctions sur mesure</strong><span>2 990 € HT+</span></button></div><div class="v3-project-detail v3-glass" aria-live="polite"><div><h3>Page unique stratégique</h3><p>Pour une activité avec une offre principale et un parcours simple. L’objectif est de faire comprendre rapidement ce que vous proposez, à qui et pourquoi vous choisir.</p><p><strong>990 € HT</strong></p></div><a class="cta" href="#test">Faire le test gratuit <span>→</span></a></div><p class="v3-project-included"><strong>Dans chaque projet payant :</strong> stratégie + document stratégique + site + réseau social principal + fiche Google.</p></section>'''

bundle_groups = [
    ('Commerce', [('shop','Boutique en ligne'),('booking','Réservation'),('ticket','Billetterie'),('membership','Adhésion'),('quote','Demande de devis avancée'),('payment','Paiement en ligne')]),
    ('Contenu', [('multilingual','Multilingue'),('lms','Espace formation / LMS'),('catalog','Catalogue'),('directory','Annuaire'),('members','Espace membre'),('resources','Blog / ressources')]),
    ('Connexions', [('crm','CRM'),('api','API / outil métier'),('automation','Automatisations'),('migration','Migration'),('emailing','Emailing / nurturing')]),
]
bundle_buttons = ''
for group_name, items in bundle_groups:
    bundle_buttons += f'<div class="v3-bundle-group-title">{group_name}</div>'
    for key, label in items:
        selected = 'true' if key == 'shop' else 'false'
        bundle_buttons += f'<button class="v3-bundle-button" type="button" data-bundle="{key}" aria-selected="{selected}"><span>{label}</span><span>→</span></button>'

bundles = f'''
<section class="v3-section v3-bundles" id="fonctionnalites"><div><p class="v3-kicker">17 bundles disponibles</p><h2 class="v3-title">On ajoute des fonctions quand elles servent <span class="editorial">le parcours.</span></h2><p class="v3-lede">Une fonctionnalité n’est jamais intéressante parce qu’elle existe. Elle l’est lorsqu’elle retire une friction ou automatise quelque chose d’utile.</p></div><div class="v3-bundle-browser"><div class="v3-bundle-list v3-glass">{bundle_buttons}</div><div class="v3-bundle-detail v3-glass" aria-live="polite"><small>Commerce</small><h3>Boutique en ligne</h3><p>Pour vendre des produits ou services avec un parcours d’achat cohérent avec le reste du site.</p><ul><li>Catalogue et fiches produit</li><li>Paiement</li><li>Emails transactionnels</li></ul></div></div></section>'''

technical = '''
<section class="v3-section v3-tech" id="technique"><div class="v3-tech-inner"><p class="v3-kicker">Construction technique & IA</p><h2 class="v3-title">L’IA va vite. <span class="editorial">Les mauvais choix aussi.</span></h2><p class="v3-lede">Nous utilisons l’IA pour accélérer la recherche, le prototypage et certaines tâches de production. Elle ne décide ni de votre positionnement, ni de votre architecture, ni de la façon dont le site devra évoluer.</p><div class="v3-tech-compare"><div class="v3-tech-row v3-tech-row--head"><div>Critère</div><div>100 % généré</div><div>Paranoir</div></div><div class="v3-tech-row"><div>Production</div><div class="muted">Rapide</div><div class="yes">Rapide</div></div><div class="v3-tech-row"><div>Structure</div><div class="muted">Souvent générique</div><div class="yes">Pensée pour votre activité</div></div><div class="v3-tech-row"><div>Message</div><div class="muted">Produit à partir d’un prompt</div><div class="yes">Décidé à partir de la stratégie</div></div><div class="v3-tech-row"><div>Évolutivité</div><div class="muted">Variable</div><div class="yes">Prévue dès l’architecture</div></div><div class="v3-tech-row"><div>Maintenance</div><div class="muted">Dépend de ce qui a été généré</div><div class="yes">Dépendances maîtrisées</div></div><div class="v3-tech-row"><div>Autonomie</div><div class="muted">Pas toujours anticipée</div><div class="yes">Choisie selon vos besoins</div></div></div><p class="v3-tech-note"><strong>Notre règle :</strong> l’IA accélère. Les décisions restent humaines, documentées et maintenables.</p></div></section>'''

process = '''
<section class="v3-process" id="methode" data-process-step="0"><div class="v3-process-track"><div class="v3-process-stage"><div class="v3-process-copy"><div class="v3-process-counter"><strong>01 / 04</strong><span class="v3-process-progress"><i></i></span></div><article class="v3-process-step is-active"><small>01 · Comprendre</small><h3>Comprendre.</h3><p>On rassemble le contexte, l’existant, les offres, les clients et les symptômes. On distingue les faits des hypothèses.</p></article><article class="v3-process-step"><small>02 · Décider</small><h3>Décider.</h3><p>On organise les informations, formule le positionnement et arbitre ce qui doit être compris en premier. Le document stratégique prend forme.</p></article><article class="v3-process-step"><small>03 · Déployer</small><h3>Déployer.</h3><p>La stratégie devient un site, un réseau social principal et une fiche Google cohérents. Chaque support prend son rôle.</p></article><article class="v3-process-step"><small>04 · Transmettre</small><h3>Transmettre.</h3><p>Vous récupérez les accès, les règles, le document stratégique et les repères nécessaires pour garder la main sur la suite.</p></article></div><div class="v3-process-scene" aria-hidden="true"><div class="v3-scene-layer" data-scene="0"><span class="v3-note n1">Offres</span><span class="v3-note n2">Clients</span><span class="v3-note n3">Concurrence</span><span class="v3-note n4">Messages</span><div class="v3-scene-thread"></div></div><div class="v3-scene-layer" data-scene="1"><div class="v3-scene-doc"><strong>Document stratégique</strong><div class="bars"><i></i><i></i><i></i><i></i></div></div></div><div class="v3-scene-layer" data-scene="2"><div class="v3-device-row"><div class="v3-device"><strong>Site</strong><i></i><i></i><i></i></div><div class="v3-device"><strong>Réseau</strong><i></i><i></i></div><div class="v3-device"><strong>Fiche Google</strong><i></i><i></i></div></div></div><div class="v3-scene-layer" data-scene="3"><div class="v3-handoff"><div class="v3-handoff-card"><small>Transmission</small><strong>Vous gardez la main.</strong><p>Document, accès, règles et plan d’action restent avec vous.</p></div></div></div></div></div></div></section>'''

studio = '''
<section class="about v3-studio" id="studio"><div class="photo liquid"><picture><source srcset="/assets/images/alexandre-victoria-paranoir-opti.webp" type="image/webp"/><img src="/assets/images/alexandre-victoria-paranoir-opti.png" alt="Victoria et Alexandre — Paranoir Studio" width="800" height="1202" loading="lazy" style="width:100%;height:100%;object-fit:cover;border-radius:inherit"/></picture></div><div class="about-copy liquid"><p class="kicker">Le studio</p><h2>Deux expertises associées. Les personnes qui pensent le projet sont aussi celles qui le livrent.</h2><p>Paranoir réunit la stratégie, l’UX, les contenus et la construction technique dans la même équipe. Moins de passages de relais, moins de déperdition entre ce qui a été décidé et ce qui finit réellement en ligne.</p><div class="v3-studio-members"><div class="v3-studio-member"><strong>Victoria</strong><span>Stratégie, UX, positionnement, contenus et accompagnement.</span></div><div class="v3-studio-member"><strong>Alexandre</strong><span>Architecture technique, intégrations, performance et livraison.</span></div></div><div class="v3-credentials"><span class="v3-pill">UX & stratégie</span><span class="v3-pill">Développement</span><span class="v3-pill">Formation</span><span class="v3-pill">Performance</span><span class="v3-pill">Accessibilité</span></div></div></section>'''

faq = '''
<section class="faq v3-faq" id="faq"><div class="v3-faq-head"><p class="v3-kicker">Questions fréquentes</p><h2 class="v3-title">Les réponses utiles, <span class="editorial">sans roman.</span></h2></div><div class="v3-faq-priority"><article class="v3-glass"><h3>Le résultat du test est-il immédiat ?</h3><p>Oui. Votre première analyse s’affiche directement après vos réponses.</p></article><article class="v3-glass"><h3>La stratégie est-elle réellement incluse ?</h3><p>Oui. Elle est intégrée à chaque projet payant et formalisée dans votre document stratégique.</p></article><article class="v3-glass"><h3>Combien coûte un projet ?</h3><p>990 € HT, 1 990 € HT ou à partir de 2 990 € HT selon la complexité.</p></article></div><div class="v3-faq-list"><details><summary>Pourquoi commencer par le test gratuit ?</summary><p>Pour vérifier ce qui mérite réellement d’être clarifié avant de choisir un format de site ou d’ajouter des actions.</p></details><details><summary>Faut-il déjà avoir un site ?</summary><p>Non. Le point de départ peut être une offre, une activité en lancement, un site ancien ou une communication devenue incohérente.</p></details><details><summary>La fiche Google est-elle incluse ?</summary><p>Oui. Son optimisation fait partie du déploiement prévu dans les projets payants.</p></details><details><summary>Travaillez-vous uniquement avec WordPress ?</summary><p>Non. La solution technique dépend du projet, de son autonomie future et des dépendances réellement utiles.</p></details><details><summary>Puis-je modifier mon site ensuite ?</summary><p>Oui. L’objectif est de vous laisser une structure que vous pouvez faire vivre sans dépendance inutile.</p></details></div></section>'''

final = '''
<section class="final v3-final" id="cta-final"><div class="final-inner"><p class="v3-kicker" style="color:rgba(255,255,255,.72)">Votre prochain projet</p><h2>Commence par une question : <span class="highlight" style="color:#fff">qu’est-ce qui doit devenir évident ?</span></h2><p>Avant de choisir un nombre de pages, un outil ou une nouvelle campagne, vérifiez ce que votre activité a réellement besoin de clarifier.</p><a class="cta" href="#test">Faire le test gratuit <span>→</span></a><div class="v3-final-reassurance"><span>3 minutes</span><span>Gratuit</span><span>Résultat immédiat</span><span>Recommandation personnalisée</span></div></div></section>'''

new_main = '<main id="main">\n' + '\n'.join([hero, proof, manifesto, quiz, strategy, document, deployment, projects, bundles, technical, process, realisations, reviews, studio, faq, final]) + '\n</main>'
html = re.sub(r'<main id="main">.*?</main>', new_main, html, count=1, flags=re.S)

# Navigation statique de secours, remplacée ensuite par le header enrichi.
static_nav = '''<nav class="nav"><a class="brand" href="/">Paranoir Studio</a><div class="nav-mid">Stratégie &amp; déploiement</div><div class="nav-right"><a class="nav-link" href="#approche">Approche</a><a class="nav-link" href="#strategie">Stratégie</a><a class="nav-link" href="#projets">Projets</a><a class="nav-link" href="#realisations">Réalisations</a><a class="nav-cta" href="#test">Faire le test gratuit</a></div></nav>'''
html = re.sub(r'<nav class="nav">.*?</nav>', static_nav, html, count=1, flags=re.S)

# Footer final : aucun faux lien vers une page qui n'existe pas encore.
new_footer = f'''<footer class="site-footer"><div class="footer-inner"><div class="footer-brand"><span class="footer-logo">Paranoir Studio</span><p class="footer-tagline">Du flou à l'évidence.</p></div><nav class="footer-nav" aria-label="Navigation footer"><a href="#approche">Approche</a><a href="#strategie">Stratégie</a><a href="#projets">Projets</a><a href="#realisations">Réalisations</a><span class="footer-upcoming">Formation <em>À venir</em></span><span class="footer-upcoming">Consulting <em>À venir</em></span><span class="footer-upcoming">Blog <em>À venir</em></span></nav><div class="footer-contact"><a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a><a href="{whatsapp}" target="_blank" rel="noopener noreferrer">WhatsApp →</a><a href="{linkedin}" target="_blank" rel="noopener noreferrer">LinkedIn →</a><a href="{instagram}" target="_blank" rel="noopener noreferrer">Instagram →</a></div><div class="footer-legal-col"><span class="footer-copy">Paranoir Studio © | Tous droits réservés | 2026–2027</span><nav aria-label="Liens légaux" class="site-footer-links"><a href="/mentions-legales.html">Mentions légales</a><a href="/politique-confidentialite.html">Confidentialité</a><a href="/politique-cookies.html">Cookies</a><button class="footer-cookie-btn" id="manageCookies" type="button">Gérer les cookies</button></nav></div></div></footer>'''
html = re.sub(r'<footer class="site-footer">.*?</footer>', new_footer, html, count=1, flags=re.S)

# Les styles v3 sont présents dès le HTML, donc pas de flash de l'ancienne home.
html = ensure_stylesheet(html, "/assets/css/navigation-v2.css", "navigation-v2-css")
html = ensure_stylesheet(html, "/assets/css/hero-v2.css", "hero-v2-css")
html = ensure_stylesheet(html, "/assets/css/home-v3.css", "home-v3-css")

# Marqueur de build et cache-busting.
html = re.sub(r'<!-- build:[^>]* -->\s*', '', html, count=1)
html = html.replace('<body class="site-home">', f'<!-- build:{version} -->\n<body class="site-home home-v3-ready">', 1)
html = html.replace('<body class="site-home home-v3-ready">', f'<body class="site-home home-v3-ready">', 1)
html = re.sub(r'(/assets/js/site\.min\.js)\?v=[^"\']+', lambda m: f"{m.group(1)}?v={version}", html)
html = re.sub(r'(/assets/js/cookies\.min\.js)\?v=[^"\']+', lambda m: f"{m.group(1)}?v={version}", html)
index.write_text(html, encoding="utf-8")

# Tous les assets chargés par le bootstrap portent aussi le SHA du build.
bootstrap = Path("assets/js/site.min.js")
script = bootstrap.read_text(encoding="utf-8")
script = re.sub(r'(/assets/(?:js|css)/[^?"\']+)\?v=[^"\']+', lambda m: f"{m.group(1)}?v={version}", script)
bootstrap.write_text(script, encoding="utf-8")

print(f"Prepared deploy {version}")
