from pathlib import Path
import json
import os
import re
from urllib.parse import quote

version = os.environ.get("BUILD_VERSION", "dev")[:8]
whatsapp = "https://wa.me/33637432180?text=" + quote(
    "Bonjour Paranoir, je souhaite échanger sur mon projet et mon diagnostic."
)
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
    if href in source:
        return source
    id_attr = f' id="{element_id}"' if element_id else ""
    tag = f'<link{id_attr} rel="stylesheet" href="{href}?v={version}"/>'
    return source.replace("</head>", tag + "\n</head>", 1)


# -----------------------------------------------------------------------------
# Métadonnées et données structurées
# -----------------------------------------------------------------------------
meta_description = (
    "Paranoir Studio clarifie votre offre, votre message et votre positionnement, "
    "puis déploie cette stratégie sur votre site internet, votre réseau social principal "
    "et votre fiche Google Business Profile. Commencez par un diagnostic gratuit en 7 questions."
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
        "legalName": "Paranoir Studio",
        "url": "https://paranoir.fr/",
        "slogan": "Du flou à l'évidence",
        "logo": {
            "@type": "ImageObject",
            "url": "https://paranoir.fr/assets/images/logo-paranoir-studio-noir-illu-hd.png",
        },
        "image": "https://paranoir.fr/assets/images/alexandre-victoria-paranoir-opti.webp",
        "email": "victoria@paranoir.me",
        "telephone": "+33637432180",
        "description": "Studio de stratégie et de déploiement digital. Paranoir clarifie l'offre, le positionnement et le message, puis les déploie sur le site internet, le réseau social principal et la fiche Google Business Profile.",
        "foundingDate": "2018",
        "areaServed": "FR",
        "inLanguage": "fr",
        "knowsAbout": [
            "Stratégie d'offre",
            "Positionnement de marque",
            "Message marketing",
            "Site internet",
            "UX et accessibilité numérique",
            "Réseaux sociaux",
            "Google Business Profile",
            "Diagnostic stratégique",
        ],
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
            "sameAs": linkedin,
        },
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
        "name": "Accompagnements Paranoir Studio",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@type": "Service",
                    "name": "Diagnostic gratuit",
                    "description": "Sept questions donnent une première orientation claire sur le principal point à traiter. Le prospect peut ensuite transmettre ses réponses à Paranoir ou poursuivre sur WhatsApp, sans engagement.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {
                        "@type": "Offer",
                        "price": "0",
                        "priceCurrency": "EUR",
                        "availability": "https://schema.org/InStock",
                    },
                },
            },
            {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@type": "Service",
                    "name": "Stratégie complète + site en une page",
                    "description": "Pour une activité structurée autour d'une offre principale : dossier stratégique complet, site internet en une page, réseau social principal optimisé et fiche Google Business Profile optimisée.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {
                        "@type": "Offer",
                        "price": "990",
                        "priceCurrency": "EUR",
                        "availability": "https://schema.org/InStock",
                    },
                },
            },
            {
                "@type": "ListItem",
                "position": 3,
                "item": {
                    "@type": "Service",
                    "name": "Stratégie complète + site de 5 à 15 pages",
                    "description": "Pour une activité avec plusieurs offres, publics ou enjeux de visibilité : dossier stratégique complet, site de 5 à 15 pages, organisation des contenus, réseau social principal optimisé et fiche Google Business Profile optimisée.",
                    "provider": {"@id": "https://paranoir.fr/#organization"},
                    "offers": {
                        "@type": "Offer",
                        "price": "3290",
                        "priceCurrency": "EUR",
                        "availability": "https://schema.org/InStock",
                    },
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
                "name": "Pourquoi commencer par le diagnostic gratuit ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Parce qu'avant de parler de pages, de fonctionnalités ou de budget, il faut comprendre ce qui bloque réellement. En 7 questions, vous obtenez une première direction et évitez de choisir seul une solution qui n'est peut-être pas adaptée.",
                },
            },
            {
                "@type": "Question",
                "name": "Que se passe-t-il après le diagnostic ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Vous obtenez une première lecture de votre situation. Paranoir peut ensuite reprendre vos réponses avec vous, approfondir les points importants et confirmer le format adapté. Vous n'avez pas besoin de tout réexpliquer.",
                },
            },
            {
                "@type": "Question",
                "name": "Quelle différence entre le projet à 990 € HT et celui à partir de 3 290 € HT ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Le premier correspond aux activités qui peuvent concentrer leur offre et leur message sur une seule page. Le second convient aux entreprises qui doivent présenter plusieurs offres, plusieurs publics, davantage de contenus ou travailler leur visibilité sur plusieurs pages. Le diagnostic permet de confirmer le bon format.",
                },
            },
            {
                "@type": "Question",
                "name": "Pourquoi travailler avec Paranoir plutôt qu'avec une agence classique ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Paranoir est un studio implanté sur son territoire. Vous travaillez directement avec un binôme stratégie et technique expérimenté. Plus de 60 entreprises ont été accompagnées. Une demande de site devient une stratégie claire, un plan d'action et des supports alignés pour continuer à communiquer.",
                },
            },
            {
                "@type": "Question",
                "name": "Peut-on tout faire à distance ?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Oui. Paranoir accompagne aussi bien des entreprises du territoire que des clients ailleurs en France. Les échanges peuvent se faire en visioconférence et sur WhatsApp.",
                },
            },
        ],
    },
]

schema_html = '<script type="application/ld+json">\n' + json.dumps(schema, ensure_ascii=False, indent=2) + '\n</script>'
html = re.sub(r'<script type="application/ld\+json">.*?</script>', schema_html, html, count=1, flags=re.S)


# -----------------------------------------------------------------------------
# Hero statique : même promesse que la version interactive
# -----------------------------------------------------------------------------
hero = extract(r'<section class="hero">.*?</section>', html, "hero")
hero = re.sub(
    r'<div class="eyebrow">.*?</div>',
    '<div class="eyebrow"><span class="dot"></span>Site internet · Réseau social · Fiche Google</div>',
    hero,
    count=1,
    flags=re.S,
)
hero = re.sub(
    r'<h1>.*?</h1>',
    '<h1>Votre valeur reste floue.<span class="hero-line-two">Nous la rendons évidente.</span></h1>',
    hero,
    count=1,
    flags=re.S,
)
hero = re.sub(
    r'<p class="sub">.*?</p>',
    '<p class="sub">Nous clarifions <strong>ce que vous vendez</strong>, <strong>à qui vous le vendez</strong> et <strong>pourquoi vous êtes différent</strong>. Puis nous déployons cette clarté sur votre site, votre réseau social principal et votre fiche Google Business Profile.</p>',
    hero,
    count=1,
    flags=re.S,
)
hero = re.sub(
    r'<div class="hero-actions">.*?</div>',
    '<div class="hero-actions"><a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a><p class="micro">3 minutes · Sans engagement · Un premier niveau de clarté immédiatement</p><div class="hero-proof-line"><span class="hero-proof-line__stars" aria-label="5 étoiles">★★★★★</span><span>5/5 sur Google</span><span class="hero-proof-line__separator" aria-hidden="true"></span><span>Plus de 60 entreprises accompagnées</span></div></div>',
    hero,
    count=1,
    flags=re.S,
)
hero = hero.replace('<span>Dossier ouvert</span>\n<span>Enquête stratégique</span>', '<span>Système de clarté</span>\n<span>Stratégie → déploiement</span>')
hero = hero.replace('<div class="stamp">Cause trouvée</div>', '<div class="stamp">Message aligné</div>')


# -----------------------------------------------------------------------------
# Réalisations et avis existants : on conserve les vrais médias et témoignages
# -----------------------------------------------------------------------------
realisations = extract(r'<section class="realisations">.*?</section>', html, "réalisations")
realisations = realisations.replace('<section class="realisations">', '<section class="realisations" id="realisations">', 1)
realisations = re.sub(r'<p class="kicker">Réalisations</p>\s*<h2>.*?</h2>', '<p class="kicker">Réalisations</p>\n<h2>Des problèmes différents. <span class="highlight">Des réponses visibles.</span></h2>', realisations, count=1, flags=re.S)
realisation_tags = [
    '<p class="real-offer"><span>Positionnement</span><span>Message</span><span>Site</span></p>',
    '<p class="real-offer"><span>Positionnement</span><span>Site</span><span>Référencement</span></p>',
    '<p class="real-offer"><span>Identité</span><span>Message</span><span>Site</span></p>',
]
iterator = iter(realisation_tags)
realisations = re.sub(r'<p class="real-offer">.*?</p>', lambda _: next(iterator), realisations, count=3, flags=re.S)

reviews = extract(r'<section class="google-reviews">.*?</section>', html, "avis")
reviews = reviews.replace('<section class="google-reviews">', '<section class="google-reviews" id="avis">', 1)
reviews = re.sub(r'<p class="kicker">.*?</p>\s*<h2>.*?</h2>', '<p class="kicker">Ils ont travaillé avec nous</p>\n<h2>Le résultat compte. La façon d’y arriver aussi.</h2>', reviews, count=1, flags=re.S)


# -----------------------------------------------------------------------------
# Fallback HTML : lisible, indexable et cohérent avant le JavaScript enrichi
# -----------------------------------------------------------------------------
static_home = '''
<section class="home-section home-proof" id="preuve">
<div class="home-section__inner"><div class="home-proof__grid">
<div class="home-proof__item"><strong>+60</strong><span>entreprises accompagnées</span></div>
<div class="home-proof__item"><strong>★★★★★ 5/5</strong><span>sur Google</span></div>
<div class="home-proof__item"><strong>Des conseils en continu</strong><div class="home-proof__links"><a href="''' + linkedin + '''" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a><a href="''' + instagram + '''" target="_blank" rel="noopener noreferrer">Instagram ↗</a></div></div>
</div></div></section>

<section class="home-section cycle-section cycle-section--problem" id="approche">
<div class="home-section__inner"><div class="cycle-wrap">
<div class="cycle-copy"><p class="home-kicker">Quand le message se dérègle</p><h2>Le client ne devrait pas avoir à deviner ce que vous faites.</h2><p class="home-lede">Votre activité peut évoluer plus vite que votre communication. Le problème commence souvent là.</p><div class="cycle-copy__note">La solution n’est pas d’en dire davantage. C’est de repartir d’une base commune.</div></div>
<div class="cycle-visual" role="img" aria-label="Cercle vicieux de la perte de clarté"><div class="cycle-ring"><div class="cycle-arrow" aria-hidden="true"></div><div class="cycle-center"><strong>Plus de communication.<br>Pas forcément plus de clarté.</strong></div><div class="cycle-node cycle-node--1">Votre activité évolue</div><div class="cycle-node cycle-node--2">Votre offre devient plus difficile à résumer</div><div class="cycle-node cycle-node--3">Site, réseaux et Google ne racontent plus la même chose</div><div class="cycle-node cycle-node--4">Le client hésite ou comprend mal votre différence</div><div class="cycle-node cycle-node--5">Vous ajoutez du contenu pour mieux expliquer</div><div class="cycle-node cycle-node--6">Votre message devient encore plus difficile à suivre</div></div></div>
</div></div></section>

<section class="home-section process-section" id="methode"><div class="home-section__inner">
<div class="home-section__head"><p class="home-kicker">Du diagnostic à la mise en ligne</p><h2>Vous savez ce qu’on fait, ce que vous recevez et ce qui vient ensuite.</h2></div>
<div class="process-grid">
<article class="home-card process-step"><span class="process-step__num">01</span><h3>Vous nous donnez le contexte</h3><p>Votre activité, vos offres, vos clients, ce qui existe déjà et ce qui vous pose problème.</p><p class="process-step__accent">Pas besoin de préparer un dossier. Nous allons chercher l’information avec vous.</p></article>
<article class="home-card process-step"><span class="process-step__num">02</span><h3>Nous mettons tout à plat ensemble</h3><p>Nous confrontons ce que vous voulez transmettre à ce que vos clients doivent réellement comprendre.</p><p class="process-step__accent">Nous décidons ensemble ce qui doit rester, ce qui doit évoluer et ce qui doit passer en premier.</p></article>
<article class="home-card process-step"><span class="process-step__num">03</span><h3>Vous recevez votre dossier stratégique complet</h3><div class="deliverables"><div class="deliverable"><strong>Fondations</strong><span>Analyse de l’existant · Mission & vision · Positionnement</span></div><div class="deliverable"><strong>Offres & message</strong><span>Offres · Messages clés · Réponses aux objections clients</span></div><div class="deliverable"><strong>Identité & site</strong><span>Charte graphique · Arborescence · Organisation des contenus</span></div><div class="deliverable"><strong>Déploiement</strong><span>Guide réseau social · Guide fiche Google · Plan d’action 30 jours</span></div></div><p class="process-step__accent">Vous savez quoi dire, comment le montrer et dans quel ordre avancer.</p></article>
<article class="home-card process-step"><span class="process-step__num">04</span><h3>Nous le déployons avec vous</h3><p>Nous construisons et mettons votre site en ligne, optimisons votre réseau social principal et votre fiche Google Business Profile, puis nous vous accompagnons dans leur mise en œuvre.</p><p>La restitution validée ensemble devient le document de référence de tout le déploiement.</p><p class="process-step__accent">Vous ne repartez pas avec un rapport à appliquer seul. Vous repartez avec une stratégie déjà mise en mouvement.</p></article>
</div></div></section>

<section class="home-section diagnostic-section" id="diagnostic"><div class="home-section__inner"><div class="home-card diagnostic-shell"><div class="diagnostic-intro"><h2>Faites votre diagnostic gratuit</h2><p class="diagnostic-promise">7 questions. 3 minutes max. Une première réponse claire, sans engagement.</p></div><div class="diagnostic-form"><ol class="offer-situations"><li>Où en est votre activité aujourd’hui ?</li><li>Combien d’offres vos clients doivent-ils comprendre ?</li><li>Quelqu’un qui vous découvre comprend-il rapidement ce que vous vendez ?</li><li>Votre site, votre réseau social et votre fiche Google racontent-ils la même chose ?</li><li>Qu’avez-vous déjà aujourd’hui ?</li><li>Qu’est-ce qui vous freine le plus aujourd’hui ?</li><li>Quelle est votre priorité maintenant ?</li></ol><p class="process-step__accent">Le formulaire interactif affiche une question à la fois et vous donne une première orientation immédiatement.</p></div></div></div></section>

<section class="home-section offers-section" id="projets"><div class="home-section__inner"><div class="home-section__head"><p class="home-kicker">Deux situations, deux formats</p><h2>Le bon format dépend surtout de ce que vos clients doivent comprendre.</h2><p class="home-lede">Le diagnostic nous permet de confirmer le format adapté avant de commencer.</p></div><div class="offers-grid">
<article class="home-card offer-card-v3"><p class="offer-card-v3__kicker">Vous avez une offre principale</p><h3>Une page claire peut suffire.</h3><p class="offer-card-v3__price">990 € HT</p><p class="offer-card-v3__intro">Ce format correspond notamment à une entreprise qui :</p><ul class="offer-situations"><li>se lance ou relance son activité ;</li><li>vend principalement une offre ou un service ;</li><li>possède un ancien site qui ne correspond plus à ce qu’elle fait aujourd’hui ;</li><li>a besoin d’expliquer clairement son activité, rassurer et permettre une prise de contact ;</li><li>n’a pas besoin de multiplier les pages pour être comprise.</li></ul><div class="offer-delivery"><span>Site en une page</span><span>Réseau social principal optimisé</span><span>Fiche Google Business Profile optimisée</span></div><p class="offer-card-v3__intro">Avec le travail stratégique nécessaire pour que les trois racontent la même chose.</p><a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a></article>
<article class="home-card offer-card-v3"><p class="offer-card-v3__kicker">Vous avez plusieurs offres, publics ou sujets à expliquer</p><h3>Il faut organiser avant d’ajouter des pages.</h3><p class="offer-card-v3__price">À partir de 3 290 € HT</p><p class="offer-card-v3__intro">Ce format correspond notamment à une entreprise qui :</p><ul class="offer-situations"><li>propose plusieurs services ou plusieurs offres ;</li><li>s’adresse à plusieurs types de clients ;</li><li>possède un site devenu difficile à suivre au fil des années ;</li><li>a fait évoluer son activité sans faire évoluer toute sa communication ;</li><li>doit créer des pages spécifiques pour être trouvée sur Google ;</li><li>doit aider différents visiteurs à trouver rapidement ce qui les concerne.</li></ul><div class="offer-delivery"><span>Site de 5 à 15 pages</span><span>Organisation du site et de la navigation</span><span>Réseau social principal optimisé</span><span>Fiche Google Business Profile optimisée</span></div><p class="offer-card-v3__intro">Avec un travail plus approfondi sur vos offres, vos messages et l’organisation des contenus.</p><a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a></article>
</div></div></section>

<section class="home-section ai-section" id="ia"><div class="home-section__inner"><div class="home-card ai-section__panel"><div class="ai-grid"><div class="ai-manifesto"><p class="home-kicker">L’IA accélère. Elle ne décide pas.</p><h2>L’IA peut construire un site. Elle ne sait pas décider à votre place.</h2><p>Chez Paranoir, nous utilisons l’intelligence artificielle pour rechercher, analyser, prototyper, automatiser et produire plus efficacement.</p><p>Mais nous ne lui confions pas les décisions qui devront encore être bonnes demain : votre message, l’organisation de vos contenus, les choix techniques et la manière dont votre site devra évoluer.</p><div class="ai-callout">L’IA est un outil.<br>Pas un technicien.</div></div><div class="ai-points"><div class="ai-point"><strong>Un site généré peut sembler terminé très vite.</strong><span>La vraie difficulté apparaît quand il faut ajouter une offre, une page, une fonctionnalité ou faire évoluer le référencement.</span></div><div class="ai-point"><strong>Une architecture non pensée vieillit mal.</strong><span>Chaque évolution peut devenir plus fragile, plus compliquée ou plus coûteuse si personne n’a prévu comment le site devait être repris et maintenu.</span></div><div class="ai-point"><strong>Nous utilisons l’IA pour aller plus vite.</strong><span>Nous gardons les décisions humaines qui rendent votre site maintenable, évolutif et pérenne.</span></div><div class="ai-point"><strong>Votre activité va évoluer.</strong><span>Votre site doit pouvoir suivre sans devoir être entièrement reconstruit à chaque changement.</span></div></div></div></div></div></section>

<section class="home-section cycle-section cycle-section--positive" id="experience"><div class="home-section__inner"><div class="cycle-wrap"><div class="cycle-copy"><p class="home-kicker">Ce que vous vivez avec nous</p><h2>Pas de boîte noire entre le premier échange et la mise en ligne.</h2><span class="editorial-accent">Vous comprenez les choix. Vous savez où on va. Vous gardez la main.</span></div><div class="cycle-visual" role="img" aria-label="Cercle vertueux de l’accompagnement Paranoir"><div class="cycle-ring"><div class="cycle-arrow" aria-hidden="true"></div><div class="cycle-center"><strong>Un projet compris est plus facile à faire vivre.</strong></div><div class="cycle-node cycle-node--1">Vous nous expliquez votre activité avec vos mots</div><div class="cycle-node cycle-node--2">Nous remettons les informations dans le bon ordre</div><div class="cycle-node cycle-node--3">Nous expliquons chaque recommandation simplement</div><div class="cycle-node cycle-node--4">Vous validez les décisions importantes</div><div class="cycle-node cycle-node--5">Vous les voyez prendre forme sur vos supports</div><div class="cycle-node cycle-node--6">Vous gardez les repères pour continuer et évoluer</div></div></div></div></div></section>
'''

studio = '''
<section class="home-section studio-v3" id="studio"><div class="home-section__inner"><div class="studio-grid"><div class="home-card studio-photo"><picture><source srcset="/assets/images/alexandre-victoria-paranoir-opti.webp" type="image/webp"><img src="/assets/images/alexandre-victoria-paranoir-opti.png" alt="Victoria et Alexandre, Paranoir Studio" width="800" height="1202" loading="lazy"></picture></div><div class="home-card studio-copy"><p class="home-kicker">Victoria + Alexandre</p><h2>Deux expertises. Un seul projet.</h2><div class="studio-copy__roles"><div class="studio-role"><strong>Victoria</strong><span>Clarifie l’offre, le message, l’expérience et la direction visuelle.</span></div><div class="studio-role"><strong>Alexandre</strong><span>Transforme ces choix en un site fiable, rapide et capable d’évoluer avec votre activité.</span></div></div><p class="home-lede">Vous travaillez directement avec nous, du premier échange à la mise en ligne.</p><p class="studio-signature">La stratégie sait où aller. La technique sait comment y arriver.</p><div class="credentials"><h3>Diplômes & certifications</h3><div class="credentials-grid"><div class="credential-person"><strong>Victoria Dury</strong><ul><li><b>Accessibilité numérique RGAA</b> · UX Vision</li><li><b>Marketing Digital</b> · Learning Shelter</li><li><b>Directrice artistique UX-UI</b> · Fonderie de l’image</li><li><b>UI Designer / Intégration web</b> · Fonderie de l’image</li></ul></div><div class="credential-person"><strong>Alexandre Dury</strong><ul><li><b>Développeur WordPress</b> · CFM</li><li><b>Direction artistique</b> · Fonderie de l’image</li><li><b>Chef de projet</b> · Fonderie de l’image</li></ul></div></div></div></div></div></div></section>
'''

experience_rail = '''
<section class="home-section experience-rail" id="experiences"><div class="home-section__inner"><div class="experience-rail__head"><div><p class="home-kicker">Au fil de nos parcours</p><h2>Nous avons travaillé avec des entreprises de toutes tailles.</h2></div></div><div class="brand-marquee" aria-label="Entreprises rencontrées au fil de nos parcours professionnels"><div class="brand-marquee__track"><span class="brand-word">Aéroport de Paris</span><span class="brand-word">Michelin</span><span class="brand-word">Alfa Romeo</span><span class="brand-word">AG2R</span><span class="brand-word">MMA</span><span class="brand-word">MSA</span><span class="brand-word" aria-hidden="true">Aéroport de Paris</span><span class="brand-word" aria-hidden="true">Michelin</span><span class="brand-word" aria-hidden="true">Alfa Romeo</span><span class="brand-word" aria-hidden="true">AG2R</span><span class="brand-word" aria-hidden="true">MMA</span><span class="brand-word" aria-hidden="true">MSA</span></div></div></div></section>
'''

faq = '''
<section class="home-section faq-v3" id="faq"><div class="home-section__inner"><div class="home-section__head"><h2>FAQ</h2></div><div class="faq-v3__list">
<details><summary>Pourquoi commencer par le diagnostic gratuit ?</summary><p>Parce qu’avant de parler de pages, de fonctionnalités ou de budget, il faut comprendre ce qui bloque réellement. En 7 questions, vous obtenez une première direction et évitez de choisir seul une solution qui n’est peut-être pas adaptée.</p></details>
<details><summary>Que se passe-t-il après le diagnostic ?</summary><p>Vous obtenez une première lecture de votre situation. Nous pouvons ensuite reprendre vos réponses avec vous, approfondir les points importants et confirmer le format adapté. Vous n’avez pas besoin de tout réexpliquer.</p></details>
<details><summary>Quelle différence entre le projet à 990 € HT et celui à partir de 3 290 € HT ?</summary><p>Le premier correspond aux activités qui peuvent concentrer leur offre et leur message sur une seule page. Le second convient aux entreprises qui doivent présenter plusieurs offres, plusieurs publics, davantage de contenus ou travailler leur visibilité sur plusieurs pages. Le diagnostic permet de confirmer le bon format.</p></details>
<details><summary>Pourquoi travailler avec Paranoir plutôt qu’avec une agence classique ?</summary><p>Parce que vous ne venez pas simplement acheter un site. Paranoir est un studio implanté sur son territoire, avec une volonté de travailler durablement avec les entreprises qui l’entourent et de faire circuler les compétences localement. Nous avons plusieurs années d’expérience et plus de 60 entreprises accompagnées. Vous pouvez venir nous voir pour un site. Vous repartez avec une stratégie claire, un plan d’action, un site construit autour de cette stratégie et des supports alignés pour continuer à communiquer. Et vous travaillez directement avec un binôme stratégie + technique qui a déjà fait ses preuves.</p></details>
<details><summary>Peut-on tout faire à distance ?</summary><p>Oui. Nous travaillons aussi bien avec des entreprises du territoire qu’avec des clients ailleurs en France. Les échanges peuvent se faire en visioconférence et sur WhatsApp.</p></details>
</div></div></section>
'''

final_cta = '''
<section class="home-section final-v3" id="cta-final"><div class="home-section__inner"><div class="final-v3__panel"><h2>Vous ne savez pas encore ce qu’il faut refaire ? C’est justement par là qu’on commence.</h2><p><strong>7 questions. 3 minutes max.</strong><br>Identifiez ce qui brouille votre communication avant d’engager du temps ou du budget au mauvais endroit.</p><div class="final-v3__actions"><a class="cta" href="#diagnostic">Commencer mon diagnostic gratuit <span>→</span></a><a class="diagnostic-btn" href="''' + whatsapp + '''" target="_blank" rel="noopener noreferrer">Échanger sur WhatsApp</a></div><p class="final-v3__micro">Gratuit · Sans engagement</p></div></div></section>
'''

new_main = '<main id="main">\n' + hero + static_home + realisations + '\n' + reviews + studio + experience_rail + faq + final_cta + '\n</main>'
html = re.sub(r'<main id="main">.*?</main>', new_main, html, count=1, flags=re.S)


# -----------------------------------------------------------------------------
# Navigation statique cohérente avant le bootstrap JS
# -----------------------------------------------------------------------------
static_nav = '''<nav class="nav">
<a class="brand" href="/">Paranoir Studio</a>
<div class="nav-mid">Stratégie &amp; déploiement</div>
<div class="nav-right">
<a class="nav-link" href="#approche">Approche</a>
<a class="nav-link" href="#diagnostic">Diagnostic</a>
<a class="nav-link" href="#projets">Offres</a>
<a class="nav-link" href="#realisations">Réalisations</a>
<a class="nav-cta" href="#diagnostic">Commencer mon diagnostic gratuit</a>
</div>
</nav>'''
html = re.sub(r'<nav class="nav">.*?</nav>', static_nav, html, count=1, flags=re.S)


# -----------------------------------------------------------------------------
# Footer : navigation principale, accompagnements spécifiques et contacts
# -----------------------------------------------------------------------------
new_footer = '''<footer class="site-footer">
<div class="footer-inner footer-inner-v2">
<div class="footer-brand"><span class="footer-logo">Paranoir Studio</span><p class="footer-tagline">Du flou à l'évidence.</p></div>
<nav class="footer-v2-col footer-nav" aria-label="Navigation footer"><strong>Parcours</strong><a href="#approche">Approche</a><a href="#diagnostic">Diagnostic gratuit</a><a href="#projets">Offres</a><a href="#realisations">Réalisations</a><a href="#avis">Avis</a><a href="#studio">Studio</a><a href="#faq">FAQ</a></nav>
<div class="footer-v2-col" aria-label="Accompagnements spécifiques"><strong>Accompagnements spécifiques</strong><span class="footer-v2-future">Sites pour gîtes et hébergements touristiques <small>à venir</small></span><a href="#ia">IA pour les entreprises</a><span class="footer-v2-future">Atelier Fiche Google <small>à venir</small></span><span class="footer-v2-future">Formation communication <small>à venir</small></span></div>
<div class="footer-v2-col footer-contact"><strong>Contact</strong><a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a><a href="''' + whatsapp + '''" target="_blank" rel="noopener noreferrer">WhatsApp →</a><a href="''' + linkedin + '''" target="_blank" rel="noopener noreferrer">LinkedIn →</a><a href="''' + instagram + '''" target="_blank" rel="noopener noreferrer">Instagram →</a></div>
<div class="footer-v2-legal"><span>Paranoir Studio © | Tous droits réservés | 2026–2027</span><nav aria-label="Liens légaux" class="site-footer-links"><a href="/mentions-legales.html">Mentions légales</a><a href="/politique-confidentialite.html">Confidentialité</a><a href="/politique-cookies.html">Cookies</a><button class="footer-cookie-btn" id="manageCookies" type="button">Gérer les cookies</button></nav></div>
</div>
</footer>'''
html = re.sub(r'<footer class="site-footer">.*?</footer>', new_footer, html, count=1, flags=re.S)


# -----------------------------------------------------------------------------
# CSS critique des couches modernes chargé aussi sans JavaScript
# -----------------------------------------------------------------------------
html = ensure_stylesheet(html, "/assets/css/navigation-v2.css", "navigation-v2-css")
html = ensure_stylesheet(html, "/assets/css/hero-v2.css", "hero-v2-css")
html = ensure_stylesheet(html, "/assets/css/home-v3.css")
html = ensure_stylesheet(html, "/assets/css/home-v3-qc.css")

# Marqueur de build et cache-busting des scripts publics.
html = re.sub(r'<!-- build:[^>]* -->\s*', '', html, count=1)
html = html.replace('<body class="site-home">', f'<!-- build:{version} -->\n<body class="site-home">', 1)
html = re.sub(
    r'(/assets/js/site\.min\.js)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    html,
)
html = re.sub(
    r'(/assets/js/cookies\.min\.js)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    html,
)

index.write_text(html, encoding="utf-8")

# Le bootstrap reste le point d’entrée JS. On aligne son CTA et versionne ses assets.
bootstrap = Path("assets/js/site.min.js")
script = bootstrap.read_text(encoding="utf-8")
script = script.replace("Faire le test gratuit", "Diagnostic gratuit")
script = script.replace("Test de clarté", "Diagnostic gratuit")
script = re.sub(
    r'(/assets/(?:js|css)/[^?"\']+)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    script,
)
bootstrap.write_text(script, encoding="utf-8")

print(f"Prepared deploy {version}")
