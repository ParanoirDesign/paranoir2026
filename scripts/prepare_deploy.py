from pathlib import Path
import os
import re
from urllib.parse import quote

version = os.environ.get("BUILD_VERSION", "dev")[:8]
whatsapp = "https://wa.me/33637432180?text=" + quote(
    "Bonjour Victoria, je viens de remplir le questionnaire de diagnostic stratégique sur le site de Paranoir Studio. Je préfère poursuivre l’échange sur WhatsApp."
)

index = Path("index.html")
html = index.read_text(encoding="utf-8")

replacements = {
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

html = re.sub(
    r'<section class="offer" id="reservation">.*?</section>\s*(?=<section class="about">)',
    new_offer + "\n",
    html,
    count=1,
    flags=re.S,
)

footer_old = '''<div class="footer-contact">
<a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a>
<a href="https://www.linkedin.com/in/victoria-dury-paranoir/" target="_blank" rel="noopener noreferrer">LinkedIn →</a>
</div>'''
footer_new = f'''<div class="footer-contact">
<a href="mailto:victoria@paranoir.me">victoria@paranoir.me</a>
<a href="{whatsapp}" target="_blank" rel="noopener noreferrer">WhatsApp →</a>
<a href="https://www.linkedin.com/in/victoria-dury-paranoir/" target="_blank" rel="noopener noreferrer">LinkedIn →</a>
</div>'''
html = html.replace(footer_old, footer_new)

if 'offers-v2.css' not in html:
    html = html.replace(
        '</head>',
        f'<link rel="stylesheet" href="/assets/css/offers-v2.css?v={version}"/>\n</head>',
        1,
    )

html = re.sub(
    r'(/assets/js/site\.min\.js)\?v=[^"\']+',
    lambda match: f"{match.group(1)}?v={version}",
    html,
)
index.write_text(html, encoding="utf-8")

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
