from pathlib import Path
import json
import os
import re
from urllib.parse import quote

version = os.environ.get("BUILD_VERSION", "dev")[:8]
whatsapp = "https://wa.me/33637432180?text=" + quote(
    "Bonjour Victoria, je viens de remplir le questionnaire de diagnostic stratégique sur le site de Paranoir Studio. Je préfère poursuivre l’échange sur WhatsApp."
)

index = Path("index.html")
html = index.read_text(encoding="utf-8")

# -----------------------------------------------------------------------------
# Métadonnées et données structurées
# -----------------------------------------------------------------------------
meta_description = (
    "Paranoir Studio clarifie votre offre, votre positionnement et votre message, "
    "puis les déploie sur votre site internet, votre réseau social principal et votre fiche Google. "
    "Commencez par un diagnostic stratégique gratuit."
)

html = re.sub(r"<title>.*?</title>", "<title>Paranoir Studio — Stratégie, site internet, réseau social & fiche Google</title>", html, count=1, flags=re.S)
html = re.sub(r'<meta name="description" content="[^"]*"/>', f'<meta name="description" content="{meta_description}"/>', html, count=1)
html = re.sub(r'<meta property="og:description" content="[^"]*"/>', f'<meta property="og:description" content="{meta_description}"/>', html, count=1)
html = re.sub(r'<meta name="twitter:description" content="[^"]*"/>', f'<meta name="twitter:description" content="{meta_description}"/>', html, count=1)

schema = [
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "@id": "https://paranoir.fr/#organization",
        "name": "Paranoir Studio",
        "legalName": "Paranoir Studio",
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
        "knowsAbout": [
            "Stratégie d'offre",
            "Positionnement de marque",
            "Message marketing",
            "Site internet",
            "Réseaux sociaux",
            "Google Business Profile",
            "Diagnostic stratégique",
        ],
        "aggregateRating": {"@type": "AggregateRating", "ratingValue": "5", "reviewCount": "23", "bestRating": "5", "worstRating": "1"},
        "contactPoint": {
            "@type": "ContactPoint",
            "email": "victoria@paranoir.me",
            "telephone": "+33637432180",
            "contactType": "customer service",
            "availableLanguage": "fr",
        },
        "founder": {
            "@type": "Person",
            "@id": "https://paranoir.fr/#victoria",
            "name": "Victoria Dury",
            "jobTitle": "Fondatrice & Directrice conseil",
            "email": "victoria@paranoir.me",
            "worksFor": {"@id": "https://paranoir.fr/#organization"},
            "sameAs": "https://www.linkedin.com/in/victoria-dury-paranoir/",
        },
        "sameAs": ["https://www.linkedin.com/in/victoria-dury-paranoir/"],
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
        "name": "Accompagnements Paranoir Studio",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@type": "Service",
                    "name": "Diagnostic stratégique gratuit",
                    "description": "Questionnaire de repérage, analyse menée par Paranoir, dossier d'analyse personnalisé et restitution lors d'un rendez-vous ou par WhatsApp.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {"@type": "Offer", "price": "0", "priceCurrency": "EUR", "availability": "https://schema.org/InStock"},
                },
            },
            {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@type": "Service",
                    "name": "Stratégie complète + site en une page",
                    "description": "Pour lancer une activité ou repartir de zéro : plan stratégique complet, site internet en une page, réseau social principal optimisé et fiche Google optimisée.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {"@type": "Offer", "price": "990", "priceCurrency": "EUR", "availability": "https://schema.org/InStock"},
                },
            },
            {
                "@type": "ListItem",
                "position": 3,
                "item": {
                    "@type": "Service",
                    "name": "Stratégie complète + site de 5 à 15 pages",
                    "description": "Pour faire évoluer ou réaligner une activité installée : plan stratégique complet, site de 5 à 15 pages, architecture éditoriale et SEO, réseau social principal optimisé et fiche Google optimisée.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {"@type": "Offer", "price": "3290", "priceCurrency": "EUR", "availability": "https://schema.org/InStock"},
                },
            },
        ],
    },
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Comment fonctionne le diagnostic stratégique gratuit ?",
                "acceptedAnswer": {"@type": "Answer", "text": "Vous répondez à quelques questions. Paranoir étudie ensuite vos réponses et vos principaux supports, prépare un dossier d'analyse personnalisé, puis vous présente les conclusions lors d'un échange gratuit."},
            },
            {
                "@type": "Question",
                "name": "Que se passe-t-il après le questionnaire ?",
                "acceptedAnswer": {"@type": "Answer", "text": "Le questionnaire ne génère pas un résultat définitif automatiquement. Il déclenche une analyse menée par Paranoir. Nous préparons votre dossier avant la restitution."},
            },
            {
                "@type": "Question",
                "name": "Puis-je poursuivre sur WhatsApp plutôt qu'en visio ?",
                "acceptedAnswer": {"@type": "Answer", "text": "Oui. Après le questionnaire, vous pouvez réserver un rendez-vous ou écrire directement à Paranoir sur WhatsApp pour convenir du format d'échange le plus adapté."},
            },
            {
                "@type": "Question",
                "name": "Quelle différence entre les projets à 990 € HT et à partir de 3 290 € HT ?",
                "acceptedAnswer": {"@type": "Answer", "text": "Les deux incluent un plan stratégique complet, un site, l'optimisation du réseau social principal et de la fiche Google. Le format à 990 € HT convient à une activité structurée autour d'une offre principale sur une seule page. Le format à partir de 3 290 € HT s'adresse aux activités plus matures qui nécessitent entre 5 et 15 pages, plusieurs parcours ou une architecture SEO plus complète."},
            },
            {
                "@type": "Question",
                "name": "Faut-il déjà avoir un site ?",
                "acceptedAnswer": {"@type": "Answer", "text": "Non. Le diagnostic et le projet peuvent aussi partir d'une activité en lancement, d'une offre à restructurer ou d'une volonté de repartir de zéro."},
            },
        ],
    },
]

schema_html = '<script type="application/ld+json">\n' + json.dumps(schema, ensure_ascii=False, indent=2) + '\n</script>'
html = re.sub(r'<script type="application/ld\+json">.*?</script>', schema_html, html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# CTA et diagnostic gratuit
# -----------------------------------------------------------------------------
replacements = {
    '<div class="nav-mid">Diagnostic &amp; Clarté</div>': '<div class="nav-mid">Stratégie &amp; déploiement</div>',
    '<a class="nav-link" href="#reservation">Clarté Déployée</a>': '<a class="nav-link" href="#reservation">Projets</a>',
    '<a class="nav-cta" href="#prediagnostic">Test de clarté</a>': '<a class="nav-cta" href="#prediagnostic">Demander mon diagnostic gratuit</a>',
    '<a class="cta" href="#prediagnostic">Faire le test de clarté <span>→</span></a>': '<a class="cta" href="#prediagnostic">Demander mon diagnostic gratuit <span>→</span></a>',
    '<p class="micro">3 minutes · Gratuit · Rapport de Clarté remis en visio</p>': '<p class="micro">Quelques questions · Un dossier personnalisé · Rendez-vous ou WhatsApp</p>',
    '<p class="kicker">Test de clarté gratuit</p>': '<p class="kicker">Diagnostic stratégique gratuit</p>',
    '<h2>Répondez à 5 questions.</h2>': '<h2>Votre diagnostic commence par quelques questions.</h2>',
    '<p class="lede quiz-subtitle">Voyez si vous regardez le bon problème.</p>': '<p class="lede quiz-subtitle">Vous répondez. Nous analysons. Nous vous présentons les conclusions.</p>',
    "<strong>Ce n'est pas un formulaire de contact.</strong> Répondez et recevez votre Rapport de Clarté gratuit en visio.": '<strong>Le questionnaire est la première étape.</strong> Paranoir étudie ensuite vos réponses et vos principaux supports, prépare un dossier d’analyse personnalisé, puis vous le présente lors d’un échange gratuit.',
    '<span class="orbit-pill p1">site</span>': '<span class="orbit-pill p1">réponses</span>',
    '<span class="orbit-pill p2">message</span>': '<span class="orbit-pill p2">analyse</span>',
    '<span class="orbit-pill p3">offre</span>': '<span class="orbit-pill p3">dossier</span>',
    '<span class="orbit-pill p4">parcours</span>': '<span class="orbit-pill p4">restitution</span>',
    '<legend>Où voulez-vous recevoir la suite ?</legend>': '<legend>Où pouvons-nous vous contacter pour préparer votre diagnostic ?</legend>',
    "<p class=\"quiz-note\">Après validation, votre résultat s'affiche directement. Votre Rapport de Clarté vous est remis en visio — gratuit.</p>": '<p class="quiz-note">Après validation, choisissez comment poursuivre : en réservant un rendez-vous ou en nous écrivant sur WhatsApp. Nous étudierons vos réponses avant l’échange et préparerons votre dossier d’analyse personnalisé.</p>',
    '<button class="cta quiz-submit" id="quizSubmit" type="submit">Voir mon résultat →</button>': '<button class="cta quiz-submit" id="quizSubmit" type="submit">Envoyer mes réponses →</button>',
    "<p class=\"quiz-privacy\">Vos réponses servent uniquement à préparer l'échange. Pas d'abonnement, pas de relance automatique déguisée en relation humaine.</p>": '<p class="quiz-privacy">Vos réponses servent uniquement à préparer votre analyse et votre échange avec Paranoir. Pas d’abonnement, pas de relance automatique déguisée en relation humaine.</p>',
}
for old, new in replacements.items():
    html = html.replace(old, new)

old_result = '''<div class="result-cta" id="resultCta">
<div>
<small>Votre livrable gratuit</small>
<strong>Rapport de Clarté — Gratuit</strong>
<span>Votre Rapport de Clarté est gratuit. Il vous est remis en visio — 30 minutes pour comprendre ce qui bloque vraiment et décider ensemble de la suite.</span>
</div>
<a class="cta" href="https://meet.brevo.com/victoria-dury/rapport-de-clarte" target="_blank" rel="noopener noreferrer" aria-label="Réserver ma visio Rapport de Clarté (ouvre dans un nouvel onglet)">Réserver ma visio <span>→</span></a>
</div>'''
new_result = f'''<div class="result-cta diagnostic-result-v2" id="resultCta">
<div>
<small>Choisissez la suite</small>
<strong>Votre dossier sera préparé avant l’échange</strong>
<span>Réservez un rendez-vous de restitution ou écrivez-nous sur WhatsApp pour convenir du format qui vous convient.</span>
</div>
<div class="diagnostic-contact-actions">
<a class="cta" href="https://meet.brevo.com/victoria-dury/rapport-de-clarte" target="_blank" rel="noopener noreferrer">Choisir un rendez-vous <span>→</span></a>
<a class="diagnostic-whatsapp" href="{whatsapp}" target="_blank" rel="noopener noreferrer">Continuer sur WhatsApp <span>→</span></a>
</div>
</div>'''
html = html.replace(old_result, new_result)

# -----------------------------------------------------------------------------
# Processus réel : questionnaire -> analyse -> dossier -> restitution -> projet
# -----------------------------------------------------------------------------
new_method = '''<section class="method" id="method">
<div class="reveal">
<p class="kicker">Diagnostic stratégique gratuit</p>
<h2>Quelques questions. Une vraie analyse derrière.</h2>
<p>Le questionnaire ne vous donne pas une réponse automatique définitive. Il nous donne la matière nécessaire pour étudier votre situation, vérifier vos principaux points de contact et préparer une restitution utile. <span class="marker">Le diagnostic est un parcours, pas un quiz isolé.</span></p>
</div>
<div class="timeline reveal">
<div class="step"><div class="num">01</div><div><strong>Vous répondez</strong><span>Cinq questions pour nous aider à repérer les premiers signes de blocage et comprendre votre situation.</span></div></div>
<div class="step"><div class="num">02</div><div><strong>Nous analysons</strong><span>Nous étudions vos réponses, votre offre et vos principaux supports : site, réseau social et fiche Google lorsque vous en avez.</span></div></div>
<div class="step"><div class="num">03</div><div><strong>Nous préparons votre dossier</strong><span>Nous synthétisons les constats, les incohérences et les sujets à traiter en priorité dans un dossier d’analyse personnalisé.</span></div></div>
<div class="step"><div class="num">04</div><div><strong>Nous vous le restituons</strong><span>Vous choisissez un rendez-vous ou WhatsApp. Nous vous expliquons les conclusions et répondons à vos questions.</span></div></div>
<div class="step"><div class="num">05</div><div><strong>Nous construisons la suite si elle est utile</strong><span>Si un projet Paranoir est pertinent, le diagnostic sert de point de départ au plan stratégique complet et au déploiement.</span></div></div>
</div>
</section>'''
html = re.sub(r'<section class="method" id="method">.*?</section>\s*(?=<section class="offer")', new_method + "\n", html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# Deux projets payants validés
# -----------------------------------------------------------------------------
new_offer = '''<section class="offer offer-v2" id="reservation">
<div class="offer-layout">
<div class="price-panel reveal">
<div>
<p class="kicker" style="color:rgba(255,255,255,.76)">Deux formats. Une stratégie complète.</p>
<h2>Le bon projet dépend de <span class="offer-v2__accent">l’étape où se trouve votre activité.</span></h2>
<p class="price-note">Dans les deux formats, nous clarifions votre offre, votre cible, votre différence et votre message. Puis nous déployons cette stratégie sur vos trois points de contact essentiels.</p>
<div class="offer-v2__common">
<div class="offer-v2__common-item"><strong>Plan stratégique complet</strong><span>Offre, cible, positionnement, différence et message.</span></div>
<div class="offer-v2__common-item"><strong>Site internet conçu et développé</strong><span>Un parcours cohérent avec votre stratégie et vos objectifs.</span></div>
<div class="offer-v2__common-item"><strong>Réseau social principal optimisé</strong><span>Profil, présentation et message alignés.</span></div>
<div class="offer-v2__common-item"><strong>Fiche Google optimisée</strong><span>Une présence locale cohérente, lisible et crédible.</span></div>
</div>
</div>
<div>
<a class="cta" href="#test">Demander mon diagnostic gratuit <span>→</span></a>
<p class="micro">Nous déterminons ensemble le format réellement adapté à votre activité.</p>
</div>
</div>
<div class="offer-v2__cards reveal">
<article class="liquid offer-v2__card">
<p class="offer-v2__eyebrow">Pour lancer une activité ou repartir de zéro</p>
<h3>Stratégie complète + site en une page</h3>
<div class="offer-v2__price">990 € <small>HT</small></div>
<p class="offer-v2__desc">Vous lancez une activité, recentrez votre entreprise autour d’une offre principale ou souhaitez repartir de zéro avec un positionnement plus solide. Nous construisons une base stratégique complète puis la déployons sur un site en une page, votre réseau social principal et votre fiche Google.</p>
<div class="offer-v2__ideal"><small>Idéal lorsque</small><strong>Votre activité peut être présentée autour d’une offre principale et d’un parcours de vente simple.</strong></div>
<div class="offer-v2__chips"><span>Plan stratégique complet</span><span>Site one-page</span><span>Réseau social</span><span>Fiche Google</span></div>
</article>
<article class="liquid offer-v2__card">
<p class="offer-v2__eyebrow">Pour faire évoluer ou réaligner une activité installée</p>
<h3>Stratégie complète + site de 5 à 15 pages</h3>
<div class="offer-v2__price">À partir de 3 290 € <small>HT</small></div>
<p class="offer-v2__desc">Votre activité grandit, vos offres se multiplient ou votre site actuel ne reflète plus votre positionnement. Nous réalignons l’ensemble puis construisons une architecture plus complète, capable de soutenir plusieurs offres, publics ou parcours.</p>
<div class="offer-v2__ideal"><small>Idéal lorsque</small><strong>Votre activité a gagné en maturité et votre site doit enfin suivre sa complexité, son ambition ou sa croissance.</strong></div>
<div class="offer-v2__chips"><span>Plan stratégique complet</span><span>5 à 15 pages</span><span>Architecture SEO</span><span>Réseau social</span><span>Fiche Google</span></div>
</article>
</div>
</div>
</section>'''
html = re.sub(r'<section class="offer" id="reservation">.*?</section>\s*(?=<section class="about">)', new_offer + "\n", html, count=1, flags=re.S)

# Noms d'anciens projets dans les réalisations : on garde une désignation générique et juste.
html = html.replace('— Clarté Déployée', '— Stratégie + déploiement digital')

# -----------------------------------------------------------------------------
# FAQ cohérente avec le fonctionnement réel
# -----------------------------------------------------------------------------
new_faq = '''<section class="faq">
<p class="kicker reveal">Questions</p>
<h2 class="reveal">FAQ</h2>
<details class="reveal">
<summary>Comment fonctionne le diagnostic stratégique gratuit ?</summary>
<p>Vous répondez à quelques questions. Nous étudions ensuite vos réponses et vos principaux supports, préparons un dossier d’analyse personnalisé, puis nous vous présentons les conclusions lors d’un échange gratuit.</p>
</details>
<details class="reveal">
<summary>Que se passe-t-il après le questionnaire ?</summary>
<p>Le questionnaire ne génère pas un diagnostic définitif automatiquement. Il déclenche notre analyse. Nous préparons votre dossier avant la restitution, afin que l’échange parte déjà de constats concrets.</p>
</details>
<details class="reveal">
<summary>Je suis obligé de faire une visio ?</summary>
<p>Non. Vous pouvez choisir un rendez-vous ou poursuivre sur WhatsApp. L’objectif est de vous restituer l’analyse dans un format qui vous convient, pas d’ajouter une visioconférence à votre collection.</p>
</details>
<details class="reveal">
<summary>Quelle différence entre les projets à 990 € HT et à partir de 3 290 € HT ?</summary>
<p>Les deux incluent un plan stratégique complet, un site internet, l’optimisation de votre réseau social principal et de votre fiche Google. Le projet à 990 € HT convient lorsqu’une offre principale peut être présentée efficacement sur une seule page. Le projet à partir de 3 290 € HT concerne les activités plus matures qui nécessitent entre 5 et 15 pages, plusieurs offres, plusieurs parcours ou une architecture SEO plus complète.</p>
</details>
<details class="reveal">
<summary>Faut-il déjà avoir un site ?</summary>
<p>Non. Nous pouvons partir d’une activité en lancement, d’une offre à restructurer ou d’une volonté de faire table rase et repartir sur de bonnes bases.</p>
</details>
<details class="reveal">
<summary>Le diagnostic m’engage-t-il à travailler avec Paranoir ?</summary>
<p>Non. Le diagnostic est gratuit et sert d’abord à comprendre votre situation. Si un projet est pertinent, nous vous expliquons lequel et pourquoi. La décision vous appartient ensuite.</p>
</details>
</section>'''
html = re.sub(r'<section class="faq">.*?</section>\s*(?=<section class="realisations">)', new_faq + "\n", html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# CTA final : même promesse partout
# -----------------------------------------------------------------------------
new_final = '''<section class="final">
<div class="final-inner">
<h2 class="reveal">Avant de refaire votre site, votre communication ou votre offre, identifiez d’abord <span class="highlight">ce qui mérite vraiment d’être corrigé.</span></h2>
<p class="reveal">Quelques questions nous donnent le point de départ. Nous menons ensuite l’analyse, préparons votre dossier et vous présentons les conclusions.</p>
<a class="cta reveal" href="#test">Demander mon diagnostic gratuit <span>→</span></a>
<p class="micro reveal">Quelques questions · Un dossier personnalisé · Rendez-vous ou WhatsApp</p>
</div>
</section>'''
html = re.sub(r'<section class="final">.*?</section>\s*(?=<section class="offer-comparison")', new_final + "\n", html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# Ancien comparatif à trois offres remplacé par les deux vrais projets
# -----------------------------------------------------------------------------
new_comparison = '''<section class="offer-comparison offer-comparison-v2" id="comparatif-offres">
<div class="comparison-inner">
<div class="comparison-head">
<div class="reveal">
<p class="kicker">Choisir le bon format</p>
<h2>Même profondeur stratégique. Deux niveaux de déploiement.</h2>
</div>
<p class="lede reveal"><strong>Le prix ne détermine pas la qualité de la stratégie.</strong> Il dépend surtout de la complexité de votre activité et du nombre de parcours que votre site doit porter.</p>
</div>
<div class="offer-choice-intro reveal">
<div><strong>Vous ne savez pas lequel vous correspond ?</strong><br><span>Le diagnostic stratégique gratuit sert précisément à éviter de choisir un format au hasard.</span></div>
<a class="cta" href="#test">Demander mon diagnostic <span>→</span></a>
</div>
<div class="offer-choice-grid reveal">
<article class="liquid offer-choice-card">
<p class="offer-choice-card__eyebrow">Lancement · recentrage · nouveau départ</p>
<h3>Stratégie complète + site en une page</h3>
<div class="offer-choice-card__price">990 € <small>HT</small></div>
<p>Pour une activité qui peut être comprise et vendue autour d’une offre principale et d’un parcours simple.</p>
<ul>
<li>Plan stratégique complet</li>
<li>Site internet en une page</li>
<li>Réseau social principal optimisé</li>
<li>Fiche Google optimisée</li>
<li>Une offre principale, un parcours lisible</li>
</ul>
<a class="cta" href="#test">Vérifier si ce format me convient <span>→</span></a>
</article>
<article class="liquid offer-choice-card">
<p class="offer-choice-card__eyebrow">Croissance · refonte · réalignement</p>
<h3>Stratégie complète + site de 5 à 15 pages</h3>
<div class="offer-choice-card__price">À partir de 3 290 € <small>HT</small></div>
<p>Pour une activité installée dont les offres, les publics ou les parcours ont besoin d’une architecture plus complète.</p>
<ul>
<li>Plan stratégique complet</li>
<li>Site internet de 5 à 15 pages</li>
<li>Architecture éditoriale et SEO plus complète</li>
<li>Réseau social principal optimisé</li>
<li>Fiche Google optimisée</li>
</ul>
<a class="cta" href="#test">Vérifier si ce format me convient <span>→</span></a>
</article>
</div>
</div>
</section>'''
html = re.sub(r'<section class="offer-comparison" id="comparatif-offres">.*?</section>\s*(?=</main>)', new_comparison + "\n", html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# Footer : parcours, accompagnements spécifiques à venir et contacts
# -----------------------------------------------------------------------------
new_footer = f'''<footer class="site-footer">
<div class="footer-inner footer-inner-v2">
<div class="footer-brand">
<span class="footer-logo">Paranoir Studio</span>
<p class="footer-tagline">Du flou à l'évidence.</p>
</div>
<nav class="footer-v2-col" aria-label="Parcours Paranoir">
<strong>Parcours</strong>
<a href="#test">Diagnostic stratégique gratuit</a>
<a href="#reservation">Nos deux projets</a>
<a href="#realisations">Réalisations</a>
<a href="#faq">FAQ</a>
</nav>
<div class="footer-v2-col" aria-label="Accompagnements spécifiques à venir">
<strong>Accompagnements spécifiques</strong>
<span class="footer-v2-future" data-future-url="/hebergements-touristiques">Sites pour gîtes et hébergements touristiques <small>à venir</small></span>
<span class="footer-v2-future" data-future-url="/accompagnement-ia">Accompagnement IA pour les entreprises <small>à venir</small></span>
<span class="footer-v2-future" data-future-url="/atelier-fiche-google">Atelier Fiche Google <small>à venir</small></span>
<span class="footer-v2-future" data-future-url="/formation-charge-de-communication">Formation pour chargés de communication <small>à venir</small></span>
</div>
<div class="footer-v2-col">
<strong>Contact</strong>
<a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a>
<a href="{whatsapp}" target="_blank" rel="noopener noreferrer">WhatsApp →</a>
<a href="https://www.linkedin.com/in/victoria-dury-paranoir/" target="_blank" rel="noopener noreferrer">LinkedIn →</a>
</div>
<div class="footer-v2-legal">
<span>Paranoir Studio © | Tous droits réservés | 2026–2027</span>
<nav aria-label="Liens légaux">
<a href="/mentions-legales.html">Mentions légales</a>
<a href="/politique-confidentialite.html">Confidentialité</a>
<a href="/politique-cookies.html">Cookies</a>
<button class="footer-cookie-btn" id="manageCookies" type="button">Gérer les cookies</button>
</nav>
</div>
</div>
</footer>'''
html = re.sub(r'<footer class="site-footer">.*?</footer>', new_footer, html, count=1, flags=re.S)

# -----------------------------------------------------------------------------
# CSS additionnels et cache-busting
# -----------------------------------------------------------------------------
for stylesheet in ("offers-v2.css", "site-refresh-v2.css"):
    if stylesheet not in html:
        html = html.replace(
            "</head>",
            f'<link rel="stylesheet" href="/assets/css/{stylesheet}?v={version}"/>\n</head>',
            1,
        )

html = re.sub(
    r'(/assets/js/site\.min\.js)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    html,
)
index.write_text(html, encoding="utf-8")

# Le bootstrap construit le header moderne : on aligne son CTA et on versionne tous les assets chargés.
bootstrap = Path("assets/js/site.min.js")
script = bootstrap.read_text(encoding="utf-8")
script = script.replace("Faire le test gratuit", "Demander mon diagnostic gratuit")
script = re.sub(
    r'(/assets/(?:js|css)/[^?"\']+)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    script,
)
bootstrap.write_text(script, encoding="utf-8")

print(f"Prepared deploy {version}")
