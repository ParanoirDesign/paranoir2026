(() => {
  const setText = (element, text) => {
    if (element) element.textContent = text;
  };

  const applyDiagnosticCopy = () => {
    const section = document.getElementById('test') || document.getElementById('prediagnostic');
    if (!section || section.dataset.diagnosticV2 === 'true') return;
    section.dataset.diagnosticV2 = 'true';

    const head = section.querySelector('.prequiz-head');
    setText(head?.querySelector('.kicker'), 'Diagnostic stratégique gratuit');
    setText(head?.querySelector('h2'), 'Votre diagnostic commence par quelques questions.');
    setText(head?.querySelector('.quiz-subtitle'), 'Vous répondez. Nous analysons. Nous vous présentons les conclusions.');

    const ledes = head ? Array.from(head.querySelectorAll('.lede')) : [];
    const explanation = ledes.find(item => !item.classList.contains('quiz-subtitle'));
    if (explanation) {
      explanation.innerHTML = '<strong>Le questionnaire est la première étape.</strong> Paranoir étudie ensuite vos réponses et vos principaux supports, prépare un dossier d’analyse personnalisé, puis vous le présente lors d’un rendez-vous gratuit.';
    }

    const orbitCenter = head?.querySelector('.orbit-center');
    setText(orbitCenter, '?');
    const orbitLabels = ['réponses', 'analyse', 'dossier', 'restitution'];
    head?.querySelectorAll('.orbit-pill').forEach((pill, index) => {
      if (orbitLabels[index]) pill.textContent = orbitLabels[index];
    });

    const quiz = section.querySelector('#growthQuiz');
    if (!quiz) return;

    const lastStep = quiz.querySelector('.quiz-step[data-step="5"]');
    setText(lastStep?.querySelector('legend'), 'Où pouvons-nous vous contacter pour préparer votre diagnostic ?');

    const note = lastStep?.querySelector('.quiz-note');
    if (note) {
      note.textContent = 'Après validation, choisissez votre rendez-vous de restitution. Nous étudierons vos réponses avant l’échange et préparerons votre dossier d’analyse personnalisé.';
    }

    const resultCta = quiz.querySelector('#resultCta');
    if (resultCta) {
      const small = resultCta.querySelector('small');
      const strong = resultCta.querySelector('strong');
      const description = resultCta.querySelector('span');
      const bookingLink = resultCta.querySelector('a');

      setText(small, 'Étape suivante');
      setText(strong, 'Réservez votre rendez-vous de restitution');
      setText(description, 'Nous analyserons vos réponses et vos principaux supports avant l’échange. Votre dossier d’analyse personnalisé vous sera présenté pendant ce rendez-vous gratuit.');
      if (bookingLink) {
        bookingLink.innerHTML = 'Choisir mon créneau <span aria-hidden="true">→</span>';
        bookingLink.setAttribute('aria-label', 'Choisir mon rendez-vous de restitution, ouvre dans un nouvel onglet');
      }
    }

    const submitButton = quiz.querySelector('#quizSubmit');
    if (submitButton) submitButton.textContent = 'Envoyer mes réponses →';

    const privacy = quiz.querySelector('.quiz-privacy');
    if (privacy) {
      privacy.textContent = 'Vos réponses servent uniquement à préparer votre analyse et le rendez-vous de restitution. Pas d’abonnement, pas de relance automatique déguisée en relation humaine.';
    }

    const result = quiz.querySelector('#quizResult');
    quiz.addEventListener('submit', () => {
      requestAnimationFrame(() => {
        if (!result) return;
        result.innerHTML = '<strong>Vos réponses sont bien enregistrées.</strong><br>La prochaine étape consiste à choisir votre rendez-vous. Paranoir étudiera votre situation et préparera votre dossier d’analyse personnalisé avant de vous le présenter.';
        result.classList.add('active');
      });
    });

    if (submitButton) {
      const normalizeSubmitLabel = () => {
        if (submitButton.textContent.includes('Rapport envoyé')) {
          submitButton.textContent = '✓ Demande envoyée !';
        }
      };
      new MutationObserver(normalizeSubmitLabel).observe(submitButton, {
        childList: true,
        characterData: true,
        subtree: true
      });
    }

    document.querySelectorAll('a[href="#test"], a[href="#prediagnostic"]').forEach(link => {
      const isPrimaryCta = link.classList.contains('cta');
      link.innerHTML = isPrimaryCta
        ? 'Demander mon diagnostic gratuit <span aria-hidden="true">→</span>'
        : 'Demander mon diagnostic gratuit';
      link.setAttribute('href', '#test');
    });

    const heroMicrocopy = document.querySelector('.hero-v2 .hero-actions .micro');
    if (heroMicrocopy) {
      heroMicrocopy.textContent = 'Quelques questions · Un dossier personnalisé · Un rendez-vous gratuit';
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(applyDiagnosticCopy), { once: true });
  } else {
    requestAnimationFrame(applyDiagnosticCopy);
  }
})();
