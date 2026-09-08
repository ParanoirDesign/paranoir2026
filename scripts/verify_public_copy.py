from pathlib import Path
import os
import re

version = os.environ.get("BUILD_VERSION", "dev")[:8]
index = Path("index.html")
html = index.read_text(encoding="utf-8")

# Manifeste visible juste après les preuves sociales : même structure, nouveau message.
html = re.sub(
    r'<section class="statement">\s*<h2 class="reveal" style="margin:0 auto">.*?</h2>\s*</section>',
    '<section class="statement">\n<h2 class="reveal" style="margin:0 auto">Vos clients passent de Google à votre site, puis à vos réseaux. <span class="highlight">Ils doivent comprendre la même chose partout.</span></h2>\n</section>',
    html,
    count=1,
    flags=re.S,
)

# Les anciens noms ne doivent plus survivre dans le contenu public.
# On garde naturellement les slugs techniques historiques quand ils ne sont pas affichés.
public_replacements = {
    'Obtenir mon Rapport de Clarté': 'Demander mon diagnostic gratuit',
    'Rapport de Clarté': 'dossier d’analyse personnalisé',
    'Clarté Déployée': 'Projet stratégique + déploiement',
    'Test de clarté': 'Diagnostic stratégique',
    'test de clarté': 'diagnostic stratégique',
    'Formation Clarté': 'Formation pour chargés de communication',
    'remis en visio': 'présenté lors d’un échange gratuit',
    'remise en visio': 'présentation lors d’un échange gratuit',
}
for old, new in public_replacements.items():
    html = html.replace(old, new)

# Marqueur de build non visible, utile pour diagnostiquer une préprod sans toucher au design.
html = re.sub(r'<!-- build:[^>]* -->\s*', '', html, count=1)
html = html.replace('<body class="site-home">', f'<!-- build:{version} -->\n<body class="site-home">', 1)

expected = [
    'Diagnostic stratégique gratuit',
    'Stratégie complète + site en une page',
    'Stratégie complète + site de 5 à 15 pages',
    'Continuer sur WhatsApp',
    'Sites pour gîtes et hébergements touristiques',
    'Ils doivent comprendre la même chose partout.',
]
missing = [text for text in expected if text not in html]
if missing:
    raise RuntimeError('Contenu public incomplet avant déploiement : ' + ' | '.join(missing))

forbidden = [
    'Rapport de Clarté',
    'Clarté Déployée',
    'Test de clarté',
    'test de clarté',
]
remaining = [text for text in forbidden if text in html]
if remaining:
    raise RuntimeError('Ancien vocabulaire encore présent : ' + ' | '.join(remaining))

index.write_text(html, encoding="utf-8")
print(f'Public copy verified for build {version}')
for text in expected:
    print(f'  OK: {text}')
