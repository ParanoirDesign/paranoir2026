(() => {
  const WHATSAPP_URL = `https://wa.me/33637432180?text=${encodeURIComponent('Bonjour Victoria, je viens de remplir le questionnaire de diagnostic stratégique sur le site de Paranoir Studio. Je préfère poursuivre l’échange sur WhatsApp.')}`;

  const ensureStylesheet = () => {
    if (document.querySelector('link[href*="diagnostic-v2.css"]')) return;
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/assets/css/diagnostic-v2.css?v=2';
    document.head.appendChild(link);
  };

  const setText = (element, text) => {
    if (element) element.textContent = text;
  };

  const applyDiagnosticCopy = () => {
    ensureStylesheet();

    const section = document.getElementById('test') || document.getElementById('prediagnostic');
    if (!section || section.dataset.diagnosticV3 === 'true') return;
    section.dataset.diagnosticV3 = 'true';

    const head = section.querySelector('.prequiz-head');
    setText(head?.querySelector('.kicker'), 'Diagnostic stratégique gratuit');
    setText(head?.querySelector('h2'), 'Votre diagnostic commence par quelques questions.');
    setText(head?.querySelector('.quiz-subtitle'), 'Vous répondez. Nous analysons. Nous vous présentons les conclusions.');

    const ledes = head ? Array.from(head.querySelectorAll('.lede')) : [];
    const explanation = ledes.find(item => !item.classList.contains('quiz-subtitle'));
    if (explanation) {
      explanation.innerHTML = '<strong>Le questionnaire est la première étape.</strong> Paranoir étudie ensuite vos réponses et vos principaux supports, prépare un dossier d’analyse personnalisé, puis vous le présente lors d’un échange gratuit.';
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
      note.textContent = 'Après validation, choisissez comment poursuivre : en réservant un rendez-vous ou en nous écrivant sur WhatsApp. Nous étudierons vos réponses avant l’échange et préparerons votre dossier d’analyse personnalisé.';
    }

    const resultCta = quiz.querySelector('#resultCta');
    if (resultCta) {
      resultCta.classList.add('diagnostic-result-v2');
      resultCta.innerHTML = `
        <div>
          <small>Choisissez la suite</small>
          <strong>Votre dossier sera préparé avant l’échange</strong>
          <span>Réservez un rendez-vous de restitution ou écrivez-nous sur WhatsApp pour convenir du format qui vous convient.</span>
        </div>
        <div class="diagnostic-contact-actions">
          <a class="cta" href="https://meet.brevo.com/victoria-dury/rapport-de-clarte" target="_blank" rel="noopener noreferrer" aria-label="Choisir un rendez-vous de restitution, ouvre dans un nouvel onglet">Choisir un rendez-vous <span aria-hidden="true">→</span></a>
          <a class="diagnostic-whatsapp" href="${WHATSAPP_URL}" target="_blank" rel="noopener noreferrer" aria-label="Continuer sur WhatsApp, ouvre dans un nouvel onglet">Continuer sur WhatsApp <span aria-hidden="true">→</span></a>
        </div>`;
    }

    const submitButton = quiz.querySelector('#quizSubmit');
    if (submitButton) submitButton.textContent = 'Envoyer mes réponses →';

    const privacy = quiz.querySelector('.quiz-privacy');
    if (privacy) {
      privacy.textContent = 'Vos réponses servent uniquement à préparer votre analyse et votre échange avec Paranoir. Pas d’abonnement, pas de relance automatique déguisée en relation humaine.';
    }

    const result = quiz.querySelector('#quizResult');
    quiz.addEventListener('submit', () => {
      requestAnimationFrame(() => {
        if (!result) return;
        result.innerHTML = '<strong>Vos réponses sont bien enregistrées.</strong><br>Paranoir va étudier votre situation et préparer votre dossier d’analyse personnalisé. Vous pouvez maintenant choisir un rendez-vous ou poursuivre directement sur WhatsApp.';
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
      heroMicrocopy.textContent = 'Quelques questions · Un dossier personnalisé · Rendez-vous ou WhatsApp';
    }

    const footerContact = document.querySelector('.footer-contact');
    if (footerContact && !footerContact.querySelector('.footer-whatsapp')) {
      const whatsappLink = document.createElement('a');
      whatsappLink.className = 'footer-whatsapp';
      whatsappLink.href = WHATSAPP_URL;
      whatsappLink.target = '_blank';
      whatsappLink.rel = 'noopener noreferrer';
      whatsappLink.textContent = 'WhatsApp →';
      whatsappLink.setAttribute('aria-label', 'Contacter Paranoir Studio sur WhatsApp, ouvre dans un nouvel onglet');
      footerContact.appendChild(whatsappLink);
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(applyDiagnosticCopy), { once: true });
  } else {
    requestAnimationFrame(applyDiagnosticCopy);
  }
})();
