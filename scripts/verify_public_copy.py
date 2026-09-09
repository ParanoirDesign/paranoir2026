from pathlib import Path
import os

version = os.environ.get("BUILD_VERSION", "dev")[:8]
html = Path("index.html").read_text(encoding="utf-8")
home_js = Path("assets/js/home-v3.js").read_text(encoding="utf-8")
public_runtime = html + "\n" + home_js

expected_html = [
    "Votre valeur reste floue.",
    "Nous la rendons évidente.",
    "Commencer mon diagnostic gratuit",
    "7 questions. 3 minutes max. Une première réponse claire, sans engagement.",
    "Plus de communication.<br>Pas forcément plus de clarté.</strong>",
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
    "Échanger sur WhatsApp",
]

expected_runtime = [
    "Question 1 sur 7",
    "Où en est votre activité aujourd’hui ?",
    "Combien d’offres vos clients doivent-ils comprendre ?",
    "Quelqu’un qui vous découvre comprend-il rapidement ce que vous vendez ?",
    "Votre site, votre réseau social et votre fiche Google racontent-ils la même chose ?",
    "Qu’avez-vous déjà aujourd’hui ?",
    "Qu’est-ce qui vous freine le plus aujourd’hui ?",
    "Quelle est votre priorité maintenant ?",
    "Votre priorité : clarifier avant de communiquer davantage.",
    "Votre priorité : remettre vos supports dans le même sens.",
    "Votre priorité : organiser une activité devenue plus complexe.",
    "Votre priorité : mieux exploiter des bases déjà solides.",
    "Votre priorité : construire dans le bon ordre.",
    "Parler de mon diagnostic",
    "Continuer sur WhatsApp",
    "Nous avons vos réponses, vous n’aurez pas à recommencer.",
    "fetch('/mail.php'",
]

missing_html = [text for text in expected_html if text not in html]
missing_runtime = [text for text in expected_runtime if text not in public_runtime]
missing = missing_html + missing_runtime
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

remaining = [text for text in forbidden if text in public_runtime]
if remaining:
    raise RuntimeError("Ancien ou contenu contradictoire encore présent : " + " | ".join(remaining))

if f"<!-- build:{version} -->" not in html:
    raise RuntimeError("Marqueur de build absent")

print(f"Public copy verified for build {version}")
print(f"  HTML checks: {len(expected_html)}")
print(f"  Runtime checks: {len(expected_runtime)}")
print("  Legacy copy: clean")
