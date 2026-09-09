from pathlib import Path

# Le diagnostic public est désormais porté par assets/js/home-v3.js.
# Ce script reste volontairement présent dans le workflow pour ne pas casser
# l'étape de préparation historique, mais il ne réécrit plus l'ancien quiz.
site = Path("assets/js/site.js")
if not site.exists():
    raise SystemExit("assets/js/site.js introuvable")

print("Legacy quiz runtime left untouched; home-v3 owns the public diagnostic")
