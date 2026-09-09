from pathlib import Path
import os
import re

version = os.environ.get("BUILD_VERSION", "dev")[:8]
html = Path("index.html").read_text(encoding="utf-8")
site_js = Path("assets/js/site.js").read_text(encoding="utf-8")
home_js = Path("assets/js/home-v3.js").read_text(encoding="utf-8")
hero_js = Path("assets/js/hero-deployment-v2.js").read_text(encoding="utf-8")
nav_js = Path("assets/js/home-v3-nav.js").read_text(encoding="utf-8")
public_runtime = "\n".join([html, site_js, home_js, hero_js, nav_js])

expected_html = [
    'class="site-home home-v3-ready"',
    'Votre valeur reste floue.',
    'Nous la rendons évidente.',
    'Faire le test gratuit',
    'id="approche"',
    'les mauvais signaux.',
    'v3-tangle',
    'id="test"',
    'Une question à la fois.',
    'Question <strong id="quizCurrent">1</strong>/5',
    'id="strategie"',
    'La stratégie est incluse',
    'id="document-strategique"',
    'Document de référence',
    'id="deploiement"',
    'Le fil se dénoue',
    'id="projets"',
    '990 € HT',
    '1 990 € HT',
    '2 990 € HT+',
    'id="fonctionnalites"',
    '17 bundles disponibles',
    'Boutique en ligne',
    'Espace formation / LMS',
    'Automatisations',
    'id="technique"',
    'L’IA va vite.',
    'Les mauvais choix aussi.',
    'id="methode"',
    'Comprendre.',
    'Décider.',
    'Déployer.',
    'Transmettre.',
    'id="realisations"',
    'Décision stratégique',
    'id="avis"',
    'id="studio"',
    'Deux expertises associées.',
    'id="faq"',
    'Le résultat du test est-il immédiat ?',
    'La stratégie est-elle réellement incluse ?',
    'Combien coûte un projet ?',
    'id="cta-final"',
    'Résultat immédiat',
    'Recommandation personnalisée',
    'À venir',
]

expected_runtime = [
    'fetch("/mail.php"',
    'initProjectSelector',
    'initBundles',
    'initProcess',
    'detective-thread',
    'requestAnimationFrame(render)',
    "querySelectorAll('.site-header__link[href^=\"#\"]')",
]

missing_html = [text for text in expected_html if text not in html]
missing_runtime = [text for text in expected_runtime if text not in public_runtime]
missing = missing_html + missing_runtime
if missing:
    raise RuntimeError("Contenu public incomplet avant déploiement : " + " | ".join(missing))

forbidden = [
    'Question 1 sur 7',
    '7 questions. 3 minutes max.',
    '3 290 € HT',
    'cycle-ring',
    'Deux situations, deux formats',
    'Pas de boîte noire entre le premier échange et la mise en ligne.',
]
remaining = [text for text in forbidden if text in html]
if remaining:
    raise RuntimeError("Ancienne direction encore présente dans le HTML public : " + " | ".join(remaining))

# Le CTA de conversion principal doit rester strictement identique.
if html.count('Faire le test gratuit') < 3:
    raise RuntimeError("CTA principal insuffisamment présent dans le HTML public")

# Les 17 bundles doivent bien être présents dans le navigateur de fonctionnalités.
bundle_buttons = re.findall(r'class="v3-bundle-button"', html)
if len(bundle_buttons) != 17:
    raise RuntimeError(f"Nombre de bundles incorrect : {len(bundle_buttons)} au lieu de 17")

# Un seul identifiant par cible, sinon navigation et accessibilité deviennent imprévisibles.
ids = re.findall(r'\sid="([^"]+)"', html)
duplicates = sorted({item for item in ids if ids.count(item) > 1})
if duplicates:
    raise RuntimeError("IDs dupliqués dans le HTML public : " + " | ".join(duplicates))

# Toutes les ancres internes doivent pointer vers une cible existante.
id_set = set(ids)
anchors = re.findall(r'href="#([^"]+)"', html)
missing_targets = sorted({anchor for anchor in anchors if anchor and anchor not in id_set})
if missing_targets:
    raise RuntimeError("Ancres internes sans cible : " + " | ".join(missing_targets))

if f"<!-- build:{version} -->" not in html:
    raise RuntimeError("Marqueur de build absent")

print(f"Public copy verified for build {version}")
print(f"  HTML checks: {len(expected_html)}")
print(f"  Runtime checks: {len(expected_runtime)}")
print(f"  Bundles: {len(bundle_buttons)}")
print(f"  Unique IDs: {len(id_set)}")
print("  Internal anchors: valid")
print("  Legacy layouts: absent")
