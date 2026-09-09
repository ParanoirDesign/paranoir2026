from pathlib import Path

# Le diagnostic public est désormais porté par assets/js/home-v3.js.
# Cette étape ne réécrit plus l'ancien quiz. Elle sert uniquement de dernier
# nettoyage du HTML généré par prepare_deploy.py avant le contrôle public.
site = Path("assets/js/site.js")
index = Path("index.html")

if not site.exists() or not index.exists():
    raise SystemExit("Fichiers publics introuvables pendant le build")

html = index.read_text(encoding="utf-8")
html = html.replace("Clarté Déployée", "Stratégie + déploiement")
html = html.replace("Rapport de Clarté", "diagnostic gratuit")
index.write_text(html, encoding="utf-8")

print("Legacy quiz runtime left untouched; final public copy cleaned")
