from pathlib import Path
import re

site = Path("assets/js/site.js")
script = site.read_text(encoding="utf-8")

new_builder = '''    function buildQuizResult() {
      const data = new FormData(quiz);
      const signal = data.get("signal");
      const offre = data.get("offre");
      const certitude = data.get("certitude");

      let hypothesis = "Situation à analyser avant de décider quoi corriger.";
      let label = "Hypothèse interne";

      if (offre === "long" || offre === "variable" || offre === "confus") {
        label = "Hypothèse interne : lisibilité de l’offre";
        hypothesis = "Les réponses suggèrent un problème possible de lisibilité de l’offre, de la cible ou de la différence perçue.";
      }

      if (signal === "conversion") {
        label = "Hypothèse interne : promesse ou parcours";
        hypothesis = "Les réponses suggèrent de vérifier la promesse, le parcours et la cohérence du site avant de conclure à un simple problème technique.";
      }

      if (certitude === "urgent") {
        label = "Hypothèse interne : décision d’investissement";
        hypothesis = "Le prospect doit arbitrer rapidement où investir. Priorité à la vérification des causes avant toute nouvelle dépense.";
      }

      if (quizResult) {
        quizResult.innerHTML = `<strong>Vos réponses sont bien enregistrées.</strong><br>Paranoir va maintenant étudier votre situation et préparer votre dossier d’analyse personnalisé. Vous pouvez choisir un rendez-vous ou poursuivre sur WhatsApp.`;
        quizResult.classList.add("active");
      }
      if (resultCta) resultCta.classList.add("active");
      return `${label} — ${hypothesis}`;
    }

    if (quiz && steps.length)'''

script, count = re.subn(
    r'    function buildQuizResult\(\) \{.*?\n    \}\n\n    if \(quiz && steps\.length\)',
    new_builder,
    script,
    count=1,
    flags=re.S,
)
if count != 1:
    raise SystemExit("Unable to patch buildQuizResult")

script = script.replace(
    '        buildQuizResult();\n        quiz.scrollIntoView({ behavior: "smooth", block: "center" });\n\n        const data = new FormData(quiz);\n        const resultatEl = document.getElementById("quizResult");\n        const resultatTexte = resultatEl ? resultatEl.textContent.trim() : "";',
    '        const resultatTexte = buildQuizResult();\n        quiz.scrollIntoView({ behavior: "smooth", block: "center" });\n\n        const data = new FormData(quiz);',
)
script = script.replace('submitBtn.textContent = res.ok ? "✓ Rapport envoyé !" : "Erreur — réessayez";', 'submitBtn.textContent = res.ok ? "✓ Demande envoyée !" : "Erreur — réessayez";')

site.write_text(script, encoding="utf-8")
print("Patched public quiz runtime")
