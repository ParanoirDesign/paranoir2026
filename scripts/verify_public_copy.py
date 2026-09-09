from pathlib import Path
import os

version = os.environ.get("BUILD_VERSION", "dev")[:8]
html = Path("index.html").read_text(encoding="utf-8")

expected = [
    "Votre valeur reste floue.",
    "Nous la rendons évidente.",
    "Commencer mon diagnostic gratuit",
    "7 questions. 3 minutes max. Une première réponse claire, sans engagement.",
    "Plus de communication.<br>Pas forcément plus de clarté.",
    "Vous recevez votre dossier stratégique complet",
    "Réponses aux objections clients",
    "Plan d’action 30 jours",
    "Nous le déployons avec vous",
    "Une page claire peut suffire.",
    "990 € HT",
    "Il faut organiser avant d’ajouter des pages.",
    "3 290 € HT",
    "L’IA est un outil.<br>Pas un technicien.",
    "maintenable, évolutif et pérenne",
    "Pas de boîte noire entre le premier échange et la mise en ligne.",
    "Des problèmes différents.",
    "Le résultat compte. La façon d’y arriver aussi.",
    "Diplômes & certifications",
    "Accessibilité numérique RGAA",
    "UX Vision",
    "Marketing Digital",
    "Learning Shelter",
    "Fonderie de l’image",
    "Développeur WordPress",
    "CFM",
    "Au fil de nos parcours",
    "Pourquoi travailler avec Paranoir plutôt qu’avec une agence classique ?",
    "5/5 sur Google",
    "Instagram",
    "Continuer sur WhatsApp",
]

missing = [text for text in expected if text not in html]
if missing:
    raise RuntimeError("Contenu public incomplet avant déploiement : " + " | ".join(missing))

forbidden = [
    "Rapport de Clarté",
    "Clarté Déployée",
    "Test de clarté",
    "test de clarté",
    "Faire le test gratuit",
    "23 avis Google",
    "Stratégie + déploiement digital",
    "Cinq questions",
    "parcours de vente simple",
    "si elle est utile",
    '"reviewCount": "23"',
]

remaining = [text for text in forbidden if text in html]
if remaining:
    raise RuntimeError("Ancien ou contenu contradictoire encore présent : " + " | ".join(remaining))

if f"<!-- build:{version} -->" not in html:
    raise RuntimeError("Marqueur de build absent")

Path("index.html").write_text(html, encoding="utf-8")
print(f"Public copy verified for build {version}")
for text in expected:
    print(f"  OK: {text}")
